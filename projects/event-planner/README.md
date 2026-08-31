# Verein Turnierplaner

Das installierbare WordPress-Plugin liegt unter
[`plugin/verein-turnierplaner`](plugin/verein-turnierplaner).

## Plugin-Paket

Die GitHub Action **Verein Turnierplaner – Plugin-ZIP** erstellt bei Änderungen
am Plugin sowie bei manueller Ausführung die Datei
`verein-turnierplaner.zip`. Das Paket kann anschließend als Artifact
`verein-turnierplaner-plugin` aus dem jeweiligen Workflow-Lauf heruntergeladen
werden. Beim Paketieren übernimmt die Action das bereits unter
[`../../design/logo/tus_logo.png`](../../design/logo/tus_logo.png) versionierte
Vereinslogo in das Plugin. So enthält das installierbare Paket immer die
zentrale Logo-Fassung und bleibt zugleich eigenständig. Eine erzeugte ZIP-Datei
wird nicht im Repository versioniert.
