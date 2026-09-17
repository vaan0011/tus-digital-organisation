# Besucher- und Funktionslandkarte der TuS-Homepage

## Purpose

Dieses Dokument übersetzt die vorhandenen Homepage-, Fachmodul- und Projektanforderungen in eine gemeinsame Sicht aus Perspektive der Besucherinnen und Besucher.

Es beantwortet für häufige Anliegen:

- welche Frage ein Besucher mitbringt,
- über welchen öffentlichen Weg die Antwort erreichbar sein muss,
- welches System die führende Quelle ist,
- welche Komponente die Information darstellt,
- was bereits verbindlich definiert ist,
- und welche Inhalte oder Integrationen vor der Veröffentlichung noch ergänzt werden müssen.

Die Landkarte ist keine zweite Fachspezifikation. Sie verbindet die bestehenden Quellen und verhindert, dass die Homepage nach internen Plugins statt nach Nutzerzielen strukturiert wird.

## Core Principle

> **Besucherfrage → klare Antwort → eindeutige nächste Aktion.**

Ein Besucher muss die interne Organisation und die technischen Module des TuS nicht kennen.

Für Daten und Funktionen gilt weiterhin:

> **Das Theme liefert Look und Layout. WordPress-Inhalte und Fachplugins liefern Content, Daten und Funktionen.**

Informationen werden einmal in ihrer fachlich führenden Quelle gepflegt und auf der Homepage passend dargestellt.

## Main Content

### 1. Quellenhierarchie

Für diese Funktionslandkarte gilt folgende Reihenfolge:

1. GitHub-Dokumente und ADRs sind die verbindliche Quelle für Architektur, Systemgrenzen und bereits gefasste Entscheidungen.
2. Google-Drive-Unterlagen liefern ergänzende reale Inhalte, Arbeitsstände, Konzepte und Belege für wiederkehrende Nutzerbedürfnisse.
3. Das freigegebene Homepage-Mockup ist die visuelle Referenz.
4. Die bestehende Homepage ist Migrations- und Inhaltsquelle, aber nicht automatisch Zielarchitektur.

Im Google-Drive-Projektbereich existiert derzeit kein eigener Homepage-Ordner. Relevante Unterlagen liegen verteilt in Vereins-, Veranstaltungs-, Sponsoring- und Organisationskontexten. Sie werden deshalb ergänzend ausgewertet, aber nicht als parallele technische Spezifikation behandelt.

### 2. Prioritätsstufen der Nutzerwege

- **P1 – direkt:** auf der Startseite sichtbar oder über einen eindeutigen Hauptnavigationseintrag erreichbar.
- **P2 – schnell:** höchstens zwei verständliche Schritte ab Startseite.
- **P3 – Service:** über Suche, Service-Navigation oder Footer zuverlässig auffindbar.

P1 bedeutet nicht, dass jedes Anliegen einen großen eigenen Startseitenblock benötigt. Es bedeutet, dass der Weg weder versteckt noch von internem Vereinswissen abhängig sein darf.

### 3. Besucher- und Funktionslandkarte

#### Orientierung, Aktualität und Vereinsleben

| Priorität | Besucherfrage | Öffentlicher Weg / Antwort | Führende Quelle | Umsetzung und Status |
|---|---|---|---|---|
| P1 | Was ist der TuS Mingolsheim? | Hero, kurzer Vereinseinstieg, Abteilungen und Kennzahlen | WordPress-Seiten und zentrale Kennzahlenkonfiguration | in Homepage-Standard und Mockup definiert |
| P1 | Was passiert gerade beim TuS? | nächste Spiele, aktuelle Nachrichten und nächste Veranstaltungen | Team Manager/Matchdaten, WordPress-Beiträge, Event Planner | Zielbild definiert; Fachintegrationen teilweise noch im Aufbau |
| P1 | Was gibt es Neues? | Lead Story, aktuelle Beiträge, Alle Nachrichten | WordPress-Beiträge | mit WordPress Core umsetzbar |
| P1 | Welche Veranstaltungen stehen an? | EventCards, Veranstaltungsübersicht und Veranstaltungsdetail | Event Planner | Fachumfang definiert; öffentliche Render-Schnittstelle schrittweise anbinden |
| P2 | Welche Abteilungen und Vereinsbereiche gibt es? | dynamische Abteilungsübersicht und Abteilungsseiten | hierarchische WordPress-Seiten | in Homepage- und Content-Modell definiert |
| P2 | Wie hat sich der Verein entwickelt? | Verein, Geschichte, Jubiläumsmagazin und später Archiv-Inhalte | WordPress, Magazin/PDF, perspektivisch Archiv | Magazin ist für V1 prominent vorgesehen |
| P3 | Ich kenne den Seitennamen nicht – wie finde ich etwas? | gut sichtbare Suche in Desktop- und Mobile-Header | WordPress-Suche | Theme-Verantwortung; Suchergebnisse müssen relevante Inhaltstypen verständlich darstellen |

#### Fußball, Mannschaften und Training

| Priorität | Besucherfrage | Öffentlicher Weg / Antwort | Führende Quelle | Umsetzung und Status |
|---|---|---|---|---|
| P1 | Wann spielt der TuS als Nächstes? | Startseitenblock Nächste Spiele mit priorisierten MatchCards | Matchdaten-Modul im Team Manager; FUSSBALL.DE/Sportmedia als externe Quelle | Architektur entschieden; produktiver Provider-Spike noch offen |
| P2 | Wo finde ich alle Spiele oder Ergebnisse? | zentrale Spielübersicht, Mannschaftsseite und offizieller Fallback-Link | Team Manager/Matchdaten | dynamischer Block vorgesehen; ohne Import neutraler Fallback |
| P2 | Welche Mannschaft passt zu mir oder meinem Kind? | Mannschaftsübersicht mit Herren, Frauen, Jugend und weiteren Teams | Team Manager | Fachmodell definiert, Plugin-Code noch nicht vorhanden |
| P2 | Wann und wo trainiert eine Mannschaft? | Mannschaftsseite und Trainingsübersicht | Team Manager | zentrale Pflege ist verbindliches Ziel |
| P2 | Wer trainiert die Mannschaft und wie nehme ich Kontakt auf? | Trainerteam und rollenbasierter Kontaktweg | Team Manager plus Kontaktarchitektur | öffentliche Freigabe und Rollenrouting beachten |
| P2 | Wie sind Trainingsplätze und Hallen belegt? | verständliche Platz-/Hallenbelegung | Team Manager für Trainingsdaten, TuS Platzbelegung für Ressourcen-/Gesamtsicht | Systemgrenze definiert; Projekt in Discovery |

#### Mitmachen, Mitgliedschaft und Engagement

| Priorität | Besucherfrage | Öffentlicher Weg / Antwort | Führende Quelle | Umsetzung und Status |
|---|---|---|---|---|
| P1 | Kann ich ein Probetraining machen? | Schnelleinstieg Probetraining, kurze Zielseite und klarer Kontakt-/Anfrageweg | WordPress-Seite plus rollenbasierter Sport-/Jugendkontakt | als Schnelleinstieg definiert; Formular-/Routingdetails vor Go-live festlegen |
| P1 | Mein Kind möchte Fußball spielen – was muss ich tun? | Einstieg Jugend & Eltern mit Altersorientierung, Probetraining, Mannschaft und Kontakt | WordPress-Inhalt plus Team Manager | Nutzerweg definiert; Teamdaten später dynamisch |
| P1 | Wie kann ich Schiedsrichterin oder Schiedsrichter werden? | direkter Eintrag unter Mitmachen und sichtbarer kontextbezogener Einstieg von der Startseite | redaktionelle WordPress-Seite plus freigegebener Schiedsrichter-/Sportkontakt | **neue verbindliche Anforderung**; bislang nicht als eigener Homepage-Nutzerweg dokumentiert |
| P1 | Wie kann ich mich beim TuS engagieren? | Mitmachen-Einstieg mit Helfen, Trainer/Betreuer, Sportparkteam und weiteren Rollen | WordPress-Inhalte; perspektivisch Mitglieder & Engagement | allgemeiner Einstieg definiert; konkrete Möglichkeiten redaktionell pflegen |
| P2 | Wie werde ich Mitglied? | Mitgliedschaftsseite mit aktuellem Ablauf, Beiträgen, Dokumenten und Kontakt | WordPress-Seite plus bestehende Mitgliederverwaltung | kein neues Mitgliedersystem in Homepage V1; Ist-Prozess vor Migration prüfen |
| P2 | Wie kann ich Trainerin, Trainer oder Betreuer werden? | Mitmachen-Seite mit Voraussetzungen, Qualifizierung und Kontakt | WordPress-Seite plus Sport-/Jugendkontakt | redaktioneller Nutzerweg; keine eigene Homepage-Datenbank |
| P3 | Wo sehe ich offene Helferschichten oder meine Einsätze? | später Mitglieder-/Engagement-Ansicht | Event Planner und Mitglieder & Engagement | nicht Teil des ersten Homepage-Theme-Inkrements |

##### Mindestinhalt der Seite Schiedsrichter werden

Die Zielseite soll mindestens beantworten:

- Warum sind Schiedsrichter für Verein und Spielbetrieb wichtig?
- Wer kann Schiedsrichter werden?
- Wie läuft Ausbildung, Prüfung und Einstieg grundsätzlich ab?
- Welche Unterstützung übernimmt der TuS?
- Wer ist der offizielle rollenbasierte Kontakt?
- Was ist der nächste konkrete Schritt?

Aktuelle Verbandsangaben, Voraussetzungen, Kosten, Termine und Ansprechpartner werden vor Veröffentlichung fachlich geprüft und nicht dauerhaft ungeprüft im Theme hinterlegt.

Der Google-Drive-Bestand bestätigt Schiedsrichter als eigenständigen sichtbaren Vereinsbereich. Historische Zahlen aus Flyern werden jedoch nicht ungeprüft auf die neue Homepage übernommen.

#### Partner und Sponsoren

| Priorität | Besucherfrage | Öffentlicher Weg / Antwort | Führende Quelle | Umsetzung und Status |
|---|---|---|---|---|
| P1 | Welche Unternehmen unterstützen den TuS? | kuratierter Partnerbereich auf der Startseite plus Alle Partner | Partnerdatenquelle; übergangsweise kontrolliert redaktionell | bereits im Homepage-Standard definiert; ausdrücklich keine unstrukturierte Logo-Wand |
| P1 | Wie kann mein Unternehmen Partner werden? | sichtbarer CTA Partner werden, Partner-Landingpage und später Partner-Fit-Check | öffentliche Partner-Entry-Spezifikation und Partnerportal | fachlich detailliert spezifiziert |
| P2 | Was bewirken Partnerschaften beim TuS? | Partnerstories, Projekte, Aktivierungen und gemeinsame Wirkung | Partnerportal/Partnerdaten und freigegebene redaktionelle Inhalte | für MVP teilweise optional, strukturell vorzusehen |
| P2 | Welche Ziele kann eine Partnerschaft unterstützen? | zielbasierter Einstieg: Reichweite, Recruiting, Jugend, Gesundheit, Gemeinschaft, Netzwerk, Infrastruktur | Partnerkonzept und Partner-Fit-Check | verbindlich zielbasiert, nicht als reiner Preiskatalog |
| P3 | Ich bin bereits Partner – wo finde ich meinen Bereich? | später klarer Zugang zum Partner Hub | Partner Hub | späterer Ausbau; nicht Teil des öffentlichen Homepage-MVP |

Für die Startseite gelten zwei getrennte Aufgaben:

1. **Unsere Partner sichtbar machen:** kuratierte, wertige Darstellung der bestehenden Unterstützer.
2. **Neue Partner gewinnen:** klarer Einstieg Partner werden mit einem strukturierten nächsten Schritt.

Partnerlogos werden vollständig, unverzerrt und mit sinnvollen zugänglichen Namen dargestellt. Das Theme enthält keine fest codierte Partnerliste.

#### Veranstaltungen, Sportpark und Service

| Priorität | Besucherfrage | Öffentlicher Weg / Antwort | Führende Quelle | Umsetzung und Status |
|---|---|---|---|---|
| P1 | Welche Veranstaltung oder welches Camp findet als Nächstes statt? | EventCard und Eventdetail mit Termin, Ort und Anmeldung/Buchungsweg | Event Planner | Event-/Camp-Modell definiert |
| P2 | Wie melde ich mich zu einem Camp oder Event an? | interne Anmeldung, externer Buchungslink oder reine Information – je Event | Event Planner | drei Buchungsfälle sind fachlich definiert |
| P2 | Wo findet etwas statt und wie komme ich hin? | Sportpark-/Anfahrtsseite mit Adresse, Orientierung und Parkhinweisen | WordPress-Seite | redaktionell zu pflegen; externe Karte nur kontrolliert einbinden |
| P2 | Wann ist ein Platz oder eine Halle belegt? | Platzbelegungsansicht | TuS Platzbelegung und relevante Trainings-/Eventdaten | Projekt in Discovery |
| P2 | Wo finde ich den Fanshop? | dauerhaft sichtbarer Service-Link im Header/Mobilmenü und Footer | zentrale WordPress-Service-Navigation | externer Link, nicht im Theme duplizieren |
| P2 | Wo kann ich das Jubiläumsmagazin lesen? | prominenter Magazinblock plus Magazinseite/PDF | WordPress-Medien und Magazinseite | für V1 definiert |
| P3 | Wo finde ich Satzung, Formulare und Downloads? | Service-/Downloadbereich und Footer | WordPress-Seiten und Medien | bestehende Dokumente vor Migration inventarisieren |
| P3 | Wo finde ich Gaststätte oder weitere Sportpark-Informationen? | Service-/Sportparkseite und Footer | WordPress-Seiten | redaktioneller Inhalt |
| P3 | Wo finde ich Facebook und Instagram? | Header-Service, Mobile-Menü und Footer; wenige Social-Einstiege | WordPress-Navigation | Links statt unnötiger Drittanbieter-Embeds |

#### Kontakt, Schutz und rechtliche Informationen

| Priorität | Besucherfrage | Öffentlicher Weg / Antwort | Führende Quelle | Umsetzung und Status |
|---|---|---|---|---|
| P1 | Wen muss ich mit meinem Anliegen kontaktieren? | Anliegen wählen → zuständiger Bereich → offizieller Kontaktweg | Homepage-Kontaktarchitektur und künftige Rollenpostfächer | rollenbasiert statt personenbezogen |
| P2 | Ich habe eine allgemeine Vereinsfrage | Geschäftsstelle/Kontaktseite mit schlankem Formular | WordPress plus freigegebenes Rollenpostfach oder Intake | serverseitiges Routing, keine persönliche Adresse im Template |
| P2 | Ich habe eine Presse- oder Redaktionsanfrage | klarer Redaktion-/Pressekontakt | Rollenpostfach | redaktioneller Kontaktweg |
| P2 | Ich muss einen sensiblen Schutz- oder Datenschutzfall melden | eigener geschützter Kontaktweg, nicht über allgemeine Formulare | Kinder-/Jugendschutz beziehungsweise Datenschutz | getrennte Routing- und Schutzregeln zwingend |
| P3 | Wo finde ich Impressum und Datenschutz? | jederzeit unmittelbar im Footer erreichbar | freigegebene WordPress-Seiten | darf nicht in schwer auffindbaren Akkordeons verschwinden |

### 4. Zuordnung der öffentlichen Komponenten zu ihren Systemen

| Öffentliche Komponente | Content-/Datenquelle | Funktions-/Render-Owner | Visueller Owner | Fallback |
|---|---|---|---|---|
| Header, Suche, Navigation, Footer | WordPress Navigation und Seiten | Theme / WordPress Core | Theme | Kernnavigation funktioniert ohne Fachplugin |
| Hero und Schnelleinstiege | WordPress Startseiteninhalt | Core Blocks / Theme Pattern | Theme | redaktioneller Inhalt |
| NewsCard | WordPress-Beiträge | WordPress Query / Theme | Theme | verständlicher Empty State |
| MatchCard | synchronisierte Matchdaten | Team Manager/Matchdaten-Modul | Theme-Tokens | letzter gültiger Stand oder offizieller Spielplan-Link |
| Mannschafts- und Trainingsdarstellung | Mannschafts-/Saisondaten | Team Manager | Theme-Tokens | redaktioneller Hinweis/Kontaktweg |
| EventCard / Camp | Eventdaten | Event Planner | Theme-Tokens | Link zur Veranstaltungsübersicht oder Empty State |
| Platzbelegung | Ressourcen- und Belegungsdaten | TuS Platzbelegung | Theme-Tokens | verständlicher Hinweis statt Seitenfehler |
| DepartmentCard | freigegebene Abteilungsseiten | Homepage Components / WordPress | Theme-Tokens | manuell kuratierte WordPress-Auswahl |
| Magazinblock | Magazinseite, Cover und PDF | WordPress Core / Pattern | Theme | Magazinseite ohne eingebetteten Viewer |
| Kennzahlen | zentrale Homepage-Konfiguration | Homepage Components | Theme-Tokens | Block ausblenden, wenn Werte nicht freigegeben sind |
| PartnerLogo / PartnerCard | Partnerdatenquelle | Partnerkomponente; Übergang kontrolliert redaktionell | Theme-Tokens | kuratierte WordPress-Auswahl |
| Partner-Fit-Check | öffentliches Anfrageobjekt | Partnerportal-Adapter/Intake | Theme-Tokens | offizieller Partnerschaftskontakt |
| Schiedsrichter werden | redaktionelle Seite und Sportkontakt | WordPress Core / Kontakt-Routing | Theme | offizieller allgemeiner Sportkontakt |
| Kontaktwahl | Anliegen- und Rollenrouting | WordPress/Intake-Komponente | Theme-Tokens | Geschäftsstelle als kontrollierter allgemeiner Kontakt |

### 5. Verbindliche Navigationszuordnung

Die bereits beschlossene Hauptnavigation bleibt:

- Aktuelles
- Fußball
- Abteilungen
- Verein
- Mitmachen
- Partner
- Service

Mindestens folgende Unterwege müssen darin klar auffindbar sein:

#### Mitmachen

- Probetraining
- Jugend & Eltern
- Mitglied werden
- Schiedsrichter werden
- Trainer/Betreuer werden
- Helfen und Ehrenamt

#### Partner

- Unsere Partner
- Partner werden
- Partnerprojekte und -stories, sobald freigegeben
- später Zugang Partner Hub

#### Service

- Kontakt
- Anfahrt / Sportpark
- Veranstaltungen
- Platzbelegung
- Downloads
- Shop
- Jubiläumsmagazin
- Impressum
- Datenschutz

Auf Mobile und Tablet erscheinen dieselben fachlichen Wege im rechten Drawer. Es gibt keine inhaltlich reduzierte Mobile-Navigation, die wichtige Nutzerziele versteckt.

### 6. Startseitenanforderungen aus der Funktionslandkarte

Die Startseite benötigt in V1 weiterhin:

1. Header und Suche
2. Hero
3. nächste Spiele
4. zielorientierte Schnelleinstiege
5. aktuelle Nachrichten
6. Jubiläumsmagazin
7. Abteilungen
8. Veranstaltungen
9. Verein und Kennzahlen
10. **kuratierte Sichtbarkeit unserer Partner**
11. Social Media
12. Service und Footer

Zusätzlich wird verbindlich ergänzt:

- **Schiedsrichter werden** muss von der Startseite beziehungsweise dem Bereich Mitmachen kontextbezogen direkt erreichbar sein.
- **Unsere Partner** und **Partner werden** sind zwei unterschiedliche Aktionen innerhalb des Partnerbereichs.
- Eine Partnerdarstellung nur im Footer erfüllt die Anforderung nicht.
- Die Startseite muss auch dann vollständig nutzbar bleiben, wenn Match-, Event-, Partner- oder Platzdaten noch nicht angebunden oder vorübergehend nicht verfügbar sind.

Die genaue visuelle Einordnung von Schiedsrichter werden innerhalb der bestehenden Schnelleinstiege wird im nächsten UI-Abgleich entschieden, ohne den Nutzerweg erneut grundsätzlich zu öffnen.

### 7. V1-Umsetzungsgrenze

Das erste Theme-Inkrement darf bereits bereitstellen:

- vollständige responsive Seitenstruktur,
- Header, Suche, Navigation und Footer,
- Hero und redaktionelle Startseitenbereiche,
- WordPress-Beiträge, Seiten, Magazin und Service-Links,
- visuelle Komponenten und definierte Empty-/Fallback-Zustände,
- stabile Slots beziehungsweise Block-Schnittstellen für Fachplugins.

Es wartet nicht auf die vollständige Umsetzung aller Fachplugins.

Dynamisch angeschlossen werden anschließend:

- Matchdaten und Mannschaften,
- Veranstaltungen,
- Platzbelegung,
- Partnerdaten und Partner-Intake,
- weitere fachliche Ansichten.

Bis zur jeweiligen Integration werden keine parallelen Theme-Datenbanken oder manuell duplizierten Fachlisten aufgebaut.

### 8. Erkannte offene Arbeitsaufgaben

Diese Punkte sind keine offenen Grundsatzfragen zur Homepage, müssen aber vor dem jeweiligen Release erledigt werden:

1. Für Schiedsrichter werden fachlichen Content-Owner, rollenbasierten Kontaktweg und aktuelle Verbandsinformationen bestätigen.
2. Den realen Probetraining-/Jugend-Anfrageweg und das Formularrouting festlegen.
3. Den aktuellen Mitgliedschaftsprozess und seine Formulare vor Migration prüfen.
4. Für den Partnerblock die Übergangsquelle und die kuratierte Startauswahl festlegen, bis eine gemeinsame Partnerdatenquelle bereitsteht.
5. Partner-Intake-Schnittstelle und CRM-Write-back vor produktivem Fit-Check entscheiden.
6. Reale Shop-, Magazin-/PDF- und relevante Service-URLs eintragen.
7. Bestehende Seiten, Downloads, Shortcodes, Widgets und Weiterleitungsbedarf inventarisieren.
8. Fachplugin-Blöcke mit ihren Empty-, Fehler- und Veraltet-Zuständen definieren und testen.

### 9. Abnahmekriterien der Nutzerführung

Die Funktionslandkarte ist bei der Umsetzung erfüllt, wenn:

- jedes P1-Anliegen direkt oder über einen eindeutig benannten Haupteinstieg erreichbar ist,
- jedes P2-Anliegen höchstens zwei verständliche Schritte benötigt,
- Nutzer keine interne Vorstands-, Abteilungs- oder Pluginstruktur kennen müssen,
- Desktop, Tablet und Smartphone dieselben fachlich wichtigen Wege anbieten,
- Suche und Navigation deutsche, verständliche Begriffe verwenden,
- jede dynamische Komponente eine führende Quelle und einen Fallback besitzt,
- Kontaktdaten rollenbasiert und datensparsam ausgegeben werden,
- Partner sichtbar gewürdigt werden und interessierte Unternehmen einen separaten Akquiseweg erhalten,
- Schiedsrichter werden als eigener Nutzerweg auffindbar ist,
- Inhalte nicht mehrfach manuell gepflegt werden müssen,
- ausgefallene Fachmodule die restliche Startseite nicht blockieren.

## Relationship to other documents

- README.md
- PROJECT-STATE.md
- ARCHITECTURE.md
- CONTENT-MODEL.md
- FUSSBALL-DE-INTEGRATION.md
- ../../design/homepage-standard.md
- ../../design/homepage-contact-architecture.md
- ../../design/ui-standard.md
- ../team-manager/FUNCTIONAL-SCOPE.md
- ../team-manager/MATCH-DATA-MODULE.md
- ../event-planner/FUNCTIONAL-SCOPE.md
- ../platzbelegung/README.md
- ../partner-portal/PUBLIC-PARTNER-ENTRY.md
- ../partner-hub/FUNCTIONAL-SCOPE.md
- ../member-engagement/FUNCTIONAL-SCOPE.md
- ../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md
- ../../decisions/ADR-0012-team-manager-match-data-module.md

## Future Development

Nach der fachlichen Prüfung dieser Landkarte werden:

1. die bestätigten Nutzerwege in Homepage-Standard, Navigation und UI-Mockup gespiegelt,
2. offene Inhalte und Kontaktwege mit fachlichen Ownern vervollständigt,
3. Theme- und Fachplugin-Arbeit in kleine umsetzbare Inkremente zerlegt,
4. reale Nutzung und Suchanfragen später gegen die Prioritätsstufen geprüft,
5. neue häufige Anliegen nur ergänzt, wenn sie eine klare Antwort, Quelle und Zuständigkeit besitzen.
