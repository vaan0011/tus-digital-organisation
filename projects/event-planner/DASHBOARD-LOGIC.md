# Event Planner – Dashboard Logic V1

## Purpose

Dieses Dokument definiert die fachliche Logik des Event-Planner-Dashboards und der Eventhistorie.

Es beschreibt bewusst zuerst **welche Informationen angezeigt werden und wie sie berechnet werden**. Das visuelle Layout orientiert sich an den abgestimmten Mockups, übernimmt aber ausschließlich die bestehenden TuS-/Event-Planner-UI-Standards und nicht die Mockup-Farben.

## Core Principle

**Das Dashboard zeigt den aktuellen Arbeitsstand des Event Planners. Die Historie zeigt abgeschlossene und archivierte Planung.**

Dashboard-Zahlen und offene Aufgaben werden aus den echten Event-, Turnier- und Helferdaten abgeleitet. Es gibt keine separat manuell gepflegten Dashboard-Zähler oder Dashboard-Aufgaben.

Ein Objekt verschwindet nicht automatisch nur deshalb aus dem Dashboard, weil sein Datum in der Vergangenheit liegt. Solange es nicht bewusst archiviert wurde, bleibt es Teil des aktuellen Arbeitsstandes und kann als offene Aufgabe zur Nachbereitung/Archivierung erscheinen.

## Main Content

### 1. Hauptdashboard

Titel:

`TuS Eventplaner`

Untertitel:

`Zentrale Übersicht für Events, Turniere, Fußballcamps und Helferschichten`

Das Hauptdashboard enthält vier Schnellaktionen, vier Kennzahlen sowie die Bereiche `Übersicht` und `Offene Aufgaben`.

### 2. Schnellaktionen

Die vier primären Aktionen sind:

- `neues Event`
- `neues Turnier`
- `neues Camp`
- `Schichten öffnen`

Logik:

#### Neues Event

Öffnet das bestehende Event-Anlageformular mit der Event-Art `event`.

#### Neues Turnier

Öffnet die bestehende Turnieranlage.

#### Neues Camp

Öffnet grundsätzlich dasselbe Event-Grundmodell wie `neues Event`, setzt aber die Event-Art `camp`.

Ein Fußballcamp wird **nicht** als eigene isolierte Datenwelt aufgebaut. Camp-spezifische Funktionen können später am gemeinsamen Event-Grundmodell ergänzt werden.

#### Schichten öffnen

Öffnet die zentrale Helferschicht-Ansicht.

### 3. Event-Arten

Die bestehende Event-Tabelle benötigt für die Dashboard- und Camp-Logik eine einfache fachliche Klassifikation.

Vorgesehene Grundwerte:

- `event`
- `camp`

Bestehende Events werden bei Einführung der Klassifikation ohne Datenverlust als `event` behandelt.

Turniere bleiben aufgrund ihrer eigenen Team-, Spielplan- und Ergebnislogik eine separate fachliche Einheit und können weiterhin mit einem Event verknüpft sein.

### 4. Kennzahl `Events`

Die Kennzahl `Events` zählt alle **nicht archivierten** Datensätze der Event-Art `event`.

Sie wird nicht zusätzlich nach Datum gefiltert.

Dadurch bleiben vergangene, aber noch nicht abgeschlossene/archivierte Veranstaltungen sichtbar und gehen nicht still aus dem Arbeitsstand verloren.

### 5. Kennzahl `Turniere`

Die Kennzahl `Turniere` zählt alle Turniere mit Status ungleich `archiviert`.

Ein Turnier kann eigenständig oder mit einem Event verknüpft sein.

Die KPI zählt das Turnier unabhängig von dieser Verknüpfung genau einmal.

### 6. Kennzahl `Camps`

Die Kennzahl `Camps` zählt alle **nicht archivierten** Datensätze der Event-Art `camp`.

Ein Camp ist damit fachlich ein spezialisierter Event-Typ und keine zweite Eventverwaltung.

### 7. Kennzahl `Schichten`

Die Kennzahl `Schichten` zählt alle Helferschichten, deren zugehöriges Event **nicht archiviert** ist.

Sie zählt nicht nur freie oder belegte Schichten, sondern die gesamte aktuell zu verwaltende Schichtmenge.

Offene Helferplätze werden stattdessen im Bereich `Offene Aufgaben` sichtbar gemacht.

### 8. Bereich `Übersicht`

Die Übersicht soll nicht erneut jede Detailtabelle aus den Untermodulen anzeigen.

Sie ist eine kompakte Arbeitsübersicht über die nächsten bzw. noch relevanten Planungseinheiten.

Grundlogik:

- nicht archivierte Events,
- nicht archivierte Camps,
- nicht archivierte Turniere,
- chronologische Sortierung nach fachlich relevantem Datum,
- vergangene, noch nicht archivierte Objekte bleiben sichtbar und werden als überfällig/nachzubereiten markiert,
- verknüpfte Turniere können innerhalb des zugehörigen Events dargestellt werden, damit die Übersicht nicht unnötig doppelt wirkt.

Pro Eintrag sollen nur die Informationen erscheinen, die für die Orientierung nötig sind:

- Typ,
- Name,
- Datum bzw. Zeitraum,
- Ort, sofern vorhanden,
- kompakter Planungs-/Statushinweis,
- direkter Einstieg in die Bearbeitung.

Die Übersicht ist Navigation und Arbeitsorientierung, kein Ersatz für die Detailmodule.

### 9. Bereich `Offene Aufgaben`

`Offene Aufgaben` ist **kein manuell gepflegter To-do-Manager**.

Die Einträge werden automatisch aus dem tatsächlichen Planungszustand erzeugt.

V1 soll nur belastbare und direkt handlungsrelevante Regeln enthalten.

#### Event / Camp

Mögliche offene Aufgaben:

- Veranstaltung liegt in der Vergangenheit, ist aber noch nicht archiviert → `Event abschließen / archivieren`.
- noch keine Programmpunkte vorhanden → `Programm fehlt`.
- Helferbedarf ist definiert, aber noch keine Schichten wurden erzeugt → `Helferschichten erzeugen`.
- vorhandene Schichten besitzen noch freie Plätze → `X Helferplätze offen`.

Camp-spezifische Prüfungen werden erst ergänzt, wenn die dazugehörigen Camp-Funktionen tatsächlich existieren.

#### Turnier

Mögliche offene Aufgaben:

- keine Teams vorhanden → `Teams fehlen`.
- Teams vorhanden, aber noch kein Spielplan → `Spielplan fehlt`.
- weitere Turnieraufgaben werden nur ergänzt, wenn sie fachlich eindeutig und aus vorhandenen Daten zuverlässig ableitbar sind.

#### Priorisierung

Offene Aufgaben werden grundsätzlich nach Dringlichkeit sortiert:

1. vergangene/überfällige Sachverhalte,
2. zeitnah bevorstehende Veranstaltungen mit fehlender Planung,
3. sonstige offene Planungspunkte.

Jede Aufgabe verlinkt möglichst direkt zur Stelle, an der sie erledigt werden kann.

Wenn keine offenen Aufgaben vorliegen, wird ein positiver Leerzustand angezeigt, statt eine leere Box ohne Erklärung zu zeigen.

### 10. Keine künstliche Prozentlogik ohne Nutzen

Der aktuelle Dashboard-Stand berechnet einen einfachen Fortschrittswert aus wenigen vorhandenen Merkmalen.

Für Dashboard V1 wird kein Prozentwert nur um seiner selbst willen benötigt.

Falls später ein Fortschrittsstatus verwendet wird, muss klar definiert sein, welche fachlichen Schritte dafür zählen. Ein scheinbar präziser Prozentwert ohne belastbare Bedeutung soll vermieden werden.

### 11. Eventhistorie

Die Historie erhält eine eigene Ansicht entsprechend dem abgestimmten Mockup.

Titel:

`TuS Eventhistorie`

Untertitel:

`Archiv für Events, Turniere, Fußballcamps und Helferschichten`

Die Historie arbeitet ausschließlich mit archivierten Daten bzw. Daten, die einem archivierten Event zugeordnet sind.

### 12. Historien-Kennzahlen

#### Events

Anzahl archivierter Events der Art `event`.

#### Turniere

Anzahl archivierter Turniere.

#### Camps

Anzahl archivierter Events der Art `camp`.

#### Schichten

Anzahl der Schichten, deren zugehöriges Event archiviert ist.

Schichten werden dadurch historisch erhalten, ohne einen eigenen künstlichen Archivstatus zu benötigen.

### 13. Historien-Bereich `Übersicht`

Die linke Historien-Übersicht zeigt archivierte Planungseinheiten, standardmäßig mit den neuesten vergangenen Veranstaltungen zuerst.

Sinnvolle spätere Filter:

- Jahr,
- Typ,
- Suche.

Diese Filter werden erst umgesetzt, wenn die Grundansicht stabil funktioniert.

### 14. Historien-Bereich `Details`

Wird ein archiviertes Objekt ausgewählt, zeigt `Details` die dazugehörige verdichtete Historie.

Bei einem Event/Camp perspektivisch unter anderem:

- Stammdaten,
- Zeitraum und Ort,
- Programmpunkte,
- verknüpfte Turniere,
- Helferbedarf,
- Anzahl Schichten,
- Besetzung bzw. später tatsächlich geleistete Helferstunden,
- später Bestellungen und Ausgaben.

Die Historie soll mit wachsendem Event-Modul automatisch wertvoller werden. Sie wird deshalb aus denselben Eventdaten aufgebaut und nicht separat gepflegt.

### 15. Archivierungslogik

`archiviert` ist die bewusste Grenze zwischen aktuellem Dashboard und Historie.

Grundsatz:

- aktive/nicht archivierte Objekte → Dashboard,
- archivierte Objekte → Historie,
- vergangenes Datum allein archiviert nichts automatisch.

Damit bleibt die Verantwortung nachvollziehbar und kein noch nicht nachbearbeitetes Event verschwindet unbemerkt.

### 16. Farben und Darstellung

Die Mockups definieren Aufbau, Hierarchie und Vereinfachungsrichtung.

Sie sind **keine Farbquelle**.

Für die Implementierung gelten weiterhin:

- `../../design/ui-standard.md`,
- die bestehenden Event-Planner-Styles,
- die dort festgelegten UI-Tokens.

Bestehende Farben werden nicht aufgrund der Canva-Mockups ersetzt.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md` definiert das Gesamtziel des Event Planners.
- `PROJECT-STATE.md` hält den aktuellen Entwicklungsstand.
- `SMOKE-TEST.md` definiert die technische Baseline-Prüfung.
- `../../design/ui-standard.md` definiert die verbindliche UI-Grundlage.

## Future Development

Nach Freigabe dieser Logik erfolgt die Umsetzung in kleinen Schritten:

1. Event-Art `event` / `camp` als rückwärtskompatible Klassifikation einführen,
2. Dashboard-Kennzahlen korrekt ableiten,
3. Schnellaktionen verdrahten,
4. kompakte `Übersicht` aufbauen,
5. `Offene Aufgaben` aus belastbaren Regeln ableiten,
6. Eventhistorie auf dieselbe Datenbasis setzen,
7. erst danach zusätzliche Komfortfunktionen oder weitere Aufgabenregeln ergänzen.
