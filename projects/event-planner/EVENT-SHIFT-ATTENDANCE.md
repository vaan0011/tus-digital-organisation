# Event Planner – Anwesenheit bei Helferschichten

## Purpose

Schichtanmeldungen sollen nach dem Event nicht nur als Anmeldung erhalten bleiben, sondern auch dokumentieren können, ob eine angemeldete Person nicht erschienen ist.

## Core Principle

**Absage und No-Show sind fachlich verschieden und dürfen nicht gleich behandelt werden.**

- Eine Absage wird als Anmeldung gelöscht. Der Platz wird wieder frei und kann erneut gebucht werden.
- Ein No-Show bleibt als ursprüngliche Anmeldung erhalten und wird mit `Nicht erschienen` markiert.

## Admin-Verhalten

In der PIN-geschützten Gesamtübersicht `Schichten / Mitbringen` steht zusätzlich der Bereich `Anwesenheit Helferschichten` zur Verfügung.

Pro Schichtanmeldung kann der Admin:

- `Nicht erschienen` markieren,
- eine versehentlich gesetzte No-Show-Markierung wieder zurücksetzen.

No-Shows werden in der Adminansicht deutlich rot markiert.

## Datenmodell

Die bestehende Tabelle `vtp_shift_signups` bleibt fachliche Quelle der Anmeldung und erhält:

- `attendance_status` mit den aktuell erlaubten Werten `registered` und `no_show`,
- `attendance_updated_at` für den Zeitpunkt der letzten Statusänderung.

Bestehende Anmeldungen erhalten automatisch den Status `registered`.

## Belegung und Historie

Eine No-Show-Markierung löscht die Anmeldung nicht und gibt den Platz nicht erneut frei. Sie ist eine nachgelagerte Dokumentation der tatsächlichen Teilnahme.

Soll ein Platz wegen einer rechtzeitigen Absage wieder buchbar werden, wird weiterhin die Funktion `Anmeldung löschen` verwendet.

## Datenschutz und Zugriff

Die Anwesenheitsverwaltung ist ausschließlich in der geschützten Admin-Gesamtübersicht sichtbar und verwendet denselben Event-PIN bzw. WordPress-Adminzugriff wie die übrige Arbeitslisten-Verwaltung.

Gruppenlinks wie `?gruppe=E-Jugend` zeigen keine No-Show-Markierung und keine privaten Verwaltungsinformationen.

## Future Development

Der Anwesenheitsstatus kann später für Helferstunden, Engagement-Historie oder vereinsweite Auswertungen genutzt werden. Eine solche Auswertung ist nicht Bestandteil dieser ersten Umsetzung.
