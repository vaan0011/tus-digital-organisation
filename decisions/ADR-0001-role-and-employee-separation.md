# ADR-0001 – Rollen und Mitarbeiter werden getrennt modelliert

## Status

Accepted

## Date

2026-09-03

## Scope

TuS Digital Organisation, digitale Mitarbeiter, HR, Verantwortungsmodell.

## Context

Im Repository wurden Rollen und konkrete digitale Mitarbeiter teilweise gemeinsam unter `employees/` beschrieben. Gleichzeitig definiert das Organisationsmodell, dass Verantwortung und Rollen unabhängig von ihrer aktuellen Besetzung bestehen sollen.

## Problem

Wenn Rolle und Mitarbeiter vermischt werden, gehen dauerhafte Verantwortlichkeiten, Berechtigungen und Arbeitsregeln beim Wechsel einer Person oder eines KI-Modells leicht verloren.

## Decision

Rollen und Mitarbeiter werden organisatorisch getrennt.

- `roles/` beschreibt dauerhafte Rollen, Auftrag, Verantwortung, Grenzen und rollenspezifische Standards.
- `employees/` beschreibt konkrete menschliche oder digitale Mitarbeiter und deren Rollenzuweisungen, Wissen und Entwicklung.

Eine Rolle bleibt bestehen, wenn ihre Besetzung wechselt.

## Rationale

Die Entscheidung folgt dem Organisationsprinzip: Verantwortung vor Person und Organisation vor Technologie.

Sie erleichtert Nachfolge, Onboarding und den Austausch digitaler Mitarbeiter.

## Alternatives Considered

Alle Informationen weiterhin ausschließlich unter `employees/` führen.

Dies wurde verworfen, weil dadurch dauerhafte Rolle und aktuelle Besetzung strukturell vermischt bleiben.

## Consequences

Neue operative Rollen werden unter `roles/` definiert.

Bestehende Mitarbeiterdokumentation wird schrittweise an diese Trennung angepasst, wenn reale Arbeit dies erfordert.

## Reopen Conditions

Die Entscheidung wird nur neu geprüft, wenn das Rollenmodell nachweislich zu unnötiger Doppelpflege oder unklarer Verantwortung führt.

## Supersedes / Superseded by

Keine.

## Related Documents

- `../organization/organization-model.md`
- `../roles/README.md`
- `../employees/README.md`