# ADR-0010: Second Brain und Memory Router

## Status

Accepted

## Date

2026-09-10

## Scope

TuS Digital Organisation – organisationsweites Wissen, Chat-to-Brain-Migration, Context Routing, Anti-Loop-Regeln, Rollen-, Projekt- und Wissensarbeit.

## Context

Die TuS Digital Organisation verfügt inzwischen über Rollen, Projekte, ADRs, Standards, Architektur, Funding- und Sponsoring-Wissen sowie erste eigenständig fortsetzbare Runtime-Logik.

Gleichzeitig ist ein erheblicher Teil des über Jahre in Chats aufgebauten Wissens noch nicht systematisch als organisationsweites Gedächtnis erschlossen. Dadurch besteht das Risiko, dass neue Chats bekannte Themen erneut diskutieren, frühere Fehlversuche wiederholen oder bereits getroffene Entscheidungen nur deshalb neu öffnen, weil ihr Kontext nicht geladen wurde.

Die Inventur in `architecture/tus-os-inventory.md` hat deshalb Second Brain und Memory Router als nächste Fundamentbausteine identifiziert.

## Problem

Ein einzelner zentraler Wissensordner würde das Problem nicht lösen, weil die fachlich richtige Wahrheit bereits verteilt liegt:

- Entscheidungen in `decisions/`,
- Projektzustände in `projects/`,
- Fachwissen in `knowledge/`,
- Rollenwissen in `roles/`,
- Standards in `standards/`,
- Originalquellen und große bzw. geschützte Artefakte in Google Drive,
- fachliche Register in ihren jeweiligen Systemen.

Gleichzeitig ist es ineffizient und fehleranfällig, vor jeder Aufgabe das gesamte Repository oder historische Chats zu lesen.

## Decision

Die TuS Digital Organisation führt verbindlich zwei zusammenwirkende Konzepte ein:

1. **Second Brain** – organisationsweite Wissensarchitektur, die dauerhaft relevantes Wissen an seiner fachlich richtigen Source of Truth bewahrt und Wissensarten wie Fact, Decision, Current State, Open Question, Rejected, Lesson Learned, Hypothesis und Superseded unterscheidet.
2. **Memory Router** – verbindliche Arbeitslogik, die für eine konkrete Aufgabe das kleinste ausreichende Kontextpaket aus Rolle, aktuellem Zustand, Entscheidungen, Standards, Fachwissen, Rejected/Lessons, Skills, Runtime und externen Quellen auswählt.

Chats sind Arbeitsoberfläche und Rohmaterial, aber keine dauerhafte fachliche Source of Truth.

Zusätzlich gilt organisationsweit:

> **Eine bereits entschiedene oder verworfene Frage wird nicht allein deshalb neu geöffnet, weil ein neuer Chat beginnt, ein anderer Mitarbeiter arbeitet oder die frühere Diskussion nicht erinnert wird.**

Eine Neubewertung erfordert neue belastbare Evidenz, relevante geänderte Randbedingungen, einen nachgewiesenen Nachteil, eine neue Anforderung oder eine ausdrückliche menschliche Entscheidung.

## Rationale

Diese Lösung nutzt die bereits vorhandene Repository-Architektur, statt eine parallele Wissensdatenbank aufzubauen.

Sie unterstützt die bestehenden Core Principles:

- Wissen bleibt, Menschen wechseln,
- eine fachliche Quelle der Wahrheit,
- Beziehungen erzeugen Organisationswissen,
- Chat und Tool dürfen nicht zum einzigen Gedächtnis werden.

Der Memory Router reduziert gleichzeitig die Gefahr, dass ein großes Second Brain durch zu viel Kontext selbst unbenutzbar wird.

## Alternatives Considered

### Alle Chatverläufe vollständig archivieren

Verworfen. Gesprächsverläufe enthalten zu viel temporären Kontext, Wiederholungen und Zwischenstände. Sie bleiben Rohmaterial, nicht kanonisches Organisationswissen.

### Einen neuen zentralen `second-brain/`-Ordner als alleinigen Speicher anlegen

Verworfen. Dies würde bestehende Sources of Truth duplizieren und widerspricht dem Prinzip der fachlich eindeutigen Quelle.

### Jeder Rollen-Chat liest bei Start das gesamte Repository

Verworfen. Zu viel irrelevanter Kontext erhöht Aufwand und Widerspruchsrisiko und skaliert nicht.

### ChatGPT-Memory als alleinige Gedächtnisschicht verwenden

Verworfen als organisatorische Source of Truth. Produktspezifische Memory-Funktionen können unterstützen, dürfen aber die langfristige Arbeitsfähigkeit der Organisation nicht bestimmen.

## Consequences

Positiv:

- neue Chats können am dokumentierten Stand ansetzen,
- Entscheidungen und verworfene Wege werden wiederverwendbar,
- weniger Schleifen und Doppelarbeit,
- vorhandene GitHub-/Drive-Strukturen werden besser verbunden,
- Rollen können mit kleinerem, relevanterem Kontext arbeiten,
- spätere technische Automatisierung erhält ein klares fachliches Modell.

Zu beachten:

- bestehende Chats müssen schrittweise migriert werden,
- nicht jedes Wissen gehört nach GitHub,
- Context Routing ist zunächst eine Arbeitsregel und noch keine vollautomatische technische Funktion,
- schlecht gepflegte Current States bleiben eine Schwachstelle und müssen bei realer Arbeit verbessert werden.

## Reopen Conditions

Die Grundentscheidung darf neu geprüft werden, wenn beispielsweise:

- ein zukünftiges System eine nachweislich bessere, tool-unabhängige kanonische Wissensarchitektur ermöglicht,
- die verteilte Source-of-Truth-Struktur praktisch zu unauflösbaren Konflikten führt,
- der Memory Router in realer Arbeit nachweislich kritischen Kontext systematisch verfehlt,
- sich die grundlegende Plattform- oder Organisationsarchitektur wesentlich ändert.

## Supersedes / Superseded by

Keine.

## Related Documents

- `../knowledge/README.md`
- `../knowledge/SECOND-BRAIN-STANDARD.md`
- `../architecture/memory-router.md`
- `../architecture/tus-os-inventory.md`
- `../architecture/knowledge-graph.md`
- `../core/objects/knowledge-entry.md`
- `../standards/employee-operating-standard.md`
- `../standards/employee-runtime-standard.md`
- `../standards/learning-loop.md`

## Notes

Funding und Sponsoring dienen als bereits fortgeschrittene Wissensdomänen. Der Archivist dient als Referenz für Runtime/Loop-Logik. Die nächste Ausbaustufe ist die kontrollierte Migration weiterer Chat-Wissensbereiche und anschließend der Skill-/Loop-Ausbau.