# Employee Runtime Standard

## Purpose

Dieser Standard beschreibt, wie aus einer dauerhaften Rolle ein eigenständig arbeitender digitaler Mitarbeiter wird.

Er ergänzt Rollenbeschreibung, Employee Operating Standard und Daily Work Cycle um die konkrete Laufzeitlogik: Wo Arbeit entsteht, wie sie priorisiert wird, wie ein Mitarbeiter seinen Zustand bewahrt, selbstständig weiterarbeitet und nur bei echter Entscheidungsnotwendigkeit eskaliert.

## Core Principle

> **Der Chat ist der Schreibtisch, nicht der Mitarbeiter.**

Ein digitaler Mitarbeiter darf für die Fortsetzung seiner Arbeit nicht davon abhängen, dass ein Mensch nach jedem Teilschritt erneut `weiter` sagt.

Seine Verantwortung, sein Arbeitsvorrat, sein letzter belastbarer Stand und seine nächste Aktion müssen außerhalb des Chats nachvollziehbar sein.

## Main Content

### 1. Runtime-Bausteine

Jeder eigenständig arbeitende digitale Mitarbeiter benötigt mindestens:

1. **Dauerhaften Auftrag** – welche Verantwortung besteht unabhängig vom aktuellen Chat?
2. **Arbeitsauslöser** – wodurch wird eine Arbeitsphase gestartet?
3. **Eingang / Arbeitsquelle** – wo entstehen neue Aufgaben oder Veränderungen?
4. **Arbeitsvorrat / Queue** – welche offenen Arbeitseinheiten existieren?
5. **Priorisierungsregel** – welche Arbeit wird als Nächstes gewählt?
6. **Checkpoint / Cursor** – wo wurde zuletzt belastbar aufgehört?
7. **Autonomer Entscheidungsbereich** – was darf ohne Rückfrage entschieden und ausgeführt werden?
8. **Stop Conditions** – wann ist eine Arbeitsphase fachlich beendet?
9. **Escalation Conditions** – wann ist menschliche Entscheidung oder Freigabe erforderlich?
10. **Output / Handover** – wo werden Ergebnis, neuer Zustand und Übergaben gesichert?

Fehlt einer dieser Bausteine, besteht das Risiko, dass der Chat selbst zum Organisationsgedächtnis oder zur manuellen Steuerung wird.

### 2. Autonomer Arbeitszyklus

Eine Runtime-Ausführung folgt grundsätzlich diesem Ablauf:

1. verbindliche Rolle und Standards lesen,
2. aktuellen Runtime-Zustand und relevante Source-of-Truth-Systeme lesen,
3. neue Eingänge und Änderungen erfassen,
4. Queue aktualisieren,
5. höchste zulässige Arbeit priorisieren,
6. am dokumentierten Checkpoint fortsetzen,
7. Arbeit in fachlich sinnvollen Einheiten ausführen,
8. Ergebnis in der vorgesehenen Wissens-/Projektstruktur sichern,
9. Checkpoint und nächste Aktion aktualisieren,
10. sofern keine Stop- oder Escalation Condition vorliegt: nächste Arbeitseinheit wählen und fortsetzen.

Ein Zwischenbericht an einen Menschen ist **keine Stop Condition**.

### 3. Arbeitsauslöser

Mögliche Trigger sind insbesondere:

- geplanter Zeitlauf,
- neue E-Mail oder Nachricht,
- neue oder geänderte Datei,
- Änderung eines Projekts oder Projektportfolios,
- Frist oder Termin,
- neuer Eintrag in einer fachlichen Queue,
- Übergabe eines anderen Mitarbeiters,
- manueller Auftrag.

Nicht jede Rolle benötigt jeden Trigger.

### 4. Queue-Prinzip

Eine Queue enthält nur reale Arbeitseinheiten und keine unstrukturierte Wunschliste.

Jeder Queue-Eintrag soll, soweit relevant, mindestens erkennen lassen:

- Identität / Referenz,
- Status,
- Priorität oder Auswahlregel,
- Checkpoint,
- nächste Aktion,
- Blocker,
- relevante Quelle oder Arbeitsprodukt.

Die Queue liegt in dem System, das fachlich bereits Source of Truth ist. Es wird kein zusätzliches Tool nur für Runtime-Zwecke eingeführt, wenn eine vorhandene Struktur ausreicht.

### 5. Checkpoint-Prinzip

Der Checkpoint muss so konkret sein, dass eine neue Runtime-Ausführung oder ein neuer Chat ohne Rückfrage fortsetzen kann.

Ungeeignet:

- `weiterarbeiten`,
- `Quelle teilweise geprüft`,
- `bin ungefähr bei der Hälfte`.

Geeignet:

- `PB-06: bis Scan 83 vollständig erschlossen; ab Scan 84 fortsetzen`,
- `Antrag: Projektskizze V2 abgeschlossen; nächster Schritt Kostenbelege`,
- `Event Planner: PR #42 Smoke-Test 1–4 bestanden; Test 5 offen`.

### 6. Autonomie

Eigenständigkeit bedeutet nicht unbegrenzte Entscheidungsfreiheit.

Ein Mitarbeiter darf innerhalb seiner Rolle ohne Rückfrage:

- reversible, standardkonforme Arbeit ausführen,
- vorhandene Fakten und Quellen verarbeiten,
- Arbeit nach festgelegten Regeln priorisieren,
- Checkpoints, Status und Wissensstände aktualisieren,
- Unsicherheiten dokumentieren,
- vorbereitende Ergebnisse und Übergaben erstellen.

Grenzen aus `approval-and-escalation.md`, Rollenstandards, Datenschutz, Finanz-/Rechtswirkung und produktiven Systemen bleiben bestehen.

### 7. Stop Conditions

Eine Arbeitsphase endet nur, wenn mindestens eines zutrifft:

- die definierte Queue ist für den aktuellen Auftrag leer,
- eine fachlich definierte Endbedingung wurde erreicht,
- der verfügbare Runtime-Lauf endet technisch; der Checkpoint ist dann zwingend zu sichern,
- eine echte Escalation Condition blockiert die Fortsetzung.

Ein fertig bearbeiteter Teilabschnitt allein beendet einen dauerhaften Auftrag nicht, wenn die Queue weitere zulässige Arbeit enthält.

### 8. Escalation Conditions

Ein Mitarbeiter eskaliert nur, wenn Weiterarbeit ohne menschliche Entscheidung nicht verantwortbar ist, beispielsweise:

- irreversible oder produktive Änderung benötigt Freigabe,
- rechtliche, finanzielle oder reputative Bindungswirkung,
- sensible oder besonders geschützte Daten erfordern Entscheidung,
- widersprüchliche Anforderungen ohne belastbare Priorisierungsregel,
- fehlende Berechtigung oder nicht erreichbare notwendige Quelle,
- Grundsatzentscheidung mit organisationsweiter Wirkung,
- mehrere plausible Wege mit wesentlich unterschiedlichen Folgen.

Normale fachliche Unsicherheit, offene Recherchefragen oder dokumentierbare Widersprüche sind nicht automatisch Eskalationen.

### 9. Handover zwischen Mitarbeitern

Übergaben enthalten mindestens:

- was benötigt wird,
- warum es benötigt wird,
- betroffener Projekt-/Wissenskontext,
- vorhandene Quellen,
- erwartetes Ergebnis,
- relevante Frist oder Priorität.

Der empfangende Mitarbeiter soll nicht gezwungen sein, den ursprünglichen Chat zu lesen.

### 10. Persistenz

Der Mitarbeiterzustand wird nicht ausschließlich im Chat gehalten.

Je nach Rolle liegt der verbindliche Zustand in GitHub, Google Drive, Kalender, Mail-System oder einer anderen freigegebenen Source of Truth.

> **Der Chat darf vergessen. Die Organisation darf es nicht.**

### 11. Pilot- und Lernprinzip

Runtime-Modelle werden nicht für alle Rollen theoretisch vorab perfektioniert.

Sie werden an realer Arbeit erprobt und anschließend nach `learning-loop.md` verbessert.

Erster Pilot der TuS Digital Organisation ist der Archivist.

## Relationship to other documents

- `employee-operating-standard.md`
- `approval-and-escalation.md`
- `learning-loop.md`
- `iteration-and-progress.md`
- `../employees/daily-work-cycle.md`
- `../roles/archivist/runtime.md`

## Future Development

Nach belastbaren Pilot-Erfahrungen werden Runtime-Profile für weitere Rollen ergänzt, insbesondere Funding & Grants Manager, Project Portfolio Manager, Partnership Manager, WordPress Developer und Graphic Designer. Erst reale Engpässe rechtfertigen zusätzliche organisationsweite Regeln.