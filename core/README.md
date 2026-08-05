# Core

## Purpose

Der Core enthält alle zentralen Domänenobjekte und Architekturbausteine der TuS Digital Organisation.

Diese Komponenten werden pluginübergreifend verwendet und bilden das fachliche Fundament der gesamten Plattform.

---

## Core Principle

Jedes Objekt wird genau einmal definiert.

Plugins erweitern diese Objekte um fachliche Funktionen, erzeugen jedoch keine eigenen Kopien.

---

## Main Content

Der Core enthält unter anderem:

- Objekte
- Beziehungen
- Ereignisse
- Rollen
- Berechtigungen
- Workspaces

Alle Plugins greifen auf diese gemeinsamen Bausteine zu.

---

## Relationship to other documents

- `core-object.md`
- `core-principles.md`
- `../architecture/platform-architecture.md`
- `../vision/vision.md`

---

## Future Development

Der Core wächst gemeinsam mit der digitalen Organisation.

Neue Objekte werden nur aufgenommen, wenn sie pluginübergreifend benötigt werden.

