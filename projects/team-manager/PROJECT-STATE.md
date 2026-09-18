# Team Manager – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für den TuS Team Manager.

Sie hält den aktuellen Stand, offene Datenklärungen, bekannte Risiken und den nächsten sinnvollen Schritt fest.

## Core Principle

Die gemeinsame Mannschaftsidentität, die saisonale Historie und die reale Trainingsbelegung werden vor dem ersten Plugin-Inkrement so konkretisiert, dass keine zweite Mannschafts- oder Trainingsdatenwelt entsteht.

## Main Content

### Current Goal

Die aus den realen Quellen abgeleiteten Saison- und Trainingsdaten werden fachlich bereinigt. Danach wird ein kleines vertikales Plugin-Inkrement vorbereitet: Mannschaftssaison, Trainingsressourcen, Trainingsserie, Konfliktprüfung und lesende Trainingsübersicht.

Parallel bleibt der bereits beschlossene Provider-Spike für das Matchdaten-Modul offen.

Es existiert noch kein Team-Manager-Plugin-Code.

### Verified

- Der langfristige fachliche Funktionsumfang ist in `FUNCTIONAL-SCOPE.md` dokumentiert.
- `DATA-STANDARD.md` definiert Mannschaft, Mannschaftssaison, Personenrollen, JSG-Beziehungen, Ressourcen und Trainingseinheiten.
- `ADR-0013` entscheidet eine gemeinsame saisonübergreifende `team_id` und eine saisonbezogene `team_season_id` für alle Verbraucher.
- Event Planner, Platzbelegung und Matchdaten-Modul führen keine eigenen Mannschaftslisten.
- Die realen Saisonquellen 2026/27 sind in `SEASON-2026-27.md` strukturiert ausgewertet.
- Das TuS-Sportgelände besitzt Hauptplatz, Trainingsfeld 1 mit Q1/Q2 sowie Trainingsfeld 2 mit Q3/Q4.
- Für den Winterbetrieb sind Schönbornhalle, Ohrenberghalle und das Kunstrasen-Kleinfeld am TuS-Gelände als Trainingsstätten bestätigt.
- Außen- und Winterplan werden als getrennte `training_period` innerhalb derselben Saison geführt; ein Plan überschreibt den anderen nicht.
- Im Quellbild gilt: Q1 oben rechts, Q2 oben links, Q3 unten rechts, Q4 unten links.
- Der aktuelle TuS-Trainingsplan mit Zeiten und roten Quadrantenzuordnungen ist vollständig als Prüftabelle dokumentiert.
- Die männlichen A-, B- und C-Junioren bilden 2026/27 eine JSG aus TuS Mingolsheim, VfR Kronau und TSV Langenbrücken.
- Reguläre JSG-Trainingsstandorte: A-Junioren Mingolsheim, B-Junioren Langenbrücken, C-Junioren Kronau.
- Juniorinnen werden nicht aufgrund der Altersklasse automatisch der JSG zugeordnet.
- Trainerrollen werden saisonbezogen modelliert; Name, Telefon und E-Mail besitzen getrennte Veröffentlichungsfreigaben mit Standard `false`.
- Private Kontaktdaten aus der Drive-Trainerliste werden nicht in dieses öffentliche Repository kopiert.
- `ADR-0012` legt das Matchdaten-Modul als Bestandteil des Team Managers fest; der Matchday Editor bleibt lesender Verbraucher.

### Open Data Clarifications

Vor Veröffentlichung oder produktivem Seed-Import müssen die betroffenen Datensätze geklärt werden:

1. Die TuS-Planzeile `B-Junioren` widerspricht dem bestätigten regulären Trainingsort Langenbrücken und überschneidet sich dienstags auf Q3 mit Herren 2. Zu prüfen ist insbesondere, ob `B-Juniorinnen` gemeint ist.
2. Die Jahrgangsangabe `D1 – TuS 2014/2025` ist fehlerhaft; die vermutete Korrektur `2014/2015` benötigt Bestätigung.
3. Jahrgänge E2, E3 und D-Juniorinnen fehlen.
4. Bambini-Trainer fehlen.
5. D-Juniorinnen-Trainer fehlen.
6. Bei C-Juniorinnen fehlen Rolle und Kontaktstatus der zweiten Person.
7. Exakte Zeiten und Ressourcen der B-/C-Junioren an den Partnerstandorten fehlen.
8. Offizielle JSG-Bezeichnung, Vereinsreihenfolge und federführender Verein sind zu bestätigen.
9. Für den Winterbetrieb fehlen Periodengrenzen, Mannschaftszuordnungen, Zeiten und gegebenenfalls Hallenteilflächen.

### Open Technical Work

1. Technisches Schema und Migrationen einschließlich `training_period` aus dem fachlichen Datenstandard ableiten.
2. Geschützte Personen-/Kontaktdatenhaltung und Feldfreigaben implementieren.
3. Seed-/Importformat für bestätigte Saison- und Ressourcendaten einschließlich gemeinsamer Trainingsserien festlegen.
4. Konfliktprüfung für Ressourcenhierarchie und Zeitüberschneidungen implementieren.
5. Lesende Servicegrenze für Event Planner und Platzbelegung definieren.
6. Sportmedia-Zugang, Bedingungen, Kosten, Dateiformat und Beispieldaten verifizieren.
7. Homepage- und Matchday-Read-only-Verträge nach Schema- und Provider-Spike konkretisieren.

### Excluded / Not Yet Decided

- Kein Scraping von fussball.de wird ungeprüft als Architekturstandard festgelegt.
- Saisonale FUSSBALL.DE-Widget-Codes werden nicht zur Zielarchitektur.
- WordPress-Seiten werden nicht zur fachlichen Hauptdatenquelle.
- Private Kontaktdaten werden nicht in Seed-Dateien des öffentlichen Repositories abgelegt.
- Widersprüchliche Quelldaten werden nicht stillschweigend korrigiert oder veröffentlicht.
- Custom Post Types versus eigene Tabellen wird erst aus dem technischen Schema entschieden.
- Es wird kein großes kombiniertes Plugin-Inkrement begonnen.

### Active Development

Dokumentationsbranch für Datenstandard, Saisonstand und Architekturentscheidung. Funktionaler Plugin-Code wurde noch nicht begonnen.

### Next Meaningful Step

1. die neun offenen Datenklärungen mit Jugendleitung bzw. Planverantwortlichen auflösen,
2. bestätigte, nicht personenbezogene Seed-Daten aus `SEASON-2026-27.md` erzeugen,
3. technisches Schema und Migrationen für `team`, `team_season`, Ressourcen und Trainingsserien entwerfen,
4. ein kleines vertikales Inkrement mit Konfliktprüfung und lesender Wochenansicht umsetzen,
5. parallel den Sportmedia-Provider-Spike fortführen.

## Relationship to other documents

- `README.md`
- `DATA-STANDARD.md`
- `SEASON-2026-27.md`
- `FUNCTIONAL-SCOPE.md`
- `MATCH-DATA-MODULE.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../platzbelegung/PROJECT-STATE.md`
- `../../architecture/platform-architecture.md`
- `../../architecture/stability-and-simplicity.md`
- `../../standards/iteration-and-progress.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/ui-standard.md`
- `../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md`
- `../../decisions/ADR-0012-team-manager-match-data-module.md`
- `../../decisions/ADR-0013-shared-team-identity-and-season-model.md`

## Future Development

Nach fachlicher Klärung der markierten Quelldaten wird der Projektstand auf das erste testbare Trainingsdaten-Inkrement aktualisiert. Matchdaten bleiben ein abgegrenztes paralleles Modul mit eigenem Provider-Gate.
