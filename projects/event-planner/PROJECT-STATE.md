# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie soll verhindern, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, ausgeschlossene Wege oder den letzten verifizierten Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Vor der nächsten funktionalen Erweiterung wird ein reproduzierbarer Entwicklungs- und Testablauf etabliert, damit Änderungen gegen einen bekannten stabilen Stand geprüft werden können.

Der aktive Schritt ist PR #10 `Event Planner: reproduzierbare Baseline und Smoke-Test`.

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
- Der Baseline-Branch `event-planner/baseline-smoke-test` basiert direkt auf dem aktuellen `main`-Commit `032f1bd39a96fca6548eefb833442f12ed2aa17f`.
- PR #10 verändert keinen Event-Planner-Produktcode; er ergänzt ausschließlich Test-, Playground- und Projektzustands-Infrastruktur.
- Der neue WordPress-Playground-PR-Preview-Workflow wurde in PR #10 erfolgreich ausgeführt und hat einen funktionalen Preview-Einstieg in den PR eingefügt. Die frühere Annahme, dies sei erst nach Merge in den Default-Branch möglich, ist damit für dieses Repository widerlegt.

## Open

- Der Baseline-Smoke-Test für Commit `032f1bd39a96fca6548eefb833442f12ed2aa17f` muss noch vollständig durchgeführt und mit `PASSED` oder `FAILED` dokumentiert werden.
- Im Plugin-Header steht `3.6.0`, während `VTP_VERSION` noch `3.5.0` ist. Die Konstante wird im aktuellen Stand für Admin- und Public-CSS-Cache-Versionierung verwendet. Dieser Befund wird nicht im Baseline-Infrastruktur-PR nebenbei behoben.
- Frühere Entwicklungsversuche und verworfene Ansätze sind nur dann zu übernehmen, wenn sie aus Repository, PRs oder anderen belastbaren Quellen rekonstruiert werden können. Sie werden nicht aus Erinnerung erfunden.

## Excluded / Already Tried

- Ältere Entwicklungs-PRs auf Basis des früheren Branches `organisation` gelten nicht automatisch als aktueller Entwicklungsstand oder Last Known Good.
- Funktionale Änderungen aus diesen PRs werden nicht gesammelt übernommen, bevor die 3.6.0-Baseline formal verifiziert wurde.
- Die Annahme „Playground-PR-Preview funktioniert erst, wenn der Workflow bereits in `main` liegt“ gilt für dieses Repository als widerlegt: PR #10 hat den Preview-Button bereits vor Merge erfolgreich erzeugt.

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

Branch:

`event-planner/baseline-smoke-test`

Pull Request:

`#10 – Event Planner: reproduzierbare Baseline und Smoke-Test`

Scope:

- reproduzierbare WordPress-Playground-Baseline,
- verbindlicher Smoke-Test,
- PR-Preview-Infrastruktur,
- Aktualisierung dieses Projekt-Checkpoints.

Keine funktionale Änderung am Event Planner.

## Next Meaningful Step

1. den in PR #10 bereitgestellten WordPress-Playground-Preview öffnen,
2. den Baseline-Kandidaten anhand `SMOKE-TEST.md` vollständig prüfen,
3. Testergebnis direkt in diesem Entwicklungszyklus dokumentieren,
4. bei `PASSED` Commit `032f1bd39a96fca6548eefb833442f12ed2aa17f` als ersten formalen Last Known Good eintragen,
5. PR #10 anschließend prüfen und nach menschlicher Freigabe in `main` übernehmen,
6. erst danach den nächsten funktionalen Entwicklungs-PR beginnen,
7. ältere PRs anschließend selektiv auf wiederverwendbare, noch gewünschte Änderungen prüfen.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.
