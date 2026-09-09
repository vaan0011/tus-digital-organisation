# Memory Router

## Purpose

Der Memory Router definiert, wie ein menschlicher oder digitaler Mitarbeiter vor wesentlicher TuS-Arbeit den relevanten Organisationskontext findet, ohne das gesamte Repository oder alte Chats lesen zu müssen.

Er ist kein neues Speichersystem. Er verbindet bestehende Sources of Truth und bestimmt die sinnvolle Lesereihenfolge für eine konkrete Aufgabe.

## Core Principle

> **So viel Kontext wie nötig, so wenig wie möglich.**

Ein Mitarbeiter soll vor einer Aufgabe die Informationen lesen, die Entscheidungen verbessern und Wiederholungen verhindern – nicht das gesamte Organisationsarchiv.

## Main Content

### 1. Routing Input

Vor wesentlicher Arbeit werden soweit erkennbar folgende Merkmale bestimmt:

- Rolle,
- fachliche Domäne,
- Projekt oder Vorhaben,
- Art der Aufgabe,
- betroffene Objekte oder Systeme,
- erforderliche Entscheidung oder gewünschter Output,
- mögliche Risiken / Freigaben.

Nicht jedes Merkmal muss vorhanden sein.

### 2. Routing-Reihenfolge

Der Standard-Leseweg lautet:

1. **Rolle** – `roles/<rolle>/role.md` und nur die für die Aufgabe relevanten Rollenstandards.
2. **Aktueller Zustand** – bei Projekten `PROJECT-STATE.md`, bei Wissensdomänen `CURRENT-STATE.md` oder fachlich gleichwertige Source of Truth.
3. **Verbindliche Entscheidungen** – relevante ADRs unter `decisions/`.
4. **Organisationsstandards** – nur die für den Arbeitstyp relevanten Dateien unter `standards/`, `organization/`, `core/` oder `architecture/`.
5. **Fachwissen** – relevante Dateien unter `knowledge/`, Design-/Archivquellen oder fachliche Register.
6. **Rejected / Lessons** – frühere Fehlversuche, verworfene Wege und Lessons Learned prüfen, wenn die Aufgabe eine bekannte Problemklasse berührt.
7. **Skills** – sobald eigenständige Skill-Definitionen existieren, die benötigten Fähigkeiten laden.
8. **Runtime / Loop** – wenn Arbeit fortgesetzt oder wiederkehrend ausgeführt wird, Queue, Cursor, nächste Aktion und Stop-/Escalation-Logik laden.
9. **Externe Artefakte** – nur die tatsächlich benötigten Google-Drive-, Web- oder sonstigen Quellen öffnen.

### 3. Minimal Context Set

Für eine konkrete Aufgabe soll ein `Minimal Context Set` entstehen.

Es enthält typischerweise:

- 1 Rollenquelle,
- 1 aktuellen Projekt- oder Fachzustand,
- die tatsächlich relevanten ADRs,
- notwendige Standards,
- notwendiges Fachwissen,
- gegebenenfalls Runtime-Zustand und externe Quellen.

Die Zahl der Dateien ist kein Qualitätsmaß. Entscheidend ist, dass keine kritische Wahrheit fehlt und keine unnötige Informationsmasse geladen wird.

### 4. Source Precedence

Wenn Quellen scheinbar widersprechen, gilt nicht pauschal „neueste Datei gewinnt“.

Stattdessen wird nach fachlicher Zuständigkeit aufgelöst:

- ADR → langfristige verbindliche Entscheidung,
- `PROJECT-STATE.md` → aktueller operativer Zustand eines Projekts,
- `CURRENT-STATE.md` → aktueller Zustand einer Wissensdomäne,
- Standard → verbindliche organisations- oder rollenspezifische Arbeitsregel,
- Fachregister / Originalquelle → fachliche Fakten und Quellenlage,
- Chat → ergänzender Arbeitskontext, aber keine automatische kanonische Wahrheit.

Bei echtem Konflikt greift der Second Brain Standard.

### 5. Anti-Loop Gate

Bevor eine bekannte Grundsatzfrage erneut diskutiert oder eine frühere Lösung ersetzt wird, prüft der Router:

1. Gibt es eine relevante ADR?
2. Gibt es einen dokumentierten Rejected-Ansatz oder ein Lesson Learned?
3. Gibt es einen aktuellen Projekt-/Fachzustand, der die Frage bereits beantwortet?
4. Hat sich seitdem etwas materiell geändert?

Ohne neue Evidenz, geänderte Randbedingung oder explizite Neubewertung wird die bestehende Entscheidung angewendet statt erneut diskutiert.

### 6. Routing nach Arbeitstyp

#### Projektarbeit

Mindestens:

- zuständige Rolle,
- `projects/<projekt>/PROJECT-STATE.md`,
- relevante ADRs,
- Projekt-README bei Scope-Fragen,
- relevante Standards und fachliche Wissensquellen.

#### Facharbeit ohne formales Projekt

Mindestens:

- Rolle,
- fachlicher `CURRENT-STATE` oder führende Fachquelle,
- relevante ADRs und Standards,
- passende Arbeitsdaten / Originalquellen.

#### Design / Produktion

Zusätzlich zwingend prüfen:

- Brand-Entscheidungen,
- Original-Assets / verbindliche Referenzen,
- bekannte Rejected-Ansätze und Produktions-Learnings.

#### Recherche / Funding

Zusätzlich prüfen:

- Aktualität der Quellen,
- offizielle Primärquellen,
- fachliche Bewertungslogik,
- vorhandene Dossiers, Radar- und Kalenderstände.

#### Runtime / autonomer Loop

Zusätzlich zwingend:

- Queue,
- Priorisierung,
- Cursor / Checkpoint,
- nächste Aktion,
- Entscheidungsgrenzen,
- Stop- und Escalation Conditions,
- Write-back-Ziel.

### 7. Write-back Routing

Der Memory Router bestimmt nicht nur, was gelesen wird, sondern auch, wohin neue dauerhafte Erkenntnisse zurückgeschrieben werden.

Typische Ziele:

- langfristige Entscheidung → `decisions/`,
- Projektfortschritt → `PROJECT-STATE.md`,
- fachlicher Arbeitsstand → `CURRENT-STATE.md`,
- wiederverwendbare Erkenntnis → zuständige Wissensdomäne / Standard,
- verworfener Weg → ADR oder fachliche Rejected-/Lesson-Struktur,
- Runtime-Fortschritt → fachliche Queue / Checkpoint-Quelle,
- große oder geschützte Artefakte → geeigneter Drive-Bereich plus nicht-sensibler Verweis in GitHub.

### 8. Neuer Chat / Rollenstart

Ein neuer Chat soll nicht versuchen, historische Gespräche vollständig nachzubilden.

Stattdessen lautet das Ziel:

> **Lies den aktuellen kanonischen Zustand und nur die für deine Aufgabe relevanten Vorgängerentscheidungen.**

Historische Chats werden nur dann benötigt, wenn eine relevante Information noch nicht in das Second Brain migriert wurde oder eine Entscheidung ohne ihren ursprünglichen Kontext nicht verständlich ist.

### 9. Router ist eine Arbeitsregel, kein Tool-Zwang

Der Memory Router kann heute manuell über gezieltes Lesen in GitHub, Drive und anderen Sources of Truth ausgeführt werden.

Später kann er technisch durch Suche, Knowledge Graph, Plugins oder Automationen unterstützt werden.

Die Architektur darf nicht davon abhängen, dass ein bestimmtes ChatGPT-Feature oder ein einzelnes Tool dauerhaft existiert.

### 10. Qualitätsprüfung

Vor Beginn der eigentlichen Arbeit soll ein Mitarbeiter intern beantworten können:

- Kenne ich den aktuellen Zustand?
- Kenne ich die relevanten Entscheidungen?
- Kenne ich bestehende Fehlversuche / Rejected-Ansätze?
- Weiß ich, welche Quelle fachlich maßgeblich ist?
- Weiß ich, wo ein neues Ergebnis dokumentiert werden muss?

Wenn diese Fragen für eine wesentliche Aufgabe nicht beantwortbar sind, fehlt Kontext oder eine Systemlücke ist sichtbar geworden.

## Relationship to other documents

- `tus-os-inventory.md`
- `knowledge-graph.md`
- `../knowledge/README.md`
- `../knowledge/SECOND-BRAIN-STANDARD.md`
- `../decisions/README.md`
- `../roles/README.md`
- `../projects/README.md`
- `../standards/employee-operating-standard.md`
- `../standards/employee-runtime-standard.md`

## Future Development

Der Router wird zunächst als verbindliche Arbeitslogik genutzt.

Aus realer Nutzung wird später entschieden, welche Teile technisch unterstützt werden müssen, zum Beispiel durch maschinenlesbare Metadaten, Rollen-Context-Maps, Projekt-Context-Maps oder einen automatisierten Knowledge-Graph-Resolver.