# Heritage Classic Artwork Spec V1

## Purpose

Dieses Dokument übersetzt die bestehende Heritage-Classic-Referenz in eine kontrollierte Rekonstruktionsspezifikation. Es ist noch **keine freigegebene Produktionsdatei**, sondern die verbindliche Arbeitsgrundlage für den Aufbau des Master-Artworks.

## Core principle

**Die Referenz wird rekonstruiert, nicht neu gestaltet.**

Es werden keine zusätzlichen Logos, Claims, Labels oder dekorativen Elemente ergänzt. Das Motiv besteht ausschließlich aus den in der Referenz sichtbaren Kernelementen.

## Main content

### 1. Source of Truth für diesen Arbeitsschritt

Primäre Referenz:

- Google Drive: `HER-002_Heritage_Classic_Reference.jpg`
- Datei-ID: `1MwsX8CBTWrvT_x66L7XqUGlQYNDW6lzy`

Sekundäre Kontextreferenz:

- Google Drive: `HER-002_Heritage_Collection_Reference.png`
- Datei-ID: `1wVAzQRjiff84ewqQfngQgrbxsApiqdKb`

Die Einzelreferenz zeigt das Motiv in Bordeaux und Vintage Beige sowie einen vorgesehenen Dateiaufbau mit SVG, PDF/X-4, transparentem PNG und Mockup.

### 2. Motivbestandteile

Das Heritage-Classic-Motiv besteht aus exakt drei typografischen Ebenen:

1. `MINGOLSHEIM`
   - Großbuchstaben
   - kräftiger College-/Varsity-Charakter
   - deutlich gebogen/arched
   - optisch stärkstes Element

2. `EST. 1901`
   - Großbuchstaben/Ziffern
   - in einem horizontalen, abgerundeten Rechteck
   - Rahmen in gleicher Motivfarbe wie die Typografie
   - zentriert unter `MINGOLSHEIM`

3. `TURN- UND SPORTVEREIN`
   - Großbuchstaben
   - kondensierte, kräftige Grotesk
   - gerade gesetzt
   - zentriert unter `EST. 1901`

**Kein TuS-Logo ist Bestandteil dieses Heritage-Classic-Brustmotivs.**

Das offizielle TuS-Logo aus `design/logo/` darf daher nicht automatisch in das Artwork eingefügt werden.

### 3. Typografie – Referenzstatus

Die bestehende Referenz benennt folgende Fonts:

- `MINGOLSHEIM`: **COLLEGE BLOCK**, Bold, Arched
- `EST. 1901`: **DIN CONDENSED BOLD**
- `TURN- UND SPORTVEREIN`: **DIN CONDENSED BOLD**

Status dieser Angaben: `Reference – zu verifizieren`.

Vor dem finalen Master-Artwork müssen geprüft werden:

- exakter Fontname/Hersteller,
- tatsächlicher Schnitt,
- Lizenz für Merch/Print,
- Verfügbarkeit für kontrollierte Produktion,
- Übereinstimmung der Buchstabenformen mit der Referenz.

Es ist ausdrücklich **keine** ähnliche College- oder Condensed-Schrift als stiller Ersatz erlaubt.

### 4. Farbvarianten – Referenzstatus

Die Referenz nennt für die Heritage-Kollektion folgende technische Werte:

#### Bordeaux

- HEX: `#80182B`
- RGB: `128 / 24 / 43`
- CMYK: `25 / 100 / 80 / 35`
- Pantone: `1955 C`

#### Vintage Beige

- HEX: `#DED4C1`
- RGB: `222 / 212 / 193`
- CMYK: `10 / 12 / 20 / 0`
- Pantone: `7527 C`

Status aller Werte: `Reference – zu verifizieren`.

Sie dürfen bis zur technischen Prüfung nicht als organisationsweit Approved Corporate Colors behandelt werden.

### 5. Farbrollen im Produkt

#### HER-001 Bordeaux Shirt

- Rohling: Bordeaux
- Artwork: heller Vintage-Beige-/Creme-Ton

#### HER-002 Vintage Beige Shirt

- Rohling: Vintage Beige
- Artwork: Bordeaux

Die beiden Varianten verwenden dieselbe Artwork-Geometrie. Nur die technische Motivfarbe wird variantenspezifisch gewechselt.

### 6. Geometrie und Hierarchie

Aus der Referenz ergeben sich folgende verbindliche Verhältnisregeln:

- `MINGOLSHEIM` ist mit Abstand die breiteste Zeile.
- `EST. 1901` sitzt mittig darunter und ist deutlich schmaler.
- Der Rahmen um `EST. 1901` hat abgerundete Ecken und eine vergleichsweise feine Kontur.
- `TURN- UND SPORTVEREIN` ist breiter als das EST.-Badge, aber schmaler als `MINGOLSHEIM`.
- Alle drei Ebenen sind auf einer gemeinsamen vertikalen Mittelachse ausgerichtet.
- Zwischen den drei Ebenen bleibt sichtbar Luft; sie bilden keine kompakte Logoform.
- Der Bogen von `MINGOLSHEIM` ist moderat und symmetrisch; keine starke Halbkreis-Verformung.

Die exakten Vektormaße werden erst im Rekonstruktionsschritt festgelegt und anschließend gegen die Referenz geprüft.

### 7. Dateiaufbau laut Referenz

Die Referenz sieht vor:

1. SVG – Vektordatei
2. PDF/X-4 – Druckdatei
3. PNG – transparent
4. Mockup

Zusätzlich nennt die Referenz für das PNG:

- 4500 × 5400 px
- 300 dpi
- transparenter Hintergrund

Status: `Reference – produktionstechnisch zu bestätigen`.

Die finale Produktionsdatei richtet sich zusätzlich nach den Anforderungen des Ausstatters.

### 8. Produktionsregel

Die finale Produktionsquelle muss:

- als echtes Vektor-Artwork vorliegen,
- die final bestätigten Fonts entweder korrekt eingebettet oder in Pfade umgewandelt enthalten,
- keine KI-generierten Buchstabenformen enthalten,
- keine Logos enthalten, die nicht Bestandteil der Referenz sind,
- für Bordeaux und Vintage Beige aus derselben Geometrie abgeleitet werden.

### 9. Brand Preflight für Heritage Classic

Vor `Approved Artwork`:

- [ ] Referenzmotiv ohne zusätzliche Elemente rekonstruiert
- [ ] `MINGOLSHEIM`-Font verifiziert
- [ ] DIN-Condensed-Font verifiziert
- [ ] Fontlizenzen geklärt
- [ ] Bogen und Proportionen gegen Referenz geprüft
- [ ] Bordeaux-Farbwert technisch verifiziert
- [ ] Vintage-Beige-Farbwert technisch verifiziert
- [ ] Rohling und reale Textilfarbe bekannt
- [ ] Druckverfahren bekannt
- [ ] reale Druckbreite/-höhe festgelegt
- [ ] SVG-Master erzeugt
- [ ] Produktions-PDF aus demselben Master abgeleitet
- [ ] transparenter PNG-Export aus demselben Master abgeleitet
- [ ] Mockup verwendet exakt dieses Master-Artwork

## Relationship to other documents

- `../README.md`
- `../../../design-production-system.md`
- `../../../typography.md`
- `../../../colors.md`
- `../../../generative-design-standard.md`
- `../../../product-types.md`

## Future development

Nächster Schritt ist die Verifikation der beiden genannten Schriftfamilien und anschließend der kontrollierte Vektoraufbau des Motivs. Erst danach werden HER-001 und HER-002 als Webshop-/Mockupbilder neu erzeugt.