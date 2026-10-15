# Sponsoring Current State

Stand: 2026-09-11

## Purpose

Dieses Dokument ist der kompakte Einstiegspunkt für den aktuellen Arbeitsstand des Verantwortungsbereichs Sponsoring / Partnerships.

Es verweist auf die maßgeblichen fachlichen und operativen Sources of Truth und verhindert, dass ein neuer Chat den Stand aus älteren Gesprächsverläufen rekonstruieren muss.

## Core Principle

> **Der Chat darf wechseln. Der fachliche Stand und die operative Partnerarbeit bleiben erhalten.**

## Main Content

### 1. Strategische Basis

Status: `etabliert`

Leitidee:

> **Aus Sponsoren werden Partner.**

Grundlogik:

> **Unternehmensziel → passende Partnerwelt → Aktivierung → Reichweite → Partnererlebnis → Wirkung**

Die ausführliche fachliche Grundlage liegt in `README.md`.

Dort bleiben insbesondere verankert:

- sieben Partnerwelten,
- Media & Reichweite,
- Partnererlebnis,
- Partner Journey,
- Kampagnen,
- Projektprioritäten,
- LED Media Screen,
- Steuer- und Vereinsstruktur.

### 2. Verbindliche Produktabgrenzung

Status: `entschieden`

Die Grundlogik lautet:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

#### Öffentliche Partnerseite / Homepage

Die künftige TuS-Homepage erhält einen klar sichtbaren Einstieg `Partner werden`.

Verbindlich ist inzwischen:

- Einstieg über das Unternehmensziel statt über Werbepakete,
- Leitfrage **„Was möchten Sie mit einer Partnerschaft erreichen?“**,
- kurzer mobiler Partner-Fit-Check,
- strukturierte Anfrage statt isolierter E-Mail,
- Übergabe in die interne Partnerarbeit,
- keine automatische Preis-, Leistungs- oder Vertragszusage.

Fachliche Akquise- und Betreuungsschicht:

- `PARTNER-AKQUISE-UND-BETREUUNG.md`

Fachliche und technische Spezifikation für Homepage / WordPress Developer:

- `../../projects/partner-portal/PUBLIC-PARTNER-ENTRY.md`

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
- Ziele und Partnerschaft verständlich darstellen,
- vereinbarte und noch nutzbare Leistungen sichtbar machen,
- Wirkung zeigen,
- Jobs, Angebote, Einladungen und Inhalte nutzbar machen,
- Projekte, Kampagnen und Netzwerk zugänglich machen,
- jährlichen Partner-Check-in unterstützen.

Aktueller Projektstand:

- `../../projects/partner-hub/PROJECT-STATE.md`
- `../../projects/partner-hub/FUNCTIONAL-SCOPE.md`

Die Produktabgrenzung ist langfristig in `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md` dokumentiert.

### 3. Neue Akquise- und Betreuungsschicht

Status: `fachlich beschlossen / Umsetzung offen`

Am 11.09.2026 wurde die öffentliche Arbeit von Bedani Marketing als externe Inspiration geprüft.

Übernommen werden nicht deren Pakete oder Preise, sondern fünf nützliche Muster:

1. klarer öffentlicher Einstieg für Unternehmen,
2. strukturierter Sponsoring-/Partnerkontakt,
3. professionelle kompakte Vertriebsunterlagen,
4. Partnerstories und Wirkung statt reiner Leistungslisten,
5. planbarer Jahreszyklus für Bestandspartner.

Bedani bleibt externe Inspiration, nicht Source of Truth.

Für den TuS sind vorgesehen:

- Homepage-CTA `Partner werden`,
- Partner-Fit-Check,
- TuS Partner-One-Pager,
- kompakte Partner-Präsentation,
- reale freigegebene Partnerstories,
- minimaler Partner-Jahreszyklus von Zielklärung über Aktivierung und Wirkung bis Check-in / Verlängerung.

Details: `PARTNER-AKQUISE-UND-BETREUUNG.md`.

### 4. Gemeinsame Datenbasis

Status: `Prinzip beschlossen / technische Ausgestaltung teilweise offen`

Partnerportal, Partner Hub und öffentliche Homepage-Anfrage sind keine getrennten Datenwelten.

Für gemeinsam genutzte Informationen gilt eine fachliche Quelle der Wahrheit.

Insbesondere sollen Partner, Ansprechpartner, Partnerschaft, Partnerziele, Leistungen, Events, Projekte, Kampagnen, Jobs und Angebote nicht unabhängig in mehreren Modulen gepflegt werden.

Für die öffentliche Homepage gilt zusätzlich:

> **Keine dauerhafte harte Kopplung an konkrete Google-Sheet-Spalten.**

Der WordPress Developer plant eine austauschbare serverseitige Intake-Grenze. Die konkrete technische Variante wird vor Umsetzung gegen Architecture Checklist und Stability & Simplicity geprüft.

### 5. Operative Partnersteuerung und Runtime

Status: `native CRM-Source-of-Truth vorhanden / Runtime aktiv`

Verbindliche geschützte operative Source of Truth:

- `TuS Partner CRM – Operative Source of Truth`
- Tab `Partner-CRM`

Dort liegen insbesondere:

- Partner / Lead,
- Owner,
- Status,
- letzter Kontakt,
- nächster Schritt,
- Zieldatum,
- Potenzial,
- Partnerwelt,
- Priorität,
- Projekt / Kampagne,
- Quelle / Referenz,
- Notiz.

Das ältere `TuS_Partner_System_V1.xlsx` ist nur noch historische Arbeitsreferenz.

Die etwa 50 Bestandspartner sind noch nicht vollständig einzeln migriert. `CRM001` bildet den offenen Konsolidierungsauftrag ab.

Aktuelle projektbezogene Chance unter anderem:

- `SPORTINN / Joma` für `Trainingskleidung Ausstattungsgrundstock`.

Runtime-Logik:

- `../../roles/partnership-manager/runtime.md`

Externe Kontaktaufnahme, verbindliche Angebote, Preise, Exklusivität und Verträge bleiben freigabepflichtig.

### 6. Visuelle Werbeflächen-Inventur

Status: `Ist-Bestand fotografisch erfasst / Partner- und Vertragsabgleich offen`

Operative Quelle:

- `Werbeflaechen-Inventar Sportpark 2026`

Fachliche Ableitung:

- `WERBEFLAECHEN-INVENTUR.md`

Wesentliche Erkenntnisse:

- klassische lange Bandenlinie bereits stark belegt,
- Hauptseite am Zuschauerbereich besitzt Premium-Potenzial,
- Zaun-/Bannerbereiche besitzen Restkapazität,
- Parkplatz-/Außenzäune passen besonders zu Recruiting und Kampagnen,
- Eingang und Identitätsflächen nicht beliebig vermarkten,
- Festplatz besitzt hohen Wert für Events, Hospitality und Partner Experience.

### 7. Partner Hub – ergänzte Kernlogik

Status: `fachlich beschlossen`

Verbindlich ergänzt:

- wenige priorisierte Partnerziele,
- Nutzungs-/Erfüllungsstatus vereinbarter Leistungen,
- jährlicher Partner-Check-in.

Der Check-in ist jetzt zusätzlich in den gesamten Partner-Jahreszyklus eingebettet; Details siehe `PARTNER-AKQUISE-UND-BETREUUNG.md`.

### 8. Steuer- und Vereinsstruktur

Status: `Ist-Analyse offen`

Es bestehen:

1. TuS 1901 Mingolsheim e.V.
2. Förderverein
3. Jugendförderverein

Die endgültige steuerliche Soll-Struktur ist noch nicht beschlossen.

Zu prüfen bleiben insbesondere:

- wirtschaftlicher Geschäftsbetrieb,
- § 64 AO,
- mögliche Gewinnpauschale für geeignete Werbung,
- Vorsteuerabzug,
- Projekt- und freie Rücklagen,
- sachliche Zuständigkeit der drei Vereine.

### 9. LED Media Screen

Status: `strategisch weit entwickelt / Umsetzung offen`

Der LED Media Screen bleibt ein zentrales Partner- und Kommunikationsasset.

Fachliche Quelle für die Aktivierungslogik:

- `MOMENT-PARTNER-MODELLE.md`

Grundprinzip:

> **Momente statt Werbesekunden.**

Vor verbindlicher Umsetzung werden Angebot, Technik, Finanzierung, Steuer-/Vereinszuordnung und Genehmigungen aktuell geprüft.

### 10. Nächste sinnvolle Arbeitsschwerpunkte

1. aktuelle Bestandspartner in das native CRM konsolidieren,
2. Leistungen, Laufzeiten, Gegenleistungen und Einnahmen ergänzen,
3. aktive A-Leads und projektbezogene Partnerchancen über die Runtime weiterbearbeiten,
4. **TuS Partner-One-Pager und kompakte Partner-Präsentation erstellen**, 
5. **Homepage-Einstieg `Partner werden` fachlich/visuell prototypisieren**, 
6. technische Intake-Schnittstelle zwischen Homepage und operativer Partnerarbeit festlegen,
7. Partner-Jahreszyklus an ersten realen Bestandspartnern testen,
8. historische Sponsorendaten normalisieren,
9. Werbeflächen-Inventur mit Partnerbestand und Vertragsstatus verbinden,
10. steuerliche Ist-Struktur rekonstruieren,
11. Partnerportal und Partner Hub jeweils auf einen kleinen MVP begrenzen.

### 11. GitHub-Pflicht

Nach relevanter Arbeit bleibt das Ergebnis nicht nur im Chat.

Je nach Inhalt werden aktualisiert:

- `README.md`,
- dieses Dokument,
- `PARTNER-AKQUISE-UND-BETREUUNG.md`,
- `WERBEFLAECHEN-INVENTUR.md`,
- `MOMENT-PARTNER-MODELLE.md`,
- relevante Projektzustände,
- ADRs bei langfristigen Grundsatzentscheidungen.

Operative Partnerstände bleiben dagegen im geschützten nativen CRM.

## Relationship to other documents

- `README.md`
- `PARTNER-AKQUISE-UND-BETREUUNG.md`
- `WERBEFLAECHEN-INVENTUR.md`
- `MOMENT-PARTNER-MODELLE.md`
- `../../roles/partnership-manager/role.md`
- `../../roles/partnership-manager/partnership-standard.md`
- `../../roles/partnership-manager/runtime.md`
- `../../roles/partnership-manager/START-PROMPT.md`
- `../../projects/partner-portal/README.md`
- `../../projects/partner-portal/PROJECT-STATE.md`
- `../../projects/partner-portal/PUBLIC-PARTNER-ENTRY.md`
- `../../projects/partner-hub/FUNCTIONAL-SCOPE.md`
- `../../projects/partner-hub/PROJECT-STATE.md`
- `../../projects/led-media-screen/PROJECT-STATE.md`
- `../../projects/trainingskleidung-ausstattungsgrundstock/PROJECT-STATE.md`
- `../../decisions/ADR-0005-partnership-manager-and-sponsoring-memory.md`
- `../../decisions/ADR-0008-partnerportal-und-partner-hub-abgrenzung.md`

## Future Development

Der nächste Reifegewinn kommt jetzt aus realer Anwendung: Homepage-Einstieg prototypisieren, Vertriebsunterlagen schaffen, Bestandspartner sauber führen und die Partner-Journey mit echten Gesprächen und Aktivierungen testen.

Neue Dokumentation wird nur ergänzt, wenn sie wiederkehrende Arbeit tatsächlich verbessert.
### Update 12.10.2026 – Partnerkonzept 2.0 in Akquisephase

- Verbindliche fachliche Arbeitsgrundlage: [Partnerkonzept 2.0 – Akquise-Playbook](PARTNERKONZEPT-2-0-AKQUISE-PLAYBOOK.md). Enthält Projekt- und Preis-Hypothesen, Partnerrollen, Story-Ansätze, Anschreiben, Gesprächsablauf und priorisierte Maßnahmen; keine genehmigten Angebote.
- **Gesprächsteam:** 1. Vorsitzender und Finanzvorstand Thomas führen strategische Partner- und Lieferantengespräche. Digitaler Partnership Manager bereitet vor und führt CRM-Nachverfolgung. Keine automatische externe Ansprache.
- **Höchste operative Priorität:** Getränkelieferant 2027 und sichere Versorgung Januar; Rothenberger-Ausstieg laut Vorstandsnachverfolgung, Umfang noch zu prüfen. Detail: `../../projects/getraenkelieferant-2027/PROJECT-STATE.md`.
- **Drei Jugend-Eventchancen:** zwei Januar-Turnierwochenenden Schönbornhalle (CRM020, CRM021) und Jugendsportfest Juli mit Zukunftsmeile, Azubi-, Mobilitäts-/Jobrad- und Ausstellerideen (CRM022). Projekt-/Event-Rechte und Termine vor Vermarktung klären.
- **Sportpark-Naming:** `../../projects/sportpark-namensrechte/PROJECT-STATE.md`; ambitioniertes Premium-Ziel ist unvalidiert. LED-, Event- und Sportparkrechte nicht doppelt vermarkten.
- **Rasenpflege 2027:** drei Plätze, ca. 12.000 € historische **Kostenschätzung**, kein bestätigter Sponsoringerlös (CRM018).
- Operative Source of Truth bleibt das geschützte native Partner-CRM; vertrauliche Partnerdaten nicht im Repository duplizieren.


### Update 15.10.2026 – Sportpark 2031 und Getränkepartner

- **Sportpark 2031:** Das Sportpark-Namensrecht ist laut Vorstand intern frei. Das verifizierte Fünfjahreskonzept verbindet eine langfristige Namenspartnerschaft mit einem sichtbaren jährlichen Sportparkprojekt; eine optionale Unterstützung regulärer Teilzeitbeschäftigung im Sportparkteam bleibt ein gesonderter Finanzierungsbaustein.
- **Partnerstories vorhanden:** Sparkasse Kraichgau, Volksbank Kraichgau, MAYA Hausbau und SEW-EURODRIVE. Alle Unterlagen sind interne, nicht versendete Arbeitsentwürfe. MAYA und Sparkasse bleiben A-Leads; Volksbank und SEW wurden wegen belastbarem Regional-/Sport- bzw. Ausbildungsfit als B-Leads ins CRM aufgenommen.
- **Sportparkteam:** Jobcenter-Vorabklärung für zwei bestehende Maßnahmenteilnehmende am 13.10.2026 versendet. Förderinstrument, individuelle Förderfähigkeit, Höhe und Laufzeit offen; keine Arbeitsplatzzusage und keine gesicherte Finanzierung.
- **Getränkelieferant 2027:** Thome-Partnerkonzept für sechs feste Events fertig; Kiosk und Pilotlogik ausgeschlossen. Gewünscht ist eine getrennte Kombination aus Lieferangebot, Geldbeitrag und Sachleistungen, insbesondere Schürzen, Beschattung und Mehrwegbecher. Getränke Böllinger ist weiterer Vergleichskandidat. Interne Rechte-/Owner-Klärung ist bis 16.10.2026 fällig.
- **Zeitkritisch:** EconSocial-LED-Erstgespräch am 16.10.2026, 09:45 Uhr; Mustervertrag, vollständiger Leistungsumfang und TuS-Vermarktungsrechte bleiben Entscheidungsgates.
