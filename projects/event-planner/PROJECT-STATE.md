# Event Planner – Project State

## Purpose

Diese Datei ist der kompakte, verbindliche Projekt-Checkpoint für den TuS Event Planner.

Sie verhindert, dass neue Chats oder Entwickler bereits getroffene Entscheidungen, verifizierte Erkenntnisse, ausgeschlossene Wege oder den letzten belastbaren Stand verlieren.

Sie ist kein Tagebuch und wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

## Current Goal

Die fachliche Logik für Dashboard, Camps, Aufgaben sowie die Struktur der Event-Anlage ist geklärt und wird anschließend in kleinen, überprüfbaren Änderungen umgesetzt.

Verbindliche Logik-, UI- und Datenhaltungsquellen:

- `DASHBOARD-LOGIC.md`
- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`

Die vom Nutzer bereitgestellten Mockups definieren Aufbau, Informationshierarchie und Vereinfachungsrichtung. Sie sind ausdrücklich **keine Farbquelle**; Farben und Komponenten bleiben an die bestehenden Event-Planner-/TuS-UI-Standards gebunden.

Das Zielbild für die zweite Mockup-Seite ist noch nicht endgültig festgelegt. Durch die gewünschte Jahresauswertung und Helfer-Jahressicht entwickelt sie sich voraussichtlich von einer reinen `Eventhistorie` in Richtung `Auswertung & Historie`.

Der Baseline-Smoke-Test ist weiterhin nicht vollständig abgeschlossen. Deshalb bleibt der formale Last Known Good offen.

Langfristiges fachliches Zielbild:

`FUNCTIONAL-SCOPE.md`

## Current Repository State

Projektpfad:

`projects/event-planner/plugin/verein-turnierplaner/`

Aktuell dokumentierte Plugin-Version:

`3.6.0`

Bekannter Versionsbefund:

- Plugin-Header: `3.6.0`
- `VTP_VERSION`: `3.5.0`
- `VTP_VERSION` wird im aktuellen Stand für CSS-Cache-Versionierung verwendet.

Reproduzierbare Baseline:

- Baseline-Kandidat: `032f1bd39a96fca6548eefb833442f12ed2aa17f`
- WordPress `7.1`
- PHP `8.2`
- Sprache `de_DE`
- Blueprint: `playground/baseline-3.6.0.json`

PR #26 `Event Planner: verifizierte Arbeit auf aktuellen main synchronisieren` ist nach `main` gemergt. Damit liegen die verifizierte Event-Tag-Datumslogik, das fachliche Zielbild und der organisationsweite Datums-Picker-Standard auf dem Hauptzweig.

PR #31 `Event Planner: Dashboard-Logik nach Fachklärung präzisieren` ist ebenfalls nach `main` gemergt. Damit sind Camp-Grundlogik, echte Organisationsaufgaben und die Modulgrenze zur Helfer-Jahresauswertung im Hauptstand dokumentiert.

PR #33 `Event Planner: Event-Anlegen-UI dokumentieren` ist nach `main` gemergt. Damit ist die abgestimmte Struktur der Event-Anlage und der zeilenweisen Sponsorenpflege im Hauptstand dokumentiert.

## Last Known Good

Noch nicht formal dokumentiert.

Der Baseline-Kandidat `032f1bd39a96fca6548eefb833442f12ed2aa17f` darf erst nach vollständig bestandenem `SMOKE-TEST.md` als Last Known Good bezeichnet werden.

## Verified

- GitHub ist die maßgebliche Quelle für Code, fachliches Zielbild, Entscheidungen und Entwicklungsstand.
- Entwicklung erfolgt über Branch und Pull Request.
- PR #10 mit reproduzierbarer Playground-/Smoke-Test-Infrastruktur wurde nach `main` gemergt.
- PR #26 mit den später verifizierten Event-Änderungen wurde nach `main` synchronisiert.
- Der Playground-Preview-Workflow wurde erfolgreich ausgeführt.
- Smoke-Test Schritt 1 wurde manuell bestätigt: WordPress startet, Anmeldung funktioniert, Plugin ist aktiv und das Dashboard ist erreichbar.
- Smoke-Test Schritt 2 wurde manuell bestätigt: Ein Event lässt sich speichern, erneut öffnen und behält seine Kerndaten.
- Das Enddatum verwendet das Event-Startdatum als fachlichen Kontext, solange noch keine bewusste Nutzerauswahl erfolgt ist.
- Die Event-Tag-Logik aus PR #13 wurde manuell bestätigt: Bei Tag 1 `26.09.2026` und Tag 2 `27.09.2026` erhält ein neu hinzugefügter Tag 3 bereits beim Erzeugen `28.09.2026`.
- Der native Date-Picker öffnet dadurch im passenden Zeitraum.
- Eine spätere manuelle Datumswahl wird nicht automatisch überschrieben.
- Der zuvor getestete Ansatz, den Default erst während `pointerdown` oder `focus` zu setzen, ist als unzuverlässig widerlegt.
- Das daraus abgeleitete organisationsweite Datums-Picker-Muster ist im zentralen `design/ui-standard.md` dokumentiert.
- Das fachliche Zielbild des Event Planners ist in `FUNCTIONAL-SCOPE.md` definiert.

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

Festgelegt:

- obere Kennzahlreihe nutzt die Kategorien Events, Turniere, Camps und Schichten,
- eine Jahresauswertung soll zeigen können, wie viele Veranstaltungen je Kategorie pro Jahr durchgeführt wurden,
- eine grafische Darstellung aus den vorhandenen Daten ist gewünscht,
- archivierte Event-Details sollen langfristig weiterhin nachvollziehbar bleiben.

Noch offen:

- endgültige Seitenbezeichnung und genaue Aufteilung zwischen `Auswertung` und `Historie`,
- genaue Darstellung der historischen Detailansicht.

Helfer-Jahresauswertung:

- der Event Planner ist Quelle für konkrete Schichten und bestätigte tatsächlich geleistete Zeiten,
- `member-engagement` ist Quelle für personenbezogene Jahres-/Periodensummen, Helfersoll und Rabatt-Berechtigung,
- eine kompakte Zusammenfassung darf im Event-Planner-Auswertungsbereich angezeigt werden, aber nicht mit eigener paralleler Berechnungslogik,
- sinnvoll sind Aggregationen wie `Soll erfüllt`, `nur noch wenige Stunden offen` und `Gesamtliste`, jeweils mit Absprung in das Mitglieder-/Engagement-Modul,
- lange personenbezogene Stundenlisten gehören nicht als Standardinhalt direkt auf das Event-Dashboard.

## Open

- Dashboard-Logik V1 muss gegen den bestehenden Plugin-Code umgesetzt und im Playground geprüft werden.
- Die Event-Anlegen-UI aus `EVENT-FORM-UI.md` muss in kleinen Änderungen umgesetzt und verifiziert werden.
- Vor jeder neuen dauerhaften Formular-/Fachdaten-Erweiterung muss die Datenbankpersistenz gemäß `DATA-PERSISTENCE.md` festgelegt werden.
- Der bestehende Sponsoren-Sammelwert muss vor Umstellung auf strukturierte Sponsor-Zeilen hinsichtlich Rückwärtskompatibilität/Migration geprüft werden.
- Für die Unterscheidung von Event und Camp ist eine rückwärtskompatible Event-Klassifikation erforderlich; bestehende Events müssen ohne Datenverlust als `event` weiterfunktionieren.
- Für echte Organisationsaufgaben ist ein kleines persistentes Event-Aufgabenmodell erforderlich; es darf nicht unnötig zu einem komplexen Projektmanagementsystem wachsen.
- Camp-Grunddaten und interne/externe Buchungswege müssen in kleinen Schritten persistent modelliert werden.
- Die genaue Auswertungs-/Historienseite bleibt bewusst offen, bis die Informationsstruktur weiter geklärt ist.
- Die Integration der Helfer-Jahressicht darf erst erfolgen, wenn eine gemeinsame Personen-/Engagement-Datenquelle existiert.
- Der Baseline-Smoke-Test muss ab Schritt 3 vollständig fortgesetzt und mit `PASSED` oder `FAILED` dokumentiert werden.
- Erst bei vollständigem `PASSED` wird der Baseline-Kandidat als erster formaler Last Known Good eingetragen.
- Der Versionsunterschied zwischen Plugin-Header `3.6.0` und `VTP_VERSION` `3.5.0` bleibt ein separater technischer Befund.
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

Branch:

`event-planner/persistence-rule`

Scope:

- projektweite Persistenzregel dokumentieren,
- Event-Anlegen-UI explizit an dauerhafte Datenbankpersistenz binden,
- Session-/Browserzustand als dauerhafte Datenquelle ausschließen,
- Persistenz als Test- und Migrationskriterium festhalten,
- keine Produktcode- oder Datenbankänderung in diesem Dokumentationsschritt.

## Next Meaningful Step

1. Persistenzregel nach menschlicher Freigabe nach `main` übernehmen,
2. anschließend Event-Navigation und Formularlayout als kleinen UI-/Datenmodell-PR umsetzen,
3. für jedes neue dauerhafte Feld vorab die Datenbankpersistenz definieren,
4. Vorlagen-Dropdown mit sauberem Leerzustand vorbereiten,
5. Sponsoren-Sammelfeld separat und rückwärtskompatibel auf strukturierte persistente Sponsor-Zeilen umstellen,
6. Persistenztest `Speichern → Reload → erneut öffnen` für alle neuen Felder durchführen,
7. Responsive Verhalten und Accessibility im Playground prüfen,
8. danach Dashboard-/Camp-/Aufgabenlogik in weiterhin kleinen Schritten umsetzen,
9. den offenen Baseline-Smoke-Test vollständig abschließen und erst dann einen formalen LKG dokumentieren.

## Update Rule

Diese Datei wird aktualisiert, wenn mindestens eines zutrifft:

- Last Known Good ändert sich,
- ein neues konkretes Projektziel beginnt,
- ein wichtiger Lösungsweg wurde belastbar ausgeschlossen,
- eine langfristige Entscheidung wurde getroffen,
- ein relevanter Branch oder PR übernimmt die aktive Arbeit,
- ein Risiko oder Blocker verändert den nächsten sinnvollen Schritt.
