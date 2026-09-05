# PROJECT STATE – Aufbau Digitale Vereinsorganisation

**Stand:** 2026-09-05  
**Status:** Aktiv  
**Phase:** Aufbau / Konsolidierung  
**Fachlicher Bereich:** Vereinsentwicklung / Digitalisierung  
**Fachlicher Projekt-Owner:** noch nicht explizit benannt

## Purpose

Dieses Dokument ist der verbindliche Einstiegspunkt für den aktuellen Stand des Projekts **Aufbau Digitale Vereinsorganisation**.

Es dokumentiert die abgrenzbare Aufbauphase der TuS Digital Organisation und trennt sie vom späteren dauerhaften Betrieb.

## Core Principle

> **Das Projekt baut die Organisation auf. Die Organisation selbst bleibt danach bestehen.**

Die digitale Vereinsorganisation wird nicht als einzelnes Softwareprojekt verstanden. Sie verbindet Organisationsmodell, Verantwortlichkeiten, Rollen, Mitarbeiter, Wissen, Prozesse, Standards und Werkzeuge.

## Main Content

### 1. Ausgangslage

Der TuS baut seit 2026 eine digitale Vereinsorganisation auf, die Ehrenamtliche entlasten, Wissen dauerhaft sichern und Verantwortlichkeiten unabhängig von einzelnen Personen oder Technologien erhalten soll.

Bereits real vorhanden sind:

- ein umfangreiches GitHub-Repository als Organisations- und Wissensbasis,
- Vision, Kultur, Werte und Organisationsprinzipien,
- Organisationsmodell und Organigramm,
- Plattform- und Wissensarchitektur,
- gemeinsame Mitarbeiter- und Arbeitsstandards,
- ein Rollenmodell mit mehreren real eingesetzten Fachrollen,
- ein Projektportfolio und formale Projektzustände,
- erste aktive bzw. formalisierte digitale Fachprojekte,
- ein zentraler Google-Drive-Artefaktraum für große Projektdateien.

Das Vorhaben ist damit über eine lose Idee hinaus und befindet sich in einer realen Aufbau- und Konsolidierungsphase.

### 2. Projektabgrenzung

Das Projekt umfasst den Aufbau der organisationsweiten Grundlagen.

Es umfasst insbesondere:

- Organisationsmodell,
- Verantwortungsbereiche,
- Rollenmodell,
- Modell für digitale Mitarbeiter,
- gemeinsame Standards,
- Wissens- und Entscheidungsstruktur,
- Projektgovernance,
- fachliche Plattformarchitektur,
- Single-Source-of-Truth-Prinzipien,
- Pilotierung der Arbeitsweise an realen Vereinsaufgaben,
- Übergabe der geschaffenen Grundlagen in den Regelbetrieb.

Nicht Bestandteil dieses Projekts ist die vollständige fachliche Umsetzung aller einzelnen digitalen Produkte. Event Planner, Partnerportal, Partner Hub, Team Manager und andere Fachprojekte behalten ihre eigenen Projektzustände.

### 3. Verbindliche vorhandene Grundlagen

#### Organisation

- `../../organization/organization-model.md`
- `../../organization/organization-chart.md`
- `../../organization/organization-principles.md`
- weitere Kultur-, Werte- und Leitprinzipiendokumente unter `../../organization/`

Zentrales Organisationsprinzip:

> **Wir bauen keine Hierarchie aus Mitarbeitern. Wir bauen ein Netzwerk aus Verantwortlichkeiten.**

#### Rollen und Mitarbeiter

- `../../roles/README.md`
- `../../employees/README.md`
- `../../decisions/ADR-0001-role-and-employee-separation.md`

Verbindliche Trennung:

- Rolle = dauerhafte Verantwortung,
- Mitarbeiter = konkrete Besetzung einer oder mehrerer Rollen,
- Chat = mögliche Arbeitsoberfläche, aber nicht der Mitarbeiter selbst.

#### Architektur und Wissen

- `../../architecture/platform-architecture.md`
- `../../architecture/knowledge-graph.md`
- `../../architecture/stability-and-simplicity.md`
- `../../system/system-overview.md`

Kernprinzipien:

- zentrale Informationen besitzen eine fachliche Quelle der Wahrheit,
- Fachsysteme erzeugen keine unabhängigen Datenwelten,
- Oberflächen bestimmen nicht das Datenmodell,
- Werkzeuge sind austauschbar,
- Wissen und Beziehungen sollen langfristig Organisationsgedächtnis bilden.

#### Arbeitsstandards

- `../../standards/employee-operating-standard.md`
- `../../standards/approval-and-escalation.md`
- `../../standards/learning-loop.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/working-standards.md`

### 4. Aktuelle visuelle Projektgrundlage

Google-Drive-Projektordner:

https://drive.google.com/drive/folders/16amdo-rcajXYGY2ZaD00KAMC-YLMsE-F

Aktuelles Artefakt:

- `TuS_Digitale_Organisation.png`

Die Grafik vom 05.09.2026 ist der derzeit neueste visuelle Arbeitsstand.

Sie zeigt unter anderem:

- TuS Mingolsheim als organisatorischen Rahmen,
- eine gemeinsame Organisationsplattform,
- mehrere fachliche Verantwortungsbereiche,
- konkrete digitale Mitarbeiter bzw. Spezialisten,
- die digitale Organisation als Netzwerk und nicht als klassische Hierarchie.

Die Grafik ist nicht automatisch die fachliche Source of Truth. Wenn Grafik und Repository voneinander abweichen, wird die Abweichung geprüft und bewusst aufgelöst.

### 5. Abgleich Grafik ↔ GitHub

Der grundlegende Ansatz ist konsistent:

- Netzwerk aus Verantwortlichkeiten statt Mitarbeiterhierarchie,
- Menschen und digitale Mitarbeiter arbeiten gemeinsam,
- Verantwortung besteht unabhängig von der Person,
- Wissen gehört der Organisation,
- Prozesse verbinden Verantwortungsbereiche,
- Werkzeuge unterstützen die Organisation und können ersetzt werden.

Aktuell erkannte Abweichungen bzw. Pflegepunkte:

1. Die Drive-Grafik ist neuer als die alte `organization/organization-map.png` im Repository.
2. Die Grafik vermischt teilweise Verantwortungsbereiche, Rollen und konkrete Mitarbeiter.
3. `system/system-overview.md` bildet ältere Plugin-/Systembegriffe ab und ist nicht vollständig mit dem heutigen Projektstand synchronisiert.
4. `employees/` enthält bislang nur wenige konkrete Mitarbeiterakten, obwohl inzwischen mehrere dauerhaft benannte digitale Rollen real eingesetzt werden.
5. Das Root-README zeigt eine vereinfachte Vier-Ebenen-Darstellung, während `organization-model.md` fünf Organisationsebenen beschreibt. Dies ist nicht zwingend ein Widerspruch, sollte aber als vereinfachte Darstellung eindeutig bleiben.

### 6. Bereits erreichte Aufbauleistungen

Bereits umgesetzt bzw. organisationsweit eingeführt sind unter anderem:

- zentrales Repository für Organisationswissen,
- Organisationsvision und -prinzipien,
- Rollen-/Mitarbeiter-Trennung,
- gemeinsame Arbeitsstandards,
- Approval- und Learning-Loop-Logik,
- zentrale Design- und Entwicklungsstandards,
- dauerhafte Fachrollen für Entwicklung, Archiv, Design, Sponsoring, Funding und Projektportfolio,
- zentrales Projektportfolio,
- dezentrale `PROJECT-STATE.md` als Projektgedächtnis,
- zentrale Ablagelogik GitHub ↔ Google Drive,
- fachliche Plattformarchitektur und Knowledge-Graph-Zielbild.

### 7. Aktuelle Lücken / offene Arbeitspakete

#### AP1 – Organisationsmodell konsolidieren

- neue visuelle Organisationsdarstellung mit GitHub-Begriffen abgleichen,
- Verantwortungsbereiche, Rollen und konkrete Mitarbeiter visuell sauber trennen,
- `organization-map.png` bzw. visuelle Referenz aktualisieren, wenn fachlich freigegeben.

#### AP2 – Mitarbeiterabbildung konkretisieren

- dauerhaft benannte digitale Mitarbeiter den vorhandenen Rollen zuordnen,
- nur dort Mitarbeiterakten anlegen, wo reale Nutzung dies rechtfertigt,
- keine rollenspezifischen Standards in Mitarbeiterakten duplizieren.

#### AP3 – Systemübersicht aktualisieren

- `system/system-overview.md` mit realen heutigen Projekten und Systemgrenzen synchronisieren,
- alte Platzhalter-/Pluginbegriffe nur weiterführen, wenn sie weiterhin fachlich gelten.

#### AP4 – minimale Betriebsarchitektur konkretisieren

- festlegen, welche Systeme welche Verantwortung besitzen,
- Daten-/Wissensquellen und Integrationsgrenzen klar halten,
- Automatisierungen und technische Orchestrierung nur dort konkretisieren, wo reale Prozesse dies benötigen,
- Austauschbarkeit von Werkzeugen erhalten.

#### AP5 – Wirkung und Pilotierung

- reale Arbeitsfälle dokumentieren,
- Zeitersparnis, weniger Doppelpflege, schnelleren Wissenstransfer oder andere Nutzenindikatoren erfassen,
- daraus belastbare Wirkungsargumente für Vorstand, Mitglieder und mögliche Fördergeber ableiten.

#### AP6 – Förderprojekt schärfen

- geeignete Förderprogramme identifizieren,
- prüfen, ob ein Gesamtprojekt oder ein klar abgegrenztes Teilprojekt sinnvoller ist,
- förderfähige Leistungen, Projektzeitraum, Budget und Eigenanteil definieren,
- messbare Ergebnisse und Zielgruppen beschreiben,
- vor förderschädlichem Vorhabenbeginn Förderbedingungen prüfen.

### 8. Förderrelevanz – aktueller Stand

Der Nutzer möchte das Projekt ausdrücklich formal führen, weil **mögliche Fördermittel** für den weiteren Aufbau geprüft werden sollen.

Damit ist das Projekt ab sofort für den Funding & Grants Manager als reales TuS-Projekt relevant.

Noch nicht geklärt und daher **nicht behauptet** werden:

- konkretes Förderprogramm,
- konkrete Förderquote,
- Antragsberechtigung,
- förderfähige Kosten,
- Projektbudget,
- Projektbeginn und Projektende,
- Bewilligungswahrscheinlichkeit.

Für Förderanträge sollte das breite Organisationsprogramm gegebenenfalls in ein klar messbares Teilvorhaben geschnitten werden, zum Beispiel anhand definierter Arbeitspakete und Pilotbereiche. Die Auswahl eines solchen Zuschnitts erfolgt erst nach Programmanalyse.

### 9. Abhängigkeiten

Das Projekt wirkt organisationsweit und hat deshalb Verbindungen zu praktisch allen Fachprojekten.

Besonders relevant sind:

- Funding & Grants Manager – Förderprüfung und mögliche Antragserstellung,
- Project Portfolio Manager – Projekttransparenz und Abgrenzung,
- WordPress Developer – technische Umsetzungen und gemeinsame Architektur,
- Datenschutz & IT – Daten, Berechtigungen und Systemgrenzen,
- alle Fachrollen – reale Pilotierung und Organisationslernen,
- Vorstand / fachliche Entscheidungsträger – Prioritäten, Freigaben und mögliche Finanzierung.

### 10. Projektrisiken

- das Projekt wird zu breit und verliert einen klaren Abschluss,
- laufender Organisationsbetrieb wird mit förderfähiger Aufbauarbeit vermischt,
- einzelne Fachprojekte werden doppelt im Gesamtprojekt gesteuert,
- Rollen, Mitarbeiter und Verantwortungsbereiche werden wieder vermischt,
- zu viele Tools oder Integrationen erhöhen Komplexität statt Nutzen,
- Förderlogik bestimmt die Organisation statt umgekehrt,
- bereits begonnene Leistungen können bei einzelnen Programmen nicht mehr förderfähig sein.

### 11. Nächster sinnvoller Schritt

1. Funding & Grants Manager soll das Projekt gegen aktuelle Förderprogramme spiegeln.
2. Dabei zunächst **keinen Antrag erzwingen**, sondern geeignete Förderlogiken und mögliche Teilprojekte identifizieren.
3. Parallel den aktuellen Aufbauzustand in wenige messbare Arbeitspakete mit Ziel, Ergebnis, Aufwand und offenem Budget strukturieren.
4. Erst danach entscheiden, ob das Gesamtprojekt oder ein Teilprojekt als Förderantrag weiterentwickelt wird.

## Relationship to other documents

- `README.md`
- `../PROJECT-PORTFOLIO.md`
- `../../vision/vision.md`
- `../../organization/organization-model.md`
- `../../organization/organization-chart.md`
- `../../roles/README.md`
- `../../employees/README.md`
- `../../system/system-overview.md`
- `../../architecture/platform-architecture.md`
- `../../architecture/knowledge-graph.md`
- `../../architecture/stability-and-simplicity.md`
- `../../standards/employee-operating-standard.md`
- `../../decisions/ADR-0001-role-and-employee-separation.md`
- `../../decisions/ADR-0007-central-project-portfolio.md`
- `../../knowledge/funding/CURRENT-STATE.md`
- `../../knowledge/funding/FUNDING-CALENDAR.md`

## Future Development

Der Projektzustand wird aktualisiert, wenn sich mindestens eines ändert:

- fachlicher Projekt-Owner,
- Projektzuschnitt,
- Arbeitspakete,
- Förderprogramm oder Förderstrategie,
- Budget / Finanzierung,
- technische Betriebsarchitektur,
- relevante Pilotierung,
- Abschlusskriterien oder Übergang in den Regelbetrieb.