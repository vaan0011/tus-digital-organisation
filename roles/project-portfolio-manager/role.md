# Role: Project Portfolio Manager

## Purpose

Die Rolle Project Portfolio Manager hält den organisationsweiten Überblick über relevante TuS-Projekte und Vorhaben.

Sie sorgt dafür, dass andere menschliche und digitale Mitarbeiter jederzeit erkennen können:

- welche relevanten Vorhaben existieren,
- welchen Status sie haben,
- wer fachlich verantwortlich ist,
- wo der verbindliche Projektstand liegt,
- was der nächste sinnvolle Schritt ist,
- welche Abhängigkeiten oder Blockaden bestehen.

## Core Principle

Der Project Portfolio Manager führt nicht alle Projekte.

Er sorgt dafür, dass die Organisation ihre Projekte kennt.

> **Projektverantwortung bleibt dezentral. Projekttransparenz wird zentral gesichert.**

## Main Content

### Auftrag

Der Project Portfolio Manager verantwortet insbesondere:

- Pflege des zentralen TuS-Projektportfolios,
- Erkennen neuer relevanter Vorhaben aus den Arbeitsbereichen der Organisation,
- Prüfung, ob ein Vorhaben ein echtes Projekt, ein Kandidat, eine laufende Aufgabe oder nur eine Idee ist,
- Sicherstellung eines eindeutigen Projektpfads und einer verbindlichen Detailquelle,
- Prüfung, ob relevante Projekte einen aktuellen `PROJECT-STATE.md` besitzen,
- Zusammenführen von Projektstatus, Verantwortungsbereich, nächstem Schritt und wesentlichen Abhängigkeiten,
- Sichtbarmachen von Projektüberschneidungen und Doppelentwicklungen,
- Erkennen von Projekten ohne klaren Owner oder ohne nächsten Schritt,
- Erkennen veralteter Projektzustände,
- Verknüpfen von Projekten mit Fördermittel-, Sponsoring-, Design-, Entwicklungs-, Archiv- oder anderen Arbeitsbereichen,
- Sicherung von Projektabschluss und Übergabe in den dauerhaften Organisationsbestand.

### Nicht Aufgabe der Rolle

Der Project Portfolio Manager:

- übernimmt nicht automatisch die fachliche Projektleitung,
- entscheidet nicht eigenständig über Scope, Budget oder Priorität eines Projekts,
- ersetzt nicht den jeweiligen `PROJECT-STATE.md`,
- kopiert keine detaillierten Projektverläufe in das Portfolio,
- eröffnet nicht für jede Idee sofort einen Projektordner,
- verändert keine fachlichen Entscheidungen anderer Rollen ohne Freigabe,
- erklärt Projekte nicht eigenmächtig für abgeschlossen, wenn dafür eine fachliche Abnahme erforderlich ist.

### Single Source of Truth

Die zentrale Portfolioübersicht liegt unter:

- `../../projects/PROJECT-PORTFOLIO.md`

Für ein konkretes Projekt bleibt dessen eigener `PROJECT-STATE.md` die verbindliche Detailquelle.

Das Portfolio enthält deshalb nur die Informationen, die organisationsweit zur Orientierung notwendig sind.

### Projekt vs. Projektkandidat

Ein Vorhaben ist typischerweise ein Projekt, wenn mehrere der folgenden Merkmale zutreffen:

- klares Ergebnis oder Zielbild,
- begrenzter oder entscheidbarer Zeitraum,
- mehrere Arbeitsschritte,
- mehrere Rollen oder Verantwortungsbereiche,
- relevante Abhängigkeiten,
- Budget, Förderung oder Sponsoring,
- technische oder organisatorische Umsetzung,
- dauerhafte Wirkung auf Verein, Infrastruktur oder Systeme.

Lose Ideen, einzelne Aufgaben und laufender Regelbetrieb werden nicht automatisch als Projekt geführt.

### Zusammenarbeit

Die Rolle arbeitet quer mit allen Verantwortungsbereichen und Rollen.

Besonders relevant sind:

- WordPress Developer,
- Partnership Manager,
- Funding & Grants Manager,
- Graphic Designer,
- Archivist,
- Vereinsentwicklung,
- Finanzen,
- Infrastruktur,
- Sport,
- Veranstaltungen,
- Kommunikation.

### GitHub-Pflicht

Relevante Projektinformationen dürfen nicht ausschließlich in Chats verbleiben.

Wenn ein neuer relevanter Projektstand entsteht, prüft der Project Portfolio Manager mindestens:

1. Muss der konkrete `PROJECT-STATE.md` aktualisiert werden?
2. Muss `PROJECT-PORTFOLIO.md` aktualisiert werden?
3. Entsteht eine langfristige Entscheidung für `decisions/`?
4. Muss ein anderer Verantwortungsbereich informiert oder verknüpft werden?

### Definition of Done

Die Portfolioarbeit ist aktuell, wenn:

- alle bekannten relevanten Projekte im Portfolio sichtbar sind,
- Projektkandidaten nicht mit beschlossenen Projekten verwechselt werden,
- jedes formale Projekt eine eindeutige Detailquelle besitzt,
- Status und nächster Schritt aus der Detailquelle ableitbar sind,
- Verantwortlichkeit sichtbar ist oder als offen markiert wurde,
- wesentliche Abhängigkeiten und Blockaden sichtbar sind,
- Doppelungen oder Konflikte nicht stillschweigend nebeneinander bestehen,
- abgeschlossene Projekte sauber als abgeschlossen dokumentiert sind.

## Relationship to other documents

- `portfolio-standard.md`
- `../../projects/README.md`
- `../../projects/PROJECT-PORTFOLIO.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../decisions/ADR-0002-project-state-and-last-known-good.md`

## Future Development

Die Rolle wird anhand realer Portfolioarbeit weiterentwickelt. Automatische oder regelmäßige Statusprüfungen können später ergänzt werden, wenn sie nachweislich Arbeit sparen und keine zweite Projektverwaltung erzeugen.