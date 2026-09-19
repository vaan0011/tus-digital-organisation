# Event Planner – Helferschichten

## Purpose

Dieses Dokument beschreibt den verbindlichen Arbeitsstandard für die Helferschichtplanung innerhalb eines Events.

Die Helferschichten verwenden die bestehenden persistenten Tabellen `vtp_shifts` und `vtp_shift_signups`. Es wird keine zweite parallele Schichtdatenquelle aufgebaut.

## Core Principle

**Schichten werden direkt am Event geplant, aus bereits vorhandenen Eventdaten sinnvoll vorbelegt und bleiben anschließend vollständig editierbar.**

Doppelte Eingaben werden vermieden. Informationen, die bereits im Ablaufplan vorhanden sind, werden für die Schichtplanung wiederverwendet.

## Moderner Event-Workflow

Im Event-Bearbeitungsscreen befindet sich der aufklappbare Block `Helferschichten`.

Er ist die einzige aktive Schichtplanung im modernen Event-Workflow.

Die früheren Blöcke

- `Helferbedarf für das Event`,
- `Helferschichten generieren`,
- `Schichtübersicht`

werden dort nicht mehr angezeigt. Die alten Tabellen und Handler bleiben vorerst ausschließlich aus Rückwärtskompatibilität im Plugin erhalten.

## Schicht manuell hinzufügen

`Schicht hinzufügen` erzeugt eine direkt editierbare Zeile mit:

- Bereich / Aufgabe,
- Datum,
- Startzeit,
- Endzeit,
- benötigten Helfern,
- optionaler Zuordnung zu Mannschaft / Abteilung / Gruppe,
- aktueller Belegung,
- Löschen-Aktion.

Es gibt keinen separaten Mini-Editmodus pro Zeile. Gespeichert wird zentral über `Helferschichten speichern`.

## Aufbau und Abbau

Aufbau und Abbau bleiben im Ablaufplan **eigene organisatorische Tagesrollen** und sind keine Programmpunkte.

Sobald für einen Aufbau- oder Abbau-Container Datum und Uhrzeit gepflegt sind, wird automatisch eine zugehörige Helferschicht bereitgestellt. Ein zusätzlicher `Übernehmen`-Klick ist nicht erforderlich.

Automatisch aus dem Ablaufplan übernommen werden:

- Bereich / Aufgabe = `Aufbau` bzw. `Abbau`,
- Datum,
- Startzeit.

Bei der erstmaligen automatischen Anlage gelten als editierbare Startwerte:

- Endzeit = Startzeit + 2 Stunden,
- benötigte Helfer = 2.

Endzeit, Helferzahl und Zuordnung können danach im Helferschicht-Block angepasst werden.

Die technische Verknüpfung erfolgt persistent über `source_type` und `source_ref` an der Schicht. Dadurch werden Aufbau/Abbau nicht doppelt erzeugt und Änderungen von Datum oder Startzeit können eindeutig dem zugehörigen Tagescontainer folgen.

Wird ein Aufbau-/Abbau-Container aus dem Ablaufplan entfernt, wird eine automatisch erzeugte Schicht ohne Anmeldungen ebenfalls entfernt. Existieren bereits Anmeldungen, bleibt die Schicht aus Gründen der Datenintegrität bestehen und wird nur von der Ablaufplan-Quelle entkoppelt.

## Schichtserie generieren

`Schichtserie generieren` erzeugt mehrere aufeinanderfolgende Schichten für denselben Bereich.

Für den gewählten regulären Eventtag werden `Von` und `Bis` automatisch aus dem Programm vorbelegt:

- `Von` = früheste Startzeit eines regulären Programmpunkts,
- `Bis` = späteste Endzeit eines regulären Programmpunkts,
- Aufbau und Abbau zählen dabei ausdrücklich nicht als Programmpunkte.

Die Zeiten bleiben Vorschläge und können vor der Generierung verändert werden.

Eine Endzeit vor der Startzeit bedeutet Folgetag. Beispiel: `20:00–02:00` läuft bis 02:00 Uhr des nächsten Kalendertags. Nach Mitternacht beginnende generierte Schichten erhalten automatisch das Datum des Folgetags.

Die erzeugten Zeilen sind vor dem Speichern normal editierbar. Bestehende Schichten werden durch die Generierung nicht automatisch ersetzt.

## Persistenz

Die fachliche Quelle für konkrete Helferschichten ist `vtp_shifts`.

Die benötigte Helferzahl liegt in `slots_needed`. Helferanmeldungen werden über `vtp_shift_signups` mit der Schicht verknüpft.

Bestehende Anmeldungen bleiben bei normaler Schichtbearbeitung erhalten. Beim bewussten Löschen einer bereits belegten Schicht warnt das UI vor dem Datenverlust.

Schichten dürfen über Mitternacht laufen. `shift_date` bleibt das Startdatum der Schicht.

## Zuordnung zu Mannschaften / Abteilungen

`assigned_group` ist die optionale Zuordnung einer Schicht.

V1 verwendet dafür noch ein freies Textfeld. Eine zentrale Auswahl aus dem späteren Mannschafts-/Organisationsmodell wird erst eingeführt, wenn diese Quelle verbindlich verfügbar ist.

## Fortschrittskacheln

Die Statuskacheln werden aus den realen Schichtdaten abgeleitet.

### Schichten

- keine Schichten = noch nicht geplant,
- Schichten vorhanden, aber nicht vollständig belegt = geplant / offen,
- alle Schichten vollständig belegt = grün / belegt.

### Helfer

- Bedarf = Summe `slots_needed`,
- organisiert = vorhandene Anmeldungen, maximal bis zum jeweiligen Bedarf gezählt,
- alle Plätze besetzt = grün / organisiert.

Die Werte werden nicht separat manuell gepflegt.

## Öffentliche Helferanmeldung

Die vorhandene öffentliche Helferanmeldung liest aus `vtp_shifts` und `vtp_shift_signups`.

Im Event-Bearbeitungsscreen angelegte, generierte oder aus Aufbau/Abbau automatisch synchronisierte Schichten stehen damit auf derselben persistenten Basis für die Helferanmeldung zur Verfügung.

## Bewusst noch nicht Bestandteil

- zentrale Mannschafts-/Abteilungsauswahl,
- Check-in und tatsächlich geleistete Stunden,
- personenzentrierte Jahres-/Rabattlogik,
- automatische Eskalation offener Schichten.
