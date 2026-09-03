#!/usr/bin/env bash
set -euo pipefail

repo_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
plugin="verein-turnierplaner"
plugin_source="${repo_root}/projects/event-planner/plugin/${plugin}"
logo_source="${repo_root}/design/logo/tus_logo.png"
version="$(sed -n "s/^[[:space:]]*\* Version: \([0-9][0-9.]*\)$/\1/p" "${plugin_source}/${plugin}.php" | head -n 1)"

if [[ -z "${version}" ]]; then
  echo "Plugin-Version konnte nicht ermittelt werden." >&2
  exit 1
fi

output="${repo_root}/dist"
staging="$(mktemp -d)"
trap 'rm -rf "${staging}"' EXIT

mkdir -p "${output}" "${staging}/${plugin}"
cp -R "${plugin_source}/." "${staging}/${plugin}/"
cp "${logo_source}" "${staging}/${plugin}/assets/tus-mingolsheim-logo.png"
find "${staging}/${plugin}" -name '.DS_Store' -delete

rm -f "${output}/${plugin}-${version}.zip"
(
  cd "${staging}"
  zip -q -r "${output}/${plugin}-${version}.zip" "${plugin}"
)

rm -f "${output}/tus-digital-organisation-source.zip"
(
  cd "${repo_root}"
  zip -q -r "${output}/tus-digital-organisation-source.zip" . \
    -x '.git/*' '.git' 'dist/*' 'dist' '*.DS_Store' '*.zip'
)

printf 'Google-Drive-Pakete erstellt:\n'
printf '  %s\n' "${output}/${plugin}-${version}.zip"
printf '  %s\n' "${output}/tus-digital-organisation-source.zip"
