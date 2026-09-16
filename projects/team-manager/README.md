# TuS Team Manager

## Purpose

Dieses Projekt entwickelt das WordPress-basierte Mannschafts- und Trainingsmanagement des TuS Mingolsheim.

Es soll die heute verteilte manuelle Pflege von Mannschaftsseiten, Saisonangaben, Jahrgängen, Kontakten, Trainingszeiten, Trainingsorten, Spielankündigungen und Platzbelegungen durch eine zentrale fachliche Datenbasis ersetzen.

## Core Principle

**Mannschaftsdaten werden einmal zentral gepflegt und anschließend in allen benötigten Ansichten wiederverwendet.**

WordPress-Seiten, Trainingspläne und Spielankündigungen sollen keine voneinander unabhängigen Datenquellen sein.

Die öffentliche Homepage zeigt Daten aus dem zentralen Mannschaftsmodell an, statt dieselben Informationen auf vielen Seiten erneut manuell zu pflegen.

## Main Content

Verbindliches fachliches Zielbild:

`FUNCTIONAL-SCOPE.md`

Verbindliche Spezifikation des Matchdaten-Moduls:

`MATCH-DATA-MODULE.md`

Verbindlicher aktueller Projektstand:

`PROJECT-STATE.md`

Ein neuer Entwickler oder Coding-Chat liest vor Arbeitsbeginn mindestens:

1. `PROJECT-STATE.md`
2. `FUNCTIONAL-SCOPE.md`
3. `MATCH-DATA-MODULE.md`, wenn Matchdaten oder Homepage-Spiele betroffen sind
4. `../../roles/wordpress-developer/role.md`
5. `../../roles/wordpress-developer/development-standard.md`
6. `../../standards/iteration-and-progress.md`
7. `../../design/design-principles.md`
8. `../../design/ui-standard.md`
9. `../../design/logo.md`
10. relevante Einträge unter `../../decisions/`

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md` beschreibt den langfristig vorgesehenen Funktionsumfang.
- `PROJECT-STATE.md` beschreibt den aktuellen Entwicklungsstand und offene Architekturfragen.
- `MATCH-DATA-MODULE.md` definiert Import, lokales Matchmodell, Homepage-Block und die lesende Nutzung durch den Matchday Editor.
- Der Event Planner benötigt Mannschaften bereits für die Zuordnung von Helferschichten. Deshalb muss die gemeinsame Nutzung von Mannschaftsdaten vor der Implementierung architektonisch geklärt werden.
- Gemeinsame UI- und Branding-Regeln stehen unter `../../design/`.

## Future Development

Vor der eigentlichen Plugin-Implementierung werden das gemeinsame Mannschafts-Datenmodell und die Saisonlogik geklärt. Parallel wird der offizielle Sportmedia-Datenzugang in einem begrenzten Provider-Spike verifiziert. Erst danach entsteht das kleine erste Matchdaten-Inkrement gemäß `MATCH-DATA-MODULE.md`.
