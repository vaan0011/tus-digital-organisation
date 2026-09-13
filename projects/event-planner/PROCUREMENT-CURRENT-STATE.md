# Event Planner – Beschaffung Current State

**Status:** Discovery / reale Datengrundlage im Aufbau  
**Stand:** 2026-09-13

## Purpose

Dieses Dokument hält den aktuellen belastbaren Arbeitsstand für die Beschaffungslogik rund um TuS-Veranstaltungen fest.

Es verhindert, dass vorhandene Rechnungen, noch fehlende Quellen, Architekturentscheidungen und nächste Schritte in einzelnen Chats oder Dateien verloren gehen.

Detaillierte Rechnungen und Original-Preislisten bleiben als Arbeitsartefakte in Google Drive. GitHub dokumentiert den nicht-sensitiven fachlichen Stand, die Regeln und die offenen Punkte.

## Core Principle

> **Erst reale TuS-Verbrauchs- und Preisdaten verstehen, dann die kleinste robuste Beschaffungslösung bauen.**

WordPress soll später die operativen Fachdaten speichern. n8n triggert Arbeit und verbindet Systeme. Ein digitaler Beschaffungsmanager analysiert, prognostiziert und erzeugt Vorschläge. Kostenpflichtige Bestellungen bleiben menschlich freizugeben.

## Main Content

### 1. Aktuelle Getränkedaten

In Google Drive liegt der Ordner `Getränkelieferant` mit aktuell vier Rechnungs-PDFs aus 2026:

- Sommerfest Jugend,
- Jahrmarkt,
- Maibaum,
- Winterfeier.

Die Rechnungen enthalten nicht nur ursprüngliche Bestellmengen, sondern auch Rückgaben, Pfand sowie teilweise Leihinventar und Nachholungen. Damit kann aus den Quellen deutlich besser ein tatsächlicher Verbrauch und realer Eventservicebedarf abgeleitet werden als aus reinen Bestelllisten.

Aus den vier vorhandenen Quellen wurde im Google-Sheet `08_Angebotsvergleich – Getränkelieferant 2027` der Tab `Bedarfsprofil 2026` aufgebaut.

Der derzeitige dokumentierte Rechnungsendbetrag der vier vorhandenen Quellen beträgt zusammen **16.377,92 EUR brutto**. Dieser Betrag ist ausdrücklich **kein reiner Getränkeeinkauf**, da darin je nach Veranstaltung auch Pfand, Leihinventar, Kühlung, Ausschanktechnik, Mobiliar und weitere Leistungen enthalten sind.

Die vier vorhandenen Quellen ergeben zusammen **2.010 Liter abgerechnetes Fassbier**. Auch diese Zahl ist nur ein Teil des Gesamtbedarfs, da zusätzlich Flaschen-/Kastenware, Wein, alkoholfreie Getränke und Eventequipment relevant sind.

### 2. Noch fehlende Getränkedaten

Für ein vollständigeres Jahresprofil fehlen aktuell noch:

- Hallenturniere Jugend,
- TuS Kiosk.

Der Kiosk wird fachlich nicht als Dauer-Event behandelt. Er soll später jedoch denselben Artikel-, Lieferanten- und Preislistenbestand verwenden wie der Event Planner.

### 3. Essen / Lebensmittel

Für Essen wird derselbe Grundprozess vorgesehen wie für Getränke:

`Bedarf -> Vorjahreswerte -> Bestellung -> tatsächlicher Verbrauch -> Rest/Waste -> Kosten -> Lernwert für die nächste Veranstaltung`

Die dafür relevanten Essens-/Lebensmittelabrechnungen liegen aktuell noch nicht vollständig vor und werden nachgezogen.

Sinnvolle zusätzliche Datenpunkte gegenüber Getränken sind insbesondere:

- Artikel / Speise,
- Gebinde / Einkaufseinheit,
- Einkaufsmenge,
- Einkaufspreis,
- verwendete bzw. verkaufte Menge, soweit belastbar verfügbar,
- verwertbarer Restbestand,
- nicht verwertbarer Rest / Waste,
- erzeugte bzw. verkaufte Portionen, soweit belastbar verfügbar,
- Vorbestellfrist,
- notwendige Kühlung oder Zubereitungstechnik.

Ziel ist keine kleinteilige Küchenbuchhaltung, sondern eine belastbare Grundlage für Mengenplanung, Kosten und Wiederverwendung von Erfahrungswerten.

### 4. Preislisten

Aktuelle Preislisten für Getränke und Essen müssen später operativ abrufbar sein.

Dabei sollen mindestens unterscheidbar sein:

- aktueller gültiger Preis,
- Lieferant,
- Gebinde / Einheit,
- Quelle,
- Preislistenstand / Gültigkeitsdatum,
- historische Preise,
- tatsächlich bei einem Event abgerechnete Preise.

Neue Preise dürfen historische Preise nicht still überschreiben.

Original-Preislisten können in Google Drive liegen. WordPress hält die für die operative Arbeit benötigten strukturierten Preisreferenzen und verweist bei Bedarf auf das Original.

### 5. Zielarchitektur

Die aktuelle Architekturentscheidung lautet:

- **WordPress:** operative Source of Truth für Artikel, Lieferantenbezug, Preise, Bestellungen, Verbrauch, Rest/Waste und Bestände,
- **Google Drive:** Originalrechnungen, Originalpreislisten und sonstige Beschaffungsbelege,
- **n8n:** Trigger und Datentransport,
- **digitaler Beschaffungsmanager:** Analyse, Vergleich, Prognose, Preis-/Bedarfsprüfung und Bestellvorschläge,
- **Mensch:** Freigabe kostenpflichtiger Bestellungen und Entscheidungen mit wirtschaftlicher Wirkung.

Der digitale Mitarbeiter führt keine parallele eigene Datenbank.

### 6. Wiederkehrende Events

Für wiederkehrende Veranstaltungen soll die nächste Planung später auf realen Erfahrungswerten aufbauen können.

Berücksichtigt werden können insbesondere:

- Vorjahresverbrauch,
- aktuelle Preise,
- erwartete Besucherzahl,
- Veranstaltungstage und Dauer,
- Wetter, sofern relevant,
- aktueller Lagerbestand,
- Sicherheitsreserve,
- Lieferzeiten,
- Kommissions-/Rückgabemöglichkeiten,
- kurzfristige Nachversorgung.

Die historischen Rechnungen zeigen bereits, dass neben den Getränken selbst auch Kühlwagen, Durchlaufkühler, Kühlschränke, Ausschank-/Verkaufswagen, Gläser, Kohlensäure und Mobiliar beschaffungsrelevant sein können.

### 7. Aktueller Umsetzungsstand

Noch keine technische Implementierung aus diesem Themenblock starten.

Zuerst werden die realen TuS-Daten vervollständigt und danach das notwendige Datenmodell abgeleitet.

Aktuell offen:

- Getränkedaten Hallenturniere Jugend nachziehen,
- Kiosk-Bestell-/Jahresdaten nachziehen,
- Essens-/Lebensmittelabrechnungen beschaffen und auswerten,
- aktuelle Getränke-Preislisten beschaffen,
- aktuelle Essen-/Catering-Preislisten beschaffen,
- prüfen, welche Artikel- und Bestandslogik tatsächlich gemeinsam benötigt wird,
- danach kleinste robuste WordPress-Erweiterung spezifizieren.

## Relationship to other documents

- `PROCUREMENT-PRICE-LISTS.md` – verbindliches fachliches Zielbild für Beschaffung und Preislisten,
- `FUNCTIONAL-SCOPE.md` – Event Planner als gemeinsame fachliche Klammer für Eventplanung und Bestellungen,
- `DATA-PERSISTENCE.md` – dauerhafte strukturierte Speicherung relevanter Fachdaten,
- `PROJECT-STATE.md` – aktueller Entwicklungsstand des Event Planners,
- `../../roles/ROLE-CANDIDATES.md` – organisatorische Einordnung von Beschaffungs-/Materialwart-Bedarf.

## Future Development

Sobald die noch fehlenden Rechnungen und Preislisten vorliegen, wird dieser Current State aktualisiert.

Danach wird aus den realen Daten entschieden, welche Felder, Tabellen, Ansichten, Trigger und Freigabepunkte tatsächlich gebraucht werden. Erst dann geht der Beschaffungsbereich in konkrete WordPress-/n8n-Umsetzung über.
