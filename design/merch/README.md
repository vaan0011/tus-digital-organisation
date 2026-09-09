# Merchandising

## Purpose

Dieser Bereich bündelt das dauerhafte Organisationswissen für TuS-Merchandising. Er verbindet Brand- und Produktionsstandards in GitHub mit dem operativen Merch Production Master und den Produktionsartefakten in Google Drive.

Er ersetzt weder die zentrale Brand Identity noch den operativen Produktionsmaster.

## Core Principle

> **Ein Motiv wird einmal kontrolliert aufgebaut und anschließend aus derselben freigegebenen Quelle für Mockup, Produktion und Webshop verwendet.**

Mockups sind visuelle Referenzen. Sie sind keine Produktionsdateien und keine Quelle für Logos, exakte Typografie oder technische Farben.

## Main Content

### 1. Source of Truth

GitHub enthält die dauerhaft verbindlichen Regeln:

- `../design-production-system.md`
- `../design-workflow.md`
- `../generative-design-standard.md`
- `../logo.md`
- `../typography.md`
- `../colors.md`
- `artwork/README.md`

Operativer Produktstatus:

- **TuS Merch Production Master** – https://docs.google.com/spreadsheets/d/1Sm2cpw1X70WfcqEnfKZNMr5Hi71E0PRSnfmFOm-RxK4/edit

Verbindlicher Produktionsworkflow:

- **Merch Production Workflow & Freigaberegeln** – https://docs.google.com/document/d/1b0nKjLC4u41Dvtxp-3i8qYeF7yIY2UbL3jcpFDVVNQk/edit

Produktionsablage:

- **00_Merch_Production_Master** – https://drive.google.com/drive/folders/1_wsmDYbFYn5s5QkvzrgXzJlaxgO-vSsa

Dort befinden sich Arbeitsstände, Product Sheets, Referenzmockups, Artwork Working, technische Spezifikationen, Proofs, Samples, Final Production Files und Webshop Assets.

### 2. Produktlogik

Aktuell verwendete Produktgruppen:

- `HER` – Heritage
- `GYM` – Gym / Athletic
- `ACC` – Accessory
- `CAP-125` – 125 Jahre Capsule
- `CAP-LOC` – Local Capsule

Eine Capsule oder lokale Gestaltung wird nicht automatisch zum organisationsweiten TuS-Markenstandard.

### 3. Produktionskette

Verbindliche Statuskette:

`Konzept → Vorbereitung → Technikprüfung → Sample → Korrektur → Produktionsfreigabe → Produktion → Webshop live`

Fehlende technische Angaben bleiben `TBD`. Sie werden nicht aus Mockups, Screenshots oder generierten Bildern geschätzt.

### 4. Freigabegates

- **Gate A – Design:** Motiv und Produktidee sind freigegeben.
- **Gate B – Technik:** Rohling, Verfahren, Farben und Platzierung sind geklärt.
- **Gate C – Sample:** Proof bzw. physisches Sample entspricht dem freigegebenen Design.
- **Gate D – Produktion:** FINAL-Dateien und Stückzahlen sind bestätigt.
- **Gate E – Shop:** Produktbilder, Beschreibung, Varianten und Lieferfähigkeit sind geprüft.

### 5. Verbindliche Anti-Loop-Regeln

Folgende Wege gelten als geprüft und verworfen, solange keine neuen belastbaren Randbedingungen vorliegen:

- das offizielle TuS-Logo durch ein Bildmodell erzeugen, rekonstruieren oder nachzeichnen,
- ein verzerrtes Logo aus einem Mockup als Produktionslogo übernehmen,
- Artwork aus einem Mockup nachzeichnen, wenn keine kontrollierte Masterquelle vorliegt,
- exakte Typografie durch generative Bildausgabe ersetzen,
- technische Farben aus einem Screenshot oder Mockup ableiten,
- nach wiederholtem Scheitern dieselbe generative Methode nur mit leicht verändertem Prompt fortsetzen,
- ein Mockup direkt als Druckdatei behandeln,
- Webshop-Bilder erstellen, bevor das Produkt technisch freigegeben ist.

Stattdessen gilt die kontrollierte Produktionsstraße aus `../design-production-system.md`.

### 6. Referenztreue

Bei Merch wird vor jeder Umsetzung festgehalten, welche Bestandteile einer Referenz:

- nur inspirieren,
- die Designrichtung vorgeben,
- möglichst exakt rekonstruiert werden müssen,
- als Locked Asset unverändert einzusetzen sind.

Wenn der Auftrag ausdrücklich auf einem bereits freigegebenen Referenzshirt oder -motiv basiert, ist eine freie Neuinterpretation keine gültige Umsetzung.

### 7. Typografie

Bei neuen, noch nicht gebundenen Font-Entscheidungen werden frei verfügbare bzw. offen lizenzierte Schriften bevorzugt, sofern sie gestalterisch passen und dauerhaft nutzbar sind.

Diese Präferenz rechtfertigt keine stille Substitution eines bereits festgelegten oder referenzgebundenen Fonts.

### 8. Ausstatter und externe Produktion

Ein Ausstatter darf Logo, Schrift, Artwork, Proportionen oder Text nicht eigenständig nachzeichnen oder verändern.

Änderungsvorschläge des Ausstatters werden vor Umsetzung freigegeben. Bei neuen oder kritischen Produktionsverfahren wird zusätzlich zum digitalen Proof ein physisches Sample bevorzugt bzw. verlangt, wenn die reale Wirkung sonst nicht zuverlässig beurteilt werden kann.

## Relationship to other documents

- `CURRENT-STATE.md`
- `../REFERENCE-REGISTER.md`
- `artwork/README.md`
- `../design-production-system.md`
- `../design-workflow.md`
- `../generative-design-standard.md`
- `../../roles/graphic-designer/role.md`
- `../../decisions/ADR-0004-brand-controlled-design-production.md`
- `../../knowledge/SECOND-BRAIN-STANDARD.md`

## Future Development

Neue Merch-Regeln entstehen nur aus realer Produktion. Sobald ein Motiv technisch freigegeben ist, soll seine kontrollierte Artwork-Quelle dokumentiert und aus demselben Master für Produktionsdateien und Webshopdarstellung verwendet werden.
