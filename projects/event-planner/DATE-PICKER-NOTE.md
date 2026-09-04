# Event Planner – Date Picker Follow-up

Dieses Dokument ist absichtlich **nicht** die organisationsweite Regelquelle. Die verbindlichen Regeln stehen in `../../design/ui-standard.md` unter `Datumsfelder und Kalender-Picker`.

Für den aktuellen Event-Planner-Folgechange gilt:

- Event-Enddatum verwendet das Startdatum als kontextbezogenen Default, solange der Nutzer noch keine eigene Auswahl getroffen hat.
- Neue Event-Tage verwenden den vorherigen Event-Tag + 1 Tag; falls kein vorheriger Tag vorhanden ist, das Event-Startdatum.
- Manuelle Datumswahl wird danach nicht automatisch überschrieben.
- Die Playground-Konfiguration `playground/event-day-date-picker.json` lädt den relevanten Plugin-Commit für den manuellen Test.
