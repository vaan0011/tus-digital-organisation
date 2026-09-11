# Project State – TuS Platzbelegung

## Purpose

Dieses Dokument hält den aktuellen belastbaren Stand des Projekts `TuS Platzbelegung` fest und dient als Einstiegspunkt für WordPress Developer, Portfolio Manager und Datenschutzrolle.

## Core Principle

> **Keine neue Kalenderinsel bauen. Erst reale Belegungsquellen verstehen, dann das kleinste robuste Plugin umsetzen.**

## Main Content

### Status

`Discovery`

### Ausgangslage

- Die aktuelle Homepage besitzt eine Seite `Platzbelegung`.
- Der Spielbetrieb wird dort derzeit über einen direkten Google-Calendar-iframe dargestellt.
- Trainings- und Winterbelegungen werden teilweise über statische Bilder dargestellt.
- Der Nutzer hat am 11.09.2026 entschieden, dass Platzbelegung künftig als **eigenes WordPress-Plugin** auf der Homepage umgesetzt werden soll.
- Direkte Google-iframes sind für den Neuaufbau kein Zielbild.

### Ziel

Ein eigenes TuS-Plugin stellt Platz- und Hallenbelegungen im TuS-Design dar und kann perspektivisch Daten aus fachlich führenden Systemen übernehmen.

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

### Aktuell bekannte Anforderungen

- eigenes Plugin, keine bloße Seite mit eingebettetem externem Kalender,
- moderne öffentliche Darstellung,
- mobile first,
- Ressourcen konfigurierbar,
- wiederkehrende Trainingsbelegungen,
- einmalige Spiele / Veranstaltungen / Sonderbelegungen,
- keine unnötigen personenbezogenen Daten in der öffentlichen Ansicht,
- geschützte einfache Pflege statt klassischer WordPress-Backend-Arbeit,
- Integrationsfähigkeit mit Team Manager, Event Planner und Spielplandaten,
- keine doppelte manuelle Pflege, wenn eine führende Quelle vorhanden ist.

### Offene Discovery-Fragen

1. Welche Plätze und Hallen müssen tatsächlich geführt werden?
2. Wo werden Trainingszeiten heute verbindlich gepflegt?
3. Welcher konkrete Google-Kalender bzw. welche Kalender bilden aktuell den Spielbetrieb ab?
4. Wer ändert heute Belegungen und mit welchem Prozess?
5. Welche Informationen müssen öffentlich sichtbar sein?
6. Welche internen Informationen werden zusätzlich benötigt?
7. Welche Konfliktprüfung wird für V1 benötigt?
8. Welche Daten können aus `fussball.de` bzw. dem Matchday-/Team-Kontext übernommen werden?
9. Welche Veranstaltungen müssen aus dem Event Planner Belegungen erzeugen?
10. Soll der bestehende Google-Kalender migriert, vorübergehend serverseitig synchronisiert oder vollständig ersetzt werden?

### Noch keine Entscheidung

Noch nicht entschieden sind:

- konkretes WordPress-Datenmodell,
- Custom Post Types vs. eigene Tabellen,
- genaue Integrationsschnittstellen,
- Migrationsweg des aktuellen Kalenders,
- konkrete Rollen/Berechtigungen,
- finale UI-Komponenten.

Diese Punkte werden nicht vor der Discovery künstlich festgelegt.

### Privacy Status

`Privacy Check durchgeführt – Maßnahmen im Zielbild berücksichtigt`

Wesentliche Regeln:

- kein direkter Google-Calendar-iframe als künftige Kernlösung,
- öffentliche Darstellung ohne persönliche Kontaktdaten,
- Rollen-/Berechtigungsprüfung für Pflege,
- externe APIs nur kontrolliert und dokumentiert,
- keine personenbezogenen Inhalte in unnötigen Logs.

### Next Action

1. reale Ressourcenliste und aktuelle Belegungsquellen aufnehmen,
2. bestehenden Google-Kalender-/Bildprozess technisch und fachlich dokumentieren,
3. minimale V1-Datenobjekte definieren,
4. Integrationsgrenzen zu Team Manager, Event Planner und Spielplan festlegen,
5. daraus einen kleinen ersten Implementierungs-Scope für den WordPress Developer erstellen.

### Last Known Good

Kein Plugin-Code vorhanden. Aktuell existiert nur die bestehende öffentliche Platzbelegungsseite als Referenz für den Ist-Prozess.

## Relationship to other documents

- `README.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../event-planner/PROJECT-STATE.md`
- `../team-manager/PROJECT-STATE.md`

## Future Development

Der Project Portfolio Manager reconciliiert das Projekt nach Merge in `projects/PROJECT-PORTFOLIO.md`.

Der Projektzustand wird aktualisiert, sobald Datenquelle, Ressourcenmodell oder V1-Scope belastbar entschieden sind.
