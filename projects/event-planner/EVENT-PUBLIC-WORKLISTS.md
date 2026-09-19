# Event Planner – Öffentliche Arbeitslisten

## Purpose

Aufgaben, Helferschichten und Mitbringen-Einträge werden im Event intern geplant und anschließend über zwei öffentliche Arbeitslisten verteilt.

Ziel ist, dass Verantwortliche und Mannschaften ohne Registrierung genau die für sie relevanten Informationen sehen und direkt Rückmeldung geben können, während die vollständigen Admin-Gesamtübersichten geschützt bleiben.

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

Optional kann die Liste über `?person=<Name>` auf genau eine Person gefiltert und direkt weitergegeben werden. Dieser gefilterte Personenlink benötigt keinen Admin-PIN.

## 2. Schichten / Mitbringen

Die bestehende öffentliche Helferseite ist die gemeinsame Liste für:

- Helferschichten aus `vtp_shifts`,
- Mitbringen-Einträge aus `vtp_event_catering_items` mit `category=bring`.

Die Gesamtansicht ist nach Mannschaft / Abteilung / Gruppe gegliedert.

Über `?gruppe=<Gruppe>` wird dieselbe Seite auf eine einzelne Gruppe gefiltert. Dadurch kann z. B. ein E-Jugend-Link weitergegeben werden, ohne eine zweite Liste pflegen zu müssen. Dieser gefilterte Mannschaftslink benötigt keinen Admin-PIN.

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

Die öffentliche Ansicht zeigt Bedarf, bereits übernommene Menge und Restbedarf.

## Admin-Gesamtübersichten und PIN-Schutz

Die ungefilterten Gesamtübersichten `Aufgabenliste` und `Schichten / Mitbringen` sind Adminansichten.

Sie sind geschützt durch:

- einen Event-spezifischen Admin-PIN mit 4 bis 8 Ziffern,
- oder einen bestehenden WordPress-Admin-Login.

Der PIN wird im Event-Backend im Bereich `Öffentliche Seiten` gesetzt oder geändert.

Der PIN wird **nicht im Klartext** gespeichert. Persistiert wird ausschließlich ein WordPress-Passworthash in `vtp_event_worklist_access`.

Nach erfolgreicher PIN-Eingabe erhält der Browser für acht Stunden eine signierte, HttpOnly geschützte Freigabe für genau dieses Event. Wird der PIN geändert, verlieren bestehende Freigaben automatisch ihre Gültigkeit.

Die Admin-Gesamtübersichten zeigen:

- alle Personen bzw. Gruppen,
- alle Aufgaben,
- alle Schichten,
- alle Mitbringen-Bedarfe,
- die jeweiligen Rückmeldungen,
- private Kontaktdaten der Rückmeldenden,
- direkte Weiterleitungslinks für Personen bzw. Mannschaften.

### Admin-Verwaltung: Aufgaben

Auf der PIN-geschützten Aufgaben-Gesamtübersicht kann der Admin zusätzlich:

- neue Aufgaben anlegen,
- Titel, verantwortliche Person, optionale Kategorie und Fälligkeit pflegen,
- eine bestehende öffentliche Rückmeldung zurücksetzen,
- fehlerhafte Aufgaben dauerhaft löschen.

`Rückmeldung zurücksetzen` und `Aufgabe löschen` sind fachlich getrennt:

- Sagt eine verantwortliche Person ab, wird nur die Rückmeldung zurückgesetzt. Die Aufgabe bleibt bestehen und ist wieder `offen`.
- Ist die Aufgabe selbst falsch oder nicht mehr erforderlich, wird sie gelöscht. Eine vorhandene öffentliche Rückmeldung wird dabei ebenfalls entfernt.

### Admin-Verwaltung: Schichten und Mitbringen

Auf der PIN-geschützten Gesamtübersicht `Schichten / Mitbringen` kann der Admin einzelne Rückmeldungen löschen.

Bei einer gelöschten Schichtanmeldung:

- wird ausschließlich die Anmeldung entfernt,
- die Schicht bleibt bestehen,
- der frei gewordene Platz ist sofort wieder öffentlich buchbar.

Bei einer gelöschten Mitbringen-Rückmeldung:

- wird ausschließlich die konkrete Zusage entfernt,
- der Mitbringen-Bedarf bleibt bestehen,
- die zuvor zugesagte Menge wird sofort wieder als offener Bedarf angezeigt.

Diese Adminaktionen stehen nur in der geschützten Gesamtübersicht zur Verfügung, nicht in Personen- oder Mannschaftslinks.

Die gefilterten Weiterleitungslinks bleiben bewusst ohne PIN erreichbar:

- `?person=<Name>` für eine einzelne verantwortliche Person,
- `?gruppe=<Gruppe>` für eine Mannschaft / Abteilung / Gruppe.

Damit muss der Admin-PIN niemals an Eltern oder einzelne Aufgabenverantwortliche weitergegeben werden.

## Event-Bearbeitung

Im Event-Bearbeitungsscreen stehen unter `Öffentliche Seiten` direkte Links zu:

- Programm,
- Aufgabenliste,
- Schichten / Mitbringen.

Im selben Bereich kann der Event-Admin den gemeinsamen Admin-PIN für die beiden Gesamtübersichten setzen oder ändern.

## Datenschutz

- Keine Registrierung für Personen- oder Mannschaftslinks erforderlich.
- Die ungefilterten Admin-Gesamtübersichten sind PIN-geschützt.
- Kontaktdaten werden nicht in gefilterten öffentlichen Ansichten ausgegeben.
- Kontaktdaten sind nur für die Eventorganisation vorgesehen.
- Der Admin-PIN wird ausschließlich gehasht gespeichert.
- Öffentliche Seiten zeigen nur die für die Koordination notwendigen Informationen.
- Mutierende Adminaktionen prüfen zusätzlich die gültige Event-Adminfreigabe und einen WordPress-Nonce.

## Persistenz

Bestehende Tabellen bleiben fachliche Quelle:

- `vtp_event_tasks`
- `vtp_shifts`
- `vtp_shift_signups`
- `vtp_event_catering_items`

Ergänzt werden:

- `vtp_event_task_feedback` für öffentliche Aufgaben-Rückmeldungen,
- `vtp_event_bring_signups` für Mitbringen-Rückmeldungen,
- `vtp_event_worklist_access` für den gehashten Event-Admin-PIN.

## Future Development

Wenn Mannschaften und Personen später aus zentralen Vereinsmodulen kommen, sollen Freitext-Zuordnungen auf diese Stammdaten referenzieren. Die öffentlichen Listen bleiben dabei in ihrer Bedienlogik unverändert.
