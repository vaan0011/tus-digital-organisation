# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie verhindert, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, verifizierte Erkenntnisse, ausgeschlossene Wege oder den letzten belastbaren Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Die bereits manuell verifizierten Event-Datums-Verbesserungen und das fachliche Zielbild werden auf einen frischen Branch des aktuellen `main` synchronisiert.

Danach wird der noch offene Baseline-Smoke-Test ab dem Turnier-Teil vollständig abgeschlossen. Erst anschließend beginnen weitere funktionale Erweiterungen des Event-Moduls.

Langfristiges fachliches Zielbild:

`FUNCTIONAL-SCOPE.md`

## Current Repository State

Projektpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktuell dokumentierte Plugin-Version:

`3.6.0`

Bekannter Versionsbefund:

- Plugin-Header: `3.6.0`
- `VTP_VERSION`: `3.5.0`
- `VTP_VERSION` wird im aktuellen Stand für CSS-Cache-Versionierung verwendet.

Reproduzierbare Baseline:

- Baseline-Kandidat: `032f1bd39a96fca6548eefb833442f12ed2aa17f`
- WordPress `7.1`
- PHP `8.2`
- Sprache `de_DE`
- Blueprint: `playground/baseline-3.6.0.json`

## Last Known Good

Noch nicht formal dokumentiert.

Der Baseline-Kandidat `032f1bd39a96fca6548eefb833442f12ed2aa17f` darf erst nach vollständig bestandenem `SMOKE-TEST.md` als Last Known Good bezeichnet werden.

## Verified

- GitHub ist die maßgebliche Quelle für Code, fachliches Zielbild, Entscheidungen und Entwicklungsstand.
- Entwicklung erfolgt über Branch und Pull Request.
- PR #10 mit reproduzierbarer Playground-/Smoke-Test-Infrastruktur wurde nach `main` gemergt.
- Der Playground-Preview-Workflow wurde erfolgreich ausgeführt.
- Smoke-Test Schritt 1 wurde manuell bestätigt: WordPress startet, Anmeldung funktioniert, Plugin ist aktiv und das Dashboard ist erreichbar.
- Smoke-Test Schritt 2 wurde manuell bestätigt: Ein Event lässt sich speichern, erneut öffnen und behält seine Kerndaten.
- Das Enddatum verwendet das Event-Startdatum als fachlichen Kontext, solange noch keine bewusste Nutzerauswahl erfolgt ist.
- Die Event-Tag-Logik aus PR #13 wurde manuell bestätigt: Bei Tag 1 `26.09.2026` und Tag 2 `27.09.2026` erhält ein neu hinzugefügter Tag 3 bereits beim Erzeugen `28.09.2026`.
- Der native Date-Picker öffnet dadurch im passenden Zeitraum.
- Eine spätere manuelle Datumswahl wird nicht automatisch überschrieben.
- Der zuvor getestete Ansatz, den Default erst während `pointerdown` oder `focus` zu setzen, ist als unzuverlässig widerlegt.
- Das daraus abgeleitete organisationsweite Datums-Picker-Muster ist im zentralen `design/ui-standard.md` dokumentiert.
- Das fachliche Zielbild des Event Planners ist in `FUNCTIONAL-SCOPE.md` definiert.

## Open

- Der Baseline-Smoke-Test muss ab Schritt 3 vollständig fortgesetzt und mit `PASSED` oder `FAILED` dokumentiert werden.
- Erst bei vollständigem `PASSED` wird der Baseline-Kandidat als erster formaler Last Known Good eingetragen.
- Der Versionsunterschied zwischen Plugin-Header `3.6.0` und `VTP_VERSION` `3.5.0` bleibt ein separater kleiner technischer Befund und wird nicht nebenbei verändert.
- Ältere Entwicklungs-PRs #6 und #7 basieren auf dem früheren Branch `organisation` und gelten nicht als aktueller Entwicklungsstand. Gewünschte Änderungen daraus werden später nur selektiv und gegen einen verifizierten LKG geprüft.

## Module Boundaries

Der Event Planner ist die fachliche Quelle für konkrete Veranstaltungen und deren operative Planung, insbesondere:

- Veranstaltungstage und Programm,
- Turniere,
- Helferbedarf und konkrete Helferschichten,
- Schichtzuordnung zu Personen, Mannschaften, Gruppen oder Abteilungen,
- tatsächlich am Event geleistete Schichtzeiten,
- Bestellungen und eventbezogene Ausgaben,
- spätere Event-Templates und Historie.

Das Projekt `member-engagement` bündelt perspektivisch die personenzentrierte Jahres-/Periodensicht auf Engagement, Helferstunden, Soll-Erfüllung und Rabatt-Berechtigungen. Dadurch wird keine zweite Helferschicht-Logik aufgebaut.

Gemeinsame Mannschafts- und Personenidentitäten werden vor einer dauerhaften Doppelpflege architektonisch geklärt.

## Excluded / Already Tried

- Der alte Branch `event-planner/baseline-smoke-test` wird nicht direkt nach `main` gemergt, weil er inzwischen deutlich hinter `main` liegt.
- Verifizierte Änderungen daraus werden stattdessen selektiv auf einen frischen Branch des aktuellen `main` übertragen.
- Ältere PRs auf Basis von `organisation` werden nicht gesammelt übernommen.
- Der Datums-Default wird nicht erst beim Öffnen des nativen Pickers gesetzt.
- Keine große funktionale Sammeländerung vor Abschluss des Baseline-Smoke-Tests.

## Relevant Decisions & Standards

- `FUNCTIONAL-SCOPE.md`
- `SMOKE-TEST.md`
- `../../standards/employee-operating-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../decisions/README.md`

## Active Development

Branch:

`event-planner/sync-verified-work`

Pull Request:

`#26 – Event Planner: verifizierte Arbeit auf aktuellen main synchronisieren`

Scope:

- verifizierte Event-Tag-Datumslogik auf aktuellen `main` übertragen,
- Datums-Picker-Standard sichern,
- fachliches Zielbild nach `main` bringen,
- Projektstatus bereinigen,
- keine neue fachliche Funktion erfinden.

## Next Meaningful Step

1. PR #26 prüfen und nach menschlicher Freigabe nach `main` übernehmen,
2. Baseline-Smoke-Test ab Schritt 3 `Turnier` fortsetzen,
3. Teams und Spielplan prüfen,
4. Ergebnis speichern und Persistenz prüfen,
5. öffentliche Ansicht prüfen,
6. bei vollständigem `PASSED` den ersten formalen Last Known Good dokumentieren,
7. danach das bestehende Event-Modul systematisch weiter vervollständigen.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.
