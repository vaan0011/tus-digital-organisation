# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie verhindert, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, verifizierte Erkenntnisse, ausgeschlossene Wege oder den letzten belastbaren Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Der aktuelle Schwerpunkt ist der Event-Bearbeitungsworkflow mit den aufeinander aufbauenden Arbeitsblöcken:

1. `Programmpunkte und Ablaufplanung`,
2. `Aufgaben und Organisation`,
3. `Helferschichten`.

Der Ablaufplan ist als akzeptierter Referenzstand bestätigt. Aufgaben V1 sind persistent integriert. Helferschichten V1 verwenden bewusst die bestehende Datenbasis `vtp_shifts` und `vtp_shift_signups`; es wird keine zweite Schichtverwaltung aufgebaut.

Der Schichtgenerator verwendet vorhandene Programmzeiten als sinnvollen Default-Zeitraum. Aufbau und Abbau bleiben eigene organisatorische Tagesrollen, können aber explizit als Helferschicht übernommen werden.

Verbindliche Quellen für diesen Stand:

- `EVENT-EDIT-UI.md`
- `EVENT-DAY-PLANNING.md`
- `EVENT-TASKS.md`
- `EVENT-SHIFTS.md`
- `STATUS-COLOR-STANDARD.md`
- zentral: `design/backend-ui-component-standard.md`

## Current Repository State

Projektpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktueller Entwicklungsstand auf Branch `event-planner/event-shifts-v1`:

- Plugin-Version `3.8.23`,
- PR #145 offen,
- Schichtgenerator nutzt Programmzeiten als Default,
- Schichten über Mitternacht werden unterstützt,
- Aufbau/Abbau können mit Datum und Startzeit aus dem Ablaufplan in die Helferschichten übernommen werden.

## Accepted Reference State – Ablaufplanung

Die Kachel `Programmpunkte und Ablaufplanung` gilt als akzeptierter Referenzstand.

Verbindliches Verhalten:

- Eventtage werden aus dem Event-Datumsbereich initialisiert,
- Eventtage werden chronologisch sortiert und neu nummeriert,
- Aufbau und Abbau sind eigene Tagesrollen,
- Aufbau/Abbau haben Datum + Uhrzeit, aber keine Programmpunkte,
- Programmpunkte gehören nur zu regulären Eventtagen,
- Programmpunkt-Anzahl ist je Eventtag sichtbar,
- Datums-/Zeitfelder werden direkt bearbeitet,
- kein Mini-Edit-/Speichern-Modus pro Zeile,
- zentraler Save für den Ablaufplan,
- Programmkachel und Eventtage sind ein-/ausklappbar.

Dieser Stand soll nicht ohne neuen fachlichen Grund grundsätzlich umgebaut werden.

## Aufgaben V1

- persistente Tabelle `vtp_event_tasks`,
- Block `Aufgaben und Organisation`,
- direkte Bearbeitung,
- Felder: Erledigt, Aufgabe, Kategorie optional, Fälligkeit optional, Verantwortlich optional,
- zentraler Save,
- Statuskachel `Aufgaben` basiert auf echten Daten,
- Systemhinweise bleiben getrennt von echten Aufgaben.

## Helferschichten V1

- konkrete Schichten bleiben in `vtp_shifts`,
- Helferanmeldungen bleiben in `vtp_shift_signups`,
- einzelne Schichten und Schichtserien werden im Event bearbeitet,
- Statuskacheln `Schichten` und `Helfer` werden aus realen Schicht-/Anmeldedaten abgeleitet,
- Programmzeiten dienen beim Generator als Vorschlag für `Von`/`Bis`,
- eine kleinere Endzeit als Startzeit bedeutet Folgetag,
- Aufbau/Abbau bleiben keine Programmpunkte,
- gepflegte Aufbau-/Abbau-Daten können explizit als Schichtkandidat übernommen werden,
- bei der Übernahme werden Bereich, Datum und Startzeit übernommen; Endzeit und Helferzahl bleiben bewusst zu ergänzen,
- bereits übernommene Kandidaten werden anhand Bereich + Datum + Startzeit nicht erneut angeboten,
- nach der Übernahme bleibt die Helferschicht ein eigenständiger Datensatz; spätere Ablaufplanänderungen ändern sie nicht still im Hintergrund.

## Last Known Good

Noch nicht formal dokumentiert.

Die aktuellen UI- und Funktionsstände werden iterativ im WordPress Playground manuell verifiziert. Ein formaler Last Known Good wird erst nach vollständigem dokumentiertem Smoke-Test für einen exakt referenzierten Commit gesetzt.

## Development Rules

- GitHub ist Source of Truth.
- Änderungen erfolgen über Branch + Pull Request.
- Kein Merge nach `main` ohne menschliche Freigabe.
- Chat = Workspace, Repository = Memory.
- Bestehende akzeptierte Referenzstände werden nicht ohne neue Erkenntnis wieder geöffnet.
- Persistente fachliche Daten gehören in die Datenbank, nicht in Session-/Browserzustände.
- Neue Backend-UI folgt dem zentralen Backend-UI-Komponentenstandard.
