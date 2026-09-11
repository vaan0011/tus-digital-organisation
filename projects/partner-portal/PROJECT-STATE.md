# PROJECT STATE – TuS Partnerportal

**Stand:** 2026-09-11  
**Phase:** Fachliches Konzept / Vorbereitung  
**Implementierung:** Noch nicht gestartet

## Purpose

Dieses Dokument ist der verbindliche Einstiegspunkt für den aktuellen Projektstand des Partnerportals.

Es hält nur Entscheidungen, verfügbare Grundlagen, offene Abhängigkeiten und den nächsten sinnvollen Arbeitsschritt fest.

## Core Principle

Das Partnerportal wird erst implementiert, wenn der fachliche Kern ausreichend klar ist.

> **Kein Funktionsmonster. Keine doppelte Pflege. Kein WordPress-Backend im Tagesgeschäft.**

Der erste Stand soll die interne Partnerarbeit einfacher, schneller und nachvollziehbarer machen.

## Main Content

### 1. Fachliches Zielbild

Die Sponsoringstrategie ist nicht mehr nur klassische Flächenvermarktung.

Leitgedanke:

> **Aus Sponsoren werden Partner.**

Grundlogik:

> **Unternehmensziel → Partnerwelt → Aktivierung → Reichweite → Partnererlebnis → Wirkung**

Das ausführlichere fachliche Fundament liegt unter:

`../../knowledge/sponsoring/README.md`

Die ergänzende Akquise- und Betreuungsschicht liegt unter:

`../../knowledge/sponsoring/PARTNER-AKQUISE-UND-BETREUUNG.md`

### 2. Verbindliche Produktabgrenzung

Die frühere Überschneidung zwischen Partnerportal und Partner Hub ist entschieden.

Die verbindliche Logik lautet:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

#### Öffentliche Partnerseite

- ist Bestandteil der künftigen TuS-Homepage,
- spricht neue Unternehmen an,
- startet mit dem Unternehmensziel statt mit Werbepaketen,
- bietet einen kurzen Partner-Fit-Check,
- erzeugt strukturierte Partnerschaftsanfragen,
- führt diese direkt in die interne Partnerarbeit,
- erzeugt keine isolierte E-Mail- oder Formulardatenbank.

Die fachliche und technische Spezifikation liegt in:

- `PUBLIC-PARTNER-ENTRY.md`

#### Partnerportal

- ist das **interne Arbeitswerkzeug des TuS**,
- organisiert Interessenten, Journey, Aufgaben, Wiedervorlagen, Partnerziele, Partnerprodukte, Assets, Historie, Kampagnen und interne Auswertung.

#### Partner Hub

- ist die **partnerseitige Oberfläche für bestehende Partner**,
- macht Ziele, Leistungen, Wirkung, Projekte, Kampagnen, Angebote, Jobs, Inhalte und Netzwerk nutzbar,
- unterstützt den jährlichen Partner-Check-in.

Partnerportal und Partner Hub greifen auf gemeinsame fachliche Partnerdaten zurück. Die Produktabgrenzung ist in `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md` dokumentiert.

### 3. Bestätigte Produktentscheidungen

#### Frontend-Anwendung

- tägliche Nutzung ausschließlich im Frontend
- Login für internes TuS-Team
- kein notwendiger Zugriff auf `/wp-admin` für operative Partnerarbeit
- WordPress-Backend bleibt technische Administration

#### Sprache

- komplette Oberfläche auf Deutsch
- deutsche Feldbezeichnungen
- deutsche Statusnamen
- deutsche Nutzerkommunikation

#### UX / UI

- klar
- modern
- hochwertig
- selbsterklärend
- mobil nutzbar
- wenige Schritte je Aufgabe
- konsistente Muster mit Event Planner, Partner Hub und Homepage
- keine typische WordPress-Backend-Optik

#### Öffentlicher Partner-Einstieg

Status: `fachlich spezifiziert`

Verbindlich sind:

- klar sichtbarer Homepage-Einstieg `Partner werden`,
- erste Leitfrage: **„Was möchten Sie mit einer Partnerschaft erreichen?“**,
- ungefähr vier bis fünf kurze Schritte,
- Mehrfachauswahl von Unternehmenszielen,
- passende Partnerwelten / Projekte / Aktivierungsrichtungen als Orientierung,
- keine automatische Preis- oder Leistungszusage,
- strukturierte Lead-Übergabe in die interne Partnerarbeit,
- mobile first,
- serverseitige Validierung und Datenschutz,
- keine dauerhafte harte Kopplung der Homepage an konkrete Google-Sheet-Spalten.

### 4. Geplante Kernbereiche

Für das interne Partnerportal sind fachlich vorgesehen:

- Partner / Unternehmen
- Ansprechpartner
- Partnerschaften und historische Leistungen
- Partnerziele
- Partner Journey
- Partnerprodukte
- Assets / Werbemöglichkeiten
- Events
- Projekte
- Kampagnen
- Aufgaben / Wiedervorlagen
- vereinbarte Leistungen und Status
- Auswertung / Wirkung

Die genaue MVP-Auswahl wird vor Entwicklungsbeginn noch reduziert.

### 5. Partner Journey

Aktueller fachlicher Ablauf:

1. Zielunternehmen
2. Qualifizieren
3. Erstkontakt
4. Bedarfsanalyse
5. Partnerkonzept
6. Angebot
7. Vereinbarung
8. Einführung
9. Aktivierung
10. Beziehung
11. Wirkung
12. Verlängerung / Ausbau

Zusätzlich vorgesehen:

- Soft Exit
- kleine Unterstützung / Tombola / Sachleistung
- Wiedervorlage
- Entwicklung vom kleinen Unterstützer zum Themen- oder strategischen Partner

Ergebnisse des jährlichen Partner-Check-ins aus dem Partner Hub können neue Ziele, Aktivierungen und Verlängerung vorbereiten.

Der minimale Partner-Jahreszyklus ist fachlich in `../../knowledge/sponsoring/PARTNER-AKQUISE-UND-BETREUUNG.md` beschrieben.

### 6. Kampagnen

Kampagnen sind als zentrales verbindendes Objekt vorgesehen.

Typische Formen:

- TuS-Event gemeinsam mit Sponsor aktivieren
- Sponsorenevent auf dem TuS-Gelände
- gemeinsames Projekt oder Arbeitseinsatz mit Sponsor

Eine Kampagne soll vorhandene Partner-, Event-, Projekt- und Assetdaten wiederverwenden und nur wenige zusätzliche Angaben benötigen.

### 7. Vorhandene reale Sponsoringdaten

Folgende Quellen liegen bereits vor:

#### Aktuelle Sponsorenliste

Der Finanzvorstand hat eine aktuelle Liste der bestehenden Sponsoren geliefert.

Noch ausstehend:

- konkrete Leistung / Gegenleistung
- Laufzeit
- jährliche Einnahme
- Vertragsende
- ggf. Ansprechpartner und weitere Vertragsdetails

#### Operatives CRM

Aktuelle geschützte operative Source of Truth:

- `TuS Partner CRM – Operative Source of Truth`

Der Partnership Manager arbeitet dort mit Partnern, Leads, Status, nächsten Schritten, Zieldaten und Projekt-/Kampagnenbezug.

Das ältere `TuS_Partner_System_V1.xlsx` ist nur noch historische Arbeitsreferenz.

#### Bandenwerbung

Historische Excel-Datei mit Jahresreitern von 2005 bis 2026; 2007 fehlt.

Wichtige Feldlogik:

- Adressfeld 1 = Firmenname
- Adressfeld 2 = Beschreibung und/oder Ansprechpartner
- Straße = Firmenanschrift
- PLZ Ort = Sitz / Anschrift
- Position 1 = Leistung
- Zeitraum = Jahr / Saison
- Preis pro qm/Seite = historischer Preis, nicht konsistent gepflegt
- Anzahl qm = Bandenfläche
- Netto = primäre historische Umsatzkennzahl
- USt. = ausgewiesene Umsatzsteuer
- Brutto = Gesamtbetrag inkl. USt.

#### Plakatwerbung

Historische Sponsoringquelle liegt vor und soll je Unternehmen mit der übrigen Historie zusammengeführt werden.

#### Stadionheft

Historische Sponsoringquelle liegt vor und soll je Unternehmen mit der übrigen Historie zusammengeführt werden.

### 8. Zielbild für historische Daten

Nicht nur der aktuelle Vertragsstand wird gespeichert.

Pro Unternehmen soll später nachvollziehbar sein:

- Partner seit
- Leistungen je Jahr
- Werbearten
- Umsatzhistorie
- Unterbrechungen
- Mehrfachbuchungen
- heutige Partnerschaft
- Entwicklungspotenzial

Vor dem Import ist eine Stammdaten- und Dublettenprüfung erforderlich.

### 9. Partner- und Werbeangebot

Bereits identifizierte Asset- und Produktgruppen umfassen unter anderem:

- Bande und Banner
- Stadionheft
- Plakatwerbung
- Trikots und Kleidung
- Homepage und Social Media
- LED Media Screen
- Interview-/Mixed-Zone-Wand
- Spielball-Sockel
- Faltpavillons
- Eventpartnerschaften
- Turnier-Namensrechte
- perspektivische Bereichs- oder Sportpark-Namensrechte
- Recruiting- und Ausbildungspartnerschaften
- Gesundheits- und Sicherheitspartnerschaften
- Jugend- und Entwicklungsprojekte
- Infrastrukturpartnerschaften

Diese Liste ist ein fachlicher Katalog und keine Aufforderung, jede Möglichkeit als eigenes komplexes Produkt anzulegen.

Für Akquise und Gespräche sind zusätzlich vorgesehen:

- TuS Partner-One-Pager,
- kompakte Partner-Präsentation,
- projektspezifische One-Pager nur bei Bedarf,
- reale freigegebene Partnerstories.

### 10. Gemeinsame Datenbasis und Objektverantwortung

Partnerportal und Partner Hub dürfen gemeinsame Informationen nicht unabhängig pflegen.

Vor Implementierung muss entschieden werden, wo die langfristige fachliche Quelle liegt für:

- Partner / Unternehmen
- Ansprechpartner
- Partnerschaft
- Partnerziele
- vereinbarte Leistungen
- Historie
- Kampagnen

Für externe gemeinsame Objekte gilt dieselbe Logik:

- Event Planner soll fachliche Quelle eines Events sein,
- Partnerportal und Partner Hub referenzieren das Event,
- Homepage stellt freigegebene öffentliche Informationen dar,
- Homepage-Partneranfragen werden strukturiert an die operative Partnerarbeit übergeben.

Aktuell ist das native Partner-CRM die operative Source of Truth. Langfristig kann das Partnerportal diese Verantwortung übernehmen.

Für die Homepage gilt deshalb:

> **Die öffentliche Partneranfrage wird über eine austauschbare serverseitige Intake-Grenze angebunden und nicht dauerhaft direkt an konkrete Google-Sheet-Spalten gekoppelt.**

Die konkrete technische Architektur der Intake-Schnittstelle ist noch offen und wird vor Implementierung gegen Architecture Checklist und Stability & Simplicity geprüft.

### 11. Steuer- und Finanzstruktur – noch offen

Es bestehen:

1. TuS 1901 Mingolsheim e.V.
2. Förderverein
3. Jugendförderverein

Die heutige und zukünftige steuerliche Zuordnung wird vor finaler Produkt- und Vertragslogik sauber analysiert.

Der Finanzvorstand stellt dafür noch Unterlagen und Daten bereit, insbesondere:

- Satzungen
- Steuer- und Freistellungsbescheide
- Jahresabschlüsse / EÜR
- Aufteilung der Einnahmen und Ausgaben
- Umsatzsteuerstatus
- Geldflüsse zwischen den drei Vereinen
- Rücklagen und Verbindlichkeiten
- Begründung der bisherigen Werbezuordnung

Wichtige Prüfthemen:

- wirtschaftlicher Geschäftsbetrieb
- § 64 AO und aktuelle Freigrenze
- mögliche 15-%-Gewinnpauschale für geeignete Werbung
- Vorsteuerabzug
- Projekt- und freie Rücklagen
- sachliche Zuständigkeit der drei Vereine

Bis diese Analyse abgeschlossen ist, gibt es **keine finale steuerliche Soll-Struktur**.

### 12. Datenschutz und Vertraulichkeit

Das Repository ist kein CRM.

Nicht im öffentlichen Repository speichern:

- persönliche Kontaktdaten von Sponsoren
- individuelle Vertragswerte
- Steuerbescheide
- Bankdaten
- vertrauliche Vereinbarungen
- nicht öffentliche Finanzdetails

Öffentliche Homepage-Anfragen verarbeiten personenbezogene Daten. Die technische Umsetzung muss die in `PUBLIC-PARTNER-ENTRY.md` definierten Validierungs-, Datenschutz- und Sicherheitsanforderungen erfüllen.

### 13. Parallele TuS-Systeme

Parallel entstehen bzw. bestehen:

- Event Planner
- internes Partnerportal
- Partner Hub
- neue Homepage mit öffentlichem Partner-Einstieg

Zusätzlich wird der extern gehostete Webshop UX-/UI-seitig mitgedacht.

Alle Systeme sollen konsistent wirken und gemeinsame Daten nicht unabhängig mehrfach pflegen.

### 14. Bewusste Grenzen vor Entwicklungsbeginn

Noch nicht bauen:

- Buchhaltung
- Rechnungswesen
- automatische Steuerberechnung
- vollständigen Vertragsgenerator
- LED-Steuerung
- komplexe Marketingautomation
- partnerseitigen Self-Service im Partnerportal; dieser gehört in den Partner Hub
- automatischen Preis- oder Vertragsabschluss im öffentlichen Partner-Fit-Check

Version 1 muss zuerst die **interne Partnerarbeit** überzeugend organisieren. Der öffentliche Homepage-Einstieg kann unabhängig davon als kleiner UX-/Intake-Baustein prototypisiert werden, solange noch kein produktiver CRM-Write-back ohne geklärte Schnittstelle erfolgt.

## Relationship to other documents

- `README.md`
- `PUBLIC-PARTNER-ENTRY.md`
- `../partner-hub/README.md`
- `../partner-hub/PROJECT-STATE.md`
- `../../knowledge/sponsoring/README.md`
- `../../knowledge/sponsoring/CURRENT-STATE.md`
- `../../knowledge/sponsoring/PARTNER-AKQUISE-UND-BETREUUNG.md`
- `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md`
- `../event-planner/PROJECT-STATE.md`
- `../../architecture/stability-and-simplicity.md`
- `../../decisions/architecture-checklist.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/iteration-and-progress.md`

## Future Development

### Nächster fachlicher Schritt

1. fehlende Leistungs-, Laufzeit- und Einnahmedaten der Bestandspartner übernehmen,
2. historische Sponsorendaten normalisieren und Dubletten erkennen,
3. steuerliche Ist-Struktur anhand realer Unterlagen modellieren,
4. gemeinsame Partnerdatenbasis und Objektverantwortung mit Partner Hub definieren,
5. daraus das minimale Datenmodell des internen Partnerportals ableiten,
6. drei bis fünf zentrale interne Screens definieren,
7. MVP verbindlich begrenzen,
8. Intake-Schnittstelle für den öffentlichen Homepage-Einstieg festlegen,
9. Homepage-Partner-Einstieg zunächst als statischen/mobile-first UX-Prototyp umsetzen und prüfen,
10. erst danach produktiven CRM-Write-back aktivieren.

### Abnahmekriterium für den Start der internen Portalentwicklung

Die Entwicklung startet, wenn klar beantwortet werden kann:

- Welche Kernobjekte gibt es?
- Welche Informationen müssen wirklich gepflegt werden?
- Welche drei bis fünf internen Aufgaben muss Version 1 hervorragend lösen?
- Welche Daten kommen aus bestehenden Quellen?
- Welche Daten werden mit dem Partner Hub geteilt?
- Welche Daten dürfen nicht doppelt gepflegt werden?
- Welche steuerlichen Informationen müssen gespeichert, aber nicht automatisch bewertet werden?

Für den **öffentlichen Partner-Einstieg** gelten zusätzlich die Abnahmekriterien aus `PUBLIC-PARTNER-ENTRY.md`.

Bis dahin bleibt das interne Partnerportal bewusst in der Konzeptphase.