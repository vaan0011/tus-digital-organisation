# FUSSBALL.DE Integration

## Purpose

Dieses Dokument definiert das Zielmodell und den notwendigen technischen Spike für die automatisierte Anzeige der TuS-Spiele auf der Homepage.

Es entscheidet bewusst noch keinen ungeprüften Transportweg, legt aber Source of Truth, Datenmodell, Synchronisationsverhalten und Fallbacks verbindlich fest.

## Core Principle

> **FUSSBALL.DE ist die Spielquelle. WordPress zeigt eine kontrolliert synchronisierte TuS-Ansicht – ohne manuelle Doppelpflege.**

## Main Content

### 1. Bestätigter Ausgangspunkt

- FUSSBALL.DE ist fachlich führend für Spielansetzungen, Status und Ergebnisse.
- FUSSBALL.DE stellt registrierten Nutzern offizielle Website-Widgets unter `Meine Widgets` bereit.
- Offizielle Widgets umfassen beziehungsweise umfassten Verein, Mannschaft, Wettbewerb sowie letzte/nächste Spiele.
- 2025 wurden die offiziellen Wettbewerbs-Widgets um weitere Wettbewerbsarten ergänzt.
- Das heute installierte WordPress-Plugin `Include Fussball.de Widgets` ist im offiziellen WordPress-Plugin-Verzeichnis seit 07.11.2025 wegen eines Sicherheitsproblems geschlossen.
- Das geschlossene Plugin und ein generischer Drittanbieter-Widget-Embed sind deshalb keine Zielarchitektur für die TuS-MatchCard.

Offizielle Ausgangsquellen:

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

#### Matchdaten-Adapter

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
5. **Matchplugin fehlt oder ist deaktiviert:** Homepage bleibt funktionsfähig; Matchbereich fällt kontrolliert auf einen Link zurück.

### 9. Technischer Spike vor Implementierung

Der Spike beantwortet mit einem echten TuS-Widget beziehungsweise freigegebenen Website-Zugang:

1. Welche aktuelle offizielle Widget-Variante steht für `tus-mingolsheim.de` zur Verfügung?
2. Welche IDs und Konfigurationswerte liefert `Code anzeigen`?
3. Erfolgt die Datenübertragung als dokumentiertes JSON, serverseitig nutzbare Quelle oder ausschließlich als Browser-Widget?
4. Welche Felder, Statuswerte und Zeitstempel werden tatsächlich geliefert?
5. Welche Nutzungsbedingungen gelten für eigenes serverseitiges Rendering beziehungsweise Zwischenspeicherung?
6. Gibt es Rate Limits, Domainbindung oder Token-/Key-Regeln?
7. Lassen sich Vereinsspielplan und Mannschaftsspielpläne stabil zuordnen?
8. Wie werden Verlegungen, Absetzungen und Ergebnisse dargestellt?
9. Welche Privacy-/Drittanbieterrequests entstehen bei der offiziellen Widget-Variante?
10. Reicht der offizielle Weg für eine eigene MatchCard oder ist eine Abstimmung mit FUSSBALL.DE/DFB erforderlich?

Bis diese Fragen beantwortet sind, wird kein HTML-Scraping oder inoffizieller Endpoint als dauerhaft akzeptierte Schnittstelle implementiert.

### 10. Spike-Erfolgskriterium

Der Spike ist erfolgreich, wenn:

- mindestens ein echter TuS-Vereins- oder Mannschaftsdatensatz reproduzierbar abgerufen wurde,
- Felder und IDs dokumentiert sind,
- die Nutzung für die geplante TuS-Darstellung vertretbar ist,
- Fehler- und Aktualisierungsverhalten bekannt sind,
- eine Entscheidung `offizieller Adapter möglich`, `nur offizielles Widget möglich` oder `Klärung mit Anbieter erforderlich` dokumentiert wurde,
- kein Secret im Repository landet.

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
- `../../design/homepage-standard.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../knowledge/privacy/HOMEPAGE-PLUGIN-MIGRATION.md`

## Future Development

Nach dem Spike wird dieses Dokument um den tatsächlich gewählten Transport, Authentifizierung, Update-Rhythmus, Datenmapping und die konkreten technischen Testfälle ergänzt. Erst dann beginnt der Adapter-Code.
