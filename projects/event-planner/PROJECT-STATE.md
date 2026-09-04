# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie soll verhindern, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, ausgeschlossene Wege oder den letzten verifizierten Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Vor der nächsten größeren funktionalen Erweiterung wird ein reproduzierbarer Entwicklungs- und Testablauf etabliert, damit Änderungen gegen einen bekannten stabilen Stand geprüft werden können.

Parallel dazu wird die aktuell getestete Event-UX in kleinen, gestapelten Pull Requests verbessert, ohne die Baseline-Arbeit zu umgehen.

## Current Repository State

Projektpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktuell im `main` dokumentierte Plugin-Version:

`3.6.0`

Aktueller Baseline-Kandidat:

`032f1bd39a96fca6548eefb833442f12ed2aa17f`

Die Versionsnotiz beschreibt insbesondere die Reihenfolge und Terminierung von Spiel um Platz 3 und Finale.

Governance v1 und v1.1 sind in `main` übernommen. Die früheren Hinweise auf einen noch ausstehenden Governance-Merge sind damit erledigt.

## Last Known Good

Noch nicht formal dokumentiert.

Version `3.6.0` und Commit `032f1bd39a96fca6548eefb833442f12ed2aa17f` bilden den aktuellen Baseline-Kandidaten, dürfen aber erst nach bestandenem dokumentiertem Smoke-Test als Last Known Good bezeichnet werden.

Der reproduzierbare Ablauf ist in `SMOKE-TEST.md` definiert. Die fest gepinnte Playground-Konfiguration liegt unter `playground/baseline-3.6.0.json`.

## Verified

- Der Event Planner liegt im vorgesehenen Projektordner.
- GitHub ist die maßgebliche Quelle für Code und Entwicklungsdokumentation.
- Entwicklungsarbeit erfolgt über Branch und Pull Request.
- Das im Plugin enthaltene TuS-Logo ist byte-identisch mit `design/logo/tus_logo.png` und damit eine technische Projektkopie der zentralen Logoquelle.
- Der WordPress-Playground-PR-Preview-Workflow wurde erfolgreich ausgeführt.
- Smoke-Test Schritt 1 wurde manuell bestätigt: WordPress startet, Anmeldung funktioniert, Plugin ist aktiv und das Event-Planner-Dashboard ist erreichbar.
- Smoke-Test Schritt 2 wurde manuell bestätigt: Ein Testevent lässt sich speichern, erneut öffnen und behält seine Kerndaten.
- PR #12 `Event Planner: Enddatum startet am Event-Startdatum` wurde in den Baseline-Branch übernommen und manuell als funktionierend bestätigt.

## Open

- Der Baseline-Smoke-Test für Commit `032f1bd39a96fca6548eefb833442f12ed2aa17f` muss ab Schritt 3 vollständig fortgesetzt und mit `PASSED` oder `FAILED` dokumentiert werden.
- Im Plugin-Header steht `3.6.0`, während `VTP_VERSION` noch `3.5.0` ist. Die Konstante wird im aktuellen Stand für Admin- und Public-CSS-Cache-Versionierung verwendet. Dieser Befund wird nicht nebenbei behoben.
- Frühere Entwicklungsversuche und verworfene Ansätze sind nur dann zu übernehmen, wenn sie aus Repository, PRs oder anderen belastbaren Quellen rekonstruiert werden können. Sie werden nicht aus Erinnerung erfunden.
- Die Event-Tag-Datumslogik und der organisationsweite Datums-Picker-Standard liegen im Folge-Branch `event-planner/event-date-picker-default` und müssen noch manuell geprüft werden.

## Excluded / Already Tried

- Ältere Entwicklungs-PRs auf Basis des früheren Branches `organisation` gelten nicht automatisch als aktueller Entwicklungsstand oder Last Known Good.
- Funktionale Änderungen aus diesen PRs werden nicht gesammelt übernommen, bevor die 3.6.0-Baseline formal verifiziert wurde.
- Die Annahme „Playground-PR-Preview funktioniert erst, wenn der Workflow bereits in `main` liegt“ gilt für dieses Repository als widerlegt.

## Relevant Decisions & Standards

- `../../standards/employee-operating-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../decisions/README.md`
- `SMOKE-TEST.md`

## Active Development

Baseline branch:

`event-planner/baseline-smoke-test`

Baseline Pull Request:

`#10 – Event Planner: reproduzierbare Baseline und Smoke-Test`

Aktueller gestapelter UX-Branch:

`event-planner/event-date-picker-default`

Aktueller UX-Scope:

- neue Event-Tage verwenden einen kontextbezogenen Datums-Default,
- der Datums-Picker startet dadurch im fachlich relevanten Zeitraum,
- manuelle Datumswahl wird nicht automatisch überschrieben,
- der gemeinsame UI-Standard enthält verbindliche Regeln für kontextbezogene Datums-Picker.

## Next Meaningful Step

1. neuen Event-Tag im Playground des aktuellen UX-Branches testen,
2. prüfen, dass ein leerer neuer Tag beim Öffnen `vorheriger Event-Tag + 1 Tag` verwendet,
3. prüfen, dass bei fehlendem vorherigen Tag das Event-Startdatum verwendet wird,
4. prüfen, dass eine manuelle Datumswahl danach nicht überschrieben wird,
5. Folge-PR nach menschlicher Freigabe in den Baseline-Branch übernehmen,
6. anschließend Smoke-Test ab Schritt 3 fortsetzen,
7. bei vollständigem `PASSED` den Baseline-Kandidaten als ersten formalen Last Known Good dokumentieren.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.
