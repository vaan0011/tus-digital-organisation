# ADR-0013 – Gemeinsame Mannschaftsidentität und saisonale Ausprägung

## Status

Accepted

## Date

2026-09-18

## Scope

Team Manager, Event Planner, Platzbelegung, Matchdaten-Modul, Mannschaftsseiten und alle künftigen Verbraucher von Mannschaftsdaten.

## Context

Mannschaften werden für öffentliche Mannschaftsseiten, Trainingszeiten, Platzbelegung, Spiele und Helferschichten benötigt. Trainer, Jahrgänge, Spielgemeinschaften, Trainingszeiten und externe Spielkennungen ändern sich jedoch saisonweise.

Die Plattformarchitektur verlangt, zentrale Objekte nur einmal zu definieren. Ohne eine gemeinsame Identität würden Event Planner, Team Manager und Platzbelegung parallele Mannschaftslisten erzeugen oder historische Saisonwerte überschreiben.

Die realen Saisonquellen 2026/27 zeigen zusätzlich, dass JSG-Zugehörigkeit und Trainingsort nicht aus der Altersklasse allein abgeleitet werden dürfen: Die männlichen A-, B- und C-Junioren bilden eine JSG aus drei Vereinen, trainieren aber regulär an unterschiedlichen Standorten. Die Juniorinnen gehören nicht automatisch zu dieser JSG.

## Decision

### 1. Zwei Ebenen

Das gemeinsame Modell trennt verbindlich:

- `team` als stabile saisonübergreifende Mannschaftsidentität,
- `team_season` als Mannschaftsausprägung in genau einer Saison.

Andere Module erfinden keine eigenen Mannschaftsidentitäten.

### 2. Saisonabhängige Daten

Mindestens folgende Informationen gehören zu `team_season` oder zu saisonbezogenen Beziehungen:

- öffentliche Bezeichnung,
- Alters-/Wettbewerbsklasse,
- Jahrgänge,
- JSG- und Vereinsbeteiligungen,
- Trainer- und Betreuerrollen,
- Trainingszeiten und Trainingsorte,
- externe Mannschaftskennungen,
- Veröffentlichungsstatus.

Historische Saisonwerte werden nicht rückwirkend überschrieben.

### 3. Referenzen anderer Module

- Event Planner referenziert für einen konkreten Event-/Helferkontext `team_season_id`.
- Platzbelegung liest Trainingsserien mit `team_season_id` und Ressourcenreferenzen.
- Matchdaten-Modul ordnet externe Mannschaften saisonbezogen über `team_season_id` zu.
- Mannschaftsseiten werden aus `team_season` gerendert.
- `team_id` dient für saisonübergreifende Suche, Historie und Fortschreibung.

### 4. JSG als Beziehung

Eine Spielgemeinschaft wird pro Saison über Beziehungen zwischen `team_season` und beteiligten Vereinen modelliert. Sie ist kein boolesches Feld an einer Altersklasse und keine feste Programmlogik.

Vereinsbeteiligung, federführender Verein, öffentliche Bezeichnung und Trainingsstandort bleiben getrennte Eigenschaften.

### 5. Personen und Ressourcen

Personen und Trainingsressourcen erhalten ebenfalls stabile IDs. Trainerrollen und Trainingseinheiten sind saisonbezogene Beziehungen.

Private Kontaktdaten werden nicht in öffentlichen Repository-Dateien oder öffentlichen Schnittstellen dupliziert. Veröffentlichungsfreigaben gelten je Datenfeld.

### 6. Technische Einführung

Die physische Speicherung darf für das erste Inkrement im Team Manager liegen. Andere Plugins verwenden eine definierte lesende Service-/Repository-Grenze und keine eigenen Kopien.

Eine spätere technische Extraktion in einen gemeinsamen Core ist zulässig, wenn stabile IDs und Verträge erhalten bleiben.

## Rationale

Die Entscheidung:

- verhindert parallele Mannschaftslisten,
- bewahrt historische Saisons,
- bildet JSG-Sonderfälle ohne Hardcoding ab,
- ermöglicht einen kontrollierten Saisonwechsel,
- verbindet Mannschaftsseiten, Training, Platzbelegung, Events und Matchdaten,
- erlaubt ein kleines erstes Plugin-Inkrement ohne sofort ein großes Core-Framework bauen zu müssen.

## Alternatives Considered

### Nur eine Mannschaftstabelle ohne Saisonobjekt

Verworfen, weil aktuelle Änderungen Trainer, Jahrgänge, JSG und Trainingszeiten historisch überschreiben würden.

### Eigene Mannschaftslisten je Plugin

Verworfen wegen Doppelpflege, unklarer Identitäten und nicht belastbarer Integrationen.

### JSG fest an A-, B- und C-Junioren programmieren

Verworfen, weil die Regel saison- und geschlechtsspezifisch ist und sich ändern kann.

### Vollständigen organisationsweiten Core vor dem Team Manager implementieren

Verworfen als unnötige Vorbedingung. Der fachliche Vertrag ist verbindlich; die erste physische Speicherung darf lokal beginnen.

## Consequences

- Der Team Manager führt stabile `team_id` und `team_season_id`.
- Saisonwechsel erzeugen neue Entwürfe statt bestehende Datensätze umzuschreiben.
- Event Planner, Platzbelegung und Matchdaten-Modul müssen dieselben IDs referenzieren.
- JSG-Beteiligungen und Trainingsorte werden konfigurierbar gespeichert.
- Ein Import aus aktuellen Saisonquellen benötigt Validierungs- und Freigabestatus.
- Öffentliche Trainerkontakte bleiben standardmäßig gesperrt.

## Reopen Conditions

Die Entscheidung wird nur neu bewertet, wenn:

- ein externer verbindlicher Vereinsstandard andere stabile Identitäten erzwingt,
- die Implementierung nachweislich keine tragfähige Servicegrenze ermöglicht,
- ein gemeinsam eingeführter Core einen gleichwertigen, migrationssicheren Vertrag bereitstellt.

Neue Saisonwerte oder geänderte JSG-Zusammensetzungen sind keine Reopen-Bedingung; sie werden als neue saisonale Daten gepflegt.

## Related Documents

- `../architecture/platform-architecture.md`
- `../projects/team-manager/DATA-STANDARD.md`
- `../projects/team-manager/SEASON-2026-27.md`
- `../projects/team-manager/FUNCTIONAL-SCOPE.md`
- `../projects/team-manager/PROJECT-STATE.md`
- `../projects/event-planner/FUNCTIONAL-SCOPE.md`
- `../projects/platzbelegung/README.md`
- `ADR-0012-team-manager-match-data-module.md`

## Supersedes / Superseded by

Keine.
