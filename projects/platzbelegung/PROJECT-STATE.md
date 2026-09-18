# Project State – TuS Platzbelegung

## Purpose

Dieses Dokument hält den aktuellen belastbaren Stand des Projekts `TuS Platzbelegung` fest und dient als Einstiegspunkt für WordPress Developer, Portfolio Manager und Datenschutzrolle.

## Core Principle

> **Keine neue Kalenderinsel bauen. Belegungen aus fachlich führenden Quellen zusammenführen und als verständliche Sicht darstellen.**

## Main Content

### Status

`Discovery – Ressourcen-, Verfügbarkeits- und Analysemodell definiert`

### Ausgangslage

- Die aktuelle Homepage besitzt eine Seite `Platzbelegung`.
- Der Spielbetrieb wird dort derzeit über einen direkten Google-Calendar-iframe dargestellt.
- Trainings- und Winterbelegungen werden teilweise über statische Bilder dargestellt.
- Der Nutzer hat am 11.09.2026 entschieden, dass Platzbelegung künftig als eigenes WordPress-Plugin umgesetzt wird.
- Direkte Google-iframes sind für den Neuaufbau kein Zielbild.

### Ziel

Ein eigenes TuS-Plugin stellt Platz- und Hallenbelegungen im TuS-Design dar. Es kombiniert Belegungen aus fachlich führenden Systemen, ohne Trainingszeiten, Spiele oder Events nochmals separat zu pflegen. Intern zeigt es die Auslastung je Ressource und findet freie Zeitfenster für zusätzliche Trainingsgruppen.

### Fachlicher Owner

Noch offen.

Technischer Owner:

- WordPress Developer.

Relevante Fachbereiche:

- Sport,
- Jugend,
- Sportpark / Infrastruktur,
- Veranstaltungen,
- Datenschutz,
- Homepage / Kommunikation.

### Verifizierte Ressourcen und Quelle

Der reale Trainingsbetrieb nutzt am TuS-Sportgelände:

- Hauptplatz,
- Trainingsfeld 1 mit Quadrant 1 und Quadrant 2,
- Trainingsfeld 2 mit Quadrant 3 und Quadrant 4,
- Kunstrasen-Kleinfeld für den Winterbetrieb.

Im Winterbetrieb werden zusätzlich Schönbornhalle und Ohrenberghalle genutzt. Genaue Hallenteilungen und Winterzeiten sind noch aufzunehmen.

Im maßgeblichen Quellbild gilt Q1 oben rechts, Q2 oben links, Q3 unten rechts und Q4 unten links. Die Richtungen sind bildbezogen und keine Himmelsrichtungen.

Die fachlich führende Quelle für wiederkehrende Mannschaftstrainings wird der Team Manager. Sein `DATA-STANDARD.md` definiert Ressourcenhierarchie, Mannschaftssaison, Trainingsserie, Ausnahmen und Konfliktstatus. Der strukturierte Ausgangsplan 2026/27 steht in `../team-manager/SEASON-2026-27.md`.

### Datenquellen und Verantwortungsgrenzen

- Training → Team Manager,
- Heimspiele → Matchdaten-Modul des Team Managers,
- Veranstaltungen/Turniere → Event Planner,
- Ressourcen-Verfügbarkeiten, Sperrungen, Hallen-Sondertermine und Auslastungsanalyse → Platzbelegung,
- bestehender Google-Kalender → nur Übergangs-/Migrationsquelle nach Discovery.

Die Platzbelegung speichert keine zweite Kopie von Trainingsserien. Sie erzeugt eine gemeinsame zeitliche Sicht und darf eigene Einträge nur für Sachverhalte ohne andere fachlich führende Quelle führen.

### Aktuell bekannte Anforderungen

- eigenes Plugin, kein eingebetteter externer Kalender als Kernfunktion,
- moderne öffentliche Darstellung und mobile first,
- hierarchische konfigurierbare Ressourcen,
- wiederkehrende und einmalige Belegungen,
- Auslastung für Q1–Q4, Kunstrasen-Kleinfeld und Hallen,
- Suche nach zusammenhängenden freien Trainingsfenstern,
- Importvorschau und bestätigte Übernahme von Hallen-Sonderterminlisten,
- einmalige und wiederkehrende Sperrungen einzelner Quadranten oder übergeordneter Ressourcen,
- Konflikterkennung auch zwischen Teil- und Elternressourcen,
- keine unnötigen personenbezogenen Daten in der öffentlichen Ansicht,
- geschützte einfache Pflege statt klassischer WordPress-Backend-Arbeit,
- keine doppelte manuelle Pflege.

### Offene Discovery-Fragen

1. Wie werden Schönbornhalle und Ohrenberghalle real in Teilflächen belegt und welche Mannschaften trainieren im Winter wann in den Hallen bzw. auf dem Kunstrasen-Kleinfeld?
2. In welchem Dateiformat und mit welchen Spalten kommt die reale Hallen-Sonderterminliste?
3. Welche regulären Verfügbarkeitsfenster gelten je Quadrant, Kunstrasen und Halle für Außen- und Winterbetrieb?
4. Welcher konkrete Google-Kalender bildet heute welche Spiel-/Sonderbelegungen ab?
5. Wer darf Sondertermine und Sperrungen anlegen, bestätigen, ändern und aufheben?
6. Welche internen Informationen werden zusätzlich zur öffentlichen Sicht benötigt?
7. Welche Konflikte blockieren nur die Veröffentlichung und welche benötigen einen harten technischen Stopp?
8. Wie werden bestehende Kalenderdaten migriert oder kontrolliert abgelöst?
9. Wer übernimmt die fachliche Owner-Rolle?

### Noch keine Entscheidung

Noch nicht entschieden sind:

- Custom Post Types versus eigene Tabellen,
- konkrete technische Integrationsschnittstellen,
- Migrationsweg des aktuellen Kalenders,
- konkrete Rollen/Berechtigungen,
- finale UI-Komponenten.

Diese Punkte werden aus dem gemeinsamen Datenstandard und einem kleinen ersten Inkrement abgeleitet.

### Privacy Status

`Privacy Check durchgeführt – Maßnahmen im Zielbild berücksichtigt`

Wesentliche Regeln:

- kein direkter Google-Calendar-iframe als künftige Kernlösung,
- öffentliche Darstellung ohne persönliche Kontaktdaten,
- Rollen-/Berechtigungsprüfung für Pflege,
- externe APIs nur kontrolliert und dokumentiert,
- keine personenbezogenen Inhalte in unnötigen Logs.

### Next Action

1. Verfügbarkeitsfenster je Q1–Q4, Kunstrasen und Halle aufnehmen,
2. eine reale Hallen-Sonderterminliste als Importbeispiel sichern,
3. Rollen und Freigaben für Sperrungen festlegen,
4. lesende Schnittstellen zu Team Manager, Matchdaten und Event Planner konkretisieren,
5. danach das MVP aus `CAPACITY-AND-BLOCKING.md` in einem prüfbaren Inkrement umsetzen.

### Last Known Good

Kein Plugin-Code vorhanden. Außen- und Winterressourcen, führende Datenquellen sowie die Fachlogik für Auslastung, Sondertermine und Sperrungen sind dokumentiert; aktuelle Quelldaten enthalten noch markierte Klärungsfälle und werden nicht ungeprüft veröffentlicht.

## Relationship to other documents

- `README.md`
- `CAPACITY-AND-BLOCKING.md`
- `../team-manager/DATA-STANDARD.md`
- `../team-manager/SEASON-2026-27.md`
- `../team-manager/PROJECT-STATE.md`
- `../../decisions/ADR-0013-shared-team-identity-and-season-model.md`
- `../../design/homepage-standard.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../event-planner/PROJECT-STATE.md`

## Future Development

Der Project Portfolio Manager reconciliiert das Projekt nach Merge in `projects/PROJECT-PORTFOLIO.md`. Der nächste Projektstand entsteht nach Aufnahme der realen Verfügbarkeitsfenster und der ersten Hallen-Sonderterminliste.
