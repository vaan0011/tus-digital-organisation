# TuS Spielerbarometer

## Purpose

Das **TuS Spielerbarometer** ist die wiederkehrende, freiwillige Zufriedenheitsbefragung der Spieler der 1. und 2. Herrenmannschaft. Es macht die Entwicklung des Vereins aus Spielersicht sichtbar und ermöglicht konkrete, überprüfbare Verbesserungen.

## Core Principle

**Rückmeldungen dienen der Vereinsentwicklung, nicht der öffentlichen Bewertung oder Bloßstellung einzelner Personen.**

Die Antworten bleiben geschützt. Nur der Antwortlink des Google-Forms-Fragebogens wird an die Zielgruppe verteilt.

## Main Content

- **Turnus:** halbjährlich – Hinrunde (November/Dezember) und Saisonende (Mai/Juni).
- **Start:** Welle `2026-H2` (November/Dezember 2026).
- **Vergleichbarkeit:** 24 feste Fragen Q01–Q24 mit Skala 1–5 plus `Kann ich nicht beurteilen`, unveränderte IDs und Aussagen in Folgewellen.
- **Zusatzfragen:** freiwillige Freitexte F01–F05, freiwillige Mannschaftsangabe sowie Priorisierung von maximal zwei Verbesserungsfeldern.
- **Bereiche:** allgemeine Zufriedenheit, Anlage und Ausstattung, Training und Entwicklung, Mannschaft/Miteinander, Kommunikation und Vereinsführung.
- **Sportliche Betreuung:** Trainingsqualität, Förderung, faire Entscheidungen, Gesprächskultur, Wertschätzung und Vertrauen werden als Aspekte der Gesamterfahrung erfragt; keine verdeckte individuelle Personalauswertung.
- **Feedbackschleife:** Auswertung → höchstens drei priorisierte Maßnahmen mit Verantwortlichen/Termin → Prüfung der Wirksamkeit in der folgenden Welle.
- **Datenschutz:** keine Namen oder E-Mails erheben; die Kombination aus Zeitstempel, Mannschaft und Freitext kann dennoch Rückschlüsse auf Personen zulassen. Nur aggregierte Berichte, keine identifizierbaren Zitate, keine kleinzahlige Teamauswertung (Richtwert unter sieben Antworten keine Veröffentlichung).

### Architektur & Ablage

- **Google Forms:** Antwortoberfläche für Spieler; öffentlich erreichbarer Responder-Link, sofern die Kontoeinstellungen dies erlauben.
- **Google Sheets:** private Datenbasis mit `FRAGENKATALOG`, `WELLEN`, `ANTWORTEN_IMPORT`, `AUSWERTUNG`, `MASSNAHMEN` und `DATENSCHUTZ`.
- **Google Drive:** `TuS Projekte / TuS Spielerbarometer / 01 Fragebogen und Kommunikation`, `02 Datenbasis – vertraulich`, `03 Auswertungen und Maßnahmen`.
- **GitHub:** fachliches Konzept, Regeln, Prozess und datensatzfreie Automatisierungslogik; **niemals** individuelle Antworten, private Tabellen-IDs, Teilnehmerkommentare oder sensitive Details ablegen.
- **Apps Script:** `FORMULAR-SETUP.gs` ist eine bei berechtigtem Google-Konto auszuführende Einrichtungshilfe; wird **nicht** durch einen GitHub-Merge automatisch ausgeführt.

Die fachliche Wahrheit des aktuellen Umfragekatalogs und die vertraulichen Ergebnisse liegen ausschließlich in den geschützten Google-Workspace-Dateien. Kein neues Personen-/Mannschaftsstammdatensystem aufbauen; die optionale Mannschaftsangabe ist ausschließlich ein Gruppierungsmerkmal.

## Relationship to other documents

- `PROJECT-STATE.md` – aktueller Stand und nächste Schritte
- `FORMULAR-SETUP.gs` – erzeugt neue Google-Forms-Wellen aus dem privaten Sheet
- `BESTEHENDES-FORMULAR-BEFUELLEN.gs` – befüllt ein bereits manuell angelegtes, leeres Google Form direkt über dessen Apps Script; erstellt kein Duplikat
- `../team-manager/README.md` – Mannschaftsmodell, ohne personenbezogene Kopplung
- `../PROJECT-PORTFOLIO.md` – Gesamtportfolio
- `../../standards/learning-loop.md` – Maßnahmen und Lernen

## Future Development

Erst nach einer vollständigen Pilotwelle den Fragebogen auf Aufwand und Verständlichkeit prüfen. Versionierte Erweiterungen nur zusätzlich; Änderungen am konstanten Kern müssen dokumentiert werden, um keine Scheingenauigkeit in Zeitvergleichen zu erzeugen.
