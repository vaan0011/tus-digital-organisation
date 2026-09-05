# Event Planner – Smoke Test

## Purpose

Dieser Smoke-Test definiert den kleinsten reproduzierbaren Funktionsnachweis für den TuS Event Planner.

Er beantwortet vor einer funktionalen Weiterentwicklung die Frage: Läuft der bekannte Referenzstand in einer definierten WordPress-Umgebung grundsätzlich und funktionieren die zentralen Arbeitswege?

Der Test ersetzt keine detaillierten Fachtests. Er ist das Eintrittskriterium für einen formalen `Last Known Good`.

## Core Principle

Ein Stand wird erst dann als `Last Known Good` bezeichnet, wenn genau dieser Stand in einer dokumentierten Umgebung erfolgreich geprüft wurde.

Ein Versionsname allein reicht nicht aus. Maßgeblich sind Commit, WordPress-Version, PHP-Version und das dokumentierte Testergebnis.

## Baseline Candidate

Plugin: `Verein Turnierplaner 3.6.0`

Repository-Commit:

`032f1bd39a96fca6548eefb833442f12ed2aa17f`

Testumgebung:

- WordPress `7.1`
- PHP `8.2`
- Sprache `de_DE`
- frische WordPress-Playground-Instanz
- Plugin wird direkt aus dem oben genannten Git-Commit geladen

Reproduzierbare Playground-Konfiguration:

`projects/event-planner/playground/baseline-3.6.0.json`

## Smoke-Test Ablauf

### 1. Start und Aktivierung

- Playground mit der Baseline-Konfiguration starten.
- Prüfen, dass WordPress startet und die Anmeldung als Administrator funktioniert.
- Prüfen, dass der Event Planner aktiviert wird.
- Dashboard `TuS Eventplaner` öffnen.
- Es darf kein sichtbarer PHP-Fatal-Error, keine Exception und keine unbenutzbare Seite auftreten.

### 2. Event anlegen

Ein Testevent anlegen:

- Eventname: `Smoke Test Event`
- Startdatum: `01.06.2030`
- Enddatum: `01.06.2030`
- Veranstaltungsort: `TuS Sportpark`

Danach prüfen:

- Speichern funktioniert.
- Das Event erscheint unter den aktiven Events.
- Das Event lässt sich erneut zur Bearbeitung öffnen.
- Die gespeicherten Kerndaten sind nach dem erneuten Öffnen weiterhin vorhanden.

### 3. Turnier anlegen

Ein Testturnier anlegen:

- Name: `Smoke Test Turnier`
- Datum: `01.06.2030`
- Ort: `TuS Sportpark`
- einen regulären Turniermodus verwenden, der eine Gruppen-/Spielplangenerierung erlaubt

Danach prüfen:

- Speichern funktioniert.
- Das Turnier erscheint unter den aktiven Turnieren.
- Das Turnier lässt sich zur Bearbeitung öffnen.

### 4. Teams und Spielplan

Im Testturnier vier Teams anlegen:

- `Team A`
- `Team B`
- `Team C`
- `Team D`

Danach prüfen:

- Teams bleiben nach dem Speichern erhalten.
- Ein Spielplan lässt sich generieren.
- Generierte Spiele werden angezeigt.
- Ein erneutes Laden der Seite verliert den generierten Spielplan nicht.

### 5. Ergebnis speichern

Für ein generiertes Spiel ein eindeutiges Ergebnis eintragen, zum Beispiel `1:0`.

Danach prüfen:

- Ergebnis lässt sich speichern.
- Ergebnis ist nach erneutem Laden weiterhin vorhanden.
- Die Seite bleibt ohne sichtbaren PHP-Fehler benutzbar.

### 6. Öffentliche Ansicht

Für das Testturnier die öffentliche Turnierseite erstellen bzw. aktualisieren und öffnen.

Danach prüfen:

- Öffentliche Seite wird geladen.
- Turniername und Spielplan sind sichtbar.
- Das gespeicherte Ergebnis wird korrekt dargestellt.
- Es tritt kein sichtbarer PHP-Fatal-Error auf.

## Pass Criteria

Der Smoke-Test gilt nur als bestanden, wenn alle sechs Bereiche erfolgreich geprüft wurden.

Ein kosmetischer Befund darf dokumentiert werden, ohne den Test zwingend scheitern zu lassen. Fehler bei Aktivierung, Speicherung, Datenpersistenz, Spielplangenerierung oder öffentlicher Darstellung führen dagegen zu `FAILED`.

## Result Template

Nach jedem formalen Baseline-Test wird das Ergebnis kompakt dokumentiert:

- Datum:
- getesteter Commit:
- Plugin-Version:
- WordPress-Version:
- PHP-Version:
- Ergebnis: `PASSED` / `FAILED`
- Abweichungen / Befunde:
- Prüfer:

Nur bei `PASSED` darf der getestete Commit in `PROJECT-STATE.md` als `Last Known Good` eingetragen werden.

## Known Baseline Finding

Im Referenzstand `3.6.0` trägt der WordPress-Plugin-Header die Version `3.6.0`, während die Konstante `VTP_VERSION` noch `3.5.0` enthält.

Die Konstante wird im aktuellen Stand für die Versionskennung der Admin- und Public-CSS-Dateien verwendet. Der Befund wird deshalb zunächst dokumentiert und nicht im Rahmen dieses Baseline-Aufbaus nebenbei verändert.

## Relationship to Other Documents

- `PROJECT-STATE.md` dokumentiert den aktuellen Projektzustand und den gültigen Last Known Good.
- `../../roles/wordpress-developer/development-standard.md` definiert die Entwicklungs- und Testanforderungen.
- `../../standards/iteration-and-progress.md` definiert Last Known Good, Lernschleifen und Abbruchregeln.
- `.github/workflows/event-planner-pr-preview.yml` stellt nach seiner Übernahme in `main` für künftige Event-Planner-PRs eine direkte WordPress-Playground-Vorschau bereit.

## Future Development

Der Smoke-Test darf erweitert werden, wenn wiederkehrende reale Fehler zeigen, dass ein zusätzlicher kleiner Prüfschritt einen klaren Schutzwert bietet.

Er soll bewusst kompakt bleiben und nicht zu einer vollständigen manuellen Regressionstest-Sammlung anwachsen.
