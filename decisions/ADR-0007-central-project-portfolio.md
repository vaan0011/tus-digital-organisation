# ADR-0007: Zentrales Projektportfolio bei dezentraler Projektverantwortung

## Status

Accepted

## Date

2026-09-04

## Scope

TuS Digital Organisation – organisationsweite Projekttransparenz

## Context

Mit wachsender paralleler Arbeit entstehen immer mehr TuS-Projekte und relevante Vorhaben in unterschiedlichen Verantwortungsbereichen.

Einzelne Projekte besitzen bereits eigene `PROJECT-STATE.md`, während weitere größere Vorhaben in Sponsoring-, Förder-, Infrastruktur-, Archiv- oder Organisationsarbeit entstehen.

Ohne zentrale Übersicht besteht das Risiko, dass:

- relevante Projekte übersehen werden,
- verschiedene Rollen mit unterschiedlichen Projektständen arbeiten,
- ähnliche Projekte parallel entstehen,
- Förder- oder Sponsoringchancen nicht mit realen Vorhaben verbunden werden,
- Projekte ohne Owner oder nächsten Schritt unsichtbar bleiben,
- Wissen nur in einzelnen Chats liegt.

Gleichzeitig soll keine zweite zentrale Projektmanagement-Datenbank entstehen, die alle Details aus den Projektakten dupliziert.

## Decision

1. Die TuS Digital Organisation führt ein zentrales Projektportfolio unter `projects/PROJECT-PORTFOLIO.md`.
2. Das Portfolio enthält nur organisationsweit notwendige Orientierungsinformationen.
3. Für ein formales Projekt bleibt dessen `PROJECT-STATE.md` die verbindliche Detailquelle.
4. Projektverantwortung bleibt beim jeweiligen fachlichen Verantwortungsbereich bzw. der zuständigen Rolle.
5. Die dauerhafte Querschnittsrolle `Project Portfolio Manager` verantwortet Sichtbarkeit, Konsistenz und Aktualität des Portfolios.
6. Relevante, aber noch nicht ausreichend geklärte Vorhaben können als `Kandidat` geführt werden, ohne sofort einen eigenen Projektordner zu erhalten.
7. Neue Projektordner werden nur angelegt, wenn ein echtes dauerhaft relevantes Vorhaben einen eigenen Projektzustand benötigt.
8. Projektüberschneidungen und Doppelentwicklungen werden sichtbar gemacht, bevor weitere parallele Umsetzung erfolgt.
9. Andere Rollen – insbesondere Funding & Grants Manager und Partnership Manager – dürfen das zentrale Portfolio als Einstiegspunkt für reale TuS-Vorhaben verwenden.

## Rationale

Die Organisation braucht sowohl dezentrale fachliche Verantwortung als auch zentrale Transparenz.

Eine einzige große Projektdatei mit allen Details würde schnell veralten und Doppelpflege verursachen. Nur einzelne Projektzustände wiederum erschweren den organisationsweiten Überblick.

Das Portfolio löst dies als schlanke Index- und Koordinationsschicht:

> **Detailwahrheit im Projekt. Portfolioübersicht zentral.**

## Alternatives Considered

### Jede Rolle pflegt nur ihre eigenen Projekte

Nicht ausreichend, weil bereichsübergreifende Abhängigkeiten, Doppelungen und Finanzierungschancen schwer sichtbar werden.

### Zentrales vollständiges Projektmanagement-System

Derzeit verworfen, weil dies zusätzliche Pflege, Datenfelder und Komplexität erzeugen würde, bevor ein nachgewiesener Bedarf besteht.

### Alle Ideen sofort als Projektordner anlegen

Verworfen, weil dadurch das Repository mit unfertigen Wunschlisten und unklaren Vorhaben überladen würde.

## Consequences

- neue Rolle `roles/project-portfolio-manager/`,
- zentrale Übersicht `projects/PROJECT-PORTFOLIO.md`,
- `projects/README.md` definiert die minimale Projektstruktur,
- formale Projekte behalten ihre eigenen `PROJECT-STATE.md`,
- größere noch unklare Vorhaben können als Kandidaten sichtbar werden,
- Projektüberschneidungen werden organisationsweit schneller erkannt,
- Fördermittel-, Sponsoring-, Entwicklungs- und Designarbeit können auf dieselbe Projektübersicht zugreifen.

## Reopen Conditions

Diese Entscheidung wird neu geprüft, wenn:

- die Anzahl und Komplexität der Projekte einen anderen Mechanismus nachweislich erforderlich machen,
- ein anderes System die gleiche Funktion einfacher und zuverlässig als gemeinsame Source of Truth übernimmt,
- die Portfolio-Pflege dauerhaft Doppelarbeit erzeugt,
- das Projektmodell der Organisation grundlegend geändert wird.

Ein neues Tool allein ist kein ausreichender Grund.

## Related Documents

- `../projects/README.md`
- `../projects/PROJECT-PORTFOLIO.md`
- `../roles/project-portfolio-manager/role.md`
- `../roles/project-portfolio-manager/portfolio-standard.md`
- `ADR-0002-project-state-and-last-known-good.md`