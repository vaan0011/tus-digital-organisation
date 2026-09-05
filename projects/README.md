# TuS Projects

## Purpose

Der Ordner `projects/` enthält konkrete, zeitlich oder inhaltlich abgrenzbare Vorhaben der TuS Digital Organisation und des TuS Mingolsheim, soweit sie ein dauerhaftes gemeinsames Projektgedächtnis benötigen.

## Core Principle

Ein Projekt bekommt einen eigenen Arbeitsstand. Die Organisation bekommt zusätzlich einen gemeinsamen Überblick.

> **Detailwahrheit im Projekt. Portfolioübersicht zentral.**

## Main Content

### Zentrale Übersicht

Die organisationsweite Projektübersicht liegt in:

- `PROJECT-PORTFOLIO.md`

Sie enthält nur:

- Projekt / Vorhaben,
- Status,
- fachlichen Verantwortungsbereich,
- verbindliche Detailquelle,
- nächsten sinnvollen Schritt,
- wesentliche Abhängigkeiten.

### Formale Projektstruktur

Ein dauerhaft relevantes formales Projekt besitzt mindestens:

- `README.md` – Purpose, fachlicher Rahmen und dauerhafte Grundidee,
- `PROJECT-STATE.md` – aktueller operativer Projektzustand.

Weitere Dateien entstehen nur bei echtem Bedarf.

### Projektartefakte in Google Drive

GitHub bleibt die verbindliche Quelle für strukturierte Projektinformation, insbesondere:

- Projektstatus und nächster Schritt,
- fachliche Entscheidungen,
- Anforderungen und Scope,
- Architektur- und Entwicklungsdokumentation,
- nicht-vertrauliche Erkenntnisse aus Sponsoring und Fördermittelarbeit,
- Verweise auf externe Projektartefakte.

Große, binäre oder visuelle Projektartefakte werden nicht unnötig im Repository dupliziert. Der zentrale Google-Drive-Artefaktraum ist:

- `TuS Projekte`: https://drive.google.com/drive/folders/1AZwLimESPBMoBw5d6AZLHRvJzYpEFyGq

Dort werden insbesondere abgelegt:

- Fotos und Bildsammlungen,
- Scans und größere PDF-Dokumente,
- Planzeichnungen und Präsentationen,
- Angebote und umfangreiche Arbeitsdateien,
- große Tabellen und Datenexporte,
- Druck-, Design- und Produktionsdateien,
- sonstige große Projektdateien, die nicht sinnvoll in Git versioniert werden.

Wenn ein Projekt einen eigenen Drive-Unterordner oder eine wesentliche Drive-Datei besitzt, wird der entsprechende Link in der Projektakte bzw. im `PROJECT-STATE.md` referenziert. Andere Rollen sollen nicht anhand privater Chatverläufe nach Dateien suchen müssen.

Der `Partnership Manager`, der `Funding & Grants Manager`, der `Graphic Designer`, der `Archivist` und weitere beteiligte Rollen verwenden GitHub zur Einordnung des Projektstands und Google Drive für die dazugehörigen Artefakte.

Vertrauliche, personenbezogene, finanzielle oder vertragliche Dateien werden nur in einem dafür angemessen geschützten Drive-Bereich abgelegt und nicht allein wegen der Projektablage öffentlich oder breiter freigegeben.

### Kein Ordner für jede Idee

Nicht jedes Vorhaben braucht sofort einen Projektordner.

Ideen und noch nicht ausreichend geklärte Vorhaben können zunächst als `Kandidat` im zentralen Portfolio geführt werden.

Ein formales Projekt wird daraus, wenn Ziel, Bedeutung und Bedarf für einen eigenen dauerhaften Projektzustand ausreichend klar sind.

### Verantwortlichkeit

Der jeweilige Fachbereich bzw. die zuständige Rolle verantwortet den Inhalt des Projekts.

Der Project Portfolio Manager verantwortet nicht den fachlichen Scope, sondern die organisationsweite Sichtbarkeit, Konsistenz und Aktualität des Projektportfolios.

### Projektstatus

Portfolio-Statuswerte:

- `Kandidat`
- `Discovery`
- `Geplant`
- `Aktiv`
- `Blockiert`
- `Pausiert`
- `Abgeschlossen`
- `Verworfen`

Die Detailbegründung liegt im jeweiligen Projektzustand bzw. bei Kandidaten in der Portfolio-Notiz.

### Neue Projekte

Vor einem neuen Projektordner wird geprüft:

1. Gibt es bereits ein gleiches oder stark überlappendes Projekt?
2. Ist das Vorhaben mehr als eine einzelne Aufgabe?
3. Gibt es ein klares Ziel/Problem?
4. Ist ein fachlicher Verantwortungsbereich erkennbar?
5. Braucht das Vorhaben ein dauerhaftes Projektgedächtnis?

### Abschluss

Abgeschlossene Projekte bleiben nachvollziehbar.

Projektwissen, Entscheidungen und relevante Assets werden nicht gelöscht, nur weil die aktive Umsetzung beendet ist.

## Relationship to other documents

- `PROJECT-PORTFOLIO.md`
- `../roles/project-portfolio-manager/role.md`
- `../roles/project-portfolio-manager/portfolio-standard.md`
- `../standards/iteration-and-progress.md`
- `../decisions/ADR-0002-project-state-and-last-known-good.md`

## Future Development

Die Projektstruktur wird nicht zu einem schweren PM-System ausgebaut. Zusätzliche Felder oder Statusmechanismen werden nur ergänzt, wenn sie in realer Arbeit wiederholt Nutzen schaffen.