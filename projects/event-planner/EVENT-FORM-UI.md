# Event Planner – Event-Anlegen UI

## Purpose

Dieses Dokument definiert die verbindliche Struktur und Bedienlogik für den Screen zum Anlegen und späteren Bearbeiten von TuS-Veranstaltungen.

Die bereitgestellten Mockups definieren Aufbau, Informationshierarchie und Vereinfachungsrichtung. Sie sind ausdrücklich **keine Farbquelle**. Für Farben, Komponenten und Zustände gelten weiterhin die bestehenden Event-Planner-Styles sowie die zentralen TuS-UI-Standards.

## Core Principle

**Ein Event soll in einem klar strukturierten Arbeitsgang angelegt werden können.**

Die Oberfläche trennt Navigation, Veranstaltungsdaten, Vorlagenbezug und eventbezogene Sponsoren so, dass der Nutzer sofort erkennt, welche Informationen wohin gehören.

Daten werden nicht in großen Sammelfeldern verborgen, wenn sie fachlich strukturiert und wiederverwendbar sein sollen.

**Alle fachlich dauerhaft benötigten Formularwerte werden persistent in der Datenbank gespeichert.** Sessions, Session-IDs oder flüchtiger Browserzustand sind keine dauerhafte Datenquelle. Die verbindliche projektweite Regel steht in `DATA-PERSISTENCE.md`.

## Main Content

### 1. Seitentitel und Einordnung

Titel:

`Events: Neue TuS Veranstaltungen anlegen`

Untertitel:

`Veranstaltungen können aus Vorlagen oder komplett neu angelegt werden`

Die Wortwahl kann bei der Implementierung leicht sprachlich geglättet werden, ohne die fachliche Bedeutung zu verändern.

### 2. Navigation im Event-Modul

Am oberen Rand stehen vier gleichwertige Hauptbereiche:

- `neues Event`
- `aktive Events`
- `Vorlagen`
- `Archiv`

Der aktuell aktive Bereich wird visuell eindeutig hervorgehoben.

Logik:

#### Neues Event

Zeigt das Formular zum Anlegen einer neuen Veranstaltung.

#### Aktive Events

Zeigt alle aktuell nicht archivierten Events zur Auswahl und Bearbeitung.

#### Vorlagen

Führt zur Verwaltung und Auswahl wiederverwendbarer Event-Templates.

Templates sind Bestandteil des langfristigen Event-Planner-Zielbilds. Die Navigation darf bereits vorgesehen werden, auch wenn die vollständige Template-Logik in einem späteren Entwicklungsschritt umgesetzt wird.

#### Archiv

Zeigt archivierte Events bzw. führt in die historische Eventansicht.

Die endgültige Verbindung zur späteren Seite `Auswertung & Historie` wird separat entschieden.

### 3. Neues Event anlegen

Der eigentliche Formularbereich trägt die Überschrift:

`Neues Event anlegen`

Im Kopf des Formularbereichs ist zusätzlich eine Auswahl vorgesehen:

`Veranstaltung aus Vorlage anlegen:`

mit einem Dropdown.

Verhalten:

- ohne vorhandene Vorlagen kann ein neutraler Leerzustand wie `– keine Vorlagen vorhanden –` angezeigt werden,
- bei Auswahl einer Vorlage werden geeignete Felder und später auch wiederkehrende Planungsbestandteile vorbelegt,
- das neu erzeugte Event ist anschließend unabhängig von der Vorlage bearbeitbar,
- Änderungen am neuen Event verändern die Vorlage nicht rückwirkend.

### 4. Bereich `Veranstaltungsdaten`

Die Veranstaltungsdaten werden auf größeren Bildschirmen in zwei klar getrennten Spalten dargestellt.

#### Linke Spalte

- Veranstaltungsname
- Startdatum
- Enddatum
- Veranstaltungsort

#### Rechte Spalte

- Veranstaltungsbeschreibung
- zusätzlicher Link zur Veranstaltung
- Checkbox `Veranstaltung im öffentlichen Kalender anzeigen?`

Die bestehende fachliche Datums-Picker-Logik bleibt verbindlich:

- Enddatum verwendet Startdatum als Kontext, solange keine bewusste Nutzerauswahl getroffen wurde,
- kontextbezogene Defaults werden gesetzt, bevor der native Datums-Picker geöffnet wird,
- manuelle Auswahl wird nicht still überschrieben.

### 5. Persistenz der Formularwerte

Jedes Formularfeld, dessen Wert nach `Event anlegen` oder `Speichern` dauerhaft zum Event gehört, muss in der Datenbank persistiert werden.

Für die Event-Anlage betrifft das mindestens:

- Veranstaltungsname,
- Startdatum,
- Enddatum,
- Veranstaltungsort,
- Veranstaltungsbeschreibung,
- zusätzlichen Veranstaltungslink,
- öffentliche Kalender-Sichtbarkeit,
- ausgewählte Event-Art bzw. später Camp-spezifische Werte,
- eventbezogene Sponsor-Zeilen einschließlich Logo-/Medienreferenz.

Nach erfolgreichem Speichern müssen diese Informationen nach Reload, Browser-Neustart, Session-Ende und erneutem Öffnen des Events weiterhin vorhanden sein.

Nicht zulässig ist, dauerhaft benötigte Informationen nur über Session-IDs, JavaScript-Zustand, Query-Parameter oder andere flüchtige Mechanismen wiederzufinden.

Temporärer Zustand ist nur zulässig, solange ein Verlust fachlich ausdrücklich akzeptabel ist und noch kein erfolgreicher dauerhafter Speichervorgang signalisiert wurde.

Die vollständige Regel einschließlich Migration und Persistenztest steht in `DATA-PERSISTENCE.md`.

### 6. Responsive Verhalten

Das zweispaltige Formular ist nur für ausreichend breite Ansichten vorgesehen.

Auf mobilen Endgeräten oder schmalen Ansichten werden die Felder kontrolliert untereinander dargestellt.

Die Reihenfolge bleibt fachlich nachvollziehbar:

1. Veranstaltungsname
2. Startdatum
3. Enddatum
4. Veranstaltungsort
5. Veranstaltungsbeschreibung
6. zusätzlicher Link
7. Kalender-Sichtbarkeit

### 7. Sponsorenübersicht

Der Sponsorenbereich wird **nicht** als großes unstrukturiertes Text- oder Sammelfeld dargestellt.

Stattdessen werden eventbezogene Sponsoren zeilenweise geführt.

Überschrift:

`Sponsorenübersicht`

Aktion:

`Neuen Sponsor hinzufügen`

Jeder Sponsor ist ein eigener strukturierter Eintrag.

### 8. Sponsor-Zeile

Eine Sponsor-Zeile trennt mindestens folgende Informationen klar voneinander:

- `Name`
- `Logo`
- `Link zur Homepage`

Die visuelle Anordnung erfolgt auf breiten Ansichten in einer Zeile bzw. klaren Spalten.

Das Logo wird über einen geeigneten WordPress-Medien-/Upload-Mechanismus gepflegt und nicht als freier Text in ein Sammelfeld geschrieben. Die dauerhafte Medienreferenz wird im fachlichen Datensatz gespeichert.

Der Homepage-Link ist ein eigenes URL-Feld.

### 9. Sponsor-Aktionen

Sponsor-Zeilen benötigen verständliche Aktionen zum:

- Hinzufügen,
- Bearbeiten,
- Entfernen,
- Speichern, soweit der konkrete Bearbeitungsmodus dies erfordert.

Im **Neuanlage-Modus** werden neu erfasste Sponsor-Zeilen grundsätzlich zusammen mit `Event anlegen` dauerhaft in der Datenbank gespeichert. Es ist nicht erforderlich, vor Existenz des Events künstlich jede Zeile separat serverseitig zu speichern.

Im **Bearbeitungsmodus** können Zeilen später einzeln ergänzt oder entfernt werden; die Änderung muss anschließend persistent gespeichert werden.

Werden Icon-Aktionen verwendet, benötigen sie eindeutige Tooltips/ARIA-Labels und dürfen nicht nur durch ihre Grafik verständlich sein.

### 10. Datenstruktur der Event-Sponsoren

Die UI benötigt strukturierte Sponsor-Daten statt eines großen Textfelds.

Fachlich relevant je Sponsor:

- Name,
- Logo-/Medienreferenz,
- Homepage-Link.

Weitere Partner-/Sponsoringdaten werden nicht automatisch in diesen Event-Bereich gezogen.

Für die erste Umsetzung gilt:

**Der Event Planner verwaltet die Sponsorendarstellung des konkreten Events.**

Eine spätere Verbindung zu einer gemeinsamen Partnerdatenquelle bzw. zum Partner Hub darf möglich bleiben, soll aber nicht Voraussetzung für die einfache Event-Anlage sein und keine doppelte Partnerverwaltung erzwingen.

### 11. Hauptaktion

Am Ende des Formulars steht die klare primäre Aktion:

`Event anlegen`

Sie speichert dauerhaft mindestens:

- Veranstaltungsdaten,
- Kalender-Sichtbarkeit,
- zusätzliche URL,
- zum neuen Event erfasste Sponsor-Zeilen.

Ein erfolgreicher Speichervorgang darf nur bestätigt werden, wenn die relevanten Daten persistent geschrieben wurden.

Weitere Planungsbereiche wie Ablauf, Aufgaben, Helferbedarf, Schichten, Bestellungen oder Ausgaben werden nach dem Anlegen im Event-Bearbeitungsprozess ergänzt und unterliegen ebenfalls `DATA-PERSISTENCE.md`, sobald ihre Daten dauerhaft relevant sind.

### 12. Visuelle Leitplanken

Die Mockups definieren:

- die klare obere Navigation,
- die zweispaltige Informationsstruktur,
- den abgegrenzten Bereich `Veranstaltungsdaten`,
- den zeilenweisen Sponsorenbereich,
- die ruhige und reduzierte Informationshierarchie.

Sie definieren **nicht**:

- neue Primärfarben,
- neue Branding-Farben,
- neue Logo-Varianten,
- abweichende globale UI-Tokens.

Für die Implementierung gelten insbesondere:

- `../../design/ui-standard.md`,
- `../../design/logo.md`,
- die bestehenden Event-Planner-Styles.

### 13. Umsetzung in kleinen Schritten

Die Umsetzung soll nicht als großer Sammelumbau erfolgen.

Sinnvolle Reihenfolge:

1. obere Event-Navigation und neues Formularlayout,
2. Vorlagen-Dropdown als vorbereitete UI mit sauberem Leerzustand,
3. Sponsorenbereich von Sammelfeld auf strukturierte Zeilen umstellen,
4. dauerhafte Datenstruktur und bestehende Sponsor-Daten rückwärtskompatibel behandeln bzw. migrieren,
5. Speichern → Reload → erneutes Öffnen für alle persistenten Felder verifizieren,
6. responsive Verhalten und Accessibility prüfen,
7. vollständigen Ablauf im WordPress Playground verifizieren.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md` definiert den Gesamtumfang des Event Planners.
- `DASHBOARD-LOGIC.md` definiert Dashboard, operative Aufgaben sowie Auswertungs-/Historienrichtung.
- `DATA-PERSISTENCE.md` definiert die verbindliche dauerhafte Datenhaltung für alle fachlich persistenten Werte.
- `PROJECT-STATE.md` hält den aktuellen Entwicklungsstand.
- `../../design/ui-standard.md` definiert die organisationsweiten UI-Regeln.
- `../../design/logo.md` definiert die verbindliche Markenasset-Nutzung.

Dieses Dokument ist die verbindliche Struktur- und UX-Vorgabe für die Event-Anlage und die dazugehörige Sponsorenpflege.

## Future Development

Spätere Erweiterungen dürfen die Grundstruktur ergänzen, insbesondere durch:

- echte Event-Templates,
- strukturierte Organisationsaufgaben,
- Bestellungen und Ausgaben,
- Camp-spezifische Felder bei Event-Art `camp`,
- optionale Referenzen auf eine zentrale Partnerdatenquelle.

Die Event-Anlage soll dabei weiterhin kompakt bleiben. Zusätzliche Spezialfunktionen werden nur dort eingeblendet, wo sie für den gewählten Event-Typ tatsächlich relevant sind. Alle dauerhaft benötigten neuen Felder müssen vor ihrer UI-Umsetzung eine definierte persistente Datenquelle besitzen.
