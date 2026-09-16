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

Die obere Navigation der Eventübersicht enthält:

- `neues Event`
- `Veranstaltungskalender`
- `Vorlagen`
- `Archiv`

Ein zusätzlicher Selbstlink auf die bereits geöffnete Eventübersicht ist nicht vorgesehen.

`Veranstaltungskalender` verwendet die zentrale öffentliche Kalender-URL des Plugins (`VTP_Public::calendar_url()`) und öffnet die öffentliche TuS-Veranstaltungsübersicht in einem neuen Tab.

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

Ein neu angelegtes zukünftiges Event muss unmittelbar nach dem Speichern hier erscheinen, solange noch kein operativer Planungsbaustein vorhanden ist.

Sie können über `Öffnen` bearbeitet und anschließend durch reale Planungsdaten automatisch zu einer aktiven Veranstaltung werden.

### Zeitbezug

Die Ansicht heißt `Übersicht aller anstehenden TuS Veranstaltungen`.

Deshalb werden dargestellt:

- zukünftige Veranstaltungen,
- aktuell laufende mehrtägige Veranstaltungen,
- Veranstaltungen ohne festes Datum.

Ein leeres Enddatum bedeutet bei eintägigen Veranstaltungen fachlich `Enddatum = Startdatum` und darf ein Event nicht aus der Übersicht herausfiltern.

Vergangene, nicht archivierte Veranstaltungen gehören nicht in diese anstehende Übersicht; sie werden im Dashboard als Nachbereitungs-/Archivierungsbedarf behandelt.

### Robuste Lade-Logik

Die Event-Grunddaten werden zuerst separat aus der persistenten Event-Tabelle geladen.

Operative Zähler wie Programmpunkte, Helferbedarf, Schichten und verknüpfte Turniere werden anschließend je Event ergänzt.

Damit kann ein Fehler oder eine Abweichung in einer Nebenabfrage niemals dazu führen, dass das eigentliche Event vollständig aus der Eventübersicht verschwindet.

Diese Trennung folgt dem Prinzip: **Event-Sichtbarkeit zuerst aus Event-Stammdaten, Planungsstatus anschließend aus operativen Fachdaten ableiten.**

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
