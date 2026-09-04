# TuS Partnerportal

## Purpose

Dieses Projekt entwickelt das WordPress-basierte **interne Arbeitswerkzeug** für die Partnerarbeit des TuS Mingolsheim.

Das Portal soll Sponsoring, Akquise, Partnerpflege, Kampagnen, Projekte und Anfragen in einer gemeinsamen, einfach bedienbaren Frontend-Anwendung organisieren.

Die tägliche Vereinsarbeit findet **nicht im WordPress-Backend** statt.

Bestehende Partner arbeiten dagegen im separaten, partnerseitigen `Partner Hub`. Beide Bereiche greifen auf gemeinsame fachliche Partnerdaten zurück und erzeugen keine getrennten Datenwelten.

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

### 1. Drei Zugänge – eine gemeinsame Partnerdatenbasis

Die Partnerarbeit besitzt drei klar getrennte Zugänge:

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

#### Internes TuS-Team – Partnerportal

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

#### Bestehende Partner – Partner Hub

Der persönliche Bereich bestehender Partner wird fachlich im Projekt `../partner-hub/` geführt.

Dort sollen Partner unter anderem:

- ihre Partnerschaft und Ziele verstehen,
- vereinbarte und noch nutzbare Leistungen sehen,
- Verwendung und Wirkung ihres Engagements nachvollziehen,
- Jobs und Angebote einbringen,
- Einladungen beantworten,
- freigegebene Inhalte nutzen,
- Projekte und Kampagnen entdecken,
- sich im Partnernetzwerk beteiligen,
- am jährlichen Partner-Check-in teilnehmen.

Die Grundlogik lautet:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

### 2. Zentrale fachliche Objekte

Das Portal soll mit wenigen stabilen Objekten arbeiten:

- Partner / Unternehmen
- Ansprechpartner
- Partnerschaft / Vereinbarung
- Partnerziele
- historische Leistung
- vereinbarte Leistung / Erfüllungsstatus
- Partnerprodukt
- Asset
- Event
- Projekt
- Kampagne
- Aufgabe / Aktivität

Neue Anforderungen werden bevorzugt durch Beziehungen zwischen diesen Objekten gelöst und nicht automatisch durch neue Module.

Partnerportal und Partner Hub verwenden für gemeinsame Objekte dieselbe fachliche Quelle.

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

Partnerziele und Ergebnisse des jährlichen Partner-Check-ins fließen in Bedarfsanalyse, Aktivierung und Verlängerung zurück.

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

### 6. Gemeinsame Objektverantwortung

Gemeinsam genutzte Informationen werden nicht in mehreren TuS-Systemen unabhängig gepflegt.

Beispiele:

- Der Event Planner ist fachliche Quelle eines Events; Partnerportal und Partner Hub referenzieren es.
- Ein im Partner Hub eingereichter und vom TuS freigegebener Job kann auf der Homepage erscheinen, ohne erneut angelegt zu werden.
- Partnerstammdaten, Partnerziele und vereinbarte Leistungen werden zentral geführt und nur kontextbezogen dargestellt.

### 7. UX- und UI-Standard

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

### 8. Bewusste Nicht-Ziele für den ersten Stand

Der erste Entwicklungsstand soll nicht gleichzeitig werden zu:

- Buchhaltungssoftware
- vollständiger Rechnungssoftware
- Steuerberechnungsprogramm
- LED-Steuerung
- Social-Media-Automatisierung
- vollautomatischem Vertragsgenerator
- partnerseitigem Self-Service-Portal; dafür ist der Partner Hub zuständig

Der erste Stand soll die **interne Partnerarbeit zuverlässig organisieren**.

## Relationship to other documents

- `PROJECT-STATE.md`
- `../partner-hub/README.md`
- `../partner-hub/FUNCTIONAL-SCOPE.md`
- `../../knowledge/sponsoring/README.md`
- `../../architecture/stability-and-simplicity.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../decisions/ADR-0007-partnerportal-und-partner-hub-abgrenzung.md`

## Future Development

Vor Beginn der Implementierung werden gemeinsame Partnerdatenbasis, Objektverantwortung, zentrale Ansichten und MVP-Umfang kompakt festgelegt.

Ein neuer Entwickler oder Coding-Chat liest vor Arbeitsbeginn mindestens:

1. `PROJECT-STATE.md`
2. `README.md`
3. `../partner-hub/PROJECT-STATE.md`
4. `../../knowledge/sponsoring/README.md`
5. `../../decisions/ADR-0007-partnerportal-und-partner-hub-abgrenzung.md`
6. `../../roles/wordpress-developer/role.md`
7. `../../roles/wordpress-developer/development-standard.md`
8. `../../architecture/stability-and-simplicity.md`
9. `../../design/design-principles.md`
10. `../../design/ui-standard.md`
11. `../../standards/iteration-and-progress.md`

Neue Funktionen werden erst ergänzt, wenn ihr praktischer Nutzen den zusätzlichen Bedien- und Wartungsaufwand rechtfertigt.
