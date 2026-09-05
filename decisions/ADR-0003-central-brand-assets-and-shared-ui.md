# ADR-0003 – Zentrale Markenassets und gemeinsamer UI-Standard

## Status

Accepted

## Date

2026-09-03

## Scope

Digitale Produkte, WordPress-Plugins, Portale, Websites und andere TuS-Oberflächen.

## Context

Das Repository enthält bereits offizielle TuS-Logo-Dateien sowie eine moderne UI im Event Planner. Ohne verbindliche Quelle könnten zukünftige Projekte Logos nachbauen und jeweils eigene Farben, Buttons, Karten und Bedienmuster einführen.

## Problem

Projektspezifische Varianten führen zu inkonsistentem Erscheinungsbild, zusätzlicher Pflege und wiederkehrenden Designentscheidungen.

## Decision

`design/logo/` ist die fachlich maßgebliche Quelle für die freigegebenen TuS-Logo-Assets.

Projektkopien sind nur technische Kopien und dürfen nicht unabhängig verändert werden.

Digitale TuS-Produkte folgen einem gemeinsamen UI-Standard unter `design/ui-standard.md`.

Die moderne Event-Planer-Oberfläche dient als erste praktische Referenz für UI v1. Neue Muster werden bevorzugt als Erweiterung des gemeinsamen Systems entwickelt statt als projektspezifisches Designsystem.

## Rationale

Eine gemeinsame visuelle Sprache reduziert Entwicklungsaufwand, stärkt Wiedererkennung und verhindert, dass Nutzer jedes TuS-System neu lernen müssen.

## Alternatives Considered

Jedes Projekt gestaltet Logo-Nutzung und UI eigenständig.

Dies wurde verworfen, weil dadurch Redundanz, Inkonsistenz und unnötige Designarbeit entstehen.

## Consequences

UI- und Logoänderungen müssen die zentralen Designstandards berücksichtigen.

Neue wiederkehrende UI-Muster können nach erfolgreicher Erprobung in den gemeinsamen Standard übernommen werden.

## Reopen Conditions

Die Entscheidung wird neu geprüft, wenn eine neue verbindliche Corporate Identity beschlossen wird oder ein anderes zentrales Designsystem die Anforderungen nachweislich besser erfüllt.

## Supersedes / Superseded by

Keine.

## Related Documents

- `../design/README.md`
- `../design/logo.md`
- `../design/design-principles.md`
- `../design/ui-standard.md`
- `../roles/wordpress-developer/development-standard.md`