# Rollen- und Arbeitsbedarf-Kandidaten

## Purpose

Dieses Dokument hält frühe Beobachtungen zu wiederkehrenden Arbeitsbedarfen der TuS Digital Organisation fest, bevor entschieden ist, ob daraus eine eigene Rolle, ein Skill, ein Loop, ein Projekt, ein Produkt oder ein Teil einer bestehenden Verantwortung entsteht.

Es ist bewusst ein Arbeitsparkplatz und keine Rollenfreigabe.

## Core Principle

> **Erst den realen Arbeitsbedarf verstehen, dann die passende organisatorische Form wählen.**

Nicht jeder wiederkehrende Vorgang benötigt einen eigenen digitalen Mitarbeiter. Neue Rollen entstehen nur, wenn eine dauerhafte, klar abgrenzbare Verantwortung dies rechtfertigt.

## Main Content

### Statuslogik

Neue Einträge in diesem Dokument sind zunächst **ungeprüfte Kandidaten**.

Bei späterer Bearbeitung wird je Themenblock entschieden, ob der Bedarf am besten abgebildet wird durch:

- eine bestehende Rolle,
- eine neue Rolle,
- einen Skill,
- einen Runtime-/Automations-Loop,
- ein Projekt oder Softwareprodukt,
- einen organisatorischen Prozess,
- oder eine Kombination daraus.

Geklärte Kandidaten werden auf ihre neue kanonische Quelle verwiesen und hier nicht parallel weitergeführt.

### 1. Vorstandssitzung / Vorstandsarbeit – entschieden

Ursprüngliche Schnellnotizen:

- Projekte
- Agendabuilder
- Nachverfolgung von Sitzungen
- Anfragen an `vorstand@tus`

**Entscheidung vom 12.09.2026:** Aus diesem Bedarf wird vorerst **keine eigene neue Rolle**.

Die Vorstandsarbeit wird als organisationsweiter **Sarah Governance Loop** weiterentwickelt. Sarah koordiniert Agenda-Vorbereitung, Triage, Aufgaben-/Beschlussnachverfolgung und die Verbindung zu bestehenden fachlichen Quellen. Entscheidungen bleiben beim zuständigen Vorstand.

Kanonischer aktueller Stand:

- `../knowledge/governance/CURRENT-STATE.md`

Der Project Portfolio Manager bleibt fachliche Quelle für Projektstatus und Projektabhängigkeiten. Der Event Planner soll wiederkehrende operative Veranstaltungsdetails aus Vorstandssitzungen herausnehmen.

### 2. Sportpark

Schnellnotizen:

- 1-€-Jobber Tasklist
- 1-€-Jobber Stunden
- Wetterdaten und Taskliste
- Angebotssuche
- Bestellwesen
- Getränkeversorgung / Getränkebestellung Kiosk

#### Beschaffung und Versorgung

Der Sportpark benötigt neben Aufgaben- und Stundensteuerung wahrscheinlich eine einfache wiederkehrende Beschaffungs- und Versorgungslogik.

Relevante Beispiele:

- Trainings- und Fußballmaterial,
- Verbrauchsmaterial,
- Platz-/Pflegematerial,
- Kioskgetränke,
- weitere regelmäßig benötigte Sportparkartikel.

Für den Kiosk ist später insbesondere zu klären:

- aktueller Bestand und Mindestbestand je relevanter Ware,
- erwarteter Bedarf aus Heimspielen, Veranstaltungen und Saisonverlauf,
- Bestellmenge und Gebinde,
- Lieferant sowie Lieferung versus Selbstabholung,
- Lieferzeit, Mindestbestellwert und Rückgabe-/Leergutlogik,
- Verbindung zum künftigen Getränkepartner,
- Freigabe vor tatsächlicher Bestellung.

Ein späterer n8n-Loop könnte aus Bestand, anstehenden Heimspielen/Events und Lieferzeiten einen **Bestellvorschlag** erzeugen. Eine Bestellung wird nicht ohne ausdrücklich definierten Freigabeprozess ausgelöst.

Noch offen:

- Welche Aufgaben gehören zum Sportparkteam, zu Greenkeeping/Hartmut oder zu Verwaltung/Beschaffung?
- Welche Daten müssen dauerhaft erfasst werden: Aufgaben, Verantwortliche, Stunden, Material, Maschinen, Wetterbezug, Kosten und Bestände?
- Welche Aufgaben können regelbasiert aus Wetterdaten abgeleitet oder priorisiert werden?
- Welche Teile des Bestellwesens gehören zum Materialwart und welche zu einer breiteren Beschaffungs-/Versorgungsverantwortung?
- Welche Teile sind operative Tagesarbeit und welche sind Projekt-/Investitionsthemen?

Erste Arbeitshypothese, **keine Rollenentscheidung**: Wahrscheinlich zunächst ein gemeinsamer Sportpark-Operations-Bereich mit Task-/Stundenerfassung, Bestands-/Bestelllogik und späteren Automationen. Ob dafür eine neue Rolle nötig ist, wird gegen bestehende Sportpark-/Greenkeeper-/Beschaffungsverantwortung geprüft.

### 3. Mitgliederverwaltung

Schnellnotizen:

- Neuanmeldungen
- Kündigungen

Noch offen:

- Welche weiteren wiederkehrenden Kernprozesse gehören zur Mitgliederverwaltung?
- Welche Schritte sind rein administrativ, welche benötigen menschliche Prüfung oder Freigabe?
- Wo liegt künftig die führende Mitglieder-Source-of-Truth?
- Welche Datenflüsse, Aufbewahrungsregeln und Berechtigungen sind mit dem Data Protection Manager abzustimmen?
- Welche Eingänge sollen später über `mitgliederverwaltung@...` strukturiert verarbeitet werden?

Erste Arbeitshypothese, **keine Rollenentscheidung**: Dies ist sehr wahrscheinlich eine dauerhafte fachliche Verantwortung. Vor Anlage einer formalen Rolle soll der vollständige Prozessumfang einmal inventarisiert werden, damit nicht nur Anmeldung und Kündigung modelliert werden.

### 4. Materialwart / Beschaffungsradar

Realer wiederkehrender Bedarf:

- Trainings- und Fußballmaterial regelmäßig auf attraktive Beschaffungsmöglichkeiten prüfen,
- insbesondere Fußbälle, Hütchen, Leibchen, Trainingsstangen, Koordinationsmaterial, Minitore, Ballnetze, Pumpen, Markierungs- und vergleichbares Verbrauchs-/Trainingsmaterial,
- Vereins-, Mengen- und Aktionsangebote bei seriösen Händlern beobachten,
- nur bei **außergewöhnlich gutem Preis-Leistungs-Verhältnis** aktiv melden.

Gewünschte spätere Runtime:

- **Cadence:** wöchentlich über n8n,
- aktuelle Preise und Angebote gegen realistische Markt-/Referenzpreise und – soweit vorhanden – frühere TuS-Beschaffungspreise vergleichen,
- Qualität, Vereins-Eignung, Stück-/Mengenpreis, Versand und Mengenstaffeln berücksichtigen,
- reine Marketingrabatte oder gewöhnliche Preisbewegungen ignorieren,
- bei einem echten Schnäppchen eine kurze Beschaffungsempfehlung mit Artikel, Händler, Endpreis, Vergleichspreis, Ersparnis, Mengenhinweis und Angebotsfrist ausgeben,
- keine Bestellung automatisch auslösen; Beschaffung bleibt freigabepflichtig.

Der Schwellwert für `außergewöhnlich günstig` soll nicht blind als fixer Rabatt-Prozentsatz definiert werden. Maßgeblich ist ein belastbarer Vergleich aus Marktpreis, Produktqualität, benötigter Menge und TuS-Bedarf. Ein konfigurierbarer Deal-Score bzw. Schwellenwert kann später aus realen Läufen kalibriert werden.

Der Kandidat hängt eng mit dem Sportpark-Bestellwesen zusammen. Der reine Angebotsradar soll nicht unnötig vom realen Bestand und Bedarf getrennt werden.

Noch zu entscheiden:

- Ist `Materialwart` eine eigene dauerhafte Rolle oder ein Beschaffungs-Skill/Runtime unter Sport bzw. Vereinsverwaltung?
- Welche Materialgruppen gehören dauerhaft auf die Watchlist?
- Soll zusätzlich ein Soll-/Ist-Lagerbestand geführt werden, damit nur wirklich benötigtes Material beobachtet wird?
- Welche Händler und Ausrüster sind bevorzugt bzw. wegen bestehender Partnerschaften oder Konditionen besonders zu berücksichtigen?
- Wie wird verhindert, dass ein günstiges Angebot gekauft wird, obwohl kein realer Bedarf besteht?
- Gehört die Kiosk-/Getränkeversorgung in dieselbe Verantwortung oder nur in denselben Beschaffungsprozess?

Erste Arbeitshypothese, **noch keine Rollenfreigabe**: Der wiederkehrende Preis- und Bedarfscheck ist ein klarer Kandidat für einen späteren n8n-Runtime-Loop. Ob dafür ein eigener digitaler Mitarbeiter `Materialwart` entsteht oder der Loop einer bestehenden Sport-/Beschaffungsverantwortung zugeordnet wird, wird nach den ersten realen Anforderungen entschieden.

### 5. Scouting – Jugend und Herren

Realer wiederkehrender Bedarf:

Der TuS möchte den regionalen Fußballmarkt systematischer beobachten und potenziell interessante Spieler frühzeitig erkennen, statt nur auf persönliche Zufallshinweise zu reagieren.

Vorgesehener Beobachtungsraum:

- Kreisligen und Kreisklassen im Raum **Bruchsal**,
- Kreisligen und Kreisklassen im Raum **Karlsruhe**,
- Kreisligen und Kreisklassen im Raum **Heidelberg**,
- **Landesligen Baden**,
- **Verbandsliga Baden**.

Der Arbeitsbedarf umfasst grundsätzlich **Herren und Jugend**, wird aber wegen unterschiedlicher Schutz- und Datenschutzanforderungen nicht identisch behandelt.

#### Mögliche spätere Herren-Runtime

Ein Scouting-Run könnte regelmäßig öffentlich verfügbare sportliche Informationen aus belastbaren Quellen sichten und daraus Kandidatenhinweise erzeugen.

Denkbare Kriterien, die fachlich noch festzulegen sind:

- Position,
- Alter,
- aktuelles und bisheriges Spielniveau,
- Einsätze / Spielminuten,
- Tore und weitere belastbar verfügbare Leistungsindikatoren,
- Entwicklung über mehrere Spieltage / Saisons,
- Vereinswechsel bzw. Wechselhistorie, soweit öffentlich und relevant,
- regionale Erreichbarkeit,
- erkennbarer Positions- oder Kaderbedarf des TuS.

Ausgabe soll keine automatische Spielerbewertung als Wahrheit sein, sondern eine **Scouting-Shortlist mit Begründung und Quellen**, die anschließend durch sportlich Verantwortliche geprüft wird.

#### Jugend – zusätzliche Grenzen

Für Jugendspieler gelten strengere Leitplanken.

Vorgesehen ist ausschließlich die Nutzung **öffentlicher sportlicher Informationen aus legitimen Fußball-/Verbandsquellen**. Nicht vorgesehen sind insbesondere:

- private oder halbprivate Social-Media-Recherche,
- Sammlung von Schul-, Familien-, Wohn- oder privaten Kontaktdaten,
- verdeckte Persönlichkeits- oder Verhaltensprofile,
- automatisierte Kontaktaufnahme mit Minderjährigen,
- automatisierte Transfer-/Wechselempfehlungen ohne menschliche sportliche Prüfung.

Bei Jugendspielern dient ein digitaler Scouting-Run zunächst nur der sportlichen Vorauswahl bzw. Beobachtung. Jede weitere Prüfung und Ansprache bleibt bei den zuständigen menschlichen Vereinsverantwortlichen und muss zu Jugend-/Datenschutzstandards passen.

#### Noch zu entscheiden

- Wird `Scouting` eine eigene Rolle oder ein Skill/Runtime unter Sport / sportlicher Leitung?
- Welche Mannschaften des TuS sollen konkret unterstützt werden?
- Welche Altersklassen im Jugendbereich sind tatsächlich relevant?
- Welche Positionen und Kaderbedarfe werden als Input benötigt?
- Welche öffentlichen Datenquellen sind dauerhaft nutzbar, belastbar und technisch zugänglich?
- Wie oft soll der Markt geprüft werden: wöchentlich, rund um Transferperioden oder ereignisbasiert?
- Welche Kriterien erzeugen einen Hinweis und welche nur Beobachtung?
- Wo wird eine Shortlist geschützt geführt und wer darf sie sehen?
- Wie werden bereits geprüfte / verworfene Kandidaten markiert, damit keine Schleifen entstehen?

Erste Arbeitshypothese, **noch keine Rollenfreigabe**: Der Bedarf ist dauerhaft und klar genug für einen späteren Scouting-Loop. Vor einem eigenen digitalen Mitarbeiter werden zunächst Datenquellen, sportliche Kriterien, Jugendgrenzen und der Handoff an Trainer bzw. sportlich Verantwortliche definiert.

## Relationship to other documents

- `README.md` – Prinzip und aktuelle formale Rollen
- `../knowledge/governance/CURRENT-STATE.md` – geklärter Governance-/Vorstandsbedarf
- `../projects/PROJECT-PORTFOLIO.md` – formale Projekte und Projektkandidaten
- `project-portfolio-manager/` – Projekte, Abhängigkeiten und Projektstatus
- `data-protection-manager/` – Datenschutz und Informationsschutz bei personenbezogenen Prozessen
- `../standards/child-youth-protection.md` – Schutzanforderungen bei Jugendbezug
- `../organization/organization-model.md` – Organisationsmodell und Verantwortung

## Future Development

Dieses Dokument wird nur dann erweitert, wenn ein neuer realer Arbeitsbedarf auftaucht, dessen organisatorische Zuordnung noch nicht geklärt ist.

Bei Klärung wird der jeweilige Kandidat in die fachlich richtige Source of Truth überführt und hier entsprechend als entschieden markiert oder entfernt. Es sollen keine dauerhaften Parallelbeschreibungen entstehen.