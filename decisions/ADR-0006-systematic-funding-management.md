# ADR-0006: Systematisches Fördermittelmanagement

## Status

Accepted

## Date

2026-09-04

## Scope

TuS Digital Organisation – Fördermittel & Förderprogramme

## Context

Der TuS Mingolsheim verfügt über zahlreiche bestehende und geplante Vorhaben in Bereichen wie Jugend, Sport, Infrastruktur, Soziales, Ehrenamt, Digitalisierung, Nachhaltigkeit, Kultur und Vereinsentwicklung.

Förderprogramme wurden bisher nicht als eigener dauerhafter Arbeitsbereich systematisch beobachtet, bewertet und mit diesen Projekten verbunden.

Dadurch besteht das Risiko, Förderchancen zu verpassen, Fristen zu spät zu erkennen, Projekte förderschädlich zu früh zu beginnen oder Anträge ohne ausreichende strategische und formale Vorbereitung einzureichen.

## Decision

1. Fördermittel & Förderprogramme werden als dauerhafter querschnittlicher Verantwortungsbereich der TuS Digital Organisation etabliert.
2. Die digitale operative Startrolle heißt `Funding & Grants Manager`.
3. Förderarbeit wird als Pipeline aus Förderradar, Fit-Prüfung, Förderkalender, Antrag, Nachverfolgung und Lernen organisiert.
4. Konkrete Förderchancen werden gegen aktuelle offizielle Primärquellen verifiziert.
5. Ein zentraler Förderkalender wird unter `knowledge/funding/FUNDING-CALENDAR.md` gepflegt.
6. Ernsthaft relevante Programme erhalten standardisierte Programmdossiers.
7. Der TuS bewertet Förderprogramme danach, wie gut sie zu realen Vereinsvorhaben passen. Projekte werden nicht ohne fachlichen Grund für Förderbedingungen verbogen.
8. Frühere Förderempfänger und bewilligte Projekte werden recherchiert, wenn sie öffentlich zugänglich sind, um Auswahlmuster und realistische Passung besser zu verstehen.
9. Förderstellen und Ansprechpartner werden bei relevanten offenen Fragen professionell einbezogen.
10. Bewilligungen und Ablehnungen werden als Lernquelle dokumentiert.
11. Relevante nicht-vertrauliche Förderergebnisse werden in GitHub gesichert; schutzbedürftige Originalunterlagen verbleiben in geeigneten geschützten Systemen.

## Rationale

Fördermittelarbeit ist zeitkritisch, regelbasiert und wissensintensiv. Ein dauerhaftes Fördermittelmanagement erhöht die Chance, passende Programme frühzeitig zu erkennen und qualitativ bessere Anträge vorzubereiten.

Ein zentraler Förderkalender verhindert, dass Fristen nur in einzelnen Chats, E-Mails oder persönlichen Erinnerungen existieren.

Programmdossiers reduzieren Wiederholungsarbeit und schaffen eine belastbare Grundlage für zukünftige Ausschreibungsrunden.

## Alternatives Considered

### Fördermittel weiterhin situativ prüfen

Verworfen, weil Chancen und Fristen dadurch zufällig bleiben und Wissen nicht systematisch aufgebaut wird.

### Fördermittel als Teil des Sponsoring-Bereichs führen

Verworfen. Sponsoring und Förderung können sich ergänzen, folgen aber unterschiedlichen Logiken. Förderprogramme besitzen eigene Richtlinien, Antragsberechtigungen, Mittelbindungen, Fristen und Nachweispflichten.

### Nur große Programme verfolgen

Verworfen. Auch kleine lokale, regionale oder stiftungsseitige Förderungen können für konkrete Vereinsprojekte einen hohen Nutzen bei überschaubarem Aufwand haben.

## Consequences

- neue Rolle `roles/funding-grants-manager/`,
- eigener Wissensraum `knowledge/funding/`,
- zentraler Förderkalender,
- standardisierte Programmdossiers,
- verbindliche Antrags-Checkliste,
- dauerhafte Förderpipeline und Learnings,
- querschnittliche Zusammenarbeit mit Projekten und Verantwortungsbereichen.

## Reopen Conditions

Diese Entscheidung wird nur erneut geprüft, wenn beispielsweise:

- ein anderes verbindliches System die Förderpipeline und Wissenssicherung vollständig übernimmt,
- Förderarbeit organisatorisch dauerhaft an eine andere fachlich geeignete Stelle übertragen wird,
- das Repository-Zugriffsmodell die vorgesehene Wissenssicherung grundlegend verändert.

Ein neuer Chat oder eine einzelne Ausschreibung reicht nicht aus.

## Related Documents

- `../roles/funding-grants-manager/role.md`
- `../roles/funding-grants-manager/funding-standard.md`
- `../knowledge/funding/README.md`
- `../knowledge/funding/CURRENT-STATE.md`
- `../knowledge/funding/FUNDING-CALENDAR.md`