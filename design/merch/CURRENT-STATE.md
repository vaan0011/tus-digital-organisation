# Merch Current State

Stand: 2026-09-10

## Purpose

Dieses Dokument ist der kompakte GitHub-Einstieg in den aktuellen Merch-Arbeitsstand. Es verweist auf die operative Source of Truth in Google Drive und hält nur den für neue Chats relevanten Zustand fest.

## Core Principle

> **Produktstatus wird einmal gepflegt. GitHub erklärt den Kontext; der Merch Production Master führt den operativen Stand.**

## Main Content

### 1. Operative Source of Truth

**TuS Merch Production Master**  
https://docs.google.com/spreadsheets/d/1Sm2cpw1X70WfcqEnfKZNMr5Hi71E0PRSnfmFOm-RxK4/edit

Tab: `Produkte`

Produktionsworkflow:  
https://docs.google.com/document/d/1b0nKjLC4u41Dvtxp-3i8qYeF7yIY2UbL3jcpFDVVNQk/edit

Produktionsordner:  
https://drive.google.com/drive/folders/1_wsmDYbFYn5s5QkvzrgXzJlaxgO-vSsa

### 2. Aktuelle Launch-Produkte

| ID | Produkt | Variante | aktueller Status |
|---|---|---|---|
| HER-001 | Heritage Classic T-Shirt | Bordeaux | Vorbereitung |
| HER-002 | Heritage Classic T-Shirt | Vintage Beige | Vorbereitung |
| HER-003 | Heritage Hoodie | Anthrazit | Vorbereitung |
| GYM-001 | Timeline Performance Shirt | Grau | Technikprüfung |
| GYM-002 | Mengelse Athletic Heavy Shirt | Blackout | Vorbereitung |
| ACC-001 | Blackout Snapback | Schwarz | Vorbereitung |
| CAP-125-001 | 125 Jahre Heritage Shirt | TBD | Vorbereitung |

Weitere Phase-2-/Konzeptprodukte bleiben im Merch Production Master sichtbar und werden hier nicht doppelt gepflegt.

### 3. Bereits erreicht

- Merch Production Master angelegt und strukturiert.
- verbindlicher Produktionsworkflow mit Statuskette und Freigabegates angelegt.
- Produkt-IDs und Produktgruppen definiert.
- Heritage Classic T-Shirt Bordeaux, Vintage Beige und Heritage Hoodie als konkrete Launch-Produkte vorbereitet.
- für HER-001 bis HER-003 Product-Sheet-/Artwork-Vorbereitung vorhanden.
- offizielles TuS-Logo für die Produktionsarbeit als Locked Asset festgelegt.
- weitere Launch-Produkte Gym / Athletic, Accessory und 125-Jahre-Capsule im Master erfasst.
- Ausstatter-Rückmeldung ist als nächster technischer Informationsschritt vorgesehen.

### 4. Aktuelle Hauptblocker / TBD

Für die laufenden Launch-Produkte fehlen je nach Produkt noch reale Produktionsparameter, insbesondere:

- konkreter Rohling / Modell,
- Grammatur und Material,
- reale Produktfarbe,
- Schnitt,
- Druck-, Stick- oder Spezialverfahren,
- maximale Druck-/Stickfläche,
- Platzierungsmaße in cm,
- technische Farben,
- Mindestmengen und Staffelpreise,
- benötigte Dateiformate,
- Proof- und Sample-Möglichkeiten.

Diese Angaben werden nicht aus Mockups geschätzt.

### 5. Produktbezogene Besonderheiten

- `HER-001`: Mockup-Wappen ausdrücklich nicht als Produktionslogo verwenden; Original-TuS-Logo aus GitHub ist Locked Asset.
- `HER-002`: realen Vintage-Beige-Rohling und technische Ausführung mit Ausstatter klären.
- `HER-003`: Hoodie-Rohling, Anthrazit, Grammatur, Schnitt sowie Druck/Stick und physisches Sample klären.
- `GYM-001`: schweiß-/feuchtigkeitsreaktiven Druck technisch prüfen; falls nicht belastbar realisierbar, permanenter Ton-in-Ton-Druck als Alternative bewerten.
- `GYM-002`: Frontgestaltung und exakten Heavyweight-Rohling definieren.
- `ACC-001`: Stickdatei ausschließlich aus Original-TuS-Logo ableiten.
- `CAP-125-001`: vorhandene Druckdatei technisch und markenseitig prüfen; Logo, Typografie und Print nicht ungeprüft übernehmen.

### 6. Produktionsfreigabe

Zum aktuellen Stand ist für die aufgeführten Launch-Produkte noch keine Serien-Produktionsfreigabe dokumentiert.

Daraus folgt:

- keine Produktionsdatei allein aus einem Mockup ableiten,
- keine technischen Maße oder Farben erfinden,
- keine Webshop-Finalbilder als freigegebenen Produktzustand behandeln,
- zuerst technische Angaben, Proof und – wo relevant – Sample sauber abschließen.

### 7. Nächste Aktion

Sobald die Ausstatter-Rückmeldung vorliegt:

1. technische Angaben produktweise in den Merch Production Master übernehmen,
2. `TBD` nur durch bestätigte Werte ersetzen,
3. Artwork und Placement Specs gegen reale Rohlinge prüfen,
4. digitalen Supplier Proof anfordern,
5. bei wichtigen oder neuen Verfahren Sample durchführen,
6. erst nach Gate C/D FINAL-Dateien erzeugen bzw. freigeben,
7. Webshop Assets anschließend aus dem freigegebenen Produktzustand erstellen.

Parallel kann der Heritage-Classic-Artwork-Master kontrolliert weiter aufgebaut werden, soweit dafür keine noch offenen Produktionsdaten erfunden werden müssen.

### 8. Anti-Loop-Hinweis

Die früher wiederholt gescheiterte Methode, Mockup und Markenbestandteile komplett generativ neu zu erzeugen, ist kein zulässiger Standardweg mehr.

Details: `README.md`, `../design-production-system.md`, `../generative-design-standard.md` und `../../decisions/ADR-0004-brand-controlled-design-production.md`.

## Relationship to other documents

- `README.md`
- `artwork/README.md`
- `../CURRENT-STATE.md`
- `../REFERENCE-REGISTER.md`
- `../design-production-system.md`
- `../../knowledge/SECOND-BRAIN-STANDARD.md`

## Future Development

Dieser Current State wird nur bei echten Statusänderungen aktualisiert. Die detaillierte operative Pflege bleibt im Merch Production Master.
