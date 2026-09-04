# Team Manager – Functional Scope

## Purpose

Dieses Dokument beschreibt das fachliche Zielbild des TuS Team Managers.

Der Team Manager soll die heute auf viele WordPress-Seiten, Listen und manuelle Suchvorgänge verteilte Pflege von Mannschaftsinformationen, Trainingsdaten und Spielankündigungen durch eine zentrale, verlässliche Datenbasis ersetzen.

Ziel ist insbesondere, den hohen jährlichen Pflegeaufwand zum Saisonwechsel zu reduzieren und Informationen dort zu pflegen, wo sie fachlich hingehören: bei der Mannschaft, der Saison, dem Training oder dem Spielbetrieb – nicht mehrfach auf einzelnen Homepage-Seiten.

## Core Principle

**Eine Mannschaft ist die gemeinsame fachliche Quelle für ihre saisonbezogenen Informationen und öffentlichen Darstellungen.**

Mannschaftsdaten werden zentral gepflegt. Die Homepage rendert daraus öffentliche Mannschaftsseiten, Trainingsinformationen und weitere Ansichten.

Saisonabhängige Werte werden soweit möglich aus Regeln und vorhandenem Kontext abgeleitet. Manuelle Pflege bleibt nur dort nötig, wo tatsächlich eine fachliche Änderung vorliegt.

## Main Content

### 1. Mannschaften als zentrale Datenobjekte

Das System verwaltet die TuS-Mannschaften zentral.

Je nach Mannschaft bzw. Saison sollen insbesondere folgende Informationen gepflegt werden können:

- Mannschaftsname und öffentliche Bezeichnung,
- Alters-/Wettbewerbsklasse,
- Saison,
- relevante Jahrgänge,
- Trainer und Betreuer,
- öffentliche Kontaktinformationen,
- Trainingszeiten,
- Trainingsorte bzw. Trainingsflächen,
- optionale Mannschaftsbilder oder weitere öffentliche Inhalte,
- externe Zuordnung zum Spielbetrieb, insbesondere für fussball.de.

Nicht jede Information ist dauerhaft. Trainer, Kontakte, Trainingszeiten oder Spielgemeinschaften können sich von Saison zu Saison ändern und müssen historisch nachvollziehbar bleiben.

### 2. Saisonmodell und automatische Jahrgänge

Die Saison wird als eigenes fachliches Konzept geführt, zum Beispiel `2026/27` oder `2027/28`.

Bei Jugendmannschaften sollen die zugehörigen Jahrgänge aus Mannschaftsklasse und Saison automatisch vorgeschlagen bzw. berechnet werden.

Referenzbeispiel:

- B-Junioren, Saison `2026/27` → Jahrgänge `2010/2011`,
- B-Junioren, Saison `2027/28` → Jahrgänge `2011/2012`.

Die Regel soll nicht jedes Jahr auf jeder Homepage-Seite neu eingetragen werden müssen.

Dabei gilt:

- die automatische Ableitung ist der Standard,
- Sonderfälle müssen manuell überschreibbar sein,
- eine Änderung der aktiven Saison darf historische Mannschaftsdaten nicht rückwirkend überschreiben,
- die genaue Altersklassen-/Jahrgangslogik wird vor Implementierung als fachliche Tabelle bzw. Regelwerk verifiziert.

### 3. Saisonwechsel

Der jährliche Saisonwechsel soll weitgehend vorbereitet werden können, ohne alle Mannschaftsseiten manuell neu anzufassen.

Das System soll insbesondere unterstützen:

- neue Saison anlegen bzw. aktivieren,
- bestehende Mannschaftsstrukturen als Ausgangspunkt übernehmen,
- Jahrgänge automatisch fortschreiben,
- saisonabhängige Angaben gezielt prüfen,
- Trainer, Kontakte, Trainingszeiten und Zuordnungen nur dort ändern, wo sich tatsächlich etwas geändert hat,
- neue Saison erst nach fachlicher Prüfung veröffentlichen.

Ziel ist kein blindes automatisches Umschalten, sondern eine vorbereitete, kontrollierbare Saisonfortschreibung.

### 4. Öffentliche Mannschaftsseiten

Für jede veröffentlichte Mannschaft stellt das Plugin im öffentlichen Bereich der Homepage eine konsistente Mannschaftsseite bzw. wiederverwendbare Darstellung bereit.

Die Seite kann je nach Mannschaft insbesondere anzeigen:

- Mannschaftsname,
- Saison und Jahrgänge,
- Trainer/Betreuer,
- freigegebene Kontaktdaten,
- Trainingszeiten,
- Trainingsort,
- nächste Spiele,
- weitere später definierte Mannschaftsinhalte.

Die öffentliche Darstellung wird aus den zentralen Daten generiert. Sie darf nicht verlangen, dieselben Kerndaten zusätzlich auf einer separaten WordPress-Seite händisch zu pflegen.

Die genaue technische Einbindung – dynamische Seite, Block, Shortcode oder Template – wird erst bei der Implementierung festgelegt und muss dem gemeinsamen TuS-UI-System folgen.

### 5. Kontakte und Veröffentlichung

Trainer- und Betreuerinformationen können personenbezogene Daten enthalten.

Deshalb wird zwischen internen Daten und öffentlich freigegebenen Angaben unterschieden.

Das System soll nur ausdrücklich für die öffentliche Darstellung vorgesehene Kontaktinformationen auf der Homepage ausgeben.

Eine spätere gemeinsame Personen-/Kontaktquelle ist möglich, wird aber nicht ohne Architekturentscheidung parallel neu aufgebaut.

### 6. Spielinformationen und fussball.de

Spielinformationen sind bereits im offiziellen Spielbetrieb gepflegt und sollen nicht nochmals manuell auf der Homepage erfasst werden müssen.

Ziel ist eine automatisierte bzw. weitgehend automatisierte Übernahme der relevanten Spielinformationen je Mannschaft.

Mindestens vorgesehen sind:

- Zuordnung einer TuS-Mannschaft zu ihrer externen Mannschaft bzw. Kennung,
- nächste Spiele,
- Datum und Uhrzeit,
- Heim-/Auswärtssituation,
- Gegner,
- Spielort, soweit verfügbar,
- Wettbewerb bzw. Staffel, soweit für die Darstellung sinnvoll,
- zuverlässige Aktualisierung der Homepage-Ankündigungen.

Der konkrete technische Zugriffsweg auf fussball.de ist **noch nicht entschieden**.

Vor Implementierung wird geprüft, welche stabile, zulässige und wartbare Schnittstelle, Einbettung oder Datenquelle verfügbar ist. Eine fragile Scraping-Lösung wird nicht ohne vorherige Prüfung zum Standard gemacht.

Für die spätere technische Umsetzung gilt als Ziel:

- Spielinformationen lokal bzw. kontrolliert synchronisieren statt bei jedem Seitenaufruf live von einer externen Quelle abhängig zu sein,
- letzten erfolgreichen Aktualisierungsstand nachvollziehbar machen,
- bei einem vorübergehenden Ausfall nicht sofort die öffentliche Darstellung verlieren,
- externe Identifikatoren zentral pro Saison/Mannschaft pflegen.

### 7. Homepage-Spielankündigungen

Aus den synchronisierten Spielinformationen sollen automatisch öffentliche Ansichten erzeugt werden können.

Dazu gehören insbesondere:

- nächste Spiele einer einzelnen Mannschaft,
- nächste TuS-Spiele über mehrere Mannschaften hinweg,
- Homepage-Kacheln bzw. Spielankündigungen,
- später gegebenenfalls Filter nach Herren, Frauen, Jugend oder Zeitraum.

Ziel ist, dass ein Spielplan nicht mehr händisch auf fussball.de gesucht und in die Homepage kopiert werden muss.

### 8. Trainingszeiten

Trainingszeiten werden zentral an der jeweiligen Mannschaft gepflegt und nicht zusätzlich auf mehreren Homepage-Seiten.

Eine Trainingseinheit bzw. regelmäßige Trainingszeit soll mindestens Bezug haben zu:

- Mannschaft,
- Wochentag,
- Startzeit,
- Endzeit,
- Trainingsstätte,
- konkreter Fläche bzw. Teilfläche, sofern relevant,
- Gültigkeitszeitraum bzw. Saison-/Winterbezug,
- optionalen Hinweisen.

Wiederkehrende Trainingszeiten und einmalige Sondertermine müssen getrennt abbildbar sein.

### 9. Trainingsstätten und Flächen

Trainingsstätten werden zentral als Ressourcen gepflegt.

Zum bekannten Nutzungskontext gehören insbesondere:

- zwei Trainingsfelder beim TuS Mingolsheim,
- deren Aufteilung in nutzbare Teilflächen/Quadranten,
- ein Kleinspielfeld mit Kunstrasen für den Winterbetrieb,
- Ohrenberghalle,
- Schönbornhalle,
- externe Trainingsstätten bei Partnervereinen.

Aktuell bekannte externe Nutzungen sind unter anderem:

- C-Junioren beim VfR Kronau,
- B-Junioren beim TSV Langenbrücken.

Diese Angaben sind fachliche Ausgangsdaten und müssen später konfigurierbar bleiben; sie dürfen nicht als dauerhaft unveränderliche Programmlogik eingebaut werden.

Die genaue Benennung und Anzahl der Teilflächen der beiden TuS-Trainingsfelder wird bei der späteren Einrichtung als konfigurierbare Ressourcen festgelegt.

### 10. Platz- und Hallenbelegung

Aus den zentral gepflegten Trainingszeiten soll automatisch eine Belegungsübersicht entstehen.

Das System soll insbesondere unterstützen:

- Belegung nach Wochentag und Uhrzeit,
- Darstellung je Trainingsstätte,
- Darstellung je Teilfläche/Quadrant,
- parallele Belegung verschiedener Teilflächen,
- Erkennen offensichtlicher Doppelbelegungen,
- saisonale bzw. winterliche Belegungspläne,
- Veröffentlichung einer verständlichen Trainingsübersicht.

Die Belegungsplanung ist damit keine zweite Datenpflege, sondern eine andere Sicht auf dieselben Trainingsdaten.

### 11. Sondertermine und Hallenzeiten

Neben festen wöchentlichen Trainingszeiten gibt es insbesondere im Hallenbetrieb zusätzliche, unregelmäßige Zeitfenster.

Das System soll deshalb auch einmalige Sondertermine verwalten können.

Beispiele:

- zusätzlich verfügbare Hallenzeit,
- einmalige Verlegung,
- Zusatztraining,
- Ausfall eines regulären Termins,
- Tausch einer Fläche oder Halle.

Sondertermine dürfen den normalen Trainingsplan nicht unnötig kompliziert machen. Sie werden als Ausnahme zum wiederkehrenden Grundplan geführt.

### 12. Historie

Saisonwechsel dürfen alte Informationen nicht einfach überschreiben.

Das System soll später nachvollziehbar machen können:

- welche Mannschaften es in einer Saison gab,
- welche Jahrgänge zugeordnet waren,
- wer Trainer/Betreuer war,
- wann und wo trainiert wurde,
- welche externen Spielzuordnungen galten,
- welche Mannschaftsseite in dieser Saison fachlich zugrunde lag.

Damit wird auch die Übergabe an neue Jugendleiter, Trainer und Homepage-Verantwortliche einfacher.

### 13. Beziehung zum Event Planner

Der Event Planner weist Helferschichten künftig auch Mannschaften oder Abteilungen zu.

Deshalb darf der Team Manager keine isolierte Mannschaftsliste erzeugen, die im Event Planner nochmals separat gepflegt werden muss.

Vor der Implementierung wird architektonisch entschieden, wie eine gemeinsam nutzbare Mannschaftsidentität bereitgestellt wird.

Arbeitshypothese:

- Mannschaften sind fachlich geteilte Stammdaten,
- saisonbezogene Mannschaftsinformationen gehören zum Team-Management,
- andere Module referenzieren dieselbe Mannschaftsidentität.

Diese Arbeitshypothese ist noch keine Architekturfreigabe und muss vor der Implementierung gegen die Plattformarchitektur geprüft werden.

### 14. Vereinfachungsregeln

Für alle Erweiterungen gelten folgende Leitplanken:

- eine Information nur einmal fachlich pflegen,
- keine WordPress-Seite als zweite Datenbank verwenden,
- saisonabhängige Werte aus Regeln und Vorjahresdaten ableiten, wo dies sicher möglich ist,
- Sonderfälle überschreibbar halten,
- historische Saisons nicht durch aktuelle Änderungen zerstören,
- Trainingsplan und Platzbelegung aus denselben Daten erzeugen,
- öffentliche Daten klar von internen bzw. personenbezogenen Daten trennen,
- externe Datenquellen robust anbinden und Ausfälle beherrschbar machen,
- keine unnötigen Felder oder komplexen Workflows einführen.

### 15. Erfolgskriterien des Gesamtmoduls

Das Zielbild ist erreicht, wenn der saisonale Pflegeaufwand deutlich sinkt und dieselben Informationen nicht mehr auf vielen Seiten einzeln geändert werden müssen.

Insbesondere soll es möglich sein:

- eine Mannschaft zentral zu pflegen,
- eine neue Saison kontrolliert vorzubereiten,
- Jugendjahrgänge automatisch fortzuschreiben,
- Mannschaftsseiten automatisch aus zentralen Daten bereitzustellen,
- nächste Spiele ohne Copy-and-Paste auf der Homepage anzuzeigen,
- Trainingszeiten einmal zentral zu pflegen,
- daraus Trainingsplan und Platz-/Hallenbelegung zu erzeugen,
- reguläre und einmalige Trainingszeiten gemeinsam nachvollziehbar zu verwalten,
- historische Saisondaten später zuverlässig wiederzufinden.

## Relationship to other documents

- `README.md` beschreibt Einstieg und Arbeitsweise des Projekts.
- `PROJECT-STATE.md` beschreibt den aktuellen Projektstand und die offenen Vorentscheidungen.
- `../event-planner/FUNCTIONAL-SCOPE.md` beschreibt die Nutzung von Mannschaften im Event Planner.
- `../../architecture/platform-architecture.md` ist für die Entscheidung über gemeinsam genutzte Mannschaftsdaten relevant.
- `../../design/ui-standard.md` definiert gemeinsame UI-Muster.
- `../../roles/wordpress-developer/development-standard.md` definiert den technischen Entwicklungsstandard.

Dieses Dokument ist die fachliche Quelle für den langfristig vorgesehenen Funktionsumfang des Team Managers. Es ersetzt keine einzelne technische Spezifikation und keine Architekturentscheidung.

## Future Development

Vor der Implementierung ist folgende Reihenfolge sinnvoll:

1. fachliches Mannschafts- und Saisonmodell konkretisieren,
2. Altersklassen-/Jahrgangsregeln verifizieren,
3. gemeinsame Mannschaftsidentität mit Event Planner architektonisch entscheiden,
4. Trainingsstätten, Teilflächen, wiederkehrende Zeiten und Sondertermine als einfaches Ressourcenmodell konkretisieren,
5. technischen Zugriffsweg auf fussball.de prüfen,
6. erst danach ein kleines erstes Plugin-Inkrement entwickeln,
7. öffentliche Mannschaftsseite und Saisonwechsel schrittweise aufbauen,
8. Spiel-Synchronisation und Trainings-/Belegungsansichten anschließend ergänzen.

Die Reihenfolge ist eine Orientierung. Die Umsetzung bleibt in kleinen, testbaren Pull Requests.
