# Heritage Font Verification

## Purpose

Dieses Dokument hält den Verifikationsstand der für Heritage Classic benötigten Schriften fest. Ziel ist ein reproduzierbares Master-Artwork mit möglichst freien, kommerziell nutzbaren Fonts und klar dokumentierter Lizenz.

## Core principle

**Free Fonts first. Ein Fontname im Mockup ist ein Hinweis, keine zwingende Produktionsvorgabe.**

Wenn eine freie Schrift die visuelle Aufgabe ausreichend präzise erfüllt, wird sie gegenüber einer kostenpflichtigen Alternative bevorzugt. Kostenpflichtige Fonts kommen nur zum Einsatz, wenn der Qualitätsunterschied für das konkrete Produkt relevant ist.

## Main content

### 1. `MINGOLSHEIM` – freie College-/Slab-Alternative

Die Heritage-Classic-Referenz nennt `COLLEGE BLOCK (Bold, Arched)`.

Für den freien Produktionsweg wird zuerst **Graduate** geprüft.

Quelle: Google Fonts / Graduate Project.

Lizenz: **SIL Open Font License 1.1 (OFL)**.

Status: `Proposed for Heritage Proof`.

Warum Graduate priorisiert wird:

- deutlicher College-/Varsity-Charakter,
- kräftige Serif-/Slab-Formen,
- offene, nachvollziehbare Lizenz,
- frei für kommerzielle Nutzung im Rahmen der OFL,
- geeignet für einen kontrollierten Outline-/Vektor-Workflow.

Zu prüfen:

- horizontale Proportion gegenüber der Referenz,
- Buchstabenabstände,
- Bogenradius,
- vertikale Gewichtung,
- charakteristische Formen insbesondere bei `M`, `G`, `S`, `H` und `E`.

Der Bogen wird als Layoutgeometrie erzeugt und nicht durch Bildgenerierung.

Weitere freie Vergleichskandidaten dürfen im Proof ergänzt werden, wenn Graduate bei den charakteristischen Buchstabenformen sichtbar abweicht.

### 2. `EST. 1901` / `TURN- UND SPORTVEREIN` – freie Condensed-Alternative

Die Referenz nennt `DIN CONDENSED BOLD`.

Für den freien Produktionsweg wird zuerst **Barlow Condensed Bold** geprüft.

Quelle: Google Fonts / Barlow Project, Designer Jeremy Tribby.

Lizenz: **SIL Open Font License 1.1 (OFL)**.

Status: `Proposed for Heritage Proof`.

Warum Barlow Condensed priorisiert wird:

- schmale groteske Grundform,
- mehrere Gewichte verfügbar,
- gute Eignung für kurze kräftige Kennzeichnung (`EST. 1901`) und längere Unterzeile,
- offene, kommerziell nutzbare Lizenz,
- reproduzierbar für Print, Merch, Web und kontrollierte Vektorexporte.

Vergleichskandidaten für den Proof:

- **Roboto Condensed** – frei/offen, neutraler und DIN-näher,
- **Oswald** – frei/offen, enger und plakativ,
- **Bebas Neue** – OFL, sehr display-orientiert; nur als Vergleich, da die Referenz kräftiger und weniger hochgezogen wirkt.

### 3. Proof-Entscheidung

Heritage Classic wird erst typografisch `Approved`, wenn ein Side-by-Side-Proof gegen die Drive-Referenz bestätigt:

- charakteristische Buchstabenformen stimmen ausreichend,
- Gesamtbreite und Proportionen sind nah an der Referenz,
- Bogenwirkung von `MINGOLSHEIM` stimmt,
- `EST. 1901` besitzt die passende kräftige Condensed-Anmutung,
- `TURN- UND SPORTVEREIN` bleibt trotz schmalem Satz gut lesbar,
- Abstände und Zeilenverhältnisse sind reproduzierbar.

Ziel ist nicht, einen kostenpflichtigen Font um jeden Preis 1:1 zu imitieren. Ziel ist, den bestehenden Heritage-Charakter zuverlässig und reproduzierbar zu erhalten.

### 4. Lizenzregel für TuS Fonts

Bevorzugt werden Fonts mit klarer Open-Source-/Free-for-commercial-use-Lizenz, insbesondere SIL OFL.

Für jeden Approved Font werden dokumentiert:

- offizielle Bezugsquelle,
- Lizenz,
- Familie und Schnitt,
- Einsatzrolle,
- Version/Stand, soweit relevant.

Fontdateien dürfen nur dann im Repository abgelegt werden, wenn die Lizenz die Weitergabe erlaubt und der zugehörige Lizenztext ebenfalls korrekt mitgeführt wird. Alternativ wird ausschließlich die offizielle Bezugsquelle dokumentiert.

Für Produktionsübergaben wird finale Schrift nach Möglichkeit in Pfade/Kurven umgewandelt, sodass der Ausstatter keine lokale Fontinstallation benötigt.

### 5. Free-First-Beschaffungsentscheidung

Für Heritage Classic gilt folgende Reihenfolge:

1. Graduate + Barlow Condensed als Kombination A proofen.
2. Graduate mit Roboto Condensed und Oswald vergleichen.
3. Falls Graduate oben nicht ausreichend nah an der Referenz liegt, weitere freie College-/Slab-Familien prüfen.
4. Erst wenn kein freier Kandidat qualitativ überzeugt, kostenpflichtige Original-/Fallback-Fonts erneut bewerten.
5. Keine kostenpflichtige Fontlizenz ohne dokumentierten Qualitätsgrund beschaffen.

### 6. Aktueller Status

`MINGOLSHEIM`: **Graduate** → `Proposed for Heritage Proof`.

`EST. 1901` / `TURN- UND SPORTVEREIN`: **Barlow Condensed Bold** → `Proposed for Heritage Proof`.

Vergleich unten: Roboto Condensed, Oswald, Bebas Neue.

Das Artwork bleibt bis zum bestandenen visuellen Proof `Reconstruction`, nicht `Approved Artwork`.

## Relationship to other documents

- `../../typography.md`
- `../../design-production-system.md`
- `../../merch/artwork/heritage-classic/artwork-spec-v1.md`

## Future development

Nach dem typografischen Proof werden exakte Fontquelle, Schnitt, Lizenzstatus, Bogenparameter, Tracking und Größenverhältnisse dokumentiert. Danach kann das Heritage-Classic-Master-Artwork als kontrollierte Vektorquelle aufgebaut werden.