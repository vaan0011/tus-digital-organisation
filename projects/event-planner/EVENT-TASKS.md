# Event Planner – Aufgaben und Organisation

## Purpose

Dieses Dokument beschreibt das verbindliche V1-Modell für echte Organisationsaufgaben eines Events.

Der Aufgabenbereich ersetzt wiederkehrende Zettel-, Messenger- und Einzellisten für organisatorische Tätigkeiten wie Bestellungen, Genehmigungen, Material oder Vorbereitung.

## Core Principle

**Eine echte Aufgabe ist ein persistenter Event-Datensatz und kein flüchtiger Hinweis.**

Systemhinweise wie `Programm fehlt` oder `Helferplätze offen` werden weiterhin aus vorhandenen Fachdaten abgeleitet und nicht als künstliche Aufgaben dupliziert.

## Main Content

### 1. Minimales Aufgabenmodell V1

Eine Aufgabe besitzt:

- eindeutigen Event-Bezug,
- Titel,
- optionale Kategorie,
- optionales Fälligkeitsdatum,
- optionale Verantwortlichkeit,
- Status `open` oder `done`,
- Herkunft `manual` oder `template`,
- Sortierreihenfolge,
- Erstellungs- und Änderungszeitpunkt.

Die Daten werden dauerhaft in `vtp_event_tasks` gespeichert.

### 2. Typische Aufgaben

Beispiele:

- Catering bestellen,
- Foodtruck anfragen,
- Ausschankgenehmigung beantragen,
- Pilswagen bestellen,
- Kassen / Wechselgeld vorbereiten,
- Material organisieren,
- Lieferungen abstimmen,
- Ansprechpartner bestätigen,
- Beschilderung vorbereiten.

Die Liste ist nicht fest codiert.

### 3. UI im Event bearbeiten

Unterhalb von `Programmpunkte und Ablaufplanung` folgt der ein-/ausklappbare Block:

`Aufgaben und Organisation`

Der Block verwendet die zentralen Backend-UI-Muster.

Verbindlich:

- `+ Aufgabe hinzufügen`,
- direkte Bearbeitung der Felder ohne zusätzlichen Edit-Modus,
- Checkbox `Erledigt`,
- Titel,
- Kategorie optional,
- Fälligkeit optional,
- Verantwortlich optional,
- eindeutige Löschen-Aktion,
- zentraler Button `Aufgaben speichern`,
- keine Speichern-Aktion pro Zeile.

### 4. Statuskachel

Die Fortschrittskachel `Aufgaben` zeigt echte persistente Aufgabenstände.

Regeln:

- keine Aufgaben: `0` / `noch nicht geplant` / neutral,
- Aufgaben vorhanden, noch keine erledigt: `0 / Gesamt` / `geplant` / aktiv,
- teilweise erledigt: `Erledigt / Gesamt` / `X offen` / Warnzustand,
- alle erledigt: `Gesamt / Gesamt` / `erledigt` / grün.

Rot bleibt echten kritischen Zuständen vorbehalten. Überfälligkeitsregeln werden erst ergänzt, wenn die fachliche Eskalationslogik festgelegt ist.

### 5. Sortierung

Persistierte Aufgaben werden zunächst so angezeigt:

1. offene Aufgaben,
2. offene Aufgaben mit Fälligkeit chronologisch,
3. offene Aufgaben ohne Fälligkeit,
4. erledigte Aufgaben.

Die Sortierung soll Orientierung geben, ohne ein komplexes Projektmanagementsystem nachzubauen.

### 6. Systemhinweise

Automatische Hinweise bleiben getrennt von echten Aufgaben.

Beispiele:

- Programm fehlt,
- Helferbedarf ohne Schichten,
- offene Helferplätze,
- vergangenes Event noch nicht archiviert.

Sie können im Dashboard gemeinsam mit echten offenen Aufgaben erscheinen, werden aber nicht als dauerhafte manuelle Aufgabe gespeichert.

### 7. Templates und Historie

Später können Aufgaben aus Event-Templates oder bewährten Vorjahresveranstaltungen übernommen werden.

Erledigte Aufgaben bleiben Bestandteil der Eventhistorie und dürfen deshalb nicht beim Erledigen gelöscht werden.

## Relationship

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENT-EDIT-UI.md`
- `DATA-PERSISTENCE.md`
- `STATUS-COLOR-STANDARD.md`
- `../../design/backend-ui-component-standard.md`

## Future Development

Bewusst noch nicht Bestandteil von V1:

- Prioritätsstufen,
- Unteraufgaben,
- Kommentare,
- Anhänge,
- komplexe Workflows,
- automatische Eskalationen,
- feste Kategorien,
- tiefe Personen-/Team-Verknüpfungen.

Diese Funktionen werden nur ergänzt, wenn der reale TuS-Arbeitsablauf sie benötigt.
