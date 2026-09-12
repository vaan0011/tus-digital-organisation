# UI Standard

## Purpose

Dieses Dokument definiert den gemeinsamen UI-Standard für digitale Produkte der TuS Digital Organisation.

Dazu gehören insbesondere WordPress-Plugins, Portale, interne Arbeitsoberflächen, die öffentliche Homepage und zukünftige Webanwendungen.

## Core Principle

Ein TuS-Nutzer soll vertraute Muster wiedererkennen und nicht jedes digitale Produkt neu lernen müssen.

Neue Produkte bauen auf dem gemeinsamen UI-System auf. Abweichungen benötigen einen fachlichen Grund.

## Main Content

### 1. Referenzimplementierung

Die aktuelle moderne Oberfläche des Event Planers dient als erste praktische Referenz für UI v1.

Sie ist keine unveränderbare Designgrenze. Bewährte Muster werden übernommen und gemeinsam weiterentwickelt.

### 2. UI v1 Tokens

Die folgenden Werte stammen aus der bestehenden modernen Event-Planer-Oberfläche und bilden den Startpunkt für gemeinsame digitale Oberflächen:

- Primary Action: `#0B5FD3`
- Primary Hover: `#064AAB`
- TuS Accent: `#B7192B`
- Text: `#1F2937`
- Strong Text: `#111827`
- Muted Text: `#667085`
- Border: `#DFE5EF`
- Soft Background: `#F6F8FB`
- Surface: `#FFFFFF`

Diese Werte sind UI-Tokens. Sie ersetzen keine separat beschlossene Corporate-Design-Farbdefinition.

### 3. Semantische Farbnutzung

Farben werden nach Funktion eingesetzt:

- Blau für primäre digitale Aktionen und Fokus,
- TuS-Rot als markanter Vereinsakzent,
- neutrale Flächen und Borders für Struktur,
- Statusfarben ausschließlich mit zusätzlicher textlicher oder ikonischer Bedeutung.

Ein neues Projekt führt nicht ohne Grund weitere Primärfarben ein.

### 4. Typografie für Bedienoberflächen

Bis eine eigene UI-Schrift ausdrücklich als `Approved` festgelegt ist, verwenden TuS-Bedienoberflächen bevorzugt eine performante Systemschriftfamilie statt externe Webfonts nur für dekorative Wirkung zu laden.

Referenzrichtung:

`-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif`

Dies ist eine technische UI-Baseline und keine Festlegung der Marken-Hausschrift für Print, Merch oder Kampagnen.

Typografie folgt einer klaren Hierarchie. Ein Plugin erfindet nicht für einzelne Seiten neue Schriftfamilien, Überschriftensysteme oder zufällige Größenabstufungen.

### 5. Spacing und Rhythmus

Abstände sollen projektübergreifend aus einem kleinen gemeinsamen Raster entstehen.

Referenzskala für neue Komponenten:

- `4px`
- `8px`
- `12px`
- `16px`
- `24px`
- `32px`
- `48px`

Nicht jede Komponente muss jede Stufe verwenden. Willkürliche Einzelwerte werden vermieden, wenn eine bestehende Stufe denselben Zweck erfüllt.

### 6. Flächen und Karten

Inhalte werden bevorzugt in klaren, ruhigen Bereichen strukturiert.

Referenzmuster:

- weiße Surface,
- dezente Border,
- zurückhaltender Schatten,
- Kartenradius typischerweise `12–16px`,
- ausreichender Innenabstand,
- klar erkennbare Überschrift und Funktion.

### 7. Buttons und Eingaben

Buttons und Formelemente sollen projektübergreifend vertraut wirken.

Referenzmuster:

- primäre Aktionen deutlich hervorgehoben,
- sekundäre Aktionen visuell zurückhaltender,
- Radius typischerweise `8px`,
- sichtbarer Fokuszustand,
- klare Beschriftung statt unklarer Symbolaktionen,
- destruktive Aktionen eindeutig als solche erkennbar,
- Icon-only-Aktionen nur, wenn Bedeutung eindeutig ist und ein zugänglicher Name/Tooltip vorhanden ist.

Auf Touch-Oberflächen erhalten zentrale Interaktionsflächen ausreichend Raum und werden nicht unnötig klein gestaltet.

### 8. Navigation

Navigation orientiert sich an Aufgaben und nicht an technischen Modulen.

Tabs, Menüs und Navigationseinträge:

- verwenden verständliche fachliche Begriffe,
- bleiben möglichst stabil,
- vermeiden unnötige Ebenen,
- zeigen nur kontextrelevante Optionen.

### 9. Formulare

Formulare werden so kurz wie fachlich möglich gehalten.

Regeln:

- nur notwendige Felder,
- verständliche sichtbare Labels,
- sinnvolle Defaults,
- zusammengehörige Angaben gruppieren,
- Fehler möglichst direkt am Problem erklären,
- Fehlerzustände nicht nur über Farbe darstellen,
- Pflicht/optional verständlich machen,
- keine doppelte Eingabe bereits vorhandener Informationen,
- Tastaturreihenfolge folgt der visuellen/fachlichen Reihenfolge.

#### Datumsfelder und Kalender-Picker

Datumsfelder sollen vorhandenen fachlichen Kontext verwenden und den Nutzer nicht unnötig zu einem weit entfernten Datum navigieren lassen.

Verbindliche Regeln:

- Gibt es bereits ein fachlich relevantes Bezugsdatum, öffnet ein Datumsfeld im dazu passenden Zeitraum und nicht ohne Grund beim heutigen Datum.
- Abhängige Datumsfelder verwenden einen sinnvollen Default aus dem vorhandenen Kontext, zum Beispiel `Enddatum = Startdatum`, solange der Nutzer noch keine eigene Auswahl getroffen hat.
- Bei fortlaufenden Datumsreihen wird der nächste sinnvolle Wert aus dem vorherigen Eintrag abgeleitet, zum Beispiel `vorheriger Event-Tag + 1 Tag`.
- Automatisch gesetzte Defaults dürfen eine spätere bewusste Nutzerauswahl nicht still überschreiben.
- `min`- und `max`-Grenzen werden nur gesetzt, wenn sie eine fachliche Regel abbilden; sie werden nicht allein zur Navigation im Kalender missbraucht.
- Kontextbezogene Defaults müssen gesetzt sein, **bevor** der native Kalender-Picker geöffnet wird. Eine Wertänderung erst während `pointerdown`, `focus` oder einer bereits gestarteten Picker-Interaktion gilt nicht als verlässliches Muster.
- Bei dynamisch erzeugten Datumsfeldern wird der sinnvolle Default deshalb möglichst bereits beim Erzeugen des neuen Felds gesetzt.
- Gibt es keinen fachlichen Datumsbezug, darf das native Standardverhalten des Browsers verwendet werden.

Dieses Muster gilt organisationsweit für neue und überarbeitete TuS-Oberflächen mit Datumsfeldern.

Als verifiziertes Referenzmuster gilt die Umsetzung im Event Planner: Ein neu erzeugter Event-Tag erhält seinen kontextbezogenen Default bereits beim Anlegen des Felds (`vorheriger Event-Tag + 1 Tag`). Dadurch zeigt das Feld den richtigen Wert, bevor der native Picker geöffnet wird; eine spätere manuelle Auswahl bleibt unangetastet. Der zuvor erprobte Ansatz, den Default erst während `pointerdown` oder `focus` zu setzen, wurde im manuellen Browser-Test als unzuverlässig verworfen.

### 10. Status, Feedback und Zustände

Nach wichtigen Aktionen muss der Nutzer erkennen können, was passiert ist.

Das System kommuniziert insbesondere:

- Erfolg,
- Fehler,
- fehlende Eingaben,
- laufende Verarbeitung,
- leere Zustände,
- fehlende Berechtigung,
- irreversible Folgen vor der Ausführung.

Ladezustände dürfen nicht unnötig die gesamte Oberfläche blockieren, wenn nur ein Teilbereich verarbeitet wird.

### 11. Responsive Verhalten

Mobile, Tablet und Desktop werden als echte Nutzungskontexte behandelt.

Neue bzw. wesentlich geänderte Oberflächen werden mindestens auf folgenden Test-Viewports geprüft:

- Smartphone um `360px`,
- Tablet um `768px`,
- Desktop um `1280px`.

Diese Werte sind Testgrößen und keine vorgeschriebenen CSS-Breakpoints.

Responsive Design verwendet je nach Kontext:

- **Reflow** – Inhalte ordnen sich neu,
- **Reduce** – sekundäre Informationen werden sinnvoll reduziert,
- **Prioritize** – zentrale Information/Aktion bleibt zuerst sichtbar.

Mehrspaltige Layouts brechen kontrolliert um. Tabellen erhalten für kleine Displays eine bewusste Lösung statt ungeplant horizontal aus dem Viewport zu laufen.

Die Oberfläche muss ohne Zoom bedienbar sein; Browser-Zoom darf nicht deaktiviert werden.

### 12. Accessibility – WCAG 2.2 AA

Neue und wesentlich geänderte TuS-Oberflächen orientieren sich an WCAG 2.2 Level AA. Dies entspricht auch dem aktuellen Accessibility-Ziel für neuen bzw. geänderten WordPress-Code.

Mindestens gelten:

- semantisches HTML vor ARIA-Sonderkonstruktionen,
- alle wesentlichen Interaktionen sind mit Tastatur erreichbar,
- Fokus ist sichtbar und folgt einer nachvollziehbaren Reihenfolge,
- modale Dialoge/Menüs verwalten Fokus nachvollziehbar,
- Formularfelder besitzen programmatisch zugeordnete Labels,
- Fehlermeldungen sind verständlich und dem Problem zugeordnet,
- Farbe ist nie der einzige Informationsträger,
- Text-/UI-Kontraste sind ausreichend,
- relevante Bilder besitzen passende Alternativtexte,
- dekorative Bilder werden assistiven Technologien nicht unnötig vorgelesen,
- Links und Buttons haben einen verständlichen zugänglichen Namen,
- Überschriften bilden eine sinnvolle Struktur,
- Inhalte bleiben bei Vergrößerung und auf kleinen Displays nutzbar,
- Animationen/Bewegungen bleiben sparsam und respektieren `prefers-reduced-motion`, wenn relevant.

Accessibility ist Bestandteil von Design und Abnahme, nicht ein späteres Zusatzprojekt.

### 13. Backend und Frontend – eine Familie, nicht dasselbe Layout

Interne Arbeitsoberflächen und öffentliche Frontends müssen nicht identisch aussehen.

Sie verwenden jedoch dieselbe visuelle und interaktive Grundsprache:

- gemeinsame Farben/Tokens,
- Typografie-Baseline,
- Button- und Formularmuster,
- Abstandslogik,
- Status-/Fehlerlogik,
- Fokus-/Accessibility-Verhalten.

Interne Oberflächen priorisieren Effizienz und klare Arbeitsabläufe. Öffentliche Oberflächen priorisieren Orientierung, Markenwirkung und reduzierte Informationsführung.

Der Nutzungskontext darf Varianten rechtfertigen; er rechtfertigt kein zweites unabhängiges Designsystem.

### 14. Performance im UI

Eine Oberfläche soll nicht nur gut aussehen, sondern unmittelbar reagieren.

Daher gilt:

- keine schweren UI-Bibliotheken ohne klaren Nutzen,
- CSS/JS nur dort laden, wo es gebraucht wird,
- Bilder passend dimensionieren,
- keine unnötigen Layoutsprünge,
- Ladezustände und asynchrone Prozesse nachvollziehbar darstellen,
- externe Inhalte dürfen den Kern der Seite nicht unnötig blockieren.

Für die öffentliche Homepage gelten zusätzlich die Performanceziele aus `../standards/software-development-quality-standard.md`.

### 15. Kein projektspezifisches UI-System ohne Grund

Ein Entwickler erstellt nicht für jedes Plugin neue Button-, Karten-, Formular-, Spacing-, Typografie- oder Farbsysteme.

Wenn ein bestehendes Muster nicht ausreicht, wird zunächst geprüft:

- kann das bestehende Muster erweitert werden,
- ist die neue Lösung auch für andere TuS-Produkte sinnvoll,
- sollte daraus ein gemeinsames UI-Muster entstehen?

### 16. UI-Abnahme

Bei neuen bzw. wesentlich geänderten sichtbaren Funktionen werden mindestens geprüft:

- Desktop, Tablet, Smartphone,
- Tastaturbedienung und Fokus,
- Labels/Fehlermeldungen,
- Empty State,
- Loading State,
- Fehlerzustand,
- lange/unerwartete Inhalte,
- Berechtigungs-/Read-only-Zustand soweit relevant,
- korrekte Originalassets und Brand-Tokens.

Ein Agent dokumentiert nur tatsächlich durchgeführte Prüfungen als bestanden.

### 17. Veränderung des UI Standards

Neue UI-Muster dürfen im Projekt erprobt werden.

Zum organisationsweiten Standard werden sie erst, wenn sie sich bewährt haben und nachvollziehbar übernommen wurden.

## Relationship to other documents

- `README.md`
- `design-principles.md`
- `brand-identity.md`
- `logo.md`
- `colors.md`
- `typography.md`
- `../standards/software-development-quality-standard.md`
- `../standards/data-persistence-and-database-standard.md`
- `../standards/iteration-and-progress.md`
- `../roles/wordpress-developer/development-standard.md`

## Future Development

Der Standard wird aus realen Produkten weiterentwickelt. Wiederkehrende Komponenten, die sich in mehreren Produkten bewähren, sollen als gemeinsames TuS Digital Design System konkretisiert werden.

Weitere Tokens oder Breakpoints werden nur ergänzt, wenn reale Produkte sie benötigen; es entsteht kein abstraktes Designsystem ohne Nutzung.