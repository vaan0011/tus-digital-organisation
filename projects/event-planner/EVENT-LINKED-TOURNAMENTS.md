# Event Planner – Verknüpfte Turniere

## Purpose

Die Event-Zentrale zeigt die mit einem Event verbundenen Turniere und bietet einen direkten Einstieg in den Turnierplan zur Pflege der Zuordnung.

## Core Principle

**Die Event-Zentrale zeigt die Verknüpfung, der Turnierplan pflegt sie.**

Es wird keine zweite Verknüpfungslogik im Event aufgebaut. Source of Truth bleibt die bestehende Turnierzuordnung über `event_id` bzw. die Legacy-Kompatibilität über `parent_event`.

## Main Content

### Event-Zentrale

Die Karte `Verknüpfte Turniere` enthält immer die Aktion `Turnierplan öffnen`.

Die Aktion führt in die Übersicht der aktiven Turniere. Dort kann ein Turnier geöffnet und im bestehenden Bereich `Event-Zuordnung` über `Teil eines Events` einem Event zugewiesen werden.

### Verknüpfte Turniere

Bereits zugeordnete, nicht archivierte Turniere werden chronologisch angezeigt.

Jede kompakte Zeile zeigt:

- Turniername,
- Turnierart,
- Datum,
- Uhrzeit,
- direkte Aktion `Öffnen` zum jeweiligen Turnier.

Die Darstellung folgt dem zentralen Backend-UI-Komponentenstandard:

- dezente Border,
- kompakter Innenabstand,
- klare Typografie,
- sekundärer Outline-Button,
- responsive Einspalten-Darstellung auf kleinen Viewports.

### Leerzustand

Wenn noch kein Turnier verknüpft ist, wird erklärt, dass die Zuordnung im Turnier unter `Event-Zuordnung` erfolgt. `Turnierplan öffnen` bleibt sichtbar.

## Relationship

- `EVENT-EDIT-UI.md`
- `EVENTS-OVERVIEW.md`
- `../design/backend-ui-component-standard.md`

## Future Development

Wenn der Turnierbereich später selbst auf die neue Event-Planner-UI umgestellt wird, kann der Einstieg aus dem Event optional einen Event-Kontext übergeben, um die Zuordnung dort noch schneller vorzubelegen. Die fachliche Source of Truth bleibt dabei die Turnierzuordnung.
