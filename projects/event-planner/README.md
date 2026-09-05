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

`plugin/verein-turnierplaner/`

Verbindlicher fachlicher Funktionsrahmen:

`FUNCTIONAL-SCOPE.md`

Verbindliche Dashboard- und Auswertungslogik:

`DASHBOARD-LOGIC.md`

Verbindliche Struktur für Event-Anlage und Sponsorenpflege:

`EVENT-FORM-UI.md`

Verbindliche Regel für dauerhafte Datenhaltung:

`DATA-PERSISTENCE.md`

Verbindlicher Projekt-Checkpoint:

`PROJECT-STATE.md`

Ein neuer Entwickler oder ein neuer Coding-Chat liest vor Arbeitsbeginn mindestens:

1. `FUNCTIONAL-SCOPE.md`
2. `DASHBOARD-LOGIC.md`
3. `EVENT-FORM-UI.md`
4. `DATA-PERSISTENCE.md`
5. `PROJECT-STATE.md`
6. `../../roles/wordpress-developer/role.md`
7. `../../roles/wordpress-developer/development-standard.md`
8. `../../standards/iteration-and-progress.md`
9. `../../design/design-principles.md`
10. `../../design/ui-standard.md`
11. `../../design/logo.md`
12. relevante Einträge unter `../../decisions/`

## Working Rule

Der Chat ist Arbeitsraum.

Das Repository ist das Projektgedächtnis.

Langfristige fachliche Ziele, Entscheidungen, ausgeschlossene Lösungswege und der letzte verifizierte Stand werden deshalb nicht ausschließlich im Chat belassen.

`FUNCTIONAL-SCOPE.md` beschreibt, **was** der Event Planner langfristig fachlich leisten soll.

`DASHBOARD-LOGIC.md` beschreibt, **wie** Dashboard, operative Aufgaben und die Richtung von Auswertung/Historie fachlich funktionieren sollen.

`EVENT-FORM-UI.md` beschreibt, **wie** die Event-Anlage strukturiert wird, einschließlich Navigation, Vorlagen-Auswahl und zeilenweiser Sponsorenpflege.

`DATA-PERSISTENCE.md` beschreibt, **wo und wie** dauerhaft benötigte fachliche Informationen gespeichert werden. Persistente Daten gehören in die Datenbank und dürfen nicht von Sessions oder flüchtigem Browserzustand abhängen.

`PROJECT-STATE.md` beschreibt, **wo** die Entwicklung aktuell steht und was als Nächstes sinnvoll ist.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`
- `PROJECT-STATE.md`
- `SMOKE-TEST.md`
- `../member-engagement/`
- `../../roles/wordpress-developer/`
- `../../standards/`
- `../../design/`
- `../../decisions/`

## Future Development

Das Projekt entwickelt seine Dokumentation aus realer Arbeit weiter. Neue Dateien oder Prozesse entstehen nur, wenn sie einen wiederkehrenden praktischen Nutzen haben.
