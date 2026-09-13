# Sportpark – Current State

**Status:** operativer Wissensbereich im Aufbau  
**Stand:** 2026-09-13

## Purpose

Dieses Dokument hält den aktuellen nicht-sensitiven Arbeitsstand für wiederkehrende Sportpark-Aufgaben, Instandhaltung, Material- und Versorgungsbedarfe fest.

Ziel ist, kleine reale Aufgaben nicht unnötig zu eigenständigen Projekten aufzublähen, sie aber trotzdem so zu dokumentieren, dass sie nicht verloren gehen und später in einen verlässlichen Sportpark-Operations-Loop überführt werden können.

## Core Principle

> **Kleine Sportpark-Arbeit wird operativ gesteuert. Ein eigenes Projekt entsteht nur, wenn Umfang, Risiko, Investition oder Abhängigkeiten dies wirklich rechtfertigen.**

Eine Aufgabe soll möglichst mit Ort, Bedarf, Material, Verantwortlichkeit, Termin, Status und Kostenbezug nachvollziehbar sein.

## Main Content

### 1. Zielbild Sportpark Operations

Der Sportpark benötigt perspektivisch einen einfachen gemeinsamen Arbeitsbereich für wiederkehrende Aufgaben.

Dazu gehören insbesondere:

- Instandhaltungs- und Reparaturaufgaben,
- Platz-/Pflegeaufgaben,
- Aufgaben für 1-Euro-Jobber bzw. operative Helfer,
- Stunden-/Leistungsnachweis, soweit erforderlich,
- Materialbedarf,
- Bestands- und Mindestbestandslogik,
- Beschaffung und Angebotsprüfung,
- Wetterbezug bei geeigneten Außenaufgaben,
- Status und Erledigungsnachweis.

Noch nicht entschieden ist, ob dieser Bereich als eigenes WordPress-Modul, als Teil einer breiteren Vereinsoperations-Lösung oder in anderer Form umgesetzt wird.

### 2. Verbindung zur Beschaffung

Sportpark-Aufgaben sollen nicht parallel eine zweite Beschaffungsdatenbank aufbauen.

Wenn eine Aufgabe Material benötigt, soll sie später auf denselben gemeinsamen Artikel-/Lieferanten-/Preisbezug zugreifen können, der auch für Event Planner, Kiosk und Materialwart vorgesehen ist.

Beispiel:

`Aufgabe gemeldet -> Materialbedarf bestimmen -> Bestand prüfen -> Preis/Lieferant prüfen -> Freigabe -> Beschaffung -> Aufgabe ausführen -> Erledigung dokumentieren`

Kostenpflichtige Bestellungen bleiben menschlich freizugeben.

### 3. Erster konkreter Pilotfall – Raucher-/Gruppenraum streichen

Im Sportpark gibt es einen Raucher-/Gruppenraum mit TV. Der Raum soll gestrichen werden.

Einordnung:

- **kein eigenständiges Projekt**, solange kein größerer Sanierungs-, Budget- oder Genehmigungsumfang entsteht,
- normale Sportpark-Instandhaltungsaufgabe,
- geeignet als erster realer Pilotfall für die spätere Task-/Material-/Beschaffungslogik.

Vor Ausführung sollen mindestens geprüft bzw. erfasst werden:

- Wandflächen / Raumgröße soweit für Materialbedarf nötig,
- aktueller Zustand der Wände,
- gewünschte Farbe,
- ob nur Wände oder auch Decke gestrichen werden,
- notwendige Vorarbeiten,
- Grundierung nötig ja/nein,
- benötigte Farbmenge,
- Abdeckmaterial,
- Klebeband,
- Rollen / Pinsel / Verlängerung,
- Spachtel-/Ausbesserungsmaterial, falls erforderlich,
- Verantwortlicher für Durchführung,
- gewünschter Ausführungstermin,
- Materialbestand bereits vorhanden ja/nein,
- erwartete bzw. tatsächliche Kosten.

Der vorhandene TV und sonstige Einrichtungsgegenstände müssen vor den Arbeiten geschützt bzw. aus dem Arbeitsbereich entfernt werden.

### 4. Vorstand / Eskalation

Der Gruppenraum-Streichauftrag gehört nicht auf eine Vorstandssitzung, solange keine wesentliche Budget-, Nutzungs-, Sanierungs- oder Grundsatzentscheidung erforderlich ist.

Der Vorstand wird erst eingebunden, wenn beispielsweise:

- ein relevanter Budgetrahmen überschritten wird,
- größere bauliche Mängel sichtbar werden,
- eine Nutzungsänderung geplant wird,
- mehrere Gewerke oder externe Fachfirmen erforderlich werden,
- rechtliche, sicherheitsbezogene oder genehmigungsrelevante Fragen entstehen.

### 5. Späterer Runtime-/n8n-Kontext

Ein zukünftiger Sportpark-Loop kann Aufgaben aus unterschiedlichen Triggern übernehmen, zum Beispiel:

- manuell gemeldeter Mangel,
- wiederkehrende Wartung,
- Wetterlage,
- Mindestbestand,
- Veranstaltung oder Heimspiel,
- Kontrolltermin.

Möglicher Ablauf:

`Trigger -> Aufgabe klassifizieren -> Priorität bestimmen -> Material/Abhängigkeiten prüfen -> Owner zuweisen -> Ausführung -> Prüfung -> Status aktualisieren -> nächste Aufgabe`

n8n kann Trigger, Erinnerungen und Datentransport übernehmen. Die fachliche Aufgabe und ihr Status benötigen eine dauerhafte operative Source of Truth.

## Relationship to other documents

- `../../roles/ROLE-CANDIDATES.md` – offene organisatorische Einordnung von Sportpark, Materialwart und Beschaffung,
- `../../projects/event-planner/PROCUREMENT-PRICE-LISTS.md` – geplanter gemeinsamer Artikel-/Lieferanten-/Preislistenbezug für Beschaffung,
- `../../standards/employee-runtime-standard.md` – Grundlogik für später autonome Arbeitsloops,
- `../governance/CURRENT-STATE.md` – Trennung zwischen operativer Arbeit und vorstandsrelevanter Steuerung.

## Future Development

Der nächste Schritt ist nicht sofort Softwareentwicklung.

Zunächst werden reale Sportpark-Aufgaben wie der Gruppenraum erfasst und abgearbeitet. Daraus wird sichtbar, welche Felder, Statuswerte, Verantwortlichkeiten, Materialverknüpfungen und Automationen tatsächlich gebraucht werden.

Wenn mehrere reale Aufgaben dieses Muster bestätigen, wird daraus die kleinste robuste Sportpark-Operations-Lösung spezifiziert.