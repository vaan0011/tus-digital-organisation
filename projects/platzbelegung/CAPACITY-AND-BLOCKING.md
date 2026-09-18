# Platzbelegung – Auslastung, Sondertermine und Sperrungen

## Purpose

Dieses Dokument definiert die fachliche Logik für die Auslastungsanalyse der TuS-Trainingsressourcen, die Berücksichtigung von Hallen-Sonderterminen und die Sperrung einzelner Flächen.

Ziel ist, belastbar beantworten zu können:

- Wie stark sind Q1, Q2, Q3, Q4 und das Kunstrasen-Kleinfeld ausgelastet?
- An welchen Tagen und zu welchen Zeiten kann noch eine Trainingsgruppe eingeplant werden?
- Welche Hallen-Sondertermine verändern den regulären Winterplan?
- Welche Ressource ist wegen Pflege, Wetter, Veranstaltung oder anderer Gründe gesperrt?

## Core Principle

> **Freie Kapazität entsteht aus definierter Verfügbarkeit minus Belegungen und Sperrungen – nicht aus einer optisch leeren Kalenderstelle.**

Eine Auslastungsquote ist nur belastbar, wenn für jede Ressource bekannt ist, wann sie grundsätzlich nutzbar ist. Trainings, Spiele, Veranstaltungen, Sondertermine und Sperrungen werden anschließend auf dieselbe Zeitachse projiziert.

## Main Content

### 1. Fachliche Zuständigkeit

Die Systeme bleiben klar getrennt:

- Team Manager → wiederkehrende und einmalige Mannschaftstrainings,
- Matchdaten-Modul → Heimspiele,
- Event Planner → Veranstaltungen und Turniere,
- Platzbelegung → verfügbare Nutzungszeiten, manuelle Sonderbelegungen, Hallen-Sondertermine, Sperrungen und Auslastungsanalyse.

Die Platzbelegung kopiert Trainings, Spiele oder Events nicht in eine zweite manuell gepflegte Datenwelt. Sie liest sie über stabile Referenzen und erzeugt daraus eine gemeinsame Belegungsprojektion.

### 2. Benötigte Objekte

#### `resource_availability_window`

Beschreibt, wann eine Ressource grundsätzlich nutzbar ist.

Mindestens:

- `availability_window_id`,
- `resource_id`,
- `training_period_id` oder anderer Gültigkeitskontext,
- Wochentag,
- Start- und Endzeit,
- Gültig-von und Gültig-bis,
- Status,
- Quelle und letzter Prüfzeitpunkt.

Beispiele sind die regulären nutzbaren Abendstunden eines Quadranten oder die zugewiesenen Hallenzeiten im Winterbetrieb.

#### `occupancy_entry`

Normalisierte, lesende Projektion einer tatsächlichen Belegung.

Mindestens:

- stabile Quellreferenz,
- `resource_id`,
- Beginn und Ende,
- Belegungstyp,
- Quellsystem,
- Status,
- öffentliche Bezeichnung und interne Referenz.

Mögliche Quelltypen:

- Training,
- Heimspiel,
- Event/Turnier,
- Hallen-Sondertermin,
- manuelle Sonderbelegung.

#### `resource_block`

Sperrt eine Ressource einmalig oder wiederkehrend.

Mindestens:

- `resource_block_id`,
- `resource_id`,
- Beginn und Ende oder Wiederholungsregel,
- Sperrgrund-Kategorie,
- Status,
- interne Begründung,
- optionale öffentliche Information,
- Quelle, Ersteller und Änderungszeitpunkt.

Mögliche Kategorien sind beispielsweise Platzpflege, Witterung, Reparatur, Veranstaltung, behördliche Vorgabe oder sonstiger Grund.

#### `resource_special_event`

Bildet einen Hallen- oder Ressourcen-Sondertermin aus einer extern gelieferten Liste ab.

Typen:

- `occupied` – die Ressource ist anderweitig belegt,
- `blocked` – die Ressource darf nicht genutzt werden,
- `additional_availability` – zusätzliche Nutzungszeit außerhalb der regulären Verfügbarkeit.

#### `import_batch`

Dokumentiert den Import einer Sonderterminliste mit Quelldatei, Importzeitpunkt, Zuordnung, Prüfergebnis und einzelnen Fehlern. Dadurch bleiben Wiederholungen und Korrekturen nachvollziehbar.

### 3. Ressourcenhierarchie und Sperrwirkung

Die Ressourcenhierarchie wird bei Belegung und Sperrung berücksichtigt.

- Eine Sperrung von Q1 sperrt nur Q1; Q2 bleibt nutzbar.
- Eine Sperrung von Trainingsfeld 1 sperrt Q1 und Q2.
- Eine Sperrung des gesamten TuS-Sportgeländes sperrt alle untergeordneten Ressourcen im Zeitraum.
- Eine Sperrung der Schönbornhalle oder Ohrenberghalle sperrt alle später konfigurierten Hallenteilflächen.
- Das Kunstrasen-Kleinfeld wird als eigenständige Ressource ausgewertet und gesperrt.

Eltern- und Kindressourcen dürfen nicht widersprüchlich gleichzeitig als frei und gesperrt gelten.

### 4. Berechnung der Auslastung

Für eine Ressource und einen Auswertungszeitraum werden Zeitmengen als Vereinigungen von Intervallen berechnet. Überlappungen werden nicht doppelt gezählt.

Begriffe:

- `Brutto-Verfügbarkeit` = grundsätzlich nutzbare Minuten,
- `Belegt` = Minuten mit bestätigten Trainings, Spielen, Events oder belegenden Sonderterminen,
- `Gesperrt` = Minuten mit aktiver Sperrung oder blockierendem Sondertermin,
- `Frei` = Brutto-Verfügbarkeit minus Vereinigung aus Belegt und Gesperrt.

Kennzahlen:

- Nutzungsquote = Belegt / Brutto-Verfügbarkeit,
- Sperrquote = Gesperrt / Brutto-Verfügbarkeit,
- freie Kapazität = Frei / Brutto-Verfügbarkeit.

Sperrzeiten erhöhen nicht künstlich die Nutzungsquote. Sie werden separat ausgewiesen, reduzieren aber die tatsächlich buchbare Restkapazität.

Fehlt für eine Ressource die Brutto-Verfügbarkeit, darf keine Prozentquote ausgegeben werden. Das System zeigt dann `Verfügbarkeitsrahmen fehlt` statt einer scheinbar genauen Zahl.

### 5. Auswertungen

Die interne Auslastungsanalyse unterstützt mindestens:

- Q1, Q2, Q3 und Q4 einzeln,
- Trainingsfeld 1 und 2 als abgeleitete Gesamtsicht,
- Kunstrasen-Kleinfeld,
- Schönbornhalle und Ohrenberghalle sowie später konfigurierte Hallenteilflächen,
- Außen- und Winterbetrieb getrennt,
- Auswahl nach Woche, Trainingsperiode oder frei wählbarem Zeitraum.

Je Ressource werden angezeigt:

- verfügbare Stunden,
- belegte Stunden und Nutzungsquote,
- gesperrte Stunden und Sperrquote,
- freie Stunden,
- zusammenhängende freie Zeitfenster,
- Konflikte oder unklare Quelldaten.

Eine kompakte Wochenmatrix zeigt je Wochentag, wann die Ressource frei, belegt oder gesperrt ist.

### 6. Suche nach freien Trainingsfenstern

Die Suche erhält mindestens:

- gewünschte Dauer,
- Trainingsperiode bzw. Datumsbereich,
- mögliche Wochentage,
- früheste Start- und späteste Endzeit,
- benötigte Ressourcenart,
- benötigte Kapazität, zum Beispiel ein Quadrant, zwei Quadranten, ganzes Trainingsfeld, Kunstrasen oder Halle.

Das Ergebnis listet passende freie Zeitfenster sortiert nach Tag und Beginn. Es ist eine Entscheidungshilfe und plant keine Mannschaft automatisch ein.

Für mehrere gleichzeitig benötigte Quadranten muss das Zeitfenster auf allen benötigten Ressourcen vollständig frei sein.

### 7. Hallen-Sonderterminlisten

Sondertermine aus einer gelieferten Liste werden nicht ungeprüft direkt veröffentlicht.

Der Importablauf lautet:

1. Datei oder Liste auswählen,
2. Spalten bzw. Felder zuordnen,
3. Datum, Uhrzeit, Halle/Ressource und Terminart validieren,
4. Dubletten anhand externer ID oder stabiler Quellmerkmale erkennen,
5. Vorschau mit neuen, geänderten und fehlerhaften Zeilen anzeigen,
6. fachlich bestätigen,
7. bestätigte Termine als `resource_special_event` übernehmen,
8. Auslastung und freie Zeitfenster neu berechnen.

Mindestens benötigte Eingangsdaten:

- Halle oder Ressource,
- Datum,
- Startzeit,
- Endzeit,
- Bezeichnung,
- Art der Auswirkung `occupied`, `blocked` oder `additional_availability`,
- optionale Quellkennung.

Das konkrete Dateiformat wird an der ersten realen Liste verifiziert. Tabellen, PDF- oder Scan-Auslesungen benötigen immer eine Importvorschau und Bestätigung; unsichere Zeilen werden nicht automatisch übernommen.

### 8. Sperrungen

Eine berechtigte Person kann sperren:

- einen einzelnen Quadranten,
- mehrere ausgewählte Quadranten,
- ein ganzes Trainingsfeld,
- das Kunstrasen-Kleinfeld,
- eine Halle oder Hallenteilfläche,
- einen gesamten Standort.

Sperrungen können sein:

- einmalig mit Beginn und Ende,
- ganztägig,
- wiederkehrend in einem Zeitraum,
- bis auf Widerruf mit klar sichtbarem Status.

Vor dem Speichern zeigt das System betroffene Trainings, Spiele und Veranstaltungen an. Eine Sperrung löscht oder verschiebt diese Belegungen nicht automatisch, sondern erzeugt einen sichtbaren Konflikt, der fachlich gelöst werden muss.

Aufheben oder Ändern einer Sperrung bleibt mit Zeitpunkt und verantwortlicher Person nachvollziehbar.

### 9. Priorität und Konflikte

Für die effektive Verfügbarkeit gilt:

1. aktive Sperrung oder blockierender Sondertermin,
2. bestätigte Belegung aus Training, Spiel, Event oder Sondertermin,
3. vorgemerkte bzw. noch nicht bestätigte Belegung,
4. reguläre Verfügbarkeit.

Eine zusätzliche Verfügbarkeit erweitert den nutzbaren Rahmen, hebt aber keine aktive Sperrung auf.

Entstehen widersprüchliche Belegungen, werden sie als Konflikt angezeigt. Sie werden weder stillschweigend priorisiert noch in der Auslastungsanalyse doppelt gezählt.

### 10. Sichtbarkeit und Datenschutz

Die detaillierte Auslastungsanalyse, internen Sperrgründe, Importfehler und Planungsvorschläge sind geschützt.

Die öffentliche Ansicht darf reduzierte Informationen wie `frei`, `belegt`, `gesperrt`, Zeitraum und öffentliche Bezeichnung anzeigen. Interne Notizen, Verantwortliche oder nicht freigegebene Quelldaten werden nicht veröffentlicht.

### 11. MVP

Ein erstes testbares Inkrement umfasst:

1. Verfügbarkeitsfenster je Q1–Q4 und Kunstrasen-Kleinfeld,
2. Übernahme bestätigter Trainingsserien aus dem Team Manager,
3. einmalige und wiederkehrende Ressourcensperrungen,
4. manuelle Erfassung eines Hallen-Sondertermins,
5. Importvorschau für eine reale Sonderterminliste,
6. Wochenmatrix frei/belegt/gesperrt,
7. Kennzahlen je Ressource,
8. Suche nach freien Fenstern für eine gewünschte Trainingsdauer.

Automatische Neuplanung oder Verschiebung von Mannschaften ist kein Bestandteil dieses MVP.

### 12. Abnahmekriterien

Der fachliche Kern ist erfüllt, wenn:

- eine Sperrung von Q1 Q2 nicht blockiert,
- eine Sperrung von Trainingsfeld 1 Q1 und Q2 blockiert,
- ein Hallen-Sondertermin sofort die freie Kapazität reduziert,
- zusätzliche Hallenzeit die Verfügbarkeit erweitert,
- überlappende Belegungen nicht doppelt gezählt werden,
- ohne definierten Verfügbarkeitsrahmen keine irreführende Quote erscheint,
- die Suche nur durchgehend freie Zeitfenster zurückgibt,
- Außen- und Winterperiode getrennt ausgewertet werden,
- jede importierte oder manuell gepflegte Ausnahme auf ihre Quelle zurückgeführt werden kann.

## Relationship to other documents

- `README.md`
- `PROJECT-STATE.md`
- `../team-manager/DATA-STANDARD.md`
- `../team-manager/FUNCTIONAL-SCOPE.md`
- `../team-manager/SEASON-2026-27.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../../decisions/ADR-0013-shared-team-identity-and-season-model.md`
- `../../design/ui-standard.md`

## Future Development

Nach Prüfung der ersten realen Hallen-Sonderterminliste werden Importformat, Feldzuordnung und Fehlerbehandlung konkretisiert. Später können Vorschläge für alternative Ressourcen oder Zeiten ergänzt werden; eine automatische Umplanung benötigt eine eigene Freigabe und bleibt bis dahin außerhalb des Scopes.
