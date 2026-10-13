#!/usr/bin/env python3
"""Fast, dependency-free guard against accidental repository clutter."""

import re
import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
# Existing, explicitly documented model gaps. New empty Markdown files are not allowed.
KNOWN_EMPTY = {
    "architecture/object-lifecycle.md",
    "core/objects/location.md",
    "core/objects/picture.md",
    "design/visual-language.md",
    "employees/hr/career.md",
    "employees/hr/onboarding.md",
    "employees/hr/recruitment.md",
    "employees/hr/skills.md",
    "organization/team-coordination.md",
}


def main() -> int:
    tracked = subprocess.check_output(["git", "ls-files", "-z"], cwd=ROOT)
    names = {p.decode("utf-8") for p in tracked.split(b"\0") if p}
    errors: list[str] = []

    for name in sorted(names):
        path = Path(name)
        if (
            path.name in {".DS_Store", "Thumbs.db"}
            or path.name.startswith("._")
            or "tmp" in path.parts
            or "dist" in path.parts
            or "__MACOSX" in path.parts
            or name.endswith(".zip")
        ):
            errors.append(f"Temporäre Datei eingecheckt: {name}")
        if path.suffix.lower() == ".md" and name not in KNOWN_EMPTY:
            if (ROOT / path).is_file() and (ROOT / path).stat().st_size == 0:
                errors.append(f"Neue leere Markdown-Datei: {name}")

    states = {
        name.removeprefix("projects/")
        for name in names
        if name.startswith("projects/")
        and len(Path(name).parts) == 3
        and name.endswith("/PROJECT-STATE.md")
    }
    for state in sorted(states):
        readme = "projects/" + state.replace("PROJECT-STATE.md", "README.md")
        if readme not in names:
            errors.append(f"Projekt ohne README: {readme}")

    portfolio = ROOT / "projects" / "PROJECT-PORTFOLIO.md"
    if not portfolio.is_file():
        errors.append("Zentrales Projektportfolio fehlt")
    else:
        text = portfolio.read_text(encoding="utf-8")
        references = re.findall(r"\x60([a-z0-9][a-z0-9-]*/PROJECT-STATE\.md)\x60", text)
        for ref in sorted(set(references)):
            if references.count(ref) > 1:
                errors.append(f"Projekt mehrfach im Portfolio: {ref}")
        for ref in sorted(states - set(references)):
            errors.append(f"Projekt nicht im Portfolio: {ref}")
        for ref in sorted(set(references) - states):
            errors.append(f"Portfolio-Verweis ohne Projektzustand: {ref}")
        match = re.search(r"\*\*(\d+) formale Projekte\*\*", text)
        if match and int(match.group(1)) != len(states):
            errors.append(f"Portfolio-Zählung {match.group(1)} stimmt nicht mit {len(states)} Projektzuständen überein")

    if errors:
        print("Repository-Hygiene: FEHLER")
        for error in errors:
            print("-", error)
        return 1
    print(f"Repository-Hygiene: OK – {len(names)} Dateien, {len(states)} Projekte, {len(KNOWN_EMPTY)} erlaubte Alt-Platzhalter.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
