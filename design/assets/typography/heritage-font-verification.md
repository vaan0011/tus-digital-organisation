# Heritage Font Verification

## Purpose

Dieses Dokument hält den Verifikationsstand der in der Heritage-Classic-Referenz genannten Schriften fest. Ziel ist, vor dem Aufbau eines finalen Vektor-Artworks eindeutig zu klären, welche Fontdateien und Lizenzen tatsächlich benötigt werden.

## Core principle

**Ein Fontname in einem Mockup ist ein Hinweis, keine automatisch freigegebene Produktionsquelle.**

Die verwendete Schrift muss visuell, technisch und lizenzrechtlich eindeutig bestimmt werden.

## Main content

### 1. `MINGOLSHEIM` – College Block

Die Heritage-Classic-Referenz nennt `COLLEGE BLOCK (Bold, Arched)`.

Der derzeit stärkste verifizierte Kandidat ist **College Block 2.0** von Sharkshock / Dennis Ludlow. Die öffentliche Hersteller-/Distributionsbeschreibung nennt die Schrift ausdrücklich als für gebogene College-/University-Sweater-Schriftzüge sowie T-Shirt- und Logoanwendungen geeignet.

Status: `Proposed for Heritage Proof`.

Warum dieser Kandidat priorisiert wird:

- starke visuelle Nähe zur vorhandenen Heritage-Referenz,
- explizite College-/Sportswear-Ausrichtung,
- kommerziell lizenzierbarer Ursprung ist nachvollziehbar,
- als Outline-/Vektor-Workflow für ein statisches Merch-Artwork geeignet.

Noch zu verifizieren:

- exakter Schnitt/Variante,
- Bogenradius und Warp-Geometrie,
- Buchstabenabstände,
- finale kommerzielle Lizenz für TuS-Nutzung.

Der Bogen wird als Layoutgeometrie behandelt und nicht als generatives Element.

### 2. `EST. 1901` / `TURN- UND SPORTVEREIN` – DIN Condensed

Die Heritage-Classic-Referenz nennt `DIN CONDENSED BOLD`.

Dieser Name ist nicht eindeutig genug, um ohne Foundry-Angabe eine konkrete Produktionsdatei festzulegen.

Für den Proof gelten deshalb zwei klar priorisierte Wege:

#### Priorität A – DIN Condensed über Adobe Fonts / ParaType

Adobe Fonts führt aktuell `DIN Condensed` von ParaType. Adobe beschreibt seine Fonts als für persönliche und kommerzielle Nutzung lizenziert. Diese Variante wird als erster Verfügbarkeits- und Sichtvergleich geprüft, falls der TuS-Arbeitsplatz Zugriff auf Adobe Fonts hat.

Status: `Preferred availability check`.

#### Priorität B – FF DIN Pro Condensed Bold

Als eindeutig benannter kommerzieller Bold-Schnitt ist **FF DIN Pro Condensed Bold** verfügbar. Diese Variante besitzt einen klaren Foundry-/Lizenzpfad und wird als Backup für den visuellen Proof verwendet, falls ParaType DIN Condensed nicht exakt genug passt oder der benötigte Bold-Schnitt nicht verfügbar ist.

Status: `Commercial fallback candidate`.

### 3. Proof-Entscheidung

Heritage Classic wird erst dann typografisch `Approved`, wenn ein Side-by-Side-Proof gegen die Drive-Referenz bestätigt:

- charakteristische Buchstabenformen stimmen,
- Gesamtbreite und Proportionen stimmen,
- Bogenwirkung von `MINGOLSHEIM` stimmt,
- `EST. 1901` und `TURN- UND SPORTVEREIN` besitzen die passende DIN-Anmutung,
- Abstände und Zeilenverhältnisse sind reproduzierbar.

Ein "ähnlicher" Font ohne bestandenen Proof bleibt `Proposed`.

### 4. Lizenzregel für TuS Merch

Für die Produktion benötigen wir keine Fontdateien im Repository, solange das finale Artwork als Vektorpfade übergeben wird.

Fontdateien selbst werden nicht ins öffentliche Repository eingecheckt, sofern Lizenz und Weitergaberecht dies nicht ausdrücklich erlauben.

Das Produktionsziel lautet:

1. Font auf einem lizenzierten Arbeitsplatz verwenden,
2. Artwork kontrolliert erstellen,
3. finale Schrift in Pfade/Kurven umwandeln,
4. Vektor-PDF/SVG prüfen,
5. nur die daraus erzeugten Produktionsdateien an den Ausstatter übergeben.

### 5. Beschaffungsentscheidung

Für Heritage Classic wird folgende Reihenfolge festgelegt:

1. Verfügbarkeit von College Block 2.0 mit kommerzieller Lizenz prüfen und bei Verwendung lizenzieren.
2. DIN Condensed über vorhandenen Adobe-Fonts-Zugang prüfen.
3. Falls kein passender Bold-Schnitt oder keine ausreichende visuelle Übereinstimmung vorliegt, FF DIN Pro Condensed Bold kommerziell lizenzieren.
4. Lizenznachweis außerhalb des öffentlichen Repositories in der Produktionsablage dokumentieren.
5. Nach Lizenzierung Side-by-Side-Proof erstellen.

### 6. Aktueller Status

`MINGOLSHEIM`: College Block 2.0 → `Proposed for Heritage Proof`.

`EST. 1901` / `TURN- UND SPORTVEREIN`: DIN Condensed → `Proof required`; ParaType/Adobe zuerst prüfen, FF DIN Pro Condensed Bold als kommerziell klarer Fallback.

Das Artwork bleibt bis zum bestandenen Proof `Reconstruction`, nicht `Approved Artwork`.

## Relationship to other documents

- `../../typography.md`
- `../../design-production-system.md`
- `../../merch/artwork/heritage-classic/artwork-spec-v1.md`

## Future development

Nach dem typografischen Proof werden exakte Fontquelle, Schnitt, Lizenzstatus, Bogenparameter, Tracking und Größenverhältnisse dokumentiert. Danach kann das Heritage-Classic-Master-Artwork als kontrollierte Vektorquelle aufgebaut werden.