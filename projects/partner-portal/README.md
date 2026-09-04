# TuS Partnerportal

## Purpose

Dieses Projekt entwickelt das WordPress-basierte Partnerportal des TuS Mingolsheim.

Das Portal soll Sponsoring, Partnerpflege, Kampagnen, Projekte und Anfragen in einer gemeinsamen, einfach bedienbaren Frontend-Anwendung organisieren.

Die tägliche Vereinsarbeit findet **nicht im WordPress-Backend** statt.

## Core Principle

> **Frontend zuerst. Deutsch. Selbsterklärend. So einfach wie möglich.**

Das Partnerportal soll sich wie eine moderne, ruhige und hochwertige Web-Anwendung anfühlen und nicht wie ein typisches WordPress-Plugin.

Jede Funktion muss mindestens eines leisten:

- Zeit sparen
- Doppelpflege vermeiden
- Orientierung verbessern
- Partnerbeziehungen verbessern
- Informationen sinnvoll miteinander verknüpfen

Funktionsfülle ohne klaren Nutzen wird vermieden.

## Main Content

### 1. Nutzerbereiche

#### Öffentlich

Eine öffentliche Partner-Landingpage soll Unternehmen verständlich zeigen, welche Formen einer Partnerschaft möglich sind.

Der Einstieg erfolgt bevorzugt über die Frage:

> **Was möchten Sie mit einer Partnerschaft erreichen?**

Mögliche Ziele:

- Bekanntheit steigern
- Kunden erreichen
- Mitarbeiter oder Auszubildende gewinnen
- Mitarbeiter binden
- Arbeitgeberimage stärken
- gesellschaftliche Wirkung erzielen
- Netzwerk aufbauen

Unternehmen sollen ihre Wünsche und Ideen über eine interaktive Anfrage übermitteln können.

Diese Anfrage soll direkt in die interne Partnerarbeit übergehen und keine isolierte E-Mail-Insel erzeugen.

#### Internes TuS-Team

Nach Login stehen unter anderem zur Verfügung:

- Partner und Interessenten
- Partner Journey
- nächste Aufgaben und Wiedervorlagen
- Partnerziele
- Partnerprodukte
- Assets und Werbeflächen
- Events
- Projekte
- Kampagnen
- Leistungs- und Beziehungshistorie
- Auswertung und Wirkung

#### Bestehende Partner – spätere Ausbaustufe

Perspektivisch kann ein persönlicher Partnerbereich entstehen, zum Beispiel für:

- Stammdaten
- Logos und Medien
- vereinbarte Leistungen
- geplante Aktivierungen
- Feedback
- Veranstaltungsanfragen
- Wirkung und Auswertung

Dieser Bereich gehört nicht zwingend zum ersten Entwicklungsstand.

### 2. Zentrale fachliche Objekte

Das Portal soll mit wenigen stabilen Objekten arbeiten:

- Partner / Unternehmen
- Ansprechpartner
- Partnerschaft / Vereinbarung
- historische Leistung
- Partnerprodukt
- Asset
- Event
- Projekt
- Kampagne
- Aufgabe / Aktivität

Neue Anforderungen werden bevorzugt durch Beziehungen zwischen diesen Objekten gelöst und nicht automatisch durch neue Module.

### 3. Partner Journey

Die Journey wird vollständig auf Deutsch abgebildet:

1. Zielunternehmen
2. Qualifizieren
3. Erstkontakt
4. Bedarfsanalyse
5. Partnerkonzept
6. Angebot
7. Vereinbarung
8. Einführung
9. Aktivierung
10. Beziehung
11. Wirkung
12. Verlängerung / Ausbau

Ein Soft Exit kann eine kleine Unterstützung, einen Sachpreis, eine Tombola, eine Einzelaktion oder eine Wiedervorlage auslösen.

### 4. Kampagnen

Eine Kampagne verbindet vorhandene Daten und soll mit wenigen Eingaben angelegt werden.

Minimal erforderlich:

- Name
- Ziel
- Partner
- Zeitraum
- Event oder Projekt
- Aktivierungen
- Verantwortlicher

Vorhandene Partner-, Event-, Projekt- und Assetdaten werden wiederverwendet.

Kampagnentypen:

- bestehendes TuS-Event mit Partner
- Partner-Event auf dem TuS-Gelände
- gemeinsames Projekt oder Arbeitseinsatz

### 5. Historie und Migration

Bestehende Sponsoringdaten werden nicht nur als aktueller Stand übernommen.

Historische Quellen zu Bandenwerbung, Plakatwerbung und Stadionheft sollen je Unternehmen zusammengeführt werden.

Dadurch werden unter anderem sichtbar:

- Partner seit
- historische Leistungen
- Umsatzentwicklung
- frühere Werbearten
- Unterbrechungen
- aktuelle Partnerschaft

Vertrauliche Finanz- und Vertragsdetails werden im geschützten System gespeichert und nicht im öffentlichen Repository.

### 6. UX- und UI-Standard

Verbindlich sind insbesondere:

- komplette Nutzeroberfläche auf Deutsch
- klare, moderne und ruhige Gestaltung
- verständliche Begriffe statt unnötiger Fachsprache
- wenige Schritte je Aufgabe
- mobile Nutzbarkeit
- konsistente Komponenten
- sinnvolle Voreinstellungen
- keine unnötigen Felder
- keine Doppelpflege
- WordPress-Backend nur für technische Administration

### 7. Bewusste Nicht-Ziele für den ersten Stand

Der erste Entwicklungsstand soll nicht gleichzeitig werden zu:

- Buchhaltungssoftware
- vollständiger Rechnungssoftware
- Steuerberechnungsprogramm
- LED-Steuerung
- Social-Media-Automatisierung
- vollautomatischem Vertragsgenerator
- komplexem Self-Service-Portal für Partner

Der erste Stand soll die **Partnerarbeit zuverlässig organisieren**.

## Relationship to other documents

- `PROJECT-STATE.md`
- `../../knowledge/sponsoring/README.md`
- `../../architecture/stability-and-simplicity.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/iteration-and-progress.md`

## Future Development

Vor Beginn der Implementierung werden Datenmodell, zentrale Ansichten und MVP-Umfang kompakt festgelegt.

Ein neuer Entwickler oder Coding-Chat liest vor Arbeitsbeginn mindestens:

1. `PROJECT-STATE.md`
2. `README.md`
3. `../../knowledge/sponsoring/README.md`
4. `../../roles/wordpress-developer/role.md`
5. `../../roles/wordpress-developer/development-standard.md`
6. `../../architecture/stability-and-simplicity.md`
7. `../../design/design-principles.md`
8. `../../design/ui-standard.md`
9. `../../standards/iteration-and-progress.md`

Neue Funktionen werden erst ergänzt, wenn ihr praktischer Nutzen den zusätzlichen Bedien- und Wartungsaufwand rechtfertigt.