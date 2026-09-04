# ADR-0005: Partnership Manager und dauerhaftes Sponsoring-Arbeitsgedächtnis

## Status

Accepted

## Date

2026-09-04

## Scope

TuS Digital Organisation – Verantwortungsbereich Sponsoring / Partnerships

## Context

In der bisherigen Sponsoring-Arbeit sind umfangreiche strategische Ergebnisse entstanden, unter anderem zur Leitidee „Aus Sponsoren werden Partner“, zu Partnerwelten, Kampagnen, Partner Journey, Partnerportal, LED Media Screen und Partnererlebnissen.

Ein großer Teil dieses Wissens lag bisher vor allem in Chatverläufen und einzelnen operativen Quellen.

Dadurch besteht das Risiko, dass bei neuen Chats oder späteren Mitarbeitern Entscheidungen erneut diskutiert, vorhandene Konzepte übersehen oder wichtige Erkenntnisse verloren werden.

## Decision

1. Sponsoring bleibt ein dauerhafter Verantwortungsbereich der TuS Digital Organisation.
2. Die operative digitale Startrolle für diesen Bereich heißt `Partnership Manager`.
3. Der bisherige Sponsoring-Chat wird als Arbeitsraum dieser Rolle verstanden, nicht als Source of Truth.
4. Nicht-vertrauliche strategische Ergebnisse, Entscheidungen, Konzepte und Arbeitsstände werden dauerhaft in GitHub gesichert.
5. Der zentrale fachliche Wissensraum liegt unter `knowledge/sponsoring/`.
6. `knowledge/sponsoring/CURRENT-STATE.md` dient als operativer Einstiegspunkt für neue Sponsoring-Arbeitsräume.
7. Langfristige organisationsweite Entscheidungen werden zusätzlich als ADR dokumentiert.
8. Vertrauliche Verträge, personenbezogene Kontaktdaten, Bankdaten und nicht öffentliche Einzelkonditionen werden nicht allein aufgrund der GitHub-Pflicht in ein allgemein zugängliches Repository übernommen. GitHub enthält in solchen Fällen nur die organisatorisch notwendige Erkenntnis oder Referenz.

## Rationale

Die Organisation soll Sponsoring-Wissen unabhängig vom jeweiligen Chat, Mitarbeiter oder Tool bewahren.

Die Bezeichnung Partnership Manager unterstützt die bereits entwickelte strategische Ausrichtung: Partnerbeziehungen und gemeinsamer Nutzen stehen vor reiner Werbeflächen- oder Geldlogik.

GitHub eignet sich als nachvollziehbares, versioniertes Organisationsgedächtnis für Standards, Strategien, Entscheidungen und Arbeitsstände. Gleichzeitig müssen vertrauliche Partnerdaten geschützt bleiben.

## Alternatives Considered

### Sponsoring-Chat bleibt alleinige Wissensquelle

Verworfen, weil Entscheidungen bei Chatwechseln schwer auffindbar werden und Wissen erneut rekonstruiert werden müsste.

### Vollständige Sponsorenakte in GitHub

Verworfen, weil nicht jede operative oder vertrauliche Information in ein allgemein zugängliches Organisationsrepository gehört.

### Neue eigene Sponsoring-Abteilung außerhalb des bestehenden Organisationsmodells

Nicht erforderlich. Der Verantwortungsbereich Sponsoring existiert bereits und erhält nun eine klar definierte operative Rolle und ein fachliches Arbeitsgedächtnis.

## Consequences

- neue Rolle `roles/partnership-manager/`,
- neuer Wissensraum `knowledge/sponsoring/`,
- Current-State-Checkpoint für neue Chats,
- Pflicht zur Ergebnissicherung nach relevanter Sponsoring-Arbeit,
- klare Trennung zwischen Organisationswissen und vertraulichen Partnerdaten,
- bestehende Sponsoring-Vorarbeit wird schrittweise in den fachlichen Wissensraum überführt und aktualisiert.

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