# WordPress Development Standard

## Purpose

Dieses Dokument definiert die verbindliche Arbeitsweise für Änderungen an WordPress-basierten Projekten der TuS Digital Organisation.

## Core Principle

Jede Änderung soll klein, überprüfbar, rückverfolgbar und möglichst risikoarm sein.

## Main Content

### 1. Vor der Änderung

Vor jeder Umsetzung wird geprüft:

- Was ist das konkrete gewünschte Verhalten?
- Was ist das überprüfbare Erfolgskriterium?
- Was ist der letzte dokumentierte Projektstand?
- Gibt es einen Last Known Good?
- Welche relevanten Entscheidungen wurden bereits getroffen?
- Welche Dateien und Komponenten sind betroffen?
- Gibt es bereits passende Funktionen oder Muster?
- Welche bestehenden Funktionen könnten unbeabsichtigt beeinflusst werden?
- Ist die Änderung rein lokal oder architekturrelevant?

Bei länger laufenden Projekten wird zuerst die jeweilige `PROJECT-STATE.md` gelesen.

Relevante ADRs und Standards werden nicht nur bei neuen Chats, sondern vor Richtungsentscheidungen erneut geprüft.

Bei architekturrelevanten Änderungen wird zusätzlich die Architecture Checklist angewendet.

### 2. Branch statt direkter Änderung auf `main`

Normale Entwicklungsarbeit erfolgt auf einem eigenen Branch.

Direkte Änderungen auf `main` sind nicht Teil des Standardprozesses.

### 3. Scope klein halten

Ein PR soll ein klar umrissenes Ziel verfolgen.

Unnötige Neben-Refactorings, kosmetische Umbauten oder zusätzliche Features werden vermieden, sofern sie nicht ausdrücklich Teil des Auftrags sind.

### 4. Iterationen und Fehlersuche

Bei unklarer Ursache gilt der `Iteration & Progress Standard`.

Insbesondere:

- eine Hypothese nach der anderen,
- jeder Versuch muss Erkenntnis erzeugen,
- nach zwei erfolglosen Versuchen ohne neuen Wissensstand wird die Umsetzung gestoppt und die Annahme überprüft,
- gegen den Last Known Good vergleichen, statt unkontrolliert weiterzubauen.

Bereits ausgeschlossene Wege werden nicht ohne neue belastbare Information wiederholt.

### 5. Bestehendes Verhalten respektieren

Bestehende Funktionen werden nicht stillschweigend verändert.

Wenn eine Änderung bestehendes Verhalten absichtlich ersetzt, muss dies im PR sichtbar beschrieben werden.

### 6. UI und Markenassets

Vor Änderungen an sichtbaren Oberflächen werden geprüft:

- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`

Bestehende TuS-UI-Muster werden wiederverwendet, bevor projektspezifische Varianten entstehen.

Offizielle Logos werden aus der zentralen freigegebenen Quelle übernommen und nicht nachgebaut oder eigenmächtig verändert.

### 7. Sicherheits- und Datenregeln

Besondere Aufmerksamkeit gilt:

- Eingabevalidierung,
- Ausgabe-Escaping,
- Berechtigungsprüfungen,
- Nonces bei schreibenden Aktionen,
- Datenbankzugriffen,
- Dateioperationen,
- externen Requests,
- personenbezogenen Daten.

Keine Datenmigration wird beiläufig als Nebeneffekt einer anderen Änderung eingeführt.

### 8. Datenbankänderungen

Schema- oder Migrationsänderungen benötigen einen klaren Migrationspfad.

Vor Umsetzung wird festgelegt:

- wie bestehende Daten erhalten bleiben,
- wie Fehler erkannt werden,
- ob ein Rollback möglich ist,
- wie die Änderung getestet wird.

Datenmigrationen mit möglichem Datenverlust benötigen menschliche Freigabe.

### 9. Tests

Tests richten sich nach Art und Risiko der Änderung.

Mindestens wird geprüft:

- funktioniert das neue Verhalten,
- funktionieren relevante bestehende Abläufe weiterhin,
- entstehen offensichtliche PHP-/WordPress-Fehler,
- verhält sich die Änderung mit leeren, ungültigen oder unerwarteten Eingaben sinnvoll.

Automatisierte Tests werden bevorzugt, wenn sie praktikabel sind. Manuelle Prüfungen werden dokumentiert, wenn keine geeignete Automatisierung vorhanden ist.

Ein Stand wird erst nach erfolgreicher Prüfung als neuer Last Known Good behandelt.

### 10. Pull Request

Jede relevante Änderung wird als PR vorbereitet.

Ein guter PR beschreibt knapp:

- Ziel,
- wesentliche Änderungen,
- durchgeführte Tests,
- bekannte Einschränkungen oder Risiken,
- notwendige Folgeschritte.

### 11. Review vor Merge

Der Entwickler bewertet seine eigene Änderung vor Übergabe noch einmal gegen:

- vereinbarten Scope,
- Core Principles,
- Stability & Simplicity,
- UI- und Markenstandards bei sichtbaren Änderungen,
- Sicherheitsrisiken,
- Definition of Done.

Merge in `main` benötigt menschliche Freigabe, sofern nicht ausdrücklich anders geregelt.

### 12. Dokumentation und Projekt-Checkpoint

Dokumentation wird aktualisiert, wenn die Änderung:

- Verhalten oder Bedienung dauerhaft verändert,
- Architektur oder Datenmodell beeinflusst,
- neue Abhängigkeiten schafft,
- neue wiederkehrende Entwicklungsregeln hervorbringt.

Bei länger laufenden Projekten wird `PROJECT-STATE.md` aktualisiert, wenn sich Ziel, Last Known Good, relevante Ausschlüsse, Entscheidungen, Risiken oder der nächste sinnvolle Schritt verändert haben.

Versionstexte oder Changelogs sollen nicht als Ersatz für belastbare Projektdokumentation dienen.

## Relationship to other documents

- `role.md`
- `../../standards/employee-operating-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../decisions/README.md`
- `../../decisions/architecture-checklist.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../architecture/stability-and-simplicity.md`

## Future Development

Dieser Standard wird aus realen WordPress-Projekten erweitert, etwa um konkrete Regeln für Datenmigrationen, Tests, Releases, Backups oder CI, sobald diese wiederkehrend benötigt werden.