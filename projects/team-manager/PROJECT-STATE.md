# Team Manager – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für den TuS Team Manager.

Sie hält den aktuellen Stand, offene Vorentscheidungen, bekannte Risiken und den nächsten sinnvollen Schritt fest.

## Core Principle

Vor der Plugin-Implementierung werden die fachlichen und architektonischen Grundlagen so weit geklärt, dass keine zweite Mannschaftsdatenwelt entsteht und saisonale Daten später historisch verlässlich bleiben.

## Main Content

### Current Goal

Die gemeinsame Mannschaftsidentität und das Saisonmodell werden konkretisiert. Parallel wird das erste abgegrenzte Plugin-Modul vorbereitet: automatisierter Matchdaten-Import, lokale Projektion und gemeinsame Nutzung durch Homepage und Matchday Editor.

Es existiert noch kein Team-Manager-Plugin-Code. Die Matchdaten-Architektur ist in `ADR-0012` und `MATCH-DATA-MODULE.md` verbindlich festgelegt.

### Verified

- Im Repository gab es vor diesem Projekt noch kein eigenes Team-/Mannschaftsprojekt.
- Der langfristige fachliche Funktionsumfang ist in `FUNCTIONAL-SCOPE.md` dokumentiert.
- Der initiale Projektscope wurde über PR #17 nach `main` übernommen.
- Mannschaftsdaten werden auch außerhalb dieses zukünftigen Plugins benötigt: Der Event Planner soll Helferschichten Mannschaften oder Abteilungen zuweisen können.
- Saison, Jahrgänge, Trainer/Kontakte, Trainingszeiten, Trainingsorte und externe Spielzuordnungen sind teilweise saisonabhängig und dürfen historische Saisons nicht rückwirkend überschreiben.
- Trainingszeiten und Platz-/Hallenbelegung sollen aus derselben Datenquelle erzeugt werden.
- FUSSBALL.DE bietet laut offizieller FAQ derzeit keine direkte API an und verweist für automatisierte Datenlieferungen auf Sportmedia per SFTP.
- `ADR-0012` legt das Matchdaten-Modul als Bestandteil des Team Managers fest; der Matchday Editor wird lesender Verbraucher und nicht Homepage-Datenquelle.

### Open

Vor dem ersten funktionalen Code müssen mindestens folgende Punkte geklärt werden:

1. **Gemeinsame Mannschaftsidentität:**
   Soll `Mannschaft` als gemeinsam nutzbares Kernobjekt bereitgestellt werden, damit Event Planner und Team Manager dieselben Mannschaften referenzieren?

2. **Saisonmodell:**
   Welche Angaben gehören zur dauerhaften Mannschaft und welche zu einer saisonbezogenen Mannschaftsausprägung?

3. **Altersklassen/Jahrgänge:**
   Die automatische Fortschreibung soll regelbasiert erfolgen. Das vollständige Regelwerk für alle relevanten Jugendklassen muss vor Implementierung verifiziert werden.

4. **Kontakte/Personen:**
   Es muss entschieden werden, ob Trainer/Betreuer zunächst innerhalb des Team Managers gepflegt oder später aus einer gemeinsamen Personen-/Kontaktquelle referenziert werden. Öffentliche Freigabe personenbezogener Daten ist getrennt zu behandeln.

5. **Trainingsressourcen:**
   Die konkreten TuS-Teilflächen/Quadranten, externe Trainingsstätten, Winterstätten und Hallenzeit-Logik müssen als einfache konfigurierbare Ressourcen modelliert werden.

6. **Sportmedia-Datenlieferung:**
   Der bevorzugte Transportweg ist identifiziert. Offen sind Kontakt, Zugang, Bedingungen, mögliche Kosten, reales Dateiformat, Lieferfrequenz, Feldbelegung und Statuswerte. Diese Punkte werden im Provider-Spike aus `MATCH-DATA-MODULE.md` verifiziert.

7. **Homepage- und Matchday-Schnittstellen:**
   Die Verantwortungsgrenze ist durch `ADR-0011` und `ADR-0012` festgelegt. Offen bleibt der konkrete Block- und Read-only-Vertrag nach Abschluss von Mannschafts-/Saisonmodell und Provider-Spike.

### Excluded / Not Yet Decided

- Kein Scraping von fussball.de wird ungeprüft als Architekturstandard festgelegt.
- Saisonale FUSSBALL.DE-Widget-Codes werden nicht zur Zielarchitektur.
- Der Matchday Editor und `season-state.md` werden nicht zur öffentlichen Matchdatenbank.
- Es werden nicht parallel eigene Mannschaftslisten im Event Planner und Team Manager aufgebaut.
- WordPress-Seiten werden nicht als fachliche Hauptdatenquelle für Mannschaftsdaten verwendet.
- Es wird noch kein großes kombiniertes Plugin-Inkrement begonnen, bevor die offenen Architekturfragen geklärt sind.

### Active Development

Aktiver Dokumentationsbranch `team-manager/match-data-module-decision`. Funktionaler Plugin-Code wurde noch nicht begonnen.

### Next Meaningful Step

1. gemeinsame Mannschaftsidentität mit Event Planner gegen die Plattformarchitektur prüfen,
2. einfaches Mannschaft-/Saisonmodell einschließlich Team-Saison-ID entwerfen,
3. parallel Sportmedia kontaktieren und repräsentative Beispieldaten sowie Bedingungen sichern,
4. Provider-Spike und Matchmapping gegen die Beispieldaten durchführen,
5. danach das erste kleine Matchdaten-Inkrement aus `MATCH-DATA-MODULE.md` umsetzen.

## Relationship to other documents

- `README.md`
- `FUNCTIONAL-SCOPE.md`
- `MATCH-DATA-MODULE.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../../architecture/platform-architecture.md`
- `../../architecture/stability-and-simplicity.md`
- `../../standards/iteration-and-progress.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/ui-standard.md`
- `../homepage/FUSSBALL-DE-INTEGRATION.md`
- `../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md`
- `../../decisions/ADR-0012-team-manager-match-data-module.md`

## Future Development

Nach Abschluss des Mannschafts-/Saisonmodells und des Sportmedia-Provider-Spikes wird dieser Projektstand auf das erste testbare Matchdaten-Inkrement aktualisiert.