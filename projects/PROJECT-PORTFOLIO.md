# TuS Project Portfolio

Stand: 2026-09-12 – Runtime-Abgleich bis einschließlich gemergtem PR #97

## Purpose

Dieses Dokument ist die zentrale organisationsweite Übersicht über relevante TuS-Projekte und Projektkandidaten.

Es ist kein zweites Projektmanagement-System und ersetzt keine `PROJECT-STATE.md`.

## Core Principle

> **Detailwahrheit im Projekt. Portfolioübersicht zentral.**

Andere Mitarbeiter sollen von hier aus schnell erkennen können, welche Vorhaben existieren, wo der aktuelle Stand liegt, wer fachlich zuständig ist und welche Abhängigkeiten relevant sind.

## Main Content

### 1. Inventur-Ergebnis

Die aktuelle Repository- und Arbeitsstandprüfung ergibt:

- **14 formale Projekte** unter `projects/`, jeweils mit `README.md` und `PROJECT-STATE.md`,
- davon **2 Aktiv**, **1 Geplant** und **11 Discovery**,
- mehrere reale Projektkandidaten aus Homepage-, Infrastruktur-, Archiv- und Förderarbeit,
- mehrere Themen, die bewusst **kein eigenes Projekt** sind, sondern Einzelmaßnahmen, Regelbetrieb, Fachfelder oder ein übergeordnetes Programm.

Seit dem letzten vollständigen Portfolio-Abgleich wurden drei weitere formale Projekte gemergt:

- `kinder-jugendschutz/` über PR #80,
- `stadionheft/` über PR #81,
- `platzbelegung/` über PR #85.

Zusätzlich wurde mit PR #79 der Förderstatus von `digital-organisation/` fachlich geklärt: WISO 2026 ist geschlossen, weil zum erforderlichen Zeitpunkt kein aktueller Gemeinnützigkeitsnachweis vorlag. Der nächste Förderweg ist deshalb eine systematische Ersatzprogrammsuche; eine Suche nach einem WISO-Einreichungsnachweis ist nicht mehr erforderlich.

PR #97 erweitert im Projekt `Mitglieder & Engagement` die bereits vorgesehene Beitragsnachlass-Logik fachlich um ein gemeinsames Anerkennungsmodell für Funktionsträger, aktive Schiedsrichter und bestätigte Helferleistungen. Die Architektur- und Integrationsreihenfolge des Projekts ändert sich dadurch noch nicht; konkrete Beitragsregeln bleiben eine spätere Vereinsentscheidung.

Offene Pull Requests werden als Arbeitsstand berücksichtigt, aber erst nach Merge als `main`-Wahrheit behandelt. PR #98 ist daher noch nicht Bestandteil dieses Portfolio-Stands.

### 2. Formale Projekte

| Projekt | Fachlicher Verantwortungsbereich / Owner | Status | Verbindliche Detailquelle | Nächster sinnvoller Schritt | Wesentliche Abhängigkeit / Portfolio-Hinweis | Querschnitt |
|---|---|---|---|---|---|---|
| Event Planner | Veranstaltungen; technischer Owner: WordPress Developer; fachlicher Produkt-Owner nicht explizit benannt | Aktiv | `event-planner/PROJECT-STATE.md` | aktuellen Dashboard-/Historienstand im Playground manuell prüfen, Ergebnis dokumentieren und danach die Event-Anlegen-UI in einem kleinen persistenten Inkrement umsetzen | Dashboard V1 und erster Historienbereich sind auf `main`; manuelle Prüfung und formaler LKG noch offen | Entwicklung, Design, Mitglieder & Engagement, Team Manager, Homepage |
| Mitglieder & Engagement | noch kein eindeutiger einzelner Verantwortungsbereich/Owner; fachlicher Kontext Mitglieder / Engagement / Organisation | Discovery | `member-engagement/PROJECT-STATE.md` | bestehende Mitgliederverwaltung analysieren und gemeinsame Personen-/Mitgliedsidentität definieren | keine zweite Personendatenwelt; Beitragsanerkennung für Funktionen, Schiedsrichter und Helferstunden ist fachlich vorbereitet, aber noch nicht beschlossen | Entwicklung, Datenschutz, Veranstaltungen, Sport, Vorstand/Generalversammlung |
| Partner Hub | Sponsoring / Partnership Manager | Discovery | `partner-hub/PROJECT-STATE.md` | gemeinsame Partnerdatenbasis, Rollen/Freigaben, Account-Lifecycle und MVP-Grenzen konkretisieren | Partner Hub = partnerseitige Oberfläche für bestehende Partner; gemeinsame Partnerdatenbasis mit Partnerportal | Sponsoring, Entwicklung, Design, Homepage, Event Planner, Portfolio |
| Partnerportal | Sponsoring / Partnership Manager | Discovery | `partner-portal/PROJECT-STATE.md` | reale Sponsorendaten und Steuer-Ist konsolidieren, gemeinsame Partnerdatenbasis definieren und internes MVP reduzieren | Partnerportal = internes TuS-Arbeitswerkzeug; natives Partner-CRM ist operative Zwischen-SoT | Sponsoring, Finanzen/Steuer, Entwicklung, Design, Homepage |
| TuS Tauschbörse | Gesellschaft & Soziales; fachlicher Produkt-Owner nicht explizit benannt | Discovery | `reuse-marketplace/PROJECT-STATE.md` | konto-freien Vermittlungsablauf, Datenschutz/Missbrauchsschutz und realen `Kinder von Atibie`-Spendenweg konkretisieren; danach MVP festlegen | kein aktiver Implementierungsbranch, noch kein Plugin-Code | Entwicklung, Design, Datenschutz, Gesellschaft & Soziales |
| Team Manager | Sport; fachlicher Produkt-Owner nicht explizit benannt | Discovery | `team-manager/PROJECT-STATE.md` | gemeinsame Mannschaftsidentität und Saisonmodell definieren; danach Jahrgangs-/Ressourcenlogik und fussball.de-Anbindung untersuchen | keine parallele Mannschafts- oder Personendatenwelt | Sport, Entwicklung, Datenschutz, Event Planner, Mitglieder & Engagement, Homepage |
| LED Media Screen | Sponsoring / Infrastruktur / Kommunikation; fachlicher Projekt-Owner noch offen | Discovery | `led-media-screen/PROJECT-STATE.md` | Technikbeiblatt, Fundament, Strom, Genehmigung und Gesamtfinanzierung ohne unbestätigten Direktzuschuss klären | kein qualifizierter direkter Zuschuss im aktuellen Scope; keine Bestellung ausgelöst | Partnership Manager, Funding & Grants, Infrastruktur, Finanzen, Kommunikation/Design, Vorstand |
| Aufbau Digitale Vereinsorganisation | Vereinsentwicklung / Digitalisierung; fachlicher Projekt-Owner noch offen | Aktiv | `digital-organisation/PROJECT-STATE.md` | alternative Förderprogramme systematisch recherchieren, nach Nutzbarkeit vor/nach neuem Gemeinnützigkeitsnachweis trennen und Aufbauarbeitspakete messbar schärfen | WISO 2026 ist geschlossen; aktueller Gemeinnützigkeitsnachweis fehlt voraussichtlich bis Herbst 2026 | Funding & Grants, Project Portfolio, WordPress Developer, Datenschutz & IT, alle Fachbereiche, Vorstand |
| Großfeldtore Haupt- und Trainingsplatz | Sport / Infrastruktur; fachlicher Projekt-Owner noch offen | Geplant | `grossfeldtore-haupt-trainingsplatz/PROJECT-STATE.md` | BSB-Konfiguration, Eigentums-/Nutzungsstatus, Netze, Versand, Fundament und Gesamtpreis vor Bestellung klären | BSB-Vorabprüfung vor Anschaffung; Kellogg’s nur als bereits eingereichten Vorgang nachhalten | Funding & Grants, Sport, Infrastruktur, Finanzen, Vorstand |
| Arbeitsplatz Sportparkteam | Sportpark / Infrastruktur / Vereinsentwicklung; fachlicher Projekt-Owner noch offen | Discovery | `arbeitsplatz-sportparkteam/PROJECT-STATE.md` | bis 18.09. § 16i beim Jobcenter Bruchsal vorabklären, § 16e hilfsweise; danach Tätigkeitsprofil und Stundenmodelle | persönliche Förderfähigkeit offen; Vertrag erst nach positiver Rückmeldung | Funding & Grants, Partnership Manager, Infrastruktur, Finanzen/Lohn, Datenschutz, Vorstand |
| Trainingskleidung Ausstattungsgrundstock | Sport / Ausstattung / Partnerships; fachlicher Projekt-Owner noch offen | Discovery | `trainingskleidung-ausstattungsgrundstock/PROJECT-STATE.md` | Hauptpartnerangebot konkretisieren, 3–5 passende Partner qualifizieren, Sponsorlogo-/Ausrüsterrechte und reale Größenverteilung klären | SPORTINN/Joma bleibt Ausrüster; separater Finanzierungspartner erforderlich | Partnership Manager, Sport, Ausstattung, Finanzen/Steuer, Design, Vorstand |
| Kinder- und Jugendschutz einführen | Jugend / Vereinsentwicklung / Schutz & Prävention; fachlicher Projekt-Owner noch zu benennen | Discovery | `kinder-jugendschutz/PROJECT-STATE.md` | Vorstandsverantwortung und zwei Vertrauenspersonen bestimmen, §72a-Status mit Jugendamt klären, danach TuS-Risikoanalyse durchführen | ohne benannte Verantwortung kein belastbarer Übergang vom Konzept in den Schutzprozess; hochsensible Schutzfälle dürfen nicht in normale KI-/n8n-Queues laufen | Jugend, Vorstand, Datenschutz, Trainer/Betreuer, Kommunikation |
| Stadionheft / Spieltagsmagazin Herren | Redaktion / Kommunikation / Herrenfußball; fachlicher Projekt-Owner noch nicht explizit benannt | Discovery | `stadionheft/PROJECT-STATE.md` | aktuelle Master-Druckvorlage, 1–2 Referenzausgaben und Anzeigenordner identifizieren; danach reale Seiten-/Content-Map und Pilot erstellen | keine Automatisierung vor gesicherten Masterassets, gültigen Anzeigen und klarer Druckfreigabe | Matchday Editor, Archivist, Graphic Designer, Partnership Manager, Event Planner, WordPress Developer |
| TuS Platzbelegung | Sport / Jugend / Sportpark / Veranstaltungen; fachlicher Owner offen; technischer Owner: WordPress Developer | Discovery | `platzbelegung/PROJECT-STATE.md` | reale Ressourcenliste und Belegungsquellen aufnehmen, Google-Kalender-/Bildprozess dokumentieren und minimale V1-Datenobjekte definieren | keine neue Kalenderinsel; Integrationsgrenzen zu Team Manager, Event Planner und Spielplandaten vor Code klären | Entwicklung, Datenschutz, Homepage, Sport, Jugend, Infrastruktur |

### 3. Aktualität der formalen Projektzustände

| Projekt | Portfolio-Befund | Erforderliche Pflege |
|---|---|---|
| Event Planner | **aktuell / manuelle Prüfung offen** | nächster Update nach dokumentiertem Playground-Test, neuem LKG oder Implementierungs-PR |
| Mitglieder & Engagement | **aktuell / Beitragsanerkennung fachlich erweitert** | keine künstliche Statusänderung; aktuelle Beitragsordnung und spätere Vereinsentscheidung bleiben separate Fachgates |
| Partner Hub | **aktuell** | nächste Aktualisierung nach Entscheidung zu gemeinsamer Partnerdatenbasis, Rollen/Freigaben oder MVP |
| Partnerportal | **aktuell** | nächste Aktualisierung nach Bestandspartner-Konsolidierung, Steuer-Ist oder gemeinsamer Partnerdatenbasis |
| TuS Tauschbörse | **aktuell** | verbleibende Discovery-Schritte aus `PROJECT-STATE.md` bearbeiten |
| Team Manager | **aktuell** | gemeinsame Mannschaftsidentität und Saisonmodell sind der aktuelle Einstieg |
| LED Media Screen | **aktuell** | bei Änderung von Angebot, Owner, Förder-Scope, Genehmigung, Finanzierung oder Beauftragungsstatus aktualisieren |
| Aufbau Digitale Vereinsorganisation | **aktuell nach PR #79** | WISO nicht wieder öffnen; Ersatzförderung und messbare Aufbauarbeitspakete weiterführen |
| Großfeldtore Haupt- und Trainingsplatz | **aktuell** | BSB und realen Bestellscope vor Anschaffung klären |
| Arbeitsplatz Sportparkteam | **aktuell** | bei Jobcenter-Antwort, Förderfähigkeit, Stundenmodell, Arbeitgeberkosten, Partnerfinanzierung, Vorstandsbeschluss oder Vertrag aktualisieren |
| Trainingskleidung Ausstattungsgrundstock | **aktuell** | nächste Aktualisierung bei Partnerqualifizierung/Freigabe, Rechteklärung, Artikel-/Größenfestlegung, Finanzierung oder Bestellung |
| Kinder- und Jugendschutz einführen | **aktuell – neu seit PR #80** | bei Benennung von Verantwortung/Vertrauenspersonen, §72a-Klärung, Risikoanalyse oder Konzeptfreigabe aktualisieren |
| Stadionheft / Spieltagsmagazin Herren | **aktuell – neu seit PR #81** | bei identifiziertem Masterlayout, Anzeigenbestand, Owner/Druckfreigabe oder Pilot-LKG aktualisieren |
| TuS Platzbelegung | **aktuell – neu seit PR #85** | bei geklärten Datenquellen, Ressourcenmodell, Integrationsgrenzen oder V1-Scope aktualisieren |

Alle vierzehn formalen Projekte erfüllen die minimale Projektstruktur aus `projects/README.md`.

### 4. Reale Projektkandidaten

Die folgenden Vorhaben sind ausreichend relevant, um im Portfolio sichtbar zu bleiben, aber noch nicht automatisch reif für einen eigenen Projektordner.

| Vorhaben | Status | Möglicher fachlicher Bereich / Owner | Warum portfolio-relevant | Nächste Portfolio-Aktion | Querschnitt |
|---|---|---|---|---|---|
| Neuaufbau TuS-Homepage | Kandidat | Kommunikation; fachlicher Projekt-Owner noch festzulegen | Zielbild, Kontakt-/Privacy-Architektur und technische Migrationsbefunde sind deutlich gereift, aber ein eigener Projektzustand ist noch nicht beschlossen | Owner und konkreten Relaunch-/Migrationsscope klären; Platzbelegung bleibt eigenes Teilprojekt | Entwicklung, Graphic Designer, Team Manager/fussball.de, Event Planner, Partnerdaten, Datenschutz, Archiv/Content |
| Umkleideböden / klar abgegrenzte Umkleidesanierung | Kandidat | Infrastruktur / Sport; Owner offen | qualifizierte Funding-Chance `OPP-002` mit Priorität A | technischen Scope, Ist-/Zielzustand, Kosten und Eigentums-/Nutzungsrecht klären; danach BSB-Vorabklärung | Funding, Infrastruktur, Finanzen, Sport |
| Hauptgebäude / Fassade | Kandidat | Infrastruktur; Owner offen | kurzfristig priorisierte Gebäudeaufwertung mit möglichem Partner-/Förderbezug | reine Optik/Instandhaltung von energetischer Sanierung trennen; danach Kosten, Finanzierung und Owner klären | Funding, Sponsoring, Infrastruktur, Finanzen, Design |
| Kunstrasen | Kandidat | Infrastruktur / Sport / Finanzen; Owner offen | großes langfristiges Sportstätten- und Finanzierungsprojekt | Zielbild, Trägerschaft/Eigentum, Kostenrahmen, Priorität und Vorplanung klären | Funding, Infrastruktur, Sport, Finanzen, Sponsoring |
| Jugendräume | Kandidat | Jugend / Infrastruktur; Owner offen | mittelfristiges Infrastruktur- und Jugendvorhaben | Bedarf, Nutzergruppen, Scope, Standort, Verantwortlichkeit und Finanzierung klären | Funding, Jugend, Infrastruktur, Sponsoring, Design |
| Funktions-/Unterstellgebäude Festplatz | Kandidat | Infrastruktur / Veranstaltungen; Owner offen | mittelfristiges Bau- und Nutzungsprojekt | Bedarf, Nutzung, Genehmigungs-/Trägerschaftsfragen, Kosten und Owner klären | Funding, Infrastruktur, Veranstaltungen, Sponsoring |
| Bekleidungslager / physischer Vereins-Shop | Kandidat | Organisation / Merch / Finanzen; Owner offen | reale organisatorische und ggf. räumliche Infrastrukturfrage | physischen Lager-/Ausgabebedarf vom extern gehosteten Webshop trennen | Organisation, Finanzen, Design, Sponsoring |
| Energie / PV / Speicher / Klimaschutzmaßnahmen | Kandidat | Infrastruktur / Nachhaltigkeit / Finanzen; Owner offen | potentiell größere Investitions- und Fördermaßnahmen | konkretes Gebäude/Anlage, Energieproblem, technische Zielsetzung und Wirtschaftlichkeit bestimmen | Funding, Infrastruktur, Finanzen |
| Bewässerungsanlage / nachhaltige Platzpflege-Investition | Kandidat | Infrastruktur / Sport; Owner offen | konkretes Investitionsfeld im Funding-Radar | realen Investitionsbedarf, technische Lösung, Eigentums-/Nutzungsrecht und Kosten klären | Funding, Infrastruktur, Sport, Finanzen |
| Aufbau / nachhaltige Organisation Sportparkteam | Kandidat | Infrastruktur / Vereinsentwicklung; Owner offen | vom formalen Projekt `arbeitsplatz-sportparkteam/` getrenntes mögliches Organisationsvorhaben | prüfen, ob neben dem konkreten Arbeitsplatzprojekt noch eine eigenständige Initiative erforderlich ist | Vereinsentwicklung, Infrastruktur, Funding, Sponsoring |
| Historienarchiv – abgegrenztes Erschließungs-/Digitalisierungsprojekt | Kandidat | Archiv & Vereinsgeschichte / Archivist | qualifizierte Funding-Chance `OPP-003` B+; Archiv als Ganzes bleibt Regelbetrieb | Vorabskizze mit Bestand, Ziel, Output, Metadaten, Zugänglichkeit und Kosten erstellen; Förderfähigkeit klären | Archivist, Funding, Kommunikation, Design, Datenschutz/IT |
| Historien-/Jubiläumspublikation oder andere konkrete Archiv-Ausgabe | Kandidat | Archiv & Vereinsgeschichte / Kommunikation | konkrete Publikation kann ein eigenständiges Ergebnis besitzen | nur bei beschlossenem Produkt, Zielgruppe, Umfang, Termin und Owner als Projekt führen | Archivist, Kommunikation, Graphic Designer, Homepage/Print |

### 5. Bewusst nicht als eigenständige Projekte geführt

| Thema / Vorhaben | Einordnung | Portfolio-Begründung / Zuordnung |
|---|---|---|
| 125-Jahre-Jubiläumszuschüsse nach bereits realisiertem Jubiläum | Einzelaufgabe | administrative Nachprüfung, kein neues Vereinsprojekt |
| Finanzpuffer / Rücklagenaufbau | Regelbetrieb / Finanzziel | laufende Finanzsteuerung |
| Sponsoringstrategie und laufende Partnerarbeit | Regelbetrieb / Fachbereich | Partnership Manager; Produktentwicklung in Partnerportal/Partner Hub |
| Konsolidierung historischer Sponsorendaten | Arbeitsaufgabe / Discovery-Zulieferung | operative Grundlage für Sponsoring und Partnerportal |
| Funding Radar / Förderkalender / Programmdossiers | Regelbetrieb / Fachbereich | Funding & Grants Manager; konkrete Vereinsvorhaben bleiben Projekte/Kandidaten |
| Vereinsgeschichte / Historienarchiv als Ganzes | Regelbetrieb / Fachbereich | dauerhafte Archivistenaufgabe; nur abgegrenzte Outputs werden Projekte |
| TuS Digital Organisation – dauerhafter Betrieb nach der Aufbauphase | Programm / Regelbetrieb | `digital-organisation/` beschreibt nur Aufbau/Konsolidierung |
| externer Webshop – laufende UX/UI-Angleichung | laufende Design-/Betriebsaufgabe | erst bei klarer Relaunch-/Migration als Projekt prüfen |
| Jugend- und Mädchenfußball allgemein | laufendes Fach-/Förderfeld | konkrete Camps/Kooperationen separat prüfen |
| Trainer- und Schiedsrichterentwicklung | laufendes Fach-/Förderfeld | Schiedsrichterorganisation ist aktuell Facharbeit; nur abgegrenzte Initiative als Projekt führen |
| FSJ / Bildung / Ausbildung | laufendes Fach-/Förderfeld | konkrete neue Einführung/Programmänderung separat prüfen |
| Ghana-Unterstützung / `Kinder von Atibie` allgemein | laufendes soziales Feld | Spendenweg derzeit Abhängigkeit der Tauschbörse |
| Integration / Beschäftigung / soziale Träger | laufendes Fach-/Förderfeld | konkretes Vorhaben `arbeitsplatz-sportparkteam/` ist formalisiert |
| Barrierefreiheit / Teilhabe | Projektfeld, noch kein konkretes Projekt | Funding-Chancen vorhanden, aber kein ausreichend abgegrenztes Vorhaben |
| Theater / Kultur allgemein | laufender Vereinsbereich / Förderfeld | konkrete Produktionen erst bei realem Scope als Projekt führen |
| Gesundheits-, Sicherheits- und Präventionsangebote | Themen-/Partnerfeld | Kinder-/Jugendschutz ist als konkrete Einführung formalisiert; übrige Prävention noch kein Projekt |
| `plugins/event-manager/` | fachliches/architektonisches Wissensartefakt | überschneidet sich stark mit Event Planner; kein zweites Eventprojekt |

### 6. Wesentliche Abhängigkeiten und Überschneidungen

#### Aufbau Digitale Vereinsorganisation ↔ alle Fachprojekte

Das Aufbauprojekt schafft gemeinsame Organisations-, Rollen-, Wissens-, Governance- und Architekturgrundlagen, übernimmt aber nicht die fachliche Leitung der einzelnen Projekte.

#### Event Planner ↔ Mitglieder & Engagement ↔ Team Manager ↔ Platzbelegung

Diese Projekte dürfen keine getrennten Personen-, Mannschafts-, Saison-, Ressourcen- oder Belegungsdatenwelten aufbauen. Vor produktiver Integration müssen Objektverantwortung und führende Quellen klar sein.

#### Partnerportal ↔ Partner Hub ↔ operatives Partner-CRM

Die Produktabgrenzung bleibt: **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**. Das native Partner-CRM ist die geschützte operative Zwischenlösung, nicht eine zweite langfristige Partnerdatenwelt.

#### Homepage ↔ Platzbelegung ↔ fachliche Systeme

Die Homepage bleibt Kandidat für einen eigenen Relaunch-/Migrationszustand. Platzbelegung ist dagegen bereits ein eigenständiges formales Plugin-Projekt. Die Homepage darf keine zweite Datenpflege für Platz-, Team-, Event-, Partner- oder Archivdaten erzeugen.

#### Stadionheft ↔ Archiv / Partnership / Event Planner / Matchday

Das Stadionheft nutzt bestehende Fachquellen. Partneranzeigen, Archivfakten und Veranstaltungsdaten bleiben in ihren jeweiligen Sources of Truth; das Heft ist Produktions- und Publikationsprojekt, keine neue Datenhaltung.

#### Kinder- und Jugendschutz ↔ Jugend / Datenschutz / Vorstand

Vor technischer oder organisatorischer Automatisierung müssen Verantwortung, Vertrauenspersonen, §72a-Prozess und geschützter Datenweg stehen. Schutzfallkommunikation wird nicht in normale KI-/n8n-Prozesse geroutet.

#### Infrastrukturprojekte ↔ Funding / Sponsoring / Finanzen

Umkleideböden, Fassade, Kunstrasen, Bewässerung, Jugendräume, Festplatzgebäude, Energie/PV, Großfeldtore und LED Media Screen teilen wiederkehrende Abhängigkeiten: Owner, Eigentums-/Nutzungsrecht, Scope, Kosten-/Finanzierungsplan, Genehmigungen, Förderbedingungen und Partnerpotenzial.

### 7. Offene Portfolio-Lücken und nächste Koordinationspunkte

1. **Fachliche Owner präzisieren:** Weiterhin fehlen explizite fachliche Owner bei Event Planner, Mitglieder & Engagement, Tauschbörse, Team Manager, LED Media Screen, Digitale Vereinsorganisation, Großfeldtore, Arbeitsplatz Sportparkteam, Trainingskleidung sowie neu bei Kinder-/Jugendschutz, Stadionheft und Platzbelegung.
2. **Kinder-/Jugendschutz organisatorisch verankern:** Vorstandsverantwortung und zwei Vertrauenspersonen festlegen; danach §72a und Risikoanalyse.
3. **Stadionheft produktionsfähig machen:** Mastervorlage, Anzeigenassets, Owner und Druckfreigabe identifizieren.
4. **Platzbelegung Discovery abschließen:** reale Ressourcen und Quellen aufnehmen; Integrationsgrenzen vor Code festlegen.
5. **Event Planner verifizieren:** aktuellen Plugin-Stand manuell prüfen und erst nach Smoke-Test neuen LKG festlegen.
6. **Partnerplattform konkretisieren:** gemeinsame Partnerdatenbasis, Objektverantwortung, Rollen/Freigaben und MVP-Grenzen entscheiden.
7. **Großfeldtore bestellreif machen:** BSB-Konfiguration und Gesamtpreis klären.
8. **LED Media Screen bis Go/No-Go schärfen:** Technik, Fundament, Strom, Genehmigung, Rechtseinheit und Finanzierung klären.
9. **Arbeitsplatz Sportparkteam förder- und entscheidungsreif machen:** bis 18.09. Jobcenter vorabklären, dann Tätigkeitsprofil, Stundenmodelle und Partnerfinanzierung entwickeln.
10. **Trainingskleidung partnerschafts- und bestellreif machen:** Partnerangebot, Leads, Rechte, Artikel und Größen klären.
11. **Digitale Vereinsorganisation nach WISO neu ausrichten:** Ersatzförderung recherchieren und Aufbauarbeitspakete messbar strukturieren.
12. **Homepage formalisierungsreif machen:** Owner und konkreten Relaunch-/Migrationsscope klären; technische Ist-Inventur ist inzwischen deutlich weiter.
13. **Event-Manager-Artefakt einordnen:** Doppelentwicklung verhindern.
14. **Archiv sauber trennen:** Archiv als Regelbetrieb; nur abgegrenzte Erschließungs-/Digitalisierungs-/Publikationsvorhaben als Projekte.

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

Ein offener PR kann als bekannter Arbeitsstand erwähnt werden, ersetzt aber nicht die verbindliche Detailquelle auf `main`.

## Relationship to other documents

- `README.md`
- `../roles/project-portfolio-manager/role.md`
- `../roles/project-portfolio-manager/portfolio-standard.md`
- jeweilige `PROJECT-STATE.md`
- `../knowledge/funding/CURRENT-STATE.md`
- `../knowledge/funding/FUNDING-CALENDAR.md`
- `../knowledge/sponsoring/CURRENT-STATE.md`
- `../design/homepage-standard.md`
- `../organization/organization-chart.md`
- `../decisions/ADR-0007-central-project-portfolio.md`

## Future Development

Das Portfolio bleibt kompakt und wird nicht zu einem zweiten Projektmanagement-System ausgebaut.

Der nächste Reifegewinn entsteht durch aktuelle Projektzustände, eindeutige fachliche Owner, geklärte Systemgrenzen und die gezielte Formalisierung nur tatsächlich eigenständiger Vorhaben.
