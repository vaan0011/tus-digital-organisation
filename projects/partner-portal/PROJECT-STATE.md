# PROJECT STATE – TuS Partnerportal

**Stand:** 2026-09-04  
**Phase:** Fachliches Konzept / Vorbereitung  
**Implementierung:** Noch nicht gestartet

## Purpose

Dieses Dokument ist der verbindliche Einstiegspunkt für den aktuellen Projektstand des Partnerportals.

Es hält nur Entscheidungen, verfügbare Grundlagen, offene Abhängigkeiten und den nächsten sinnvollen Arbeitsschritt fest.

## Core Principle

Das Partnerportal wird erst implementiert, wenn der fachliche Kern ausreichend klar ist.

> **Kein Funktionsmonster. Keine doppelte Pflege. Kein WordPress-Backend im Tagesgeschäft.**

Der erste Stand soll die Partnerarbeit einfacher, schneller und nachvollziehbarer machen.

## Main Content

### 1. Fachliches Zielbild ist ausreichend umrissen

Die Sponsoringstrategie ist nicht mehr nur klassische Flächenvermarktung.

Leitgedanke:

> **Aus Sponsoren werden Partner.**

Grundlogik:

> **Unternehmensziel → Partnerwelt → Aktivierung → Reichweite → Partnererlebnis → Wirkung**

Das ausführlichere fachliche Fundament liegt unter:

`../../knowledge/sponsoring/README.md`

### 2. Bestätigte Produktentscheidungen

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
- konsistente Muster mit Event Planner und Homepage
- keine typische WordPress-Backend-Optik

### 3. Geplante Kernbereiche

Für den ersten fachlichen Stand sind vorgesehen:

- Partner / Unternehmen
- Ansprechpartner
- Partnerschaften und historische Leistungen
- Partner Journey
- Partnerprodukte
- Assets / Werbemöglichkeiten
- Events
- Projekte
- Kampagnen
- Aufgaben / Wiedervorlagen
- Auswertung / Wirkung

Die genaue MVP-Auswahl wird vor Entwicklungsbeginn noch reduziert.

### 4. Öffentliche Partner-Landingpage

Das Plugin soll neben dem geschützten internen Bereich auch eine öffentliche Partnerseite unterstützen.

Die Seite soll nicht nur bestehende Sponsorenlogos zeigen, sondern Unternehmen interaktiv über ihre Ziele abholen.

Möglicher Einstieg:

> **Was möchten Sie mit einer Partnerschaft erreichen?**

Eine Anfrage soll strukturiert in die interne Partnerarbeit übergehen.

Perspektivisch ist ein eigener Login-Bereich für bestehende Partner möglich, aber kein Muss für Version 1.

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

### 10. Projektprioritäten

#### Kurzfristig

- Fassade Hauptgebäude
- LED Media Screen
- Böden Umkleiden
- Tore / Netze
- finanzieller Puffer für laufende Kosten

#### Mittelfristig

- Festplatz-Funktionsgebäude
- Jugendräume
- Sportparkteam
- Bekleidungslager / Vereins-Shop
- Rücklagenaufbau

#### Langfristig

- Kunstrasen
- weitere Sportpark- und Zauninfrastruktur

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

Solche Daten gehören später in das geschützte Partnerportal bzw. in die dafür vorgesehenen Finanzsysteme.

### 13. Parallele WordPress-Projekte

Parallel entstehen:

- Event Planner
- Partnerportal
- neue Homepage

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
- umfangreichen Partner-Self-Service

Version 1 muss zuerst die tägliche Partnerarbeit überzeugend organisieren.

## Relationship to other documents

- `README.md`
- `../../knowledge/sponsoring/README.md`
- `../event-planner/PROJECT-STATE.md`
- `../../architecture/stability-and-simplicity.md`
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
4. daraus das minimale Datenmodell des Partnerportals ableiten,
5. drei bis fünf zentrale Screens definieren,
6. MVP verbindlich begrenzen,
7. erst danach Implementierung starten.

### Abnahmekriterium für den Start der Entwicklung

Die Entwicklung startet, wenn klar beantwortet werden kann:

- Welche Kernobjekte gibt es?
- Welche Informationen müssen wirklich gepflegt werden?
- Welche drei bis fünf Aufgaben muss Version 1 hervorragend lösen?
- Welche Daten kommen aus bestehenden Quellen?
- Welche Daten dürfen nicht doppelt gepflegt werden?
- Welche steuerlichen Informationen müssen gespeichert, aber nicht automatisch bewertet werden?

Bis dahin bleibt das Projekt bewusst in der Konzeptphase.