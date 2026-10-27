#!/usr/bin/env python3
"""Discover self-contained WordPress extensions and build installable ZIPs."""
import argparse
import hashlib
import json
import re
import subprocess
import sys
import zipfile
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
IGNORED = {".git", ".github", "node_modules", ".venv", "venv", "tests", "test", "fixtures", "vendor", "dist", "build", "__pycache__"}
PACKAGE_EXCLUDES = {".git", ".github", "node_modules", ".venv", "venv", "tests", "test", "fixtures", "__pycache__", ".DS_Store"}
EXCLUDE_SUFFIXES = {".zip", ".log", ".pyc", ".phar"}
MAX_HEADER_BYTES = 16384

def header(path, field):
    content = path.read_bytes()[:MAX_HEADER_BYTES].decode("utf-8", "replace")
    match = re.search(r"^[ \t]*(?:\*[ \t]*)?" + re.escape(field) + r":[ \t]*(.+?)[ \t]*$", content, re.I | re.M)
    return match.group(1).strip() if match else ""

def discover():
    candidates = []
    for path in ROOT.rglob("*"):
        if any(part in IGNORED or part.startswith(".") for part in path.relative_to(ROOT).parts[:-1]):
            continue
        if not path.is_file() or path.is_symlink():
            continue
        if path.name == "style.css" and header(path, "Theme Name"):
            candidates.append(("theme", path.parent, path))
        elif path.suffix == ".php" and header(path, "Plugin Name"):
            candidates.append(("plugin", path.parent, path))
    result = []
    seen = set()
    for kind, folder, entry in candidates:
        relative = folder.relative_to(ROOT).as_posix()
        if relative in seen:
            raise ValueError("Multiple WordPress headers in same folder: " + relative)
        seen.add(relative)
        slug = folder.name
        if not re.fullmatch(r"[a-z0-9][a-z0-9-]*", slug):
            raise ValueError("Non-installable extension folder name: " + relative)
        version = header(entry, "Version")
        if not version or not re.fullmatch(r"[A-Za-z0-9][A-Za-z0-9._+-]*", version):
            raise ValueError("Missing/invalid Version header in " + str(entry))
        if kind == "theme":
            if not ((folder / "index.php").is_file() or (folder / "templates" / "index.html").is_file()):
                raise ValueError("Theme is missing index.php or templates/index.html: " + relative)
            if header(entry, "Template"):
                # A child theme needs a separately installed parent theme.
                raise ValueError("Child theme requires parent theme (not standalone): " + relative)
        result.append((kind, folder, entry, slug, version))
    return sorted(result, key=lambda x: (x[0], str(x[1])))

def files_in(folder):
    for p in sorted(folder.rglob("*")):
        if not p.is_file():
            continue
        rel = p.relative_to(folder)
        if p.is_symlink():
            raise ValueError("Symlink not supported in WordPress package: " + str(p))
        if any(part in PACKAGE_EXCLUDES or part.startswith(".") for part in rel.parts):
            continue
        if p.suffix.lower() in EXCLUDE_SUFFIXES:
            continue
        yield p

def validate(entry, folder, kind, php):
    # PHP parser checks all PHP sources that actually ship inside the ZIP.
    entries = list(files_in(folder))
    if kind == "plugin" and entry not in entries:
        raise ValueError("Plugin entrypoint excluded from package: " + str(entry))
    if not any(p.suffix == ".php" for p in entries) and kind == "plugin":
        raise ValueError("Plugin without PHP: " + str(folder))
    # Only check require/include with statically resolvable literal relative paths.
    # Dynamic include paths and third-party dependencies require runtime testing.
    for p in entries:
        if p.suffix == ".php":
            result = subprocess.run([php, "-l", str(p)], capture_output=True, text=True)
            if result.returncode:
                raise ValueError("PHP syntax invalid in " + str(p) + ": " + result.stdout + result.stderr)
    composer = folder / "composer.json"
    if composer.exists():
        data = json.loads(composer.read_text())
        deps = {name: version for name, version in data.get("require", {}).items() if name != "php" and not name.startswith("ext-")}
        if deps and not (folder / "vendor" / "autoload.php").is_file():
            raise ValueError("Composer dependencies are declared but vendor/autoload.php is missing: " + str(folder))
    for p in entries:
        if p.suffix == ".php":
            content = p.read_text(errors="replace")
            # Literal includes, including __DIR__ . '/file.php'; do not claim dynamic coverage.
            for match in re.finditer(r"(?:require|include)(?:_once)?\s*(?:\(\s*)?(?:__DIR__|dirname\s*\(\s*__FILE__\s*\))\s*\.\s*['\"](/[^'\"]+)['\"]", content):
                target = (p.parent / match.group(1).lstrip("/")).resolve()
                if not target.is_file() or not target.is_relative_to(folder.resolve()):
                    raise ValueError("Unresolved PHP file dependency: " + str(p) + " -> " + match.group(1))
    return entries

def build(args):
    out = Path(args.output).resolve()
    out.mkdir(parents=True, exist_ok=True)
    extensions = discover()
    if not extensions:
        raise ValueError("No WordPress extensions with valid headers found")
    manifest = []
    names = set()
    for kind, folder, entry, slug, version in extensions:
        name = f"{slug}-{version}.zip"
        if name in names:
            raise ValueError("Duplicate ZIP name: " + name)
        names.add(name)
        entries = validate(entry, folder, kind, args.php)
        archive = out / name
        with zipfile.ZipFile(archive, "w", compression=zipfile.ZIP_DEFLATED, compresslevel=9) as zf:
            for p in entries:
                zf.write(p, f"{slug}/{p.relative_to(folder).as_posix()}")
        with zipfile.ZipFile(archive) as zf:
            if zf.testzip() is not None:
                raise ValueError("ZIP CRC integrity failure: " + name)
            if f"{slug}/{entry.relative_to(folder).as_posix()}" not in zf.namelist():
                raise ValueError("Missing WordPress entrypoint in ZIP: " + name)
        digest = hashlib.sha256(archive.read_bytes()).hexdigest()
        manifest.append({"kind": kind, "source": folder.relative_to(ROOT).as_posix(), "slug": slug,
                         "version": version, "archive": name, "sha256": digest, "files": len(entries)})
        print(f"BUILT {kind}: {folder.relative_to(ROOT)} -> {name} ({len(entries)} files)")
    (out / "manifest.json").write_text(json.dumps(manifest, indent=2, ensure_ascii=False) + "\n")
    (out / "SHA256SUMS").write_text("".join(f"{m['sha256']}  {m['archive']}\n" for m in manifest))
    print(f"Validated {len(manifest)} WordPress extension(s)")
    return 0

if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    parser.add_argument("--output", default="dist/wordpress")
    parser.add_argument("--php", default="php")
    try:
        sys.exit(build(parser.parse_args()))
    except (ValueError, OSError, json.JSONDecodeError) as error:
        print("BUILD FAILED:", error, file=sys.stderr)
        sys.exit(1)
