# Event Planner – Dashboard Logic V1

## Purpose

Dieses Dokument definiert die fachliche Logik des Event-Planner-Dashboards sowie die Richtung für Auswertung und Historie.

Es beschreibt bewusst zuerst **welche Informationen angezeigt werden, woher sie stammen und wie sie berechnet werden**. Das visuelle Layout orientiert sich an den abgestimmten Mockups, übernimmt aber ausschließlich die bestehenden TuS-/Event-Planner-UI-Standards und nicht die Mockup-Farben.

## Core Principle

**Das Dashboard ist die operative Startseite für anstehende Veranstaltungen und offene Organisationsarbeit.**

Dashboard-Zahlen, Übersichten und Aufgaben werden aus den echten Event-, Turnier-, Camp- und Helferdaten abgeleitet. Es gibt keine separat gepflegten Dashboard-Zähler.

Offene Aufgaben bestehen aus zwei Quellen:

1. **echten Organisationsaufgaben**, die manuell oder aus Event-Templates entstehen,
2. **Systemhinweisen**, die sich zuverlässig aus dem Planungszustand ableiten lassen.

Ein Objekt verschwindet nicht automatisch nur deshalb aus dem Arbeitsbestand, weil sein Datum in der Vergangenheit liegt. Solange es nicht bewusst abgeschlossen/archiviert wurde, bleibt es nachbearbeitbar und kann als offene Aufgabe erscheinen.

## Main Content

### 1. Hauptdashboard

Titel:

`TuS Eventplaner`

Untertitel:

`Zentrale Übersicht für Events, Turniere, Fußballcamps und Helferschichten`

Das Hauptdashboard enthält:

- vier Schnellaktionen,
- vier Kennzahlen,
- den Bereich `Übersicht`,
- den Bereich `Offene Aufgaben`.

Die Mockup-Farben sind nicht verbindlich. Die spätere Umsetzung verwendet die bestehenden Event-Planner-/TuS-UI-Tokens.

### 2. Schnellaktionen

Die vier primären Aktionen sind:

- `neues Event`
- `neues Turnier`
- `neues Camp`
- `Schichten öffnen`

#### Neues Event

Öffnet das bestehende Event-Anlageformular mit der Event-Art `event`.

#### Neues Turnier

Öffnet die bestehende Turnieranlage.

#### Neues Camp

Öffnet das gemeinsame Event-Grundmodell mit der Event-Art `camp`.

Ein Fußballcamp ist fachlich ein spezialisiertes Event und **keine eigene isolierte Datenwelt**.

#### Schichten öffnen

Öffnet die zentrale Helferschicht-Ansicht.

### 3. Event-Arten

Die bestehende Event-Tabelle benötigt für Dashboard und Camps eine einfache fachliche Klassifikation.

Vorgesehene Grundwerte:

- `event`
- `camp`

Bestehende Events werden bei Einführung dieser Klassifikation ohne Datenverlust als `event` behandelt.

Turniere bleiben wegen ihrer eigenen Team-, Spielplan- und Ergebnislogik eine separate fachliche Einheit und können weiterhin mit einem Event verknüpft sein.

### 4. Fußballcamps

Fußballcamps nutzen das Event-Grundmodell und damit insbesondere:

- Stammdaten,
- Zeitraum,
- Veranstaltungs-/Trainingsort,
- Ablauf und Programmpunkte,
- Helferschichten, falls benötigt,
- Aufgaben und organisatorische Checklisten,
- spätere Historie.

Zusätzlich benötigt ein Camp camp-spezifische Informationen, insbesondere:

- Ausrichter / Anbieter,
- öffentliche Camp-Beschreibung,
- Teilnehmerzahl bzw. Teilnehmerlimit, sofern relevant,
- Preis-/Teilnahmeinformationen,
- Trainingsort,
- Buchungsart,
- Buchungslink bzw. Anmeldeweg.

Für die Buchungsart sind mindestens folgende Fälle vorgesehen:

- `intern`: Anmeldung/Buchung über eine vom TuS bereitgestellte Camp-Seite,
- `extern`: Buchung erfolgt beim externen Ausrichter; der TuS veröffentlicht lediglich Informationen und den externen Buchungslink,
- `keine Buchung`: reine Informationsseite, falls für einen Sonderfall keine Anmeldung benötigt wird.

Ein externer Camp-Anbieter mit eigener Buchungsplattform wird deshalb **nicht** in eine TuS-Buchungslogik gezwungen.

Die öffentliche Camp-Seite soll später aus denselben gepflegten Daten erzeugt werden und nicht separat in WordPress manuell nachgebaut werden.

### 5. Kennzahl `Events`

Die Kennzahl `Events` zählt alle **nicht archivierten** Datensätze der Event-Art `event`.

Sie wird nicht zusätzlich nach Datum gefiltert, damit noch nicht abgeschlossene Veranstaltungen nicht aus dem Arbeitsbestand verschwinden.

### 6. Kennzahl `Turniere`

Die Kennzahl `Turniere` zählt alle Turniere mit Status ungleich `archiviert`.

Ein Turnier kann eigenständig oder mit einem Event verknüpft sein.

Die KPI zählt jedes Turnier genau einmal.

### 7. Kennzahl `Camps`

Die Kennzahl `Camps` zählt alle **nicht archivierten** Datensätze der Event-Art `camp`.

### 8. Kennzahl `Schichten`

Die Kennzahl `Schichten` zählt alle Helferschichten, deren zugehöriges Event **nicht archiviert** ist.

Sie zählt die gesamte aktuell zu verwaltende Schichtmenge.

Offene Helferplätze erscheinen zusätzlich als handlungsrelevante Aufgabe.

### 9. Bereich `Übersicht`

Die Dashboard-Übersicht zeigt **alle anstehenden bzw. aktuell laufenden Planungseinheiten** in einer gemeinsamen chronologischen Sicht:

- Events,
- Turniere,
- Fußballcamps.

Grundlogik:

- zukünftige Objekte werden nach Datum aufsteigend angezeigt,
- aktuell laufende mehrtägige Events/Camps bleiben sichtbar,
- vergangene, noch nicht archivierte Objekte werden nicht mehr als `anstehend` geführt, sondern als Nachbereitungs-/Archivierungsaufgabe markiert,
- verknüpfte Turniere können innerhalb des zugehörigen Events dargestellt werden, sofern dies Doppelungen reduziert.

Pro Eintrag sollen nur die Informationen erscheinen, die für Orientierung und Einstieg nötig sind:

- Typ,
- Name,
- Datum bzw. Zeitraum,
- Ort, sofern vorhanden,
- kompakter Statushinweis,
- direkter Einstieg in die Bearbeitung.

Die Übersicht ist Navigation und Arbeitsorientierung, kein Ersatz für Detailmodule.

### 10. Bereich `Offene Aufgaben`

`Offene Aufgaben` ist ein echter operativer Arbeitsbereich.

Er bündelt **konkrete Organisationsaufgaben** und **automatisch erkannte Systemhinweise**.

Damit können nicht nur Schichten, sondern die tatsächlichen wiederkehrenden Organisationsarbeiten einer Veranstaltung erfasst werden.

Typische echte Organisationsaufgaben sind beispielsweise:

- Catering bestellen,
- Foodtruck anfragen/bestätigen,
- Ausschankgenehmigung beantragen,
- Pilswagen bestellen,
- Kassen/Wechselgeld richten,
- Material organisieren,
- Lieferungen abstimmen,
- Ansprechpartner bestätigen,
- Beschilderung vorbereiten,
- sonstige veranstaltungsspezifische Aufgaben.

Diese Liste ist bewusst nicht fest codiert. Der reale Nutzen entsteht dadurch, dass Aufgaben:

- manuell an einem Event angelegt werden können,
- aus Event-Templates übernommen werden können,
- später aus bewährten Vorjahresveranstaltungen wiederverwendet werden können.

#### Minimales Aufgabenmodell

Eine Aufgabe benötigt in der ersten sinnvollen Ausbaustufe nur:

- Event-Bezug,
- Titel,
- optional Kategorie,
- optional Fälligkeit,
- optional Verantwortlichkeit,
- Status `offen` / `erledigt`,
- Herkunft `manuell` / `template` / `system`.

Weitere Statusstufen oder Prioritätsmodelle werden nur ergänzt, wenn der reale Arbeitsablauf sie benötigt.

#### Systemhinweise Event / Camp

Zusätzlich können aus vorhandenen Daten belastbar erkannt werden:

- Veranstaltung liegt in der Vergangenheit, ist aber noch nicht abgeschlossen/archiviert → `Event abschließen / archivieren`,
- noch keine Programmpunkte vorhanden → `Programm fehlt`,
- Helferbedarf ist definiert, aber noch keine Schichten wurden erzeugt → `Helferschichten erzeugen`,
- vorhandene Schichten besitzen freie Plätze → `X Helferplätze offen`.

Camp-spezifisch können später nur dann Systemhinweise ergänzt werden, wenn die entsprechenden Funktionen vorhanden sind, zum Beispiel:

- externe Buchung gewählt, aber Buchungslink fehlt,
- Preis-/Teilnahmeinformation fehlt,
- Trainingsort fehlt.

#### Systemhinweise Turnier

Mögliche belastbare Hinweise:

- keine Teams vorhanden → `Teams fehlen`,
- Teams vorhanden, aber noch kein Spielplan → `Spielplan fehlt`.

Weitere Turnierhinweise werden erst aufgenommen, wenn sie aus vorhandenen Daten eindeutig ableitbar sind.

#### Sortierung

Aufgaben werden nach Handlungsrelevanz sortiert:

1. überfällige Aufgaben,
2. zeitnah fällige Aufgaben,
3. Systemhinweise zu bevorstehenden Veranstaltungen,
4. sonstige offene Aufgaben.

Jede Aufgabe verlinkt möglichst direkt zur Stelle, an der sie erledigt werden kann.

Wenn keine offenen Aufgaben vorliegen, wird ein positiver Leerzustand angezeigt.

### 11. Keine künstliche Prozentlogik ohne Nutzen

Für Dashboard V1 wird kein Prozentwert nur um seiner selbst willen verwendet.

Falls später ein Fortschrittsstatus eingeführt wird, muss fachlich klar sein, welche Schritte zählen. Ein scheinbar präziser Prozentwert ohne belastbare Bedeutung wird vermieden.

### 12. Auswertung und Historie – Zielbild noch nicht vollständig festgelegt

Die zweite Mockup-Seite wird **noch nicht vorschnell nur als `Eventhistorie` festgeschrieben**.

Mit den inzwischen gewünschten Jahresauswertungen ist wahrscheinlich eine breitere Funktion sinnvoll, zum Beispiel:

`Auswertung & Historie`

Die genaue Bezeichnung und endgültige Seitenstruktur bleiben offen, bis die Informationsbedürfnisse vollständig geklärt sind.

Fest steht bereits die obere Kennzahlreihe mit den Kategorien:

- Events,
- Turniere,
- Camps,
- Schichten.

Für Auswertungen soll ein Jahr auswählbar sein. Die Zahlen beziehen sich dann auf den gewählten Zeitraum und werden aus den echten Fachdaten berechnet.

### 13. Auswertung `Veranstaltungen pro Jahr`

Der Bereich `Übersicht` der zweiten Seite soll voraussichtlich eine grafische Jahresauswertung enthalten.

Ziel ist sichtbar zu machen, wie sich die Veranstaltungsaktivität des TuS entwickelt hat.

Sinnvolle Darstellung:

- Anzahl Events pro Jahr,
- Anzahl Turniere pro Jahr,
- Anzahl Camps pro Jahr,
- optional zusätzliche Schicht-/Helferkennzahlen nur dann, wenn die Grafik dadurch nicht überladen wird.

Die Grafik wird aus den gespeicherten Event-/Turnierdaten erzeugt und nicht separat gepflegt.

### 14. Helfer-Jahresauswertung

Die personenbezogene Jahresauswertung der Helferstunden ist fachlich **nicht Eigentum der Eventhistorie**.

Verantwortung:

- Event Planner = konkrete Schichten und tatsächlich bestätigte/geleistete Zeiten pro Event,
- `member-engagement` = personenzentrierte Jahres-/Periodensicht, Soll-Erfüllung und Rabatt-Berechtigung.

Trotzdem kann eine kompakte Helfer-Jahresauswertung auf der Auswertungsseite des Event Planners sichtbar gemacht werden, sofern sie ihre Daten aus `member-engagement` bezieht.

Empfohlenes Dashboard-Muster für das laufende Jahr:

- `X Personen haben ihr Helfersoll erfüllt`,
- `Y Personen fehlen nur noch wenige Stunden`,
- `Z Personen haben noch größeren offenen Bedarf`,
- direkter Absprung in die vollständige Mitglieder-/Engagement-Liste.

Im Event-Planner-Dashboard sollen nicht standardmäßig lange Namenslisten wie `Max Meier – 120 h` erscheinen.

Die handlungsrelevanten Listen liegen hinter dem Absprung:

- `Soll erfüllt` → Grundlage für späteren Beitragsnachlass-/Abgleichprozess,
- `kurz vor Soll` → gezielte Information/Ansprache möglich,
- `Gesamtliste` → vollständige periodische Auswertung.

Die Definition von `kurz vor Soll` wird später als fachliche Regel im Mitglieder-/Engagement-Modul festgelegt und nicht im Event Planner hart codiert.

### 15. Archivierte Event-Details

Unabhängig von der späteren Seitenbezeichnung soll eine echte Eventhistorie erhalten bleiben.

Abgeschlossene/archivierte Events und Camps müssen später nachvollziehbar machen können:

- Stammdaten,
- Zeitraum und Ort,
- Programmpunkte,
- Aufgaben/Checklisten und deren Abschluss,
- verknüpfte Turniere,
- Helferbedarf,
- Schichten,
- tatsächlich bestätigte Helfereinsätze,
- Bestellungen,
- Ausgaben,
- besondere Erkenntnisse für die nächste Durchführung.

Diese Historie entsteht aus denselben operativen Daten und wird nicht separat nachgepflegt.

### 16. Archivierungslogik

`archiviert` ist die bewusste Grenze zwischen aktuellem Arbeitsbestand und abgeschlossener Historie.

Grundsatz:

- aktive/nicht archivierte Objekte → operativer Bestand,
- zukünftige/laufende Objekte → Dashboard-Übersicht,
- vergangene, nicht archivierte Objekte → offene Nachbereitungsaufgabe,
- archivierte Objekte → Historie/Auswertung,
- vergangenes Datum allein archiviert nichts automatisch.

### 17. Farben und Darstellung

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
- `../member-engagement/FUNCTIONAL-SCOPE.md` definiert die personenzentrierte Helfer-Jahresauswertung und Soll-Erfüllung.

## Future Development

Nach Freigabe dieser Logik erfolgt die Umsetzung in kleinen Schritten:

1. Event-Art `event` / `camp` rückwärtskompatibel einführen,
2. Dashboard-Kennzahlen korrekt ableiten,
3. Schnellaktionen verdrahten,
4. kompakte anstehende `Übersicht` aufbauen,
5. echtes Aufgaben-/Checklistenmodell ergänzen,
6. Systemhinweise in `Offene Aufgaben` integrieren,
7. Camp-spezifische Informationen und interne/externe Buchungswege ergänzen,
8. Jahresauswertung und Historie auf dieselbe Datenbasis setzen,
9. Helfer-Jahresstatus nur über die gemeinsame Datenquelle des Mitglieder-/Engagement-Moduls anbinden.

Diese Reihenfolge ist Orientierung und keine Freigabe für einen großen Sammel-PR.
