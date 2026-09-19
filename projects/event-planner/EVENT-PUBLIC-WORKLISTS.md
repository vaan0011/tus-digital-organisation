# Event Planner – Öffentliche Arbeitslisten

## Purpose

Aufgaben, Helferschichten und Mitbringen-Einträge werden im Event intern geplant und anschließend über zwei öffentliche Arbeitslisten verteilt.

Ziel ist, dass Verantwortliche und Mannschaften ohne Registrierung genau die für sie relevanten Informationen sehen und direkt Rückmeldung geben können.

## Core Principle

**Intern einmal planen, öffentlich passend filtern und Rückmeldungen wieder in denselben Event-Datenbestand zurückführen.**

Es entstehen keine separaten Excel-, WhatsApp- oder Papierlisten.

## 1. Aufgabenliste

Die öffentliche `Aufgabenliste` zeigt die Event-Aufgaben gruppiert nach verantwortlicher Person.

Pro Aufgabe werden angezeigt:

- Aufgabe,
- Kategorie, falls vorhanden,
- Fälligkeit, falls vorhanden,
- Status.

Die verantwortliche Person kann ohne Registrierung zurückmelden:

- `Übernommen`,
- `Erledigt`,
- optional eine kurze Notiz.

Eine Rückmeldung `Erledigt` setzt auch den fachlichen Aufgabenstatus im Event auf `done`.

Die öffentliche Ansicht zeigt keine privaten Kontaktdaten. Ein eingeloggter Admin sieht zusätzlich die konkrete Rückmeldung und den Namen des Rückmeldenden.

Optional kann die Liste über `?person=<Name>` auf genau eine Person gefiltert und weitergegeben werden.

## 2. Schichten / Mitbringen

Die bestehende öffentliche Helferseite ist die gemeinsame Liste für:

- Helferschichten aus `vtp_shifts`,
- Mitbringen-Einträge aus `vtp_event_catering_items` mit `category=bring`.

Die Gesamtansicht ist nach Mannschaft / Abteilung / Gruppe gegliedert.

Über `?gruppe=<Gruppe>` wird dieselbe Seite auf eine einzelne Gruppe gefiltert. Dadurch kann z. B. ein E-Jugend-Link weitergegeben werden, ohne eine zweite Liste pflegen zu müssen.

### Helferschichten

Eltern oder Helfer können sich ohne Registrierung auf einen freien Platz eintragen.

Gespeichert werden:

- Name,
- optionale Kontaktmöglichkeit.

Öffentlich sichtbar ist nur die Belegung, nicht die Kontaktdaten.

### Mitbringen

Mitbringen-Einträge können von mehreren Personen gemeinsam erfüllt werden.

Beispiel:

- Bedarf: 30 Muffins
- Rückmeldung 1: 10 Muffins
- Rückmeldung 2: 10 Muffins
- Rückmeldung 3: 10 Muffins

Pro Rückmeldung werden gespeichert:

- Name,
- Menge,
- optionale Kontaktmöglichkeit.

Die öffentliche Ansicht zeigt Bedarf, bereits übernommene Menge und Restbedarf. Namen und Kontakte sind nur für eingeloggte Admins sichtbar.

## Admin-Gesamtübersicht

Öffnet ein eingeloggter Admin die ungefilterte öffentliche Seite, sieht er:

- alle Personen bzw. Gruppen,
- alle Aufgaben,
- alle Schichten,
- alle Mitbringen-Bedarfe,
- die jeweiligen Rückmeldungen,
- private Kontaktdaten der Rückmeldenden.

Im Event-Bearbeitungsscreen stehen unter `Öffentliche Seiten` direkte Links zu:

- Programm,
- Aufgabenliste,
- Schichten / Mitbringen.

In der Gesamtansicht werden Admins zusätzlich gruppenspezifische Weiterleitungslinks angeboten.

## Datenschutz

- Keine Registrierung erforderlich.
- Kontaktdaten werden nicht öffentlich ausgegeben.
- Kontaktdaten sind nur für die Eventorganisation vorgesehen.
- Öffentliche Seiten zeigen nur die für die Koordination notwendigen Informationen.

## Persistenz

Bestehende Tabellen bleiben fachliche Quelle:

- `vtp_event_tasks`
- `vtp_shifts`
- `vtp_shift_signups`
- `vtp_event_catering_items`

Ergänzt werden:

- `vtp_event_task_feedback` für öffentliche Aufgaben-Rückmeldungen,
- `vtp_event_bring_signups` für Mitbringen-Rückmeldungen.

## Future Development

Wenn Mannschaften und Personen später aus zentralen Vereinsmodulen kommen, sollen Freitext-Zuordnungen auf diese Stammdaten referenzieren. Die öffentlichen Listen bleiben dabei in ihrer Bedienlogik unverändert.
