# Ereignis

## Purpose

Ein Ereignis beschreibt eine fachlich relevante Veränderung innerhalb der TuS Digital Organisation.

Es dient als Auslöser für Prozesse, Automatisierungen und Benachrichtigungen.

---

## Core Principle

Objekte kommunizieren nicht direkt miteinander.

Sie erzeugen Ereignisse.

Andere Objekte oder Plugins können auf diese Ereignisse reagieren.

Dadurch bleibt die Architektur lose gekoppelt und beliebig erweiterbar.

---

## Main Content

### Beschreibung

Ein Ereignis entsteht immer dann, wenn sich der Zustand eines Objekts fachlich verändert.

Beispiele:

- Veranstaltung veröffentlicht
- Aufgabe abgeschlossen
- Dokument freigegeben
- Sponsor zugesagt
- Ticket verkauft
- Person registriert

---

### Stammdaten

Ein Ereignis besitzt unter anderem:

- Typ
- Quelle
- Zeitpunkt
- Auslöser
- Beschreibung
- Status

---

### Fähigkeiten

Ein Ereignis kann:

- Prozesse starten
- Benachrichtigungen auslösen
- Workflows starten
- digitale Mitarbeiter informieren
- protokolliert werden

---

### Beziehungen

Ein Ereignis kann verbunden sein mit:

- Personen
- Rollen
- Aufgaben
- Veranstaltungen
- Dokumenten
- Workspaces
- Wissenseinträgen

---

### Verantwortlichkeit

Jedes Ereignis besitzt einen Auslöser.

Zusätzlich können weitere beteiligte Objekte referenziert werden.

---

### Ansichten

Ereignisse können dargestellt werden als:

- Aktivitätsfeed
- Timeline
- Historie
- Audit-Log
- Benachrichtigungen

---

## Relationship to other documents

- beziehung.md
- workspace.md
- aufgabe.md
- ../../architektur/platform-architecture.md

---

## Future Development

Ereignisse bilden langfristig die Grundlage für Automatisierungen, n8n-Workflows, digitale Mitarbeiter und KI-gestützte Empfehlungen.