# TuS Brand Identity

## Purpose

Dieses Dokument beschreibt die verbindliche Grundlage der visuellen Identität des TuS Mingolsheim.

Es verbindet Marke, Gestaltung und Produktion so, dass unterschiedliche Medien erkennbar zum selben Verein gehören.

## Core Principle

Die Marke wird nicht bei jedem Produkt neu erfunden.

Offizielle Assets und freigegebene Designentscheidungen sind Organisationswissen und werden wiederverwendet.

Für WordPress gilt zusätzlich:

> **Die Brand Identity wird zur Laufzeit vom aktiven Theme bereitgestellt. Plugins liefern Funktion und Struktur, nicht ihre eigene Markenidentität.**

Ein späterer Theme-Wechsel darf deshalb nicht erfordern, Farben oder Schriften in jedem TuS-Plugin einzeln anzupassen.

## Main Content

### 1. Markencharakter

Die visuelle Kommunikation soll den TuS Mingolsheim als lebendigen, bodenständigen, gemeinschaftlichen und zugleich modernen Verein zeigen.

Gestaltung darf sportlich, emotional und zeitgemäß sein, ohne beliebig oder austauschbar zu wirken.

### 2. Verbindliche Quellen

Die fachlich verbindlichen Details liegen in:

- `logo.md` für offizielle Logos,
- `colors.md` für freigegebene Markenfarben und deren semantische Bedeutung,
- `typography.md` für freigegebene Schriften,
- `visual-language.md` für Bild- und Formensprache,
- `ui-standard.md` für digitale Bedienoberflächen,
- `product-types.md` für produktspezifische Anforderungen.

Diese Dokumente sind die Governance- und Design-Source-of-Truth. Einzelne Entwürfe, Chats oder generierte Bilder ersetzen sie nicht.

Für die **technische Ausspielung in WordPress** ist das aktive TuS-Theme die Runtime-Source-of-Truth für Brand-Tokens wie Farben und Typografie. Das Theme setzt die freigegebenen Markenentscheidungen über WordPress Global Styles, Theme-Konfiguration und/oder stabile CSS-Custom-Properties um.

Plugins duplizieren diese Werte nicht als eigene Markenquelle.

### 3. Theme und Plugins

Für TuS-WordPress-Produkte gilt:

- öffentliche Plugin-Komponenten erben Farben und Typografie aus dem aktiven Theme,
- Plugins verwenden bevorzugt WordPress Global Styles bzw. vom Theme bereitgestellte semantische CSS-Variablen,
- Markenfarben und Markenfonts werden nicht als feste Hex-Werte oder eigene Font-Dateien in jedem Plugin dupliziert,
- ein Plugin darf neutrale technische Fallbacks besitzen, wenn ein Theme-Token fehlt; der Fallback wird nicht zur zweiten Brand-Source-of-Truth,
- Layout-, Abstands-, Accessibility- und Interaktionsregeln dürfen im Plugin definiert werden, soweit sie funktional erforderlich sind,
- Original-Logos und andere Locked Assets werden weiterhin aus der zentral freigegebenen Asset-Quelle verwendet,
- ein Theme-Wechsel muss ohne fachliche Codeänderung in den Plugins möglich bleiben, solange die vereinbarte Token-/Style-Schnittstelle erfüllt wird.

Interne WordPress-Backend-Oberflächen dürfen sich stärker an nativen WordPress-Admin-Mustern orientieren. Sie sollen funktional konsistent bleiben, müssen aber nicht die öffentliche Theme-Gestaltung künstlich nachbauen.

### 4. Status von Markenbestandteilen

Jeder Markenbestandteil gehört zu einem der folgenden Zustände:

- **Approved** – verbindlich freigegeben und wiederzuverwenden,
- **Reference** – aus bestehender Arbeit ableitbar, aber noch nicht als vollständiger Markenstandard beschlossen,
- **Proposed** – Vorschlag, noch nicht verbindlich,
- **Deprecated** – nicht mehr für neue Arbeit verwenden.

Ein Designer darf einen noch offenen Bereich nicht eigenmächtig als `Approved` behandeln.

### 5. Wiedererkennbarkeit vor Effekthascherei

Ein starkes Einzelmotiv darf die Vereinsidentität nicht verdrängen.

Insbesondere bleiben:

- offizielles Logo,
- freigegebene Typografie,
- definierte Farben,
- zentrale Markenelemente

auch dann verbindlich, wenn ein kreativer Entwurf mit anderen Varianten optisch spektakulärer wirken würde.

### 6. Produktgerechte Anwendung

Brand Identity bedeutet nicht, jedes Medium identisch zu gestalten.

Ein Gym-Shirt, ein Spieltagsmagazin, ein Plakat, eine Eintrittskarte und ein WordPress-Interface dürfen unterschiedliche Ausdrucksformen besitzen.

Sie müssen jedoch dieselbe Markenbasis respektieren.

Produktspezifische Unterschiede werden in `product-types.md` beschrieben.

### 7. Originale statt Rekonstruktionen

Verbindliche Assets werden aus ihren freigegebenen Quelldateien übernommen.

Sie werden nicht:

- aus Screenshots ausgeschnitten, wenn eine Originaldatei vorhanden ist,
- durch KI nachgezeichnet,
- aus einem Mockup rekonstruiert,
- aus einer niedrig aufgelösten Vorschau neu gebaut.

### 8. Lernende Brand Identity

Die Brand Identity darf wachsen.

Neue wiederkehrende Gestaltungsmuster werden aber erst nach realer Anwendung und Freigabe zum Standard.

Eine erfolgreiche Einzelgrafik wird nicht automatisch zur neuen Markenregel.

## Relationship to other documents

- `README.md`
- `logo.md`
- `colors.md`
- `typography.md`
- `visual-language.md`
- `ui-standard.md`
- `product-types.md`
- `design-workflow.md`
- `../decisions/ADR-0003-central-brand-assets-and-shared-ui.md`
- `../standards/software-development-quality-standard.md`

## Future Development

Die Brand Identity wird durch freigegebene reale Arbeiten weiter konkretisiert. Farben, Typografie und weitere digitale Brand-Tokens werden im Theme als technische Runtime-Konfiguration gepflegt, damit die Plugins von konkreten Markenwerten entkoppelt bleiben.