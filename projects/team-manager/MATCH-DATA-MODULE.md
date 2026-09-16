# Team Manager – Matchdaten-Modul

## Purpose

Dieses Dokument definiert den fachlichen und technischen Rahmen für das Matchdaten-Modul des TuS Team Managers.

Das Modul soll Spielansetzungen, Status und Ergebnisse aus einer verifizierten externen Quelle übernehmen, lokal kontrolliert speichern und mehreren TuS-Verbrauchern bereitstellen. Dazu gehören insbesondere der Homepage-Block „Nächste Spiele“ und später der Matchday Editor.

Es ersetzt keine offizielle Spielverwaltung und erzeugt keine zweite manuell zu pflegende Spielplanwelt.

## Core Principle

> **Matchdaten werden einmal automatisiert importiert, eindeutig einer TuS-Mannschaft und Saison zugeordnet und anschließend von Homepage und Redaktion gemeinsam genutzt.**

Das Theme liefert den Look. Der Team Manager liefert Mannschaftsidentität, Matchdaten und Funktionen. Der Matchday Editor liefert redaktionelle Berichte.

## Main Content

### 1. Produktgrenze

Das Matchdaten-Modul ist ein abgegrenzter Bestandteil des Team-Manager-Plugins.

Es verantwortet:

- Provider-Connectoren für verifizierte externe Datenlieferungen,
- geplanten und manuellen Import,
- Validierung und Normalisierung,
- Zuordnung zu Mannschaft und Saison,
- lokale regenerierbare Matchdaten,
- Fehler- und Aktualisierungsstatus,
- Abfragefunktionen für andere Module,
- dynamische öffentliche Spielblöcke,
- eine dokumentierte lesende Schnittstelle für den Matchday Editor.

Es verantwortet nicht:

- Gestaltung und Brand-Tokens des Themes,
- redaktionelle Spielberichte,
- manuelle Pflege von Spielansetzungen als parallele Quelle,
- offizielle Spielverwaltung oder Ergebnismeldung,
- personenbezogene Spieldetails ohne gesonderten freigegebenen Bedarf.

### 2. Datenquelle und Transportstrategie

Fachlich führend bleiben die offiziellen Spielbetriebsdaten, die auf FUSSBALL.DE veröffentlicht werden.

Zum Stand 2026-09-16 erklärt die offizielle FUSSBALL.DE-FAQ:

- eine direkte Schnittstelle zu FUSSBALL.DE ist derzeit nicht möglich,
- automatisierte Datenlieferungen werden über Sportmedia angeboten,
- der Versand erfolgt automatisiert über eine SFTP-Verbindung,
- als Datenprodukte werden Ergebnisse und Tabellen, Spielberichte sowie Spielpläne genannt.

Daraus folgt folgende Provider-Priorität:

1. **Sportmedia-SFTP-Connector** nach erfolgreicher Prüfung von Zugang, Format, Nutzungsbedingungen, Kosten und Aktualisierung,
2. anderer dokumentierter offizieller Provider nur nach eigener Entscheidung,
3. offizieller Widget-Link als öffentlicher Notfall-Fallback, nicht als primäre Datenbasis,
4. kein produktives HTML-Scraping und kein inoffizieller Endpoint ohne gesonderte Freigabe.

Der Transport wird hinter einer Connector-Schnittstelle gekapselt. Fachmodell, Speicherung und Ausgabe kennen keine SFTP- oder HTML-Details.

### 3. Zielarchitektur

Der Datenfluss lautet:

`Offizielle Datenlieferung → Provider-Connector → Normalisierung → Mannschafts-/Saisonzuordnung → lokale Matchprojektion → öffentliche Blöcke und lesende Verbraucher`

Vorgesehene interne Komponenten:

- **Provider Connector:** liest externe Dateien beziehungsweise Datensätze,
- **Import Service:** steuert Abruf, Validierung, Retry und Protokollierung,
- **Normalizer:** übersetzt externe Felder und Statuswerte in das TuS-Matchmodell,
- **Team Mapping Service:** ordnet externe Mannschaften einer internen Team-Saison zu,
- **Match Repository:** speichert die regenerierbare lokale Projektion,
- **Match Query Service:** liefert gefilterte Matchlisten für Blöcke und weitere Verbraucher,
- **Public Match Block:** rendert „Nächste Spiele“ serverseitig,
- **Read-only Export:** stellt dem Matchday Editor freigegebene Matchdaten bereit,
- **Admin Status:** zeigt Quelle, letzten Lauf, Fehler und ungeklärte Zuordnungen.

Das Theme greift weder auf Provider noch direkt auf interne Tabellen zu.

### 4. Externe Mannschaftszuordnung

Jede externe Mannschaft wird einer internen saisonbezogenen Mannschaftsausprägung zugeordnet.

Die Zuordnung enthält mindestens:

- interne Mannschafts-ID,
- interne Team-Saison-ID,
- interne Saison,
- Quellsystem,
- externe Vereinskennung, soweit geliefert,
- externe Mannschaftskennung,
- externe Originalbezeichnung,
- öffentliche TuS-Bezeichnung,
- Gültigkeit,
- Prioritätsgruppe,
- offizielle Quell-URL,
- Status `bestätigt`, `vorgeschlagen`, `ungeklärt` oder `inaktiv`.

Verbindliche öffentliche Bezeichnungen:

| Externe Bezeichnung | Öffentliche TuS-Bezeichnung |
|---|---|
| `TuS Mingolsheim` | `1. Mannschaft Herren` |
| `TuS Mingolsheim 2` | `2. Mannschaft Herren` |
| `SpG St. Leon/Mingolsheim` beziehungsweise aktuelle offizielle Schreibweise | `Frauenmannschaft` |
| Jugendmannschaften | aktuelle fachliche Jugendbezeichnung |

Eine Zuordnung darf vorgeschlagen, aber bei Mehrdeutigkeit nicht automatisch veröffentlicht werden.

### 5. Normalisiertes Matchmodell

Die lokale Matchprojektion enthält mindestens:

- interne Match-ID,
- externe stabile Spiel-ID,
- Quellsystem,
- zugeordnete Team-Saison-ID,
- externe Mannschafts- und Wettbewerbskennungen, soweit geliefert,
- Wettbewerb und Staffel,
- Spieltag, soweit geliefert,
- Anstoßzeit in `Europe/Berlin`,
- Heimteam und Gastteam,
- TuS-Heim-/Auswärtsbezug,
- Spielort und Adresse, soweit geliefert,
- Status,
- Ergebnis und Halbzeitstand, soweit vorhanden,
- offizielle Quell-URL,
- Quelländerungszeit, soweit vorhanden,
- Zeitpunkt des letzten erfolgreichen Imports,
- technischer Fingerprint für Änderungsvergleich,
- Importstatus.

Mindestens unterstützte normalisierte Statuswerte:

- `scheduled` – angesetzt,
- `rescheduled` – verlegt,
- `cancelled` – abgesetzt oder ausgefallen,
- `live` – laufend, nur wenn belastbar geliefert,
- `finished` – beendet,
- `unknown` – nicht eindeutig zugeordnet.

Für die Homepage werden keine Aufstellungen, Torschützen, Karten oder sonstigen personenbezogenen Spieldetails importiert. Ein späterer redaktioneller Bedarf benötigt eine separate Datenminimierungs- und Berechtigungsentscheidung.

### 6. Synchronisation und Betrieb

Verbindliche Betriebsregeln:

- kein externer Abruf während eines öffentlichen Seitenaufrufs,
- geplanter serverseitiger Import,
- zusätzlicher manueller Lauf für berechtigte Administratoren,
- idempotente Updates anhand der externen Spiel-ID,
- keine Dubletten bei wiederholtem Import derselben Lieferung,
- letzte erfolgreiche Projektion bleibt bei Quellausfall verfügbar,
- Importfehler überschreiben keine gültigen Matchdaten,
- Secrets und SFTP-Zugangsdaten werden nie im GitHub-Repository gespeichert,
- Importprotokolle enthalten keine unnötigen personenbezogenen Daten,
- Zeitstempel des letzten erfolgreichen und letzten fehlgeschlagenen Laufs sind intern sichtbar.

Der konkrete Zeitplan wird nach Kenntnis der Lieferfrequenz festgelegt. Die Architektur muss einen echten Server-Cron ebenso unterstützen wie eine kontrollierte WordPress-Ausführung.

### 7. Saisonwechsel

Der Saisonwechsel wird als fachlicher Prozess im Team Manager behandelt.

Ablauf:

1. neue Saison anlegen,
2. externe Mannschaften und Wettbewerbe aus der neuen Lieferung erkennen,
3. Zuordnung zur neuen Team-Saison vorschlagen,
4. unveränderte eindeutige Zuordnungen kontrolliert übernehmen,
5. neue Spielgemeinschaften, Namen oder Kennungen als prüfbedürftig markieren,
6. Saison-Mapping fachlich bestätigen,
7. öffentliche Ausgabe für die neue Saison aktivieren.

Dabei gilt:

- kein neuer Widget-Code,
- keine Änderung am Theme,
- keine rückwirkende Änderung historischer Saisonzuordnungen,
- keine rein namensbasierte automatische Veröffentlichung bei Mehrdeutigkeit,
- alte Matchdaten bleiben historisch nachvollziehbar.

### 8. Öffentlicher Block „Nächste Spiele“

Der Team Manager stellt einen dynamischen serverseitig gerenderten WordPress-Block bereit.

Standardverhalten:

- Zeitraum: nächste sieben Kalendertage,
- Zeitzone: `Europe/Berlin`,
- Priorität: 1. Mannschaft Herren, 2. Mannschaft Herren, Frauenmannschaft, danach Jugend,
- abgesetzte und verlegte Partien verständlich kennzeichnen,
- keine technisch fehlerhaften oder ungeklärten Mannschaftszuordnungen veröffentlichen,
- Link `Alle Spiele` zum vollständigen TuS-Spielplan beziehungsweise zur vorgesehenen Übersichtsseite,
- offizielle Quellverlinkung je Spiel, soweit sinnvoll,
- neutraler Empty State, wenn keine Spiele anstehen,
- kontrollierter Fallback auf den offiziellen Vereinsspielplan, wenn noch kein erfolgreicher Import existiert.

Der Block liefert semantisches HTML. Farben, Schriften, Abstände, responsive Darstellung und visuelle MatchCards kommen aus dem aktiven TuS-Theme.

Konfigurierbar bleiben mindestens:

- Zeitraum,
- maximale Anzahl,
- einbezogene Prioritätsgruppen,
- optionale einzelne Mannschaft,
- Anzeige von Wettbewerb und Spielort.

### 9. Lesende Schnittstelle für den Matchday Editor

Der Matchday Editor wird als lesender Verbraucher vorgesehen.

Die Schnittstelle liefert mindestens:

- stabile Match-ID,
- Mannschaftszuordnung,
- Datum und Uhrzeit,
- Gegner,
- Heim/Auswärts,
- Wettbewerb und Spieltag,
- Status,
- Ergebnis und Halbzeitstand, soweit vorhanden,
- offizielle Quell-URL,
- Zeitpunkt der letzten erfolgreichen Synchronisation.

Vorgesehener Ablauf:

1. Matchday Editor fragt neue abgeschlossene Spiele ab,
2. bereits verarbeitete Spiele werden anhand der stabilen Match-ID erkannt,
3. redaktionell benötigte Details werden weiterhin gegen belastbare Quellen geprüft,
4. Berichte werden erstellt und in Google Drive abgelegt,
5. `season-state.md` wird als redaktioneller Checkpoint fortgeschrieben.

Die Schnittstelle ist read-only. Der Matchday Editor ändert keine Matchdaten und ist kein notwendiger Zwischenschritt für die Homepage.

Der genaue technische Vertrag – WordPress-REST-Route, Authentifizierung und Filter – wird im Implementierungsinkrement festgelegt. Öffentlich ohnehin sichtbare Matchdaten und interne Betriebsdaten werden dabei getrennt behandelt.

### 10. Administrationsoberfläche

Die operative Oberfläche bleibt klein, deutsch und auf Ausnahmen fokussiert.

Sie zeigt mindestens:

- aktive Datenquelle,
- letzten erfolgreichen Import,
- letzten Fehler mit verständlicher Kurzbeschreibung,
- Anzahl neuer, aktualisierter und unveränderter Spiele,
- ungeklärte Mannschaftszuordnungen,
- Saison-Mapping-Status,
- Aktion `Jetzt synchronisieren`,
- Link zu einer kompakten Importhistorie.

Ein normaler Lauf benötigt keine manuelle Bearbeitung. Menschen greifen nur bei Fehlern, neuen Saisonzuordnungen oder echten Sonderfällen ein.

### 11. Fehler- und Fallback-Verhalten

| Situation | Verhalten |
|---|---|
| Quelle kurzfristig nicht erreichbar | letzten erfolgreichen Stand anzeigen, intern warnen |
| Lieferung formal fehlerhaft | Import verwerfen, gültigen Stand behalten |
| externe Mannschaft ungeklärt | nicht veröffentlichen, administrativ melden |
| Spiel wurde verlegt | bestehenden Datensatz aktualisieren und kennzeichnen |
| Spiel wurde abgesetzt | nicht still löschen, relevanten Status anzeigen |
| noch kein erfolgreicher Import | neutraler Empty State und offizieller Spielplan-Link |
| Matchdaten-Modul deaktiviert | Homepage bleibt funktionsfähig und zeigt kontrollierten Fallback |

### 12. Datenschutz und Sicherheit

- Es werden nur die für Spielanzeige und freigegebene Verbraucher notwendigen Daten importiert.
- SFTP-Zugangsdaten und andere Secrets liegen außerhalb des Repositorys.
- Externe Dateien gelten als nicht vertrauenswürdig und werden vor Verarbeitung validiert.
- Dateinamen, Pfade und Inhalte dürfen keine beliebigen Schreiboperationen im Server-Dateisystem auslösen.
- Der manuelle Import ist berechtigungsgeprüft und gegen CSRF geschützt.
- Öffentliche Endpunkte liefern keine Zugangsdaten, internen Fehlerdetails oder Importprotokolle.
- Personenbezogene Spieldetails werden ohne neue fachliche und datenschutzbezogene Freigabe nicht Teil dieses Moduls.

### 13. Erstes Entwicklungsinkrement

Vor dem produktiven Plugin-Code wird ein begrenzter Provider-Spike durchgeführt.

Ergebnis des Spikes:

- bestätigter Sportmedia-Ansprechpartner und Zugangsweg,
- dokumentierte Bedingungen und mögliche Kosten,
- repräsentative Beispieldatei,
- dokumentiertes Schema und Zeichencodierung,
- bekannte Lieferfrequenz,
- verifizierte IDs für Verein, Mannschaft, Wettbewerb und Spiel,
- bekannte Statuswerte für Verlegung, Absetzung und Ergebnis,
- Entscheidung, ob das Datenprodukt den Homepage- und Matchday-Bedarf abdeckt.

Erst danach folgt das kleinste funktionale Plugin-Inkrement:

1. Matchmodell und Repository,
2. Import einer lokalen Beispieldatei,
3. Mannschafts-/Saisonmapping,
4. idempotente Aktualisierung und Diagnosestatus,
5. automatisierte Tests.

Der produktive SFTP-Connector und der öffentliche Block folgen auf dieser nachweisbaren Basis.

### 14. Abnahmekriterien

Das Matchdaten-Modul ist für die erste produktive Nutzung bereit, wenn:

- eine verifizierte Datenlieferung ohne manuelles Copy-and-Paste importiert wird,
- wiederholter Import keine Dubletten erzeugt,
- die nächsten sieben Tage korrekt gefiltert werden,
- Erwachsenen- und Jugendbezeichnungen den Beschlüssen entsprechen,
- Verlegungen und Absetzungen korrekt aktualisiert werden,
- ein Quellausfall den letzten gültigen Stand erhält,
- ungeklärte Zuordnungen nicht versehentlich veröffentlicht werden,
- der Block ohne externen Live-Request rendert,
- das Theme die Darstellung über gemeinsame Tokens gestalten kann,
- der Matchday Editor Matchdaten lesend beziehen kann,
- Saisonwechsel keinen neuen Widget- oder Theme-Code erfordert,
- Desktop, Tablet, Smartphone und Tastaturbedienung geprüft sind.

## Relationship to other documents

- `README.md`
- `FUNCTIONAL-SCOPE.md`
- `PROJECT-STATE.md`
- `../homepage/FUSSBALL-DE-INTEGRATION.md`
- `../homepage/ARCHITECTURE.md`
- `../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md`
- `../../decisions/ADR-0012-team-manager-match-data-module.md`
- `../../roles/matchday-editor/runtime.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/ui-standard.md`

## Future Development

Nach dem Provider-Spike wird dieses Dokument nur um tatsächlich verifizierte Transportdetails, das reale Dateischema, den finalen Synchronisationsrhythmus und den konkreten lesenden Schnittstellenvertrag ergänzt.

Neue Matchfunktionen werden nur aufgenommen, wenn sie einen klaren TuS-Prozess vereinfachen und keine zweite manuelle Datenpflege erzeugen.
