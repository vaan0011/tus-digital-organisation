# Historienarchiv – Current State

Stand: 2026-09-10

## Purpose

Dieses Dokument ist der kompakte Einstiegspunkt für einen neuen Archivist-Chat.

Es beschreibt nicht den vollständigen historischen Wissensbestand und ersetzt nicht den live geführten Quellenindex. Es verhindert, dass ein neuer Chat mit einem veralteten Übergabedokument oder einem alten Gesprächsstand beginnt.

## Core Principle

> **Der aktuelle Quellenindex schlägt einen alten Chat-Checkpoint.**

Der operative Zustand wird bei jedem Start aus den aktuellen Drive-Registern gelesen.

## Main Content

### 1. Source of Truth

Operative Source of Truth ist das Google Sheet:

**`TuS Historie – Quellenindex`**

Der Tab `Quellen` enthält Arbeitsqueue und Quellenstatus. Die weiteren Tabs enthalten die strukturierte Faktenbasis, insbesondere:

- `Ereignisse`
- `Personen`
- `Orte`
- `Fundstücke`
- `Unsicherheiten`
- `Sportler-Erfolge`
- `Spieleinsätze`
- `Reisen-Ausflüge`
- `Regeln-Rivalitäten`
- `Gegner-Historie`
- `Mitgliedschaften`
- `Mitgliederbuch-ML01`
- `Saison-Einsatzlisten`

Originalquellen und Erschließungsdokumente liegen im Google-Drive-Arbeitsarchiv.

### 2. Alte Chat-Übergabe ist nur noch historischer Snapshot

Das Drive-Dokument **`TuS Historie – Übergabe neuer Chat`** mit Stand 02.09.2026 enthält weiterhin nützliche fachliche Erkenntnisse und offene Forschungsfragen.

Es ist jedoch **nicht mehr der verbindliche operative Fortsetzungspunkt**.

Der dort genannte Einstieg `SP-02` ist überholt. Seitdem wurde die Sportchronik deutlich weiter erschlossen.

Bei Konflikten zum aktuellen Arbeitsstand gilt:

1. aktueller Quellenindex und aktuelle Arbeitsprodukte,
2. aktuelle GitHub-Runtime und Archivstandards,
3. erst danach ältere Übergabe- oder Chatstände.

### 3. Verifizierter Fortschritt der Sportchroniken

Zum Stand 10.09.2026 ist im Quellenindex dokumentiert:

- `SP-02` – Saisonblöcke 1969/70 und 1971/72 detailliert erschlossen; Status `ERSCHLOSSEN MIT OFFENEN PRÜFSTELLEN`.
- `SP-03` – 1972/73 und 1973/74 detailliert erschlossen; 40 Spielerwerte der Saisonmatrix gegen Einzelbögen reconciliert; Status `ERSCHLOSSEN MIT OFFENEN PRÜFSTELLEN`.
- `SP-04` – Saisonfragment 1974/75 bis Quellenende erschlossen; keine vollständige Saisonstatistik ableiten; definierte Prüfstellen bleiben offen.

Ein neuer Chat darf deshalb nicht wieder bei SP-02 beginnen.

### 4. Sichtbare Runtime-Migrationsschuld

Bei der Prüfung des Quellenindex am 10.09.2026 wurden mehrere ältere Quellen mit Status `IN BEARBEITUNG` gefunden, deren Felder `Checkpoint` und `Nächste Aktion` noch leer sind, unter anderem:

- `PB-06`
- `PB-08`
- `BR-01`
- `ML-01`
- `SP-01`

Diese Einträge stammen aus einer Arbeitsphase vor vollständiger Einführung der Archivist-Runtime.

Sie dürfen nicht automatisch als tatsächlich aktivster Arbeitsstand interpretiert werden.

### 5. Erste Aufgabe des neuen Archivist-Chats

Vor neuer Quellenarbeit führt der neue Chat einmalig einen **Runtime-Reconciliation-Pass** durch:

1. Live-Quellenindex lesen.
2. Quellen mit `IN BEARBEITUNG` und leerem Checkpoint identifizieren.
3. Für diese Quellen vorhandene Erschließungsdokumente und relevante aktuelle Registerstände prüfen.
4. Den letzten belastbaren Stand bestimmen.
5. `Checkpoint`, `Nächste Aktion`, `Arbeitsprodukt` und gegebenenfalls Status im Quellenindex ergänzen bzw. korrigieren.
6. Danach anhand der Runtime-Regeln die tatsächlich nächste zulässige Arbeit auswählen und fortsetzen.

Dabei wird keine bereits belastbar erledigte Detailerschließung nur zur Rekonstruktion des Chats wiederholt.

### 6. Inhaltliche Langfristziele

Nach bzw. parallel zur Bestandserschließung werden insbesondere verfolgt:

- belastbare Spieler-, Einsatz- und Erfolgsstatistiken,
- Personenbiografien und Rollenwechsel über Jahrzehnte,
- Gegner-Historien,
- Reisen und Ausflüge,
- Strafen, Regeln und Rivalitäten,
- besondere Anekdoten und Wendepunkte,
- Vereinsrituale, Lied und Schlachtruf,
- historische Datenlücken und Widersprüche,
- publikationsfähige Funde für Homepage, Magazin, Spieltagsheft und Chronik.

Rankings werden nur als **dokumentierte Werte in den erhaltenen Quellen** formuliert, solange die Überlieferung nicht vollständig ist.

### 7. Write-back

Der neue Chat schreibt dauerhaften Fortschritt nicht in diesen Current State hinein, wenn der Quellenindex bereits die bessere operative Source of Truth ist.

Dieses Dokument wird nur aktualisiert, wenn sich der Einstieg, die Source-of-Truth-Logik, zentrale bekannte Migrationsschuld oder eine organisationsweit relevante Archivlage wesentlich ändert.

## Relationship to other documents

- `README.md`
- `../../roles/archivist/START-PROMPT.md`
- `../../roles/archivist/role.md`
- `../../roles/archivist/runtime.md`
- `../../roles/archivist/archive-standard.md`
- `../../architecture/memory-router.md`
- `../SECOND-BRAIN-STANDARD.md`

## Future Development

Sobald die alten `IN BEARBEITUNG`-Einträge vollständig auf Runtime-Checkpoints migriert sind, wird die Migrationsschuld aus diesem Dokument entfernt. Danach soll ein neuer Chat allein über Bootstrap, Runtime und Live-Quellenindex ohne spezielle Übergabedokumente arbeitsfähig sein.