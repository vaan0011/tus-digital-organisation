# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie soll verhindern, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, ausgeschlossene Wege oder den letzten verifizierten Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Vor der nächsten funktionalen Erweiterung soll ein reproduzierbarer Entwicklungs- und Testablauf etabliert werden, damit Änderungen gegen einen bekannten stabilen Stand geprüft werden können.

## Current Repository State

Projektpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktuell im `main` dokumentierte Plugin-Version:

`3.6.0`

Die Versionsnotiz beschreibt insbesondere die Reihenfolge und Terminierung von Spiel um Platz 3 und Finale.

## Last Known Good

Noch nicht formal dokumentiert.

Version `3.6.0` ist der aktuelle Referenzstand im Repository, darf aber nicht automatisch als vollständig verifizierter Last Known Good behandelt werden.

Der nächste Entwicklungszyklus soll mit einem dokumentierten Smoke-Test beginnen. Erst ein erfolgreich geprüfter Stand wird als Last Known Good festgehalten.

## Verified

- Der Event Planner liegt im vorgesehenen Projektordner.
- GitHub ist die maßgebliche Quelle für Code und Entwicklungsdokumentation.
- Entwicklungsarbeit erfolgt über Branch und Pull Request.
- Das im Plugin enthaltene TuS-Logo ist byte-identisch mit `design/logo/tus_logo.png` und damit eine technische Projektkopie der zentralen Logoquelle.

## Open

- Ein formaler Last Known Good muss noch durch einen reproduzierbaren Test bestätigt werden.
- Die konkrete WordPress-Testumgebung und der Smoke-Test-Ablauf müssen noch verbindlich festgelegt werden.
- Frühere Entwicklungsversuche und verworfene Ansätze sind nur dann zu übernehmen, wenn sie aus Repository, PRs oder anderen belastbaren Quellen rekonstruiert werden können. Sie werden nicht aus Erinnerung erfunden.

## Excluded / Already Tried

Noch keine belastbare projektweite Ausschlussliste angelegt.

Ab jetzt werden relevante erfolglose Hypothesen hier festgehalten, wenn ihre Wiederholung wahrscheinlich wäre.

## Relevant Decisions & Standards

- `../../standards/employee-operating-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../decisions/README.md`

## Active Governance Change

Die Governance v1 wird aktuell in PR #8 vorbereitet.

Sie enthält die verbindlichen Mitarbeiter-, Entwicklungs-, Archiv-, UI-, Marken- und Fortschrittsstandards.

## Next Meaningful Step

Nach Merge der Governance v1:

1. neuen Coding-Chat mit diesem `PROJECT-STATE.md` als Einstieg starten,
2. aktuellen Plugin-Stand in einer WordPress-Testumgebung installieren,
3. einen kleinen reproduzierbaren Smoke-Test definieren und durchführen,
4. erfolgreichen Stand als `Last Known Good` eintragen,
5. erst danach die nächste funktionale Änderung beginnen.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.