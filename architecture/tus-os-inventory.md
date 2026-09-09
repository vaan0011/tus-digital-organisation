# TuS OS Inventory

Stand: 2026-09-10 – erste organisationsweite OS-/Second-Brain-Inventur

## Purpose

Dieses Dokument macht sichtbar, welche Bausteine der TuS Digital Organisation bereits existieren, welche Funktion sie im zukünftigen TuS-OS übernehmen und welche Lücken noch geschlossen werden müssen.

Es ist **keine neue Parallelstruktur**. Es ordnet den bestehenden Repository-Bestand in fünf zusammenwirkende Ebenen ein:

1. **Second Brain** – was die Organisation weiß,
2. **TuS-OS** – wie die Organisation funktioniert,
3. **Skills** – was Rollen beherrschen müssen,
4. **Loops / Runtime** – wie Arbeit selbstständig fortgesetzt wird,
5. **Memory Router** – wie für eine konkrete Aufgabe nur der relevante Kontext geladen wird.

## Core Principle

> **Keine wesentliche TuS-Arbeit beginnt bei null. Vor neuer Arbeit wird zuerst geprüft, was bereits gewusst, entschieden, gelernt, verworfen oder begonnen wurde.**

Chats sind Rohmaterial und Arbeitsoberfläche. GitHub wird die dauerhaft nachvollziehbare organisatorische Wahrheit. Google Drive bleibt Artefakt-, Quellen- und geschützter Arbeitsraum dort, wo Dateien, Originalquellen oder sensible Informationen hingehören.

## Main Content

### 1. Executive Inventory

Der aktuelle Repository-Bestand ist bereits deutlich näher an einem Betriebssystem als bisher benannt:

| Ebene | Bereits vorhanden | Reife | Hauptlücke |
|---|---|---:|---|
| TuS-OS | `organization/`, `standards/`, `core/`, `architecture/`, `decisions/`, `roles/`, `projects/` | hoch | kein zentraler OS-Einstieg und keine explizite Zuordnung der Bestandteile |
| Second Brain | `knowledge/funding/`, `knowledge/sponsoring/`, ADRs, `PROJECT-STATE.md`, fachliche Standards | mittel | Wissen aus Chats und weiteren Fachbereichen ist noch nicht organisationsweit strukturiert migriert |
| Skills | Fachkompetenz steckt in Rollen- und Standarddateien | niedrig bis mittel | kein wiederverwendbarer Skill-Katalog und keine eindeutige Trennung Rolle ↔ Skill ↔ Runtime |
| Loops / Runtime | `employee-runtime-standard.md`, `daily-work-cycle.md`, `learning-loop.md`, besonders `roles/archivist/runtime.md` | mittel bis hoch | noch kein organisationsweiter Loop-Katalog; Runtime-Reife ist je Rolle unterschiedlich |
| Memory Router | implizit durch Verweise und Startprompts | niedrig | kein formales Routing-Modell, das pro Aufgabe relevante Entscheidungen, Wissen, Skills und Zustände auswählt |

**Schlüsselbefund:** Es muss kein neues System erfunden werden. Die nächste Stufe entsteht vor allem durch **Ordnen, Verlinken, Verdichten und Lücken schließen**.

---

### 2. TuS-OS – vorhandene Systemsubstanz

#### 2.1 Organisation und Kultur

Bereits vorhanden:

- `organization/culture.md`
- `organization/guiding-principles.md`
- `organization/leadership-philosophy.md`
- `organization/organization-chart.md`
- `organization/organization-dna.md`
- `organization/organization-model.md`
- `organization/organization-principles.md`
- `organization/philosophy.md`
- `organization/responsibility-philosophy.md`
- `organization/team-philosophy.md`
- `organization/values.md`

Befund:

- Die kulturelle und organisatorische DNA ist umfangreich vorhanden.
- Mehrere Dokumente haben thematische Nähe; langfristig ist eine klare Navigationslogik wichtiger als sofortige Konsolidierung.
- Leere bzw. sehr dünne Dateien wie `team-coordination.md` und einzelne Kurzdateien sind als unfertige Systemstellen sichtbar zu halten, statt stillschweigend als vollständige Standards zu behandeln.

#### 2.2 Core und Architektur

Bereits vorhanden:

- `core/core-object.md`
- `core/core-principles.md`
- Objektdefinitionen für u. a. Person, Rolle, Aufgabe, Ereignis, Dokument, Ressource, Beziehung, Workspace und Wissenseintrag
- `architecture/knowledge-graph.md`
- `architecture/platform-architecture.md`
- `architecture/stability-and-simplicity.md`

Befund:

- Das Repo enthält bereits die Grundlage für ein objektorientiertes Organisationsmodell und einen Knowledge Graph.
- Das ist die technische Basis für den späteren Memory Router.
- Leere Objektdefinitionen wie `location.md`, `picture.md` und `object-lifecycle.md` markieren echte Modelllücken.

#### 2.3 Entscheidungen

Bereits vorhanden ist ein wachsender ADR-Bestand, u. a. zu:

- Trennung Rolle / Mitarbeiter,
- Projektzustand und Last Known Good,
- zentralen Brand Assets,
- kontrollierter Designproduktion,
- Partnership Manager und Sponsoring Memory,
- systematischem Funding Management,
- zentralem Projektportfolio.

Befund:

- `decisions/` ist bereits ein Kern des Second Brain und gleichzeitig Governance-Schicht des OS.
- ADRs sollten künftig gezielt mit betroffenen Rollen, Skills, Projekten und Wissensdomänen verknüpft werden.

---

### 3. Second Brain – vorhandenes Wissen und Migrationslücken

#### 3.1 Bereits kanonisch vorhanden

Aktuelle Wissensdomänen unter `knowledge/`:

- `funding/`
- `sponsoring/`

Zusätzliche faktische Wissensspeicher existieren verteilt in:

- `projects/*/PROJECT-STATE.md`,
- `decisions/`,
- Rollenstandards,
- Designstandards,
- Architekturdateien,
- Google-Drive-Artefakten und Fachregistern.

#### 3.2 Noch nicht als Second Brain sichtbar genug

Aus der bisherigen TuS-Arbeit sind mindestens folgende Wissensdomänen als Migrationskandidaten bekannt:

- Archiv / Vereinsgeschichte,
- Brand Identity / Designentscheidungen,
- Merch / Produktionsregeln,
- Homepage / Kommunikation,
- Spielberichte / Matchday Content,
- Mitglieder / Engagement,
- Mannschaften / Sportdaten,
- Veranstaltungen,
- Infrastruktur / Sportpark,
- Datenschutz / IT,
- Vereinsentwicklung / Digitale Organisation.

Diese Domänen sollen **nicht automatisch neue Ordner erhalten**. Vor Anlage wird geprüft, ob Wissen bereits an einer fachlich besseren Stelle kanonisch liegt.

#### 3.3 Wissensarten gegen die „Schleifen des Todes“

Für Second-Brain-Einträge werden künftig mindestens folgende Zustände unterschieden:

- **Known / Fact** – belastbares Wissen,
- **Decision** – verbindlich entschieden,
- **Current State** – aktueller Arbeitsstand,
- **Open Question** – bewusst offen,
- **Rejected / Do not revisit** – geprüft und verworfen,
- **Lesson Learned** – aus realer Arbeit abgeleitete Regel,
- **Hypothesis** – plausible, noch nicht bestätigte Annahme,
- **Superseded** – durch neueren Stand ersetzt.

Der Zustand `Rejected / Do not revisit` ist ausdrücklich wichtig: Ein verworfener Weg darf nicht in einem neuen Chat ohne neue Evidenz wieder als frische Idee präsentiert werden.

---

### 4. Skills – vom Rollenwissen zum wiederverwendbaren Kompetenzmodell

Aktuell enthalten Rollen bereits viel Fachkompetenz, aber Skill und Rolle sind noch nicht sauber getrennt.

Beispiel Archivist:

- Quellenkritik,
- Quellenerschließung,
- Metadatenpflege,
- Entitäten- und Beziehungserkennung,
- Unsicherheitsmanagement,
- historische Querschnittsauswertung,
- Anekdoten- und Publikationspotenzial erkennen.

Diese Fähigkeiten sind heute überwiegend in `role.md`, `archive-standard.md` und `runtime.md` eingebettet.

#### Zielbild

Ein Skill ist eine wiederverwendbare Fähigkeit mit:

- Purpose,
- Input,
- Methode,
- Qualitätskriterien,
- Grenzen,
- Output,
- relevanten Tools / Quellen,
- Beziehungen zu Standards und Entscheidungen.

Skills werden erst dann als eigenständige Dateien ausgelagert, wenn mindestens eines gilt:

1. mehrere Rollen benötigen dieselbe Fähigkeit,
2. die Fähigkeit ist komplex genug für einen eigenen Qualitätsstandard,
3. sie entwickelt sich unabhängig von der Rolle weiter,
4. ihre Wiederverwendung verhindert Doppelarbeit oder widersprüchliche Regeln.

**Keine Skill-Dateien nur um der Struktur willen.**

#### Erste Skill-Kandidaten

Organisationsweit wiederverwendbar:

- Source Research & Verification,
- Structured Documentation,
- Decision Capture,
- Current-State Handover,
- GitHub Working / PR Handover,
- Google-Drive Source Handling,
- Privacy-aware Information Handling,
- Brand Compliance,
- Web Research with Primary Sources,
- Cross-Domain Dependency Detection.

Rollenspezifische Kandidaten:

- Archivist: Historical Source Analysis, Archive Cataloguing, Historical Entity Linking,
- Funding: Funding Eligibility Analysis, Funding Calendar Management, Application Research,
- Partnership: Partner Matching, Sponsoring Campaign Design, Partner CRM Reasoning,
- Graphic Design: Production-ready Brand Application, Reference Fidelity,
- WordPress: TuS Frontend UX Implementation, WordPress Plugin Delivery,
- Project Portfolio: Initiative Classification, Dependency Mapping, Project-State Audit,
- Matchday Editor: Match Fact Validation, Emotional Sports Reporting, Channel Adaptation.

---

### 5. Loops / Runtime – autonomes Weiterarbeiten ohne Chat-Loops

#### 5.1 Bereits vorhandene organisationsweite Bausteine

- `standards/employee-runtime-standard.md`
- `employees/daily-work-cycle.md`
- `standards/learning-loop.md`
- `standards/iteration-and-progress.md`
- `standards/approval-and-escalation.md`

#### 5.2 Referenzimplementierung: Archivist

`roles/archivist/runtime.md` ist aktuell der reifste Runtime-Pilot. Er besitzt bereits:

- dauerhaften Auftrag,
- Source of Truth,
- Arbeitsqueue,
- Cursor / Checkpoint,
- Auswahlregel für nächste Arbeit,
- wiederholbaren Arbeitszyklus,
- Statusmodell,
- autonomen Entscheidungsbereich,
- echte Eskalationsbedingungen,
- Definition of Done,
- automatische Fortsetzung in die nächste Phase.

Damit ist der Archivist das Referenzmuster für weitere Rollenloops.

#### 5.3 Zielmuster eines TuS-Loops

Jeder echte Loop braucht nur dann eine eigene Runtime-Definition, wenn Arbeit über mehrere Ausführungen selbstständig fortgesetzt werden soll.

Mindestbestandteile:

1. **Mission** – welcher dauerhafte Auftrag wird verfolgt?
2. **Queue / Trigger** – wo kommt die nächste Arbeit her?
3. **Cursor** – wo wurde belastbar aufgehört?
4. **Cycle** – welche Schritte werden wiederholt?
5. **Write-back** – wo wird der neue Zustand gespeichert?
6. **Decision Boundary** – was darf autonom entschieden werden?
7. **Escalation** – wann ist menschliche Entscheidung nötig?
8. **Done / Transition** – wann endet der Loop oder wechselt die Phase?

#### 5.4 Nächste Loop-Kandidaten

- Funding Radar Loop,
- Project Portfolio Review Loop,
- Sponsoring / Partner Development Loop,
- Matchday Reporting Loop,
- Design Production & Brand QA Loop,
- Event Planner Development Loop,
- Archive Ingestion / New Source Loop.

Nicht jeder wiederkehrende Prozess braucht Automatisierung. Ein Loop beschreibt zuerst **Arbeitslogik**; eine geplante Aufgabe oder Automation bestimmt anschließend **wann** er ausgeführt wird.

---

### 6. Memory Router – fehlende Verbindungsschicht

Der Memory Router soll keinen neuen Wissensspeicher erzeugen. Er entscheidet, welche vorhandenen Quellen für eine konkrete Aufgabe gelesen werden müssen.

#### Geplante Routing-Reihenfolge

Vor wesentlicher Arbeit prüft eine Rolle:

1. Welche Rolle arbeite ich gerade?
2. Welches Projekt / welche Wissensdomäne ist betroffen?
3. Welche aktuellen `PROJECT-STATE`- oder `CURRENT-STATE`-Dateien gelten?
4. Welche ADRs / verbindlichen Entscheidungen betreffen die Aufgabe?
5. Welche Standards gelten?
6. Welche Skills werden benötigt?
7. Gibt es `Rejected`, Lessons Learned oder frühere Fehlversuche, die Wiederholung verhindern?
8. Wo muss der neue Arbeitsstand zurückgeschrieben werden?

#### Anti-Loop-Regel

> **Eine bereits entschiedene oder verworfene Frage wird nur neu geöffnet, wenn neue Evidenz, eine geänderte Randbedingung oder eine explizite menschliche Entscheidung dies rechtfertigt.**

Wenn etwas neu geöffnet wird, muss dokumentiert werden:

- was sich geändert hat,
- welche frühere Entscheidung betroffen ist,
- warum die Neubewertung gerechtfertigt ist.

---

### 7. Rollen-Inventar

Aktuell formal vorhanden:

| Rolle | Bestand | OS-Reife | Nächste strukturelle Aufgabe |
|---|---|---:|---|
| Archivist | Rolle + Archivstandard + Runtime | sehr hoch | Skills aus realer Arbeit identifizieren; nicht vorschnell zerlegen |
| Funding & Grants Manager | formale Rolle vorhanden | hoch | Funding Loop und wiederverwendbare Research-/Eligibility-Skills explizit machen |
| Graphic Designer | formale Rolle vorhanden | mittel bis hoch | Brand-/Production-Learnings aus Chats vollständig kanonisieren; Reference-Fidelity als Skill prüfen |
| Matchday Editor | formale Rolle vorhanden | mittel | wiederkehrenden Matchday-Loop und Faktenübergabe standardisieren |
| Partnership Manager | formale Rolle vorhanden | hoch | Sponsoring Memory, Kampagnen und Partnerdaten mit Loop/Skills verbinden |
| Project Portfolio Manager | formale Rolle vorhanden | hoch | Portfolio Review Loop + Inventory-Audit als wiederverwendbare Fähigkeit definieren |
| WordPress Developer | formale Rolle + konkreter Mitarbeiterbereich vorhanden | hoch | Entwicklungsloop gegen Projektzustände/PR/LKG schärfen |

Befund:

- Rollenmodell und Mitarbeiter-Modell sind bereits bewusst getrennt.
- `employees/` enthält aktuell im Wesentlichen den WordPress-Developer als konkret ausgeprägten Mitarbeiterbereich; weitere digitale Mitarbeiter sind organisatorisch noch nicht gleichmäßig repräsentiert.
- Das ist kein unmittelbarer Fehler, aber eine sichtbare Reifedifferenz.

---

### 8. Projekt-Inventar und Anschluss an das OS

Das zentrale `projects/PROJECT-PORTFOLIO.md` führt aktuell zehn formale Projekte sowie reale Projektkandidaten.

Das Projektportfolio bleibt **die Übersicht über Vorhaben**, während dieses Dokument **die Übersicht über die Betriebsfähigkeit der Organisation** bildet.

Künftig soll jedes formale Projekt mindestens anschließbar sein an:

- zuständige Rolle(n),
- relevante Entscheidungen,
- relevante Wissensdomäne(n),
- benötigte Skills,
- aktuellen Zustand,
- gegebenenfalls Runtime / Loop,
- relevante externe Artefakte.

Damit wird aus einer Projektliste ein navigierbares Organisationsnetz.

---

### 9. Repository-Hygiene und sichtbare Schulden

Bei der Inventur wurden zusätzlich strukturelle Schulden sichtbar:

- mehrere `.DS_Store`-Dateien sind versioniert,
- einzelne leere Architektur-/Objektdateien existieren,
- einige Projektzustände sind laut Portfolio teilweise veraltet,
- Wissen ist außerhalb von Funding und Sponsoring noch stark verteilt,
- Skill-Definitionen fehlen als eigene Schicht,
- Loop-Definitionen existieren, sind aber nicht als organisationsweiter Katalog auffindbar,
- ein zentraler OS-Einstieg fehlt.

Diese Punkte sind **kein Anlass für einen großen Repository-Umbau**. Sie werden inkrementell bereinigt.

---

### 10. Chat-to-Brain Migration Standard

Bisherige und zukünftige TuS-Chats werden nicht als Gesprächsprotokolle nach GitHub kopiert.

Aus relevanten Chatabschnitten werden nur dauerhafte Organisationsartefakte extrahiert:

```text
Chat / Arbeitsdialog
        ↓
Fakt / Erkenntnis / Problem
        ↓
Entscheidung | Current State | Lesson | Rejected | Open Question
        ↓
passender kanonischer Speicher
        ↓
Verknüpfung zu Rolle / Projekt / Skill / Loop
```

Vor jeder Migration gilt:

- Existiert die Information bereits kanonisch? → aktualisieren statt duplizieren.
- Ist sie nur temporär? → nicht ins langfristige Second Brain aufnehmen.
- Ist sie widersprüchlich? → Unsicherheit bzw. Konflikt sichtbar dokumentieren.
- Ist eine frühere Regel überholt? → nicht löschen; nachvollziehbar superseden.

---

### 11. Reifegradmodell

Für die weitere Inventur verwenden wir vier Reifegrade:

- **L0 – Chat-dependent:** Wissen/Fähigkeit lebt praktisch nur im Gespräch.
- **L1 – Documented:** in GitHub/Drive dokumentiert, aber nicht sauber in das Organisationsmodell eingebunden.
- **L2 – Connected:** Rolle, Wissen, Entscheidung, Projekt und Arbeitsregel sind sinnvoll verknüpft.
- **L3 – Runtime-ready:** Arbeit kann mit Queue, Cursor, Entscheidungsgrenzen und Write-back selbstständig fortgesetzt werden.

Ziel ist **nicht**, alles auf L3 zu bringen. Nur Tätigkeiten mit echtem Nutzen aus autonomer Fortsetzung benötigen Runtime-Reife.

---

### 12. Priorisierte nächste Ausbauschritte

#### Priorität A – Fundament

1. Dieses Inventory als zentralen Ausgangspunkt etablieren.
2. Einen kleinen `Second Brain`-Standard definieren: Zustände, Canonical Source, Rejected/Superseded-Regel.
3. Einen `Memory Router`-Standard definieren.
4. Bestehende Rollen gegen Skills und Runtime inventarisieren, ohne Dateien künstlich aufzublähen.
5. Archivist Runtime als Referenzmuster dokumentieren.

#### Priorität B – Migration aus realer Arbeit

6. Brand-/Merch-Learnings vollständig kanonisieren.
7. Archivwissen sichtbar in das Second-Brain-Modell einbinden, ohne die bestehenden Drive-Register zu duplizieren.
8. Homepage-/Kommunikationswissen und Matchday-Wissen einordnen.
9. Funding und Sponsoring als bereits fortgeschrittene Second-Brain-Domänen an das Routing-Modell anschließen.
10. Projektportfolio mit Rollen-/Knowledge-/Decision-Referenzen anreichern, wo dies echten Navigationsnutzen bringt.

#### Priorität C – Runtime-Ausbau

11. Funding Radar Loop definieren.
12. Project Portfolio Review Loop definieren.
13. Sponsoring Loop definieren.
14. Matchday Loop definieren.
15. Weitere Loops nur aus realem Bedarf ableiten.

---

## Relationship to other documents

Dieses Inventory ordnet insbesondere folgende bestehende Bereiche ein, ersetzt sie aber nicht:

- `../README.md`
- `../organization/organization-model.md`
- `../organization/organization-dna.md`
- `../core/core-principles.md`
- `knowledge-graph.md`
- `platform-architecture.md`
- `../roles/README.md`
- `../standards/employee-operating-standard.md`
- `../standards/employee-runtime-standard.md`
- `../standards/learning-loop.md`
- `../projects/PROJECT-PORTFOLIO.md`
- `../decisions/`
- `../knowledge/`

## Future Development

Dieses Dokument bleibt die **Inventur- und Reifegradkarte** des TuS-OS.

Es wird nicht zum Handbuch mit allen Details ausgebaut. Sobald Second Brain, Skill-Katalog, Memory Router oder weitere Runtime-Muster eigene stabile Standards erhalten, verweist dieses Inventory auf diese Quellen und bewertet nur noch Bestand, Reife, Lücken und nächste strukturelle Schritte.

Langfristiges Ziel:

> **Chats dürfen wechseln. Mitarbeiter dürfen wechseln. Tools dürfen wechseln. Das Wissen, die Entscheidungen und die Arbeitsfähigkeit der TuS Digital Organisation bleiben erhalten.**
