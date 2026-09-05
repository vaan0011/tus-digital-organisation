# Verein Turnierplaner

Das installierbare WordPress-Plugin liegt unter
[`plugin/verein-turnierplaner`](plugin/verein-turnierplaner).

## Plugin-Paket

Die Ablage und Weitergabe erfolgt über Google Drive. Das lokale Skript
[`../../scripts/build-gdrive-packages.sh`](../../scripts/build-gdrive-packages.sh)
erstellt mit folgendem Aufruf die benötigten Dateien:

```bash
./scripts/build-gdrive-packages.sh
```

Unter `dist/` entstehen anschließend:

- `verein-turnierplaner-<version>.zip` zur Installation in WordPress
- `tus-digital-organisation-source.zip` als vollständige Quellcode-Sicherung

Beim Paketieren wird das zentrale Vereinslogo aus
[`../../design/logo/tus_logo.png`](../../design/logo/tus_logo.png) in das Plugin
übernommen. Die erzeugten ZIP-Dateien werden nicht versioniert und können direkt
in den vorgesehenen Google-Drive-Ordner hochgeladen werden.
