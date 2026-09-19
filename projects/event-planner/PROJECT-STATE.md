# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie verhindert, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, verifizierte Erkenntnisse, ausgeschlossene Wege oder den letzten belastbaren Stand verlieren.

Sie ist kein Tagebuch. Detailentscheidungen stehen in den verlinkten Fach- und UI-Dokumenten.

## Current Goal

Der aktuelle Schwerpunkt ist die Fertigstellung des Event-Moduls als intuitive, persistente Veranstaltungsplanung.

Die Bereiche Event-Anlage, Event-Übersicht, Event-Bearbeitung und `Programmpunkte und Ablaufplanung` wurden in mehreren kleinen Schritten überarbeitet. Die Programm-/Ablaufplanung hat inzwischen einen manuell bestätigten, intuitiven Referenzstand erreicht und wird nicht ohne neuen konkreten fachlichen Bedarf oder reproduzierbaren Usability-Fehler grundlegend neu geöffnet.

Nächster fachlicher Ausbau nach Abschluss des aktuellen PRs:

1. echte persistente Event-Aufgaben,
2. Helferbedarf und Schichten,
3. Bestellungen und Ausgaben,
4. Templates und wiederverwendbare Veranstaltungsplanung,
5. Camps auf dem gemeinsamen Event-Grundmodell.

## Current Repository State

Projektpfad:

`projects/event-planner/`

Pluginpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktiver Entwicklungsbranch:

`event-planner/day-sort-program-count`

Aktiver Pull Request:

`PR #138 – Event Planner: Event-Tage chronologisch sortieren und Programmpunkte anzeigen`

Der PR enthält inzwischen zusätzlich die später bestätigten Folgeänderungen aus der laufenden Event-Ablauf-Arbeit.

Aktueller Plugin-Stand auf dem Branch:

- Plugin-Header: `3.8.17`
- `VTP_VERSION`: `3.8.17`

## Last Known Good

Noch nicht formal dokumentiert.

Der historische Baseline-Kandidat `032f1bd39a96fca6548eefb833442f12ed2aa17f` ist für den heutigen Funktionsumfang veraltet.

Ein neuer formaler Last Known Good wird erst für einen exakt referenzierten aktuellen Commit eingetragen, nachdem der vollständige `SMOKE-TEST.md` auf dem aktuellen Funktionsstand mit `PASSED` dokumentiert wurde.

## Verified

Manuell bestätigt bzw. im laufenden Arbeitszyklus verifiziert:

- Events können persistent angelegt und erneut geöffnet werden.
- Create und Edit verwenden dieselbe Backend-Form-Sprache.
- dauerhaft relevante Eventdaten werden in der Datenbank gespeichert; Sessions oder flüchtiger Browserzustand sind keine Source of Truth.
- URL-Felder akzeptieren Eingaben ohne Protokoll und normalisieren fehlendes Protokoll zu `https://`.
- neue Event-Tage werden aus dem Event-Datumsbereich initialisiert.
- neue zusätzliche Event-Tage verwenden standardmäßig den letzten normalen Event-Tag + 1 Kalendertag.
- Event-Tage können auf dasselbe Datum gelegt werden, ohne fachlich zusammenzufallen.
- Tagescontainer werden nach dem Speichern chronologisch sortiert.
- bei gleichem Datum gilt `Aufbau → Eventtag → Abbau`.
- die Nummerierung `Tag 1`, `Tag 2`, … wird aus den normalen Event-Tagen neu abgeleitet.
- Aufbau und Abbau zählen weder als normale Event-Tage noch als Programmpunkte.
- Aufbau und Abbau sind eigene persistente Tagesrollen und besitzen nur Datum und Uhrzeit.
- Aufbau und Abbau besitzen keinen Programmbereich.
- Programmpunkt-Typen sind aktuell `Programmpunkt`, `Musik`, `Spiel`.
- pro normalem Event-Tag wird die Anzahl der vorhandenen Programmpunkte in der kompakten Zeile angezeigt.
- die gesamte Sektion `Programmpunkte und Ablaufplanung` kann ein- und ausgeklappt werden.
- normale Event-Tage können separat ein- und ausgeklappt werden.
- Datums- und Aufbau-/Abbau-Zeitfelder sind im Event-Edit-Modus direkt editierbar.
- es gibt keinen unnötigen Edit-/Speichern-Mini-Modus pro Tageszeile; gespeichert wird gesammelt über `Event-Ablauf speichern`.
- die Statusleiste steht oberhalb der Event-Zentrale und verwendet die dokumentierte Statusfarbsemantik.
- Aufbau/Abbau werden nicht in der Programmpunkt-Kennzahl der Statusleiste berücksichtigt.
- die doppelte Darstellung der Eventhistorie im Dashboard wurde auf eine einzige Ausgabe reduziert.

## Accepted Reference – Programmpunkte und Ablaufplanung

Der aktuelle Stand dieser Kachel wurde vom Nutzer als final bzw. intuitiv bestätigt und gilt als Referenz für weitere UI-Arbeit.

Verbindliche Details:

- `EVENT-EDIT-UI.md`
- `EVENT-DAY-PLANNING.md`
- `STATUS-COLOR-STANDARD.md`
- `../../design/backend-ui-component-standard.md`
- `../../design/backend-form-standard.md`

Kernregeln:

- Event-Datumsbereich erzeugt die normalen Event-Tage automatisch.
- Aufbau/Abbau sind organisatorische Tagesrollen, keine Programmpunkte.
- Aufbau/Abbau haben Datum + Uhrzeit und dürfen am selben Datum wie ein Eventtag liegen.
- Programmpunkte existieren nur an normalen Event-Tagen.
- Tageszeilen sind kompakt, chronologisch und zeigen relevante Kennzahlen.
- direkte Bearbeitung wird bevorzugt, wenn kein eigener Bearbeitungsmodus fachlich nötig ist.
- eine zentrale Speicheraktion ist besser als redundante Speicheraktionen pro Zeile.
- Auf-/Zuklappen dient nur der UI und verändert keine Fachdaten.

Dieser Referenzstand soll nicht aufgrund von Geschmack oder eines neuen Chats wieder geöffnet werden.

## Dashboard / Eventübersicht

Verbindlich:

- Dashboard zeigt Schnellaktionen für Event, Turnier, Camp und Schichten.
- Dashboard-Zähler werden aus Fachdaten berechnet und nicht separat gepflegt.
- `Übersicht` zeigt anstehende bzw. laufende Objekte.
- Eventübersicht unterscheidet geplante und aktive Veranstaltungen aus vorhandenen Fachdaten, nicht über einen zweiten manuell gepflegten Status.
- `Veranstaltungskalender` führt auf die vorhandene öffentliche Kalenderansicht.
- `TuS Eventhistorie` wird im Dashboard genau einmal dargestellt.

## Event-Anlage / Event-Bearbeitung

Verbindliche Quellen:

- `EVENT-FORM-UI.md`
- `EVENT-EDIT-UI.md`
- `DATA-PERSISTENCE.md`
- `URL-INPUT-STANDARD.md`

Festgelegt:

- Create und Edit verwenden dieselbe Form-Sprache.
- Event-Stammdaten sind klar zweispaltig auf Desktop und einspaltig auf kleinen Displays.
- Sponsoren werden zeilenweise mit `Name`, `Logo`, `Link zur Homepage` gepflegt.
- wiederkehrende Buttons, Plus-Aktionen, Icon-Aktionen, Karten und Formfelder folgen den zentralen Backend-UI-Standards.
- Mockup-Farben sind keine Farbquelle; bestehende TuS-/Plugin-Tokens bleiben maßgeblich.

## Data Persistence

Verbindliche Quelle:

`DATA-PERSISTENCE.md`

Grundregel:

**Alle dauerhaft relevanten fachlichen Werte werden persistent in der Datenbank gespeichert.**

Das gilt insbesondere für:

- Event-Stammdaten,
- Sponsoreninformationen,
- Event-Tage,
- Tagesrollen,
- Aufbau-/Abbau-Uhrzeiten,
- Programmpunkte,
- Turniere,
- Aufgaben,
- Schichten,
- Helferbedarf,
- Bestellungen,
- Ausgaben,
- Templates und Camps.

## Module Boundaries

Der Event Planner ist die fachliche Quelle für konkrete Veranstaltungen und deren operative Planung, insbesondere:

- Veranstaltungstage und Programm,
- Aufbau und Abbau,
- Fußballcamps und deren Event-/Buchungsinformationen,
- Turniere,
- Event-Aufgaben und Checklisten,
- eventbezogene Sponsoren-/Partnerdarstellung,
- Helferbedarf und konkrete Helferschichten,
- tatsächlich am Event geleistete und bestätigte Schichtzeiten,
- Bestellungen und eventbezogene Ausgaben,
- Event-Templates und Eventhistorie.

Das Projekt `member-engagement` bündelt die personenzentrierte Jahres-/Periodensicht auf Engagement, Helferstunden, Soll-Erfüllung und Rabatt-Berechtigungen. Der Event Planner baut dafür keine parallele Jahreslogik auf.

## Open

- PR #138 muss noch als Gesamtstand manuell geprüft und anschließend nach menschlicher Freigabe nach `main` gemergt werden.
- vollständiger aktueller Smoke-Test und formaler Last Known Good stehen noch aus.
- echtes persistentes Aufgabenmodell fehlt noch.
- Helferbedarf und Schichtplanung müssen auf das neue Event-Edit-Muster gebracht werden.
- Bestellungen und eventbezogene Ausgaben fehlen noch.
- Event-Templates müssen noch umgesetzt werden.
- Camp-spezifische persistente Daten und interne/externe Buchungswege fehlen noch.
- vollständige historische Event-Detailakte und Helfer-Jahresintegration bleiben spätere Schritte.

## Excluded / Already Tried

- keine dauerhaften Fachdaten nur in Sessions, Query-Parametern oder JavaScript-Zustand.
- keine zweite manuell gepflegte Fortschrittslogik neben den Fachdaten.
- keine separate Event-Datenwelt für Camps.
- keine zweite personenbezogene Jahres-/Rabattlogik parallel zu `member-engagement`.
- keine Rückkehr von `Aufbau` oder `Abbau` in das Programmpunkt-Dropdown.
- kein Edit-/Speichern-Mini-Workflow pro Tageszeile, solange direkte Bearbeitung plus zentrale Speicheraktion ausreicht.
- keine erneute grundlegende Neugestaltung der akzeptierten Programm-/Ablaufkachel ohne neuen belastbaren Bedarf.

## Relevant Decisions & Standards

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENTS-OVERVIEW.md`
- `EVENT-FORM-UI.md`
- `EVENT-EDIT-UI.md`
- `EVENT-DAY-PLANNING.md`
- `STATUS-COLOR-STANDARD.md`
- `DATA-PERSISTENCE.md`
- `URL-INPUT-STANDARD.md`
- `SMOKE-TEST.md`
- `../member-engagement/FUNCTIONAL-SCOPE.md`
- `../../design/backend-ui-component-standard.md`
- `../../design/backend-form-standard.md`
- `../../design/ui-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../roles/wordpress-developer/development-standard.md`

## Active Development

Branch:

`event-planner/day-sort-program-count`

Pull Request:

`#138`

Der Branch enthält den aktuell akzeptierten Programm-/Ablaufstand mit Plugin-Version `3.8.17`.

## Next Meaningful Step

1. aktuellen Stand von PR #138 im Playground als Gesamtfluss prüfen,
2. insbesondere Event anlegen → Event bearbeiten → Aufbau/Abbau → Programmpunkte → Speichern → Reload testen,
3. bei erfolgreicher Prüfung PR #138 nach ausdrücklicher menschlicher Freigabe nach `main` mergen,
4. danach den nächsten Bereich im Event-Modul angehen, vorzugsweise echte Event-Aufgaben als persistentes Modell,
5. formalen aktuellen Smoke-Test und Last Known Good anschließend nachziehen.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein akzeptierter Referenzstand wird festgelegt,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.
