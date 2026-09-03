# Entscheidungen

## Purpose

Der Ordner `decisions/` dokumentiert langfristige Entscheidungen zur Architektur, Organisation, Philosophie und Arbeitsweise der TuS Digital Organisation.

Diese Dokumente beantworten nicht nur **was** entschieden wurde, sondern vor allem **warum**.

Dadurch bleiben wichtige Hintergründe auch Jahre später nachvollziehbar.

## Core Principle

Entscheidungen sollen Orientierung geben und verhindern, dass dieselben Diskussionen mehrfach geführt werden.

Ein neuer Chat, ein neuer Mitarbeiter oder persönliche Erinnerung öffnen eine gültige Entscheidung nicht automatisch wieder.

## Main Content

### Wann entsteht eine ADR?

Eine Entscheidung wird dokumentiert, wenn mindestens eines zutrifft:

- sie beeinflusst Architektur oder Datenmodell,
- sie verändert die organisationsweite oder rollenspezifische Arbeitsweise,
- sie betrifft mehrere Projekte oder Module,
- sie legt eine verbindliche Quelle oder einen Standard fest,
- sie soll langfristig Bestand haben,
- ihre spätere Wiederholung als Diskussion wahrscheinlich wäre.

Nicht jede kleine operative Entscheidung benötigt eine ADR.

### Aufbau

Neue ADRs verwenden `template.md`.

Sie dokumentieren insbesondere:

- Status,
- Datum,
- Scope,
- Kontext und Problem,
- verbindliche Entscheidung,
- Begründung,
- relevante Alternativen,
- Auswirkungen,
- Bedingungen für eine spätere Wiederaufnahme,
- ersetzte oder ersetzende Entscheidungen.

### Nummerierung

Entscheidungen werden fortlaufend nummeriert:

- `ADR-0001`
- `ADR-0002`
- `ADR-0003`

Die Nummer bleibt dauerhaft bestehen.

### Status

Verwendete Statuswerte:

- `Proposed`
- `Accepted`
- `Superseded`
- `Rejected`

Eine ersetzte Entscheidung wird nicht gelöscht. Sie bleibt nachvollziehbar und verweist auf ihre Nachfolgeentscheidung.

### Entscheidung erneut öffnen

Eine akzeptierte Entscheidung wird nur erneut geprüft, wenn neue belastbare Gründe vorliegen, beispielsweise:

- neue Anforderung,
- neue Information,
- nachgewiesener Nachteil,
- relevante Änderung des technischen oder organisatorischen Umfelds.

Geschmack, Vergessen oder ein neuer Chat reichen nicht aus.

### Beziehung zum Projektzustand

ADRs erklären langfristige Entscheidungen.

`PROJECT-STATE.md` beschreibt dagegen den aktuellen operativen Stand eines konkreten Projekts.

Der Projekt-Checkpoint verweist auf relevante ADRs, dupliziert ihre Begründung aber nicht.

## Current Decisions

- `ADR-0001-role-and-employee-separation.md`
- `ADR-0002-project-state-and-last-known-good.md`
- `ADR-0003-central-brand-assets-and-shared-ui.md`

## Related Documents

- `template.md`
- `architecture-checklist.md`
- `../standards/iteration-and-progress.md`
- `../core/core-principles.md`
- `../vision/vision.md`

## Future Development

Neue ADRs entstehen aus echten langfristigen Entscheidungen. Das Entscheidungsarchiv soll vollständig genug sein, um Wiederholungen zu vermeiden, aber klein genug bleiben, um tatsächlich genutzt zu werden.