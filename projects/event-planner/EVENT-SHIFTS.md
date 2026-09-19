# Event Planner – Helferschichten

## Purpose

Dieses Dokument beschreibt den aktuellen Arbeitsstandard für die Helferschichtplanung innerhalb eines Events.

Die Helferschichten sind Bestandteil der Eventplanung und verwenden die bestehenden persistenten Tabellen `vtp_shifts` und `vtp_shift_signups`. Es wird keine zweite parallele Schichtdatenquelle aufgebaut.

## Core Principle

**Schichten werden direkt am Event geplant, können einzeln angelegt oder als Serie erzeugt werden und bleiben anschließend vollständig editierbar.**

Die Personeneintragung erfolgt auf derselben persistenten Schichtbasis. Planung und tatsächliche Anmeldung bleiben damit miteinander verbunden.

## V1-Arbeitsablauf

Im Event-Bearbeitungsscreen befindet sich unterhalb von `Aufgaben und Organisation` der aufklappbare Block `Helferschichten`.

### Schicht manuell hinzufügen

`Schicht hinzufügen` erzeugt eine neue editierbare Zeile.

Eine Schicht enthält:

- Bereich / Aufgabe,
- Datum,
- Startzeit,
- Endzeit,
- benötigte Helfer,
- optionale Zuordnung zu Mannschaft / Abteilung / Gruppe,
- aktuelle Belegung,
- Löschen-Aktion.

Alle Felder werden direkt bearbeitet. Es gibt keinen separaten Mini-Editmodus pro Zeile.

Gespeichert wird zentral über `Helferschichten speichern`.

### Schichtserie generieren

`Schichtserie generieren` erzeugt mehrere aufeinanderfolgende Schichten für denselben Bereich.

Eingaben:

- Bereich / Aufgabe,
- Datum,
- Zeitraum von / bis,
- Blocklänge,
- Helfer je Schicht,
- optionale Zuordnung.

Beispiel:

`Ausschank`, 14:00–22:00, Blocklänge 120 Minuten, 3 Helfer je Schicht

erzeugt:

- 14:00–16:00,
- 16:00–18:00,
- 18:00–20:00,
- 20:00–22:00.

Die erzeugten Zeilen sind vor dem Speichern normal editierbar.

Die Generierung ersetzt keine bestehenden Schichten automatisch.

## Persistenz

Die fachliche Quelle für konkrete Helferschichten ist `vtp_shifts`.

Die benötigte Helferzahl einer konkreten Schicht liegt in `slots_needed`.

Öffentliche oder interne Helferanmeldungen werden über `vtp_shift_signups` mit der jeweiligen Schicht verknüpft.

Bestehende Anmeldungen bleiben erhalten, wenn eine Schicht bearbeitet wird.

Wird eine bereits belegte Schicht bewusst gelöscht, wird im UI vor dem Entfernen gewarnt. Beim anschließenden Speichern werden die zugehörigen Anmeldungen ebenfalls gelöscht.

## Zuordnung zu Mannschaften / Abteilungen

`assigned_group` bleibt die optionale Zuordnung einer Schicht.

Damit können Schichten später beispielsweise einer Mannschaft, Abteilung oder sonstigen Gruppe zur Besetzung zugewiesen und über gruppenspezifische Helferansichten gefiltert werden.

V1 verwendet dafür bewusst noch ein freies Textfeld. Eine zentrale Auswahl aus dem späteren Mannschafts-/Organisationsmodell wird erst eingeführt, wenn diese Quelle verbindlich verfügbar ist.

## Fortschrittskacheln

Die bestehenden Statuskacheln werden aus den realen Schichtdaten abgeleitet.

### Schichten

- `0/0` = noch nicht geplant,
- Schichten vorhanden, aber keine vollständig belegt = geplant,
- teilweise vollständig belegt = Warn-/Zwischenzustand,
- alle Schichten vollständig belegt = grün / belegt.

### Helfer

- Bedarf = Summe `slots_needed`,
- organisiert = vorhandene Anmeldungen, maximal bis zum jeweiligen Bedarf gezählt,
- alle Plätze besetzt = grün / organisiert.

Die Kachelwerte werden nicht separat manuell gepflegt.

## Verhältnis zum alten Helferbedarf

Die bestehende Tabelle `vtp_helper_needs` und die ältere Helferschicht-Verwaltungsseite bleiben vorerst aus Kompatibilitätsgründen erhalten.

Im modernen Event-Bearbeitungsfluss wird der konkrete Schichtbedarf jedoch direkt über `vtp_shifts.slots_needed` gepflegt. Es soll keine doppelte Eingabe desselben konkreten Schichtbedarfs entstehen.

Eine spätere Bereinigung der alten Helferbedarf-/Generatorlogik erfolgt separat, nachdem der neue Workflow im realen Einsatz bestätigt wurde.

## Öffentliche Helferanmeldung

Die vorhandene öffentliche Helferanmeldung liest bereits aus `vtp_shifts` und `vtp_shift_signups`.

Neu im Event-Bearbeitungsscreen angelegte oder generierte Schichten können deshalb ohne zweite Datenpflege in dieser öffentlichen Ansicht verwendet werden.

Der öffentliche Helfer-Workflow selbst ist nicht Bestandteil dieser V1-Änderung und wird als nächster eigener Arbeitsblock weiterentwickelt.

## Nicht Bestandteil von V1

- wiederkehrende Schichten über mehrere Tage mit einem Klick,
- automatisches Ableiten von Schichten aus Programmpunkten,
- automatische Mannschafts-/Abteilungsauswahl,
- Prioritäten,
- Check-in / tatsächlich geleistete Stunden,
- automatischer Sollstunden-/Beitragsrabatt,
- automatische Eskalation offener Schichten.

Diese Punkte werden erst ergänzt, wenn der Grundworkflow belastbar funktioniert.
