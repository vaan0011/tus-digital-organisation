# TuS Spielerbarometer – Project State

## Purpose

Operativer Projekt-Checkpoint für den Aufbau und die wiederkehrende Durchführung des halbjährlichen Spielerbarometers.

## Core Principle

**Teilnahme für Spieler einfach; Rücklauf vertraulich; Handlungsergebnisse transparent und wiederholbar.**

## Main Content

### Current Goal
Erste Welle `2026-H2` als bestehendes Google Form v1.1 (31 Bewertungsfragen, 6 Freitextfragen) datensparsam erproben; die private Auswertung und Datenschutzfreigabe prüfen, ehe der Link breit an die Mannschaften verteilt wird.

### Verified (31.10.2026)
- Das bestehende Google Form wurde per gebundenem Apps Script v1.1 aktualisiert; das Ausführungsprotokoll bestätigt am 31.10.2026 um 18:36 Uhr `ERFOLG: Formular v1.1 aktualisiert.`; der zweite Reparaturlauf hat keine Elemente dupliziert und bestehende Antworten erhalten.
- Fachlicher Umfang: 24 ursprüngliche Bewertungsfragen, davon Q04 und Q05 mit aktualisiertem Wortlaut, sieben neue Aussagen zu Trainerteam (T01–T03) und Spieltag (S01–S04), sowie sechs optionale Freitexte (F01–F06), optionale Mannschaftsangabe und Priorisierung.
- Die ausdrücklich ausgeschlossenen Fragen zu Torwarttraining/Torwarttrainer werden **nicht** erhoben, da eine Anonymisierung bei wenigen Torhütern nicht sichergestellt wäre.
- Bewertungsoptionen sind als fünf ausgeschriebene Zustimmungsstufen (1 bis 5) umgesetzt; Fragen können übersprungen werden.
- Google Forms schreibt in das private Antworttab `Formularantworten 1`. Die sieben neuen Bewertungen und F06 erscheinen dort in zusätzlichen Spalten, unabhängig von der visuellen Reihenfolge der Fragen. Die zuvor erfassten Antworten sind erhalten geblieben.
- Im privaten Sheet `ANTWORTEN_IMPORT` übernehmen neue Formelspalten `AJ:AQ` die Felder T01–T03, S01–S04 und F06; die v1.0-Daten bleiben unverändert.
- `AUSWERTUNG` enthält die zusätzlichen Kennzahlen `Ø Trainerteam` (J) und `Ø Spieltag` (K). Die Kennzahl eines Bereichs wird nur gezeigt, wenn **jede** darin enthaltene Bewertungsfrage von wenigstens sieben Antwortenden derselben Mannschaft und Welle beantwortet wurde. Die bestehende Kernkennzahl `Ø Gesamt` bezieht sich weiterhin nur auf Q01–Q24, um die Zeitreihe nicht unbeabsichtigt zu verändern.
- Q04 und Q05 haben mit v1.1 eine neue Bedeutung beziehungsweise Formulierung; sie dürfen nicht ohne Vorbehalt mit älteren Wellen verglichen werden.
- Eine aktuelle **Testantwort nach dem Umbau**, die tatsächlich durch die neuen Auswertungsspalten läuft, sowie die formale Datenschutz-/Teilnehmerzugriffsprüfung stehen noch aus.


### Intended Public / Private Boundary

- **Öffentlich / teilnehmendenzugänglich:** ausschließlich der **Google-Forms-Responder-Link**; keine Editorlinks und keine Einsicht in Antwortzusammenfassungen.
- **Privat:** Google-Sheets-Datenbasis, Rohantworten, Freitexte, Formularbearbeitungslink und Auswertungsvorlagen. Zugriff nur für explizit benannte Verantwortliche.
- **Externe Kommunikation:** zusammengefasste, datensparsame Ergebnisse und Verbesserungsmaßnahmen, keine Einzelfälle.
- Der GitHub-Repository-Status `public` ist kein Ort für echte Befragungsdaten.

### Open Gates Before Sending
1. Formularvorschau auf Mobilgerät und Desktop prüfen: genau sieben neue Trainer-/Spieltagaussagen plus ein neuer Freitext; keine Torwartfragen; alle 31 Bewertungsfragen mit fünf Optionen.
2. Testantwort nach v1.1 abgeben und sicherstellen, dass T01–T03, S01–S04 und F06 in `Formularantworten 1` und `ANTWORTEN_IMPORT` korrekt ankommen.
3. Datenschutztext und Einstellungen kontrollieren: keine E-Mail-Erfassung, keine ungewollte Anmeldung, keine Einsicht in Antworten oder Bearbeitungsrechte, keine Nennung sensibler Vorfälle in Freitext.
4. Bereits vorhandene interne Antwortdatensätze überprüfen, bevor etwas gelöscht oder in die produktive Statistik übernommen wird; keine pauschale Löschung annehmen.
5. Öffentlich nur zusammengefasste, hinreichend große Auswertungen; Freitexte nicht roh weitergeben. Erst nach Prüfung den Link breit verteilen.

### Next Meaningful Step
Eine explizite Testantwort **nach v1.1** aus der Formularvorschau einreichen, neue Datenfelder und das datenschutzkonforme Auswertungsverhalten verifizieren, den Testdatensatz dann bewusst behandeln und die Welle freigeben.

### Future Development

Nach jeder Welle maximal drei Maßnahmen, Verantwortliche und Prüftermin festhalten. Wellen durch `erstelleWelle('2027-H1')` usw. neu erzeugen, unveränderte Kernfragen beibehalten, getrennte Roh-Antworttabs und normierte Trenddaten in der privaten Basis verwalten.
