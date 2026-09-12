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

Noch offen:

- Welche Aufgaben gehören zum Sportparkteam, zu Greenkeeping/Hartmut oder zu Verwaltung/Beschaffung?
- Welche Daten müssen dauerhaft erfasst werden: Aufgaben, Verantwortliche, Stunden, Material, Maschinen, Wetterbezug, Kosten?
- Welche Aufgaben können regelbasiert aus Wetterdaten abgeleitet oder priorisiert werden?
- Was bedeutet `Angebotssuche` im konkreten Ablauf: Material, Dienstleistungen, Maschinen, Verbrauchsmittel oder mehrere Kategorien?
- Welche Teile sind operative Tagesarbeit und welche sind Projekt-/Investitionsthemen?

Erste Arbeitshypothese, **keine Rollenentscheidung**: Wahrscheinlich zunächst ein gemeinsamer Sportpark-Operations-Bereich mit Task-/Stundenerfassung und späteren Automationen. Ob dafür eine neue Rolle nötig ist, wird gegen bestehende Sportpark-/Greenkeeper-Verantwortung geprüft.

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

Noch zu entscheiden:

- Ist `Materialwart` eine eigene dauerhafte Rolle oder ein Beschaffungs-Skill/Runtime unter Sport bzw. Vereinsverwaltung?
- Welche Materialgruppen gehören dauerhaft auf die Watchlist?
- Soll zusätzlich ein Soll-/Ist-Lagerbestand geführt werden, damit nur wirklich benötigtes Material beobachtet wird?
- Welche Händler und Ausrüster sind bevorzugt bzw. wegen bestehender Partnerschaften oder Konditionen besonders zu berücksichtigen?
- Wie wird verhindert, dass ein günstiges Angebot gekauft wird, obwohl kein realer Bedarf besteht?

Erste Arbeitshypothese, **noch keine Rollenfreigabe**: Der wiederkehrende Preis- und Bedarfscheck ist ein klarer Kandidat für einen späteren n8n-Runtime-Loop. Ob dafür ein eigener digitaler Mitarbeiter `Materialwart` entsteht oder der Loop einer bestehenden Sport-/Beschaffungsverantwortung zugeordnet wird, wird nach den ersten realen Anforderungen entschieden.

## Relationship to other documents

- `README.md` – Prinzip und aktuelle formale Rollen
- `../knowledge/governance/CURRENT-STATE.md` – geklärter Governance-/Vorstandsbedarf
- `../projects/PROJECT-PORTFOLIO.md` – formale Projekte und Projektkandidaten
- `project-portfolio-manager/` – Projekte, Abhängigkeiten und Projektstatus
- `data-protection-manager/` – Datenschutz und Informationsschutz bei personenbezogenen Prozessen
- `../organization/organization-model.md` – Organisationsmodell und Verantwortung

## Future Development

Dieses Dokument wird nur dann erweitert, wenn ein neuer realer Arbeitsbedarf auftaucht, dessen organisatorische Zuordnung noch nicht geklärt ist.

Bei Klärung wird der jeweilige Kandidat in die fachlich richtige Source of Truth überführt und hier entsprechend als entschieden markiert oder entfernt. Es sollen keine dauerhaften Parallelbeschreibungen entstehen.