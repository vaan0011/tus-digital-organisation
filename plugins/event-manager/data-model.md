# Datenmodell

## Purpose

Dieses Dokument beschreibt alle fachlichen Objekte des Event Managers sowie deren Beziehungen.

Es bildet die Grundlage für die technische Umsetzung und stellt sicher, dass Funktionen auf einem konsistenten Datenmodell aufbauen.

---

## Core Principle

Funktionen entstehen aus Daten.

Bevor eine Funktion entwickelt wird, müssen die benötigten Objekte und ihre Beziehungen definiert sein.

---

## Hauptobjekte

Der Event Manager verwaltet unter anderem folgende Objekte:

- Veranstaltung
- Veranstaltungstyp
- Aufgabe
- Rolle
- Person
- Digitaler Mitarbeiter
- Ressource
- Dokument
- Bild
- Ticket
- Sponsor
- Helfer
- Zeitplan
- Budget
- Wissenseintrag
- Checkliste
- Kommunikation
- Standort

Dieses Dokument beschreibt schrittweise jedes Objekt und dessen Beziehungen zu anderen Objekten.

# Objekt: Veranstaltung

## Beschreibung

Die Veranstaltung ist das zentrale Objekt des Event Managers.

Alle weiteren Objekte stehen direkt oder indirekt mit einer Veranstaltung in Beziehung.

Eine Veranstaltung bildet den vollständigen organisatorischen Rahmen eines Vereinsereignisses – von der ersten Idee bis zur Archivierung.

---

## Stammdaten

Jede Veranstaltung besitzt unter anderem folgende Eigenschaften:

- Titel
- Kurzbeschreibung
- Veranstaltungstyp
- Status
- Datum
- Beginn
- Ende
- Veranstaltungsort
- Veranstalter
- Saison
- Kategorie
- Sichtbarkeit
- Titelbild

---

## Beziehungen

Eine Veranstaltung kann besitzen:

- mehrere Aufgaben
- mehrere Rollen
- mehrere Helfer
- mehrere Sponsoren
- mehrere Dokumente
- mehrere Bilder
- mehrere Tickets
- mehrere Ressourcen
- mehrere Kommunikationskanäle
- mehrere Wissenseinträge
- mehrere Checklisten
- mehrere Budgets
- mehrere Zeitpläne

Sie bildet den Mittelpunkt des gesamten Datenmodells.

## Status einer Veranstaltung

Jede Veranstaltung besitzt genau einen aktuellen Status.

Der Status beschreibt den organisatorischen Fortschritt und steuert, welche Funktionen verfügbar sind.

### Mögliche Status

- Idee
- In Planung
- Freigegeben
- Bewerbung läuft
- Vorbereitung
- Aufbau
- Laufend
- Nachbereitung
- Archiviert
- Vorlage

Der Status kann automatisch oder manuell geändert werden.

Abhängig vom Status können Funktionen aktiviert oder deaktiviert werden.

Beispiele:

- Ticketverkauf erst nach Freigabe
- Social-Media-Kampagnen während der Bewerbungsphase
- Helfer-Checklisten während Aufbau und Durchführung
- Lessons Learned erst in der Nachbereitung
- Wiederverwendung nur bei archivierten Veranstaltungen


## Zeitachse

Jede Veranstaltung besitzt eine eigene Zeitachse.

Auf dieser Zeitachse werden alle relevanten Ereignisse, Termine und Meilensteine chronologisch verwaltet.

### Beispiele

- Veranstaltung angelegt
- Budget freigegeben
- Sponsoren angeschrieben
- Ticketverkauf gestartet
- Flyer veröffentlicht
- Ortsblatt versendet
- Social-Media-Kampagne gestartet
- Helferplanung abgeschlossen
- Material bestellt
- Aufbau begonnen
- Veranstaltung gestartet
- Veranstaltung beendet
- Fotos hochgeladen
- Artikel veröffentlicht
- Danksagungen versendet
- Lessons Learned abgeschlossen
- Veranstaltung archiviert

Jeder Eintrag besitzt mindestens:

- Datum und Uhrzeit
- Verantwortlichen
- Status
- Kategorie
- Beschreibung
- Verknüpfungen zu Aufgaben oder Dokumenten

Die Zeitachse dient gleichzeitig als Projekttagebuch und als vollständige Historie der Veranstaltung.

## Beziehungen

Die Stärke des Event Managers liegt nicht in einzelnen Datenobjekten, sondern in deren Beziehungen.

Eine Veranstaltung steht mit zahlreichen anderen Objekten in Verbindung.

### Direkte Beziehungen

Eine Veranstaltung besitzt:

- einen Veranstaltungstyp
- mehrere Aufgaben
- mehrere Rollen
- mehrere Verantwortliche
- mehrere Helfer
- mehrere Sponsoren
- mehrere Ressourcen
- mehrere Dokumente
- mehrere Bilder
- mehrere Kommunikationsmaßnahmen
- mehrere Termine
- mehrere Budgets
- mehrere Tickets
- mehrere Wissenseinträge

### Indirekte Beziehungen

Eine Veranstaltung kann außerdem mit folgenden Bereichen verknüpft sein:

- Mannschaften
- Trainer
- Mitglieder
- Spielbetrieb
- Vereinschronik
- Bildarchiv
- Content Hub
- Sponsor Manager
- Designsystem
- Dokumentenmanagement

Das Datenmodell ist bewusst relational aufgebaut.

Informationen werden nicht mehrfach gespeichert, sondern über Beziehungen miteinander verknüpft.

## Beziehungstypen

Nicht jede Beziehung zwischen zwei Objekten besitzt dieselbe Bedeutung.

Deshalb beschreibt der Event Manager Beziehungen bewusst über ihren fachlichen Kontext.

Beispiele:

### Person ↔ Veranstaltung

- organisiert
- unterstützt
- besucht
- fotografiert
- moderiert
- leitet

### Sponsor ↔ Veranstaltung

- Hauptsponsor
- Co-Sponsor
- Sachspender
- Werbepartner
- Ehrengast

### Ressource ↔ Veranstaltung

- reserviert
- benötigt
- aufgebaut
- ausgeliehen
- zurückgegeben

### Dokument ↔ Veranstaltung

- Einladung
- Genehmigung
- Ablaufplan
- Pressebericht
- Rechnung
- Protokoll

Beziehungen besitzen eigene Eigenschaften wie Zeitraum, Status, Verantwortlichkeiten oder Bemerkungen.

Dadurch entstehen deutlich aussagekräftigere Informationen als durch einfache Zuordnungen.

## Beziehungseigenschaften

Beziehungen besitzen eigene Informationen und sind nicht nur einfache Verknüpfungen zwischen zwei Objekten.

Dadurch können Beziehungen selbst verwaltet, ausgewertet und historisiert werden.

Eine Beziehung kann unter anderem folgende Eigenschaften besitzen:

- Beginn
- Ende
- Status
- Priorität
- Verantwortlicher
- Beschreibung
- Bemerkungen
- Dokumente
- Bilder
- Historie

### Beispiele

Anton organisiert das Sportfest.

Diese Beziehung besitzt:

- seit Januar 2027
- Rolle: Gesamtleitung
- Status: aktiv
- Verantwortlichkeit: Organisation
- Bemerkung: Ansprechpartner für Behörden

---

Ein Sponsor unterstützt das Jugendturnier.

Diese Beziehung besitzt:

- Sponsorenpaket Gold
- Laufzeit drei Jahre
- Werbefläche Hauptplatz
- Ansprechpartner
- Vertragsdokumente

Dadurch wird nicht nur gespeichert, **dass** zwei Objekte miteinander verbunden sind, sondern auch **wie**, **seit wann** und **unter welchen Bedingungen**.

## Verantwortlichkeit

Jedes Objekt im Event Manager besitzt mindestens einen Verantwortlichen.

Dadurch ist jederzeit nachvollziehbar, wer für Informationen, Entscheidungen oder Aufgaben zuständig ist.

### Verantwortliche können sein:

- Person
- Rolle
- Organisationsteam
- Digitaler Mitarbeiter

Die Verantwortlichkeit kann sich im Laufe einer Veranstaltung ändern und wird historisch nachvollziehbar gespeichert.

### Beispiele

Eine Aufgabe besitzt einen Verantwortlichen.

Ein Dokument besitzt einen Autor.

Ein Sponsor besitzt einen Ansprechpartner.

Ein Budget besitzt einen Verantwortlichen.

Eine Checkliste besitzt einen Besitzer.

Ein Wissenseintrag besitzt einen Verfasser.

Dadurch entstehen klare Zuständigkeiten und eine transparente Zusammenarbeit zwischen Menschen und digitalen Mitarbeitern.

## Ereignisse

Objekte reagieren auf Ereignisse.

Ein Ereignis beschreibt eine fachliche Änderung innerhalb des Systems und kann weitere Prozesse oder Automatisierungen auslösen.

### Beispiele

Eine Veranstaltung wird angelegt.

→ Vorlage auswählen

→ Standardaufgaben erzeugen

→ Organisationsteam erstellen

---

Ein Sponsor bestätigt seine Teilnahme.

→ Ansprechpartner informieren

→ Werbeleistungen aktivieren

→ Einladung versenden

---

Ein Ticket wird verkauft.

→ Sitzplatz reservieren

→ Bestätigung versenden

→ Teilnehmerliste aktualisieren

---

Ein Presseartikel wird veröffentlicht.

→ Facebook aktualisieren

→ Instagram vorbereiten

→ Chronik vormerken

---

Ein Event wird archiviert.

→ Wissenseinträge übernehmen

→ Bilder archivieren

→ Vorlage aktualisieren

→ Statistiken erzeugen

### Grundprinzip

Nicht Benutzer starten Prozesse.

Ereignisse starten Prozesse.

Dadurch entsteht eine lose gekoppelte und beliebig erweiterbare Architektur.

## Fähigkeiten

Objekte besitzen nicht nur Daten.

Sie besitzen fachliche Fähigkeiten.

Dadurch werden Funktionen nicht einem Plugin, sondern dem jeweiligen Objekt zugeordnet.

### Beispiel: Veranstaltung

Eine Veranstaltung kann:

- veröffentlicht werden
- archiviert werden
- kopiert werden
- storniert werden
- verschoben werden
- abgeschlossen werden
- bewertet werden

### Beispiel: Ticket

Ein Ticket kann:

- verkauft werden
- reserviert werden
- bezahlt werden
- storniert werden
- eingecheckt werden
- übertragen werden

### Beispiel: Sponsor

Ein Sponsor kann:

- angefragt werden
- zusagen
- absagen
- verlängern
- kündigen
- bewertet werden

### Beispiel: Dokument

Ein Dokument kann:

- erstellt werden
- freigegeben werden
- veröffentlicht werden
- archiviert werden
- versioniert werden

Neue Funktionen entstehen bevorzugt durch neue Fähigkeiten bestehender Objekte und nicht durch neue Tabellen oder eigenständige Module.

## Kontext

Objekte existieren niemals isoliert.

Jedes Objekt befindet sich in einem fachlichen Kontext, der bestimmt, welche Informationen, Funktionen und Beziehungen in diesem Moment relevant sind.

### Beispiele

Eine Veranstaltung befindet sich beispielsweise im Kontext:

- Planung
- Durchführung
- Nachbereitung

Ein Benutzer befindet sich im Kontext:

- Trainer
- Vorstand
- Helfer
- Sponsor
- Besucher

Ein Dokument befindet sich im Kontext:

- Entwurf
- Freigabe
- Veröffentlichung
- Archiv

Der aktuelle Kontext beeinflusst unter anderem:

- sichtbare Informationen
- verfügbare Funktionen
- Bearbeitungsrechte
- Automatisierungen
- Benachrichtigungen
- Vorschläge digitaler Mitarbeiter

Dadurch erhält jeder Benutzer genau die Informationen und Werkzeuge, die er in seiner aktuellen Situation benötigt.

## Ansichten

Alle Benutzer arbeiten auf denselben Daten.

Unterschiedlich sind lediglich die Ansichten auf diese Daten.

Eine Ansicht stellt genau die Informationen und Funktionen bereit, die für den aktuellen Benutzer und seinen Kontext relevant sind.

### Beispiele

#### Vorstand

- Veranstaltungsübersicht
- Budget
- Risiken
- Fortschritt
- Entscheidungen

#### Helfer

- persönliche Aufgaben
- Einsatzzeiten
- Ansprechpartner
- Checklisten

#### Sponsor

- Werbeleistungen
- Ansprechpartner
- Veranstaltungen
- Einladungen
- Partnerschaft

#### Trainer

- Mannschaft
- Turnierinformationen
- Treffpunkte
- Aufgaben

#### Digitaler Mitarbeiter

- offene Aufgaben
- Automatisierungen
- Dokumente
- Kommunikation
- Wissenseinträge

### Grundprinzip

Die Daten sind für alle identisch.

Nur die Sicht auf diese Daten verändert sich.

Dadurch entstehen einfache Benutzeroberflächen ohne unnötige Komplexität.

---

## Related Documents

- `vision.md`
- `../../core/core-object.md`
- `../../core/objects/event.md`
- `../../architecture/platform-architecture.md`

---

## Planned Documents

- `requirements.md`
- `interfaces.md`

---

## Future Development

Das Datenmodell wird kontinuierlich erweitert und bildet die Grundlage für alle zukünftigen Funktionen des Event Managers.

