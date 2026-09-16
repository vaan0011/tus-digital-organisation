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

Verbindliche Logik der Ansicht `aktive Events`:

`EVENTS-OVERVIEW.md`

Verbindliche Struktur für Event-Anlage und Sponsorenpflege:

`EVENT-FORM-UI.md`

Verbindliche Struktur und Fortschrittslogik für `Event bearbeiten`:

`EVENT-EDIT-UI.md`

Verbindliche Semantik für Fortschritts- und Statusfarben:

`STATUS-COLOR-STANDARD.md`

Verbindliche Regel für dauerhafte Datenhaltung:

`DATA-PERSISTENCE.md`

Verbindlicher UX-/Speicherstandard für normale Web-URLs:

`URL-INPUT-STANDARD.md`

Verbindlicher Projekt-Checkpoint:

`PROJECT-STATE.md`

Ein neuer Entwickler oder ein neuer Coding-Chat liest vor Arbeitsbeginn mindestens:

1. `FUNCTIONAL-SCOPE.md`
2. `DASHBOARD-LOGIC.md`
3. `EVENTS-OVERVIEW.md`
4. `EVENT-FORM-UI.md`
5. `EVENT-EDIT-UI.md`
6. `STATUS-COLOR-STANDARD.md`
7. `DATA-PERSISTENCE.md`
8. `URL-INPUT-STANDARD.md`
9. `PROJECT-STATE.md`
10. `../../roles/wordpress-developer/role.md`
11. `../../roles/wordpress-developer/development-standard.md`
12. `../../standards/iteration-and-progress.md`
13. `../../design/design-principles.md`
14. `../../design/ui-standard.md`
15. `../../design/logo.md`
16. relevante Einträge unter `../../decisions/`

## Working Rule

Der Chat ist Arbeitsraum.

Das Repository ist das Projektgedächtnis.

Langfristige fachliche Ziele, Entscheidungen, ausgeschlossene Lösungswege und der letzte verifizierte Stand werden deshalb nicht ausschließlich im Chat belassen.

`FUNCTIONAL-SCOPE.md` beschreibt, **was** der Event Planner langfristig fachlich leisten soll.

`DASHBOARD-LOGIC.md` beschreibt, **wie** Dashboard, operative Aufgaben und die Richtung von Auswertung/Historie fachlich funktionieren sollen.

`EVENTS-OVERVIEW.md` beschreibt, **wie** anstehende Events in aktive und geplante Veranstaltungen aufgeteilt werden, ohne einen zweiten manuell gepflegten Planungsstatus einzuführen.

`EVENT-FORM-UI.md` beschreibt, **wie** die Event-Anlage strukturiert wird, einschließlich Navigation, Vorlagen-Auswahl und zeilenweiser Sponsorenpflege.

`EVENT-EDIT-UI.md` beschreibt, **wie** der Event-Bearbeitungsscreen als kompakte Arbeitszentrale aufgebaut ist, wie die fünf Fortschrittsstufen berechnet werden und wie die Tagescontainer bedient werden.

`STATUS-COLOR-STANDARD.md` beschreibt, **wie** Grau, Blau, Gelb/Orange, Grün und Rot fachlich verwendet werden. Rot ist dabei ausdrücklich nur für echte kritische Zustände vorgesehen.

`DATA-PERSISTENCE.md` beschreibt, **wo und wie** dauerhaft benötigte fachliche Informationen gespeichert werden. Persistente Daten gehören in die Datenbank und dürfen nicht von Sessions oder flüchtigem Browserzustand abhängen.

`URL-INPUT-STANDARD.md` beschreibt, **wie** normale Web-URLs nutzerfreundlich eingegeben, automatisch normalisiert und dauerhaft vollständig gespeichert werden.

`PROJECT-STATE.md` beschreibt, **wo** die Entwicklung aktuell steht und was als Nächstes sinnvoll ist.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENTS-OVERVIEW.md`
- `EVENT-FORM-UI.md`
- `EVENT-EDIT-UI.md`
- `STATUS-COLOR-STANDARD.md`
- `DATA-PERSISTENCE.md`
- `URL-INPUT-STANDARD.md`
- `PROJECT-STATE.md`
- `SMOKE-TEST.md`
- `../member-engagement/`
- `../../roles/wordpress-developer/`
- `../../standards/`
- `../../design/`
- `../../decisions/`

## Future Development

Das Projekt entwickelt seine Dokumentation aus realer Arbeit weiter. Neue Dateien oder Prozesse entstehen nur, wenn sie einen wiederkehrenden praktischen Nutzen haben.
