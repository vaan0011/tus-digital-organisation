# Event Planner – Bewirtung

## Purpose

Der Block `Bewirtung` bündelt die Planung für Getränke, Essen und Dinge, die von Mannschaften oder Abteilungen zum Event mitgebracht werden.

Ziel ist eine einfache, belastbare Liste: **Was wird benötigt, in welcher Menge und – bei Mitbringen – wer übernimmt es?**

## Core Principle

**Getränke, Essen und Mitbringen werden einmal pro Event zentral gepflegt. Keine doppelte Liste, keine unnötige Beschaffungslogik.**

## Position im Event-Workflow

Der aufklappbare Block `Bewirtung` steht direkt unterhalb von `Helferschichten`.

Er ist in drei Bereiche gegliedert:

- `Getränke`
- `Essen`
- `Mitbringen`

## Eintrag

### Getränke und Essen

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

### Mitbringen

Ein Mitbringen-Eintrag enthält:

- Artikel,
- Menge,
- Einheit,
- optionale Zuordnung zu Mannschaft/Abteilung/Gruppe,
- optionale Notiz.

Beispiele:

- Muffins – 30 – Stück – C-Jugend
- Kuchen – 5 – Stück – Frauen
- Salate – 8 – Schüsseln – Herren 2

`Mitbringen` ist bewusst keine Bestellung. Deshalb heißt das Mengenfeld hier nur `Menge`.

Die Zuordnung ist in V1 ein freies Feld. Sobald eine zentrale Mannschafts-/Abteilungsquelle vorhanden ist, soll daraus eine Auswahl werden, ohne das fachliche Datenmodell zu verändern.

## Einheiten

Die Einheit bleibt ein freies Feld mit Vorschlägen, damit reale Beschaffungs- und Mitbringeinheiten des Vereins nicht künstlich eingeschränkt werden.

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
- Bleche

## Bedienung

- `Getränk hinzufügen` erzeugt eine neue Getränk-Zeile.
- `Essen hinzufügen` erzeugt eine neue Essen-Zeile.
- `Mitbringen hinzufügen` erzeugt eine neue Mitbringen-Zeile.
- Einträge können direkt bearbeitet oder gelöscht werden.
- Gespeichert wird zentral über `Bewirtung speichern`.
- Der Block kann wie die übrigen Arbeitsblöcke ein- und ausgeklappt werden.

## Persistenz

Die fachliche Quelle ist die Tabelle `vtp_event_catering_items`.

Pro Zeile werden Event, Kategorie, Artikel, Menge, Einheit, optionale Zuordnung, Notiz und Sortierung gespeichert.

Kategorien:

- `drink` = Getränke
- `food` = Essen
- `bring` = Mitbringen

Bewirtungsdaten sind interne Planungsdaten und werden in V1 nicht automatisch auf öffentlichen Eventseiten ausgegeben.

## Event-Vorlagen

Alle drei Kategorien werden beim Speichern eines Events als Vorlage übernommen. Bei `Mitbringen` wird auch die Mannschafts-/Abteilungszuordnung gespeichert.

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
