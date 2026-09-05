# ADR-0004: Brand-controlled Design Production

## Status

Accepted

## Date

2026-09-03

## Scope

TuS Digital Organisation – Gestaltung, Brand Identity und Medienproduktion

## Context

In bisherigen Gestaltungsarbeiten entstanden wiederholt zeitaufwändige Iterationsschleifen.

Besonders problematisch waren:

- durch generative Bildwerkzeuge verfälschte TuS-Logos,
- wechselnde oder unklare Fonts,
- ungewollte Änderungen bereits freigegebener Designbestandteile,
- vollständige Neugenerierungen wegen kleiner Detailänderungen,
- fehlende Trennung zwischen Mockup, Entwurf und echter Produktionsdatei,
- fehlendes Produktverständnis vor der Gestaltung,
- verlorene Entscheidungen über bereits freigegebene Richtungen.

Gleichzeitig soll Gestaltung kreativ bleiben und unterschiedliche Produkte wie Merch, Flyer, Plakate, Eintrittskarten, Printmedien, Social Media und digitale Oberflächen passend bedienen.

## Decision

Die TuS Digital Organisation behandelt Brand Identity und Designproduktion als dauerhaftes Organisationswissen.

Daraus folgen verbindlich:

1. Es gibt eine dauerhafte Rolle `Graphic Designer`.
2. Design ist primär dem Verantwortungsbereich Kommunikation zugeordnet und unterstützt weitere Bereiche quer zur Organisation.
3. Offizielle Markenassets werden zentral gepflegt und nicht pro Projekt neu erfunden.
4. Das TuS-Logo wird aus der freigegebenen Originaldatei eingesetzt und nicht generativ rekonstruiert.
5. Freigegebene Fonts und Farben werden zentral dokumentiert; nicht definierte Werte dürfen nicht stillschweigend zu Markenstandards erklärt werden.
6. Vor Gestaltungsbeginn wird die Produktart mit ihren technischen Anforderungen geklärt.
7. Bei längeren Aufgaben werden Approved Direction und Locked Elements festgehalten.
8. Lokale Änderungen sollen nicht unnötig zu vollständigen Neugenerierungen führen.
9. Generative Bildwerkzeuge werden für geeignete kreative Bestandteile eingesetzt; exakte Logos, Texte, QR-Codes, Sponsorassets und andere präzise Elemente werden kontrolliert komponiert.
10. Entwurf, Mockup und Produktionsdatei bleiben klar getrennte Artefakte.

## Rationale

Die Entscheidung schützt gleichzeitig drei Ziele:

- Wiedererkennbarkeit der TuS-Marke,
- weniger unproduktive Designschleifen,
- kreative Freiheit dort, wo sie tatsächlich sinnvoll ist.

Ein zentraler Brand- und Produktionsstandard ist langfristig effizienter als die wiederholte Rekonstruktion von Markenwissen in einzelnen Chats oder Projekten.

## Considered Alternatives

### Freie Gestaltung je Projekt

Verworfen, weil dadurch Markenwissen wiederholt verloren geht und Logos, Farben, Fonts und Stil auseinanderlaufen.

### Alles in einem generativen Prompt erzeugen

Verworfen, weil generative Bildwerkzeuge verbindliche Logos, exakte Texte und andere präzise Elemente nicht zuverlässig reproduzieren.

### Vollständiges Corporate Design sofort definieren

Verworfen, weil aktuell noch nicht alle Fonts, Farbwerte und Produktstandards belastbar freigegeben sind. Diese Bereiche werden aus realer Arbeit kontrolliert ergänzt.

## Consequences

### Positive

- weniger Wiederholungen und Rückschritte,
- Schutz offizieller Markenassets,
- nachvollziehbare Designentscheidungen,
- bessere Produktionsqualität,
- schnelleres Onboarding zukünftiger Designer,
- Brand Identity kann kontrolliert aus realen Arbeiten wachsen.

### Trade-offs

- finale Designs können mehrere Produktionsschritte statt einer einzigen Generierung benötigen,
- Fonts und Farben müssen teilweise erst sauber identifiziert und freigegeben werden,
- längere Designprojekte benötigen einen kleinen dokumentierten Design State.

## Reopen Conditions

Diese Entscheidung wird erneut geprüft, wenn:

- generative Werkzeuge verbindliche Assets nachweislich reproduzierbar und verlustfrei handhaben können,
- ein neues zentrales Design-/Asset-System eingeführt wird,
- reale Arbeit zeigt, dass der Workflow unnötige Komplexität erzeugt,
- ein bewusstes Rebranding des TuS Mingolsheim beschlossen wird.

Ein neuer Chat, ein neues Designwerkzeug oder reine Geschmacksänderungen reichen nicht aus.

## Related Documents

- `../roles/graphic-designer/role.md`
- `../design/brand-identity.md`
- `../design/logo.md`
- `../design/typography.md`
- `../design/colors.md`
- `../design/product-types.md`
- `../design/design-workflow.md`
- `../design/generative-design-standard.md`
- `ADR-0003-central-brand-assets-and-shared-ui.md`

## Supersedes

None

## Superseded By

None