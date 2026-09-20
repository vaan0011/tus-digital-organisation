# Event-Vorlagen

## Zweck

Wiederkehrende TuS-Veranstaltungen sollen aus einem bereits sauber geplanten Event als Vorlage gespeichert und später mit einem neuen Startdatum wiederverwendet werden können. Eine Vorlage ist kein Jahresarchiv und kein vollständiges Event-Duplikat, sondern enthält die wiederkehrende Planungsstruktur.

## Gespeicherter Umfang

Eine Event-Vorlage enthält:

- Veranstaltungsname,
- Event-Tage,
- Aufbau und Abbau inklusive Uhrzeit,
- Aufgaben,
- manuell geplante Helferschichten,
- Bewirtungsplanung für Getränke, Essen und Mitbringen inklusive Zuordnung.

Nicht Bestandteil der Vorlage sind:

- konkrete Kalenderdaten,
- Programmpunkte,
- Sponsoren,
- Eventbeschreibung und externer Link,
- Helferanmeldungen,
- Anwesenheits-/No-Show-Daten,
- Erledigt-Status von Aufgaben,
- automatisch aus Aufbau/Abbau erzeugte Helferschichten als Dublette.

## Datumslogik

Alle datumsabhängigen Bestandteile werden relativ zum Startdatum des Ausgangsevents gespeichert.

Beispiel:

- Aufbau zwei Tage vor Eventbeginn -> `-2`,
- erster Eventtag -> `0`,
- zweiter Eventtag -> `+1`,
- Abbau am Tag nach dem Event -> entsprechender relativer Offset.

Damit enthält die Vorlage keine festen Jahresdaten. Beim Erzeugen eines neuen Events wird das neu gewählte Startdatum wieder zu Offset `0`.

Für Aufgaben mit Fälligkeit wird ebenfalls nur der relative Abstand zum Eventstart gespeichert.

## Helferschichten

Manuelle Helferschichten werden mit Bereich/Aufgabe, relativem Tag, Start- und Endzeit, benötigter Helferzahl und optionaler Mannschafts-/Gruppenzuordnung gespeichert.

Automatisch aus Aufbau/Abbau erzeugte Schichten werden nicht zusätzlich in die Vorlage aufgenommen. Aufbau/Abbau sind bereits Bestandteil der Tagesstruktur und erzeugen ihre Helferschichten über die bestehende Operations-Synchronisierung erneut.

Helferanmeldungen werden niemals in eine Vorlage übernommen.

## Aufgaben

Gespeichert werden Titel, Kategorie, relative Fälligkeit, Verantwortlichkeit und Reihenfolge. Beim Erzeugen eines Events aus einer Vorlage starten Aufgaben wieder als offen.

## Bewirtung

Gespeichert werden Kategorie, Artikel, Menge, Einheit, optionale Notiz und Reihenfolge. Bei `Mitbringen` wird zusätzlich die Mannschafts-/Gruppenzuordnung übernommen.

## Vorlagenbibliothek

Unter `Events -> Vorlagen` kann eine gespeicherte Vorlage:

- geöffnet und bearbeitet,
- direkt als Basis für ein neues Event verwendet,
- dauerhaft gelöscht werden.

In der Bearbeitung können Vorlagenname, Tage/Aufbau/Abbau, Aufgaben, Helferschichten und Bewirtung verändert werden.

`Als Vorlage speichern` im Event-Abschlussblock legt beim ersten Mal eine Vorlage an. Wird dasselbe Ausgangsevent später erneut als Vorlage gespeichert, wird die bestehende Vorlage aktualisiert statt dupliziert.

## Neues Event aus Vorlage

Unter `Neues Event anlegen` ist die Vorlagenauswahl aktiv.

Bei ausgewählter Vorlage:

1. wird der Veranstaltungsname vorbelegt,
2. ist ein neues Startdatum erforderlich,
3. wird das Enddatum aus dem letzten regulären Event-Tag der Vorlage berechnet,
4. wird das Event über den bestehenden Event-Speicherweg angelegt,
5. anschließend werden Tagesstruktur, Aufgaben, Helferschichten und Bewirtung aus dem Template-Snapshot erzeugt,
6. Aufbau-/Abbau-Schichten werden danach über die bestehende automatische Synchronisierung ergänzt.

Aufbau und Abbau können vor bzw. nach dem eigentlichen Event-Zeitraum liegen und verändern den regulären Event-Endtermin nicht.

Der vorbelegte Veranstaltungsname darf dem Namen eines bereits bestehenden Events entsprechen. Die Datenbank verwendet für Events einen eindeutigen technischen `slug`; der gemeinsame Event-Speicher erzeugt deshalb bei einer Namenskollision automatisch einen freien Slug (`name`, `name-2`, `name-3`, ...). Der sichtbare Veranstaltungsname wird dadurch nicht verändert.

## Architektur

Die Vorlage erzeugt keine parallele Datenwelt. Nach dem Anwenden liegen die Daten in den bestehenden Event-Tabellen und werden danach ganz normal über die bestehenden Module bearbeitet:

- `event_days`,
- `event_tasks`,
- `shifts`,
- `event_catering_items`.

Der normale Event-Speicherweg bleibt für die Event-Anlage die Source of Truth. Der Template-Workflow ergänzt anschließend nur die wiederkehrenden Planungsdaten.

## Zukunft

Nur bei echtem Bedarf:

- Vorlage duplizieren,
- Vorlagenversionierung,
- optionale Übernahme weiterer Event-Stammdaten,
- Vergleich Vorlage ↔ aktuelles Event.
