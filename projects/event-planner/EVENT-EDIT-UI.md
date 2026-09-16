# Event Planner – Event bearbeiten

## Purpose

Dieses Dokument beschreibt die verbindliche UI- und Fortschrittslogik des Screens `Event bearbeiten`.

Der Bearbeitungsscreen soll nicht alle Funktionen gleichzeitig offen darstellen, sondern die Veranstaltung als kompakte Arbeitszentrale strukturieren. Der Nutzer soll zuerst den Gesamtzustand erkennen und anschließend gezielt in den benötigten Bereich einsteigen.

## Core Principle

**Zuerst Überblick, dann Bearbeitung.**

Bestehende persistente Event-, Programm-, Schicht- und Helferdaten bleiben Source of Truth. Die neue Oberfläche ordnet diese Informationen neu und erzeugt keinen zweiten manuellen Fortschrittsstatus.

## Main Content

### 1. Kopfbereich

Der Screen beginnt mit:

- Titel `Events: TuS Veranstaltungen bearbeiten`,
- kurzer Beschreibung,
- Navigation zu `neues Event`, `aktive Events`, `Vorlagen` und `Archiv`.

### 2. Event-Zentrale

Direkt unter der Navigation stehen drei kompakte Bereiche:

#### Veranstaltungsdaten

Zeigt mindestens:

- Veranstaltungsname,
- Datum bzw. Datumsbereich,
- Veranstaltungsort.

Ein Edit-Stift öffnet die detaillierte Bearbeitung der Event-Stammdaten.

#### Öffentliche Seite

Bietet den direkten Absprung auf die öffentliche Event-/Programmseite.

#### Verknüpfte Turniere

Zeigt die mit dem Event verbundenen Turniere kompakt an. Wenn keine Turniere verbunden sind, wird ein klarer Leerzustand angezeigt.

### 3. Fortschritt der Eventplanung

Die fünf Statuskacheln bilden die Planung von links nach rechts ab.

Sie werden aus realen Fachdaten berechnet und nicht separat gepflegt.

#### Stufe 1 – Event erstellt

Kennzahl:

- Anzahl der Event-Tage.

Status:

- `Event erstellt`, sobald das Event existiert.

#### Stufe 2 – Programm veröffentlicht

Kennzahl:

- Anzahl der Programmpunkte.

Status ist erfüllt, wenn mindestens ein öffentlicher Programmpunkt vorhanden ist und die öffentliche Eventseite existiert.

#### Stufe 3 – Aufgaben

Zielkennzahl:

- `erledigte Aufgaben / Aufgaben gesamt`.

Das persistente Event-Aufgabenmodell existiert noch nicht. Bis zu dessen Einführung zeigt die Kachel transparent `0 Aufgaben` und `noch nicht geplant`. Es werden keine erfundenen oder flüchtigen Aufgabenstände erzeugt.

#### Stufe 4 – Schichten

Kennzahl:

- `voll belegte Schichten / Schichten gesamt`.

Eine Schicht gilt als voll belegt, wenn mindestens so viele Anmeldungen wie benötigte Plätze vorhanden sind.

#### Stufe 5 – Helfer

Kennzahl:

- `belegte Helferplätze / benötigte Helferplätze`.

Die Kennzahl beschreibt die Besetzung der Helferplätze im Event. Personenbezogene Jahresstunden und Mitgliederrabatte bleiben Aufgabe des Mitglieder-&-Engagement-Moduls.

### 4. Programmpunkte und Ablaufplanung

Die Event-Tage werden als Containergruppen dargestellt.

Jeder Tag zeigt zunächst kompakt:

- `Tag X – Wochentag, Datum`,
- Datum,
- Aktionen als Icons.

Reihenfolge der Aktionen:

1. Aufklappen / Einklappen,
2. Bearbeiten,
3. Speichern,
4. Löschen.

Der Edit-Stift aktiviert die Datumsbearbeitung des Tages.

Die Diskette speichert den aktuellen Programmstand über die vorhandene persistente `vtp_save_event_items`-Logik.

Das Aufklapp-Icon öffnet den Container und zeigt die Programmpunkte des Tages. Innerhalb des geöffneten Tages kann ein weiterer Programmpunkt hinzugefügt werden.

`Neuen Tag hinzufügen` steht oberhalb der Tagescontainer.

Die vorhandene Datums-Picker-Logik bleibt verbindlich: neue Event-Tage orientieren sich am bestehenden Event-/Vortagsdatum und dürfen nicht unnötig im heutigen Monat starten.

### 5. Farben und Status

Canva-Mockups definieren Struktur und Informationshierarchie, nicht die Farbpalette.

Die Oberfläche verwendet die bestehenden Event-Planner-/TuS-UI-Tokens. Für Statuszustände dürfen die bereits im Plugin vorhandenen Erfolgs-/Offen-Farben verwendet werden.

### 6. Persistenz

Diese UI führt keine Session-basierte oder nur clientseitige Fachdatenhaltung ein.

Alle dauerhaft relevanten Daten werden weiterhin über die bestehenden persistenten Datenquellen gespeichert. Die UI-Schicht darf lediglich Darstellung, Auf-/Zuklappen und Bearbeitungsmodus lokal steuern.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENTS-OVERVIEW.md`
- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`
- `URL-INPUT-STANDARD.md`
- `PROJECT-STATE.md`

## Future Development

Sobald das persistente Aufgabenmodul existiert, wird die dritte Fortschrittskachel an die echten Aufgabenstände angebunden.

Weitere Bereiche des Bearbeitungsscreens – insbesondere Helferbedarf, Schichtplanung, Bestellungen, Ausgaben und Archivierung – sollen schrittweise auf dasselbe Muster `Überblick → Containergruppe → gezielte Bearbeitung` umgestellt werden, ohne die bestehende funktionierende Persistenz unnötig umzubauen.
