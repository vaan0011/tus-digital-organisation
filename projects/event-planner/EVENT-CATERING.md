# Event Planner – Bewirtung

## Purpose

Der Block `Bewirtung` bündelt die Bestellplanung für Getränke und Essen direkt im Event.

Ziel ist eine einfache, belastbare Liste: **Was wird benötigt und in welcher Menge muss es bestellt werden?**

## Core Principle

**Getränke und Essen werden einmal pro Event als konkrete Bestellmengen gepflegt. Keine doppelte Liste, keine unnötige Beschaffungslogik.**

## Position im Event-Workflow

Der aufklappbare Block `Bewirtung` steht direkt unterhalb von `Helferschichten`.

Er ist in zwei Bereiche gegliedert:

- `Getränke`
- `Essen`

## Eintrag

Jeder Eintrag enthält:

- Artikel,
- Bestellmenge,
- Einheit,
- optionale Notiz.

Beispiele:

- Pils – 12 – Kisten
- Cola – 8 – Kisten
- Wasser – 120 – Flaschen
- Bratwurst – 250 – Stück
- Pommes – 40 – kg

Die Einheit bleibt ein freies Feld mit Vorschlägen, damit reale Beschaffungseinheiten des Vereins nicht künstlich eingeschränkt werden.

Vorgeschlagene Einheiten:

- Kisten
- Flaschen
- Liter
- Stück
- kg
- Packungen
- Kartons
- Dosen
- Beutel

## Bedienung

- `Getränk hinzufügen` erzeugt eine neue Getränk-Zeile.
- `Essen hinzufügen` erzeugt eine neue Essen-Zeile.
- Einträge können direkt bearbeitet oder gelöscht werden.
- Gespeichert wird zentral über `Bewirtung speichern`.
- Der Block kann wie die übrigen Arbeitsblöcke ein- und ausgeklappt werden.

## Persistenz

Die fachliche Quelle ist die Tabelle `vtp_event_catering_items`.

Pro Zeile werden Event, Kategorie, Artikel, Bestellmenge, Einheit, Notiz und Sortierung gespeichert.

Bewirtungsdaten sind interne Planungsdaten und werden in V1 nicht automatisch auf öffentlichen Eventseiten ausgegeben.

## Bewusst nicht in V1

- Lieferantenverwaltung,
- Preise oder Budget,
- Bestellstatus (`bestellt`, `geliefert` usw.),
- Lagerbestand,
- automatische Mengenberechnung aus Besucherzahlen,
- Pfand- oder Rückgabeverwaltung,
- Einkaufslisten je Lieferant,
- automatische Übernahme aus vergangenen Events.

Diese Funktionen werden nur ergänzt, wenn sie im realen Vereinsablauf einen klaren praktischen Nutzen haben.
