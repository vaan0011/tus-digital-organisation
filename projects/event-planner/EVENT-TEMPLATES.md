# Event-Vorlagen

## Zweck

Wiederkehrende TuS-Veranstaltungen sollen aus einem bereits sauber geplanten Event als Vorlage gespeichert werden können. Eine Vorlage ist kein Jahresarchiv und kein Duplikat des vollständigen Events, sondern enthält nur die wiederverwendbare Planungsstruktur.

## Gespeicherter Umfang

Eine Event-Vorlage enthält:

- Veranstaltungsname,
- Event-Tage,
- Aufbau und Abbau inklusive Uhrzeit,
- Aufgaben,
- manuell geplante Helferschichten,
- Bewirtungsplanung für Getränke und Essen.

Nicht Bestandteil der Vorlage sind aktuell:

- konkrete Kalenderdaten,
- Programmpunkte,
- Sponsoren,
- Eventbeschreibung und externer Link,
- Helferanmeldungen,
- Erledigt-Status von Aufgaben,
- automatisch aus Aufbau/Abbau erzeugte Helferschichten.

## Datumslogik

Alle datumsabhängigen Bestandteile werden relativ zum Startdatum des Ausgangsevents gespeichert.

Beispiel:

- Aufbau zwei Tage vor Eventbeginn -> `-2`,
- erster Eventtag -> `0`,
- zweiter Eventtag -> `+1`,
- Abbau am Tag nach dem Event -> entsprechend relativer Offset.

Damit enthält die Vorlage keine festen Jahresdaten und kann später auf einen neuen Veranstaltungszeitraum übertragen werden.

Für Aufgaben mit Fälligkeit wird ebenfalls nur der relative Abstand zum Eventstart gespeichert.

## Helferschichten

Manuelle Helferschichten werden mit Bereich/Aufgabe, relativem Tag, Start- und Endzeit, benötigter Helferzahl und optionaler Zuordnung gespeichert.

Automatisch aus Aufbau/Abbau erzeugte Schichten werden nicht zusätzlich in die Vorlage aufgenommen. Aufbau/Abbau sind bereits Bestandteil der Tagesstruktur und erzeugen ihre Helferschichten im normalen Event-Workflow erneut.

Helferanmeldungen werden niemals in eine Vorlage übernommen.

## Aufgaben

Gespeichert werden Titel, Kategorie, relative Fälligkeit, Verantwortlichkeit und Reihenfolge. Beim späteren Erzeugen eines Events aus einer Vorlage starten Aufgaben wieder als offen.

## Bewirtung

Gespeichert werden Kategorie, Artikel, Bestellmenge, Einheit, optionale Notiz und Reihenfolge.

## Bedienung

Im letzten Arbeitsblock `Event abschließen` stehen drei getrennte Aktionen zur Verfügung:

1. `Als Vorlage speichern`
2. `Event archivieren` bzw. `Event wiederherstellen`
3. `Event dauerhaft löschen`

Die Löschaktion ist als destruktive Aktion rot hervorgehoben und behält die bestehende Sicherheitsabfrage.

`Als Vorlage speichern` legt beim ersten Mal eine Vorlage an. Wird dasselbe Ausgangsevent später erneut als Vorlage gespeichert, wird die bestehende Vorlage aktualisiert statt dupliziert.

Gespeicherte Vorlagen werden im Bereich `Events -> Vorlagen` angezeigt.

## Abgrenzung V1

V1 speichert und dokumentiert belastbare Vorlagen. Das automatische Erzeugen eines neuen Events aus einer Vorlage ist ein eigener nächster Ausbauschritt und wird nicht implizit mit diesem Speicher-Workflow vermischt.
