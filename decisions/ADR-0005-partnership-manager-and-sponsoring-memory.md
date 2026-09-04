# ADR-0005: Partnership Manager und dauerhaftes Sponsoring-Arbeitsgedächtnis

## Status

Accepted

## Date

2026-09-04

## Scope

TuS Digital Organisation – Verantwortungsbereich Sponsoring / Partnerships

## Context

In der bisherigen Sponsoring-Arbeit sind umfangreiche strategische Ergebnisse entstanden, unter anderem zur Leitidee „Aus Sponsoren werden Partner“, zu Partnerwelten, Kampagnen, Partner Journey, Partnerportal, Partner Hub, LED Media Screen und Partnererlebnissen.

Ein Teil dieses Wissens lag zunächst in Chatverläufen. Inzwischen existiert bereits ein fachlicher Wissensstand unter `knowledge/sponsoring/` sowie Projektstände für Partnerportal und Partner Hub.

Damit dieses Wissen nicht wieder an einzelne Chats gebunden wird, benötigt der Verantwortungsbereich eine dauerhafte Rolle und einen verbindlichen Ablageprozess.

## Decision

1. Sponsoring bleibt ein dauerhafter Verantwortungsbereich der TuS Digital Organisation.
2. Die digitale operative Startrolle heißt `Partnership Manager`.
3. Der Sponsoring-Chat wird als Arbeitsraum dieser Rolle verstanden, nicht als Source of Truth.
4. Nicht-vertrauliche strategische Ergebnisse, Entscheidungen, Konzepte und Arbeitsstände werden dauerhaft in GitHub gesichert.
5. Der zentrale fachliche Wissensraum bleibt `knowledge/sponsoring/`.
6. `knowledge/sponsoring/CURRENT-STATE.md` dient als kompakter operativer Einstiegspunkt für neue Sponsoring-Arbeitsräume.
7. Langfristige organisationsweite Entscheidungen werden zusätzlich als ADR dokumentiert.
8. Vertrauliche Verträge, personenbezogene Kontaktdaten, Bankdaten und nicht öffentliche Einzelkonditionen werden nicht allein aufgrund der GitHub-Pflicht in ein allgemein zugängliches Repository übernommen.
9. Bestehende Sponsoring-Dokumentation wird wiederverwendet und nicht durch parallele Strategiedokumente dupliziert.

## Rationale

Die Organisation soll Sponsoring-Wissen unabhängig vom jeweiligen Chat, Mitarbeiter oder Tool bewahren.

Die Bezeichnung Partnership Manager unterstützt die bereits etablierte strategische Ausrichtung: Partnerbeziehungen und gemeinsamer Nutzen stehen vor reiner Werbeflächen- oder Geldlogik.

GitHub eignet sich als nachvollziehbares, versioniertes Organisationsgedächtnis für Standards, Strategien, Entscheidungen und Arbeitsstände. Gleichzeitig müssen vertrauliche Partnerdaten geschützt bleiben.

## Alternatives Considered

### Sponsoring-Chat bleibt alleinige Wissensquelle

Verworfen, weil Entscheidungen bei Chatwechseln schwer auffindbar werden und Wissen erneut rekonstruiert werden müsste.

### Vollständige Sponsorenakte in GitHub

Verworfen, weil nicht jede operative oder vertrauliche Information in ein allgemein zugängliches Organisationsrepository gehört.

### Neue parallele Sponsoring-Strategiedokumente

Verworfen, weil `knowledge/sponsoring/README.md` bereits einen umfangreichen fachlichen Stand enthält. Bestehendes Organisationswissen wird erweitert statt dupliziert.

## Consequences

- neue Rolle `roles/partnership-manager/`,
- verbindlicher rollenspezifischer Arbeitsstandard,
- Current-State-Checkpoint im bestehenden Sponsoring-Wissensraum,
- Pflicht zur Ergebnissicherung nach relevanter Sponsoring-Arbeit,
- klare Trennung zwischen Organisationswissen und vertraulichen Partnerdaten,
- sichtbare Klärung von Überschneidungen wie Partnerportal vs. Partner Hub vor neuer technischer Umsetzung.

## Reopen Conditions

Diese Entscheidung wird nur erneut geprüft, wenn beispielsweise:

- ein anderes verbindliches System das versionierte Organisationsgedächtnis vollständig übernimmt,
- das Repository-Zugriffsmodell sich grundlegend ändert,
- neue Datenschutz-/Vertraulichkeitsanforderungen eine andere Ablagestruktur erfordern,
- der Verantwortungsbereich Sponsoring organisatorisch grundlegend neu zugeschnitten wird.

Ein neuer Chat oder ein neues Tool reicht nicht aus.

## Related Documents

- `../roles/partnership-manager/role.md`
- `../roles/partnership-manager/partnership-standard.md`
- `../knowledge/sponsoring/README.md`
- `../knowledge/sponsoring/CURRENT-STATE.md`
- `ADR-0001-role-and-employee-separation.md`