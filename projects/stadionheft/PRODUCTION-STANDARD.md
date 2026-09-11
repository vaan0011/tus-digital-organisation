# Produktionsstandard – Stadionheft / Spieltagsmagazin Herren

## Purpose

Dieser Standard beschreibt die Zielarbeitsweise für die wiederkehrende Erstellung des TuS-Stadionhefts an Herren-Heimspieltagen.

Er dient zunächst als Discovery- und Pilotstandard. Verbindliche Druckparameter und konkrete Seitenzuordnungen werden nach Analyse der realen Mastervorlage ergänzt.

## Core Principle

> **Feste Vorlage. Führende Quellen. Variable Inhalte. Ein finaler Review vor Druck.**

Die Produktion automatisiert Sammlung, Aufbereitung und Satz wiederkehrender Inhalte, nicht die Verantwortung für Fakten, Rechte, Partnergültigkeit oder Druckfreigabe.

## Main Content

### 1. Drei Inhaltstypen

#### A – Locked Content

Wird nicht automatisch verändert:

- TuS-Logo,
- Brand-Elemente,
- Schriften,
- Seitenraster,
- feste grafische Elemente,
- freigegebene Partneranzeigen,
- rechtlich oder vertraglich feste Hinweise.

#### B – strukturierte variable Daten

Werden aus führenden Quellen übernommen:

- Gegner,
- Datum / Uhrzeit,
- Wettbewerb / Spieltag,
- Tabelle,
- Ergebnisse,
- ausgewählte Statistiken,
- kommende Veranstaltungen,
- definierte Projekt-/Vereinsinformationen.

#### C – redaktionelle variable Inhalte

Werden quellenbasiert redaktionell erzeugt oder übernommen:

- Gegnerportrait,
- Spielbericht / Rückblick,
- Archivgeschichte,
- Projekt-/Vereinsnews,
- Aufrufe,
- Editorial.

### 2. Content-Paket je Ausgabe

Vor dem Satz wird ein Ausgabe-Content-Paket erzeugt. Es enthält mindestens:

- Ausgabe-ID / Datum,
- konkretes Heimspiel bzw. Heimspieltag,
- sportliches Datenpaket,
- Vorwochenbericht,
- Gegnerportrait,
- Archivbeitrag,
- TuS-News,
- Veranstaltungen,
- gültige Anzeigenliste,
- verwendete Bilder / Assets mit Herkunft,
- offene Fakten- oder Freigabepunkte.

Das Content-Paket ist die Übergabe zwischen Inhaltserstellung und Layoutproduktion.

### 3. Sportliche Inhalte

Der Matchday Editor liefert beziehungsweise verifiziert:

- Gegner und Partie,
- Liga/Wettbewerb,
- Tabelle,
- vorherige Ergebnisse,
- relevante belastbare Statistiken,
- Gegnerportrait,
- letzten vollständigen TuS-Spielbericht.

`fussball.de` bleibt eine zentrale Faktenquelle. Andere Quellen dürfen ergänzen, aber widersprüchliche Daten müssen vor Druck geklärt werden.

### 4. Archivbeitrag

Der Archivist erhält pro Ausgabe eine konkrete Recherchefrage.

Priorität:

1. historischer Bezug zum aktuellen Gegner,
2. historisches Spiel oder besondere Serie,
3. Person/Anekdote mit Bezug zum Spieltag,
4. Jahrestag / `Heute vor ... Jahren`,
5. anderes starkes, quellenbelegtes Fundstück.

Ein Archivbeitrag enthält intern mindestens Quelle und Quellenstatus. Unklare Datierungen, Personenidentitäten oder Rekordbehauptungen werden nicht als gesicherte Fakten veröffentlicht.

### 5. TuS aktuell

Projekt- und Vereinsnews werden nicht aus Chat-Erinnerung erzeugt.

Mögliche Quellen:

- aktuelle `PROJECT-STATE.md`,
- freigegebene Vereinskommunikation,
- veröffentlichte Homepage-/Social-Media-Inhalte,
- vom zuständigen Owner freigegebene Aufrufe.

Interne Budgets, personenbezogene Daten, ungeklärte Verhandlungen oder noch nicht freigegebene Vorhaben werden nicht automatisch veröffentlicht.

### 6. Veranstaltungen

Es werden nur anstehende, für Stadionbesucher relevante Veranstaltungen dargestellt.

Ziel ist die Übernahme aus dem Event Planner beziehungsweise der jeweils führenden Veranstaltungsquelle. Eine separate manuelle Stadionheft-Veranstaltungsliste soll langfristig entfallen.

### 7. Partneranzeigen

Partneranzeigen sind Locked Assets.

Vor jeder Ausgabe muss maschinell oder manuell eindeutig bekannt sein:

- Partner,
- gültige Originaldatei,
- Gültigkeit / Saison,
- vereinbarte Größe / Platzierung soweit relevant,
- Status `freigegeben`.

Fehlt eine eindeutige Freigabe, wird die Anzeige nicht automatisch ersetzt, aktualisiert oder generativ nachgebaut. Der Partnership Manager klärt den Status.

### 8. Satz und Layout

Nach Analyse der Mastervorlage erhält jeder variable Slot definierte Grenzen, zum Beispiel:

- maximale Zeichen / Wörter,
- Anzahl Bilder,
- erlaubte Bildformate,
- Seitenposition,
- Fallbacktext bzw. Fallbackmodul,
- Regeln für Überlauf.

Automatische Textkürzung darf keine Fakten oder Sinnzusammenhänge verfälschen. Wenn ein Inhalt nicht sauber in den Slot passt, wird er redaktionell verdichtet oder eskaliert.

### 9. Review Gate

Vor finalem Export werden mindestens geprüft:

#### Faktencheck

- Gegner,
- Datum/Uhrzeit,
- Wettbewerb,
- Tabelle und relevante Zahlen,
- Namen,
- historische Fakten.

#### Partnercheck

- nur freigegebene Anzeigen,
- richtige Anzeige / Partnerzuordnung,
- keine veraltete Saison- oder Leistungsdarstellung.

#### Designcheck

- Original-Assets,
- keine veränderten Logos,
- keine Font-Substitution ohne Freigabe,
- kein Textüberlauf,
- Bildqualität ausreichend,
- feste Seitenlogik eingehalten.

#### Druckcheck

- korrektes Format,
- Seitenzahl,
- Beschnitt / Farbprofil / Auflösung nach realer Druckvorgabe,
- finale PDF-Version eindeutig benannt.

### 10. Dateilogik

Zielkonvention nach Pilot:

`YYYY-MM-DD – Heimspiel – Gegner – Stadionheft – FINAL.pdf`

Arbeitsstände erhalten keinen `FINAL`-Status.

Die verbindliche Mastervorlage wird niemals durch eine einzelne Spieltagsausgabe überschrieben.

### 11. Automatisierungsgrenze

Ein vollständig automatischer Versand an die Druckerei ist in der ersten Ausbaustufe nicht vorgesehen.

Ziel zunächst:

> **Automatisch bis zum prüfbaren Druckentwurf; menschliche Freigabe vor FINAL.**

Erst nach mehreren fehlerfreien Läufen wird entschieden, ob weitere Schritte automatisiert werden dürfen.

## Relationship to other documents

- `README.md`
- `PROJECT-STATE.md`
- `../../roles/matchday-editor/editorial-standard.md`
- `../../roles/archivist/archive-standard.md`
- `../../roles/partnership-manager/partnership-standard.md`
- `../../design/brand-identity.md`
- `../../design/generative-design-standard.md`

## Future Development

Nach Analyse der realen Druckvorlage werden Seitenplan, Slotdefinitionen, konkrete Druckparameter und der technische Satzweg ergänzt. Nach dem ersten Pilot werden manuelle Eingriffe gemessen und gezielt reduziert.