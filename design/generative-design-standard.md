# Generative Design Standard

## Purpose

Dieses Dokument definiert den sicheren und effizienten Einsatz generativer Bildwerkzeuge für Gestaltung des TuS Mingolsheim.

Es adressiert insbesondere bekannte Fehler aus früheren Designrunden: verfälschte Logos, unzuverlässige Schrift, ungewollte Änderungen bereits guter Elemente und wiederholte Vollgenerierungen ohne Fortschritt.

## Core Principle

Generative Werkzeuge erzeugen kreative Bildbestandteile.

Sie sind nicht die Source of Truth für Logos, exakte Typografie, QR-Codes, Sponsorassets oder andere präzise Marken- und Produktionsdaten.

## Main Content

### 1. Generieren und Komponieren sind verschiedene Arbeitsschritte

Ein finales TuS-Design darf aus mehreren Schritten entstehen:

1. generatives Motiv / Hintergrund / Illustration,
2. gezielte Bildbearbeitung,
3. Einsetzen offizieller Logos und Assets,
4. Setzen exakter Texte mit freigegebener Typografie,
5. technische Produktionsvorbereitung.

Es ist nicht erforderlich und häufig sogar falsch, alles in einem einzigen Generierungsschritt erzeugen zu wollen.

### 2. Das offizielle TuS-Logo wird nicht generiert

Wenn das offizielle TuS-Logo im finalen Produkt erscheinen soll, wird die Originaldatei aus `design/logo/` verwendet.

Ein generatives Modell darf nicht damit beauftragt werden, das Logo:

- nachzuzeichnen,
- neu zu interpretieren,
- in einen Stil umzuwandeln,
- aus einem Referenzbild zu rekonstruieren,
- als Teil einer komplett neu erzeugten Szene erneut zu rendern.

Wenn eine generierte Vorschau ein verfälschtes Logo enthält, ist dieses Logo keine zulässige Produktionsgrundlage.

### 3. Sponsor- und Partnerlogos ebenfalls schützen

Dasselbe Prinzip gilt für fremde Markenassets.

Partnerlogos werden als Originalassets platziert und nicht generativ neu erzeugt.

### 4. Exakte Texte separat setzen

Generative Bildwerkzeuge sind nicht die bevorzugte Methode für finale exakte Texte.

Besonders kritisch sind:

- Vereinsname,
- Personennamen,
- Slogans,
- Jahreszahlen,
- Koordinaten,
- Spielinformationen,
- Preise,
- URLs,
- Sponsorennamen,
- Trikot-/Produkttexte.

Diese Texte werden nach Möglichkeit in einem kontrollierten Layoutschritt mit der richtigen Schrift gesetzt.

### 5. QR-Codes, Barcodes und maschinenlesbare Elemente niemals generieren

QR-Codes, Barcodes, Ticketsicherheitsmerkmale und ähnliche maschinenlesbare Elemente werden technisch korrekt erzeugt und anschließend in das Design eingesetzt.

### 6. Generative Werkzeuge dort einsetzen, wo sie stark sind

Geeignete Aufgaben sind insbesondere:

- Stimmungsbilder,
- Illustrationen,
- Hintergründe,
- Texturen,
- abstrakte Formen,
- atmosphärische Sportmotive,
- kreative Bildideen,
- Mockup-Szenen,
- stilistische Exploration.

### 7. Locked Elements schützen

Bei einer Bearbeitung bestehender Entwürfe wird vor dem Tool-Einsatz festgelegt:

- was geändert werden soll,
- was unverändert bleiben muss.

Wenn das verwendete Werkzeug gesperrte Bestandteile nicht zuverlässig erhalten kann, wird nicht das gesamte Design erneut generiert. Stattdessen wird eine gezieltere Bearbeitungs- oder Compositing-Methode gewählt.

### 8. Keine unnötige Vollregeneration

Wenn beispielsweise nur:

- eine Farbe,
- ein Schriftzug,
- eine Position,
- ein Rahmen,
- ein einzelnes Symbol

geändert werden soll, darf ein bereits freigegebenes Gesamtmotiv nicht ohne Not vollständig neu generiert werden.

### 9. Zwei erfolglose Generierungen beenden die Methode

Wenn zwei Generierungen dasselbe konkrete Problem nicht lösen, wird die Promptformulierung nicht endlos weiter variiert.

Es wird entschieden, ob:

- das Element manuell gesetzt,
- separat generiert,
- aus einem Originalasset übernommen,
- mit einem anderen Werkzeug bearbeitet

werden muss.

### 10. Referenztreue explizit definieren

Vor einer Generierung wird geklärt, welche Referenzbestandteile:

- nur inspirieren,
- stilistisch prägend sind,
- möglichst exakt erhalten werden müssen,
- überhaupt nicht verändert werden dürfen.

### 11. Produktionsdatei bleibt kontrolliert

Ein KI-generiertes Bild kann Bestandteil einer Produktionsdatei sein.

Die finale Produktionsdatei wird jedoch separat auf technische und markenbezogene Korrektheit geprüft.

Generierung ersetzt keine Druckvorstufe.

## Relationship to other documents

- `design-workflow.md`
- `brand-identity.md`
- `logo.md`
- `typography.md`
- `product-types.md`
- `../standards/iteration-and-progress.md`

## Future Development

Dieser Standard wird anhand realer Generierungs- und Bearbeitungsfälle erweitert. Neue Regeln sollen vor allem dort entstehen, wo ein Werkzeug wiederholt typische Fehler erzeugt oder ein bestimmter Workflow nachweislich besser funktioniert.