# Typography

## Purpose

Dieses Dokument definiert, wie Schriften in der TuS Brand Identity ausgewählt, freigegeben und verwendet werden.

## Core Principle

Eine Schrift wird nicht durch häufige Verwendung automatisch zur Hausschrift.

Nur dokumentierte und freigegebene Fonts sind verbindliche Markenbestandteile.

## Main Content

### 1. Aktueller Status

Für digitale öffentliche TuS-Oberflächen ist **Barlow** als UI-Schrift freigegeben.

Status: `Approved – Digital UI`

Diese Freigabe gilt insbesondere für:

- öffentliche TuS-Homepage,
- öffentliche WordPress-Frontend-Komponenten,
- weitere digitale TuS-Oberflächen, die ihre Brand-Typografie aus dem aktiven Theme beziehen.

Sie macht Barlow ausdrücklich **nicht automatisch zur universellen TuS-Hausschrift für Merch, Print, Plakate, Eintrittskarten oder bestehende referenzgebundene Designs**.

Für diese Medien bleibt die vollständige übergreifende TuS-Typografie teilweise offen und wird aus belastbaren Referenzen bzw. Quelldateien weiterentwickelt.

### 2. Approved Digital UI Font

#### Barlow

- **Status:** `Approved – Digital UI`
- **Schriftfamilie:** Barlow
- **Einsatz:** öffentliche Website und digitale UI
- **Lizenz:** offen lizenzierte Schriftfamilie; für die technische Einbindung wird eine dauerhaft reproduzierbare, datenschutzgerechte Bereitstellung bevorzugt
- **Bevorzugte Schnitte:**
  - `400` Regular für Fließtext
  - `500` Medium für hervorgehobene UI-Texte
  - `600` SemiBold für Zwischenüberschriften und wichtige Labels
  - `700` Bold für Hauptüberschriften und starke Hervorhebungen
- **Fallback:** `Arial, Helvetica, sans-serif`

Die öffentliche Homepage soll Barlow nach Möglichkeit selbst bzw. über das Theme ausliefern, statt für den Seitenaufruf zwingend einen externen Font-Dienst zu benötigen.

### 3. Font-Register

Jede künftig freigegebene Schrift wird hier mit mindestens folgenden Angaben registriert:

- Name der Schriftfamilie,
- Status (`Approved`, `Reference`, `Proposed`, `Deprecated`),
- zulässige Schnitte,
- typische Einsatzbereiche,
- Quelle bzw. Bezugsort,
- Lizenzhinweis, soweit relevant,
- erlaubte Ersatzschrift, falls eine definiert ist.

### 4. Präferenz für frei verfügbare Fonts

Bei **neuen, noch nicht referenzgebundenen** Schriftentscheidungen werden frei verfügbare bzw. offen lizenzierte Fonts bevorzugt, sofern sie:

- gestalterisch zum TuS passen,
- technisch für den vorgesehenen Einsatz geeignet sind,
- in den benötigten Schnitten verfügbar sind,
- langfristig zuverlässig bezogen und verwendet werden können,
- eine saubere Lizenzierung für den jeweiligen Zweck erlauben.

Diese Präferenz dient Reproduzierbarkeit, Kostenkontrolle und langfristiger Unabhängigkeit.

Sie rechtfertigt ausdrücklich **keine** stille Ersetzung eines Fonts, der durch ein freigegebenes Referenzdesign, ein bestehendes Artwork oder eine konkrete Produktionsvorgabe festgelegt ist.

### 5. Keine stillen Substitutionen

Wenn ein Produkt eine bestimmte Schrift verlangt, darf sie nicht stillschweigend durch eine optisch ähnliche Schrift ersetzt werden.

Insbesondere bei:

- Merchandising,
- Logos und Wortmarken,
- Plakaten,
- Eintrittskarten,
- Printmedien,
- wiederkehrenden Kampagnen

muss die verwendete Schrift nachvollziehbar sein.

Wenn eine Referenzschrift nicht verfügbar oder nicht sicher identifizierbar ist, bleibt dies ein offener technischer Punkt statt durch eine ähnliche Schrift verdeckt zu werden.

### 6. Generative Bildwerkzeuge sind keine Typografie-Engine

Finale Texte, Vereinsnamen, Koordinaten, Slogans, Partnernamen und andere exakte Schriftinformationen sollen nicht durch Bildgenerierung erzeugt werden, wenn korrekte Buchstabenformen und reproduzierbare Typografie wichtig sind.

Der bevorzugte Ablauf lautet:

1. Motiv bzw. Hintergrund gestalten,
2. Text separat mit der richtigen Schrift setzen,
3. finale Komposition prüfen.

### 7. UI-Typografie ist ein eigener Anwendungsfall

Digitale Bedienoberflächen dürfen aus Gründen von Lesbarkeit, Performance und Systemintegration eine definierte UI-Schrift verwenden.

Für öffentliche TuS-Weboberflächen ist diese Rolle durch Barlow besetzt.

Plugins definieren Barlow nicht eigenständig. Sie erben die Typografie aus dem aktiven Theme. Damit bleibt das Theme die technische Runtime-Source-of-Truth und ein späterer Theme-Wechsel erfordert keine fachliche Änderung in jedem Plugin.

Eine UI-Schrift wird dadurch nicht automatisch zur Marken-Hausschrift für Merch oder Print.

## Relationship to other documents

- `CURRENT-STATE.md`
- `REFERENCE-REGISTER.md`
- `brand-identity.md`
- `homepage-standard.md`
- `design-workflow.md`
- `design-production-system.md`
- `generative-design-standard.md`
- `ui-standard.md`

## Future Development

Die vollständige medienübergreifende TuS-Typografie wird anhand vorhandener Designs und Quelldateien weiter bestimmt und freigegeben.

Barlow bleibt bis zu einer bewusst dokumentierten Änderung die verbindliche Digital-/UI-Schrift für die öffentliche TuS-Weboberfläche.