# TuS Design Production System

## Purpose

Dieses Dokument definiert die verbindliche Produktionsstraße für zuverlässige TuS-Designs. Ziel ist, dass Logos, Schriften, Farben, Texte und freigegebene Grafiken in finalen Medien reproduzierbar und unverändert verwendet werden.

Es trennt kreative Generierung bewusst von kontrollierter Komposition und technischer Produktion.

## Core principle

**KI erzeugt Ideen und variable Bildbestandteile. Verbindliche Markenbestandteile werden aus Originalassets komponiert.**

> **Entwurf wird gestaltet. Produktion wird konstruiert.**

Ein finales TuS-Design wird nicht daran gemessen, ob eine KI das Logo oder eine Schrift ähnlich darstellen kann. Es verwendet die freigegebene Originalquelle und muss auch typografisch, geometrisch und technisch sauber aufgebaut sein.

## Main content

### 1. Drei Artefaktstufen

Jede mehrstufige Designaufgabe unterscheidet:

1. **Konzept / Entwurf** – gestalterische Richtung, Hierarchie, Komposition und Wirkung.
2. **Reinzeichnung** – präziser Aufbau mit verbindlichen Assets, Schriften, Texten, Abständen und Geometrien.
3. **Produktionsdatei** – technisch und visuell geprüfte Datei für den konkreten Ausgabe- oder Druckprozess.

Ein Mockup oder generiertes Bild ist nicht automatisch eine Reinzeichnung. Eine Reinzeichnung ist nicht automatisch eine geprüfte Produktionsdatei.

### 2. Zwei Produktionsstufen

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

Folgende Bestandteile werden anschließend kontrolliert aus echten Assets oder mit präzisen Layout-/Vektorwerkzeugen gesetzt:

- TuS-Logo,
- historische Logos nach fachlicher Verifikation,
- Partner- und Sponsorenlogos,
- freigegebene Typografie,
- exakte Texte,
- technische Farben,
- QR-Codes und Barcodes,
- Merch-Artwork,
- Rahmen, Raster, Pfade und andere kritische Geometrien,
- andere Locked Assets.

Nach dem Einsetzen eines Locked Assets darf das Gesamtmotiv nicht erneut durch ein generatives Bildmodell gerendert werden.

### 3. Source of Truth

GitHub ist die fachliche Source of Truth für freigegebene Brand Assets und Standards.

Aktuell verbindliche TuS-Logo-Assets:

- `design/logo/tus_logo.png`
- `design/logo/tus_logo_flach.png`

Diese Dateien dürfen nicht nachgezeichnet, rekonstruiert, stilisiert oder durch ähnlich aussehende Logos ersetzt werden.

Google Drive enthält Arbeitsstände, Produktreferenzen, Proofs, Samples, Ausstatterunterlagen und finale Produktionsübergaben. Canva dient als kontrollierte Layout- und Templateoberfläche, nicht als alternative Source of Truth für das Vereinslogo.

Wenn ein vorhandenes Originalasset für die technische Produktion nicht ausreicht, wird dieser Mangel sichtbar gemacht. Es wird kein vermeintlich passendes Ersatzlogo generiert oder ungeprüft nachgezeichnet.

### 4. Asset Status

Jedes wiederverwendbare Markenasset erhält einen Status:

- `Approved` – verbindlich und produktiv nutzbar,
- `Reference` – belastbare Referenz, aber keine technische Masterdatei,
- `Proposed` – Vorschlag,
- `Deprecated` – nicht mehr für neue Arbeit verwenden.

Ein Mockup ist niemals automatisch Master-Artwork.

### 5. Locked Assets

Ein Locked Asset darf innerhalb eines Auftrags nur platziert, skaliert und – soweit fachlich freigegeben – in einer vorgesehenen Variante verwendet werden.

Nicht erlaubt sind ohne explizite Freigabe:

- generatives Neuzeichnen,
- Änderung von Proportionen,
- Änderung der inneren Geometrie,
- Ersetzen durch ähnliche Fonts oder Symbole,
- Hinzufügen erfundener Bestandteile,
- automatisches Redesign bei einer kleinen Korrektur.

### 6. Typografie

Finale Texte werden nicht als Bestandteil eines generierten Bildes produziert, wenn Schriftart oder Wortlaut verbindlich sind.

Für jede freigegebene Schrift werden dokumentiert:

- Font Family,
- Schnitt,
- Einsatzrolle,
- Lizenzstatus,
- zulässige Alternativen/Fallbacks,
- Brand Status.

Solange eine Schrift nicht verifiziert und freigegeben ist, bleibt sie `Reference` oder `Proposed`.

Typografie wird in der Reinzeichnung nicht nur auf den richtigen Font geprüft, sondern auch als Geometrie behandelt. Dazu gehören insbesondere:

- Größe,
- Laufweite / Tracking,
- Kerning bei auffälligen Buchstabenpaaren,
- Zeilenabstand,
- horizontale und vertikale Ausrichtung,
- optische Balance,
- konsistente Baseline.

Eine stille Font-Substitution ist nicht zulässig.

### 7. Bogen-, Kreis- und Pfadtext

Text entlang eines Bogens, Kreises oder anderen Pfades wird als echter Pfadtext oder mit einer anderen reproduzierbaren geometrischen Methode gesetzt.

Nicht zulässig als finale Produktionsmethode sind:

- einzeln nach Augenmaß rotierte Buchstaben,
- generativ erzeugter Bogen-Text,
- perspektivisch verzerrter Rastertext als Ersatz für Pfadtext,
- uneinheitliche Baselines oder zufällige Rotationssprünge.

Bei Pfadtext werden mindestens geprüft:

- gemeinsamer Radius bzw. definierter Pfad,
- konsistente Baseline,
- gleichmäßige optische Laufweite,
- zentrierte Platzierung,
- symmetrische Anfangs- und Endposition,
- ruhiges Wortbild aus normaler Betrachtungsdistanz.

### 8. Farben

Semantische Vereinsfarben und technische Produktionsfarben werden getrennt behandelt.

Ein Screenshot oder Mockup ist keine verlässliche Quelle für HEX, CMYK, Pantone oder Textilfarben. Technische Werte werden nur übernommen, wenn ihre Quelle verifiziert oder ausdrücklich freigegeben wurde.

### 9. Kritische Geometrien

Rahmen, Kreise, Linien, Raster, Abstände, Symmetrien und andere präzise Formen werden deterministisch aufgebaut.

Wenn ein Element exakt sein muss, ist freie Bildgenerierung nicht die Produktionsmethode.

Kleine Korrekturen werden lokal umgesetzt. Ein bereits funktionierendes Gesamtmotiv wird nicht neu generiert, nur weil ein einzelner Abstand, Text oder Rahmen korrigiert werden muss.

### 10. Templates

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

Templates entstehen bevorzugt aus real erfolgreich produzierten Arbeiten. Sie werden nicht als Dokumentationsselbstzweck vorab erzeugt.

### 11. Merch Artwork Master

Ein freigegebenes Merch-Motiv wird einmal als echtes Master-Artwork aufgebaut und anschließend für Produktvarianten wiederverwendet.

Beispiel Heritage Classic:

- `MINGOLSHEIM`
- `EST. 1901`
- `TURN- UND SPORTVEREIN`

Das Motiv wird nicht für jedes Mockup neu generiert. Farbvarianten, Platzierung und Produktionsformat werden aus demselben Master abgeleitet.

Webshopbild und Druckdatei müssen auf derselben Artwork-Quelle basieren.

### 12. Geeignete Produktionswerkzeuge

Für Reinzeichnung und Produktionsdaten wird ein Werkzeug verwendet, das die benötigte Präzision zuverlässig unterstützt, insbesondere:

- Vektor-/Layoutsoftware,
- kontrollierte SVG-Erzeugung,
- professionelle Seiten-/Drucklayoutsoftware,
- andere Werkzeuge mit echten Text-, Pfad-, Ebenen- und Exportfunktionen.

Ein Bildgenerator allein ist kein ausreichendes Reinzeichnungswerkzeug für markenkritische Druckdateien.

Die konkrete Software darf wechseln. Die Qualitätsanforderung bleibt.

### 13. Produktionsparameter

Produktionsparameter werden nicht geraten.

Wenn Druckerei oder Ausstatter Vorgaben zu Beschnitt, Farbprofil, Mindestauflösung, Maximalformat, Transparenz, Sonderfarben, Konturen oder Dateiformat macht, haben diese technischen Vorgaben Vorrang.

Liegt ein Locked Asset nur als Rasterdatei vor, wird es nicht automatisch durch Nachzeichnen oder KI-Vektorisierung verändert. Ist zwingend ein Vektorformat erforderlich, wird eine offizielle Vektorquelle beschafft oder eine kontrollierte, ausdrücklich freigegebene Ableitung erstellt.

### 14. Brand- und Production-Preflight

Vor dem Status `FINAL` wird die vollständige `print-preflight-checklist.md` durchlaufen.

Mindestens geprüft werden:

- Produktklasse und Format,
- Original-Logo-Assets,
- verbindliche Texte,
- freigegebene bzw. bestätigte Typografie,
- Bogen-/Pfadtext und andere kritische Geometrien,
- Farben,
- Partnerlogos,
- Locked Assets,
- technische Druck-/Exportanforderungen,
- reale visuelle Qualität der exportierten Datei,
- erforderliche menschliche Freigabe.

Ein Design mit fehlgeschlagenem Preflight darf nicht `FINAL`, `druckfertig` oder `produktionsbereit` heißen.

### 15. Visuelle QA

Eine Datei kann technisch korrekt exportiert und trotzdem gestalterisch schlecht sein.

Vor Freigabe wird deshalb die tatsächlich exportierte Ausgabe visuell geprüft. Insbesondere:

- wirkt die Typografie sauber und professionell,
- sind Bögen, Abstände und Achsen ruhig,
- sind Größenverhältnisse ausgewogen,
- gibt es sichtbare Artefakte oder Unschärfen,
- entspricht die Reinzeichnung der Approved Direction,
- wurden Locked Elements unverändert übernommen.

### 16. Anti-Loop-Regel

Wenn ein Werkzeug Logo, Schrift, Pfadtext oder Locked Artwork nicht zuverlässig erhält, wird nicht weiter gepromptet. Die Methode wird gewechselt und das Element kontrolliert komponiert.

Zwei Fehlversuche mit demselben konkreten Problem beenden die generative Methode für dieses Problem.

> **Korrigiere das fehlerhafte Element – regeneriere nicht das gesamte Design.**

## Relationship to other documents

Dieses Dokument konkretisiert insbesondere:

- `design/README.md`
- `design/brand-identity.md`
- `design/logo.md`
- `design/colors.md`
- `design/typography.md`
- `design/design-workflow.md`
- `design/generative-design-standard.md`
- `design/print-preflight-checklist.md`
- `design/product-types.md`
- `../decisions/ADR-0004-brand-controlled-design-production.md`

Der Generative Design Standard beschreibt den sicheren Einsatz generativer Werkzeuge. Dieses Dokument definiert die Produktionsstraße bis zum finalen Asset.

## Future development

Als erster Praxistest wird die Heritage-Kollektion verwendet. Das bestehende Heritage-Classic-Referenzmotiv wird in ein kontrolliertes Master-Artwork überführt. Dabei werden tatsächliche Typografie, Farbvarianten, Abstände, Produktionsmaße und Exportformate verifiziert.

Anschließend werden die gewonnenen Regeln auf weitere Merch-Produkte sowie Social-, Print- und Web-Templates übertragen.