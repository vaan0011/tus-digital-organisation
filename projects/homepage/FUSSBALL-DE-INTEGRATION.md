# FUSSBALL.DE Integration

## Purpose

Dieses Dokument definiert das Zielmodell und den notwendigen technischen Spike für die automatisierte Anzeige der TuS-Spiele auf der Homepage.

Der offizielle Transportweg ist inzwischen teilweise geklärt: Eine direkte FUSSBALL.DE-API steht derzeit nicht zur Verfügung; automatisierte Lieferungen werden über Sportmedia per SFTP angeboten. Dieses Dokument legt die daraus folgende Modulgrenze, den verbleibenden Provider-Spike, das Datenmodell, Synchronisationsverhalten und Fallbacks verbindlich fest.

## Core Principle

> **FUSSBALL.DE ist die Spielquelle. WordPress zeigt eine kontrolliert synchronisierte TuS-Ansicht – ohne manuelle Doppelpflege.**

## Main Content

### 1. Bestätigter Ausgangspunkt

- FUSSBALL.DE ist fachlich führend für Spielansetzungen, Status und Ergebnisse.
- Die offizielle FUSSBALL.DE-FAQ erklärt, dass eine direkte Schnittstelle derzeit nicht möglich ist.
- Für automatisierte Datenlieferungen verweist FUSSBALL.DE auf Sportmedia und einen automatisierten Versand per SFTP.
- Als verfügbare Datenprodukte werden Ergebnisse und Tabellen, Spielberichte sowie Spielpläne genannt.
- FUSSBALL.DE stellt registrierten Nutzern zusätzlich offizielle Website-Widgets unter `Meine Widgets` bereit.
- Offizielle Widgets umfassen beziehungsweise umfassten Verein, Mannschaft, Wettbewerb sowie letzte/nächste Spiele.
- 2025 wurden die offiziellen Wettbewerbs-Widgets um weitere Wettbewerbsarten ergänzt.
- Das heute installierte WordPress-Plugin `Include Fussball.de Widgets` ist im offiziellen WordPress-Plugin-Verzeichnis seit 07.11.2025 wegen eines Sicherheitsproblems geschlossen.
- Das geschlossene Plugin und ein generischer Drittanbieter-Widget-Embed sind deshalb keine Zielarchitektur für die TuS-MatchCard.

Offizielle Ausgangsquellen:

- https://next.fussball.de/faq – Abschnitt „Gibt es eine Schnittstelle/API“
- https://www.fussball.de/newsdetail/so-baue-ich-widgets-ein-tipps-fuer-webmaster/-/article-id/130660
- https://www.fussball.de/newsdetail/neue-wettbewerbs-widgets-fuer-eure-vereinsseite-jetzt-mit-pokalen-und-turnieren/-/article-id/10062803
- https://wordpress.org/plugins/include-fussball-de-widgets/

### 2. Verbindliche fachliche Zuordnung

| Externe Bezeichnung | Öffentliche TuS-Bezeichnung |
|---|---|
| `TuS Mingolsheim` | `1. Mannschaft Herren` |
| `TuS Mingolsheim 2` | `2. Mannschaft Herren` |
| `SpG St. Leon/Mingolsheim` | `Frauenmannschaft` |
| Jugendmannschaften | jeweilige FUSSBALL.DE-Jugendbezeichnung |

Diese Zuordnung gehört saisonbezogen zum Team Manager und nicht in das Theme.

### 3. Verantwortungsgrenzen

#### FUSSBALL.DE

Führende Quelle für:

- Ansetzung,
- Datum und Uhrzeit,
- Heim-/Gastmannschaft,
- Status,
- Ergebnis,
- Wettbewerb/Staffel,
- Spielort, soweit verfügbar,
- externe Spiel- und Mannschaftsidentifikatoren.

#### Team Manager

Führende Quelle für:

- TuS-Mannschaftsidentität,
- Saisonbezug,
- öffentliche Bezeichnung,
- Zuordnung zur externen FUSSBALL.DE-Mannschaft,
- Prioritätsgruppe Herren/Frauen/Jugend.

#### Team-Manager-Matchdaten-Modul

Gemäß `ADR-0012` ist der Matchdaten-Adapter ein abgegrenztes Modul des Team Managers.

Verantwortlich für:

- technischen Abruf beziehungsweise Import,
- Validierung und Normalisierung,
- persistente lokale Projektion,
- Aktualisierung und Retry,
- Status des letzten erfolgreichen Laufs,
- öffentliche Match-Block-/Render-Schnittstelle.

#### Theme

Verantwortlich für:

- visuelle MatchCard-Tokens,
- responsive Darstellung,
- Typografie, Farben, Abstände und Interaktionszustände.

Das Theme importiert keine Spieldaten.

### 4. Mindestmodell der externen Teamzuordnung

Die saisonbezogene Zuordnung benötigt mindestens:

- interne Team-/Team-Saison-ID,
- Quellsystem `fussball.de`,
- externe Vereinskennung, soweit benötigt,
- externe Mannschaftskennung,
- externe Originalbezeichnung,
- öffentliche TuS-Bezeichnung,
- Gültigkeit/Saison,
- Prioritätsgruppe,
- offizielle Quell-URL,
- Status der Zuordnung.

Die Zuordnung ist konfigurierbar und wird nicht anhand des Mannschaftsnamens bei jedem Lauf geraten.

### 5. Normalisiertes Matchmodell

Die lokale, regenerierbare Projektion enthält mindestens:

- stabile externe Spiel-ID,
- zugeordnete interne Team-Saison-ID,
- Wettbewerb/Staffel, soweit geliefert und benötigt,
- Anstoßzeit mit Zeitzone `Europe/Berlin`,
- Heimteam und Gastteam,
- Heim-/Auswärtsbezug des TuS-Teams,
- Spielort und Adresse, soweit geliefert,
- Status, zum Beispiel angesetzt, verlegt, abgesetzt, laufend oder beendet,
- Ergebnis, sofern vorhanden,
- offizielle Quell-URL,
- Änderungszeit der Quelle, soweit verfügbar,
- Zeitpunkt des letzten erfolgreichen Imports,
- technischer Fingerprint zur Erkennung von Änderungen.

Spieler-, Torschützen-, Karten- oder andere personenbezogene Detaildaten werden für die Homepage-MatchCard nicht importiert, solange kein separat freigegebener fachlicher Bedarf besteht.

### 6. Auswahl für die Startseite

Die Startseite zeigt standardmäßig die Spiele der nächsten sieben Kalendertage.

Priorität:

1. 1. Mannschaft Herren,
2. 2. Mannschaft Herren,
3. Frauenmannschaft,
4. Jugendspiele als reduzierte Auswahl beziehungsweise Zusammenfassung,
5. Einstieg `Alle Spiele`.

Abgesetzte oder verlegte Spiele werden nicht still entfernt, sondern mit verständlichem Status dargestellt, solange sie im Zeitraum relevant sind.

Die Auswahlregel liegt im Match-/Homepage-Block, nicht als manuell gepflegte Liste auf der Startseite.

### 7. Synchronisationsprinzip

Verbindlich:

- kein externer Live-Request bei jedem öffentlichen Seitenaufruf,
- serverseitige geplante Synchronisation,
- zusätzlicher manueller Retry für berechtigte Administratoren,
- idempotente Updates anhand der externen Spiel-ID,
- bestehende Datensätze werden aktualisiert, nicht bei jedem Lauf dupliziert,
- letzte erfolgreiche Projektion bleibt bei einem vorübergehenden Quellausfall verfügbar,
- technischer Fehlerstatus und letzter erfolgreicher Lauf sind intern sichtbar,
- öffentliche Ausgabe enthält keine technischen Fehlermeldungen,
- öffentliche MatchCard verlinkt auf die offizielle Quelle.

Der genaue Rhythmus wird erst nach Kenntnis von Quelle, Rate Limits und realem Änderungsverhalten festgelegt. Die Architektur unterstützt mindestens regelmäßige Aktualisierung und einen gezielten manuellen Lauf.

### 8. Fallbacks

1. **Quelle kurzfristig nicht erreichbar:** letzten erfolgreichen Stand anzeigen; intern Warnung und Retry ermöglichen.
2. **Noch kein erfolgreicher Import:** neutraler Empty State mit Link zum offiziellen Vereinsspielplan.
3. **Zuordnung fehlt:** betroffene externe Mannschaft nicht automatisch einer internen Mannschaft zuweisen; administrativ als ungeklärte Zuordnung melden.
4. **Daten sind erkennbar veraltet:** Stand transparent machen und offiziellen Link anbieten.
5. **Team Manager beziehungsweise Matchdaten-Modul fehlt oder ist deaktiviert:** Homepage bleibt funktionsfähig; Matchbereich fällt kontrolliert auf einen Link zurück.

### 9. Provider-Spike vor Implementierung

Der fachliche Transportweg ist eingegrenzt: Ziel ist eine offizielle Sportmedia-Datenlieferung per SFTP. Vor produktivem Connector-Code werden folgende Punkte mit einem realen TuS-Datenprodukt verifiziert:

1. Ansprechpartner, Bestell-/Antragsweg und technische Bereitstellung,
2. Nutzungsbedingungen und mögliche Kosten,
3. repräsentative Beispieldatei,
4. Dateiformat, Zeichencodierung und Schema,
5. Lieferfrequenz und Änderungsverhalten,
6. externe IDs für Verein, Mannschaft, Wettbewerb und Spiel,
7. Statuswerte für angesetzt, verlegt, abgesetzt, laufend und beendet,
8. Zuordnung von Vereinsspielplan und Mannschaftsspielplänen,
9. Umfang von Spielort, Ergebnis und Halbzeitstand,
10. Eignung für Homepage-Block und lesende Matchday-Schnittstelle,
11. Authentifizierung, Secret-Verwaltung, Retry und Aufbewahrung,
12. datenschutzbezogener Umfang und Datenminimierung.

Bis diese Fragen beantwortet sind, wird kein produktiver SFTP-Connector implementiert. HTML-Scraping, inoffizielle Endpunkte und saisonale Widget-Codes werden nicht als dauerhafte Ausweichlösung eingebaut.

### 10. Spike-Erfolgskriterium

Der Provider-Spike ist erfolgreich, wenn:

- eine reale oder repräsentative Sportmedia-Lieferung reproduzierbar verarbeitet werden kann,
- Bedingungen, mögliche Kosten und Betriebsweg dokumentiert sind,
- Felder, IDs, Statuswerte und Zeichencodierung bekannt sind,
- die saisonbezogene Mannschaftszuordnung belastbar möglich ist,
- Fehler- und Aktualisierungsverhalten bekannt sind,
- Homepage- und Matchday-Bedarf gegen die gelieferten Daten geprüft sind,
- kein Secret im Repository landet,
- eine Entscheidung `Sportmedia-Connector umsetzen` oder `Transportentscheidung gemäß ADR-0012 erneut öffnen` dokumentiert wurde.

### 11. Abnahmekriterien der späteren Integration

- Nächste sieben Tage werden korrekt angezeigt.
- Die drei Erwachsenenbezeichnungen entsprechen der beschlossenen TuS-Zuordnung.
- Jugendteams behalten ihre fachliche Jugendbezeichnung.
- Abgesetzte/verlegte Spiele sind verständlich erkennbar.
- Kein manuelles Copy-and-Paste von Spielen in WordPress ist nötig.
- Ein Quellausfall zerstört nicht die Startseite.
- Der letzte erfolgreiche Import ist intern nachvollziehbar.
- Desktop, Tablet, Smartphone und Tastaturbedienung sind geprüft.
- Theme-Wechsel erfordert keine Änderung des Import- oder Matchdatenmodells.

## Relationship to other documents

- `README.md`
- `PROJECT-STATE.md`
- `ARCHITECTURE.md`
- `CONTENT-MODEL.md`
- `../team-manager/PROJECT-STATE.md`
- `../team-manager/FUNCTIONAL-SCOPE.md`
- `../team-manager/MATCH-DATA-MODULE.md`
- `../../decisions/ADR-0012-team-manager-match-data-module.md`
- `../../design/homepage-standard.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../knowledge/privacy/HOMEPAGE-PLUGIN-MIGRATION.md`

## Future Development

Nach dem Provider-Spike wird dieses Dokument um die verifizierten Sportmedia-Transportdetails, Authentifizierung, den Update-Rhythmus, das reale Datenmapping und die konkreten technischen Testfälle ergänzt. Erst dann beginnt der produktive Connector-Code.
