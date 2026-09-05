# Brand Asset Master

## Purpose

Dieser Ordner bildet die zentrale fachliche Struktur für wiederverwendbare TuS Brand Assets. Er verhindert, dass Originaldateien aus Mockups, Screenshots oder generativen Bildern rekonstruiert werden.

## Core principle

**Original vor Rekonstruktion.**

Existiert ein freigegebenes Asset, wird ausschließlich dieses Asset oder eine daraus kontrolliert erzeugte technische Variante verwendet.

## Main content

### Vorgesehene Struktur

- `logos/` – Verweise bzw. künftig konsolidierte freigegebene Vereinslogo-Varianten
- `typography/` – Font-Manifest, Rollen, Schnitte, Lizenz- und Statusinformationen; keine Fontdateien ohne geklärte Lizenz
- `colors/` – technische Farbdefinitionen mit Quelle und Status
- `graphics/` – wiederverwendbare freigegebene grafische Elemente

Bis zu einer kontrollierten Migration bleiben die aktuellen offiziellen Logo-Dateien in `design/logo/` verbindlich.

### Asset Manifest

Für wichtige Assets sollen mindestens dokumentiert werden:

- eindeutige Bezeichnung,
- Dateipfad,
- Status (`Approved`, `Reference`, `Proposed`, `Deprecated`),
- Einsatzbereich,
- Quelle,
- erlaubte Varianten,
- Einschränkungen.

### Keine stillen Ableitungen

Nicht aus Screenshots oder Mockups ableiten:

- Logos,
- Fonts,
- technische Farben,
- exakte Vektorgeometrie,
- QR-/Barcodes,
- Partnerlogos.

## Relationship to other documents

- `../design-production-system.md`
- `../logo.md`
- `../typography.md`
- `../colors.md`
- `../generative-design-standard.md`

## Future development

Die Struktur wird schrittweise mit verifizierten Assets und Manifesten gefüllt. Als erster Anwendungsfall dient das Heritage-Classic-Merch-Artwork.