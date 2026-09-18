# TuS Team Manager

## Purpose

Dieses Projekt entwickelt das WordPress-basierte Mannschafts- und Trainingsmanagement des TuS Mingolsheim.

Es ersetzt die verteilte manuelle Pflege von Mannschaftsseiten, Saisonangaben, Jahrgängen, Kontakten, Trainingszeiten, Trainingsorten, Spielankündigungen und Platzbelegungen durch eine zentrale fachliche Datenbasis.

## Core Principle

**Mannschaftsdaten werden einmal zentral gepflegt und anschließend in allen benötigten Ansichten wiederverwendet.**

WordPress-Seiten, Trainingspläne, Platzbelegung und Spielankündigungen sind keine voneinander unabhängigen Datenquellen.

## Main Content

Verbindliches fachliches Zielbild:

`FUNCTIONAL-SCOPE.md`

Verbindlicher Datenstandard für Mannschaft, Saison, Rollen, Ressourcen und Training:

`DATA-STANDARD.md`

Strukturierter, nicht personenbezogener Saisonstand 2026/27:

`SEASON-2026-27.md`

Verbindliche Spezifikation des Matchdaten-Moduls:

`MATCH-DATA-MODULE.md`

Verbindlicher aktueller Projektstand:

`PROJECT-STATE.md`

Ein neuer Entwickler oder Coding-Chat liest vor Arbeitsbeginn mindestens:

1. `PROJECT-STATE.md`
2. `DATA-STANDARD.md`
3. `SEASON-2026-27.md`, wenn Mannschaften, Training, Ressourcen oder Seed-Daten betroffen sind
4. `FUNCTIONAL-SCOPE.md`
5. `MATCH-DATA-MODULE.md`, wenn Matchdaten oder Homepage-Spiele betroffen sind
6. `../../decisions/ADR-0013-shared-team-identity-and-season-model.md`
7. `../../roles/wordpress-developer/role.md`
8. `../../roles/wordpress-developer/development-standard.md`
9. `../../standards/iteration-and-progress.md`
10. `../../design/design-principles.md`
11. `../../design/ui-standard.md`
12. `../../design/logo.md`
13. weitere relevante Einträge unter `../../decisions/`

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md` beschreibt den langfristig vorgesehenen Funktionsumfang.
- `DATA-STANDARD.md` definiert den gemeinsamen fachlichen Vertrag und die Datenschutzgrenzen.
- `SEASON-2026-27.md` hält die aus den aktuellen Quellen gelesenen Saisonfakten und offenen Datenklärungen fest.
- `PROJECT-STATE.md` beschreibt den aktuellen Entwicklungsstand und den nächsten sinnvollen Schritt.
- `MATCH-DATA-MODULE.md` definiert Import, lokales Matchmodell, Homepage-Block und die lesende Nutzung durch den Matchday Editor.
- `ADR-0013` entscheidet die gemeinsame Mannschaftsidentität und die Trennung von Mannschaft und Mannschaftssaison.
- Der Event Planner referenziert dieselbe Mannschaftssaison für Helferschichten.
- Die Platzbelegung liest Trainingsserien und Ressourcen aus diesem Projekt, statt Trainingszeiten nochmals zu pflegen.
- Gemeinsame UI- und Branding-Regeln stehen unter `../../design/`.

## Future Development

Vor funktionalem Plugin-Code werden die in `SEASON-2026-27.md` markierten Widersprüche geklärt und bestätigte Seed-Daten vorbereitet. Danach entsteht ein kleines vertikales Inkrement aus Mannschaftssaison, Trainingsressourcen, Trainingsserie, Konfliktprüfung und lesender Trainingsübersicht. Der Sportmedia-Provider-Spike für Matchdaten kann parallel weiterlaufen.
