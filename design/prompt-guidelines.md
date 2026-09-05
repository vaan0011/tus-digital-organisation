# Design Prompt Guidelines

## Purpose

Dieses Dokument definiert, wie Prompts für generative Designarbeit aufgebaut werden, damit Ziele, feste Bestandteile und erlaubte Änderungen eindeutig bleiben.

## Core Principle

Ein guter Prompt beschreibt nicht nur, was entstehen soll.

Er beschreibt ebenso klar, was nicht verändert werden darf.

## Main Content

### 1. Prompt-Struktur

Ein belastbarer Designprompt enthält möglichst diese Blöcke:

1. **Product Context** – welches Produkt entsteht und wofür,
2. **Canvas / Format** – Seitenverhältnis, Maße oder Zielmedium,
3. **Visual Direction** – gewünschte Wirkung und Stil,
4. **Required Content** – notwendige Bildbestandteile,
5. **Locked Elements** – unveränderliche Bestandteile,
6. **Editable Elements** – Bereiche, die verändert werden dürfen,
7. **Technical Constraints** – produktionsrelevante Grenzen,
8. **Avoid** – ausdrücklich unerwünschte Effekte.

### 2. Logo nicht als Generierungsaufgabe formulieren

Wenn das finale Design das TuS-Logo benötigt, lautet die Aufgabe nicht „erzeuge das TuS-Logo korrekt“.

Stattdessen wird das Motiv so erzeugt, dass an der vorgesehenen Stelle genügend Raum für das spätere Einsetzen des offiziellen Logoassets bleibt.

Das Original wird anschließend separat komponiert.

### 3. Exakte Typografie separat behandeln

Finale Texte werden nicht unnötig in den Bildprompt eingebaut, wenn sie später kontrolliert gesetzt werden können.

Bei Entwurfsbildern dürfen Platzhalter oder freie Flächen vorgesehen werden.

### 4. Änderungs-Prompts

Bei einer bestehenden Approved Direction beginnt ein Änderungsauftrag gedanklich mit:

**Change only:**

- die konkret gewünschten Änderungen.

**Keep unchanged:**

- alle bereits freigegebenen Elemente.

Das verhindert, dass ein Werkzeug aus einer lokalen Änderung ungewollt ein komplettes Redesign macht.

### 5. Referenzen klassifizieren

Referenzbilder werden im Prompt ihrer Rolle entsprechend beschrieben:

- Inspiration,
- Direction,
- Exact Element,
- Locked Asset.

Eine Referenz wird nicht gleichzeitig als lose Inspiration und als unveränderliche Vorlage behandelt.

### 6. Nicht durch Prompt-Länge kompensieren

Wenn ein Werkzeug ein bestimmtes Detail nach zwei Versuchen nicht zuverlässig kontrollieren kann, wird der Prompt nicht endlos erweitert.

Stattdessen folgt die Zwei-Versuche-Regel aus `design-workflow.md` und `generative-design-standard.md`.

### 7. Produktionsanforderungen nicht vortäuschen

Begriffe wie „8K“, „print ready“ oder „vector“ machen eine generierte Datei nicht automatisch zu einer echten Produktionsdatei.

Technische Qualität wird nach der Generierung separat geprüft.

## Relationship to other documents

- `generative-design-standard.md`
- `design-workflow.md`
- `product-types.md`
- `logo.md`
- `typography.md`

## Future Development

Konkrete wiederverwendbare Promptbausteine können ergänzt werden, wenn sich in realen TuS-Projekten stabile Muster ergeben. Promptbibliotheken sollen aus bewährter Arbeit entstehen und nicht aus theoretischer Vollständigkeit.