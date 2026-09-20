# Event Planner – Globaler Event-Speicher

## Purpose

Der Abschlussblock `Event abschließen` bietet einen zentralen Checkpoint `Event speichern`.

Der Button dient dazu, den aktuell im Browser bearbeiteten Event-Stand vor Vorlage, Archivierung oder Verlassen der Seite noch einmal vollständig über die bestehenden Speicherwege zu persistieren.

## Core Principle

**Der Gesamtspeicher ersetzt keine Fachlogik und keine bestehenden Datenquellen. Er orchestriert ausschließlich die vorhandenen Save-Handler.**

Ein zusätzlicher paralleler Speicherweg oder eine zweite Event-Datenstruktur ist nicht zulässig.

## Gespeicherte Bereiche

`Event speichern` berücksichtigt, sofern der jeweilige Bereich im Bearbeitungsscreen vorhanden ist:

1. Veranstaltungsdaten und Sponsoren,
2. Aufgaben,
3. Bewirtung inklusive Mitbringen,
4. Helferschichten,
5. Ablaufplan und Programmpunkte.

Die vorhandene Validierung der einzelnen Formulare bleibt verbindlich.

## Reihenfolge

Helferschichten werden bewusst **vor** dem Ablaufplan gespeichert.

Grund: Der Ablaufplan synchronisiert Aufbau und Abbau anschließend automatisch mit den Helferschichten. Würde danach noch ein älterer Schichtformular-Stand gespeichert, könnten neu synchronisierte Aufbau-/Abbau-Schichten wieder entfernt werden.

Damit gilt als feste Reihenfolge:

`Veranstaltungsdaten → Aufgaben → Bewirtung → Helferschichten → Ablaufplan`

## Technische Save-Logik

Die vorhandenen WordPress-Save-Handler antworten nach erfolgreichem Speichern mit einem Redirect zurück zur jeweiligen Eventansicht.

Beim globalen Speichern wird diesem Redirect bewusst **nicht** gefolgt. Der Redirect selbst gilt als Erfolgssignal des jeweiligen bestehenden Save-Handlers.

Damit wird verhindert, dass die vollständige Eventseite zwischen den einzelnen Speicherschritten mehrfach im Hintergrund neu gerendert wird. Erst nachdem alle Bereiche erfolgreich gespeichert wurden, lädt der Browser die Eventseite genau einmal neu aus der Datenbank.

Antwortet ein Save-Handler dagegen mit einem echten Fehlerstatus, wird der Gesamtspeicher abgebrochen. Soweit möglich wird die konkrete Servermeldung zusätzlich zur betroffenen Bereichsbezeichnung angezeigt.

## UX

Im Block `Event abschließen` steht `Event speichern` ganz links als primäre blaue Aktion.

Während des Speicherns:

- ist der Button deaktiviert,
- zeigt er `Event wird gespeichert …`,
- werden die vorhandenen Save-Handler nacheinander aufgerufen.

Nach erfolgreichem Abschluss wird die Eventseite neu aus der Datenbank geladen und zeigt:

`Event vollständig gespeichert.`

Schlägt ein Bereich fehl, wird keine falsche Gesamterfolgsbestätigung angezeigt. Stattdessen erscheint eine Fehlermeldung mit dem betroffenen Bereich und – soweit vom Server geliefert – der konkreten Ursache.

## Relationship

- `EVENT-EDIT-UI.md`
- `EVENT-DAY-PLANNING.md`
- `EVENT-TASKS.md`
- `EVENT-SHIFTS.md`
- `EVENT-CATERING.md`
- `DATA-PERSISTENCE.md`

## Future Development

Sollten weitere persistente Arbeitsblöcke hinzukommen, werden sie nur dann in den Gesamtspeicher aufgenommen, wenn sie im Event-Bearbeitungsscreen editierbar sind und einen bestehenden belastbaren Save-Handler besitzen.


## Browserübergreifende Redirect-Behandlung

Die vorhandenen WordPress-Save-Handler leiten nach erfolgreichem POST zurück zur Eventseite. Der Gesamtspeicher folgt dieser Weiterleitung und bewertet sowohl eine erfolgreiche HTTP-Antwort als auch eine gleichartige Weiterleitung zur Eventseite als Erfolg.

Damit wird insbesondere verhindert, dass Safari die zurückgelieferte WordPress-Admin-Seite als Fehlertext anzeigt. Erst eine tatsächliche fehlgeschlagene Serverantwort ohne gültige Weiterleitung beendet den Gesamtspeicher.

### Regressionstest

1. Alle Arbeitsblöcke eines Events einzeln speichern.
2. Anschließend `Event speichern` in Safari ausführen.
3. Es darf kein aus der WordPress-Admin-Seite extrahierter Fehlertext erscheinen.
4. Nach dem abschließenden Reload muss `Event vollständig gespeichert.` erscheinen.
5. Die gespeicherten Werte aller Arbeitsblöcke müssen erhalten bleiben.
