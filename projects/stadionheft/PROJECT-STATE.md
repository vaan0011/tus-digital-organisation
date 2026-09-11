# PROJECT STATE – Stadionheft / Spieltagsmagazin Herren

**Stand:** 2026-09-11  
**Status:** Discovery  
**Phase:** Bestandsaufnahme / Produktionsdesign  
**Fachlicher Bereich:** Redaktion / Kommunikation / Herrenfußball  
**Fachlicher Projekt-Owner:** noch nicht explizit benannt

## Purpose

Dieses Dokument ist der verbindliche aktuelle Arbeitsstand für die Automatisierung der Stadionzeitschrift zu Herren-Heimspieltagen.

## Core Principle

> **Vor Automatisierung zuerst die reale Vorlage, Anzeigen und Datenquellen sauber beherrschen.**

## Main Content

### 1. Ausgangslage

Das Stadionheft wird aktuell weitgehend manuell erstellt. Wiederkehrend müssen feste Layout- und Anzeigenbestandteile mit wechselnden sportlichen und redaktionellen Inhalten kombiniert werden.

Nach Nutzerangabe existieren bereits:

- eine Druckvorlage inklusive Design,
- Sponsor-/Partneranzeigen,
- Inhalte zu Tabelle und Mannschaft,
- Spielstatistiken zum aktuellen Gegner,
- Gegnerdarstellung.

Zusätzlich sollen künftig systematisch genutzt werden:

- Spielbericht der Vorwoche,
- historische Anekdoten, Zahlen und Geschichten aus dem TuS-Archiv,
- aktuelle TuS-News und Projektstände,
- Vereinsaufrufe,
- kommende Veranstaltungen aus dem Veranstaltungskalender.

### 2. Bereits verifizierte vorhandene Arbeitsquellen

Auf Google Drive wurden aktuell gefunden:

- `Stadionheft.xlsx` – historische Stadionheft-/Anzeigen-/Abrechnungsdaten; enthält u. a. frühere Stadionheft-Inserenten und Saisonbezüge,
- vollständige Spielberichte für die laufende Saison,
- `TuS Historie – Quellenindex`,
- `Werbeflaechen-Inventar Sportpark 2026`,
- operative Sponsoring-/Partnerquellen.

Die konkrete aktuelle Design-/Druckvorlage und die aktuellen Anzeigen-Originaldateien sind noch nicht eindeutig als Masterassets identifiziert.

### 3. Zielzustand

Für jedes relevante Herren-Heimspiel kann aus einer festen Mastervorlage mit geringem manuellem Aufwand eine aktuelle, druckfertige Ausgabe erzeugt werden.

Der variable redaktionelle Inhalt wird aus führenden Quellen erzeugt bzw. übernommen. Der Mensch prüft vor Druck insbesondere Fakten, Bildrechte, Partneranzeigen und Layout.

### 4. Arbeitspakete

#### AP1 – Mastervorlage und Produktionsformat sichern

- aktuelle Stadionheft-Druckvorlage auf Drive identifizieren,
- Dateiformat und Produktionswerkzeug klären,
- Seitenformat, Beschnitt, Druckparameter und Schriften erfassen,
- feste und variable Bereiche markieren,
- Locked Assets definieren.

#### AP2 – Anzeigeninventar konsolidieren

- alle aktuellen Anzeigen-Originaldateien lokalisieren,
- Partner / Dateiname / Format / Seitenposition / Gültigkeit erfassen,
- operative Partnerquelle gegen tatsächliche Anzeigenbelegung abgleichen,
- veraltete oder ungeklärte Anzeigen nicht automatisch verwenden.

#### AP3 – feste Seiten- und Content-Map erstellen

Für jede Seite bzw. jeden Slot definieren:

- Zweck,
- feste oder variable Belegung,
- Datenquelle,
- verantwortliche Rolle,
- maximale Text-/Bildmenge,
- Fallback bei fehlendem Inhalt.

#### AP4 – sportliches Datenpaket

- anstehendes Heimspiel erkennen,
- Tabelle und sportliche Kerndaten beziehen,
- Mannschaft/Kaderquelle festlegen,
- Gegnerportrait definieren,
- direkte Duelle / Form / Statistik nur bei belastbarer Datenlage,
- Vorwochenbericht aus Drive einbinden.

#### AP5 – Archiv-Modul

Vor jeder Ausgabe erhält der Archivist ein gezieltes Briefing auf Basis von:

- Gegner,
- Heimspieltermin,
- Wettbewerb,
- möglichem Jubiläums-/Jahrestagsbezug.

Mögliche Ausgaben:

- historisches Duell,
- Anekdote,
- Personengeschichte,
- Foto mit belegtem Kontext,
- `Heute vor ... Jahren`,
- belastbare Zahl oder Serie.

Kein historischer Beitrag wird aus Vermutung erzeugt.

#### AP6 – TuS aktuell

- relevante Projektstände aus den jeweiligen `PROJECT-STATE.md` auswählen,
- Aufrufe und Vereinsnews erfassen,
- keine vertraulichen internen Projektinformationen veröffentlichen,
- Inhalte kompakt und publikationsfähig formulieren.

#### AP7 – Veranstaltungen

- anstehende relevante Termine aus der führenden Veranstaltungsquelle übernehmen,
- Event Planner als Zielquelle vorsehen,
- Datum, Titel, Ort und gegebenenfalls CTA/QR-Code prüfen.

#### AP8 – Pilot-Ausgabe

- eine reale kommende Heimspielausgabe vollständig nach neuem Prozess erstellen,
- Zeitaufwand dokumentieren,
- Fehler und manuelle Eingriffe dokumentieren,
- daraus Last Known Good und Automatisierungsgrenzen ableiten.

#### AP9 – technische Automatisierung

Erst nach erfolgreichem Pilot:

- Datenadapter definieren,
- Content-Paket maschinenlesbar erzeugen,
- Masterlayout reproduzierbar befüllen,
- PDF-Export automatisieren,
- Review-Gate vor Druck beibehalten,
- später optional Heimspiel-Trigger / Runtime einführen.

### 5. Vorgeschlagener wiederkehrender Ablauf

Für einen typischen Heimspieltag:

- **T-5/T-4:** Heimspiel erkennen und Content-Paket öffnen,
- **T-4:** Archivist-Briefing und Gegnerrecherche,
- **T-3:** Spielbericht, Tabelle, Gegner, News und Events einsammeln,
- **T-2:** erster vollständiger Satz,
- **T-1:** Fakten-/Partner-/Layout-/Druckcheck und finaler PDF-Export.

Die genaue Fristlogik wird erst nach Analyse des heutigen Druckprozesses verbindlich.

### 6. Noch offene Entscheidungen

- Wo liegt die aktuelle verbindliche Druckvorlage?
- Mit welchem Werkzeug wird heute gesetzt: InDesign, Canva, Affinity, Word, Publisher oder anderes?
- Welche Anzeigen sind 2026/27 tatsächlich gültig und in welcher Platzierung?
- Wie viele Seiten hat die Standardausgabe und welche Seiten sind fest?
- Wer ist fachlicher Owner der finalen Ausgabe?
- Wer erteilt die Druckfreigabe?
- Welche Druckerei / technischen Spezifikationen gelten?
- Welche Mannschafts-/Kaderdaten dürfen automatisiert genutzt werden?

### 7. Abhängigkeiten

- Matchday Editor,
- Archivist,
- Graphic Designer,
- Partnership Manager,
- Event Planner,
- Project Portfolio Manager,
- WordPress Developer / technische Automatisierung,
- Brand Assets und Druckstandards.

### 8. Risiken

- falsche oder veraltete Partneranzeige,
- manuelle Datenquelle wird versehentlich zur zweiten Source of Truth,
- automatisch erzeugter Text passt nicht in feste Layoutslots,
- Archivinhalt ist noch nicht ausreichend erschlossen,
- fremde Wappen/Bilder werden ohne geklärte Rechte verwendet,
- Druckautomatisierung verändert Locked Assets oder Schriften,
- zu frühe Vollautomatisierung erzeugt mehr Nacharbeit als Nutzen.

### 9. Nächster sinnvoller Schritt

1. aktuelle Master-Druckvorlage auf Google Drive identifizieren oder dort ablegen,
2. 1–2 aktuelle bzw. letzte fertige Ausgaben als Referenz identifizieren,
3. aktuellen Anzeigenordner identifizieren,
4. daraus gemeinsam die reale Seiten-/Content-Map erstellen,
5. anschließend eine Ausgabe als Pilot weitgehend automatisiert produzieren.

## Relationship to other documents

- `README.md`
- `PRODUCTION-STANDARD.md`
- `../PROJECT-PORTFOLIO.md`
- `../../roles/matchday-editor/runtime.md`
- `../../roles/archivist/runtime.md`
- `../../design/`

## Future Development

Nach erfolgreichem Pilot wird entschieden, welche Teile als dauerhafter Redaktions-/Produktionsstandard und welche als technische Runtime weitergeführt werden. Das Projekt kann abgeschlossen werden, sobald die wiederkehrende Stadionheftproduktion reproduzierbar im Regelbetrieb läuft.