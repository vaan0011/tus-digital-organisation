# TuS Project Portfolio

Stand: 2026-09-15 – Drive-Projektinventur formalisiert

## Purpose

Dieses Dokument ist die zentrale organisationsweite Übersicht über relevante TuS-Projekte und Projektkandidaten.

Es ist kein zweites Projektmanagement-System und ersetzt keine `PROJECT-STATE.md`.

## Core Principle

> **Detailwahrheit im Projekt. Portfolioübersicht zentral.**

Andere Mitarbeiter sollen von hier aus schnell erkennen können, welche Vorhaben existieren, wo der aktuelle Stand liegt, wer fachlich zuständig ist und welche Abhängigkeiten relevant sind.

## Main Content

### 1. Inventur-Ergebnis

Die aktuelle Repository- und Drive-Prüfung ergibt:

- **21 formale Projekte** unter `projects/`, jeweils mit `README.md` und `PROJECT-STATE.md`,
- davon **3 Aktiv**, **1 Geplant** und **17 Discovery**,
- weitere reale Projektkandidaten aus Homepage-, Infrastruktur-, Archiv- und Förderarbeit,
- laufende Facharbeit und Regelbetrieb bleiben bewusst außerhalb des Projektmodells.

Am 15.09.2026 wurden sieben bereits real vorhandene Drive-Projektordner formalisiert:

- Zaunanlage,
- Kunstrasen,
- Raucherraum / Kioskbereich,
- Advanced Football,
- Veranstaltungsorganisation 2026/27,
- Getränkelieferant 2027,
- DFB Vereinsheim 2.0.

Die explizite Projektentscheidung hebt `Kunstrasen` vom bisherigen Kandidaten zum formalen Projekt hoch. Beim Raucherraum bleibt die frühere Einordnung kleiner Instandhaltungsarbeiten als Regelbetrieb gültig; formalisiert wird jetzt die **größere funktionale/räumliche Weiterentwicklung**. Ebenso bleibt allgemeiner Material-/Beschaffungsbetrieb Regelbetrieb, während die klar abgegrenzte Lieferantenumstellung 2027 ein eigenes Projekt ist.

### 2. Formale Projekte

| Projekt | Fachlicher Verantwortungsbereich / Owner | Status | Verbindliche Detailquelle | Nächster sinnvoller Schritt | Wesentliche Abhängigkeit / Portfolio-Hinweis | Querschnitt |
|---|---|---|---|---|---|---|
| Event Planner | Veranstaltungen; technischer Owner: WordPress Developer; fachlicher Produkt-Owner nicht explizit benannt | Aktiv | `event-planner/PROJECT-STATE.md` | aktuellen Dashboard-/Historienstand im Playground manuell prüfen und danach Event-Anlegen-UI weiterführen | digitale Anwendung; keine zweite fachliche Eventplanung | Entwicklung, Design, Veranstaltungsorganisation, Mitglieder & Engagement, Team Manager |
| Mitglieder & Engagement | Mitglieder / Engagement / Organisation; Owner offen | Discovery | `member-engagement/PROJECT-STATE.md` | bestehende Mitgliederverwaltung analysieren und gemeinsame Personen-/Mitgliedsidentität definieren | keine zweite Personendatenwelt | Entwicklung, Datenschutz, Veranstaltungen, Sport, Vorstand/GV |
| Partner Hub | Sponsoring / Partnership Manager | Discovery | `partner-hub/PROJECT-STATE.md` | gemeinsame Partnerdatenbasis, Rollen/Freigaben, Account-Lifecycle und MVP-Grenzen konkretisieren | partnerseitige Oberfläche für bestehende Partner | Sponsoring, Entwicklung, Design, Homepage, Event Planner |
| Partnerportal | Sponsoring / Partnership Manager | Discovery | `partner-portal/PROJECT-STATE.md` | reale Sponsorendaten und Steuer-Ist konsolidieren und internes MVP reduzieren | internes TuS-Arbeitswerkzeug; gemeinsame Partnerdatenbasis mit Partner Hub | Sponsoring, Finanzen/Steuer, Entwicklung, Design |
| TuS Tauschbörse | Gesellschaft & Soziales; Owner offen | Discovery | `reuse-marketplace/PROJECT-STATE.md` | Vermittlungsablauf, Datenschutz/Missbrauchsschutz und Spendenweg konkretisieren | noch kein produktiver Implementierungsstand | Entwicklung, Design, Datenschutz, Gesellschaft & Soziales |
| Team Manager | Sport; Owner offen | Discovery | `team-manager/PROJECT-STATE.md` | gemeinsame Mannschaftsidentität und Saisonmodell definieren | keine parallele Mannschafts-/Personendatenwelt | Sport, Entwicklung, Datenschutz, Platzbelegung, Homepage |
| LED Media Screen | Sponsoring / Infrastruktur / Kommunikation; Owner offen | Discovery | `led-media-screen/PROJECT-STATE.md` | Technik, Fundament, Strom, Genehmigung und Gesamtfinanzierung klären | keine Bestellung ausgelöst | Partnership, Funding, Infrastruktur, Finanzen, Vorstand |
| Aufbau Digitale Vereinsorganisation | Vereinsentwicklung / Digitalisierung; Owner offen | Aktiv | `digital-organisation/PROJECT-STATE.md` | Ersatzförderung recherchieren und Aufbauarbeitspakete weiter schärfen | Aufbauprojekt, nicht dauerhafter Regelbetrieb | Funding, Portfolio, Entwicklung, Datenschutz/IT, Vorstand |
| Großfeldtore Haupt- und Trainingsplatz | Sport / Infrastruktur; Owner offen | Geplant | `grossfeldtore-haupt-trainingsplatz/PROJECT-STATE.md` | BSB-Konfiguration, Eigentums-/Nutzungsstatus, Netze, Versand, Fundament und Gesamtpreis klären | vor Bestellung förder-/budgetseitig absichern | Funding, Sport, Infrastruktur, Finanzen, Vorstand |
| Arbeitsplatz Sportparkteam | Sportpark / Infrastruktur / Vereinsentwicklung; Owner offen | Discovery | `arbeitsplatz-sportparkteam/PROJECT-STATE.md` | Förderfähigkeit/Jobcenter klären und danach Tätigkeitsprofil/Stundenmodell | Beschäftigungs- und Finanzierungsvoraussetzungen offen | Funding, Partnership, Infrastruktur, Finanzen/Lohn, Datenschutz |
| Trainingskleidung Ausstattungsgrundstock | Sport / Ausstattung / Partnerships; Owner offen | Discovery | `trainingskleidung-ausstattungsgrundstock/PROJECT-STATE.md` | Hauptpartnerangebot, Leads, Rechte und Größenverteilung klären | SPORTINN/Joma bleibt Ausrüster; separater Finanzierungspartner | Partnership, Sport, Finanzen, Design |
| Kinder- und Jugendschutz einführen | Jugend / Vereinsentwicklung / Schutz & Prävention; Owner zu benennen | Discovery | `kinder-jugendschutz/PROJECT-STATE.md` | Vorstandsverantwortung und Vertrauenspersonen bestimmen, §72a klären, Risikoanalyse starten | Schutzfälle nicht in normale KI-/n8n-Queues | Jugend, Vorstand, Datenschutz, Trainer/Betreuer |
| Stadionheft / Spieltagsmagazin Herren | Redaktion / Kommunikation / Herrenfußball; Owner offen | Discovery | `stadionheft/PROJECT-STATE.md` | Master-Druckvorlage, Referenzausgaben und Anzeigenordner identifizieren | keine Automatisierung ohne gesicherte Masterassets | Matchday, Archiv, Design, Partnership, Event Planner |
| TuS Platzbelegung | Sport / Jugend / Sportpark / Veranstaltungen; technischer Owner: WordPress Developer | Discovery | `platzbelegung/PROJECT-STATE.md` | Ressourcenliste/Belegungsquellen aufnehmen und V1-Datenobjekte definieren | keine neue Kalenderinsel | Entwicklung, Datenschutz, Homepage, Sport, Jugend, Infrastruktur |
| Zaunanlage | Sportpark / Infrastruktur; Owner offen | Discovery | `zaunanlage/PROJECT-STATE.md` | Ist-Situation vermessen und aktualisiertes Angebot einholen | vorhandenes Angebot von 2022 nur historische Orientierung | Funding, Partnership, Finanzen, Vorstand |
| Kunstrasen | Infrastruktur / Sport / Finanzen; Owner offen | Discovery | `kunstrasen/PROJECT-STATE.md` | sportlichen Scope der drei Flächen priorisieren, Trägerschaft klären und Kosten aktualisieren | drei Becker-Kostenvoranschläge vom 17.04.2025 ergeben aktuell 720.925,69 € brutto Orientierungswert | Funding, Infrastruktur, Sport, Finanzen, Sponsoring, Gemeinde |
| Raucherraum / Kioskbereich | Sportpark / Infrastruktur / Veranstaltungen; Owner offen | Discovery | `raucherraum/PROJECT-STATE.md` | künftige Nutzung des ca. 21,6-m²-Bereichs entscheiden und daraus Raum-Scope ableiten | kleine Instandhaltung bleibt Sportpark-Regelbetrieb; Projekt betrifft funktionale Weiterentwicklung | DFB Vereinsheim 2.0, Veranstaltungen/Kiosk, Funding, Finanzen |
| Advanced Football | Sport / Jugend / Trainerentwicklung; Owner offen | Discovery | `advanced-football/PROJECT-STATE.md` | aktuellen Anbieterstatus, Nutzen und Datenschutz-/Accountmodell verifizieren | historische Coachliste enthält geschützte personenbezogene Daten und wird nicht repliziert | Datenschutz, Team Manager, Sport/Jugend, Digitalisierung |
| Veranstaltungsorganisation 2026/27 | Veranstaltungen / Organisation; Owner offen | Discovery | `veranstaltungsorganisation-2026-27/PROJECT-STATE.md` | Eventliste 2026/27, Termine und Owner konsolidieren und nächstes Event mit Vorjahresdaten aufsetzen | fachliches Projekt; Event Planner bleibt digitales Werkzeug | Event Planner, Beschaffung, Helfer, Partnership, Finanzen, Kommunikation |
| Getränkelieferant 2027 | Beschaffung / Veranstaltungen / Kiosk; Owner offen | Aktiv | `getraenkelieferant-2027/PROJECT-STATE.md` | Kiosk-Jahresbedarf ergänzen und vergleichbare Angebote für Events bzw. Events+Kiosk einholen | fünf Bedarfsblöcke mit 17.083,52 € brutto bekannt; Anbieterentscheidung offen | Veranstaltungen, Event Planner, Partnership, Finanzen, Vorstand |
| DFB Vereinsheim 2.0 | Vereinsentwicklung / Infrastruktur / Sportpark; Owner offen | Discovery | `dfb-vereinsheim-2-0/PROJECT-STATE.md` | Projektteam bilden und mit Vereinssteckbrief, Rahmenbedingungen, Finanzen, Vision und Bedarf starten | übergeordnete Bedarfs-/Entwicklungsplanung; ersetzt konkrete Infrastrukturprojekte nicht | Vorstand, Infrastruktur, Sport/Jugend, Funding, Partnership, Finanzen, Gemeinde |

### 3. Aktualität der formalen Projektzustände

Die verbindlichen Details liegen jeweils im `PROJECT-STATE.md`. Für die sieben am 15.09.2026 neu formalisierten Projekte gilt:

| Projekt | Portfolio-Befund | Erforderliche Pflege |
|---|---|---|
| Zaunanlage | **formalisiert / Altangebot vorhanden** | nach Aufmaß und aktuellem Angebot aktualisieren |
| Kunstrasen | **formalisiert / belastbarer historischer Kostencheckpoint** | nach Scope-/Trägerschaftsentscheidung und aktualisiertem Kostenstand aktualisieren |
| Raucherraum / Kioskbereich | **formalisiert / Nutzung offen** | nach Nutzungsentscheidung und Raum-Scope aktualisieren |
| Advanced Football | **formalisiert / historischer Registrierungsbestand** | nach aktueller Anbieter-, Nutzen- und Datenschutzprüfung aktualisieren |
| Veranstaltungsorganisation 2026/27 | **formalisiert / Eventinventur offen** | nach Eventliste, Terminen und Ownern aktualisieren |
| Getränkelieferant 2027 | **aktiv / Bedarfsprofil weit fortgeschritten** | nach Kiosk-Daten, Angeboten und Lieferantenentscheidung aktualisieren |
| DFB Vereinsheim 2.0 | **formalisiert / Methodik vollständig vorhanden** | nach Projektteam und erster TuS-spezifischer Bedarfs-/Bestandsarbeit aktualisieren |

Die zuvor bestehenden vierzehn Projektzustände bleiben unverändert verbindlich und werden nur bei realen Zustandsänderungen gepflegt.

### 4. Reale Projektkandidaten

| Vorhaben | Status | Möglicher fachlicher Bereich / Owner | Warum portfolio-relevant | Nächste Portfolio-Aktion | Querschnitt |
|---|---|---|---|---|---|
| Neuaufbau TuS-Homepage | Kandidat | Kommunikation; Owner festzulegen | Zielbild und technische Migrationsbefunde sind gereift | Owner und Relaunch-/Migrationsscope klären | Entwicklung, Design, Team Manager, Event Planner, Partnerdaten, Datenschutz, Archiv |
| Umkleideböden / klar abgegrenzte Umkleidesanierung | Kandidat | Infrastruktur / Sport | qualifizierte Förder-/Investitionschance | technischen Scope, Ist-/Zielzustand, Kosten und Eigentum/Nutzungsrecht klären; DFB-Vereinsheim-Analyse nutzen | Funding, Infrastruktur, Finanzen, Sport |
| Hauptgebäude / Fassade | Kandidat | Infrastruktur | kurzfristig priorisierte Gebäudeaufwertung | Optik/Instandhaltung von energetischer Sanierung trennen; in DFB Vereinsheim 2.0 einordnen | Funding, Sponsoring, Infrastruktur, Finanzen, Design |
| Jugendräume | Kandidat | Jugend / Infrastruktur | mittelfristiges Infrastruktur-/Jugendvorhaben | Bedarf, Nutzergruppen, Standort, Scope und Finanzierung über DFB-Vereinsheim-Analyse schärfen | Funding, Jugend, Infrastruktur, Sponsoring, Design |
| Funktions-/Unterstellgebäude Festplatz | Kandidat | Infrastruktur / Veranstaltungen | mittelfristiges Bau-/Nutzungsprojekt | Bedarf, Nutzung, Genehmigung, Kosten und Owner klären | Funding, Infrastruktur, Veranstaltungen, Sponsoring |
| Bekleidungslager / physischer Vereins-Shop | Kandidat | Organisation / Merch / Finanzen | reale räumliche Infrastrukturfrage | physischen Lager-/Ausgabebedarf vom Webshop trennen | Organisation, Finanzen, Design, Sponsoring |
| Energie / PV / Speicher / Klimaschutzmaßnahmen | Kandidat | Infrastruktur / Nachhaltigkeit / Finanzen | potenziell größere Investitions-/Fördermaßnahme | Gebäude/Anlage, technisches Ziel und Wirtschaftlichkeit bestimmen; DFB-Vereinsheim-Ergebnisse berücksichtigen | Funding, Infrastruktur, Finanzen |
| Bewässerungsanlage / nachhaltige Platzpflege-Investition | Kandidat | Infrastruktur / Sport | konkretes Investitionsfeld | realen Bedarf, Technik, Eigentums-/Nutzungsrecht und Kosten klären | Funding, Infrastruktur, Sport, Finanzen |
| Aufbau / nachhaltige Organisation Sportparkteam | Kandidat | Infrastruktur / Vereinsentwicklung | mögliches Organisationsvorhaben zusätzlich zum konkreten Arbeitsplatz | prüfen, ob neben `arbeitsplatz-sportparkteam/` ein eigener Organisationsscope nötig ist | Vereinsentwicklung, Infrastruktur, Funding, Sponsoring |
| Historienarchiv – abgegrenztes Erschließungs-/Digitalisierungsprojekt | Kandidat | Archiv & Vereinsgeschichte / Archivist | klar abgrenzbarer Förder-/Digitalisierungsoutput möglich | Bestand, Ziel, Output, Metadaten, Zugänglichkeit und Kosten als Projektskizze definieren | Archiv, Funding, Kommunikation, Design, Datenschutz/IT |
| Historien-/Jubiläumspublikation oder andere konkrete Archiv-Ausgabe | Kandidat | Archiv & Vereinsgeschichte / Kommunikation | konkrete Publikation kann eigenes Ergebnis besitzen | erst bei beschlossenem Produkt, Umfang, Termin und Owner formalisieren | Archiv, Kommunikation, Design, Homepage/Print |

### 5. Bewusst nicht als eigenständige Projekte geführt

| Thema / Vorhaben | Einordnung | Portfolio-Begründung / Zuordnung |
|---|---|---|
| 125-Jahre-Jubiläumszuschüsse nach bereits realisiertem Jubiläum | Einzelaufgabe | administrative Nachprüfung |
| Finanzpuffer / Rücklagenaufbau | Regelbetrieb / Finanzziel | laufende Finanzsteuerung |
| Sponsoringstrategie und laufende Partnerarbeit | Regelbetrieb / Fachbereich | Partnership Manager; Produktentwicklung in Partnerportal/Partner Hub |
| Konsolidierung historischer Sponsorendaten | Arbeitsaufgabe / Discovery-Zulieferung | Grundlage für Sponsoring und Partnerportal |
| Funding Radar / Förderkalender / Programmdossiers | Regelbetrieb / Fachbereich | Funding & Grants Manager; konkrete Vereinsvorhaben bleiben Projekte/Kandidaten |
| Vereinsgeschichte / Historienarchiv als Ganzes | Regelbetrieb / Fachbereich | dauerhafte Archivistenaufgabe |
| Homepage/Facebook/Instagram als Archivquellen | Regelbetrieb / Fachquelle | Bestandteil des Archivisten-Loops |
| allgemeiner Sportpark-Materialradar und wiederkehrende Kiosk-/Materialbeschaffung | Arbeits-/Runtime-Kandidat | laufender Betriebsbedarf; **Getränkelieferant 2027** ist nur wegen der abgegrenzten Lieferantenumstellung ein Projekt |
| kleine Sportpark-Instandhaltung, z. B. reines Streichen | Regelbetrieb | **Raucherraum/Kioskbereich** ist nur wegen der größeren Nutzungs-/Raumentwicklung ein Projekt |
| Scouting Jugend und Herren | Arbeits-/Runtime-Kandidat | wiederkehrender sportlicher Beobachtungsprozess |
| TuS Digital Organisation – dauerhafter Betrieb nach der Aufbauphase | Programm / Regelbetrieb | `digital-organisation/` beschreibt Aufbau/Konsolidierung |
| externer Webshop – laufende UX/UI-Angleichung | laufende Design-/Betriebsaufgabe | erst bei klarer Relaunch-/Migration als Projekt prüfen |
| Jugend- und Mädchenfußball allgemein | laufendes Fach-/Förderfeld | konkrete Initiativen separat prüfen |
| Trainer- und Schiedsrichterentwicklung allgemein | laufendes Fach-/Förderfeld | **Advanced Football** ist nur die abgegrenzte Plattformprüfung/-einführung |
| FSJ / Bildung / Ausbildung | laufendes Fach-/Förderfeld | konkrete Einführung separat prüfen |
| Ghana-Unterstützung / `Kinder von Atibie` allgemein | laufendes soziales Feld | konkrete Vorhaben separat prüfen |
| Integration / Beschäftigung / soziale Träger allgemein | laufendes Fach-/Förderfeld | konkretes Vorhaben `arbeitsplatz-sportparkteam/` ist formalisiert |
| Barrierefreiheit / Teilhabe allgemein | Projektfeld | noch kein ausreichend abgegrenztes Vorhaben |
| Theater / Kultur allgemein | laufender Vereinsbereich | konkrete Produktionen separat prüfen |
| Gesundheits-, Sicherheits- und Präventionsangebote allgemein | Themen-/Partnerfeld | Kinder-/Jugendschutz ist als konkrete Einführung formalisiert |
| `plugins/event-manager/` | fachliches/architektonisches Wissensartefakt | kein zweites Softwareprojekt neben Event Planner; **Veranstaltungsorganisation 2026/27** ist fachlich/operativ abgegrenzt |

### 6. Wesentliche Abhängigkeiten und Überschneidungen

#### Aufbau Digitale Vereinsorganisation ↔ alle Fachprojekte

Das Aufbauprojekt schafft gemeinsame Organisations-, Rollen-, Wissens-, Governance- und Architekturgrundlagen, übernimmt aber nicht die fachliche Leitung der einzelnen Projekte.

#### Event Planner ↔ Veranstaltungsorganisation 2026/27 ↔ Getränkelieferant 2027

Die Veranstaltungsorganisation liefert reale Events, Bedarfe und Learnings. Der Event Planner ist das digitale Werkzeug. Das Getränkelieferantenprojekt löst einmalig die Lieferantenumstellung und darf keine dritte Eventdatenwelt erzeugen.

#### Event Planner ↔ Mitglieder & Engagement ↔ Team Manager ↔ Platzbelegung

Diese Projekte dürfen keine getrennten Personen-, Mannschafts-, Saison-, Ressourcen- oder Belegungsdatenwelten aufbauen.

#### Partnerportal ↔ Partner Hub ↔ operatives Partner-CRM

Die Produktabgrenzung bleibt: **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**.

#### DFB Vereinsheim 2.0 ↔ konkrete Infrastrukturprojekte

DFB Vereinsheim 2.0 liefert Bedarfs-, Bestands- und Priorisierungsrahmen. Kunstrasen, Raucherraum/Kioskbereich, Großfeldtore und spätere konkrete Gebäude-/Raumprojekte behalten jeweils ihren eigenen Projektzustand.

#### Kunstrasen ↔ Funding / Gemeinde / Finanzen / Partnership

Vor einem belastbaren Investitionsbeschluss müssen Flächenpriorität, Trägerschaft/Eigentum, Genehmigung, aktueller Kostenstand und Finanzierung gemeinsam geklärt werden.

#### Advanced Football ↔ Team Manager / Datenschutz

Advanced Football darf keine dauerhafte parallele Personendatenbank etablieren. Alte Coach-Kontaktdaten bleiben geschützt und werden nicht ungeprüft als aktuelle Nutzerbasis übernommen.

#### Homepage ↔ Platzbelegung ↔ fachliche Systeme

Die Homepage bleibt Kandidat für einen eigenen Relaunch-/Migrationszustand. Sie darf keine zweite Datenpflege für Platz-, Team-, Event-, Partner- oder Archivdaten erzeugen.

#### Stadionheft ↔ Archiv / Partnership / Event Planner / Matchday

Das Stadionheft nutzt bestehende Fachquellen und erzeugt keine neue führende Datenhaltung.

#### Kinder- und Jugendschutz ↔ Jugend / Datenschutz / Vorstand

Schutzfallkommunikation wird nicht in normale KI-/n8n-Prozesse geroutet.

### 7. Offene Portfolio-Lücken und nächste Koordinationspunkte

1. Fachliche Owner für die neu formalisierten Projekte benennen.
2. Getränkelieferant 2027 mit Kioskbedarf vervollständigen und Angebote vergleichbar einholen.
3. Kunstrasen: Scope der drei Flächen, Trägerschaft und aktuellen Kostenstand klären.
4. DFB Vereinsheim 2.0: Projektteam bilden und Vereinssteckbrief/Bedarf starten.
5. Raucherraum/Kioskbereich: Zielnutzung entscheiden.
6. Zaunanlage: aktuelles Aufmaß und Angebot herstellen.
7. Advanced Football: Anbieter-/Nutzen-/Datenschutzprüfung durchführen.
8. Veranstaltungsorganisation 2026/27: Eventliste, Termine und Owner konsolidieren.
9. Bestehende Software-/Fachprojekte nach ihren jeweiligen `PROJECT-STATE.md` weiterführen.
10. Infrastrukturkandidaten mit den Ergebnissen aus DFB Vereinsheim 2.0 neu priorisieren, ohne sie vorschnell zusammenzulegen.

### 8. Nutzung durch andere Mitarbeiter

Andere Rollen verwenden dieses Portfolio zur Orientierung und springen anschließend in die jeweilige Detailquelle.

- Funding & Grants Manager → reale Projekte, Kandidaten und fördersensible Investitionen,
- Partnership Manager → Projekte mit Partner-/Finanzierungs-/Aktivierungspotenzial,
- WordPress Developer → technische Projekte und vorgelagerte Architekturentscheidungen,
- Graphic Designer → Homepage-, Partner-, Merch-, Infrastruktur- und Publikationsvorhaben mit Designbedarf,
- Archivist → Trennung von dauerhaftem Archivbetrieb und echten Projekten,
- Vorstand / Fachbereiche → Owner-, Scope-, Budget- und Freigabeentscheidungen.

### 9. Aktualisierungsregel

Dieses Portfolio wird aktualisiert, wenn sich mindestens eines ändert:

- neues relevantes Projekt oder Kandidat,
- Portfolio-Status,
- fachlicher Owner,
- nächster wesentlicher Schritt,
- zentrale Blockade/Abhängigkeit,
- Projektzusammenführung/-trennung,
- Abschluss oder Verwerfung.

Kleine operative Fortschritte innerhalb eines Projekts werden nicht automatisch hier gespiegelt.

## Relationship to other documents

- `README.md`
- `../roles/project-portfolio-manager/role.md`
- `../roles/project-portfolio-manager/portfolio-standard.md`
- jeweilige `PROJECT-STATE.md`
- `../knowledge/funding/CURRENT-STATE.md`
- `../knowledge/funding/FUNDING-CALENDAR.md`
- `../knowledge/sponsoring/CURRENT-STATE.md`
- `../decisions/ADR-0007-central-project-portfolio.md`

## Future Development

Das Portfolio bleibt kompakt und wird nicht zu einem zweiten Projektmanagement-System ausgebaut. Der nächste Reifegewinn entsteht durch aktuelle Projektzustände, eindeutige fachliche Owner, geklärte Systemgrenzen und eine belastbare Priorisierung der nun sichtbaren Infrastruktur- und Organisationsprojekte.