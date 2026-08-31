# Plattformarchitektur

## Purpose

Dieses Dokument beschreibt die grundlegende Architektur der TuS Digital Organisation.

Es erklärt, wie Vision, Core, Plugins, digitale Mitarbeiter, Prozesse und Benutzeroberflächen zusammenspielen.

---

## Core Principle

Wir modellieren den Verein – nicht die Software.

Zentrale Objekte werden einmal im Core definiert und von allen Plugins gemeinsam genutzt.

Plugins bilden fachliche Arbeitsbereiche, erzeugen jedoch keine isolierten Datenwelten.

---

## Main Content

### 1. Vision

Die Vision beschreibt, warum die digitale Organisation existiert und nach welchen Prinzipien sie entwickelt wird.

Sie bildet den Rahmen für alle Architektur- und Entwicklungsentscheidungen.

---

### 2. Architektur

Der Bereich `architecture` dokumentiert organisationsweite technische und fachliche Grundsätze.

Dazu gehören insbesondere:

- Domänenmodell
- ereignisgesteuerte Architektur
- Workspaces
- Datenflüsse
- Schnittstellen
- Sicherheit
- Berechtigungen

---

### 3. Core

Der Core enthält alle zentralen, pluginübergreifenden Bausteine.

Dazu gehören:

- Objekte
- Beziehungen
- Ereignisse
- Rollen
- Berechtigungen
- Workspaces

Beispiele für Core-Objekte:

- Person
- Aufgabe
- Rolle
- Dokument
- Bild
- Ressource
- Standort

Ein Core-Objekt wird nur einmal definiert und anschließend von allen Plugins verwendet.

---

### 4. Plugins

Plugins bilden fachliche Arbeitsbereiche der digitalen Organisation.

Beispiele:

- Event Manager
- Sponsor Manager
- Team Manager
- Content Hub
- Chronik
- Bildarchiv

Plugins nutzen Core-Objekte, ergänzen sie um fachliche Fähigkeiten und stellen passende Ansichten bereit.

---

### 5. Beziehungen

Objekte werden nicht mehrfach gespeichert, sondern über fachlich bedeutungsvolle Beziehungen miteinander verbunden.

Beziehungen können eigene Eigenschaften, Verantwortlichkeiten, Dokumente, Ereignisse und Historien besitzen.

Grundsatz:

> Objekte enthalten Informationen. Beziehungen enthalten Bedeutung.

---

### 6. Ereignisse

Fachliche Ereignisse lösen Prozesse und Automatisierungen aus.

Beispiele:

- Veranstaltung veröffentlicht
- Aufgabe abgeschlossen
- Ticket verkauft
- Sponsor zugesagt
- Dokument freigegeben

Plugins kommunizieren bevorzugt über Ereignisse und bleiben dadurch modular und austauschbar.

---

### 7. Kontext und Ansichten

Alle Benutzer arbeiten mit denselben Daten.

Der aktuelle Kontext bestimmt jedoch:

- sichtbare Informationen
- verfügbare Fähigkeiten
- Bearbeitungsrechte
- Automatisierungen
- Benachrichtigungen

Jeder Benutzer sieht nur das, was für seine aktuelle Aufgabe relevant ist.

---

### 8. Workspaces

Arbeit findet in fachlichen Arbeitsbereichen statt.

Beispiele:

- Sportfest 2027
- Winterfeier
- Kunstrasenprojekt
- B-Jugend
- Sponsorenpartnerschaft

Ein Workspace führt alle relevanten Objekte, Aufgaben, Dokumente, Kommunikation und digitalen Mitarbeiter in einem gemeinsamen Kontext zusammen.

---

### 9. Digitale Mitarbeiter

Digitale Mitarbeiter übernehmen dauerhafte Rollen innerhalb der Organisation.

Sie nutzen dieselben Daten, Beziehungen, Ereignisse und Workspaces wie menschliche Mitarbeiter.

Ihre Rechte ergeben sich aus Rolle, Verantwortung und Kontext.

---

### 10. Benutzeroberflächen

Benutzeroberflächen sind unterschiedliche Ansichten auf dieselben Domänenobjekte.

Mögliche Oberflächen sind:

- WordPress-Backend
- Vereinswebsite
- mobile Anwendung
- Helferportal
- Sponsorportal
- digitale Geschäftsstelle

Die Oberfläche bestimmt nicht das Datenmodell.

---

## Related Documents

- `../vision/vision.md`
- `knowledge-graph.md`
- `object-lifecycle.md`
- `stability-and-simplicity.md`
- `../core/core-principles.md`
- `../system/system-overview.md`

---

## Future Development

Dieses Dokument wird erweitert, sobald konkrete Entscheidungen zu APIs, Datenspeicherung, Automatisierungen, Sicherheit und technischen Plattformen getroffen wurden.