# Role Bootstrap Standard

## Purpose

Dieser Standard definiert, wie ein Rollen-Chat der TuS Digital Organisation gestartet wird, ohne dass fachliches Wissen, Entscheidungen oder Arbeitsstände im Startprompt dupliziert werden.

Der Startprompt dient als Zündschlüssel. Die eigentliche organisatorische Wahrheit liegt in den verbindlichen GitHub- und fachlichen Sources of Truth.

## Core Principle

> **Ein neuer Chat beginnt nicht bei null. Er bootet in den aktuellen Stand der Organisation.**

Startprompts bleiben bewusst kurz. Sie erklären vor allem, welche Quellen zu laden sind, wie der Memory Router angewendet wird und wie relevante Ergebnisse zurückgeschrieben werden.

## Main Content

### 1. Verbindlicher Bootstrap-Ablauf

Vor wesentlicher Arbeit führt ein Rollen-Chat grundsätzlich folgende Schritte aus:

1. eigene Rollenbeschreibung lesen,
2. `architecture/memory-router.md` anwenden,
3. relevanten `CURRENT-STATE` bzw. `PROJECT-STATE` lesen,
4. betroffene ADRs und Standards prüfen,
5. relevante Lessons Learned und verworfene Ansätze berücksichtigen,
6. nur die für die konkrete Aufgabe benötigten Skills und Fachquellen laden,
7. bei vorhandener Runtime am dokumentierten Queue-/Checkpoint-Zustand fortsetzen.

### 2. Keine Wissensduplikation im Startprompt

Ein Startprompt soll keine umfangreichen Kopien von:

- Brand-Regeln,
- Projektständen,
- fachlichen Wissensbeständen,
- ADR-Inhalten,
- Produktionsdaten,
- Runtime-Details

enthalten, wenn diese bereits an einer kanonischen Stelle gepflegt werden.

Stattdessen verweist er auf die zuständigen Quellen.

### 3. Anti-Loop-Verhalten

Nach dem Bootstrap gilt:

- bereits entschiedene Fragen werden nicht ohne Reopen-Grund neu diskutiert,
- verworfene Ansätze werden nicht als neue Idee präsentiert,
- bestehende Arbeit wird nicht unnötig neu aufgebaut,
- fehlende Informationen werden nicht erfunden,
- fachlich zuständige Sources of Truth haben Vorrang vor Chat-Erinnerung.

### 4. Arbeitsverhalten

Wenn Ziel, Scope und Entscheidungsraum aus Rolle, Standards und Current State ausreichend klar sind, arbeitet die Rolle selbstständig weiter.

Eine Rückfrage ist nur erforderlich, wenn eine echte Eskalations- oder Freigabebedingung vorliegt oder eine notwendige Information nicht aus den verfügbaren Quellen ermittelt werden kann.

### 5. Write-back

Nach relevanter Arbeit wird geprüft, ob sich dauerhaft etwas geändert hat.

Je nach Fall werden aktualisiert:

- `CURRENT-STATE` oder `PROJECT-STATE`,
- ADR,
- fachliches Register,
- Lesson Learned / Rejected-Information,
- Runtime-Checkpoint,
- operative Source of Truth.

Der Chat selbst ist kein dauerhafter Speicher.

### 6. Aufbau einer rollenbezogenen `START-PROMPT.md`

Eine Rollen-Startanweisung enthält nur:

1. Rollenidentität,
2. Verweis auf diesen Bootstrap-Standard,
3. Verweis auf die Rollenbeschreibung,
4. Verweis auf den Memory Router,
5. wichtigste rollenbezogene Current-State-/Runtime-Einstiegspunkte,
6. wenige wirklich rollenspezifische Sonderregeln,
7. Write-back- und Eskalationshinweis.

### 7. Verwendung

Beim Start eines neuen Rollen-Chats wird der Inhalt der jeweiligen `START-PROMPT.md` verwendet.

Die Datei ist kein Ersatz für die Rollenbeschreibung und keine zweite Source of Truth. Sie ist der stabile Einstiegspunkt in das TuS-OS.

## Relationship to other documents

- `../architecture/memory-router.md`
- `../knowledge/SECOND-BRAIN-STANDARD.md`
- `employee-operating-standard.md`
- `employee-runtime-standard.md`
- `approval-and-escalation.md`
- `learning-loop.md`
- `../roles/`

## Future Development

Dieser Standard wird anhand der realen Nutzung weiterer Rollen erweitert. Ziel ist ein einheitlicher Bootstrap für alle TuS-Rollen mit möglichst wenig prompt-spezifischer Duplikation.