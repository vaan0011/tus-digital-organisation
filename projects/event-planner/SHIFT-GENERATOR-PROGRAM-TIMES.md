# Shift Generator – Programmzeiten

Der Schichtgenerator verwendet für den gewählten Eventtag automatisch den vorhandenen Programmzeitraum als Vorschlag.

- `Von` = früheste Startzeit eines regulären Programmpunkts.
- `Bis` = späteste Endzeit eines regulären Programmpunkts.
- Aufbau und Abbau werden nicht berücksichtigt.
- Die Werte bleiben vollständig editierbar.
- Liegt `Bis` vor `Von`, wird das Ende als Folgetag interpretiert.
- Generierte Schichten, die nach Mitternacht beginnen, erhalten automatisch das Datum des Folgetags.

Beispiel: Programm 12:00–23:00 Uhr → Generator startet mit 12:00–23:00 Uhr. Wird `Bis` auf 02:00 Uhr geändert, reicht die Serie bis 02:00 Uhr am nächsten Tag.
