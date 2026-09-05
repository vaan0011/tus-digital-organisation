# Team Manager – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für den TuS Team Manager.

Sie hält den aktuellen Stand, offene Vorentscheidungen, bekannte Risiken und den nächsten sinnvollen Schritt fest.

## Core Principle

Vor der Plugin-Implementierung werden die fachlichen und architektonischen Grundlagen so weit geklärt, dass keine zweite Mannschaftsdatenwelt entsteht und saisonale Daten später historisch verlässlich bleiben.

## Main Content

### Current Goal

Das neue Projekt wird fachlich abgegrenzt und auf eine belastbare erste Architekturentscheidung vorbereitet.

Der aktuelle Schritt ist ausschließlich Dokumentation und Vorstrukturierung. Es existiert noch kein Team-Manager-Plugin-Code.

### Verified

- Im Repository gab es vor diesem Projekt noch kein eigenes Team-/Mannschaftsprojekt.
- Der langfristige fachliche Funktionsumfang ist in `FUNCTIONAL-SCOPE.md` dokumentiert.
- Mannschaftsdaten werden auch außerhalb dieses zukünftigen Plugins benötigt: Der Event Planner soll Helferschichten Mannschaften oder Abteilungen zuweisen können.
- Saison, Jahrgänge, Trainer/Kontakte, Trainingszeiten, Trainingsorte und externe Spielzuordnungen sind teilweise saisonabhängig und dürfen historische Saisons nicht rückwirkend überschreiben.
- Trainingszeiten und Platz-/Hallenbelegung sollen aus derselben Datenquelle erzeugt werden.

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

6. **fussball.de:**
   Der gewünschte automatisierte Spielimport ist fachlich gesetzt. Der technische Zugriffsweg ist noch nicht entschieden und muss auf Stabilität, Zulässigkeit und Wartbarkeit geprüft werden.

7. **Homepage-Integration:**
   Die öffentliche Ausgabe soll dynamisch aus zentralen Daten entstehen. Ob dies über eigene Seiten, Templates, Blöcke oder Shortcodes erfolgt, wird erst nach Datenmodell und bestehender Homepage-Architektur entschieden.

### Excluded / Not Yet Decided

- Kein Scraping von fussball.de wird ungeprüft als Architekturstandard festgelegt.
- Es werden nicht parallel eigene Mannschaftslisten im Event Planner und Team Manager aufgebaut.
- WordPress-Seiten werden nicht als fachliche Hauptdatenquelle für Mannschaftsdaten verwendet.
- Es wird noch kein großes kombiniertes Plugin-Inkrement begonnen, bevor die offenen Architekturfragen geklärt sind.

### Active Development

Branch:

`team-manager/initial-scope`

Scope:

- Projekt anlegen,
- fachliches Zielbild dokumentieren,
- offene Architekturfragen sichtbar machen.

Keine funktionale Änderung an produktivem Code.

### Next Meaningful Step

1. diesen initialen Scope fachlich bestätigen,
2. gemeinsame Mannschaftsidentität mit Event Planner gegen die Plattformarchitektur prüfen,
3. einfaches Mannschaft/Saison-Datenmodell entwerfen,
4. danach Altersklassen-/Jahrgangslogik und Trainingsressourcen konkretisieren,
5. parallel die technische Integrationsmöglichkeit von fussball.de untersuchen,
6. erst dann das erste kleine Plugin-Inkrement definieren.

## Relationship to other documents

- `README.md`
- `FUNCTIONAL-SCOPE.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../../architecture/platform-architecture.md`
- `../../architecture/stability-and-simplicity.md`
- `../../standards/iteration-and-progress.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/ui-standard.md`

## Future Development

Sobald eine Architekturentscheidung zur gemeinsamen Mannschaftsidentität getroffen und dokumentiert ist, wird dieser Projektstand auf das erste konkrete, kleine Entwicklungsziel aktualisiert.
