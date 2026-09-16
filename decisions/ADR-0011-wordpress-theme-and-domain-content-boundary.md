# ADR-0011 – WordPress-Theme und fachlicher Content werden getrennt

## Status

Accepted

## Date

2026-09-16

## Scope

Neuaufbau der öffentlichen TuS-Mingolsheim-Homepage und alle öffentlich sichtbaren TuS-WordPress-Komponenten.

## Context

Das freigegebene Homepage-Mockup definiert eine klare visuelle Richtung. Gleichzeitig entstehen mit Team Manager, Event Planner, TuS Platzbelegung, Partnerlösungen und der MatchCard mehrere fachliche Datenquellen.

Die heutige Homepage hängt von Colibri, zusätzlichen Block-/Widget-Plugins und mehreren fachlich überlappenden Plugins ab. Ein Neuaufbau darf diese Kopplung nicht in einer neuen Form wiederholen.

Die bestehenden TuS-Standards legen bereits fest, dass öffentliche Plugin-Oberflächen Brand-Farben und Brand-Typografie aus dem aktiven Theme beziehen und ein Theme-Wechsel keine fachliche Plugin-Codeänderung erfordern soll.

## Problem

Wenn das Theme zusätzlich Mannschaften, Spiele, Veranstaltungen, Partner, Platzbelegungen oder andere Fachdaten verwaltet, werden Gestaltung, Datenhaltung und Geschäftslogik untrennbar gekoppelt.

Wenn Plugins dagegen jeweils eigene Farben, Schriften und Komponentenstile mitbringen, entsteht erneut eine fragmentierte Oberfläche.

## Decision

Die Zielarchitektur trennt verbindlich:

> **Das Theme liefert Look, Layout und visuelle Regeln. WordPress-Inhalte und fachliche Plugins liefern Content, Daten und Funktionen.**

### Verantwortung des TuS-Block-Themes

Das Theme verantwortet ausschließlich:

- `theme.json` mit Global Styles und semantischen Design-Tokens,
- Templates und Template Parts,
- Header, Footer und Seitengrundraster,
- Block Patterns und rein visuelle Block Styles,
- responsive Layoutregeln,
- lokal ausgelieferte Brand-Fonts nach Freigabe,
- kontrollierte Einbindung der offiziellen TuS-Logo-Assets,
- visuelle Fallbacks für leere oder nicht verfügbare Komponenten.

Das Theme speichert keine fachlichen Mannschafts-, Spiel-, Event-, Partner-, Kontakt- oder Belegungsdaten und synchronisiert keine externen Quellen.

### Verantwortung von WordPress Core

WordPress Core bleibt führend für normale redaktionelle Inhalte:

- Beiträge und Nachrichten,
- statische Seiten,
- Medien,
- Navigationen,
- redaktionelle Startseiteninhalte, die keinen eigenen fachlichen Datenbestand benötigen.

### Verantwortung fachlicher Plugins

Fachliche Plugins verantworten:

- ihre Domänenobjekte und dauerhafte Datenhaltung,
- Validierung, Berechtigungen und Geschäftsregeln,
- externe Synchronisationen und Adapter,
- serverseitig gerenderte dynamische Blöcke oder klar definierte öffentliche Schnittstellen,
- Fehler-, Empty- und Fallback-Zustände ihrer Daten.

Das Theme greift nicht direkt auf interne Plugin-Tabellen zu. Ein Plugin rendert seine öffentliche semantische Struktur und verwendet dabei die vom Theme bereitgestellten Tokens.

### Dünne Homepage-Komponentenschicht

Homepage-spezifische Funktionen ohne zuständiges Fachplugin dürfen in einem kleinen Begleitplugin `TuS Homepage Components` liegen. Es darf keine zweite Datenquelle für Mannschaften, Spiele, Events, Partner oder Platzbelegungen aufbauen.

Seine Aufgabe ist auf homepagebezogene Komposition, zentrale Vereinskennzahlen und kleine WordPress-native Abfragen begrenzt.

### Migration

Colibri und die heutige Widget-/Block-Landschaft werden nicht vorab entfernt. Das neue Theme und die benötigten Zielkomponenten werden auf Staging aufgebaut und geprüft. Erst danach werden alte Abhängigkeiten funktionsweise migriert und kontrolliert abgeschaltet.

## Rationale

Die Trennung ermöglicht:

- ein Redesign ohne Änderung fachlicher Plugin-Logik,
- eine Plugin-Weiterentwicklung ohne Duplikation der Marke,
- klare Sources of Truth,
- schrittweise Migration,
- bessere Testbarkeit und Ausfallsicherheit,
- weniger Abhängigkeit von Page Buildern und Einzelfunktionsplugins.

Ein WordPress-Block-Theme passt zur Entscheidung, weil `theme.json`, Templates, Template Parts und Patterns die visuelle Ebene abbilden, während dynamische Blocks aus Plugins ihre Daten serverseitig liefern können.

## Alternatives Considered

### Colibri als dauerhafte Zielbasis weiterverwenden

Verworfen, weil die Zielarchitektur die heutige fragmentierte Layout-/Widget-Schicht kontrolliert ablösen und nicht weiter ausbauen soll.

### Alle Homepage-Funktionen in das Theme einbauen

Verworfen, weil ein Theme-Wechsel dann fachliche Daten und Integrationen gefährden würde.

### Ein einziges großes TuS-Homepage-Plugin für alle Domänen

Verworfen, weil Team, Match, Event, Platz und Partner bereits eigene fachliche Verantwortungen besitzen oder erhalten.

### Plugins vollständig selbst gestalten lassen

Verworfen, weil dadurch wieder mehrere Brand- und UI-Systeme entstehen würden.

## Consequences

- Das Zieltheme wird als eigenes Block-Theme `tus-mingolsheim` entwickelt.
- Homepage-spezifische Funktionen können in `tus-homepage-components` liegen, sofern WordPress Core oder ein Fachplugin nicht bereits zuständig ist.
- Fachplugins müssen eine öffentliche Block-/Render-Schnittstelle anbieten, statt vom Theme über interne Tabellen abgefragt zu werden.
- Semantische Theme-Tokens werden vor dem ersten visuellen Komponenten-Release verbindlich benannt.
- Exakte Farb- und Fontwerte bleiben bis zur Brand-Freigabe offen; ihre technische Rolle wird trotzdem bereits festgelegt.
- Colibri bleibt bis zum erfolgreichen Staging-/Migrationsnachweis aktiv.

## Reopen Conditions

Die Entscheidung wird nur neu bewertet, wenn:

- die produktive WordPress-Baseline ein Block-Theme technisch nicht zuverlässig unterstützt und nicht aktualisiert werden kann,
- reale Implementierung zeigt, dass eine definierte Grenze fachlich nicht tragfähig ist,
- eine neue verbindliche Plattformentscheidung WordPress als öffentliche Oberfläche ersetzt.

Ein neues Mockup, ein anderer Page Builder oder reine Geschmacksänderungen reichen nicht aus.

## Related Documents

- `../design/homepage-standard.md`
- `../design/ui-standard.md`
- `../design/brand-identity.md`
- `../architecture/platform-architecture.md`
- `../architecture/stability-and-simplicity.md`
- `../projects/homepage/ARCHITECTURE.md`
- `../projects/homepage/CONTENT-MODEL.md`
- `../projects/homepage/FUSSBALL-DE-INTEGRATION.md`
- `../knowledge/privacy/HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`

## Supersedes / Superseded by

Keine.
