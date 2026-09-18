# Team Manager – Datenstandard

## Purpose

Dieses Dokument definiert das verbindliche fachliche Datenmodell für Mannschaften, Saisons, Personenrollen, Spielgemeinschaften, Trainingsstätten, Trainingsflächen und Trainingseinheiten.

Es bildet die gemeinsame Grundlage für Team Manager, Mannschaftsseiten, Trainingsübersicht, Platzbelegung, Event Planner und Matchdaten-Modul.

## Core Principle

> **Dauerhafte Identität und saisonale Ausprägung werden getrennt. Alle Verbraucher referenzieren dieselben stabilen IDs.**

Mannschaft, Person und Ressource werden nicht in mehreren Plugins erneut angelegt. Saisonabhängige Angaben werden versioniert und historische Daten nicht überschrieben.

## Main Content

### 1. Verbindliche Objekte

| Objekt | Zweck | Stabilität |
|---|---|---|
| `season` | Saison wie `2026/27` | dauerhaft |
| `club` | beteiligter Verein | dauerhaft |
| `team` | saisonübergreifende Mannschaftsidentität | dauerhaft |
| `team_season` | Mannschaft in genau einer Saison | saisonbezogen |
| `team_season_club` | Beteiligung eines Vereins an einer Mannschaftssaison | saisonbezogen |
| `person` | gemeinsame Personenidentität | dauerhaft |
| `team_staff_assignment` | Rolle einer Person bei einer Mannschaftssaison | saisonbezogen |
| `site` | Sportgelände, Halle oder externer Standort | dauerhaft |
| `resource` | Platz, Feld, Halle oder Teilfläche | dauerhaft/konfigurierbar |
| `training_series` | wiederkehrender Trainingstermin | saison- oder zeitraumbezogen |
| `training_series_team` | Zuordnung einer Trainingsserie zu einer oder mehreren Mannschaftssaisons | saisonbezogen |
| `training_exception` | Ausfall, Verlegung, Zusatztraining oder Flächentausch | einzelterminbezogen |

### 2. Mannschaft und Mannschaftssaison

`team` enthält nur saisonübergreifend stabile Angaben:

- stabile `team_id`,
- interne Grundbezeichnung,
- Bereich wie Herren, Frauen, Junioren oder Juniorinnen,
- Aktivstatus.

`team_season` enthält mindestens:

- stabile `team_season_id`,
- Referenz auf `team_id` und `season_id`,
- öffentliche Bezeichnung,
- Alters- und Wettbewerbsklasse,
- Jahrgänge,
- Organisationsform `club_team` oder `joint_team`,
- Veröffentlichungsstatus,
- optional externe Kennungen für den Spielbetrieb.

Format der ID:

- `team_id`: sprechender, saisonunabhängiger Slug, zum Beispiel `herren-1` oder `b-juniorinnen`;
- `team_season_id`: `<team_id>--<saisonstart>-<saisonende>`, zum Beispiel `herren-1--2026-27`.

Eine saisonale Änderung von Trainerstab, Trainingsort, JSG-Beteiligung oder öffentlichem Namen verändert nicht die `team_id`.

### 3. Spielgemeinschaften

Eine JSG ist keine fest programmierte Eigenschaft einer Altersklasse. Sie wird pro `team_season` modelliert.

`team_season_club` enthält:

- `team_season_id`,
- `club_id`,
- Beteiligungsrolle,
- optionale Reihenfolge für die öffentliche Bezeichnung,
- optional federführender Verein,
- Gültigkeitsstatus.

Trainingsort und Vereinsbeteiligung sind getrennte Sachverhalte. Eine JSG kann aus mehreren Vereinen bestehen und dennoch regulär an nur einem Partnerstandort trainieren.

Für Saison 2026/27 gilt die konkrete Belegung in `SEASON-2026-27.md`.

### 4. Personen und Trainerrollen

Personen werden über eine stabile `person_id` referenziert. Eine Person kann in derselben Saison mehrere Rollen oder Mannschaften haben.

Zulässige Rollen für den ersten Stand:

- `head_coach`,
- `coach`,
- `assistant_coach`,
- `goalkeeper_coach`,
- `coordinator`,
- `team_manager`,
- `contact_person`.

Die Originalbezeichnung der Quelle wird zusätzlich erhalten, damit zum Beispiel `Chef-Trainer`, `Trainer`, `Co-Trainer` und `TW-Trainer` nachvollziehbar bleiben.

Für Name, Telefonnummer und E-Mail gelten getrennte Freigaben:

- `publish_name`,
- `publish_phone`,
- `publish_email`.

Alle Freigaben sind standardmäßig `false`. Eine öffentliche Ausgabe erfolgt nur nach dokumentierter Freigabe. Private Kontaktdaten werden weder in diesem öffentlichen Repository noch in öffentlichen API-Antworten gespeichert.

### 5. Ressourcenhierarchie

Eine Trainingsstätte wird hierarchisch modelliert:

`site` → `resource` → optionale Teilressource.

Beispiel:

- TuS-Sportgelände
  - Hauptplatz
  - Trainingsfeld 1
    - Quadrant 1
    - Quadrant 2
  - Trainingsfeld 2
    - Quadrant 3
    - Quadrant 4

Die Belegung von `Quadrant 1` und `Quadrant 2` belegt abgeleitet das gesamte `Trainingsfeld 1`. Aggregierte Felder werden nicht zusätzlich als unabhängige Buchung gepflegt.

Ressourcen besitzen mindestens:

- stabile `resource_id`,
- Referenz auf Standort und optional übergeordnete Ressource,
- internen und öffentlichen Namen,
- Ressourcentyp,
- Aktivstatus,
- Sortierreihenfolge.

### 6. Trainingseinheiten

`training_series` enthält mindestens:

- `training_series_id`,
- Wochentag,
- lokale Start- und Endzeit,
- Zeitzone `Europe/Berlin`,
- Gültig-von und Gültig-bis oder Saisonbezug,
- eine oder mehrere `resource_id`,
- Status `draft`, `confirmed`, `conflict` oder `cancelled`,
- interne Quelle und Verifikationsdatum,
- optionale öffentliche Hinweise.

Eine Trainingsserie referenziert über `training_series_team` mindestens eine `team_season_id`. Trainieren mehrere Mannschaften gemeinsam, wird eine gemeinsame Serie mit mehreren Mannschaftsreferenzen gespeichert. Dadurch entsteht weder eine künstliche Mannschaft noch ein falscher Ressourcenkonflikt.

Mehrere Quadranten werden als mehrere Ressourcenreferenzen gespeichert, nicht als Text `1+2`.

Eine `training_exception` referenziert die Serie und beschreibt genau einen Termin als:

- `cancelled`,
- `moved`,
- `additional`,
- `resource_changed`.

### 7. Konfliktprüfung

Vor Bestätigung einer Trainingsserie wird geprüft:

1. Start liegt vor Ende.
2. Alle Ressourcen sind im Zeitraum aktiv.
3. Kind- und Elternressource werden nicht widersprüchlich parallel belegt.
4. Zwei bestätigte Serien belegen nicht dieselbe Ressource zur selben Zeit.
5. JSG-Trainingsort und saisonale Standortregel widersprechen sich nicht.
6. Eine öffentliche Trainingszeit ist nur sichtbar, wenn Mannschaftssaison und Serie veröffentlicht sind.

Ein erkannter Konflikt wird nicht stillschweigend überschrieben. Der Datensatz erhält `conflict` und benötigt fachliche Klärung.

### 8. Saisonwechsel

Der Saisonwechsel erzeugt neue `team_season`-Datensätze und kopiert vorhandene Strukturen nur als Entwurf.

Automatisch vorgeschlagen werden dürfen:

- fortgeschriebene Jahrgänge,
- Vorjahres-Trainerrollen,
- Vorjahres-Trainingsserien,
- Vorjahres-JSG-Beteiligungen,
- externe Mannschaftszuordnungen.

Vor Veröffentlichung werden alle Vorschläge einzeln bestätigt. Historische Datensätze bleiben unverändert.

### 9. Verbraucher und Verantwortungsgrenzen

- Team Manager besitzt Mannschaft, Mannschaftssaison, Rollen, Trainingsserien und Trainingsressourcen.
- Platzbelegung liest Trainingsserien und kombiniert sie mit Spielen, Events, Sperrungen und Sonderbelegungen.
- Event Planner referenziert bei konkreten Veranstaltungen `team_season_id`; `team_id` dient nur zur saisonübergreifenden Suche.
- Matchdaten-Modul referenziert `team_season_id` und saisonale externe Kennungen.
- Homepage und Theme speichern keine Kopien dieser Daten.

Die physische Speicherung kann zunächst im Team Manager liegen. Andere Module greifen über eine stabile lesende Service-/Repository-Grenze zu; sie führen keine eigene Mannschaftsliste.

### 10. Quellen- und Qualitätsstatus

Jeder importierte Datensatz speichert intern:

- Quelltyp und Quellreferenz,
- Import- oder Erfassungszeitpunkt,
- letzten fachlichen Prüftermin,
- Status `source_only`, `needs_review`, `confirmed` oder `rejected`,
- optionalen Prüfhinweis.

Eine Scandatei wird nicht allein durch OCR zur bestätigten Wahrheit. Visuelle Informationen wie rote Quadrantenzuordnungen werden fachlich geprüft.

### 11. Datenschutz und Repository-Regel

Dieses Repository darf enthalten:

- Datenmodell und Regeln,
- Mannschafts- und Ressourcen-IDs,
- öffentliche oder nicht personenbezogene Saisonfakten,
- Prüfhinweise ohne private Kontaktdaten.

Dieses Repository darf nicht enthalten:

- private Telefonnummern,
- private E-Mail-Adressen,
- nicht freigegebene personenbezogene Notizen,
- Zugangsdaten.

Die Trainerliste auf Google Drive ist operative Quelle, aber keine Freigabe zur öffentlichen Veröffentlichung aller enthaltenen Kontaktdaten.

## Relationship to other documents

- `README.md`
- `FUNCTIONAL-SCOPE.md`
- `SEASON-2026-27.md`
- `PROJECT-STATE.md`
- `MATCH-DATA-MODULE.md`
- `../../decisions/ADR-0013-shared-team-identity-and-season-model.md`
- `../platzbelegung/README.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../../architecture/platform-architecture.md`

## Future Development

Der Standard wird nach dem ersten realen Import in ein konkretes technisches Schema überführt. Feldnamen oder Speichertabellen dürfen technisch angepasst werden, solange Identitäten, Saisongrenzen, Datenschutzregeln und Verantwortungsgrenzen erhalten bleiben.
