# Event Planner – Event bearbeiten

## Purpose

Dieses Dokument beschreibt die verbindliche UI- und Fortschrittslogik des Screens `Event bearbeiten`.

Der Bearbeitungsscreen soll nicht alle Funktionen gleichzeitig offen darstellen, sondern die Veranstaltung als kompakte Arbeitszentrale strukturieren. Der Nutzer soll zuerst den Gesamtzustand erkennen und anschließend gezielt in den benötigten Bereich einsteigen.

## Core Principle

**Zuerst Status, dann Überblick, dann Bearbeitung.**

Bestehende persistente Event-, Programm-, Schicht- und Helferdaten bleiben Source of Truth. Die Oberfläche ordnet diese Informationen neu und erzeugt keinen zweiten manuellen Fortschrittsstatus.

Für Create und Edit gilt außerdem der zentrale Backend-Formstandard:

`../../design/backend-form-standard.md`

Anlegen und Bearbeiten eines Events verwenden dieselbe Form-Sprache. Feldanzahl und Feldnamen dürfen variieren; Karten, Feldgruppen, Buttons, Abstände, Typografie und Interaktionsmuster bleiben konsistent.

## Main Content

### 1. Kopfbereich

Der Screen beginnt mit:

- Titel `Events: TuS Veranstaltungen bearbeiten`,
- kurzer Beschreibung,
- Navigation zu `neues Event`, `aktive Events`, `Vorlagen` und `Archiv`.

### 2. Fortschritt der Eventplanung

Die Fortschrittsleiste steht **oberhalb** der Event-Zentrale.

Sie ist ein übergeordnetes Element und zeigt auf einen Blick, welche Planungsbereiche für das Event bereits angelegt bzw. erledigt sind.

Die fünf Statuskacheln bilden die Planung von links nach rechts ab und werden aus realen Fachdaten berechnet.

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

Das persistente Event-Aufgabenmodell existiert noch nicht. Bis zu dessen Einführung zeigt die Kachel transparent `0 Aufgaben` und `noch nicht geplant`.

#### Stufe 4 – Schichten

Kennzahl:

- `voll belegte Schichten / Schichten gesamt`.

Eine Schicht gilt als voll belegt, wenn mindestens so viele Anmeldungen wie benötigte Plätze vorhanden sind.

#### Stufe 5 – Helfer

Kennzahl:

- `belegte Helferplätze / benötigte Helferplätze`.

Personenbezogene Jahresstunden und Mitgliederrabatte bleiben Aufgabe des Mitglieder-&-Engagement-Moduls.

### 3. Event-Zentrale

Unterhalb der Fortschrittsleiste stehen drei kompakte Bereiche.

#### Veranstaltungsdaten

Zeigt mindestens:

- Veranstaltungsname,
- Datum bzw. Datumsbereich,
- Veranstaltungsort.

Ein Edit-Stift öffnet direkt darunter die detaillierte Bearbeitung der Event-Stammdaten.

#### Öffentliche Seite

Bietet den direkten Absprung auf die öffentliche Event-/Programmseite.

#### Verknüpfte Turniere

Zeigt die mit dem Event verbundenen Turniere kompakt an. Wenn keine Turniere verbunden sind, wird ein klarer Leerzustand angezeigt.

### 4. Event-Stammdaten bearbeiten

Die Bearbeitung verwendet dieselbe Form-Sprache wie `Neues Event anlegen`.

Verbindlich sind:

- dieselbe Karten- und Containerlogik,
- dieselbe zweispaltige Desktop-Struktur,
- dieselben Feld- und Label-Stile,
- dieselben Abstände und Buttonmuster,
- dieselbe Checkbox- und URL-Logik,
- dieselbe responsive Einspalten-Darstellung auf kleinen Displays,
- dieselbe zeilenweise Sponsorenpflege.

Die Event-Stammdaten werden links und rechts fachlich gruppiert:

**linke Spalte**

- Veranstaltungsname,
- Startdatum,
- Enddatum,
- Veranstaltungsort.

**rechte Spalte**

- Veranstaltungsbeschreibung,
- zusätzlicher Link zur Veranstaltung,
- Sichtbarkeit im öffentlichen Veranstaltungskalender.

Die Sponsorenübersicht verwendet dieselben strukturierten Sponsorzeilen wie bei der Event-Anlage:

- Name,
- Logo,
- Link zur Homepage,
- eindeutige Entfernen-Aktion,
- `Neuen Sponsor hinzufügen`.

Create und Edit arbeiten auf derselben persistenten Datenbasis.

### 5. Programmpunkte und Ablaufplanung

Die gesamte Arbeitssektion `Programmpunkte und Ablaufplanung` ist ein- und ausklappbar. Die Überschrift und das Auf-/Zuklapp-Icon bleiben immer sichtbar; Beschreibung, Aktionen, Tagescontainer und Speicherbutton werden beim Einklappen ausgeblendet.

Der Bereich startet standardmäßig geöffnet. Das Ein- und Ausklappen ist reiner UI-Zustand und verändert keine fachlichen Daten und keine Persistenz.

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

### 6. Farben und Status

Verbindliche Quelle für die Statussemantik:

`STATUS-COLOR-STANDARD.md`

Die Fortschrittskacheln verwenden folgende fachliche Zustände:

- Grau = noch nicht begonnen / noch nicht geplant,
- Blau = geplant / in Bearbeitung,
- Gelb oder Orange = teilweise erledigt / Aufmerksamkeit nötig,
- Grün = vollständig erfüllt,
- Rot = echter kritischer Zustand.

Rot ist ausdrücklich **kein normaler Offen-Zustand**.

Farbe wird nie allein verwendet. Jede Kachel zeigt zusätzlich einen verständlichen Status-Text.

Canva-Mockups definieren Struktur und Informationshierarchie, nicht die Farbpalette.

### 7. Persistenz

Diese UI führt keine Session-basierte oder nur clientseitige Fachdatenhaltung ein.

Alle dauerhaft relevanten Daten werden weiterhin über die bestehenden persistenten Datenquellen gespeichert. Die UI-Schicht darf lediglich Darstellung, Auf-/Zuklappen und Bearbeitungsmodus lokal steuern.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENTS-OVERVIEW.md`
- `EVENT-FORM-UI.md`
- `STATUS-COLOR-STANDARD.md`
- `DATA-PERSISTENCE.md`
- `URL-INPUT-STANDARD.md`
- `PROJECT-STATE.md`
- `../../design/backend-form-standard.md`

## Future Development

Sobald das persistente Aufgabenmodul existiert, wird die dritte Fortschrittskachel an die echten Aufgabenstände angebunden.

Zeitabhängige rote Warnzustände werden erst ergänzt, wenn fachlich belastbare Fristen bzw. Eskalationsregeln existieren.

Weitere Bereiche des Bearbeitungsscreens – insbesondere Helferbedarf, Schichtplanung, Bestellungen, Ausgaben und Archivierung – sollen schrittweise auf dasselbe Muster `Status → Überblick → Containergruppe → gezielte Bearbeitung` umgestellt werden, ohne die bestehende funktionierende Persistenz unnötig umzubauen.
