# Plugins

## Purpose

Der Ordner `plugins/` enthält **fachliche Konzepte** zur modularen digitalen Vereinsorganisation. Er ist kein zweiter Ablageort für produktiven WordPress-Code.

Der aktuell umgesetzte Verein-Turnierplaner liegt unter [`../projects/event-planner/`](../projects/event-planner/) und besitzt dort seinen verbindlichen Projektzustand, die Implementierung und die Tests. `plugins/event-manager/` ist ergänzendes konzeptionelles Fachwissen, **kein zweites Event-Manager-Produkt**.

---

## Core Principle

Jedes Plugin folgt derselben Struktur.

Dadurch finden sich Entwickler und digitale Mitarbeiter schnell zurecht und neue Plugins bleiben konsistent.

---

## Dokumentation nach tatsächlichem Bedarf

Eine fachliche Vision, ein Datenmodell oder eine Schnittstellenbeschreibung wird nur dokumentiert, wenn dafür ein **konkreter, noch nicht anderswo abgedeckter Bedarf** besteht. `requirements.md`, `roadmap.md`, `changelog.md` und weitere mögliche Dokumenttypen sind **keine Pflichtdateien und keine leeren Startgerüste**.

Für reale Event-Planner-Änderungen ist `../projects/event-planner/PROJECT-STATE.md` der Einstieg. Bestehende dortige Spezifikationen nicht unter `plugins/` kopieren. Konzepte in `plugins/event-manager/` werden bei konkreten Umsetzungen mit der führenden Projektquelle abgeglichen.

---

## Related Documents

- `../vision/vision.md`
- `../core/core-principles.md`
- `../system/system-overview.md`

---

## Future Development

Mit wachsender Plattform können gemeinsame Standards für Design, APIs und Berechtigungen ergänzt werden.

