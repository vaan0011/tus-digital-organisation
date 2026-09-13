# Event Planner – Beschaffung & Preislisten

## Purpose

Dieses Dokument beschreibt die verbindliche fachliche Grundlage für Beschaffung, Bestellungen und Preislisten im TuS Event Planner.

Ziel ist, Getränke, Lebensmittel und weitere regelmäßig benötigte Beschaffungspositionen nicht nur als einzelne Bestellungen zu dokumentieren, sondern mit aktuellen Lieferantenpreisen, historischen Preisen, tatsächlichem Verbrauch und wiederverwendbaren Erfahrungswerten zu verbinden.

Der Event Planner bleibt die fachliche Quelle für eventbezogene Bestellungen und tatsächliche Eventverbräuche. Ein zukünftiger Beschaffungs-/Materialwart kann diese Daten über n8n lesen, auswerten und Bestellvorschläge erzeugen, führt aber keine parallele eigene Fachdatenbank.

## Core Principle

> **WordPress speichert Fakten. n8n triggert Arbeit. Der Beschaffungsmanager analysiert und empfiehlt. Der Mensch gibt relevante Bestellungen frei.**

Preislisten sind keine losen Anhänge, sondern eine abrufbare fachliche Referenz für Bestellungen, Vergleiche und spätere Auswertungen.

## Main Content

### 1. Gemeinsamer Artikel- und Lieferantenbezug

Getränke, Lebensmittel und weitere wiederkehrende Beschaffungspositionen sollen auf einen gemeinsamen strukturierten Artikel-/Lieferantenbezug zurückgreifen können.

Mindestens relevant sind:

- Artikelbezeichnung,
- Kategorie, z. B. Getränke, Essen, Verbrauchsmaterial, Eventequipment,
- Lieferant / Bezugsquelle,
- Gebinde / Einheit,
- aktuelle Preise,
- Gültigkeitsdatum bzw. Preislistenstand,
- Mindestbestellmenge, sofern vorhanden,
- Liefer-/Abholmodell,
- Kommissions-/Rückgabemöglichkeit, sofern relevant,
- Pfand, sofern relevant,
- Leihinventar bzw. Zusatzservice, sofern relevant,
- historische Preise, soweit aus Rechnungen oder früheren Preislisten belastbar verfügbar.

### 2. Preislisten müssen abrufbar sein

Aktuelle Preislisten für Getränke und Lebensmittel müssen im operativen System abrufbar sein.

Dabei soll unterschieden werden zwischen:

- aktuellem gültigem Preis,
- Quelle des Preises,
- Preislistenstand / Gültigkeitsdatum,
- historischem Preis,
- eventbezogenem tatsächlich abgerechneten Preis.

Eine neue Preisliste überschreibt die Historie nicht. Preisänderungen müssen nachvollziehbar bleiben, damit spätere Vergleiche und Kalkulationen möglich sind.

Originale Preislisten oder Lieferantendokumente können als geschützte Artefakte in Google Drive liegen. WordPress hält die für die operative Arbeit notwendigen strukturierten Preisreferenzen und verweist bei Bedarf auf das Originaldokument.

### 3. Getränke

Für Getränke sind neben Artikel, Preis und Gebinde insbesondere relevant:

- Fass-/Kasten-/Flaschenformat,
- Pfand,
- Kommissions-/Rückgaberegel,
- Kühlwagen,
- Durchlaufkühler,
- Kühlschränke,
- Verkaufs-/Ausschankwagen,
- Gläser,
- Kohlensäure,
- Garnituren bzw. weiteres vom Getränkelieferanten bereitgestelltes Eventequipment,
- kurzfristige Nachversorgung während einer Veranstaltung.

Historische Bestellungen und Rückgaben werden möglichst getrennt erfasst, damit aus der Differenz ein belastbarer tatsächlicher Verbrauch abgeleitet werden kann.

### 4. Essen / Lebensmittel

Für Essen und Lebensmittel gilt derselbe Grundprozess, ergänzt um lebensmittelspezifische Informationen.

Mindestens relevant sind:

- Artikel / Speise,
- Lieferant,
- Gebinde / Einkaufseinheit,
- Einkaufspreis,
- bestellte Menge,
- tatsächlich verwendete bzw. verkaufte Menge, sofern verfügbar,
- verwertbarer Restbestand,
- nicht verwertbarer Rest / Waste, soweit sinnvoll erfassbar,
- daraus erzeugte bzw. verkaufte Portionen, sofern belastbar verfügbar,
- Vorbestellfrist,
- notwendige Kühlung oder Zubereitungstechnik, sofern relevant.

Ziel ist keine kleinteilige Küchenbuchhaltung, sondern eine belastbare Grundlage für die nächste Eventplanung und Bestellung.

### 5. Eventbezogene Bestellung

Ein Event kann Beschaffungspositionen aus dem gemeinsamen Artikel-/Lieferantenbestand übernehmen.

Je Position sollen mindestens verfügbar sein:

- benötigter Artikel,
- vorgeschlagene Menge,
- freigegebene/bestellte Menge,
- Lieferant,
- verwendeter Preis bzw. Preislistenstand,
- erwartete Kosten,
- Bestellstatus,
- tatsächliche Menge bzw. Verbrauch nach dem Event, soweit fachlich sinnvoll,
- tatsächliche Kosten,
- Rückgabe / Rest / Waste, soweit relevant.

### 6. Wiederkehrende Events und Prognosen

Für wiederkehrende Veranstaltungen soll die nächste Planung auf realen Vorjahreswerten aufbauen können.

Ein zukünftiger Beschaffungsmanager kann dafür insbesondere berücksichtigen:

- historischen tatsächlichen Verbrauch,
- aktuelle Preislisten,
- erwartete Besucherzahl,
- Dauer / Veranstaltungstage,
- Wetter, sofern relevant,
- aktuellen Lagerbestand,
- Sicherheitsreserve,
- Lieferzeit,
- mögliche kurzfristige Nachversorgung,
- Rückgabe-/Kommissionsmöglichkeiten.

Das System darf daraus einen Bestellvorschlag erzeugen. Die Bestellung selbst bleibt ein menschlich freizugebender Vorgang.

### 7. Kiosk und Event Planner

Der TuS-Kiosk ist kein künstliches Dauer-Event.

Kiosk und Event Planner sollen jedoch denselben Artikel-/Lieferanten-/Preislistenbestand nutzen können.

Damit kann derselbe Artikel beispielsweise für

- Eventbestellungen,
- Kiosk-Mindestbestände,
- laufende Kiosk-Nachbestellungen,
- Lieferantenvergleiche,
- Preisentwicklung

verwendet werden, ohne ihn mehrfach zu pflegen.

### 8. Rolle von n8n und digitalem Beschaffungsmanager

n8n kann später Trigger und Datentransport übernehmen, zum Beispiel:

- Event nähert sich,
- Preislistenstand ist veraltet,
- Mindestbestand unterschritten,
- neue Preisliste eingegangen,
- außergewöhnliche Preisänderung erkannt,
- Bestellvorschlag ist zur Freigabe bereit.

Der digitale Beschaffungsmanager darf insbesondere analysieren, vergleichen, prognostizieren und Empfehlungen erzeugen.

Er darf nicht ohne ausdrücklich beschlossenen Freigabeprozess automatisch kostenpflichtige Bestellungen auslösen.

## Relationship to other documents

Dieses Dokument konkretisiert den Bereich `Bestellungen für Veranstaltungen` aus `projects/event-planner/FUNCTIONAL-SCOPE.md`.

Es ergänzt insbesondere:

- `projects/event-planner/PROJECT-STATE.md`,
- `projects/event-planner/DATA-PERSISTENCE.md`,
- die organisationsweiten Persistenz- und Qualitätsstandards,
- den geplanten Beschaffungs-/Materialwart-Runtime-Kontext,
- spätere Kiosk- und Sportpark-Bestellprozesse.

Google Drive bleibt geeigneter Ablageort für Originalrechnungen, Preislisten und weitere Lieferantendokumente. WordPress hält die für operative Arbeit benötigten strukturierten Fachdaten persistent vor.

## Future Development

Nach Eingang weiterer Abrechnungen und Preislisten werden zunächst reale TuS-Datenmodelle abgeleitet statt vorschnell generische Beschaffungssoftware zu bauen.

Als nächste reale Datengrundlagen sind insbesondere vorgesehen:

- Getränke Hallenturniere Jugend,
- Getränke TuS Kiosk,
- Lebensmittel-/Essensabrechnungen der relevanten TuS-Veranstaltungen,
- aktuelle Getränke-Preislisten,
- aktuelle Lebensmittel-/Catering-Preislisten.

Erst danach wird entschieden, welche gemeinsame Artikel-, Preislisten- und Bestandslogik als kleinste robuste Lösung technisch im WordPress-System umgesetzt wird.