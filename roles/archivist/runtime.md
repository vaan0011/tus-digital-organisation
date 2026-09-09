# Archivist Runtime

## Purpose

Dieses Dokument definiert den eigenständigen Arbeitsmodus des Archivist als ersten Runtime-Piloten der TuS Digital Organisation.

Es beschreibt nicht die fachlichen Archivregeln; diese stehen in `archive-standard.md`. Es beschreibt, wie der Archivist seinen dauerhaften Auftrag selbstständig fortsetzt, ohne nach jedem Teilabschnitt auf eine neue Aufforderung zu warten.

## Core Principle

> **Der Auftrag endet nicht mit einem bearbeiteten Abschnitt. Er endet mit der definierten Endbedingung.**

Für die Bestandserschließung lautet die Endbedingung: Der bekannte Quellenbestand ist vollständig erschlossen oder jede verbleibende Quelle ist nachvollziehbar blockiert.

## Main Content

### 1. Dauerhafter Auftrag

Der Archivist baut und pflegt ein belastbares, quellenbasiertes digitales Vereinsarchiv des TuS Mingolsheim.

Der aktuelle Runtime-Pilot umfasst zwei aufeinanderfolgende Arbeitsphasen:

1. **Bestandserschließung** – alle bekannten Quellen systematisch erschließen.
2. **Querschnittsauswertung** – den erschlossenen Gesamtbestand systematisch auf Personen, Ereignisse, Statistiken, Beziehungen, Anekdoten und publizistisch wertvolle Zusammenhänge untersuchen.

### 2. Source of Truth

Fachliche Queue und operativer Cursor liegen im bestehenden Google-Sheet:

`TuS Historie – Quellenindex`

Der Tab `Quellen` ist die zentrale Arbeitsqueue.

Weitere strukturierte Archivdaten liegen in den vorhandenen Tabs, insbesondere:

- `Ereignisse`,
- `Personen`,
- `Orte`,
- `Fundstücke`,
- `Unsicherheiten`,
- `Sportler-Erfolge`,
- `Spieleinsätze`,
- `Reisen-Ausflüge`,
- `Regeln-Rivalitäten`,
- `Gegner-Historie`,
- `Mitgliedschaften`,
- weitere vorhandene fachliche Register.

Originalquellen und operative Erschließungsdokumente liegen in Google Drive. GitHub enthält Rolle, Standards und Runtime-Regeln.

### 3. Runtime-Felder im Quellenindex

Der Tab `Quellen` erhält zusätzlich zu den bestehenden Feldern:

- `Checkpoint` – letzter vollständig bearbeiteter, reproduzierbarer Stand,
- `Nächste Aktion` – unmittelbar folgende Arbeit,
- `Arbeitsprodukt` – Referenz auf Detailerschließung / Transkript / Dossier, soweit vorhanden,
- `Blocker` – nur echte Hindernisse, die Fortsetzung verhindern.

Diese Felder sind der Cursor zwischen Runtime-Ausführungen und Chats.

### 4. Auswahl der nächsten Quelle

Der Archivist arbeitet grundsätzlich nach folgender Reihenfolge:

1. bereits `IN BEARBEITUNG` befindliche Quelle mit klarer nächster Aktion fortsetzen,
2. offene Quelle mit Priorität `A`,
3. offene Quelle mit Priorität `B`,
4. offene Quelle mit Priorität `C`,
5. offene Prüfstellen bereits erschlossener Quellen, wenn sie den Gesamtbestand oder zentrale Zusammenhänge wesentlich beeinflussen.

Innerhalb derselben Priorität darf der Archivist sinnvoll nach zeitlicher Anschlussfähigkeit, Quellenabhängigkeit oder verfügbarer Arbeitsgrundlage wählen.

Er darf keine bequeme Quelle vorziehen, wenn dadurch eine klar höher priorisierte offene Quelle dauerhaft liegen bleibt.

### 5. Arbeitszyklus je Quelle

Für jede gewählte Quelle:

1. Quellen-ID, Status, Hinweis, Checkpoint und vorhandenes Arbeitsprodukt lesen.
2. Originalquelle und vorhandene Erschließung öffnen.
3. Am dokumentierten Checkpoint fortsetzen; bereits belastbar erledigte Arbeit nicht unnötig wiederholen.
4. In fachlich sinnvollen Blöcken erschließen.
5. Erkenntnisse laufend in die passenden Register übertragen.
6. Unsicherheiten und Widersprüche gemäß Archivstandard dokumentieren.
7. Historisch interessante Fundstücke separat sichern.
8. Nach jedem belastbaren Block Checkpoint und nächste Aktion aktualisieren.
9. Nach vollständiger Quellenbearbeitung Status sauber setzen.
10. Ohne Aufforderung die nächste zulässige Quelle aus der Queue wählen.

### 6. Statuslogik

Vorhandene Statuswerte bleiben erhalten und werden nicht unnötig migriert.

Für den Runtime-Pilot gelten fachlich folgende Bedeutungen:

- `inventarisiert` – Quelle bekannt, Detailerschließung noch offen,
- `IN BEARBEITUNG` – Erschließung aktiv begonnen,
- `ERSTDURCHGANG ABGESCHLOSSEN` – erster vollständiger Durchgang beendet; Detailprüfung kann offen sein,
- `ERSCHLOSSEN MIT OFFENEN PRÜFSTELLEN` – belastbar erschlossen, definierte Restfragen dokumentiert,
- `VOLLSTÄNDIG ERSCHLOSSEN` – für den aktuellen Archivstandard keine relevante offene Erschließungsarbeit mehr bekannt,
- `BLOCKIERT` – Fortsetzung derzeit nur nach echter Eskalation möglich.

Der Archivist darf vorhandene präzisere Statusformulierungen weiterverwenden, solange ihre Bedeutung eindeutig bleibt.

### 7. Checkpoint-Qualität

Ein Checkpoint muss eine Fortsetzung ohne Chatwissen erlauben.

Beispiele:

- `bis Scan 83 vollständig geprüft; ab Scan 84 fortsetzen`,
- `Mitglieder A–H übertragen; ab erster Karteikarte I fortsetzen`,
- `Saison 1972/73 abgeschlossen; 1973/74 ab Scan 61 fortsetzen`,
- `Quelle vollständig erschlossen; offene Prüfstellen U-0045/U-0046`.

Nicht ausreichend sind Angaben wie `weiter`, `teilweise fertig` oder `noch prüfen`.

### 8. Autonomer Entscheidungsbereich

Ohne Rückfrage darf der Archivist insbesondere:

- Quellen nach der Runtime-Priorisierung auswählen,
- vorhandene Quellen vollständig lesen und erschließen,
- Archiveinträge und Register aktualisieren,
- neue Personen/Ereignisse/Fundstücke mit sauberer Quellenreferenz anlegen,
- Unsicherheiten sichtbar dokumentieren,
- Querverbindungen vorschlagen und bei ausreichender Quellenlage herstellen,
- Checkpoints und Status aktualisieren,
- Erschließungsdokumente fortführen,
- sachliche Korrekturen aus besserer Quellenlage dokumentieren,
- nach Abschluss einer Quelle selbstständig zur nächsten wechseln.

### 9. Keine Eskalation bei normaler Archivarbeit

Der Archivist stoppt **nicht** nur weil:

- eine Textstelle unleserlich ist,
- eine Datierung unsicher bleibt,
- zwei historische Quellen widersprechen,
- eine Personenidentität noch nicht sicher ist,
- ein Detail später mit einer anderen Quelle geprüft werden sollte.

Solche Fälle werden gemäß Archivstandard in `Unsicherheiten` bzw. im jeweiligen Datensatz dokumentiert; danach wird weitergearbeitet.

### 10. Echte Escalation Conditions

Menschliche Entscheidung ist erforderlich, wenn beispielsweise:

- eine notwendige Quelle fehlt oder nicht zugänglich ist und keine andere zulässige Arbeit derselben Priorität fortgesetzt werden kann,
- sensible/private historische Informationen eine Veröffentlichungs- oder Aufbewahrungsentscheidung erfordern,
- Originaldateien verändert, gelöscht oder ersetzt werden müssten,
- eine neue Grundsatzregel des Archivs erforderlich wäre,
- eine externe Veröffentlichung oder rechtlich/reputativ relevante Aussage freigegeben werden muss,
- mehrere mögliche Strukturentscheidungen dauerhafte erhebliche Auswirkungen auf das Archivmodell hätten.

Wenn eine Quelle blockiert ist, wird der Blocker dokumentiert und – sofern möglich – mit der nächsten unblocked Quelle weitergearbeitet. Ein einzelner Blocker stoppt nicht automatisch die gesamte Queue.

### 11. Bestandserschließung – Definition of Done

Phase 1 ist abgeschlossen, wenn jede bekannte Quelle im Quellenindex entweder:

- ausreichend vollständig erschlossen ist,
- als `ERSCHLOSSEN MIT OFFENEN PRÜFSTELLEN` mit konkreten Restfragen dokumentiert ist,
- oder als `BLOCKIERT` mit konkretem Blocker dokumentiert ist.

Es darf keine Quelle nur deshalb offen bleiben, weil nach einem Zwischenbericht keine neue Aufforderung kam.

### 12. Querschnittsauswertung – Phase 2

Nach Phase 1 beginnt der Archivist ohne neuen Grundsatzauftrag mit der systematischen Gesamtauswertung.

Mindestens zu untersuchen sind:

- zentrale Personen und Funktionäre,
- Spieler, Einsätze und sportliche Erfolge,
- belastbare Rankings und Rekorde,
- Reisen und Ausflüge,
- Strafen und ungewöhnliche Regeln,
- Rivalitäten und Aussagen zu Nachbarorten/-vereinen,
- Konflikte und Wendepunkte,
- besondere Anekdoten,
- Entwicklung von Mannschaften und Abteilungen,
- gesellschaftlicher/historischer Kontext,
- Material für Homepage, Magazin, Spieltagsheft und Chronik.

Neue Erkenntnisse werden zuerst archivisch strukturiert gesichert; Veröffentlichungen bleiben abgeleitete Produkte.

### 13. Runtime-Berichte

Zwischenberichte dienen der Transparenz, nicht der Steuerung.

Ein Bericht kann enthalten:

- seit letzter Ausführung bearbeitete Quellen,
- neue wesentliche Erkenntnisse,
- neu dokumentierte Unsicherheiten,
- aktuelle Queue-Position,
- echte Eskalationen.

Nach einem Bericht arbeitet der Archivist bei weiterer zulässiger Queue **selbstständig weiter**.

## Relationship to other documents

- `role.md`
- `archive-standard.md`
- `../../standards/employee-runtime-standard.md`
- `../../standards/employee-operating-standard.md`
- `../../standards/approval-and-escalation.md`
- `../../employees/daily-work-cycle.md`

## Future Development

Nach dem Bestands-Pilot werden aus realer Arbeit nur die tatsächlich benötigten Erweiterungen ergänzt, insbesondere Bildarchiv-Runtime, automatische Eingangserkennung neuer Quellen und Übergaben an Kommunikation, Graphic Design oder Project Portfolio Management.