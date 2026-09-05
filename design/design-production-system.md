# TuS Design Production System

## Purpose

Dieses Dokument definiert die verbindliche Produktionsstraße für zuverlässige TuS-Designs. Ziel ist, dass Logos, Schriften, Farben, Texte und freigegebene Grafiken in finalen Medien reproduzierbar und unverändert verwendet werden.

Es trennt kreative Generierung bewusst von kontrollierter Komposition und technischer Produktion.

## Core principle

**KI erzeugt Ideen und variable Bildbestandteile. Verbindliche Markenbestandteile werden aus Originalassets komponiert.**

Ein finales TuS-Design wird nicht daran gemessen, ob eine KI das Logo oder eine Schrift ähnlich darstellen kann. Es verwendet die freigegebene Originalquelle.

## Main content

### 1. Zwei Produktionsstufen

#### Creative Stage

Generative Werkzeuge dürfen insbesondere verwendet werden für:

- Ideen und Art Direction,
- Hintergründe,
- atmosphärische Sportmotive,
- Illustrationen,
- Texturen,
- Fotostile,
- blanke Mockup-Szenen ohne verbindliche Markenbestandteile.

#### Deterministic Production Stage

Folgende Bestandteile werden anschließend kontrolliert aus echten Assets gesetzt:

- TuS-Logo,
- historische Logos nach fachlicher Verifikation,
- Partner- und Sponsorenlogos,
- freigegebene Typografie,
- exakte Texte,
- technische Farben,
- QR-Codes und Barcodes,
- Merch-Artwork,
- andere Locked Assets.

Nach dem Einsetzen eines Locked Assets darf das Gesamtmotiv nicht erneut durch ein generatives Bildmodell gerendert werden.

### 2. Source of Truth

GitHub ist die fachliche Source of Truth für freigegebene Brand Assets und Standards.

Aktuell verbindliche TuS-Logo-Assets:

- `design/logo/tus_logo.png`
- `design/logo/tus_logo_flach.png`

Diese Dateien dürfen nicht nachgezeichnet, rekonstruiert, stilisiert oder durch ähnlich aussehende Logos ersetzt werden.

Google Drive enthält Arbeitsstände, Produktreferenzen, Proofs, Samples, Ausstatterunterlagen und finale Produktionsübergaben. Canva dient als kontrollierte Layout- und Templateoberfläche, nicht als alternative Source of Truth für das Vereinslogo.

### 3. Asset Status

Jedes wiederverwendbare Markenasset erhält einen Status:

- `Approved` – verbindlich und produktiv nutzbar,
- `Reference` – belastbare Referenz, aber keine technische Masterdatei,
- `Proposed` – Vorschlag,
- `Deprecated` – nicht mehr für neue Arbeit verwenden.

Ein Mockup ist niemals automatisch Master-Artwork.

### 4. Locked Assets

Ein Locked Asset darf innerhalb eines Auftrags nur platziert, skaliert und – soweit fachlich freigegeben – in einer vorgesehenen Variante verwendet werden.

Nicht erlaubt sind ohne explizite Freigabe:

- generatives Neuzeichnen,
- Änderung von Proportionen,
- Änderung der inneren Geometrie,
- Ersetzen durch ähnliche Fonts oder Symbole,
- Hinzufügen erfundener Bestandteile,
- automatisches Redesign bei einer kleinen Korrektur.

### 5. Typografie

Finale Texte werden nicht als Bestandteil eines generierten Bildes produziert, wenn Schriftart oder Wortlaut verbindlich sind.

Für jede freigegebene Schrift werden dokumentiert:

- Font Family,
- Schnitt,
- Einsatzrolle,
- Lizenzstatus,
- zulässige Alternativen/Fallbacks,
- Brand Status.

Solange eine Schrift nicht verifiziert und freigegeben ist, bleibt sie `Reference` oder `Proposed`.

### 6. Farben

Semantische Vereinsfarben und technische Produktionsfarben werden getrennt behandelt.

Ein Screenshot oder Mockup ist keine verlässliche Quelle für HEX, CMYK, Pantone oder Textilfarben. Technische Werte werden nur übernommen, wenn ihre Quelle verifiziert oder ausdrücklich freigegeben wurde.

### 7. Templates

Wiederkehrende Medien sollen aus kontrollierten Mastertemplates entstehen. Zielbereiche sind insbesondere:

- Social Media,
- Spieltag/Ergebnis,
- Veranstaltungen,
- Flyer/Plakate,
- Eintrittskarten,
- Webbanner,
- Merch Product Sheets,
- Webshop-Produktbilder.

Templates enthalten feste Zonen für Locked Assets und definieren, welche Elemente verändert werden dürfen.

### 8. Merch Artwork Master

Ein freigegebenes Merch-Motiv wird einmal als echtes Master-Artwork aufgebaut und anschließend für Produktvarianten wiederverwendet.

Beispiel Heritage Classic:

- `MINGOLSHEIM`
- `EST. 1901`
- `TURN- UND SPORTVEREIN`

Das Motiv wird nicht für jedes Mockup neu generiert. Farbvarianten, Platzierung und Produktionsformat werden aus demselben Master abgeleitet.

Webshopbild und Druckdatei müssen auf derselben Artwork-Quelle basieren.

### 9. Brand Preflight

Vor dem Status `FINAL` werden mindestens folgende Punkte geprüft:

- [ ] Produktklasse und Format korrekt
- [ ] ausschließlich freigegebene Logo-Originaldateien verwendet
- [ ] keine generierten oder rekonstruierten Markenlogos vorhanden
- [ ] verbindliche Texte korrekt
- [ ] freigegebene Schrift bzw. dokumentierter Status verwendet
- [ ] Farben aus freigegebener/verifizierter Quelle
- [ ] Partnerlogos als Originalassets
- [ ] Locked Assets nicht verändert
- [ ] bei Merch: Artwork identisch zur Produktionsquelle
- [ ] Druck-/Exportanforderungen geprüft
- [ ] Freigabe dokumentiert

Ein Design mit fehlgeschlagenem Brand Preflight darf nicht `FINAL` heißen.

### 10. Anti-Loop-Regel

Wenn ein Werkzeug Logo, Schrift oder Locked Artwork nicht zuverlässig erhält, wird nicht weiter gepromptet. Die Methode wird gewechselt und das Element kontrolliert komponiert.

Zwei Fehlversuche mit demselben konkreten Problem beenden die generative Methode für dieses Problem.

## Relationship to other documents

Dieses Dokument konkretisiert insbesondere:

- `design/README.md`
- `design/brand-identity.md`
- `design/logo.md`
- `design/colors.md`
- `design/typography.md`
- `design/design-workflow.md`
- `design/generative-design-standard.md`
- `design/product-types.md`

Der Generative Design Standard beschreibt den sicheren Einsatz generativer Werkzeuge. Dieses Dokument definiert zusätzlich die Produktionsstraße bis zum finalen Asset.

## Future development

Als erster Praxistest wird die Heritage-Kollektion verwendet. Das bestehende Heritage-Classic-Referenzmotiv wird in ein kontrolliertes Master-Artwork überführt. Dabei werden tatsächliche Typografie, Farbvarianten, Abstände, Produktionsmaße und Exportformate verifiziert.

Anschließend werden die gewonnenen Regeln auf weitere Merch-Produkte sowie Social-, Print- und Web-Templates übertragen.