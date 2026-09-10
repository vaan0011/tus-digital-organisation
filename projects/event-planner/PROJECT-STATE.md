# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie verhindert, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, verifizierte Erkenntnisse, ausgeschlossene Wege oder den letzten belastbaren Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Das operative Dashboard V1 und der erste Bereich `TuS Eventhistorie` sind auf `main` umgesetzt.

Der nächste unmittelbare Projektfokus ist die manuelle Verifikation dieses aktuellen Stands im WordPress Playground. Danach wird die dokumentierte Event-Anlegen-UI in kleinen, persistenten und überprüfbaren Änderungen umgesetzt.

Verbindliche Logik-, UI- und Datenhaltungsquellen:

- `DASHBOARD-LOGIC.md`
- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`

Die vom Nutzer bereitgestellten Mockups definieren Aufbau, Informationshierarchie und Vereinfachungsrichtung. Sie sind ausdrücklich **keine Farbquelle**; Farben und Komponenten bleiben an die bestehenden Event-Planner-/TuS-UI-Standards gebunden.

Die automatisierten Preview- und Packaging-Workflows für PR #52, #58 und #61 waren erfolgreich. Das belegt die technische Integration, ersetzt aber noch nicht die manuelle Funktions- und Abnahmeprüfung.

Der Baseline-Smoke-Test ist für den aktuellen Plugin-Stand weiterhin nicht vollständig abgeschlossen. Deshalb bleibt der formale Last Known Good offen.

Langfristiges fachliches Zielbild:

`FUNCTIONAL-SCOPE.md`

## Current Repository State

Projektpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktuell dokumentierte Plugin-Version:

`3.7.1`

Versionsstand:

- Plugin-Header: `3.7.1`
- `VTP_VERSION`: `3.7.1`
- der frühere Versionsunterschied ist damit auf `main` behoben.

Historische reproduzierbare Baseline:

- früherer Baseline-Kandidat: `032f1bd39a96fca6548eefb833442f12ed2aa17f`
- WordPress `7.1`
- PHP `8.2`
- Sprache `de_DE`
- Blueprint: `playground/baseline-3.6.0.json`

Diese alte Baseline deckt Dashboard V1 und Eventhistorie noch nicht ab und ist deshalb kein LKG für den aktuellen Stand.

Relevante gemergte Änderungen:

- PR #26 übernahm die verifizierte Event-Tag-Datumslogik, das fachliche Zielbild und den organisationsweiten Datums-Picker-Standard nach `main`.
- PR #31 präzisierte Camp-Grundlogik, echte Organisationsaufgaben und die Modulgrenze zur Helfer-Jahresauswertung.
- PR #33 dokumentierte Event-Anlegen-UI und zeilenweise Sponsorenpflege.
- PR #35 übernahm die verbindliche Datenbank-Persistenzregel; der frühere Branch `event-planner/persistence-rule` ist damit abgeschlossen.
- PR #52 setzte Dashboard UI V1 auf `main` um.
- PR #58 ergänzte den ersten Historienbereich aus vorhandenen persistenten Archivdaten.
- PR #61 synchronisierte den Historienstand mit dem damaligen `main`; der daraus resultierende Plugin-Stand `3.7.1` ist der aktuelle Code-Ausgangspunkt.
- Für PR #52, #58 und #61 liefen die WordPress-Playground-Preview- und Plugin-ZIP-Workflows erfolgreich.

## Last Known Good

Noch nicht formal dokumentiert.

Der frühere Baseline-Kandidat `032f1bd39a96fca6548eefb833442f12ed2aa17f` wurde nicht vollständig durch den dokumentierten Smoke-Test geführt und bildet den inzwischen erweiterten Dashboard-/Historienstand nicht ab.

Ein neuer formaler Last Known Good wird erst für einen exakt referenzierten aktuellen Commit eingetragen, nachdem der vollständige `SMOKE-TEST.md` sowie die zusätzlichen Dashboard-/Historienprüfungen mit `PASSED` dokumentiert wurden.

## Verified

- GitHub ist die maßgebliche Quelle für Code, fachliches Zielbild, Entscheidungen und Entwicklungsstand.
- Entwicklung erfolgt über Branch und Pull Request.
- PR #10 mit reproduzierbarer Playground-/Smoke-Test-Infrastruktur wurde nach `main` gemergt.
- PR #26 mit den später verifizierten Event-Änderungen wurde nach `main` synchronisiert.
- Smoke-Test Schritt 1 wurde für die historische Baseline manuell bestätigt: WordPress startet, Anmeldung funktioniert, Plugin ist aktiv und das Dashboard ist erreichbar.
- Smoke-Test Schritt 2 wurde für die historische Baseline manuell bestätigt: Ein Event lässt sich speichern, erneut öffnen und behält seine Kerndaten.
- Das Enddatum verwendet das Event-Startdatum als fachlichen Kontext, solange noch keine bewusste Nutzerauswahl erfolgt ist.
- Die Event-Tag-Logik aus PR #13 wurde manuell bestätigt: Bei Tag 1 `26.09.2026` und Tag 2 `27.09.2026` erhält ein neu hinzugefügter Tag 3 bereits beim Erzeugen `28.09.2026`.
- Der native Date-Picker öffnet dadurch im passenden Zeitraum.
- Eine spätere manuelle Datumswahl wird nicht automatisch überschrieben.
- Der zuvor getestete Ansatz, den Default erst während `pointerdown` oder `focus` zu setzen, ist als unzuverlässig widerlegt.
- Das daraus abgeleitete organisationsweite Datums-Picker-Muster ist im zentralen `design/ui-standard.md` dokumentiert.
- Das fachliche Zielbild des Event Planners ist in `FUNCTIONAL-SCOPE.md` definiert.
- Die Persistenzregel aus PR #35 ist auf `main` dokumentiert.
- Dashboard V1 und der erste Historienbereich sind über PR #52, #58 und #61 auf `main` integriert.
- Die Plugin-Version ist in Header und `VTP_VERSION` konsistent auf `3.7.1`.
- Die automatisierten Preview- und Packaging-Workflows der drei aktuellen Dashboard-/Historien-PRs waren erfolgreich.
- Eine vollständige manuelle Funktionsprüfung dieses aktuellen Stands ist damit noch nicht behauptet.

## Dashboard Decisions V1

- Schnellaktionen: `neues Event`, `neues Turnier`, `neues Camp`, `Schichten öffnen`.
- Fußballcamps werden als Event-Art auf dem gemeinsamen Event-Grundmodell geführt, nicht als isolierte zweite Eventverwaltung.
- Camps erhalten camp-spezifische Daten wie Ausrichter, Teilnehmerzahl/-limit, Preise, Trainingsort und Buchungsart.
- Camp-Buchung muss intern, extern per Link oder ohne Buchung möglich sein.
- Turniere bleiben eine eigene fachliche Einheit mit eigener Team-, Spielplan- und Ergebnislogik.
- Dashboard-Zähler werden aus Fachdaten berechnet und nicht separat gepflegt.
- `Schichten` im Hauptdashboard zählt Schichten nicht archivierter Events.
- `Übersicht` zeigt anstehende und aktuell laufende Events, Turniere und Camps chronologisch.
- Vergangene, noch nicht archivierte Objekte erscheinen nicht mehr als anstehend, sondern als Nachbereitungs-/Archivierungsaufgabe.
- `Offene Aufgaben` ist ein echter operativer Aufgabenbereich und nicht nur eine automatische Warnliste.
- Aufgaben können manuell, aus Templates oder als Systemhinweis entstehen.
- Typische Aufgaben sind z. B. Catering, Foodtruck, Ausschankgenehmigung, Pilswagen, Kassen/Wechselgeld, Material und Lieferungen.
- Automatische Systemhinweise wie offene Helferplätze, fehlendes Programm oder fehlender Spielplan ergänzen die echten Aufgaben.
- Die bisherige künstlich einfache Fortschritts-Prozentlogik wird nicht als verbindliche Dashboard-Vorgabe übernommen.
- Mockup-Farben werden nicht übernommen; die bestehenden UI-Tokens bleiben maßgeblich.

## Event-Anlage Decisions V1

Verbindliche UI-Quelle:

`EVENT-FORM-UI.md`

Festgelegt:

- obere Event-Navigation mit `neues Event`, `aktive Events`, `Vorlagen`, `Archiv`,
- aktiver Bereich wird eindeutig hervorgehoben,
- Event-Anlage erhält eine klare zweispaltige Struktur auf Desktop und eine einspaltige responsive Darstellung auf Mobilgeräten,
- linke Formularspalte: Veranstaltungsname, Startdatum, Enddatum, Veranstaltungsort,
- rechte Formularspalte: Veranstaltungsbeschreibung, zusätzlicher Link, öffentliche Kalender-Sichtbarkeit,
- Vorlagen-Auswahl wird im Kopf der Event-Anlage vorgesehen,
- ein aus Vorlage erzeugtes Event ist anschließend unabhängig von der Vorlage bearbeitbar,
- Event-Sponsoren werden nicht mehr in einem großen Sammelfeld dargestellt,
- Sponsoren werden zeilenweise mit klar getrennten Feldern `Name`, `Logo`, `Link zur Homepage` geführt,
- neue Sponsor-Zeilen werden im Neuanlage-Modus zusammen mit `Event anlegen` gespeichert,
- Icon-Aktionen benötigen verständliche Tooltips/ARIA-Labels,
- für die erste Umsetzung bleibt der Event Planner für die Sponsorendarstellung des konkreten Events zuständig,
- eine spätere Anbindung an eine gemeinsame Partnerdatenquelle bleibt möglich, ohne die Event-Anlage davon abhängig zu machen,
- Canva-Mockup-Farben werden nicht übernommen.

## Data Persistence Decisions V1

Verbindliche Datenhaltungsquelle:

`DATA-PERSISTENCE.md`

Festgelegt:

- alle fachlich dauerhaft benötigten Informationen werden persistent in der Datenbank gespeichert,
- ein dauerhaft relevantes Formularfeld benötigt vor Implementierung eine definierte Datenbank-/Persistenzquelle,
- Sessions, Session-IDs, Query-Parameter, JavaScript-Zustand oder vergleichbare flüchtige Mechanismen dürfen nicht Source of Truth für dauerhafte Fachdaten sein,
- ein erfolgreicher Speichervorgang bedeutet, dass die bestätigten fachlichen Daten dauerhaft persistiert wurden,
- nach Reload, Browser-Neustart, Session-Ende und erneutem Öffnen müssen gespeicherte Daten weiterhin vorhanden sein,
- Medien-/Uploaddaten benötigen eine stabile dauerhafte Referenz, z. B. eine WordPress-Attachment-ID,
- strukturierte Informationen, die später einzeln bearbeitet oder ausgewertet werden, werden strukturiert und nicht nur in Sammelfeldern gespeichert,
- für neue persistente Felder gehört `Speichern → Reload/Verlassen → erneut öffnen → Wert vergleichen` zum Test,
- Datenbankänderungen werden nicht durch Quick-&-dirty-Sessionlösungen vermieden,
- bestehender Datenbestand muss bei Schemaänderungen geschützt bzw. nachvollziehbar migriert werden.

Die Regel gilt projektweit insbesondere für Event-Stammdaten, Camps, Programmpunkte, Turniere, Aufgaben, Schichten, Bestellungen, Ausgaben, Templates und eventbezogene Sponsoreninformationen.

## Auswertung / Historie – aktueller Stand

Auf `main` umgesetzt:

- Bereich `TuS Eventhistorie` unter dem operativen Dashboard,
- vier Archiv-Kennzahlen für Events, Turniere, Camps und Schichten,
- Jahresübersicht aus tatsächlich archivierten Daten,
- grafische Balkendarstellung und Aufteilung nach Events, Turnieren und Camps,
- Detailbereich für das ausgewählte Jahr,
- Filter `Alle`, `Events`, `Turniere`, `Camps`,
- direkte Absprünge zu archivierten Events bzw. Turnieren,
- responsive Darstellung.

Die Auswertung verwendet ausschließlich bereits persistente Daten aus bestehenden Event-, Turnier- und Schichttabellen. Sie führt keine neue Datenbankstruktur und keine Session-basierte Fachdatenhaltung ein.

Camps werden berücksichtigt, sobald die persistente Event-Art `camp` vorhanden ist; bis dahin bleibt dieser Wert bei `0`.

Noch offen:

- manuelle Verifikation der aktuellen Umsetzung mit Leerzustand und realen Archivdaten,
- endgültige Seitenbezeichnung und genaue Aufteilung zwischen `Auswertung` und `Historie`,
- vollständige historische Event-Detailakte,
- Integration der Helfer-Jahressicht auf Basis der gemeinsamen Personen-/Engagement-Datenquelle.

Helfer-Jahresauswertung:

- der Event Planner ist Quelle für konkrete Schichten und bestätigte tatsächlich geleistete Zeiten,
- `member-engagement` ist Quelle für personenbezogene Jahres-/Periodensummen, Helfersoll und Rabatt-Berechtigung,
- eine kompakte Zusammenfassung darf im Event-Planner-Auswertungsbereich angezeigt werden, aber nicht mit eigener paralleler Berechnungslogik,
- sinnvoll sind Aggregationen wie `Soll erfüllt`, `nur noch wenige Stunden offen` und `Gesamtliste`, jeweils mit Absprung in das Mitglieder-/Engagement-Modul,
- lange personenbezogene Stundenlisten gehören nicht als Standardinhalt direkt auf das Event-Dashboard.

## Open

- Dashboard V1 und Eventhistorie müssen auf dem aktuellen `main` im WordPress Playground manuell gegen die in PR #52/#58 beschriebenen Testfälle geprüft werden.
- Für den aktuellen Plugin-Stand muss eine exakt referenzierte reproduzierbare Testbaseline festgelegt werden.
- Der vollständige Baseline-Smoke-Test muss auf diesem aktuellen Stand durchgeführt und mit `PASSED` oder `FAILED` dokumentiert werden.
- Die Event-Anlegen-UI aus `EVENT-FORM-UI.md` muss danach in kleinen Änderungen umgesetzt und verifiziert werden.
- Vor jeder neuen dauerhaften Formular-/Fachdaten-Erweiterung muss die Datenbankpersistenz gemäß `DATA-PERSISTENCE.md` festgelegt werden.
- Der bestehende Sponsoren-Sammelwert muss vor Umstellung auf strukturierte Sponsor-Zeilen hinsichtlich Rückwärtskompatibilität/Migration geprüft werden.
- Für die Unterscheidung von Event und Camp ist eine rückwärtskompatible Event-Klassifikation erforderlich; bestehende Events müssen ohne Datenverlust als `event` weiterfunktionieren.
- Für echte manuell gepflegte Organisationsaufgaben ist ein kleines persistentes Event-Aufgabenmodell erforderlich; Dashboard V1 enthält bisher nur automatisch abgeleitete Hinweise.
- Camp-Grunddaten und interne/externe Buchungswege müssen in kleinen Schritten persistent modelliert werden.
- Die genaue Auswertungs-/Historienseite bleibt bewusst offen, bis die Informationsstruktur weiter geklärt ist.
- Die Integration der Helfer-Jahressicht darf erst erfolgen, wenn eine gemeinsame Personen-/Engagement-Datenquelle existiert.
- Ältere Entwicklungs-PRs #6 und #7 basieren auf dem früheren Branch `organisation` und gelten nicht als aktueller Entwicklungsstand.

## Module Boundaries

Der Event Planner ist die fachliche Quelle für konkrete Veranstaltungen und deren operative Planung, insbesondere:

- Veranstaltungstage und Programm,
- Fußballcamps und deren Veranstaltungs-/Buchungsinformationen,
- Turniere,
- echte Event-Aufgaben und Checklisten,
- eventbezogene Sponsoren-/Partnerdarstellung,
- Helferbedarf und konkrete Helferschichten,
- Schichtzuordnung zu Personen, Mannschaften, Gruppen oder Abteilungen,
- tatsächlich am Event geleistete und bestätigte Schichtzeiten,
- Bestellungen und eventbezogene Ausgaben,
- spätere Event-Templates und Eventhistorie.

Das Projekt `member-engagement` bündelt die personenzentrierte Jahres-/Periodensicht auf Engagement, Helferstunden, Soll-Erfüllung und Rabatt-Berechtigungen. Dadurch wird keine zweite Stunden- oder Helfersoll-Logik im Event Planner aufgebaut.

Eine spätere zentrale Partnerdatenquelle kann Sponsor-Grunddaten liefern. Der Event Planner bleibt jedoch für die konkrete Sponsorendarstellung und Zuordnung am Event zuständig.

Gemeinsame Mannschafts- und Personenidentitäten werden vor dauerhafter Doppelpflege architektonisch geklärt.

## Excluded / Already Tried

- Der alte Branch `event-planner/baseline-smoke-test` wird nicht direkt nach `main` gemergt; die verifizierten Änderungen wurden über PR #26 selektiv synchronisiert.
- Ältere PRs auf Basis von `organisation` werden nicht gesammelt übernommen.
- Der Datums-Default wird nicht erst beim Öffnen des nativen Pickers gesetzt.
- Offene Aufgaben werden nicht auf reine automatisch erkannte Warnungen reduziert.
- Das Aufgabenmodell wird nicht zu einem allgemeinen Projektmanagementsystem ausgebaut.
- Camps erhalten keine eigene isolierte Event-Datenwelt.
- Der Event Planner berechnet keine zweite personenbezogene Jahres-/Rabattlogik parallel zu `member-engagement`.
- Sponsor-Daten bleiben nicht als unstrukturiertes großes Sammelfeld das Zielbild.
- Dauerhaft benötigte Formulardaten werden nicht nur in Session-IDs oder flüchtigem Browserzustand gespeichert.
- Mockup-Farben ersetzen nicht die bestehenden Plugin-Farben.

## Relevant Decisions & Standards

- `FUNCTIONAL-SCOPE.md`
- `DASHBOARD-LOGIC.md`
- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`
- `SMOKE-TEST.md`
- `../member-engagement/FUNCTIONAL-SCOPE.md`
- `../../standards/employee-operating-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../decisions/README.md`

## Active Development

Kein aktiver Entwicklungsbranch und kein offener Pull Request.

Der aktuelle Produktcode liegt auf `main`. Dashboard V1 und der erste Historienbereich wurden über PR #52, #58 und #61 integriert. Der nächste Entwicklungsbranch beginnt erst nach der manuellen Verifikation dieses Stands.

## Next Meaningful Step

1. aktuellen `main`-Stand mit Plugin-Version `3.7.1` im WordPress Playground öffnen,
2. Dashboard V1, Historien-Leerzustand, archivierte Daten, Jahresauswahl, Filter, Navigation, Responsive-Verhalten und Datenunverändertheit manuell prüfen,
3. Ergebnis mit `PASSED` oder konkretem reproduzierbarem Fehler dokumentieren,
4. bei erfolgreicher Prüfung einen exakten aktuellen Baseline-Kandidaten festhalten und den vollständigen `SMOKE-TEST.md` abschließen,
5. danach Event-Navigation und Formularlayout als kleinen UI-/Datenmodell-PR umsetzen,
6. für jedes neue dauerhafte Feld vorab die Datenbankpersistenz definieren und mit `Speichern → Reload → erneut öffnen` prüfen,
7. Sponsoren-Sammelfeld separat und rückwärtskompatibel auf strukturierte persistente Sponsor-Zeilen umstellen,
8. Camp-/Aufgabenlogik anschließend in weiteren kleinen, überprüfbaren Inkrementen umsetzen.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.
