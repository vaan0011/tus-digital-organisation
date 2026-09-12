# WordPress Development Standard

## Purpose

Dieses Dokument definiert die verbindliche Arbeitsweise für Änderungen an WordPress-basierten Projekten der TuS Digital Organisation.

## Core Principle

Jede Änderung soll klein, überprüfbar, rückverfolgbar und möglichst risikoarm sein.

## Main Content

### 1. Verbindliche Entwicklungsbasis

Vor konkreter Coding-Arbeit gelten organisationsweit:

- `../../standards/software-development-quality-standard.md`,
- `../../standards/data-persistence-and-database-standard.md`,
- `../../architecture/stability-and-simplicity.md`,
- bei sichtbaren Oberflächen `../../design/design-principles.md` und `../../design/ui-standard.md`,
- bei personenbezogenen Daten `../data-protection-manager/privacy-standard.md`.

Zusätzlich gelten die jeweils aktuellen offiziellen WordPress Coding Standards für PHP, JavaScript, CSS und HTML sowie die WordPress Security- und Accessibility-Grundsätze.

Projektspezifische Standards konkretisieren diese Basis, dürfen sie aber nicht stillschweigend abschwächen.

### 2. Vor der Änderung

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
- Welche dauerhaften Daten werden berührt und wo liegt deren Source of Truth?
- Welche Security-, Privacy-, Accessibility-, Responsive- und Performance-Auswirkungen besitzt die Änderung?

Bei länger laufenden Projekten wird zuerst die jeweilige `PROJECT-STATE.md` gelesen.

Relevante ADRs und Standards werden nicht nur bei neuen Chats, sondern vor Richtungsentscheidungen erneut geprüft.

Bei architekturrelevanten Änderungen wird zusätzlich die Architecture Checklist angewendet.

### 3. Branch statt direkter Änderung auf `main`

Normale Entwicklungsarbeit erfolgt auf einem eigenen Branch.

Direkte Änderungen auf `main` sind nicht Teil des Standardprozesses.

### 4. Scope klein halten

Ein PR soll ein klar umrissenes Ziel verfolgen.

Unnötige Neben-Refactorings, kosmetische Umbauten oder zusätzliche Features werden vermieden, sofern sie nicht ausdrücklich Teil des Auftrags sind.

### 5. Iterationen und Fehlersuche

Bei unklarer Ursache gilt der `Iteration & Progress Standard`.

Insbesondere:

- eine Hypothese nach der anderen,
- jeder Versuch muss Erkenntnis erzeugen,
- nach zwei erfolglosen Versuchen ohne neuen Wissensstand wird die Umsetzung gestoppt und die Annahme überprüft,
- gegen den Last Known Good vergleichen, statt unkontrolliert weiterzubauen.

Bereits ausgeschlossene Wege werden nicht ohne neue belastbare Information wiederholt.

### 6. Bestehendes Verhalten respektieren

Bestehende Funktionen werden nicht stillschweigend verändert.

Wenn eine Änderung bestehendes Verhalten absichtlich ersetzt, muss dies im PR sichtbar beschrieben werden.

### 7. UI, Accessibility und Markenassets

Vor Änderungen an sichtbaren Oberflächen werden geprüft:

- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- projektspezifische UI-/Homepage-Standards, wenn relevant.

Bestehende TuS-UI-Muster werden wiederverwendet, bevor projektspezifische Varianten entstehen.

Offizielle Logos werden aus der zentralen freigegebenen Quelle übernommen und nicht nachgebaut oder eigenmächtig verändert.

Neue oder wesentlich geänderte Oberflächen müssen auf relevanten Desktop-, Tablet- und Mobile-Viewports sowie auf zentrale Tastatur-/Fokus-/Accessibility-Pfade geprüft werden. WCAG 2.2 Level AA ist der Zielstandard für neue und geänderte TuS-UI.

### 8. Sicherheits-, Privacy- und Datenregeln

Der `Software Development Quality Standard` ist verbindlich.

Besondere Aufmerksamkeit gilt insbesondere:

- Eingabevalidierung und Sanitization,
- kontextgerechtem Ausgabe-Escaping,
- Berechtigungsprüfungen/Capabilities,
- Nonces/CSRF-Schutz bei schreibenden Aktionen,
- REST-`permission_callback`,
- vorbereiteten Datenbankzugriffen,
- Dateioperationen/Uploads,
- externen Requests und deren Fehlerpfaden,
- Secrets und Logs,
- personenbezogenen Daten.

Nonces ersetzen keine Berechtigungsprüfung.

Bei personenbezogenen Daten gilt zusätzlich der Privacy & Information Protection Standard.

### 9. Datenhaltung und Datenbankänderungen

Der `../../standards/data-persistence-and-database-standard.md` ist organisationsweit verbindlich.

Dauerhafte Fachdaten dürfen insbesondere nicht über Session-IDs, Browser-Sessions, Query-Parameter, Local/Session Storage, JavaScript-Runtime-State, Transients oder Caches als alleinige Source of Truth gehalten werden.

Schema- oder Migrationsänderungen benötigen einen klaren Migrationspfad.

Vor Umsetzung wird festgelegt:

- wie bestehende Daten erhalten bleiben,
- welche Source of Truth gilt,
- wie Fehler erkannt werden,
- ob ein Rollback oder sicherer Vorwärts-/Wiederherstellungsweg möglich ist,
- wie die Änderung mit repräsentativem Altbestand getestet wird,
- welche Indizes und Abfragepfade bei eigenen Tabellen tatsächlich benötigt werden.

Datenmigrationen mit möglichem Datenverlust benötigen menschliche Freigabe.

### 10. Performance und Abhängigkeiten

Performance wird bereits beim Design berücksichtigt.

Insbesondere werden vermieden:

- unnötige Datenbankabfragen in Schleifen,
- unlimitierte große Listen,
- externe synchrone Requests bei jedem Seitenaufruf ohne fachlichen Grund,
- global geladenes CSS/JavaScript für nur lokal benötigte Funktionen,
- große neue Bibliotheken für kleine Funktionen.

Caches dürfen Performance verbessern, sind aber keine fachliche Source of Truth.

WordPress-Core-/Browser-Funktionen werden bevorzugt, wenn sie den Bedarf robust erfüllen.

Für öffentliche Komponenten gelten die im Software Development Quality Standard beschriebenen Core-Web-Vitals-Ziele, sobald reale Messung möglich ist.

### 11. Tests

Tests richten sich nach Art und Risiko der Änderung.

Mindestens wird – soweit für den Scope relevant – geprüft:

- funktioniert das neue Verhalten,
- funktionieren relevante bestehende Abläufe weiterhin,
- entstehen offensichtliche PHP-/WordPress-Fehler,
- verhält sich die Änderung mit leeren, ungültigen oder unerwarteten Eingaben sinnvoll,
- funktionieren Berechtigungsgrenzen,
- bleiben dauerhafte Daten nach Reload/erneutem Öffnen erhalten,
- funktionieren Desktop/Tablet/Mobile,
- funktionieren zentrale Tastatur-/Fokuspfade,
- existiert ein sinnvoller Fallback bei externen Fehlern,
- funktionieren Migrationen mit repräsentativem Altbestand.

Automatisierte Tests, Syntax-/Lint-/statische Checks und WordPress Coding Standards werden bevorzugt, wenn sie praktikabel sind. WordPress Playground ist ein bevorzugtes reproduzierbares Testmedium.

Manuelle Prüfungen werden dokumentiert, wenn keine geeignete Automatisierung vorhanden ist.

Ein Agent behauptet keinen Test als `PASSED`, wenn er ihn nicht tatsächlich durchgeführt hat.

Ein Stand wird erst nach erfolgreicher Prüfung als neuer Last Known Good behandelt.

### 12. Pull Request

Jede relevante Änderung wird als PR vorbereitet.

Ein guter PR beschreibt knapp:

- Ziel,
- wesentliche Änderungen,
- durchgeführte Tests,
- Security-/Privacy-/Daten-/UI-Auswirkungen soweit relevant,
- bekannte Einschränkungen oder Risiken,
- notwendige Folgeschritte.

### 13. Review vor Merge

Der Entwickler bewertet seine eigene Änderung vor Übergabe noch einmal gegen:

- vereinbarten Scope,
- Core Principles,
- Software Development Quality Standard,
- Data Persistence & Database Standard,
- Stability & Simplicity,
- UI- und Markenstandards bei sichtbaren Änderungen,
- Accessibility und Responsive-Verhalten,
- Sicherheits- und Privacy-Risiken,
- Performance,
- Definition of Done.

Merge in `main` benötigt menschliche Freigabe, sofern nicht ausdrücklich anders geregelt.

### 14. Dokumentation und Projekt-Checkpoint

Dokumentation wird aktualisiert, wenn die Änderung:

- Verhalten oder Bedienung dauerhaft verändert,
- Architektur oder Datenmodell beeinflusst,
- neue Abhängigkeiten schafft,
- neue wiederkehrende Entwicklungsregeln hervorbringt.

Bei länger laufenden Projekten wird `PROJECT-STATE.md` aktualisiert, wenn sich Ziel, Last Known Good, relevante Ausschlüsse, Entscheidungen, Risiken oder der nächste sinnvolle Schritt verändert haben.

Versionstexte oder Changelogs sollen nicht als Ersatz für belastbare Projektdokumentation dienen.

## Relationship to other documents

- `role.md`
- `../../standards/software-development-quality-standard.md`
- `../../standards/data-persistence-and-database-standard.md`
- `../../standards/employee-operating-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../data-protection-manager/privacy-standard.md`
- `../../decisions/README.md`
- `../../decisions/architecture-checklist.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../architecture/stability-and-simplicity.md`

## Future Development

Die nächste technische Ausbaustufe ist keine weitere abstrakte Regel, sondern reproduzierbares Tooling zur Durchsetzung: WordPress Coding Standards/PHPCS, PHP-Syntaxchecks, Plugin Check und projektspezifische automatisierte Tests.

Solche Checks werden erst als Merge-Gate behandelt, wenn sie stabil und reproduzierbar im Repository laufen.