# Event Planner – Status Color Standard

## Purpose

Dieser Standard definiert die verbindliche Farblogik für Fortschritts- und Statusanzeigen im TuS Event Planner.

Ziel ist, dass Farben den fachlichen Zustand verständlich unterstützen, ohne normale Planungsschritte fälschlich als Fehler darzustellen.

## Core Principle

**Rot ist eine Warnfarbe, kein normaler Planungszustand.**

Ein frisch angelegtes oder noch nicht begonnenes Planungselement ist nicht fehlerhaft. Die visuelle Grundentwicklung lautet deshalb:

`Grau → Blau → Gelb/Orange → Grün`

`Rot` wird nur verwendet, wenn ein fachlich kritischer Zustand tatsächlich vorliegt.

Farbe vermittelt einen Zustand niemals allein. Jede farbige Statusanzeige benötigt zusätzlich einen verständlichen Text wie `noch nicht geplant`, `geplant`, `3 offen`, `vollständig belegt` oder `überfällig`.

## Main Content

### 1. Grau – noch nicht begonnen

Bedeutung:

- noch nicht geplant,
- noch keine fachlichen Daten vorhanden,
- der Zustand ist zum aktuellen Zeitpunkt normal und unkritisch.

Beispiele:

- `0 Programmpunkte`,
- `0 Aufgaben`,
- `0/0 Schichten`,
- `0/0 Helfer`.

Grau ist ausdrücklich **kein Fehlerzustand**.

### 2. Blau – geplant / in Bearbeitung

Bedeutung:

- Planung wurde begonnen,
- der Baustein ist angelegt,
- Bearbeitung bzw. Besetzung steht noch am Anfang.

Beispiele:

- Programmpunkte sind vorhanden, aber noch nicht veröffentlicht,
- Aufgaben wurden angelegt, aber noch keine erledigt,
- Schichten wurden geplant, aber noch keine vollständig belegt,
- Helferbedarf ist definiert, aber noch keine Helfer sind angemeldet.

### 3. Gelb / Orange – teilweise erledigt / Aufmerksamkeit nötig

Bedeutung:

- die Bearbeitung ist sichtbar fortgeschritten,
- es bestehen aber noch offene Punkte.

Beispiele:

- einige Aufgaben erledigt, andere noch offen,
- einige Schichten vollständig belegt, andere noch offen,
- ein Teil der benötigten Helfer ist angemeldet.

Gelb/Orange signalisiert Aufmerksamkeit, aber noch keinen kritischen Fehler.

### 4. Grün – vollständig erfüllt

Bedeutung:

- der fachliche Schritt ist vollständig erfüllt.

Beispiele:

- Event wurde erstellt,
- Programm wurde veröffentlicht,
- alle Aufgaben sind erledigt,
- alle erforderlichen Schichten sind vollständig belegt,
- die benötigten Helferplätze sind vollständig besetzt.

### 5. Rot – kritisch

Bedeutung:

- überfällig,
- blockiert,
- oder ein zeitlich bzw. fachlich tatsächlich kritischer Mangel besteht.

Rot darf nicht allein daraus entstehen, dass ein Planungsschritt noch nicht begonnen wurde oder noch offen ist.

Typische künftige Beispiele:

- überfällige Pflichtaufgabe,
- fehlende erforderliche Genehmigung kurz vor Veranstaltungsbeginn,
- kritische Helferunterdeckung kurz vor oder während des Events,
- blockierender Zustand, der die Veranstaltung gefährdet.

Zeitabhängige Eskalationsregeln werden erst eingeführt, wenn dafür ein fachlich belastbares Frist-/Pflichtmodell existiert. Bis dahin wird Rot in den normalen Fortschrittskacheln nicht automatisch vergeben.

## Anwendung auf die fünf Event-Fortschrittskacheln

### Event erstellt

- Grün, sobald das Event persistent existiert.

### Programm

- Grau: keine Programmpunkte vorhanden.
- Blau: Programmpunkte vorhanden, aber noch nicht veröffentlicht.
- Grün: Programm veröffentlicht.
- Rot: erst bei einer später definierten kritischen Fristverletzung.

### Aufgaben

- Grau: keine Aufgaben geplant.
- Blau: Aufgaben vorhanden, aber noch keine erledigt.
- Gelb/Orange: Aufgaben teilweise erledigt.
- Grün: alle Aufgaben erledigt.
- Rot: überfällige oder blockierende Pflichtaufgaben, sobald das persistente Aufgabenmodell Fristen unterstützt.

### Schichten

- Grau: keine Schichten geplant.
- Blau: Schichten geplant, noch keine vollständig belegt.
- Gelb/Orange: Schichten teilweise vollständig belegt.
- Grün: alle erforderlichen Schichten vollständig belegt.
- Rot: kritische Unterbesetzung nach später definierten Eskalationsregeln.

### Helfer

- Grau: noch kein Helferbedarf vorhanden.
- Blau: Helferbedarf vorhanden, aber noch keine Helfer angemeldet.
- Gelb/Orange: Helfer teilweise angemeldet.
- Grün: benötigte Helferzahl erreicht oder überschritten.
- Rot: kritische Unterbesetzung nach später definierten Eskalationsregeln.

## Relationship to other documents

- `EVENT-EDIT-UI.md`
- `DASHBOARD-LOGIC.md`
- `FUNCTIONAL-SCOPE.md`
- `../../design/ui-standard.md`

Die bestehenden TuS-/Event-Planner-Farbtokens bleiben die visuelle Grundlage. Dieser Standard definiert die **Semantik der Zustände**, nicht eine neue unabhängige Farbwelt.

## Future Development

Sobald Aufgaben, Pflichttermine und Fristen persistent modelliert sind, können zeitabhängige Eskalationsregeln ergänzt werden.

Beispiel: Derselbe offene Helferbedarf kann drei Monate vor einem Event normal sein, wenige Tage vor Beginn jedoch kritisch werden. Solche Regeln müssen fachlich explizit definiert und dürfen nicht aus beliebigen UI-Annahmen entstehen.
