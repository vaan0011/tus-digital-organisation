# ADR-0009: Employee Runtime mit Archivist-Pilot

## Status

Accepted

## Date

2026-09-09

## Scope

TuS Digital Organisation – digitale Mitarbeiter, autonome Arbeitszyklen, Queue/Checkpoint-Logik, rollenübergreifende Runtime-Grundlage und Archivist-Pilot.

## Context

Die TuS Digital Organisation verfügt inzwischen über mehrere klar definierte Rollen, Fachstandards, Projektzustände und Wissensräume.

In der praktischen Arbeit zeigte sich jedoch ein wiederkehrendes Muster: Ein digitaler Mitarbeiter bearbeitet einen Abschnitt, berichtet den Zwischenstand und wartet anschließend auf eine erneute menschliche Aufforderung wie `weiter`, obwohl sein dauerhafter Auftrag und weitere zulässige Arbeit bereits bekannt sind.

Damit bleibt der Mensch unnötig als Taktgeber zwischen fachlich selbstständig lösbaren Arbeitsschritten eingebunden.

Gleichzeitig existiert bereits der Grundsatz:

> **Der Chat ist der Schreibtisch, nicht der Mitarbeiter.**

und der bestehende `Daily Work Cycle` sagt ausdrücklich, dass digitale Mitarbeiter nicht auf Zuruf arbeiten sollen.

## Problem

Rolle und Fachkompetenz allein reichen nicht für eigenständige Arbeit.

Ohne explizite Runtime-Logik fehlen insbesondere:

- ein dauerhafter Arbeitsauslöser,
- eine erkennbare Queue,
- eine Priorisierungsregel,
- ein reproduzierbarer Checkpoint,
- eine nächste Aktion,
- klare Stop Conditions,
- klare Escalation Conditions,
- ein persistenter Zustand außerhalb des Chats.

Dadurch kann der Chat trotz vorhandener Organisationsdokumentation zum impliziten Arbeitsgedächtnis und der Mensch zum manuellen Scheduler werden.

## Decision

Die TuS Digital Organisation führt einen organisationsweiten `Employee Runtime Standard` ein.

Dieser Standard definiert die Mindestbausteine für eigenständig arbeitende digitale Mitarbeiter:

1. dauerhafter Auftrag,
2. Arbeitsauslöser,
3. Eingang / Arbeitsquelle,
4. Queue,
5. Priorisierungsregel,
6. Checkpoint / Cursor,
7. autonomer Entscheidungsbereich,
8. Stop Conditions,
9. Escalation Conditions,
10. Output / Handover.

Der Runtime-Zustand wird in der jeweils fachlich geeigneten Source of Truth gehalten. Es wird kein neues zentrales Runtime-Tool eingeführt, wenn bestehende Systeme ausreichen.

### Pilot

Der Archivist ist der erste vollständige Runtime-Pilot.

Seine operative Queue bleibt der vorhandene Google-Sheet-Quellenindex `TuS Historie – Quellenindex`.

Der Tab `Quellen` wird um folgende Cursor-Felder ergänzt:

- `Checkpoint`,
- `Nächste Aktion`,
- `Arbeitsprodukt`,
- `Blocker`.

Der Archivist setzt die Bestandserschließung innerhalb seines definierten autonomen Bereichs selbstständig fort. Ein Zwischenbericht oder ein abgeschlossener Teilabschnitt beendet den Auftrag nicht, solange weitere zulässige Queue-Arbeit existiert.

Nach der vollständigen Bestandserschließung folgt als zweite Phase die quellenübergreifende Auswertung des Gesamtarchivs.

### Grenzen

Autonomie hebt den `Approval & Escalation Standard` nicht auf.

Irreversible Änderungen, produktive Veröffentlichungen, sensible Entscheidungen, rechtliche/finanzielle Bindungswirkung und organisationsweite Grundsatzentscheidungen bleiben freigabe- bzw. eskalationspflichtig.

## Rationale

Diese Entscheidung trennt drei Dinge sauber:

- **Rolle** – wofür ein Mitarbeiter verantwortlich ist,
- **Runtime** – wie diese Verantwortung selbstständig abgearbeitet wird,
- **Chat** – aktueller Arbeitsraum.

Dadurch kann ein neuer Chat oder eine neue Ausführung die Arbeit am gespeicherten Checkpoint fortsetzen, ohne auf persönliche Erinnerung oder die Fortsetzung eines bestimmten Gesprächs angewiesen zu sein.

Der Archivist eignet sich als Pilot, weil:

- die Queue bereits real existiert,
- die Arbeit quellenbasiert und gut prüfbar ist,
- die meisten Schritte reversibel sind,
- Unsicherheiten bereits fachlich dokumentiert werden können,
- die Endbedingung des ersten Durchgangs klar definierbar ist.

## Alternatives Considered

### Nur längere Prompts verwenden

Nicht gewählt, weil ein Prompt allein keinen persistenten Cursor, keine verlässliche Queue und keinen chat-unabhängigen Zustand schafft.

### Jeden Mitarbeiter sofort vollständig automatisieren

Nicht gewählt, weil die Runtime-Regeln aus echter Arbeit gelernt werden sollen und verschiedene Rollen unterschiedliche Risiken und Trigger besitzen.

### Neues zentrales Aufgabenmanagement einführen

Nicht gewählt, weil vorhandene fachliche Source-of-Truth-Systeme bevorzugt werden. Beim Archiv ist der Quellenindex bereits die natürliche Queue.

### Mensch bleibt manueller Scheduler

Nicht gewählt, weil dies dem Ziel eigenständiger digitaler Mitarbeiter widerspricht und unnötige operative Last beim Vorstand erzeugt.

## Consequences

Positive Auswirkungen:

- weniger manuelle `weiter`-Steuerung,
- klarer chat-unabhängiger Zustand,
- reproduzierbare Fortsetzung,
- bessere Übergaben zwischen Ausführungen und Mitarbeitern,
- klare Autonomie- und Eskalationsgrenzen,
- Grundlage für spätere Trigger/Automationen.

Zu beobachtende Risiken:

- Checkpoints können zu unpräzise gepflegt werden,
- Queue-Status kann veralten,
- zu breite Autonomiedefinition kann unerwünschte Aktionen ermöglichen,
- zu enge Eskalationsregeln können wieder zu unnötigen Stopps führen.

Diese Punkte werden im Pilot anhand realer Archivarbeit überprüft.

## Reopen Conditions

Diese Entscheidung wird überprüft, wenn reale Runtime-Arbeit zeigt, dass:

- Queue und Checkpoint keine zuverlässige Fortsetzung ermöglichen,
- das Runtime-Modell zu viel Pflegeaufwand erzeugt,
- wichtige Sicherheits-/Freigabegrenzen fehlen,
- ein gemeinsamer technischer Orchestrator eine bessere Source of Truth für mehrere Rollen benötigt,
- der Archivist-Pilot strukturelle Anforderungen aufzeigt, die organisationsweit anders gelöst werden müssen.

## Supersedes / Superseded by

Keine vorherige ADR wird ersetzt.

Der `Daily Work Cycle` bleibt bestehen und wird durch den Employee Runtime Standard konkretisiert.

## Related Documents

- `../standards/employee-runtime-standard.md`
- `../standards/employee-operating-standard.md`
- `../standards/approval-and-escalation.md`
- `../employees/daily-work-cycle.md`
- `../roles/archivist/role.md`
- `../roles/archivist/archive-standard.md`
- `../roles/archivist/runtime.md`

## Notes

Weitere Rollen erhalten erst nach Auswertung des Archivist-Piloten eigene Runtime-Profile. Die nächsten naheliegenden Kandidaten sind Funding & Grants Manager und Project Portfolio Manager.