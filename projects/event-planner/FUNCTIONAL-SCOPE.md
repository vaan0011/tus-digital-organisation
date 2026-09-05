# Event Planner – Functional Scope

## Purpose

Dieses Dokument beschreibt das fachliche Zielbild des TuS Event Planners.

Der Event Planner soll die heute verteilte Zettel-, Listen- und Einzeldatei-Arbeit rund um Veranstaltungen durch einen verlässlichen, wiederverwendbaren und nachvollziehbaren digitalen Arbeitsablauf ersetzen.

Er ist damit nicht nur ein Turnierplaner, sondern das zentrale Werkzeug zur Planung, Durchführung, Nachbereitung und späteren Rekonstruktion von TuS-Veranstaltungen.

## Core Principle

**Ein Event ist die gemeinsame fachliche Klammer für alle zugehörigen Planungsdaten.**

Programm, Turniere, Aufgaben, Helfer, Schichten, Bestellungen, Ausgaben und Auswertungen sollen nicht in getrennten Datenwelten gepflegt werden, sondern auf dasselbe Event Bezug nehmen.

Informationen werden möglichst nur einmal erfasst. Wiederkehrende Veranstaltungen nutzen Vorlagen und vorhandene Erfahrungswerte, statt jedes Jahr bei null zu beginnen.

Das Ziel ist Vereinfachung: weniger Zettel, weniger doppelte Eingaben, weniger Wissen in einzelnen Köpfen und eine bessere Übergabe an nachfolgende Generationen.

## Main Content

### 1. Events als zentrale Planungseinheit

Der Event Planner verwaltet unterschiedliche Veranstaltungsformen unter einem gemeinsamen Grundmodell.

Dazu gehören insbesondere:

- allgemeine TuS-Veranstaltungen,
- Fußballcamps,
- Sportfeste,
- mehrtägige Veranstaltungen,
- Veranstaltungen mit eingebetteten Turnieren.

Ein Event enthält mindestens seine Stammdaten, Veranstaltungstage, Programmübersicht und den Status der Planung.

Weitere Funktionen werden an dieses Event angebunden, statt unabhängig daneben zu entstehen.

### 2. Programm und Turniere

Innerhalb eines Events können Veranstaltungstage und Programmpunkte geplant werden.

Turniere können eigenständig oder als Bestandteil eines Events geführt und mit dem Veranstaltungsablauf verknüpft werden.

Ziel ist eine gemeinsame zeitliche Sicht auf das Event, ohne Turnierlogik und allgemeine Programmpunkte künstlich miteinander zu vermischen.

Turniere bleiben fachlich separat, weil sie eigene Teams, Gruppen, Spielpläne, Ergebnisse und öffentliche Turnieransichten benötigen.

### 3. Fußballcamps

Fußballcamps sind eine spezialisierte Event-Art und nutzen das gemeinsame Event-Grundmodell.

Dadurch stehen auch für Camps zur Verfügung:

- Zeitraum,
- Veranstaltungs-/Trainingsort,
- Tagesablauf und Programmpunkte,
- Aufgaben/Checklisten,
- Helferschichten, falls relevant,
- spätere Historie.

Zusätzlich benötigt ein Camp camp-spezifische Informationen, insbesondere:

- Ausrichter / Anbieter,
- öffentliche Camp-Beschreibung,
- Teilnehmerzahl bzw. Teilnehmerlimit, sofern relevant,
- Preis-/Teilnahmeinformationen,
- Trainingsort,
- Buchungsart,
- Anmelde-/Buchungsweg.

Mindestens drei Buchungsfälle müssen möglich sein:

- **interne Anmeldung/Buchung** über eine vom TuS bereitgestellte Camp-Seite,
- **externe Buchung** über den Ausrichter mit externem Link,
- **keine Buchung** für reine Informationsfälle.

Ein externer Anbieter mit eigener Buchungsplattform wird nicht in eine parallele TuS-Buchungslogik gezwungen.

Die öffentliche Camp-Seite soll später aus denselben gepflegten Camp-Daten erzeugt werden und nicht zusätzlich als manuell gepflegte WordPress-Seite entstehen.

### 4. Aufgaben und organisatorische Checklisten

Veranstaltungsorganisation besteht nicht nur aus Programm und Helferschichten.

Das Event-Modul soll deshalb echte Organisationsaufgaben verwalten können.

Typische Aufgaben sind beispielsweise:

- Catering bestellen,
- Foodtruck anfragen/bestätigen,
- Ausschankgenehmigung beantragen,
- Pilswagen bestellen,
- Kassen/Wechselgeld vorbereiten,
- Material organisieren,
- Lieferungen koordinieren,
- Beschilderung vorbereiten,
- Ansprechpartner bestätigen,
- sonstige veranstaltungsspezifische Aufgaben.

Aufgaben können:

- manuell angelegt,
- aus Event-Templates übernommen,
- später aus bewährten Vorjahresveranstaltungen wiederverwendet werden.

Eine Aufgabe benötigt zunächst nur so viel Struktur wie praktisch notwendig:

- Event-Bezug,
- Titel,
- optional Kategorie,
- optional Fälligkeit,
- optional Verantwortlichkeit,
- Status offen/erledigt,
- Herkunft manuell/template/system.

Systemhinweise wie `Helferplätze offen`, `Programm fehlt` oder `Spielplan fehlt` können zusätzlich als automatisch erzeugte Hinweise in die operative Aufgabenansicht einfließen, ersetzen aber die echten Organisationsaufgaben nicht.

### 5. Helferbedarf und Helferschichten

Für Events wird der konkrete Helferbedarf geplant.

Daraus können Schichten entstehen, die anschließend Personen, Mannschaften, Gruppen oder Abteilungen zugeordnet werden.

Das System soll insbesondere ermöglichen:

- benötigte Helfer je Tag, Bereich und Zeitraum zu definieren,
- Schichten zu erzeugen und zu bearbeiten,
- Schichten einzelnen Personen zuzuweisen,
- Schichten Mannschaften oder Abteilungen zur Besetzung zuzuweisen,
- Soll- und Ist-Besetzung sichtbar zu machen,
- offene Bedarfe frühzeitig zu erkennen,
- tatsächlich geleistete Hilfe nachvollziehbar zu bestätigen.

### 6. Helferlisten und tatsächlich geleistete Zeiten

Der Event Planner bleibt die fachliche Quelle für den **konkreten Einsatz am Event**.

Er dokumentiert insbesondere:

- wer bei welchem Event geholfen hat,
- in welcher Schicht oder Aufgabe,
- welche Zeit geplant war,
- welche Zeit tatsächlich geleistet und bestätigt wurde.

Die personenzentrierte Jahres-/Periodensicht gehört dagegen zum Projekt `member-engagement`.

Dort werden die bestätigten Event-Einsätze zusammengeführt, um zu beantworten:

- wie viele anerkannte Stunden eine Person im Bemessungszeitraum hat,
- wie weit das Helfersoll erfüllt ist,
- wer die Rabatt-Berechtigung erreicht hat,
- wem nur noch wenige Stunden fehlen.

Damit entsteht keine zweite parallele Stundenlogik im Event Planner.

### 7. Beitragsnachlass bei erfülltem Helfersoll

Der Event Planner liefert die belastbaren Rohdaten: bestätigte Helfereinsätze und tatsächlich geleistete Zeiten.

Das Mitglieder-/Engagement-Modul ermittelt daraus die personenzentrierte Soll-/Ist-Sicht und eine mögliche Rabatt-Berechtigung.

Dabei gilt:

- die konkrete Sollstundenzahl ist eine konfigurierbare fachliche Regel,
- Art und Höhe des Nachlasses sind eine gesondert festzulegende Vereinsregel,
- eine tatsächliche Beitragsänderung erfolgt nicht automatisch, solange dafür kein ausdrücklich beschlossener Finanz-/Mitgliederprozess existiert,
- die fachliche Quelle für die Jahresauswertung ist `member-engagement`, nicht eine zweite Event-Planner-Auswertung.

Der Event Planner kann später eine kompakte Zusammenfassung oder einen Absprung auf diese Auswertung anzeigen, ohne die Logik zu duplizieren.

### 8. Bestellungen für Veranstaltungen

Bestellungen und Beschaffungen sollen direkt am Event gepflegt werden können.

Ziel ist, wiederkehrende Material-, Getränke-, Lebensmittel- oder sonstige Beschaffungslisten nicht jedes Mal neu und außerhalb des Systems anzulegen.

Mindestens relevant sind:

- was wird benötigt,
- Menge,
- Verantwortlichkeit,
- Lieferant oder Bezugsquelle, sofern relevant,
- Bestell-/Erledigungsstatus,
- erwartete oder tatsächliche Kosten, sofern bekannt.

Die genaue Detailtiefe wird nur so weit ausgebaut, wie sie die reale Veranstaltungsarbeit vereinfacht.

### 9. Ausgaben und Eventkosten

Ausgaben sollen einem konkreten Event zugeordnet und nachvollziehbar dokumentiert werden können.

Ziel ist keine vollständige Vereinsbuchhaltung, sondern eine verlässliche veranstaltungsbezogene Kostensicht.

Das Modul soll insbesondere unterstützen:

- geplante und tatsächliche Ausgaben,
- Kategorie oder Zweck,
- Betrag,
- Verantwortlichkeit bzw. Belegbezug, sofern fachlich notwendig,
- Auswertung der Gesamtkosten eines Events.

Eine spätere Anbindung an Finanzprozesse ist möglich, aber nicht Voraussetzung für den fachlichen Nutzen des Event-Moduls.

### 10. Event-Templates

Wiederkehrende Veranstaltungen sollen aus Vorlagen erzeugt werden können.

Templates sollen bewährte Planung wiederverwendbar machen und damit Vorbereitung beschleunigen.

Je nach Veranstaltung können Vorlagen künftig beispielsweise enthalten:

- typische Veranstaltungstage,
- Programmpunkte,
- wiederkehrende Organisationsaufgaben,
- wiederkehrende Helferbedarfe,
- Standard-Schichten,
- Mannschafts- oder Abteilungszuständigkeiten,
- Bestell- und Materialpositionen,
- organisatorische Checklisten.

Eine Vorlage ist Ausgangspunkt für eine neue Veranstaltung. Das neu erzeugte Event muss anschließend unabhängig angepasst werden können.

### 11. Dashboard und operative Übersicht

Das Dashboard ist die zentrale operative Startseite.

Es zeigt insbesondere:

- anstehende Events,
- Turniere,
- Camps,
- aktuelle Schichtmengen,
- offene echte Organisationsaufgaben,
- belastbare automatisch erkannte Planungsprobleme.

Die verbindliche fachliche Detaildefinition liegt in `DASHBOARD-LOGIC.md`.

### 12. Auswertung und Historie

Abgeschlossene Veranstaltungen bilden eine verlässliche Historie.

Die Dokumentation soll später beantworten können:

- Wie wurde eine Veranstaltung in früheren Jahren organisiert?
- Welche Programmpunkte und Turniere gab es?
- Welche Aufgaben und Checklisten waren notwendig?
- Welche Helferbedarfe und Schichten waren notwendig?
- Welche Mannschaften oder Abteilungen haben welche Aufgaben übernommen?
- Welche Bestellungen wurden benötigt?
- Welche Ausgaben sind entstanden?
- Wo gab es Engpässe oder Besonderheiten?

Zusätzlich soll aus den gespeicherten Daten eine Jahresauswertung entstehen können, zum Beispiel:

- Anzahl Events pro Jahr,
- Anzahl Turniere pro Jahr,
- Anzahl Camps pro Jahr,
- weitere sinnvolle Kennzahlen ohne zusätzliche manuelle Pflege.

Die personenbezogene Jahresauswertung der Helferstunden bleibt Eigentum von `member-engagement`, kann aber verlinkt oder zusammengefasst angezeigt werden.

Diese Historie und Auswertung reduzieren die Abhängigkeit von einzelnen erfahrenen Personen und erleichtern die Übergabe an neue Verantwortliche.

### 13. Vereinfachungsregeln

Für alle Erweiterungen dieses Moduls gelten folgende Leitplanken:

- keine doppelte Dateneingabe ohne zwingenden fachlichen Grund,
- bestehende Daten als Defaults und Kontext verwenden,
- ein gemeinsamer Event-Bezug statt unabhängiger Insellösungen,
- nur Datenfelder aufnehmen, die einen praktischen Nutzen haben,
- wiederkehrende Arbeit über Templates oder Kopiermechanismen vereinfachen,
- klare Trennung zwischen Planung, tatsächlicher Durchführung und Historie,
- mobile und verständliche Bedienung berücksichtigen,
- keine vollständige Buchhaltung oder Mitgliederverwaltung nachbauen, wenn dafür andere fachliche Quellen zuständig sind.

### 14. Erfolgskriterien des Gesamtmoduls

Das Zielbild ist erreicht, wenn wiederkehrende TuS-Veranstaltungen weitgehend ohne zusätzliche Zettelwirtschaft und verstreute private Listen organisiert werden können.

Insbesondere soll es möglich sein:

- ein Event zentral anzulegen,
- ein Fußballcamp mit internem oder externem Buchungsweg abzubilden,
- aus einer Vorlage zu starten,
- Programm und Turniere zu planen,
- echte Organisationsaufgaben zu verwalten,
- Helferbedarf und Schichten zu organisieren,
- Aufgaben Mannschaften und Abteilungen zuzuweisen,
- tatsächlich geleistete Helferzeiten zuverlässig zu bestätigen,
- Bestellungen und veranstaltungsbezogene Ausgaben zu dokumentieren,
- abgeschlossene Events später als belastbare Referenz zu verwenden,
- Jahresauswertungen ohne zusätzliche manuelle Statistiklisten zu erzeugen.

## Relationship to other documents

- `README.md` beschreibt den Einstieg in das Projekt und die verbindlichen Arbeitsregeln.
- `DASHBOARD-LOGIC.md` beschreibt die operative Dashboard-/Auswertungslogik.
- `PROJECT-STATE.md` beschreibt ausschließlich den aktuellen Entwicklungsstand, Last Known Good, Risiken und den nächsten sinnvollen Schritt.
- `SMOKE-TEST.md` beschreibt die reproduzierbare technische Baseline-Prüfung.
- `../member-engagement/FUNCTIONAL-SCOPE.md` ist die fachliche Quelle für personenzentrierte Jahres-/Periodenauswertung, Helfersoll und Rabatt-Berechtigung.
- `../../design/ui-standard.md` definiert gemeinsame UI-Muster.
- `../../roles/wordpress-developer/development-standard.md` definiert den technischen Entwicklungsstandard.
- Architektur- oder organisationsweite Entscheidungen werden bei Bedarf zusätzlich unter `../../decisions/` dokumentiert.

Dieses Dokument ist die fachliche Quelle für den langfristig vorgesehenen Funktionsumfang des Event Planners. Es ersetzt keinen konkreten Entwicklungsplan und keine Einzelanforderung für einen Pull Request.

## Future Development

Die Umsetzung erfolgt weiterhin in kleinen, überprüfbaren Schritten.

Eine sinnvolle grobe Reihenfolge ist:

1. bestehende Event-, Programm- und Turnierfunktionen stabilisieren und abschließen,
2. Event-Art `event`/`camp` und Camp-Grunddaten ergänzen,
3. Dashboard und anstehende Übersicht auf die gemeinsame Datenbasis setzen,
4. Aufgaben-/Checklistenmodell ergänzen,
5. Helferbedarf, Schichten, Mannschafts-/Abteilungszuordnung und Helferlisten vervollständigen,
6. bestätigte tatsächliche Helferzeiten sauber an `member-engagement` übergebbar machen,
7. Bestellungen und Ausgaben eventbezogen ergänzen,
8. Templates aus den dann stabilen Event-Strukturen aufbauen,
9. Jahresauswertung und Historie aus denselben Daten ableiten,
10. die spätere Rabatt-Auswertung über den beschlossenen Mitglieder-/Engagement-Prozess anbinden.

Diese Reihenfolge ist eine Orientierung und keine Freigabe für große Sammeländerungen. Jeder Entwicklungsschritt bleibt klein, testbar und über einen klar abgegrenzten Pull Request nachvollziehbar.
