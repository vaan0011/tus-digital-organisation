# UI Standard

## Purpose

Dieses Dokument definiert den gemeinsamen UI-Standard für digitale Produkte der TuS Digital Organisation.

Dazu gehören insbesondere WordPress-Plugins, Portale, interne Arbeitsoberflächen und zukünftige Webanwendungen.

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

### 4. Flächen und Karten

Inhalte werden bevorzugt in klaren, ruhigen Bereichen strukturiert.

Referenzmuster:

- weiße Surface,
- dezente Border,
- zurückhaltender Schatten,
- Kartenradius typischerweise `12–16px`,
- ausreichender Innenabstand,
- klar erkennbare Überschrift und Funktion.

### 5. Buttons und Eingaben

Buttons und Formelemente sollen projektübergreifend vertraut wirken.

Referenzmuster:

- primäre Aktionen deutlich hervorgehoben,
- sekundäre Aktionen visuell zurückhaltender,
- Radius typischerweise `8px`,
- sichtbarer Fokuszustand,
- klare Beschriftung statt unklarer Symbolaktionen,
- destruktive Aktionen eindeutig als solche erkennbar.

### 6. Navigation

Navigation orientiert sich an Aufgaben und nicht an technischen Modulen.

Tabs, Menüs und Navigationseinträge:

- verwenden verständliche fachliche Begriffe,
- bleiben möglichst stabil,
- vermeiden unnötige Ebenen,
- zeigen nur kontextrelevante Optionen.

### 7. Formulare

Formulare werden so kurz wie fachlich möglich gehalten.

Regeln:

- nur notwendige Felder,
- verständliche Labels,
- sinnvolle Defaults,
- zusammengehörige Angaben gruppieren,
- Fehler möglichst direkt am Problem erklären,
- keine doppelte Eingabe bereits vorhandener Informationen.

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

### 8. Status und Feedback

Nach wichtigen Aktionen muss der Nutzer erkennen können, was passiert ist.

Das System kommuniziert insbesondere:

- Erfolg,
- Fehler,
- fehlende Eingaben,
- laufende Verarbeitung,
- irreversible Folgen vor der Ausführung.

### 9. Responsive Verhalten

Oberflächen werden so gebaut, dass sie auch auf kleineren Displays sinnvoll nutzbar bleiben, wenn der Nutzungskontext dies erfordert.

Mehrspaltige Layouts brechen auf kleinere Breiten kontrolliert auf eine Spalte um.

### 10. Kein projektspezifisches UI-System ohne Grund

Ein Entwickler erstellt nicht für jedes Plugin neue Button-, Karten-, Formular- oder Farbsysteme.

Wenn ein bestehendes Muster nicht ausreicht, wird zunächst geprüft:

- kann das bestehende Muster erweitert werden,
- ist die neue Lösung auch für andere TuS-Produkte sinnvoll,
- sollte daraus ein gemeinsames UI-Muster entstehen?

### 11. Veränderung des UI Standards

Neue UI-Muster dürfen im Projekt erprobt werden.

Zum organisationsweiten Standard werden sie erst, wenn sie sich bewährt haben und nachvollziehbar übernommen wurden.

## Relationship to other documents

- `README.md`
- `design-principles.md`
- `logo.md`
- `colors.md`
- `typography.md`
- `../standards/iteration-and-progress.md`
- `../roles/wordpress-developer/development-standard.md`

## Future Development

Der Standard wird aus realen Produkten weiterentwickelt. Als nächste mögliche Ausbaustufen kommen gemeinsame Komponenten, Spacing-Tokens, Typografie, Statusmuster und Accessibility-Regeln infrage, sobald dafür echte wiederkehrende Anforderungen vorliegen.
