# Event aus Vorlage anlegen – Slug-Kollision

## Problem

Eine Event-Vorlage übernimmt standardmäßig den Veranstaltungsnamen des Ausgangsevents. Der gemeinsame Event-Speicher erzeugte daraus bisher direkt denselben technischen `slug`.

Da `events.slug` eindeutig ist, scheiterte das Anlegen eines neuen Events aus einer Vorlage, solange bereits ein Event mit demselben Slug existierte.

## Korrektur

Der gemeinsame Event-Speicher erzeugt jetzt einen freien technischen Slug. Der sichtbare Veranstaltungsname bleibt unverändert.

Beispiel:

- bestehendes Event: `Sportfest` -> `sportfest`
- neues Event aus Vorlage: `Sportfest` -> `sportfest-2`
- weiteres Event: `Sportfest` -> `sportfest-3`

Das Verhalten gilt auch für normale Event-Anlage und Umbenennung, damit der gemeinsame Speicherweg robust bleibt.

## Regressionstest

1. Bestehendes Event `Sportfest` als Vorlage speichern.
2. Ausgangsevent nicht löschen oder archivieren.
3. `Events -> Vorlagen -> Event aus Vorlage anlegen` öffnen.
4. Den vorbelegten Namen `Sportfest` unverändert lassen.
5. Neues Startdatum setzen und Event anlegen.
6. Das neue Event muss erfolgreich angelegt und geöffnet werden.
7. Event-Tage, Aufgaben, Helferschichten und Bewirtung aus der Vorlage müssen vorhanden sein.
8. Das ursprüngliche Event muss unverändert bestehen bleiben.
9. Ein weiteres Event mit demselben sichtbaren Namen anlegen und prüfen, dass auch dieses erfolgreich gespeichert wird.


## Nativer Anlegeweg

Das neue Event wird über denselben klassischen WordPress-Formularweg angelegt wie ein Event ohne Vorlage. Dadurch wird der gemeinsame Event-Speicher einschließlich der eindeutigen Slug-Erzeugung zuverlässig ausgeführt.

Nach der erfolgreichen WordPress-Rückleitung liest der Workflow die neue Event-ID aus der Zieladresse und wendet anschließend den Template-Snapshot an. Der Anlegeschritt verwendet bewusst kein `fetch()`, da klassische WordPress-Redirect-Handler browserabhängig keine verlässliche Fetch-Antwort liefern.
