# ADR-0002 – Projekt-Checkpoint und Last Known Good werden verbindlich

## Status

Accepted

## Date

2026-09-03

## Scope

Länger laufende Projekte, insbesondere Softwareentwicklung und Chat-basierte Zusammenarbeit.

## Context

Frühere Arbeitsstränge haben gezeigt, dass ältere Entscheidungen, bereits ausgeschlossene Lösungswege und stabile Zwischenstände in langen Chats verloren gehen können.

## Problem

Wenn der aktuelle Projektstand nur im Chat oder in persönlicher Erinnerung lebt, können neue Chats oder Mitarbeiter bereits erledigte Diskussionen wiederholen, alte Fehler erneut ausprobieren oder einen instabilen Stand fälschlich als Ausgangspunkt verwenden.

## Decision

Länger laufende Projekte führen eine kompakte `PROJECT-STATE.md`.

Sie enthält mindestens Ziel, relevanten verifizierten Stand, Last Known Good, offene Probleme, bereits ausgeschlossene Wege, relevante Entscheidungen und nächsten sinnvollen Schritt.

Ein Stand wird erst nach erfolgreicher Prüfung zum Last Known Good.

Nach zwei erfolglosen Versuchen ohne neue Erkenntnis wird die Umsetzung gestoppt und die zugrunde liegende Annahme überprüft.

## Rationale

Der Mechanismus hält operatives Wissen außerhalb einzelner Chats fest und reduziert Wiederholungen und unkontrollierte Reparaturschleifen.

## Alternatives Considered

Nur Chathistorie oder Commit-Historie als Gedächtnis verwenden.

Dies wurde verworfen, weil beide Quellen den aktuellen fachlichen Projektzustand nicht kompakt und eindeutig darstellen.

## Consequences

`PROJECT-STATE.md` wird kein Aktivitätstagebuch, sondern nur bei relevanten Zustandsänderungen aktualisiert.

Neue Coding-Chats beginnen mit dem Projekt-Checkpoint.

## Reopen Conditions

Die Entscheidung wird geprüft, wenn der Checkpoint dauerhaft Doppelpflege erzeugt oder ein anderes System denselben Zweck zuverlässiger und einfacher erfüllt.

## Supersedes / Superseded by

Keine.

## Related Documents

- `../standards/iteration-and-progress.md`
- `../projects/event-planner/PROJECT-STATE.md`
- `README.md`