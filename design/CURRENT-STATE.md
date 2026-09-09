# Design Current State

Stand: 2026-09-10 – erste Chat-to-Brain-Migration Brand & Merch

## Purpose

Dieses Dokument ist der kompakte Einstiegspunkt für den aktuellen Arbeitsstand von Brand Identity, Designproduktion und Merchandising.

Es ersetzt keine fachlichen Designstandards. Es soll einen neuen Chat oder Mitarbeiter ohne Rekonstruktion alter Gesprächsverläufe arbeitsfähig machen.

## Core Principle

> **Der Chat darf wechseln. Freigegebene Richtung, Locked Assets, bekannte Fehler und offene Designarbeit bleiben erhalten.**

## Main Content

### 1. Was aktuell verbindlich gilt

Die Designorganisation ist grundsätzlich etabliert:

- die Rolle `Graphic Designer` ist formal definiert,
- Brand Identity und Designproduktion sind als Organisationswissen behandelt,
- das offizielle TuS-Logo wird ausschließlich aus den freigegebenen Originalassets verwendet,
- generative Werkzeuge dürfen verbindliche Logos, exakte Texte oder andere Locked Assets nicht rekonstruieren,
- Mockup, Entwurf und Produktionsdatei sind getrennte Artefakte,
- längere Designaufgaben verwenden Approved Direction, Locked Elements und einen belastbaren Design State,
- nach zwei erfolglosen Versuchen am selben konkreten Problem wird die Methode gewechselt statt weiter gepromptet,
- Brand Preflight ist Voraussetzung für den Status `FINAL`.

Verbindliche Grundsatzentscheidung: `../decisions/ADR-0004-brand-controlled-design-production.md`.

### 2. Offizielle TuS-Logo-Assets

Status: `Approved`

Verbindliche Quellen:

- `logo/tus_logo.png`
- `logo/tus_logo_flach.png`

Diese Assets werden nicht nachgezeichnet, generiert, stilisiert oder anhand eines Mockups rekonstruiert.

### 3. Typografie

Status: `teilweise offen`

Es ist noch keine vollständige offizielle TuS-Schriftfamilie als `Approved` dokumentiert.

Aktuelle Arbeitsregel:

- bei bestehenden freigegebenen Designs die tatsächliche Referenzschrift möglichst identisch weiterverwenden,
- keine stillen Font-Substitutionen,
- bei neuen, noch nicht referenzgebundenen Font-Entscheidungen frei verfügbare bzw. offen lizenzierte Fonts bevorzugen, sofern sie gestalterisch passen und dauerhaft nutzbar sind.

Verbindliche Detailquelle: `typography.md`.

### 4. Farben

Status: `teilweise offen`

Eine vollständige Corporate-Design-Farbpalette für Merch, Print und Kommunikation ist noch nicht als `Approved` dokumentiert.

Farben werden nicht aus Screenshots oder Mockups geschätzt. Technische Farbwerte werden erst aus einer verifizierten Quelle bzw. passend zum Produktionsverfahren festgelegt.

Verbindliche Detailquelle: `colors.md`.

### 5. Visuelle Sprache und Referenzen

Status: `im Aufbau`

`visual-language.md` ist derzeit noch nicht ausgearbeitet. Die reale visuelle Sprache wird deshalb kontrolliert aus bereits freigegebenen Arbeiten entwickelt.

Welche bestehenden Arbeiten als belastbare Referenz, eingeschränkte Referenz oder ausdrücklich nicht als Brand-Quelle gelten, steht in:

- `REFERENCE-REGISTER.md`

Eine Referenz ist nicht automatisch ein technischer Master für Font, Farbe oder Logo.

### 6. Design Production System

Status: `etabliert`

Verbindliche Produktionslogik:

`Creative Stage → kontrollierte Komposition → Brand Preflight → technische Produktionsprüfung → Freigabe`

Besonders relevant:

- `design-production-system.md`
- `design-workflow.md`
- `generative-design-standard.md`
- `product-types.md`

### 7. Merchandising

Status: `operativ in Vorbereitung`

Der Merch-Bereich besitzt bereits einen realen Produktionsprozess und einen operativen Google-Drive-Artefaktraum.

Einstieg:

- `merch/README.md`
- `merch/CURRENT-STATE.md`
- `merch/artwork/README.md`

Der aktuelle Produktstatus wird nicht in GitHub doppelt gepflegt. Operative Source of Truth ist das Google Sheet **TuS Merch Production Master**.

### 8. Wichtigste bekannte Anti-Loop-Learnings

Folgende Muster werden nicht erneut als Standardweg ausprobiert, solange keine neue belastbare technische Möglichkeit vorliegt:

- TuS-Logo durch Bildgenerierung rekonstruieren,
- bereits gute Gesamtentwürfe wegen einer kleinen Änderung vollständig neu generieren,
- exakte Texte oder Fonts aus generierten Bildern als Produktionsgrundlage verwenden,
- Mockups als Druckdateien behandeln,
- Farben oder Maße aus Mockups schätzen,
- eine Referenz frei neu interpretieren, wenn ausdrücklich Referenztreue gefordert ist,
- nach mehreren identischen Fehlern nur den Prompt leicht verändern und dieselbe ungeeignete Methode fortsetzen.

### 9. Offene Strukturpunkte

Noch nicht vollständig kanonisiert bzw. freigegeben sind insbesondere:

- vollständige TuS-Typografie,
- vollständige technische Markenfarbpalette,
- ausgearbeitete `visual-language.md`,
- exakte Drive-Verweise für alle historischen/freigegebenen Designreferenzen,
- freigegebene Master-Artworks für die aktuelle Merch-Linie,
- technische Produktionsparameter der aktuellen Merch-Produkte.

### 10. Nächste sinnvolle Schritte

1. aktuelle Merch-Produktion anhand der Ausstatter-Rückmeldung technisch vervollständigen,
2. Heritage Classic als ersten kontrollierten Artwork-Master fertigstellen,
3. freigegebene Referenzarbeiten im Reference Register nach und nach mit ihren konkreten Quelldateien verknüpfen,
4. daraus belastbare Typografie-, Farb- und Visual-Language-Regeln ableiten,
5. erst danach wiederverwendbare Templates aus realer Produktion standardisieren.

## Relationship to other documents

- `README.md`
- `REFERENCE-REGISTER.md`
- `brand-identity.md`
- `logo.md`
- `typography.md`
- `colors.md`
- `design-workflow.md`
- `design-production-system.md`
- `generative-design-standard.md`
- `merch/README.md`
- `../roles/graphic-designer/role.md`
- `../decisions/ADR-0004-brand-controlled-design-production.md`
- `../knowledge/SECOND-BRAIN-STANDARD.md`

## Future Development

Dieser Current State wird nur bei relevanten Änderungen aktualisiert. Detailwissen bleibt in den jeweils fachlich zuständigen Standards, Artworks und operativen Produktionsquellen.
