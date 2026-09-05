# TuS Project Portfolio

Stand: 2026-09-05 – LED Media Screen formalisiert und Portfolio-Stand synchronisiert

## Purpose

Dieses Dokument ist die zentrale organisationsweite Übersicht über relevante TuS-Projekte und Projektkandidaten.

Es ist kein zweites Projektmanagement-System und ersetzt keine `PROJECT-STATE.md`.

## Core Principle

> **Detailwahrheit im Projekt. Portfolioübersicht zentral.**

Andere Mitarbeiter sollen von hier aus schnell erkennen können, welche Vorhaben existieren, wo der aktuelle Stand liegt, wer fachlich zuständig ist und welche Abhängigkeiten relevant sind.

## Main Content

### 1. Inventur-Ergebnis

Die aktuelle Repository- und Arbeitsstandprüfung ergibt:

- **7 formale Projekte** unter `projects/`, jeweils mit `README.md` und `PROJECT-STATE.md`,
- davon **1 Aktiv** und **6 Discovery**,
- mehrere reale Projektkandidaten aus Homepage-, Infrastruktur-, Archiv- und Förderarbeit,
- mehrere Themen, die bewusst **kein eigenes Projekt** sind, sondern Einzelmaßnahmen, Regelbetrieb, Fachfelder oder ein übergeordnetes Programm.

Der LED Media Screen wurde am 05.09.2026 vom Kandidaten zum formalen Projekt hochgestuft, weil inzwischen ein konkreter Standort, zwei Visualisierungen, ein belastbares Lieferantenangebot, technische Eckdaten und ein eigenes Finanzierungs-/Partnerkonzept vorliegen.

Für offene Pull Requests gilt weiterhin: Sie sind als bekannter Arbeitsstand relevant, werden aber bis zum Merge **nicht** als verbindliche `main`-Wahrheit behandelt.

PR #28 zur Abgrenzung von Partnerportal und Partner Hub sowie PR #30 zum operativen Förderradar sind inzwischen gemergt und damit Bestandteil des verbindlichen `main`-Stands.

### 2. Formale Projekte

| Projekt | Fachlicher Verantwortungsbereich / Owner | Status | Verbindliche Detailquelle | Nächster sinnvoller Schritt | Wesentliche Abhängigkeit / Portfolio-Hinweis | Querschnitt |
|---|---|---|---|---|---|---|
| Event Planner | Veranstaltungen; technischer Owner: WordPress Developer; fachlicher Produkt-Owner nicht explizit benannt | Aktiv | `event-planner/PROJECT-STATE.md` | gemergte Dashboard-Logik in kleinen Inkrementen umsetzen und offenen Baseline-Smoke-Test vollständig abschließen | `PROJECT-STATE.md` ist teilweise veraltet: PR #29 und Folge-PR #31 sind bereits gemergt; formaler LKG weiterhin offen; gemeinsame Personen- und Mannschaftsidentität beeinflusst spätere Ausbaustufen | Entwicklung, Design, Mitglieder & Engagement, Team Manager, Homepage |
| Mitglieder & Engagement | noch kein eindeutiger einzelner Verantwortungsbereich/Owner; fachlicher Kontext Mitglieder / Engagement / Organisation | Discovery | `member-engagement/PROJECT-STATE.md` | bestehende Mitgliederverwaltung analysieren und gemeinsame Personen-/Mitgliedsidentität definieren | darf keine zweite Personendatenwelt erzeugen; hängt eng an Event Planner und Team Manager | Entwicklung, Datenschutz, Veranstaltungen, Sport, ggf. Funding/Ehrenamt |
| Partner Hub | Sponsoring / Partnership Manager | Discovery | `partner-hub/PROJECT-STATE.md` | gemeinsame Partnerdatenbasis, Rollen/Freigaben, Account-Lifecycle und MVP-Grenzen konkretisieren | Produktabgrenzung ist verbindlich entschieden: Partner Hub = partnerseitige Oberfläche für bestehende Partner; gemeinsame Partnerdatenbasis mit Partnerportal | Sponsoring, Entwicklung, Design, Homepage, Event Planner, Portfolio |
| Partnerportal | Sponsoring / Partnership Manager | Discovery | `partner-portal/PROJECT-STATE.md` | reale Sponsorendaten und Steuer-Ist konsolidieren, gemeinsame Partnerdatenbasis definieren und internes MVP reduzieren | Produktabgrenzung ist verbindlich entschieden: Partnerportal = internes TuS-Arbeitswerkzeug; keine getrennte Partnerdatenwelt zum Partner Hub | Sponsoring, Finanzen/Steuer, Entwicklung, Design, Homepage |
| TuS Tauschbörse | Gesellschaft & Soziales; fachlicher Produkt-Owner nicht explizit benannt | Discovery | `reuse-marketplace/PROJECT-STATE.md` | konto-freien Vermittlungsablauf, Datenschutz/Missbrauchsschutz und realen `Kinder von Atibie`-Spendenweg konkretisieren; danach MVP festlegen | `PROJECT-STATE.md` ist teilweise veraltet: der dort genannte Initial-Scope-Branch wurde über PR #18 bereits gemergt; noch kein Plugin-Code | Entwicklung, Design, Datenschutz, Gesellschaft & Soziales, ggf. Funding |
| Team Manager | Sport; fachlicher Produkt-Owner nicht explizit benannt | Discovery | `team-manager/PROJECT-STATE.md` | gemeinsame Mannschaftsidentität und Saisonmodell definieren; danach Jahrgangs-/Ressourcenlogik und fussball.de-Anbindung untersuchen | `PROJECT-STATE.md` ist teilweise veraltet: Initial-Scope PR #17 ist bereits gemergt; keine parallele Mannschafts- oder Personendatenwelt aufbauen | Sport, Entwicklung, Datenschutz, Event Planner, Mitglieder & Engagement, Homepage |
| LED Media Screen | Sponsoring / Infrastruktur / Kommunikation; fachlicher Projekt-Owner noch offen | Discovery | `led-media-screen/PROJECT-STATE.md` | vor Ablauf der Angebots-Preisbindung Technikbeiblatt, Fundament, Strom, Funding-Check, Genehmigung und Gesamtfinanzierung klären | Angebot 30260839-2: 48.779 € netto nach 2.000 € goracon-Sponsoringrabatt; Drive-Artefaktraum vorhanden; keine Bestellung ausgelöst | Partnership Manager, Funding & Grants, Infrastruktur, Finanzen, Kommunikation/Design, Vorstand |

### 3. Aktualität der formalen Projektzustände

| Projekt | Portfolio-Befund | Erforderliche Pflege |
|---|---|---|
| Event Planner | **prüfbedürftig** | aktiven Branch/PR und nächsten Schritt nach Merge von #29/#31 aktualisieren; verbliebene Implementierungs- und Smoke-Test-Schritte als aktuellen Zustand festhalten |
| Mitglieder & Engagement | **aktuell / ausreichend** | keine künstliche Aktualisierung; nächste reale Änderung erst nach Analyse der Mitgliederverwaltung bzw. Architekturentscheidung |
| Partner Hub | **aktuell** | nächste Aktualisierung nach Entscheidung zu gemeinsamer Partnerdatenbasis, Rollen/Freigaben oder MVP |
| Partnerportal | **aktuell** | nächste Aktualisierung nach Konsolidierung realer Sponsorendaten, Steuer-Ist oder gemeinsamer Partnerdatenbasis |
| TuS Tauschbörse | **teilweise veraltet** | gemergten Initial-Scope als erledigt markieren und nur die danach verbleibenden Discovery-Schritte führen |
| Team Manager | **teilweise veraltet** | gemergten Initial-Scope als erledigt markieren und nächsten Architektur-/Discovery-Schritt als aktuellen Einstieg setzen |
| LED Media Screen | **aktuell** | bei Änderung von Angebot, Owner, Förderung, Genehmigung, Finanzierung oder Beauftragungsstatus aktualisieren |

Alle sieben formalen Projekte erfüllen die minimale Projektstruktur aus `projects/README.md`.

### 4. Reale Projektkandidaten

Die folgenden Vorhaben sind ausreichend relevant, um im Portfolio sichtbar zu bleiben, aber noch nicht automatisch reif für einen eigenen Projektordner.

| Vorhaben | Status | Möglicher fachlicher Bereich / Owner | Warum portfolio-relevant | Nächste Portfolio-Aktion | Querschnitt |
|---|---|---|---|---|---|
| Neuaufbau TuS-Homepage | Kandidat | Kommunikation; fachlicher Projekt-Owner noch festzulegen | Zielbild, Startseitenarchitektur, Responsive-Regeln, Datenquellen und Umsetzungsreihenfolge sind bereits in `../design/homepage-standard.md` dokumentiert; damit deutlich mehr als eine lose Idee | aktuellen technischen Ist-Stand, Umsetzungsweg und fachlichen Owner klären; **vor aktiver Implementierung prüfen, ob eigener Projektzustand nötig ist** | Entwicklung, Graphic Designer, Team Manager/fussball.de, Event Planner, Partnerdaten, Archiv/Content |
| Umkleideböden / klar abgegrenzte Umkleidesanierung | Kandidat | Infrastruktur / Sport; Owner offen | konkrete kurzfristige Investitionsmaßnahme; im Funding-Radar als besonders prüfenswert und vor Beauftragung fördersensibel markiert | Scope, Kosten, Eigentums-/Nutzungsrecht und Verantwortlichkeit klären; Förderprüfung **vor** förderschädlichem Vorhabenbeginn | Funding, Infrastruktur, Finanzen, Sport, ggf. Sponsoring |
| Hauptgebäude / Fassade | Kandidat | Infrastruktur; Owner offen | kurzfristig priorisierte Gebäudeaufwertung mit möglichem Partner-/Förderbezug | zuerst trennen: reine Optik/Instandhaltung oder echte energetische Sanierung; danach Kosten, Finanzierung und Owner klären | Funding, Sponsoring, Infrastruktur, Finanzen, Design |
| Kunstrasen | Kandidat | Infrastruktur / Sport / Finanzen; Owner offen | großes langfristiges Sportstätten- und Finanzierungsprojekt mit hohem Planungsbedarf | Zielbild, Trägerschaft/Eigentum, Kostenrahmen, Priorität und Vorplanung klären; Förder-/Finanzierungsweg früh einbeziehen | Funding, Infrastruktur, Sport, Finanzen, Sponsoring |
| Jugendräume | Kandidat | Jugend / Infrastruktur; Owner offen | mittelfristiges Infrastruktur- und Jugendvorhaben | Bedarf, Nutzergruppen, Scope, Standort, Verantwortlichkeit und Finanzierung klären | Funding, Jugend, Infrastruktur, Sponsoring, Design |
| Funktions-/Unterstellgebäude Festplatz | Kandidat | Infrastruktur / Veranstaltungen; Owner offen | mittelfristiges Bau- und Nutzungsprojekt mit Veranstaltungsbezug | Bedarf, Nutzung, Genehmigungs-/Trägerschaftsfragen, Kosten und Owner klären | Funding, Infrastruktur, Veranstaltungen, Sponsoring |
| Bekleidungslager / physischer Vereins-Shop | Kandidat | Organisation / Merch / Finanzen; Owner offen | reale organisatorische und ggf. räumliche Infrastrukturfrage | physischen Lager-/Ausgabebedarf vom extern gehosteten Webshop trennen und nur den tatsächlich abgegrenzten Projektumfang weiterführen | Organisation, Finanzen, Design, Sponsoring |
| Energie / PV / Speicher / Klimaschutzmaßnahmen | Kandidat | Infrastruktur / Nachhaltigkeit / Finanzen; Owner offen | potentiell größere Investitions- und Fördermaßnahmen | konkretes Gebäude/Anlage, Energieproblem, technische Zielsetzung und Wirtschaftlichkeit bestimmen | Funding, Infrastruktur, Finanzen |
| Bewässerungsanlage / nachhaltige Platzpflege-Investition | Kandidat | Infrastruktur / Sport; Owner offen | im Funding-Radar als konkretes Investitionsfeld erkennbar; von laufender Platzpflege zu trennen | realen Investitionsbedarf, technische Lösung, Eigentums-/Nutzungsrecht, Kosten und laufende Wasserförderung klären | Funding, Infrastruktur, Sport, Finanzen |
| Aufbau / nachhaltige Organisation Sportparkteam | Kandidat | Infrastruktur / Vereinsentwicklung; Owner offen | organisatorisches Vorhaben ist in Sponsoring-/Funding-Arbeitsständen sichtbar, aber Zielbild und Abgrenzung zum laufenden Betrieb sind noch nicht klar | klären, ob eine einmalige Aufbau-/Entwicklungsinitiative existiert oder lediglich dauerhafter Regelbetrieb finanziert werden soll | Vereinsentwicklung, Infrastruktur, Funding, Sponsoring |
| Historienarchiv – abgegrenztes Erschließungs-/Digitalisierungsprojekt | Kandidat | Archiv & Vereinsgeschichte / Archivist | das Historienarchiv als Ganzes ist Regelbetrieb; ein professionell abgegrenztes Erschließungs-/Digitalisierungsvorhaben könnte dagegen einen eigenen Projektzustand benötigen und ist im Funding-Radar relevant | konkretes Quellenpaket, Ziel, Output, Umfang, Rechte, professionellen Veröffentlichungsweg und Finanzierung definieren; erst dann formalisieren | Archivist, Funding, Kommunikation, Design, Datenschutz/IT |
| Historien-/Jubiläumspublikation oder andere konkrete Archiv-Ausgabe | Kandidat | Archiv & Vereinsgeschichte / Kommunikation | Archivarbeit erzeugt wiederverwendbare Inhalte; eine konkrete Publikation kann ein eigenes abgrenzbares Ergebnis besitzen | nur bei klar beschlossenem Produkt, Zielgruppe, Umfang, Termin und Owner als Projekt führen | Archivist, Kommunikation, Graphic Designer, Homepage/Print |

### 5. Bewusst nicht als eigenständige Projekte geführt

Diese Einordnung verhindert, dass Aufgaben, Facharbeit und Wunschlisten künstlich zu Projekten werden.

| Thema / Vorhaben | Einordnung | Portfolio-Begründung / Zuordnung |
|---|---|---|
| Zusätzliche Tore / Netze | **Einzelmaßnahme / Beschaffung** | konkrete, förderrelevante Beschaffung; im Funding-Radar als A-Chance bewertet. Solange daraus kein größerer Planungszustand entsteht, reicht die Steuerung über Funding + zuständigen Fachbereich |
| 125-Jahre-Jubiläumszuschüsse nach bereits realisiertem Jubiläum | **Einzelaufgabe** | administrative Nachprüfung möglicher kommunaler/Landkreis-Zuschüsse, kein neues Vereinsprojekt |
| Finanzpuffer für laufende Kosten | **Regelbetrieb / Finanzziel** | dauerhafte finanzielle Stabilität, kein abgrenzbares Projektergebnis |
| Rücklagenaufbau | **Regelbetrieb / Finanzziel** | laufende Finanzsteuerung, kein eigenes Projekt |
| Sponsoringstrategie und laufende Partnerarbeit | **Regelbetrieb / Fachbereich** | dauerhafte Aufgabe des Partnership Managers; Produktentwicklung liegt in Partnerportal/Partner Hub |
| Konsolidierung historischer Sponsorendaten | **Arbeitsaufgabe / Discovery-Zulieferung** | operative Grundlage für Sponsoring und Partnerportal, aktuell kein eigener Projektordner nötig |
| Funding Radar / Förderkalender / Programmdossiers | **Regelbetrieb / Fachbereich** | dauerhafte Aufgabe des Funding & Grants Managers; konkrete geförderte Vereinsvorhaben bleiben eigene Projekte/Kandidaten |
| Vereinsgeschichte / Historienarchiv als Ganzes | **Regelbetrieb / Fachbereich** | dauerhafte Archivistenaufgabe ohne natürliches Projektende; nur abgegrenzte Digitalisierungs-, Erschließungs- oder Publikationsvorhaben werden Projekte |
| Digitalisierung der Vereinsorganisation | **Programm / strategisches Zielbild** | übergeordnete Klammer für mehrere Projekte; kein Megaprojekt und keine zweite Projektverwaltung erzeugen |
| externer Webshop – laufende UX/UI-Angleichung | **laufende Design-/Betriebsaufgabe** | erst bei einem klaren Relaunch-/Migrationsvorhaben mit eigenem Zielzustand als Projekt prüfen |
| Jugend- und Mädchenfußball allgemein | **laufendes Fach-/Förderfeld** | bestehende sportliche Arbeit; konkrete Camps, Kooperationen oder Entwicklungsprojekte können separat projektfähig werden |
| Trainer- und Schiedsrichterentwicklung | **laufendes Fach-/Förderfeld** | laufende Qualifizierungsarbeit; nur klar abgegrenzte Programme/Initiativen als Projekte führen |
| FSJ / Bildung / Ausbildung | **laufendes Fach-/Förderfeld** | wiederkehrende Vereinsarbeit; konkrete neue Einführung/Programmänderung separat prüfen |
| Ghana-Unterstützung / `Kinder von Atibie` allgemein | **laufendes soziales Feld** | kein eigenständiger Projektzustand erkennbar; der konkrete Spendenweg ist derzeit eine Abhängigkeit/Funktion der TuS Tauschbörse |
| Integration / Beschäftigung / soziale Träger | **laufendes Fach-/Förderfeld** | konkrete zeitlich begrenzte Maßnahmen können später Projektkandidaten werden |
| Barrierefreiheit / Teilhabe | **Projektfeld, noch kein konkretes Projekt** | Funding-Arbeitsstand zeigt Chancen, aber aktuell kein ausreichend abgegrenztes TuS-Vorhaben dokumentiert |
| Theater / Kultur allgemein | **laufender Vereinsbereich / Förderfeld** | konkrete Produktionen oder partizipative Projekte erst bei realem Scope als Projekt führen |
| Gesundheits-, Sicherheits- und Präventionsangebote | **Themen-/Partnerfeld** | aktuell kein ausreichend abgegrenztes Projektvorhaben dokumentiert |
| `plugins/event-manager/` | **fachliches/architektonisches Wissensartefakt, kein formales Projekt** | besitzt kein `PROJECT-STATE.md` und überschneidet sich stark mit dem Event Planner; Verhältnis klären, bevor daraus parallel Funktionen oder ein eigenes Projekt entstehen |

### 6. Wesentliche Abhängigkeiten und Überschneidungen

#### Event Planner ↔ Mitglieder & Engagement ↔ Team Manager

Die drei Projekte dürfen keine getrennten Personen- und Mannschaftsdatenwelten aufbauen.

Verbindlich zu klären sind insbesondere:

- gemeinsame Personen-/Mitgliedsidentität,
- gemeinsame Mannschaftsidentität,
- Saison-/Gruppenzuordnungen,
- klare Objektverantwortung für Helferschichten und Jahres-/Periodensummen.

Der Event Planner bleibt Quelle für konkrete Helferschichten und bestätigte Einsatzzeiten; Mitglieder & Engagement aggregiert die personenbezogene Jahres-/Periodensicht.

#### Partnerportal ↔ Partner Hub

Die Produktabgrenzung ist verbindlich entschieden:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

Dabei ist:

- die öffentliche Partnerseite der Akquise-Einstieg,
- das Partnerportal das interne TuS-Arbeitswerkzeug,
- der Partner Hub die partnerseitige Oberfläche bestehender Partner,
- die Partnerdatenbasis gemeinsam.

Offen bleiben die technische gemeinsame Datenbasis, Objektverantwortung, Rollen/Freigaben, Account-Lifecycle und die konkreten MVP-Grenzen.

Repository-Hygiene: Auf `main` existieren derzeit zwei akzeptierte ADR-Dateien mit der Nummer `ADR-0007` (`central-project-portfolio` sowie `partnerportal-und-partner-hub-abgrenzung`). Die fachlichen Entscheidungen sind gültig; die doppelte Nummerierung sollte separat bereinigt werden, ohne die Entscheidungen zu verändern.

#### Homepage ↔ fachliche Systeme

Die Homepage soll keine zweite Datenpflege aufbauen.

Geplante führende Quellen:

- Spiele → `fussball.de` / perspektivisch Team-Manager-Integration,
- Veranstaltungen → Event Planner,
- Partner → gemeinsamer Partnerdatenbestand,
- historische Inhalte → Archiv & Vereinsgeschichte,
- Design → zentrale TuS Design Standards.

Die öffentliche Partner-Landingpage aus der Sponsoringarbeit und der allgemeine Homepage-Neuaufbau müssen als **eine konsistente öffentliche Weblandschaft** geplant werden, nicht als zwei unabhängig gepflegte öffentliche Systeme.

#### `plugins/event-manager/` ↔ Event Planner

Das bestehende Event-Manager-Zielbild beschreibt einen sehr breiten vollständigen Event-Lebenszyklus und überschneidet sich in Aufgaben, Helfern, Kommunikation, Archivierung, Wiederverwendung und Ressourcen mit dem formalen Event-Planner-Projekt.

Vor einer Nutzung als Entwicklungsquelle ist zu entscheiden, ob `plugins/event-manager/`:

- fachliche Langfristvision des Event Planners,
- allgemeine Architektur-/Domänenreferenz,
- oder historischer/supersedierter Konzeptstand

ist.

Bis dahin entsteht daraus **kein zweites Eventprojekt**.

#### Infrastrukturprojekte ↔ Funding / Sponsoring / Finanzen

Umkleideböden, Fassade, Kunstrasen, Bewässerung, Jugendräume, Festplatzgebäude, Energie/PV und LED Media Screen teilen wiederkehrende Abhängigkeiten:

- fachlicher Owner,
- Eigentums-/Nutzungsrecht,
- belastbarer Scope,
- Kosten-/Finanzierungsplan,
- Genehmigungen,
- Förderbedingungen und möglicher förderschädlicher Vorhabenbeginn,
- Sponsoring-/Partnerpotenzial.

Funding prüft die Förderfähigkeit; Sponsoring entwickelt mögliche Partnerbeiträge. Beide Rollen übernehmen **nicht** die fachliche Projektverantwortung.

Für den LED Media Screen sind Angebot, Technik und Artefakte inzwischen in `led-media-screen/PROJECT-STATE.md` konkret dokumentiert. Eine Bestellung ist ausdrücklich noch nicht ausgelöst.

### 7. Offene Portfolio-Lücken und nächste Koordinationspunkte

1. **Fachliche Owner präzisieren:** Für Event Planner, Mitglieder & Engagement, TuS Tauschbörse, Team Manager und LED Media Screen ist kein expliziter fachlicher Projekt-/Produkt-Owner dokumentiert. Bei Mitglieder & Engagement ist zusätzlich der federführende Verantwortungsbereich nicht eindeutig.
2. **PROJECT-STATE-Pflege auslösen:** Event Planner, TuS Tauschbörse und Team Manager nach bereits gemergten PRs bereinigen.
3. **Partnerplattform weiter konkretisieren:** Nach der verbindlichen Produktabgrenzung nun gemeinsame Partnerdatenbasis, Objektverantwortung, Rollen/Freigaben und MVP-Grenzen entscheiden.
4. **Funding-Radar als verbindlichen Arbeitsstand nutzen:** PR #30 ist gemergt. Bei investiven Vorhaben weiterhin vor Beauftragung prüfen, ob Förderbedingungen einen Vorhabenbeginn sperren oder besondere Nachweise verlangen.
5. **LED Media Screen bis Go/No-Go schärfen:** technisches Beiblatt, Fundament, Stromanschluss, Genehmigung, Funding-Check, Rechtseinheit und vollständige Gesamtfinanzierung vor einer Bestellung klären.
6. **Homepage formalisierungsreif machen:** fachlichen Owner, technischen Ist-Stand und Umsetzungsweg klären. Erst dann entscheiden, ob ein eigener Projektordner/`PROJECT-STATE.md` notwendig ist.
7. **Event-Manager-Artefakt einordnen:** Verhältnis von `plugins/event-manager/` zu `projects/event-planner/` klären und Doppelentwicklung verhindern.
8. **Weitere Infrastruktur-Kandidaten schärfen:** nicht alle gleichzeitig formalisieren; zuerst die Vorhaben mit realer Entscheidung, Finanzierung, Frist oder Vorhabenbeginn-Risiko.
9. **Archiv sauber trennen:** Archiv als Regelbetrieb beibehalten; nur konkret abgegrenzte Digitalisierungs-/Erschließungs-/Publikationsvorhaben als Projekte führen.
10. **ADR-Nummerierung bereinigen:** zwei akzeptierte `ADR-0007` sind vorhanden; Nummerierung ohne Änderung der fachlichen Entscheidungen konfliktfrei machen.

### 8. Nutzung durch andere Mitarbeiter

Andere Rollen verwenden dieses Portfolio zur Orientierung und springen anschließend in die jeweilige Detailquelle.

- Funding & Grants Manager → findet reale Projekte, Kandidaten und fördersensible Investitionen,
- Partnership Manager → erkennt Projekte mit Partner-/Finanzierungs-/Aktivierungspotenzial,
- WordPress Developer → erkennt technische Projekte und vorgelagerte Architekturentscheidungen,
- Graphic Designer → erkennt Homepage-, Partner-, Merch-, Infrastruktur- und Publikationsvorhaben mit Designbedarf,
- Archivist → trennt dauerhaften Archivbetrieb von echten Erschließungs-/Digitalisierungs-/Publikationsprojekten,
- Fachbereiche → erkennen, wo ein Owner, Scope oder nächster Projektentscheid fehlt.

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

Der nächste Reifegewinn entsteht nicht durch zusätzliche Felder, sondern durch:

- aktuelle Projektzustände,
- eindeutige fachliche Owner,
- geklärte Systemgrenzen,
- und die gezielte Formalisierung nur der Vorhaben, die tatsächlich einen eigenen dauerhaften Projektzustand benötigen.
