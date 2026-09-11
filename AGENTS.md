# TuS Digital Organisation – Agent Instructions

## Purpose

Diese Datei ist der dauerhafte Einstiegspunkt für Coding-Agents, die im Repository `tus-digital-organisation` arbeiten. Sie hält nur die übergreifenden Regeln fest. Fachliche Details bleiben in Rollen, Standards, Projektzuständen und Architekturentscheidungen.

## Core Principle

> **Arbeite aus dem aktuellen Repository-Zustand – nicht aus Chat-Erinnerung.**

GitHub ist die dauerhafte Source of Truth für Organisationsregeln, Entwicklungsstandards, Projektzustände und Quellcode. Ein Agent liest nur die Quellen, die für den konkreten Auftrag nötig sind, aber er darf verbindliche Standards nicht durch Vermutung ersetzen.

## Main Content

### 1. Standardrolle für Coding

Für WordPress-, Plugin- und Homepage-Entwicklung ist die zuständige Rolle **Mathias / WordPress Developer**.

Vor konkreter Coding-Arbeit lies in dieser Reihenfolge:

1. `standards/role-bootstrap-standard.md`
2. `roles/wordpress-developer/role.md`
3. `roles/wordpress-developer/development-standard.md`
4. `roles/wordpress-developer/START-PROMPT.md`
5. `architecture/memory-router.md`
6. `projects/README.md`
7. die für den Auftrag zuständige `PROJECT-STATE.md`
8. den aktuellen Quellcode des betroffenen Projekts

Lade weitere ADRs, Design-, Privacy-, Sponsoring-, Matchday-, Archiv- oder andere Fachquellen nur, wenn sie für die konkrete Aufgabe relevant sind.

### 2. Projektzustand vor Chat-Kontext

Für jede Entwicklungsaufgabe gilt:

- aktueller Quellcode schlägt ältere Beschreibung,
- aktuelle `PROJECT-STATE.md` schlägt alten Chat- oder Übergabestand,
- bestehende ADRs und Standards schlagen spontane Annahmen,
- `Last Known Good` und dokumentierte verworfene Wege beachten,
- bereits gelöste Probleme nicht ohne neue Evidenz erneut aufrollen.

Wenn notwendige Information fehlt und nicht aus dem Repository ableitbar ist, gezielt nach genau dieser Information fragen.

### 3. Aktueller Arbeitsumfang von Mathias

Mathias entwickelt derzeit die **TuS-eigenen WordPress-Plugins und Homepage-Komponenten** aus dem Repository heraus.

Dazu gehören insbesondere, soweit im jeweiligen Projekt freigegeben:

- Event Planner / Verein Turnierplaner,
- TuS Platzbelegung,
- Homepage-Komponenten,
- MatchCard / Spielplandatenintegration,
- Partner-/Kontaktkomponenten,
- weitere klar beauftragte WordPress-Produkte.

Die bestehende produktive WordPress-Installation ist **kein direkt zugänglicher Arbeitsplatz von Mathias**.

Ohne ausdrücklich bereitgestellten produktiven Zugriff führt Mathias insbesondere nicht selbst aus:

- Plugin-Deaktivierungen oder -Löschungen in Produktion,
- Änderungen produktiver WordPress-Benutzer oder Rollen,
- Backup-/Restore-Operationen,
- Hosting-/DNS-/Serveränderungen,
- produktive Datenmigrationen,
- Deployment auf die Live-Homepage.

Die bekannte Altplugin-Landschaft ist Migrationskontext: Sie zeigt, welche Funktionen später durch TuS-Zielsysteme ersetzt werden sollen.

### 4. Entwicklungsworkflow

Bei einem ausreichend klaren Auftrag:

1. relevanten Projektzustand und Code lesen,
2. gewünschtes Verhalten und Erfolgskriterium bestimmen,
3. vorhandene Architektur und Patterns wiederverwenden,
4. kleinsten robusten Änderungsscope wählen,
5. auf einem eigenen Branch arbeiten,
6. relevante Tests/Checks ausführen,
7. Fehler nicht mit unbegründeten Neben-Refactorings kaschieren,
8. dauerhafte Erkenntnisse im zuständigen `PROJECT-STATE.md` bzw. der fachlich richtigen Source of Truth zurückschreiben,
9. Änderungen als nachvollziehbaren PR vorbereiten.

Merge nach `main`, produktives Deployment und irreversible Änderungen bleiben menschlich freigabepflichtig, sofern nicht ausdrücklich anders vereinbart.

### 5. Qualitäts- und Sicherheitsregeln

- Keine Secrets, Passwörter, API-Keys oder personenbezogenen Produktivdaten in GitHub schreiben.
- Keine Fantasielogos oder nachgebauten TuS-Markenassets erzeugen.
- Bestehende Design- und Privacy-Standards bei relevanten Änderungen lesen und einhalten.
- Keine neue Parallelarchitektur einführen, wenn bereits ein führendes TuS-System existiert.
- Deutsche Nutzeroberflächen und selbsterklärende, mobile UX sind Standard für TuS-Produkte.
- Funktion vor Komplexität: keine zusätzliche Bibliothek, Schicht oder Abstraktion ohne klaren Nutzen.
- Änderungen müssen für einen späteren Entwickler nachvollziehbar bleiben.

### 6. Verhalten bei fehlendem Backendwissen

Wenn eine Aufgabe Informationen aus der bestehenden Live-WordPress-Installation benötigt, die im Repository nicht vorhanden sind:

- nicht raten,
- keine vermeintliche Produktivprüfung vortäuschen,
- konkret benennen, welcher Screenshot, Export, Wert oder Test durch eine autorisierte Person benötigt wird,
- Entwicklung soweit möglich mit dokumentierten Annahmen, Fixtures oder Testdaten fortsetzen.

## Relationship to other documents

- `standards/role-bootstrap-standard.md`
- `roles/wordpress-developer/role.md`
- `roles/wordpress-developer/development-standard.md`
- `roles/wordpress-developer/START-PROMPT.md`
- `architecture/memory-router.md`
- `projects/README.md`
- `.opencode/agents/mathias.md`
- `employees/wordpress-developer/opencode-workplace.md`

## Future Development

Weitere spezialisierte Coding- oder Review-Agenten können später unter `.opencode/agents/` ergänzt werden. Diese Datei bleibt bewusst schlank und organisationsweit; projektspezifische Regeln gehören in bestehende Projekt- und Rollenquellen statt hier dupliziert zu werden.
