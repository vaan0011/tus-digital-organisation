# Event Planner – Eventübersicht

## Purpose

Dieses Dokument beschreibt die fachliche Logik der Eventübersicht.

Die Übersicht soll anstehende TuS-Veranstaltungen schnell erfassbar machen und zwischen bereits operativ bearbeiteten und lediglich vorgemerkten Veranstaltungen unterscheiden, ohne einen zusätzlichen manuell gepflegten Status zu erzeugen.

## Core Principle

**Der Planungszustand wird aus echten Fachdaten abgeleitet und nicht doppelt gepflegt.**

Eine Veranstaltung ist `geplant`, solange nur ihre Stammdaten existieren.

Eine Veranstaltung gilt als `aktiv`, sobald mindestens ein operativer Planungsbaustein vorhanden ist:

- Programmpunkt / Event-Ablauf,
- Helferbedarf,
- Helferschicht,
- verknüpftes nicht archiviertes Turnier.

Spätere operative Bausteine wie echte Event-Aufgaben, Bestellungen oder Ausgaben können diese Ableitung ergänzen, sobald sie persistent modelliert sind.

## Main Content

### Navigation

Die Eventübersicht benötigt keinen Button, der auf dieselbe Ansicht zurückführt.

Die obere Navigation enthält deshalb:

- `neues Event`
- `Veranstaltungskalender`
- `Vorlagen`
- `Archiv`

`Veranstaltungskalender` öffnet die bereits vorhandene öffentliche TuS-Veranstaltungsübersicht über `VTP_Public::calendar_url()`. Dadurch wird dieselbe öffentliche Quelle verwendet, die auch für den Shortcode `[verein_veranstaltungskalender]` vorgesehen ist.

### Aktive Veranstaltungen

Links erscheinen anstehende bzw. laufende, nicht archivierte Veranstaltungen, für die bereits operative Planung existiert.

Eine Karte zeigt mindestens:

- Veranstaltungsname,
- Datum bzw. Datumsbereich,
- Veranstaltungsort,
- `Öffnen`.

`Programm` wird nur angezeigt, wenn bereits mindestens ein Programmpunkt vorhanden ist.

### Geplante Veranstaltungen

Rechts erscheinen anstehende, nicht archivierte Veranstaltungen, die bislang nur als Veranstaltung angelegt wurden und noch keine operative Planung enthalten.

Ein frisch angelegtes Event ohne Programmpunkte, Helferbedarf, Schichten oder verknüpftes Turnier muss hier unmittelbar sichtbar sein.

Sie können über `Öffnen` bearbeitet und anschließend durch reale Planungsdaten automatisch zu einer aktiven Veranstaltung werden.

### Zeitbezug

Die Ansicht heißt `Übersicht aller anstehenden TuS Veranstaltungen`.

Deshalb werden dargestellt:

- zukünftige Veranstaltungen,
- aktuell laufende mehrtägige Veranstaltungen,
- Veranstaltungen ohne festes Datum.

Für eintägige Veranstaltungen ist ein leeres Enddatum zulässig und wird fachlich wie `Enddatum = Startdatum` behandelt. Ein leeres Enddatum darf deshalb ein zukünftiges Event nicht aus der Übersicht herausfiltern.

Vergangene, nicht archivierte Veranstaltungen gehören nicht in diese anstehende Übersicht; sie werden im Dashboard als Nachbereitungs-/Archivierungsbedarf behandelt.

### Farben

Mockups definieren Struktur und Informationshierarchie, nicht die Farbpalette.

Die Ansicht verwendet die bestehenden Event-Planner-/TuS-UI-Tokens. Statusunterschiede dürfen visuell kenntlich gemacht werden, ohne eine neue projektlokale Farbwelt einzuführen.

## Relationship to other documents

- `DASHBOARD-LOGIC.md`
- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`
- `FUNCTIONAL-SCOPE.md`
- `PROJECT-STATE.md`

## Future Development

Sobald weitere persistente operative Bausteine verfügbar sind, insbesondere Event-Aufgaben, Bestellungen und Ausgaben, wird geprüft, ob sie ebenfalls als Nachweis für eine aktive Planung gelten.

Die Planungsstatus-Ableitung bleibt zentral und darf nicht durch einen zweiten, unabhängig gepflegten Status dupliziert werden.
