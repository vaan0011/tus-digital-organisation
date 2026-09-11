# TuS Project Portfolio

Stand: 2026-09-11 – Runtime-Abgleich bis einschließlich PR #74

## Purpose

Dieses Dokument ist die zentrale organisationsweite Übersicht über relevante TuS-Projekte und Projektkandidaten.

Es ist kein zweites Projektmanagement-System und ersetzt keine `PROJECT-STATE.md`.

## Core Principle

> **Detailwahrheit im Projekt. Portfolioübersicht zentral.**

Andere Mitarbeiter sollen von hier aus schnell erkennen können, welche Vorhaben existieren, wo der aktuelle Stand liegt, wer fachlich zuständig ist und welche Abhängigkeiten relevant sind.

## Main Content

### 1. Inventur-Ergebnis

Die aktuelle Repository- und Arbeitsstandprüfung ergibt:

- **11 formale Projekte** unter `projects/`, jeweils mit `README.md` und `PROJECT-STATE.md`,
- davon **2 Aktiv**, **1 Geplant** und **8 Discovery**,
- mehrere reale Projektkandidaten aus Homepage-, Infrastruktur-, Archiv- und Förderarbeit,
- mehrere Themen, die bewusst **kein eigenes Projekt** sind, sondern Einzelmaßnahmen, Regelbetrieb, Fachfelder oder ein übergeordnetes Programm.

Seit dem letzten vollständigen Portfolio-Abgleich wurde über PR #72 das formale Projekt `trainingskleidung-ausstattungsgrundstock/` angelegt. PR #73 hat den Start-Scope auf zwei Trainingsshirts und eine kurze Trainingshose je Core-Set sowie die Zielgröße auf 50 Core-Sets geschärft. Der aktuelle Projektzustand trennt SPORTINN/Joma als bestehenden Ausrüster von einem noch zu gewinnenden separaten Finanzierungspartner. PR #74 verankert das Projekt zusätzlich in der operativen Partnership-Runtime und im geschützten Partner-CRM.

Der LED Media Screen wurde am 05.09.2026 vom Kandidaten zum formalen Projekt hochgestuft, weil inzwischen ein konkreter Standort, zwei Visualisierungen, ein belastbares Lieferantenangebot, technische Eckdaten und ein eigenes Finanzierungs-/Partnerkonzept vorliegen.

Die **Digitale Vereinsorganisation** bleibt langfristig das übergeordnete Organisationsprogramm des TuS. Zusätzlich wird die aktuelle, klar abgrenzbare **Aufbau- und Konsolidierungsphase** seit 05.09.2026 als formales Projekt `digital-organisation/` geführt. Damit können Aufbauziele, Arbeitspakete, Wirkung und mögliche Fördermittel sauber dokumentiert werden, ohne den späteren Dauerbetrieb zu einem ewigen Megaprojekt zu machen.

Die bisher als Einzelmaßnahme geführte Beschaffung zusätzlicher Tore wird seit 05.09.2026 als formales Projekt `grossfeldtore-haupt-trainingsplatz/` geführt. Der Umfang umfasst technische Lösung, Förderung, Fundamentierung, Einbau, Finanzierung und Beschluss vor Bestellung.

Seit 09.09.2026 wird das Vorhaben `arbeitsplatz-sportparkteam/` als formales Projekt geführt. Ziel ist ein regulärer sozialversicherungspflichtiger Beschäftigungsübergang mit Förderprüfung, Beschäftigungsmodell, Arbeitgeberkosten, sozialer Wirkung, Vorstandsbeschluss und schrittweiser Partnerfinanzierung. Personenbezogene Sozial-, Leistungs-, Lohn- und Vertragsdaten bleiben außerhalb von GitHub.

Der Runtime-Abgleich am 11.09.2026 bestätigt die bereits in PR #68 korrigierten Detailzustände von TuS Tauschbörse und Team Manager. Beide sind auf `main` aktuell; frühere Portfolio-Hinweise auf einen noch offenen Initial-Scope-Branch waren veraltet und werden hier entfernt.

Die Funding-Pipeline führt weiterhin qualifizierte Chancen für Großfeldtore, Umkleideböden, Historienarchiv und Arbeitsplatz Sportparkteam. Zusätzlich wird Trainingskleidung als reales Projekt im Förderinventar geführt, ohne dass daraus aktuell eine eigene qualifizierte A/B+-Förderchance folgt. REWE läuft bereits; Kellogg’s wurde laut Funding Current State bereits beantragt und darf nicht erneut als offene Projektauswahl behandelt werden.

Für WISO gilt seit 11.09.: Die Einreichungsfrist 10.09.2026, 23:59 Uhr ist verstrichen. Auf `main` ist weiterhin kein Einreichungsnachweis dokumentiert. Der Status ist daher nicht mehr „heute einreichen“, sondern **Einreichungsstatus extern prüfen und danach entweder `eingereicht` dokumentieren oder die Chance 2026 schließen**.

Offene Pull Requests werden als Arbeitsstand berücksichtigt, aber erst nach Merge als `main`-Wahrheit behandelt.

### 2. Formale Projekte

| Projekt | Fachlicher Verantwortungsbereich / Owner | Status | Verbindliche Detailquelle | Nächster sinnvoller Schritt | Wesentliche Abhängigkeit / Portfolio-Hinweis | Querschnitt |
|---|---|---|---|---|---|---|
| Event Planner | Veranstaltungen; technischer Owner: WordPress Developer; fachlicher Produkt-Owner nicht explizit benannt | Aktiv | `event-planner/PROJECT-STATE.md` | aktuellen Dashboard-/Historienstand im Playground manuell prüfen, Ergebnis dokumentieren und danach die Event-Anlegen-UI in einem kleinen persistenten Inkrement umsetzen | Dashboard V1 und erster Historienbereich sind auf `main`; automatisierte Workflows erfolgreich, manuelle Prüfung und formaler LKG noch offen | Entwicklung, Design, Mitglieder & Engagement, Team Manager, Homepage |
| Mitglieder & Engagement | noch kein eindeutiger einzelner Verantwortungsbereich/Owner; fachlicher Kontext Mitglieder / Engagement / Organisation | Discovery | `member-engagement/PROJECT-STATE.md` | bestehende Mitgliederverwaltung analysieren und gemeinsame Personen-/Mitgliedsidentität definieren | darf keine zweite Personendatenwelt erzeugen; hängt eng an Event Planner und Team Manager | Entwicklung, Datenschutz, Veranstaltungen, Sport, ggf. Funding/Ehrenamt |
| Partner Hub | Sponsoring / Partnership Manager | Discovery | `partner-hub/PROJECT-STATE.md` | gemeinsame Partnerdatenbasis, Rollen/Freigaben, Account-Lifecycle und MVP-Grenzen konkretisieren | Partner Hub = partnerseitige Oberfläche für bestehende Partner; gemeinsame Partnerdatenbasis mit Partnerportal | Sponsoring, Entwicklung, Design, Homepage, Event Planner, Portfolio |
| Partnerportal | Sponsoring / Partnership Manager | Discovery | `partner-portal/PROJECT-STATE.md` | reale Sponsorendaten und Steuer-Ist konsolidieren, gemeinsame Partnerdatenbasis definieren und internes MVP reduzieren | Partnerportal = internes TuS-Arbeitswerkzeug; natives Partner-CRM ist operative Zwischen-SoT, keine getrennte Datenwelt zum Partner Hub | Sponsoring, Finanzen/Steuer, Entwicklung, Design, Homepage |
| TuS Tauschbörse | Gesellschaft & Soziales; fachlicher Produkt-Owner nicht explizit benannt | Discovery | `reuse-marketplace/PROJECT-STATE.md` | konto-freien Vermittlungsablauf, Datenschutz/Missbrauchsschutz und realen `Kinder von Atibie`-Spendenweg konkretisieren; danach MVP festlegen | Initial-Scope PR #18 ist im Projektzustand als gemergt reconciliiert; kein aktiver Implementierungsbranch, noch kein Plugin-Code | Entwicklung, Design, Datenschutz, Gesellschaft & Soziales, ggf. Funding |
| Team Manager | Sport; fachlicher Produkt-Owner nicht explizit benannt | Discovery | `team-manager/PROJECT-STATE.md` | gemeinsame Mannschaftsidentität und Saisonmodell definieren; danach Jahrgangs-/Ressourcenlogik und fussball.de-Anbindung untersuchen | Initial-Scope PR #17 ist im Projektzustand als gemergt reconciliiert; keine parallele Mannschafts- oder Personendatenwelt | Sport, Entwicklung, Datenschutz, Event Planner, Mitglieder & Engagement, Homepage |
| LED Media Screen | Sponsoring / Infrastruktur / Kommunikation; fachlicher Projekt-Owner noch offen | Discovery | `led-media-screen/PROJECT-STATE.md` | Technikbeiblatt, Fundament, Strom, Genehmigung und Gesamtfinanzierung **ohne unbestätigten Direktzuschuss** klären | kein qualifizierter direkter Zuschuss im aktuellen Scope; Angebot 48.779 € netto nach Rabatt; keine Bestellung ausgelöst | Partnership Manager, Funding & Grants, Infrastruktur, Finanzen, Kommunikation/Design, Vorstand |
| Aufbau Digitale Vereinsorganisation | Vereinsentwicklung / Digitalisierung; fachlicher Projekt-Owner noch offen | Aktiv | `digital-organisation/PROJECT-STATE.md` | WISO-Einreichungsstatus außerhalb GitHub prüfen; bei fristgerechter Einreichung Nachweis dokumentieren, sonst Chance 2026 schließen; danach Arbeitspakete schärfen | WISO-Frist 10.09.2026 23:59 ist abgelaufen; `PROJECT-STATE.md` enthält noch den vor Fristende formulierten Schritt und ist in diesem Punkt nachzuziehen | Funding & Grants, Project Portfolio, WordPress Developer, Datenschutz & IT, alle Fachbereiche, Vorstand |
| Großfeldtore Haupt- und Trainingsplatz | Sport / Infrastruktur; fachlicher Projekt-Owner noch offen | Geplant | `grossfeldtore-haupt-trainingsplatz/PROJECT-STATE.md` | BSB-Konfiguration und konkretes Angebot vor Anschaffung klären; Kellogg’s nur noch als bereits eingereichten Vorgang nachhalten, sobald das tatsächlich eingereichte Projekt eindeutig zugeordnet ist | BSB A-Chance; Kellogg’s-Bewerbung laut Funding Current State bereits erfolgt; keine zweite Bewerbung vorbereiten; keine Bestellung | Funding & Grants, Sport, Infrastruktur, Finanzen, Vorstand |
| Arbeitsplatz Sportparkteam | Sportpark / Infrastruktur / Vereinsentwicklung; fachlicher Projekt-Owner noch offen | Discovery | `arbeitsplatz-sportparkteam/PROJECT-STATE.md` | bis 18.09. § 16i beim Jobcenter Bruchsal vorabklären, § 16e hilfsweise; danach Tätigkeitsprofil und Stundenmodelle | B+; persönliche Förderfähigkeit offen; Vertrag erst nach positiver Rückmeldung | Funding & Grants, Partnership Manager, Infrastruktur, Finanzen/Lohn, Datenschutz, Vorstand |
| Trainingskleidung Ausstattungsgrundstock | Sport / Ausstattung / Partnerships; fachlicher Projekt-Owner noch offen | Discovery | `trainingskleidung-ausstattungsgrundstock/PROJECT-STATE.md` | auf Basis von 2.435 € Warenwert das Hauptpartnerangebot konkretisieren, 3–5 passende Partner qualifizieren, Sponsorlogo-/Ausrüsterrechte und reale Größenverteilung klären | 50 Core-Sets = 100 Shirts + 50 Shorts; SPORTINN/Joma bleibt Ausrüster, separater Finanzierungspartner erforderlich; keine Bestellung/Sponsorenzusage | Partnership Manager, Sport, Ausstattung, Finanzen/Steuer, Design, Vorstand |

### 3. Aktualität der formalen Projektzustände

| Projekt | Portfolio-Befund | Erforderliche Pflege |
|---|---|---|
| Event Planner | **aktuell nach Reconciliation / manuelle Prüfung offen** | nächste Aktualisierung nach dokumentiertem Playground-Test, neuem LKG oder nächstem Implementierungs-PR |
| Mitglieder & Engagement | **aktuell / ausreichend** | keine künstliche Aktualisierung; nächste reale Änderung erst nach Analyse der Mitgliederverwaltung bzw. Architekturentscheidung |
| Partner Hub | **aktuell** | nächste Aktualisierung nach Entscheidung zu gemeinsamer Partnerdatenbasis, Rollen/Freigaben oder MVP |
| Partnerportal | **aktuell** | nächste Aktualisierung nach Bestandspartner-Konsolidierung, Steuer-Ist oder gemeinsamer Partnerdatenbasis |
| TuS Tauschbörse | **aktuell nach PR #68** | keine weitere Reconciliation nötig; verbleibende Discovery-Schritte aus `PROJECT-STATE.md` bearbeiten |
| Team Manager | **aktuell nach PR #68** | keine weitere Reconciliation nötig; gemeinsame Mannschaftsidentität und Saisonmodell sind der aktuelle Einstieg |
| LED Media Screen | **aktuell** | bei Änderung von Angebot, Owner, Förder-Scope, Genehmigung, Finanzierung oder Beauftragungsstatus aktualisieren |
| Aufbau Digitale Vereinsorganisation | **teilweise veraltet – WISO-Frist abgelaufen** | nur den dokumentierten WISO-Status nachziehen: Einreichungsnachweis prüfen; bei fehlender Einreichung Chance 2026 schließen; keine nachträgliche Einreichung behaupten |
| Großfeldtore Haupt- und Trainingsplatz | **aktuell mit Funding-Handoff 11.09.** | Kellogg’s nicht erneut als offene Bewerbung behandeln; BSB und realen Bestellscope vor Anschaffung klären |
| Arbeitsplatz Sportparkteam | **aktuell – Funding 11.09.** | bei Jobcenter-Antwort, Förderfähigkeit, Stundenmodell, Arbeitgeberkosten, Partnerfinanzierung, Vorstandsbeschluss oder Vertrag aktualisieren |
| Trainingskleidung Ausstattungsgrundstock | **aktuell – neu seit PR #72/#73** | nächste Aktualisierung bei Partnerqualifizierung/Freigabe, Rechteklärung, Artikel-/Größenfestlegung, Finanzierung oder Bestellung |

Alle elf formalen Projekte erfüllen die minimale Projektstruktur aus `projects/README.md`.

### 4. Reale Projektkandidaten

Die folgenden Vorhaben sind ausreichend relevant, um im Portfolio sichtbar zu bleiben, aber noch nicht automatisch reif für einen eigenen Projektordner.

| Vorhaben | Status | Möglicher fachlicher Bereich / Owner | Warum portfolio-relevant | Nächste Portfolio-Aktion | Querschnitt |
|---|---|---|---|---|---|
| Neuaufbau TuS-Homepage | Kandidat | Kommunikation; fachlicher Projekt-Owner noch festzulegen | Zielbild, Startseitenarchitektur, Responsive-Regeln, Datenquellen und Umsetzungsreihenfolge sind bereits in `../design/homepage-standard.md` dokumentiert | aktuellen technischen Ist-Stand, Umsetzungsweg und fachlichen Owner klären; vor aktiver Implementierung prüfen, ob eigener Projektzustand nötig ist | Entwicklung, Graphic Designer, Team Manager/fussball.de, Event Planner, Partnerdaten, Archiv/Content |
| Umkleideböden / klar abgegrenzte Umkleidesanierung | Kandidat | Infrastruktur / Sport; Owner offen | qualifizierte Funding-Chance `OPP-002` mit Priorität A; konkrete kurzfristige Investitionsmaßnahme und vor jeder Beauftragung fördersensibel | technischen Scope, Ist-/Zielzustand, Kosten und Eigentums-/Nutzungsrecht klären; anschließend BSB-Vorabklärung vor förderschädlichem Vorhabenbeginn | Funding, Infrastruktur, Finanzen, Sport, ggf. Sponsoring |
| Hauptgebäude / Fassade | Kandidat | Infrastruktur; Owner offen | kurzfristig priorisierte Gebäudeaufwertung mit möglichem Partner-/Förderbezug | zuerst trennen: reine Optik/Instandhaltung oder echte energetische Sanierung; danach Kosten, Finanzierung und Owner klären | Funding, Sponsoring, Infrastruktur, Finanzen, Design |
| Kunstrasen | Kandidat | Infrastruktur / Sport / Finanzen; Owner offen | großes langfristiges Sportstätten- und Finanzierungsprojekt mit hohem Planungsbedarf | Zielbild, Trägerschaft/Eigentum, Kostenrahmen, Priorität und Vorplanung klären; Förder-/Finanzierungsweg früh einbeziehen | Funding, Infrastruktur, Sport, Finanzen, Sponsoring |
| Jugendräume | Kandidat | Jugend / Infrastruktur; Owner offen | mittelfristiges Infrastruktur- und Jugendvorhaben | Bedarf, Nutzergruppen, Scope, Standort, Verantwortlichkeit und Finanzierung klären | Funding, Jugend, Infrastruktur, Sponsoring, Design |
| Funktions-/Unterstellgebäude Festplatz | Kandidat | Infrastruktur / Veranstaltungen; Owner offen | mittelfristiges Bau- und Nutzungsprojekt mit Veranstaltungsbezug | Bedarf, Nutzung, Genehmigungs-/Trägerschaftsfragen, Kosten und Owner klären | Funding, Infrastruktur, Veranstaltungen, Sponsoring |
| Bekleidungslager / physischer Vereins-Shop | Kandidat | Organisation / Merch / Finanzen; Owner offen | reale organisatorische und ggf. räumliche Infrastrukturfrage | physischen Lager-/Ausgabebedarf vom extern gehosteten Webshop trennen und nur den tatsächlich abgegrenzten Projektumfang weiterführen | Organisation, Finanzen, Design, Sponsoring |
| Energie / PV / Speicher / Klimaschutzmaßnahmen | Kandidat | Infrastruktur / Nachhaltigkeit / Finanzen; Owner offen | potentiell größere Investitions- und Fördermaßnahmen | konkretes Gebäude/Anlage, Energieproblem, technische Zielsetzung und Wirtschaftlichkeit bestimmen | Funding, Infrastruktur, Finanzen |
| Bewässerungsanlage / nachhaltige Platzpflege-Investition | Kandidat | Infrastruktur / Sport; Owner offen | im Funding-Radar als konkretes Investitionsfeld erkennbar; von laufender Platzpflege zu trennen | realen Investitionsbedarf, technische Lösung, Eigentums-/Nutzungsrecht, Kosten und laufende Wasserförderung klären | Funding, Infrastruktur, Sport, Finanzen |
| Aufbau / nachhaltige Organisation Sportparkteam | Kandidat | Infrastruktur / Vereinsentwicklung; Owner offen | das breitere organisatorische Vorhaben bleibt vom formalen Projekt `arbeitsplatz-sportparkteam/` getrennt | prüfen, ob neben dem konkreten Arbeitsplatzprojekt noch eine eigenständige Aufbau-/Entwicklungsinitiative erforderlich ist | Vereinsentwicklung, Infrastruktur, Funding, Sponsoring |
| Historienarchiv – abgegrenztes Erschließungs-/Digitalisierungsprojekt | Kandidat | Archiv & Vereinsgeschichte / Archivist | qualifizierte Funding-Chance `OPP-003` mit Priorität B+; das Historienarchiv als Ganzes bleibt Regelbetrieb | aus dem Live-Archivstand Vorabskizze mit Bestand, Ziel, Output, Metadaten, Zugänglichkeit und Kosten erstellen und Förderfähigkeit mit EVALAG klären; Zielstichtag 31.01.2027 | Archivist, Funding, Kommunikation, Design, Datenschutz/IT |
| Historien-/Jubiläumspublikation oder andere konkrete Archiv-Ausgabe | Kandidat | Archiv & Vereinsgeschichte / Kommunikation | Archivarbeit erzeugt wiederverwendbare Inhalte; eine konkrete Publikation kann ein eigenes abgrenzbares Ergebnis besitzen | nur bei klar beschlossenem Produkt, Zielgruppe, Umfang, Termin und Owner als Projekt führen | Archivist, Kommunikation, Graphic Designer, Homepage/Print |

### 5. Bewusst nicht als eigenständige Projekte geführt

| Thema / Vorhaben | Einordnung | Portfolio-Begründung / Zuordnung |
|---|---|---|
| 125-Jahre-Jubiläumszuschüsse nach bereits realisiertem Jubiläum | **Einzelaufgabe** | administrative Nachprüfung möglicher kommunaler/Landkreis-Zuschüsse, kein neues Vereinsprojekt |
| Finanzpuffer für laufende Kosten | **Regelbetrieb / Finanzziel** | dauerhafte finanzielle Stabilität, kein abgrenzbares Projektergebnis |
| Rücklagenaufbau | **Regelbetrieb / Finanzziel** | laufende Finanzsteuerung, kein eigenes Projekt |
| Sponsoringstrategie und laufende Partnerarbeit | **Regelbetrieb / Fachbereich** | dauerhafte Aufgabe des Partnership Managers; Produktentwicklung liegt in Partnerportal/Partner Hub |
| Konsolidierung historischer Sponsorendaten | **Arbeitsaufgabe / Discovery-Zulieferung** | operative Grundlage für Sponsoring und Partnerportal, aktuell kein eigener Projektordner nötig |
| Funding Radar / Förderkalender / Programmdossiers | **Regelbetrieb / Fachbereich** | dauerhafte Aufgabe des Funding & Grants Managers; konkrete geförderte Vereinsvorhaben bleiben eigene Projekte/Kandidaten |
| Vereinsgeschichte / Historienarchiv als Ganzes | **Regelbetrieb / Fachbereich** | dauerhafte Archivistenaufgabe ohne natürliches Projektende; nur abgegrenzte Digitalisierungs-, Erschließungs- oder Publikationsvorhaben werden Projekte |
| TuS Digital Organisation – dauerhafter Betrieb nach der Aufbauphase | **Programm / Regelbetrieb** | das formale Projekt `digital-organisation/` beschreibt die aktuelle Aufbau- und Konsolidierungsphase; der Dauerbetrieb bleibt organisatorische Klammer |
| externer Webshop – laufende UX/UI-Angleichung | **laufende Design-/Betriebsaufgabe** | erst bei einem klaren Relaunch-/Migrationsvorhaben mit eigenem Zielzustand als Projekt prüfen |
| Jugend- und Mädchenfußball allgemein | **laufendes Fach-/Förderfeld** | bestehende sportliche Arbeit; konkrete Camps, Kooperationen oder Entwicklungsprojekte können separat projektfähig werden |
| Trainer- und Schiedsrichterentwicklung | **laufendes Fach-/Förderfeld** | laufende Qualifizierungsarbeit; nur klar abgegrenzte Programme/Initiativen als Projekte führen |
| FSJ / Bildung / Ausbildung | **laufendes Fach-/Förderfeld** | wiederkehrende Vereinsarbeit; konkrete neue Einführung/Programmänderung separat prüfen |
| Ghana-Unterstützung / `Kinder von Atibie` allgemein | **laufendes soziales Feld** | kein eigenständiger Projektzustand; der konkrete Spendenweg ist derzeit eine Abhängigkeit/Funktion der TuS Tauschbörse |
| Integration / Beschäftigung / soziale Träger | **laufendes Fach-/Förderfeld** | das konkrete Vorhaben `arbeitsplatz-sportparkteam/` ist formalisiert; weitere Maßnahmen nur bei eigenem klaren Ziel und Umfang als Projekte |
| Barrierefreiheit / Teilhabe | **Projektfeld, noch kein konkretes Projekt** | Funding-Arbeitsstand zeigt Chancen, aber aktuell kein ausreichend abgegrenztes TuS-Vorhaben dokumentiert |
| Theater / Kultur allgemein | **laufender Vereinsbereich / Förderfeld** | konkrete Produktionen oder partizipative Projekte erst bei realem Scope als Projekt führen |
| Gesundheits-, Sicherheits- und Präventionsangebote | **Themen-/Partnerfeld** | aktuell kein ausreichend abgegrenztes Projektvorhaben dokumentiert |
| `plugins/event-manager/` | **fachliches/architektonisches Wissensartefakt, kein formales Projekt** | besitzt kein `PROJECT-STATE.md` und überschneidet sich stark mit dem Event Planner; Verhältnis klären, bevor daraus parallel Funktionen oder ein eigenes Projekt entstehen |

### 6. Wesentliche Abhängigkeiten und Überschneidungen

#### Aufbau Digitale Vereinsorganisation ↔ alle Fachprojekte

Das Aufbauprojekt schafft gemeinsame Organisations-, Rollen-, Wissens-, Governance- und Architekturgrundlagen, übernimmt aber nicht die fachliche Leitung der einzelnen Projekte.

#### Event Planner ↔ Mitglieder & Engagement ↔ Team Manager

Die drei Projekte dürfen keine getrennten Personen- und Mannschaftsdatenwelten aufbauen. Gemeinsame Personen-/Mitgliedsidentität, Mannschaftsidentität, Saison-/Gruppenzuordnungen und Objektverantwortung bleiben vorgelagerte Architekturthemen.

#### Partnerportal ↔ Partner Hub ↔ operatives Partner-CRM

Die Produktabgrenzung ist verbindlich entschieden:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

Das native Google Sheet `TuS Partner CRM – Operative Source of Truth` ist derzeit die geschützte operative Zwischenlösung. Es ersetzt weder die fachliche Partnerstrategie noch erzeugt es eine zweite langfristige Partnerdatenwelt. Langfristig kann das interne Partnerportal die operative CRM-Verantwortung übernehmen.

#### Trainingskleidung ↔ Partnership / Sport / Ausrüster

Das Projekt benötigt eine klare Trennung zwischen Ausrüsterkonditionen und Finanzierungspartnerschaft. SPORTINN/Joma ist bestehender Ausrüster und nicht der zusätzliche Finanzierungspartner. Vor Bestellung müssen Sponsorlogo-/Ausrüsterrechte, konkrete Artikel, Größenmix, Lager-/Ausgabeprozess, Rechtseinheit und Finanzierung geklärt sein.

#### Homepage ↔ fachliche Systeme

Die Homepage soll keine zweite Datenpflege aufbauen. Führende Quellen bleiben fachliche Systeme und Wissensquellen; öffentliche Partnerseite und allgemeiner Homepage-Neuaufbau müssen als eine konsistente Weblandschaft geplant werden.

#### `plugins/event-manager/` ↔ Event Planner

Das bestehende Event-Manager-Zielbild überschneidet sich stark mit dem formalen Event-Planner-Projekt. Bis zur Einordnung als Langfristvision, Domänenreferenz oder historischer Konzeptstand entsteht daraus kein zweites Eventprojekt.

#### Infrastrukturprojekte ↔ Funding / Sponsoring / Finanzen

Umkleideböden, Fassade, Kunstrasen, Bewässerung, Jugendräume, Festplatzgebäude, Energie/PV, Großfeldtore und LED Media Screen teilen wiederkehrende Abhängigkeiten: Owner, Eigentums-/Nutzungsrecht, Scope, Kosten-/Finanzierungsplan, Genehmigungen, Förderbedingungen, Vorhabenbeginn und Partnerpotenzial.

#### Arbeitsplatz Sportparkteam ↔ Funding / Sponsoring / Vereinsentwicklung

Funding klärt vorrangig § 16i und hilfsweise § 16e. Sponsoring entwickelt eine langfristige Partnerfinanzierung für Eigenanteile und Anschlussphase. Vereinsentwicklung/Sportpark definiert Tätigkeitsprofil, Arbeitsumfang und fachliche Einbindung.

### 7. Offene Portfolio-Lücken und nächste Koordinationspunkte

1. **Fachliche Owner präzisieren:** Für Event Planner, Mitglieder & Engagement, TuS Tauschbörse, Team Manager, LED Media Screen, Aufbau Digitale Vereinsorganisation, Großfeldtore, Arbeitsplatz Sportparkteam und Trainingskleidung ist kein expliziter fachlicher Projekt-/Produkt-Owner dokumentiert. Bei Mitglieder & Engagement ist zusätzlich der federführende Verantwortungsbereich nicht eindeutig.
2. **Event Planner verifizieren:** aktuellen Plugin-Stand manuell prüfen und erst nach vollständigem Smoke-Test einen neuen LKG festlegen.
3. **Partnerplattform konkretisieren:** gemeinsame Partnerdatenbasis, Objektverantwortung, Rollen/Freigaben und MVP-Grenzen entscheiden; operative CRM-Zwischenlösung nicht zur parallelen Langfristarchitektur ausbauen.
4. **WISO-Status korrigieren:** Frist ist abgelaufen; externen Einreichungsnachweis prüfen und Projekt-/Funding-State entsprechend nachziehen.
5. **Großfeldtore bestellreif machen:** BSB-Konfiguration und Gesamtpreis klären; Kellogg’s nur als bereits eingereichten Vorgang nachhalten, sobald Projektzuordnung bekannt ist.
6. **LED Media Screen bis Go/No-Go schärfen:** Technik, Fundament, Strom, Genehmigung, Rechtseinheit und Finanzierung ohne angenommenen Zuschuss klären.
7. **Arbeitsplatz Sportparkteam förder- und entscheidungsreif machen:** bis 18.09. Jobcenter vorabklären, dann Tätigkeitsprofil, Stundenmodelle und Partnerfinanzierung entwickeln.
8. **Trainingskleidung partnerschafts- und bestellreif machen:** Partnerangebot konkretisieren, 3–5 Leads qualifizieren, Rechte/Artikel/Größen klären und erst nach Finanzierung/Freigabe bestellen.
9. **Digitale Vereinsorganisation nach WISO schärfen:** Aufbauleistungen, offene Arbeitspakete, Zielgruppen, messbare Wirkung, Zeitraum und Budget strukturieren.
10. **Homepage formalisierungsreif machen:** Owner, technischen Ist-Stand und Umsetzungsweg klären; erst dann eigenen Projektordner entscheiden.
11. **Event-Manager-Artefakt einordnen:** Doppelentwicklung verhindern.
12. **Weitere Infrastruktur-Kandidaten schärfen:** zuerst Vorhaben mit realer Entscheidung, Finanzierung, Frist oder Vorhabenbeginn-Risiko.
13. **Archiv sauber trennen:** Archiv als Regelbetrieb; nur abgegrenzte Erschließungs-/Digitalisierungs-/Publikationsvorhaben als Projekte.

### 8. Nutzung durch andere Mitarbeiter

Andere Rollen verwenden dieses Portfolio zur Orientierung und springen anschließend in die jeweilige Detailquelle.

- Funding & Grants Manager → reale Projekte, Kandidaten und fördersensible Investitionen,
- Partnership Manager → Projekte mit Partner-/Finanzierungs-/Aktivierungspotenzial,
- WordPress Developer → technische Projekte und vorgelagerte Architekturentscheidungen,
- Graphic Designer → Homepage-, Partner-, Merch-, Infrastruktur- und Publikationsvorhaben mit Designbedarf,
- Archivist → Trennung von dauerhaftem Archivbetrieb und echten Projekten,
- Fachbereiche → Owner-, Scope- und Entscheidungsbedarf.

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