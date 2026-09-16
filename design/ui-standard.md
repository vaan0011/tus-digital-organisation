# UI Standard

## Purpose

Dieses Dokument definiert den gemeinsamen UI-Standard für digitale Produkte der TuS Digital Organisation.

Dazu gehören insbesondere WordPress-Plugins, Portale, interne Arbeitsoberflächen, die öffentliche Homepage und zukünftige Webanwendungen.

## Core Principle

Ein TuS-Nutzer soll vertraute Muster wiedererkennen und nicht jedes digitale Produkt neu lernen müssen.

> **Funktion und Interaktion werden gemeinsam standardisiert. Die öffentliche Brand Identity kommt zur Laufzeit aus dem WordPress-Theme.**

Plugins sollen schlank bleiben und weder ein zweites Designsystem noch eine zweite Brand-Quelle erzeugen.

## Main Content

### 1. Referenzimplementierung

Die moderne Oberfläche des Event Planners dient als praktische Referenz für bewährte Bedienmuster.

Sie ist keine unveränderbare Designgrenze und insbesondere keine technische Quelle für Markenfarben oder Markenfonts.

Bewährte Muster werden übernommen; konkrete Brand-Werte für öffentliche WordPress-Oberflächen kommen aus dem aktiven Theme.

### 2. Theme als Runtime-Quelle für Frontend-Branding

Für öffentliche WordPress-Oberflächen gilt:

- Farben und Typografie werden aus dem aktiven TuS-Theme geerbt,
- bevorzugt werden WordPress Global Styles und/oder stabile semantische CSS-Custom-Properties des Themes genutzt,
- Markenfarben werden nicht als feste Hex-Werte in jedem Plugin dupliziert,
- Markenfonts werden nicht in jedem Plugin separat definiert oder ausgeliefert,
- ein Plugin darf neutrale technische Fallbacks besitzen, wenn ein Theme-Token fehlt; diese Fallbacks sind keine zweite Brand-Source-of-Truth,
- Original-Logos und andere Locked Assets bleiben zentrale Originalassets,
- ein Theme-Wechsel darf keine fachliche Codeänderung in den Plugins erfordern, solange die vereinbarte Style-/Token-Schnittstelle erfüllt wird.

Das Theme verantwortet die technische Ausspielung der Brand Identity. Plugins verantworten Struktur, Verhalten, Semantik und fachliche Funktion.

### 3. Semantische statt konkrete Brand-Tokens

Plugin-Code verwendet bevorzugt semantische Rollen statt konkrete Markenwerte, beispielsweise:

- `primary`,
- `accent`,
- `text`,
- `muted`,
- `surface`,
- `border`,
- `success`,
- `warning`,
- `error`.

Die konkrete visuelle Ausprägung der öffentlichen Brand-Tokens liefert das Theme.

Statusfarben vermitteln Information nie ausschließlich über Farbe.

### 4. Typografie

Öffentliche Frontend-Komponenten erben die Typografie aus dem aktiven Theme und definieren keine eigene TuS-Hausschrift.

Für die öffentliche digitale TuS-Oberfläche ist Barlow gemäß `typography.md` als `Approved – Digital UI` freigegeben. Plugins laden diese Schrift nicht eigenständig, sondern erben sie über das Theme.

Interne WordPress-Backend-Oberflächen orientieren sich bevorzugt an der nativen WordPress-Admin-Typografie bzw. einer neutralen Systemschrift. Das Backend muss nicht künstlich die öffentliche Theme-Typografie nachbauen.

Ein Plugin lädt keine externe Schrift nur für dekorative Wirkung.

Typografie folgt einer klaren Hierarchie; einzelne Plugin-Seiten erfinden keine unabhängigen Schrift- oder Überschriftensysteme.

### 5. Spacing und Rhythmus

Abstände entstehen aus einem kleinen gemeinsamen Raster.

Referenzskala für neue Komponenten:

- `4px`
- `8px`
- `12px`
- `16px`
- `24px`
- `32px`
- `48px`

Willkürliche Einzelwerte werden vermieden, wenn eine bestehende Stufe denselben Zweck erfüllt.

### 6. Flächen, Karten und Container

Inhalte werden bevorzugt in klaren, ruhigen Bereichen strukturiert.

Komponenten besitzen:

- nachvollziehbare Informationshierarchie,
- ausreichenden Innenabstand,
- klar erkennbare Überschrift und Funktion,
- keine rein dekorative Komplexität ohne Nutzwert.

Öffentliche Flächen beziehen Farben, Borders und Typografie aus Theme-Tokens. Interne Backend-Flächen dürfen native WordPress-Admin-Muster verwenden.

Für die öffentliche Homepage gelten zusätzlich die konkreten Inhaltsbreiten, Gutter-, Grid-, Karten- und Bildregeln aus `homepage-standard.md`.

### 7. Buttons, Eingaben und Touch-Ziele

Buttons und Formelemente sollen projektübergreifend vertraut wirken.

Verbindlich:

- primäre und sekundäre Aktionen sind klar unterscheidbar,
- sichtbarer Fokuszustand,
- klare Beschriftung statt unklarer Symbolaktionen,
- destruktive Aktionen eindeutig erkennbar,
- Icon-only-Aktionen nur mit eindeutigem zugänglichem Namen,
- **wichtige interaktive Touch-Ziele mindestens `44 × 44 CSS-Pixel`**, soweit keine eng begrenzte Ausnahme fachlich begründet ist,
- primäre Mobile-Aktionen dürfen bevorzugt mindestens `48px` hoch sein.

Die Mindestgröße gilt insbesondere für Buttons, Navigationseinträge, Icon-Aktionen, Drawer-Steuerung, Slider-/Carousel-Steuerung und vergleichbare wichtige Interaktionen.

Im öffentlichen Frontend kommen Farben und Typografie aus dem Theme. Die funktionalen Zustände werden im Plugin sauber definiert.

### 8. Navigation

Navigation orientiert sich an Aufgaben und nicht an technischen Modulen.

Tabs, Menüs und Navigationseinträge:

- verwenden verständliche fachliche Begriffe,
- bleiben möglichst stabil,
- vermeiden unnötige Ebenen,
- zeigen nur kontextrelevante Optionen.

Die konkrete öffentliche Mobile-/Tablet-Navigation der Homepage ist in `homepage-standard.md` als rechter Drawer definiert.

### 9. Formulare

Formulare werden so kurz wie fachlich möglich gehalten.

Regeln:

- nur notwendige Felder,
- verständliche sichtbare Labels,
- sinnvolle Defaults,
- zusammengehörige Angaben gruppieren,
- Fehler direkt am Problem erklären,
- Fehlerzustände nicht nur über Farbe darstellen,
- Pflicht/optional verständlich machen,
- keine doppelte Eingabe bereits vorhandener Informationen,
- Tastaturreihenfolge folgt der visuellen und fachlichen Reihenfolge.

#### Datumsfelder und Kalender-Picker

Datumsfelder nutzen vorhandenen fachlichen Kontext.

Verbindlich:

- vorhandenes Bezugsdatum bestimmt den sinnvollen Zeitraum,
- abhängige Datumsfelder verwenden einen sinnvollen Default, solange der Nutzer noch keine bewusste Auswahl getroffen hat,
- fortlaufende Datumsreihen dürfen den nächsten logischen Wert ableiten,
- automatisch gesetzte Defaults überschreiben keine spätere Nutzerauswahl,
- `min`/`max` bilden fachliche Regeln ab und werden nicht als Navigationshack verwendet,
- kontextbezogene Defaults stehen fest, bevor der native Picker geöffnet wird,
- bei dynamischen Feldern wird der Default möglichst bereits beim Erzeugen gesetzt.

Das im Event Planner verifizierte Muster `vorheriger Event-Tag + 1 Tag` bleibt Referenz. Der frühere Ansatz, einen Default erst während `pointerdown` oder `focus` zu setzen, gilt als unzuverlässig.

### 10. Status, Feedback und Zustände

Das System kommuniziert insbesondere:

- Erfolg,
- Fehler,
- fehlende Eingaben,
- laufende Verarbeitung,
- leere Zustände,
- fehlende Berechtigung,
- irreversible Folgen vor der Ausführung.

Ladezustände blockieren nicht unnötig die gesamte Oberfläche, wenn nur ein Teilbereich verarbeitet wird.

### 11. Responsive Verhalten

Mobile, Tablet und Desktop werden als echte Nutzungskontexte behandelt.

Für öffentliche Frontends gilt als gemeinsame Implementierungsrichtung:

- Mobile: `< 768px`
- Tablet: `768px–1023px`
- Desktop: `>= 1024px`

Komponenten dürfen zusätzliche inhaltsgetriebene Breakpoints verwenden, wenn der Inhalt sichtbar früher oder später bricht. Die Bereiche sind keine Aufforderung zu starren Layouts.

Neue bzw. wesentlich geänderte Oberflächen werden mindestens auf folgenden Test-Viewports geprüft:

- `320px`,
- Smartphone um `360px` oder `390px`,
- Tablet um `768px`,
- `1024px`,
- Desktop um `1280px`,
- große Desktopbreite um `1440px`.

Zusätzlich werden bei relevanten Änderungen geprüft:

- Smartphone-Querformat,
- mindestens ein reales iPhone mit Safari,
- mindestens ein reales Android-Gerät mit Chrome.

Responsive Design nutzt je nach Kontext:

- **Reflow** – Inhalte ordnen sich neu,
- **Reduce** – sekundäre Informationen werden sinnvoll reduziert,
- **Prioritize** – zentrale Information und Aktion bleiben zuerst sichtbar.

Tablet ist ein eigener Nutzungskontext und wird nicht pauschal als großes Smartphone behandelt. Für jede wesentliche Komponente soll das Tablet-Verhalten bewusst beschrieben oder aus einem klaren gemeinsamen Muster ableitbar sein.

Tabellen und komplexe Ansichten benötigen für kleine Displays eine bewusste Lösung. Browser-Zoom wird nicht deaktiviert.

### 12. Accessibility – WCAG 2.2 AA

Neue und wesentlich geänderte TuS-Oberflächen orientieren sich an WCAG 2.2 Level AA.

Mindestens gelten:

- semantisches HTML vor ARIA-Sonderkonstruktionen,
- wesentliche Interaktionen mit Tastatur erreichbar,
- sichtbarer und nachvollziehbarer Fokus,
- programmatisch zugeordnete Formularlabels,
- verständliche zugeordnete Fehlermeldungen,
- Farbe nie als einziger Informationsträger,
- ausreichende Kontraste,
- passende Alternativtexte für relevante Bilder,
- dekorative Bilder korrekt ausblenden,
- verständliche zugängliche Namen für Links und Buttons,
- sinnvolle Überschriftenstruktur,
- Nutzbarkeit bei Vergrößerung und auf kleinen Displays,
- sparsame Bewegung; `prefers-reduced-motion` wird berücksichtigt, wenn relevant.

Accessibility ist Bestandteil von Design und Implementierung, kein späteres Zusatzprojekt.

### 13. Backend und Frontend – gemeinsame Bedienlogik, getrennte Styling-Verantwortung

Backend und öffentliches Frontend gehören zur selben Produktfamilie, müssen aber nicht identisch aussehen.

Gemeinsam sind insbesondere:

- verständliche Begriffe,
- Button-/Formularlogik,
- Status-/Fehlerverhalten,
- Spacing-Grundsätze,
- Fokus-/Accessibility-Verhalten,
- robuste Responsive-Grundsätze, soweit der Nutzungskontext dies erfordert.

Für das Styling gilt:

- **Frontend:** Theme liefert Brand-Farben und Brand-Typografie,
- **Backend:** native WordPress-Admin-Muster bzw. neutrale gemeinsame Bedienmuster werden bevorzugt,
- Plugins bauen keine parallele Brand-Schicht, die bei Theme-Wechsel separat gepflegt werden muss.

Interne Oberflächen priorisieren Effizienz und klare Arbeitsabläufe. Öffentliche Oberflächen priorisieren Orientierung, Markenwirkung und reduzierte Informationsführung.

### 14. Browser-Support

Für öffentliche TuS-Weboberflächen werden unterstützt:

- aktuelle und vorherige Hauptversion von Chrome,
- aktuelle und vorherige Hauptversion von Edge,
- aktuelle und vorherige Hauptversion von Firefox,
- aktuelle und vorherige Hauptversion von Safari auf macOS,
- aktuelle und vorherige Hauptversion von Safari auf iOS,
- aktuelle und vorherige Hauptversion von Chrome auf Android.

Internet Explorer und andere Legacy-Browser werden nicht unterstützt.

Progressive Enhancement ist zu bevorzugen: Kerninhalte, Navigation und wesentliche Interaktionen dürfen nicht ausschließlich von experimentellen Browserfeatures abhängen.

### 15. Schlanke UI und Performance

Eine Oberfläche soll unmittelbar reagieren und nur die Ressourcen laden, die für den aktuellen Kontext benötigt werden.

Daher gilt:

- keine schweren UI-Bibliotheken ohne klaren Nutzen,
- bestehende WordPress-/Browser-Funktionen vor Eigenimplementierung prüfen,
- CSS/JS nur dort laden, wo es gebraucht wird,
- Theme-Branding wiederverwenden statt Brand-CSS in Plugins zu duplizieren,
- Bilder passend dimensionieren,
- keine unnötigen Layoutsprünge,
- asynchrone Prozesse und Ladezustände nachvollziehbar darstellen,
- externe Inhalte dürfen den Kern der Seite nicht unnötig blockieren,
- keine Komponenten für hypothetische zukünftige Anforderungen auf Vorrat bauen.

Für die öffentliche Homepage gelten zusätzlich die Performanceziele aus `../standards/software-development-quality-standard.md`.

### 16. Kein projektspezifisches UI-System ohne Grund

Ein Entwickler erstellt nicht für jedes Plugin neue Button-, Karten-, Formular-, Spacing-, Typografie- oder Farbsysteme.

Wenn ein bestehendes Muster nicht ausreicht, wird zuerst geprüft:

- kann das bestehende Muster erweitert werden,
- ist die neue Lösung auch für andere TuS-Produkte real relevant,
- sollte daraus tatsächlich ein gemeinsames Muster entstehen?

Keine Abstraktion wird nur deshalb gebaut, weil sie irgendwann eventuell wiederverwendbar sein könnte.

### 17. UI-Abnahme

Bei neuen bzw. wesentlich geänderten sichtbaren Funktionen werden – soweit für den Scope relevant – geprüft:

- Desktop, Tablet, Smartphone,
- `320px` Mindestbreite,
- Smartphone-Querformat,
- Tastaturbedienung und Fokus,
- Touch-Ziele,
- Labels/Fehlermeldungen,
- Empty State,
- Loading State,
- Fehlerzustand,
- lange/unerwartete Inhalte,
- Berechtigungs-/Read-only-Zustand,
- korrekte Originalassets,
- öffentliche Komponenten reagieren korrekt auf Theme-Tokens statt eigene Brand-Werte zu erzwingen,
- relevante reale Geräte und unterstützte Browser.

Prüfungen werden risikobasiert gewählt; ein lokaler UI-Change löst nicht automatisch einen vollständigen Produkttest aus.

Ein Agent dokumentiert nur tatsächlich durchgeführte Prüfungen als bestanden.

### 18. Veränderung des UI Standards

Neue UI-Muster dürfen im Projekt erprobt werden.

Zum organisationsweiten Standard werden sie erst, wenn sie sich in realer Nutzung bewährt haben.

## Relationship to other documents

- `README.md`
- `design-principles.md`
- `brand-identity.md`
- `logo.md`
- `colors.md`
- `typography.md`
- `homepage-standard.md`
- `../standards/software-development-quality-standard.md`
- `../standards/data-persistence-and-database-standard.md`
- `../standards/iteration-and-progress.md`
- `../roles/wordpress-developer/development-standard.md`

## Future Development

Der Standard wird aus realen Produkten weiterentwickelt. Wiederkehrende Komponenten werden erst dann zum gemeinsamen TuS Digital Design System, wenn sie sich in mehreren echten Produkten bewährt haben.

Weitere Tokens, Breakpoints oder Komponenten werden nur ergänzt, wenn reale Produkte sie benötigen. Die Brand-Werte selbst bleiben im WordPress-Theme und werden nicht in Plugins dupliziert.