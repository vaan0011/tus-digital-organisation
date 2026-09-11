# Sponsoring Current State

Stand: 2026-09-11

## Purpose

Dieses Dokument ist der kompakte Einstiegspunkt für den aktuellen Arbeitsstand des Verantwortungsbereichs Sponsoring / Partnerships.

Es verweist auf die maßgeblichen fachlichen Detaildokumente und verhindert, dass ein neuer Chat den Stand aus älteren Gesprächsverläufen rekonstruieren muss.

## Core Principle

Der Chat darf wechseln. Der fachliche Stand bleibt erhalten.

## Main Content

### 1. Strategische Basis

Status: `etabliert`

Leitidee:

> **Aus Sponsoren werden Partner.**

Die ausführliche fachliche Grundlage liegt in:

- `README.md`

Dort sind unter anderem dokumentiert:

- aktuelle Ausgangslage,
- reale Datenquellen,
- sieben Partnerwelten,
- Media & Reichweite,
- Partnererlebnis,
- Partner Journey,
- Kampagnen,
- Projektprioritäten,
- LED Media Screen,
- Steuer- und Vereinsstruktur,
- Arbeitsprinzip gegen Dokumentationswachstum.

Diese Inhalte werden nicht in parallelen Strategiedokumenten dupliziert.

### 2. Verbindliche Produktabgrenzung: öffentlich / Partnerportal / Partner Hub

Status: `entschieden`

Die bisherige Überschneidung zwischen Partnerportal und Partner Hub ist aufgelöst.

Die verbindliche Logik lautet:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

#### Öffentliche Partnerseite

Zweck:

- neue Unternehmen ansprechen,
- Unternehmensziele abfragen,
- strukturierte Partnerschaftsanfragen erzeugen,
- Anfrage direkt in die interne Partnerarbeit überführen.

#### Internes Partnerportal

Zweck:

- Interessenten und Zielunternehmen,
- Partner Journey,
- Aufgaben und Wiedervorlagen,
- Partnerziele,
- Partnerprodukte und Assets,
- Historie,
- Kampagnenplanung,
- interne Partnerarbeit und Auswertung.

Aktueller Projektstand:

- `../../projects/partner-portal/PROJECT-STATE.md`
- `../../projects/partner-portal/README.md`

#### Partner Hub

Zweck:

- partnerseitige Oberfläche für bestehende Partner,
- Partnerschaft und Ziele verständlich darstellen,
- vereinbarte und noch nutzbare Leistungen sichtbar machen,
- Verwendung und Wirkung zeigen,
- Jobs und Angebote einbringen,
- Einladungen beantworten,
- Inhalte nutzen,
- Projekte, Kampagnen und Netzwerk zugänglich machen,
- jährlichen Partner-Check-in unterstützen.

Aktueller Projektstand:

- `../../projects/partner-hub/PROJECT-STATE.md`
- `../../projects/partner-hub/FUNCTIONAL-SCOPE.md`

Die Abgrenzung ist langfristig in `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md` dokumentiert.

### 3. Gemeinsame Datenbasis

Status: `Prinzip beschlossen / technische Ausgestaltung offen`

Partnerportal und Partner Hub sind keine getrennten Datenwelten.

Für gemeinsam genutzte Informationen gilt eine fachliche Quelle der Wahrheit.

Insbesondere sollen Partner, Ansprechpartner, Partnerschaft, Partnerziele, vereinbarte Leistungen, Veranstaltungen, Projekte, Kampagnen, Jobs und Angebote nicht unabhängig in mehreren Modulen gepflegt werden.

Beispiele:

- Event Planner ist fachliche Quelle eines Events; Partnerportal und Partner Hub referenzieren es.
- Ein im Partner Hub erfasster und vom TuS freigegebener Job kann auf der Homepage erscheinen, ohne erneut angelegt zu werden.
- Partnerziele und Leistungen werden zentral geführt und je Oberfläche nur passend dargestellt.

Die konkrete technische Datenarchitektur ist noch offen.

### 4. Ergänzte Kernlogik des Partner Hubs

Status: `fachlich beschlossen`

Zusätzlich zum bisherigen Scope sind drei Punkte verbindlich ergänzt:

1. **Partnerziele**  
   Wenige priorisierte Unternehmensziele bilden den Orientierungsrahmen für relevante Projekte, Kampagnen und Aktivierungen.

2. **Nutzungs-/Erfüllungsstatus von Leistungen**  
   Partner sollen erkennen können, welche vereinbarten Leistungen bereits genutzt/erfüllt wurden und welche noch offen sind.

3. **Jährlicher Partner-Check-in**  
   Ein kurzer strukturierter Austausch verbindet Wirkung, neue Unternehmensziele, Weiterentwicklung und Verlängerung.

Diese Funktionen bleiben bewusst einfach und erzeugen keine zweite Buchhaltung oder komplexe Leistungsverwaltung.

### 5. Operative Sponsoring-Datengrundlage

Status: `Arbeitsstand`

Bekannte Quellen sind insbesondere:

- aktuelle Sponsorenliste des Finanzvorstands,
- historische Bandenwerbung 2005–2026 mit bekannter Lücke 2007,
- historische Plakatwerbung,
- historische Werbung im Stadionheft,
- aktuelle visuelle Inventur der bestehenden Werbe- und Partnerflächen im Sportpark.

Leistungen, Laufzeiten, Gegenleistungen und Einnahmen je aktuellem Sponsor sollen noch ergänzt bzw. konsolidiert werden.

Vertrauliche Einzelinformationen bleiben außerhalb des öffentlichen Repositorys.

### 6. Operative Partnersteuerung und Runtime

Status: `native CRM-Source-of-Truth vorhanden / Runtime bereit`

Die verbindliche geschützte operative Source of Truth ist das native Google Sheet:

- `TuS Partner CRM – Operative Source of Truth`
- operativer Tab: `Partner-CRM`

Der Tab enthält aktuell die Felder:

- CRM-ID,
- Partner / Lead,
- Segment,
- Owner,
- Status,
- letzter Kontakt,
- nächster Schritt,
- Zieldatum,
- Potenzial min/max,
- Partnerwelt,
- Priorität,
- Projekt / Kampagne,
- Quelle / Referenz,
- Notiz.

Initial wurden die sechs operativen CRM-Einträge aus dem älteren V1-Arbeitsstand übernommen. Zusätzlich wurde `SPORTINN / Joma` als projektbezogene Chance für `Trainingskleidung Ausstattungsgrundstock` aufgenommen. Damit existiert erstmals eine zuverlässig beschreibbare operative Queue, die eine Partnership-Runtime verwenden und fortschreiben kann.

Das ältere:

- `TuS_Partner_System_V1.xlsx`

bleibt als historische Arbeitsreferenz erhalten. Es enthält weiterhin wertvolle ältere Kataloge und Arbeitsstände, ist aber **nicht mehr die operative CRM-Wahrheit** und darf neuere GitHub-Entscheidungen oder den nativen CRM-Stand nicht überschreiben.

Für operative Partnerarbeit gilt damit:

- strategische und projektbezogene Wahrheit → aktuelle GitHub-Sources-of-Truth,
- Kontaktstatus, Wiedervorlagen und operative Lead-Arbeit → natives Partner-CRM,
- vertrauliche Partnerdaten → ausschließlich geschützte operative Quellen,
- alte V1-Inhalte → nur als Kontext oder Migrationsquelle,
- Runtime-Logik → `../../roles/partnership-manager/runtime.md`.

Die etwa 50 Bestandspartner sind noch nicht vollständig einzeln in das native CRM migriert. `CRM001` bildet dafür bewusst den offenen Konsolidierungsauftrag ab.

Die Runtime darf interne Recherche, Priorisierung, Entwürfe, Datenpflege und Handoffs selbstständig ausführen. Externe Partnerkontakte, verbindliche Angebote, Preis-/Exklusivitätszusagen und Verträge bleiben freigabepflichtig.

Zweiter operativer Drive-Stand:

- `Werbeflaechen-Inventar Sportpark 2026`

Dieses native Google Sheet ist die operative Quelle für die aktuelle physische Werbeflächen-Inventur.

### 7. Visuelle Werbeflächen-Inventur

Status: `Ist-Bestand fotografisch erfasst / Partner- und Vertragsabgleich offen`

Für die physische Bestandsaufnahme liegen 44 aktuelle reale Fotos des Sportparks vor. Sie sind im geschützten Google Drive nach Bandenwerbung, Bannerwerbung, Zaunanlage und Sportpark-Übersichten geordnet. Eine vorhandene LED-Konzeptvisualisierung wird bewusst getrennt von den Ist-Fotos geführt.

Die wesentlichen Erkenntnisse sind:

- die klassische lange Bandenlinie ist bereits stark belegt und soll eher gepflegt und standardisiert als weiter verdichtet werden,
- die Hauptseite am Zuschauerbereich besitzt Premium-Potenzial,
- hohe Zaun- und Bannerbereiche verfügen über relevante Restkapazität und sollten mit wenigen größeren Standardformaten statt eines Bannerteppichs entwickelt werden,
- Parkplatz- und Außenzäune eignen sich besonders für Recruiting, Veranstaltungen und zeitlich begrenzte Kampagnen,
- Eingang, Treppen und Steinwand sind zuerst Identitätsflächen und keine beliebigen Werbeflächen,
- der Festplatz besitzt als Partner-Experience-, Event- und Hospitality-Asset einen höheren strategischen Wert als als reine statische Werbefläche.

Die fachliche Ableitung liegt in:

- `WERBEFLAECHEN-INVENTUR.md`

Operative Quelle im geschützten Drive ist das Arbeitsblatt `Werbeflaechen-Inventar Sportpark 2026` mit Flächen, Sichtbarkeit, Potenzial, Fotoquellen und nächsten Schritten.

Vor neuen Preisen und Standardformaten wird diese Flächeninventur mit aktuellem Partnerbestand, Vertrags-/Verlängerungsstatus und bestehender Preislogik verbunden.

### 8. Steuer- und Vereinsstruktur

Status: `Ist-Analyse offen`

Es bestehen:

1. TuS 1901 Mingolsheim e.V.
2. Förderverein
3. Jugendförderverein

Die endgültige steuerliche Soll-Struktur ist noch nicht beschlossen.

Für die Ist-Analyse werden insbesondere Unterlagen zu Satzungen, Steuerbescheiden, EÜR/Jahresabschlüssen, Einnahmen-/Ausgabenarten, Umsatzsteuer, Geldflüssen zwischen den Vereinen, Rücklagen und bisheriger Werbezuordnung benötigt.

Wichtige Prüfthemen bleiben unter anderem:

- wirtschaftlicher Geschäftsbetrieb,
- § 64 AO,
- mögliche Gewinnpauschale für geeignete Werbung,
- Vorsteuerabzug,
- Projekt- und freie Rücklagen,
- sachliche Zuständigkeit der drei Vereine.

### 9. LED Media Screen

Status: `strategisch weit entwickelt / Umsetzung offen`

Der LED Media Screen ist ein zentrales Asset im Sponsoring-Konzept.

Bisherige Kerngedanken:

- drehbare Nutzung für unterschiedliche Bereiche des Sportparks,
- Spieltags-, Vereins-, Event-, Recruiting- und Partnerkommunikation,
- Finanzierung über Gründungspartner als entwickeltes Modell,
- dauerhafter Gründungsstatus getrennt von zeitlich begrenzten Werberechten,
- Partneraktivierung nach dem Prinzip `Momente statt Werbesekunden`,
- wiederverwendbare Partnerrollen wie Tor-, Ecken-, Hydration-, Gesundheits-, Wechsel-, Starting-XI-, Added-Time- und MVP-Partner.

Die zentrale fachliche Quelle für diese Partnerrollen ist:

- `MOMENT-PARTNER-MODELLE.md`

Dort ist die Systematik `Founding Partner → Partnerrolle → Aktivierung` mit einem größeren Baukasten an Matchday-, Themen- und Eventrollen dokumentiert.

Vor verbindlichen Entscheidungen werden Angebot, Technik, Finanzierung, Steuer-/Vereinszuordnung und Genehmigungen aktuell geprüft.

### 10. Nächste sinnvolle Arbeitsschwerpunkte

1. etwa 50 aktuelle Bestandspartner aus der Finanzvorstands-/Sponsorendatei einzeln in das native CRM konsolidieren und Dubletten vermeiden,
2. aktuelle Leistungen, Laufzeiten, Gegenleistungen und Einnahmen der Bestandspartner ergänzen,
3. aktive `A`-Leads und projektbezogene Partnerchancen über die Runtime reproduzierbar weiterbearbeiten,
4. historische Sponsorendaten normalisieren und mit den aktuellen Partnern verbinden,
5. Werbeflächen-Inventur mit Partnerbestand, Vertragsstatus und bestehender Preislogik verbinden,
6. steuerliche Ist-Struktur der drei Vereine anhand realer Unterlagen rekonstruieren,
7. gemeinsam mit der technischen Konzeption die spätere Übernahme der operativen CRM-Verantwortung durch das interne Partnerportal definieren,
8. Partnerportal und Partner Hub jeweils auf einen kleinen MVP begrenzen,
9. für reale LED-Akquisegespräche zunächst wenige starke Moment-Partner-Rollen testen und erst danach Preise bzw. Standardpakete verfestigen.

### 11. GitHub-Pflicht

Nach relevanter Arbeit bleibt das Ergebnis nicht nur im Chat.

Je nach Inhalt werden aktualisiert:

- `knowledge/sponsoring/README.md`,
- dieses Dokument,
- `MOMENT-PARTNER-MODELLE.md`,
- relevante Projektzustände,
- ADRs bei langfristigen Grundsatzentscheidungen,
- betroffene Rollen oder Standards.

Operative Partnerstände werden dagegen im geschützten nativen CRM gepflegt und nicht nach GitHub dupliziert.

## Relationship to other documents

- `README.md`
- `WERBEFLAECHEN-INVENTUR.md`
- `MOMENT-PARTNER-MODELLE.md`
- `../../roles/partnership-manager/role.md`
- `../../roles/partnership-manager/partnership-standard.md`
- `../../roles/partnership-manager/runtime.md`
- `../../roles/partnership-manager/START-PROMPT.md`
- `../../projects/partner-portal/README.md`
- `../../projects/partner-portal/PROJECT-STATE.md`
- `../../projects/partner-hub/FUNCTIONAL-SCOPE.md`
- `../../projects/partner-hub/PROJECT-STATE.md`
- `../../projects/led-media-screen/PROJECT-STATE.md`
- `../../projects/trainingskleidung-ausstattungsgrundstock/PROJECT-STATE.md`
- `../../decisions/ADR-0005-partnership-manager-and-sponsoring-memory.md`
- `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md`

## Future Development

Der nächste Reifegewinn liegt nicht in einem weiteren Sponsoring-Dokument, sondern in realer Nutzung der operativen Queue: Bestandspartner importieren, Wiedervorlagen pflegen, Projektchancen qualifizieren und Erfahrungen aus echten Partnergesprächen in die bestehende Struktur zurückschreiben.

Langfristig kann das interne Partnerportal die CRM-Verantwortung übernehmen. Bis dahin bleibt das native Google Sheet die einzige operative Partner-CRM-Source-of-Truth.
