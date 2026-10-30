# TuS Spielerbarometer – Project State

## Purpose

Operativer Projekt-Checkpoint für den Aufbau und die wiederkehrende Durchführung des halbjährlichen Spielerbarometers.

## Core Principle

**Teilnahme für Spieler einfach; Rücklauf vertraulich; Handlungsergebnisse transparent und wiederholbar.**

## Main Content

### Current Goal

Erste Befragungswelle `2026-H2` für die 1. und 2. Herrenmannschaft vorbereiten, zugänglichen Google-Forms-Antwortlink validieren und erst nach Datenschutz-/Funktionsprüfung an die Mannschaften verteilen.

### Verified (30.10.2026)

- Der fachliche Fragenkatalog v1.0 ist abgestimmt: 24 feste Bewertungsfragen, fünf optionale Freitexte, optionale Mannschaftsangabe und priorisierte Verbesserungsfelder.
- Wiederholung zweimal pro Saison geplant: November/Dezember und Mai/Juni.
- Neues Projektverzeichnis innerhalb von `TuS Projekte` in Google Drive ist angelegt; separate Verzeichnisse für Fragebogen/Kommunikation, vertrauliche Datenbasis und aggregierte Maßnahmen.
- Ein native Google Doc mit dem Masterfragebogen und eine **nicht freigegebene** Google-Sheets-Datenbasis mit Auswertungsgrundstruktur wurden angelegt.
- Die Verbindung eines produktiven Google-Forms-Formulars mit der Datenbasis ist **noch nicht erfolgt**. Das direkte Google-Forms-Erstellen und öffentliche Freigeben ist mit dem aktuell verbundenen Google-Drive-Werkzeug nicht möglich. Das bereitgestellte `FORMULAR-SETUP.gs` kann dafür mit Google Apps Script im TuS-Konto ausgeführt werden.
- Keine echten Spielerantworten erfasst; keine öffentliche Datenfreigabe vorgenommen.

### Intended Public / Private Boundary

- **Öffentlich / teilnehmendenzugänglich:** ausschließlich der **Google-Forms-Responder-Link**; keine Editorlinks und keine Einsicht in Antwortzusammenfassungen.
- **Privat:** Google-Sheets-Datenbasis, Rohantworten, Freitexte, Formularbearbeitungslink und Auswertungsvorlagen. Zugriff nur für explizit benannte Verantwortliche.
- **Externe Kommunikation:** zusammengefasste, datensparsame Ergebnisse und Verbesserungsmaßnahmen, keine Einzelfälle.
- Der GitHub-Repository-Status `public` ist kein Ort für echte Befragungsdaten.

### Open Gates Before Sending

1. Datenschutzinformationen in verständlicher Form final prüfen: Zweck, Verantwortliche, Löschfristen, Zugriff und Umgang mit kritischem Feedback.
2. Apps Script innerhalb des privaten Master-Sheets einmalig ausführen und die Google-Forms-Verknüpfung kontrollieren.
3. Formulareinstellungen prüfen: kein Login-/E-Mail-Zwang, keine Ergebniseinsicht für Antwortende, keine Bearbeitungsrechte für Dritte.
4. Testeintrag senden und prüfen, dass Rohantworten nur in der privaten Datenbasis erscheinen; Testeintrag anschließend aus dem produktiven Bestand entfernen.
5. Öffentlichen Antwortlink in einem privaten Browserfenster testen.
6. Erst dann den Antwortlink in den beiden Mannschaftsgruppen teilen.

### Next Meaningful Step

`erstelleWelle('2026-H2')` aus `FORMULAR-SETUP.gs` im privaten Google-Sheets-Apps-Script ausführen, Form überprüfen, Datenschutz-/Veröffentlichungsgate abschließen und Starttermin der ersten Welle bestätigen.

### Future Development

Nach jeder Welle maximal drei Maßnahmen, Verantwortliche und Prüftermin festhalten. Wellen durch `erstelleWelle('2027-H1')` usw. neu erzeugen, unveränderte Kernfragen beibehalten, getrennte Roh-Antworttabs und normierte Trenddaten in der privaten Basis verwalten.
