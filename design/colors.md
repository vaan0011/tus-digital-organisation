# Colors

## Purpose

Dieses Dokument definiert, wie Farben für die TuS Brand Identity dokumentiert, freigegeben und verwendet werden.

## Core Principle

Farben werden nicht aus Screenshots, Mockups oder Erinnerungen geschätzt, wenn eine verbindliche Quelle verfügbar ist.

## Main Content

### 1. Aktueller Status

Für digitale TuS-Oberflächen ist die Rollenlogik der Farbpalette verbindlich definiert.

Die vollständige medienübergreifende Corporate-Design-Palette für Merch, Print und Vereinskommunikation ist weiterhin nicht vollständig als `Approved` dokumentiert.

Für die öffentliche Website gilt:

- **Primary / Brand Red:** muss aus dem freigegebenen flachen Original-Logo `logo/tus_logo_flach.png` technisch verifiziert und anschließend hier mit exaktem HEX/RGB-Wert dokumentiert werden.
- **White:** `#FFFFFF`, Status `Approved – Digital UI`.
- neutrale Text-, Surface-, Border- und Statusfarben werden im Theme als semantische UI-Tokens geführt und müssen WCAG-konforme Kontraste erfüllen.
- ein nicht verifizierter Rotwert darf **nicht** als dauerhafter `Approved`-Brandwert festgeschrieben werden.

Damit ist für die Theme-Implementierung die Herkunft des Primärrots verbindlich entschieden, auch wenn der exakte technische Wert noch separat aus dem Originalasset extrahiert werden muss.

### 2. Digital UI Farbrollen

Öffentliche WordPress-Oberflächen verwenden mindestens folgende semantische Rollen:

- `primary` – TuS Brand Red aus dem verifizierten Originalasset
- `on-primary` – kontrastierende Schrift/Icon-Farbe auf Primary
- `background` – Hauptseitenhintergrund
- `surface` – Karten, Panels und abgesetzte Flächen
- `text` – primärer Text
- `muted` – sekundärer Text
- `border` – dezente Trennlinien und Umrandungen
- `success`
- `warning`
- `error`

Plugins verwenden diese Rollen und keine eigene parallele Markenpalette.

### 3. Farbregister

Jede freigegebene Markenfarbe wird mit mindestens folgenden Angaben dokumentiert:

- Name / Funktion,
- Status (`Approved`, `Reference`, `Proposed`, `Deprecated`),
- HEX,
- RGB,
- CMYK, soweit für Print erforderlich,
- optional Pantone/RAL, wenn produktionstechnisch relevant,
- vorgesehene Einsatzbereiche.

Aktueller Digital-UI-Eintrag:

| Rolle | Status | Wert | Quelle / Hinweis |
|---|---|---|---|
| White | `Approved – Digital UI` | `#FFFFFF` | neutrale UI-Basis |
| Primary / Brand Red | `Pending technical verification` | noch offen | verbindlich aus `logo/tus_logo_flach.png` ableiten, nicht schätzen |

### 4. Keine Farbschätzung bei verbindlichen Assets

Das offizielle TuS-Logo wird aus der Quelldatei verwendet und nicht manuell anhand geschätzter Farbwerte nachgebaut.

Dasselbe gilt für Partner- und Sponsorenlogos.

Das Primärrot der Website wird erst dann als konkreter `Approved`-Wert registriert, wenn es technisch direkt aus dem freigegebenen Originalasset oder einer gleichwertig belastbaren Vereinsquelle verifiziert wurde.

### 5. Produkt und Produktionsverfahren berücksichtigen

Die gleiche Markenfarbe kann je nach Medium unterschiedliche technische Definitionen benötigen.

Beispiele:

- RGB/HEX für digitale Medien,
- CMYK oder Sonderfarben für Druck,
- Stick- oder Textilgarn-Farben für Merch,
- Folien-/Lack-/Materialfarben für physische Anwendungen.

Eine technische Anpassung an ein Produktionsverfahren darf die Markenwirkung nicht unnötig verändern.

### 6. Kontrast und Lesbarkeit

Farbkombinationen müssen neben Markenwirkung auch ausreichende Lesbarkeit gewährleisten.

Insbesondere bei Text, Buttons, Navigation, Eintrittskarten, Spielplänen und informationsreichen Oberflächen hat Verständlichkeit Vorrang vor dekorativen Effekten.

Für digitale Oberflächen wird WCAG 2.2 AA als Zielstandard verwendet.

Statusfarben vermitteln Information nie ausschließlich über Farbe.

### 7. Theme als Runtime-Quelle

Die freigegebenen Farbrollen werden technisch im aktiven TuS-WordPress-Theme bereitgestellt, bevorzugt über WordPress Global Styles und/oder stabile semantische CSS-Custom-Properties.

Plugins duplizieren die konkreten Brandwerte nicht. Sie konsumieren semantische Rollen wie `primary`, `text`, `surface` und `border`.

## Relationship to other documents

- `brand-identity.md`
- `logo.md`
- `homepage-standard.md`
- `ui-standard.md`
- `product-types.md`
- `design-workflow.md`

## Future Development

Nächster verbindlicher Schritt ist die technische Verifizierung des TuS-Primärrots direkt aus `logo/tus_logo_flach.png` und die Ergänzung des exakten HEX-/RGB-Werts in diesem Farbregister.

Weitere Markenfarben für Print, Merch und Vereinskommunikation werden erst aus belastbaren Quellen bzw. bewusst getroffenen Markenentscheidungen ergänzt.