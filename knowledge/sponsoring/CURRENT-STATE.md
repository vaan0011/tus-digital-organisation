# Sponsoring Current State

Stand: 2026-09-10

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

### 6. Operative Partnersteuerung und Runtime-Reife

Status: `operative Struktur vorhanden / Runtime noch nicht aktivieren`

Im geschützten Google Drive existiert der Arbeitsstand:

- `TuS_Partner_System_V1.xlsx`

Die Datei enthält bereits strukturierte Arbeitsbereiche für:

- Asset-Katalog,
- Partnerprodukt-Katalog,
- Projektportfolio für Finanzierungs-/Partnerideen,
- Partner & Leads,
- Eventportfolio,
- Pricing & Wertanker,
- Steuer- & Vereinsmatrix,
- Partner-CRM,
- Ideen-Parkplatz.

Der Tab `08 – Partner-CRM` enthält bereits die für operative Partnerarbeit sinnvollen Felder:

- Partner / Lead,
- Segment,
- Owner,
- Status,
- letzter Kontakt,
- nächster Schritt,
- Zieldatum,
- Potenzial,
- Partnerwelt,
- Priorität,
- Notiz.

Damit ist eine fachlich brauchbare Queue-Struktur grundsätzlich vorhanden. Der bestehende V1-Arbeitsstand ist jedoch älter als mehrere inzwischen in GitHub getroffene Sponsoring-, Projekt- und Architekturentscheidungen und die Bestandspartner sind noch nicht vollständig einzeln importiert.

Deshalb gilt:

- strategische und projektbezogene Wahrheit wird vor Nutzung mit dem aktuellen GitHub-Stand reconciliiert,
- vertrauliche operative Partnerdaten werden nicht nach GitHub kopiert,
- das V1-Excel wird nicht stillschweigend zur neuen zentralen Wahrheit erklärt,
- eine wiederkehrende Partnership-Runtime wird erst aktiviert, wenn die operative Partner-/CRM-Quelle als geschützte, zuverlässig beschreibbare Source of Truth festgelegt ist.

Als bevorzugte einfache Zwischenlösung ist zu prüfen, ob der operative CRM-Teil in ein geschütztes natives Google Sheet überführt wird. Langfristig kann das interne Partnerportal diese operative Quelle übernehmen. Es wird keine zusätzliche CRM-Datenwelt nur für eine Automation angelegt.

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

1. operative CRM-Quelle festlegen und den bestehenden V1-CRM-Stand gegen den aktuellen GitHub-Stand reconciliieren,
2. aktuelle Leistungen, Laufzeiten, Gegenleistungen und Einnahmen der Bestandspartner konsolidieren,
3. historische Sponsorendaten normalisieren und Dubletten erkennen,
4. Werbeflächen-Inventur mit Partnerbestand, Vertragsstatus und bestehender Preislogik verbinden,
5. steuerliche Ist-Struktur der drei Vereine anhand realer Unterlagen rekonstruieren,
6. gemeinsam mit der technischen Konzeption die zentrale Partnerdatenbasis und Objektverantwortung definieren,
7. Partnerportal und Partner Hub jeweils auf einen kleinen MVP begrenzen,
8. für reale LED-Akquisegespräche zunächst wenige starke Moment-Partner-Rollen testen und erst danach Preise bzw. Standardpakete verfestigen.

### 11. GitHub-Pflicht

Nach relevanter Arbeit bleibt das Ergebnis nicht nur im Chat.

Je nach Inhalt werden aktualisiert:

- `knowledge/sponsoring/README.md`,
- dieses Dokument,
- `MOMENT-PARTNER-MODELLE.md`,
- relevante Projektzustände,
- ADRs bei langfristigen Grundsatzentscheidungen,
- betroffene Rollen oder Standards.

## Relationship to other documents

- `README.md`
- `WERBEFLAECHEN-INVENTUR.md`
- `MOMENT-PARTNER-MODELLE.md`
- `../../roles/partnership-manager/role.md`
- `../../roles/partnership-manager/partnership-standard.md`
- `../../roles/partnership-manager/START-PROMPT.md`
- `../../projects/partner-portal/README.md`
- `../../projects/partner-portal/PROJECT-STATE.md`
- `../../projects/partner-hub/FUNCTIONAL-SCOPE.md`
- `../../projects/partner-hub/PROJECT-STATE.md`
- `../../projects/led-media-screen/PROJECT-STATE.md`
- `../../decisions/ADR-0005-partnership-manager-and-sponsoring-memory.md`
- `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md`

## Future Development

Dieser Checkpoint bleibt bewusst kurz. Detailwissen wird in den bestehenden fachlichen Quellen gepflegt und hier nur als aktueller Arbeitsstand verknüpft.

Sobald die operative CRM-Quelle verbindlich festgelegt und zuverlässig beschreibbar ist, kann für den Partnership Manager eine wiederkehrende Runtime mit Wiedervorlagen, Partner-Check-ins, Kampagnen- und Projektchancen ergänzt werden.