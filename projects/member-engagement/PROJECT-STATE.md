# TuS Mitglieder & Engagement – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für das TuS Mitglieder- und Engagement-Modul.

Sie dokumentiert aktuellen Stand, offene Architekturfragen und den nächsten sinnvollen Schritt. Sie ist kein Aktivitätstagebuch.

## Current Goal

Das fachliche Zielbild ist definiert. Vor Plugin-Code muss geklärt werden, wie die bestehende Mitgliederverwaltung angebunden wird und wie eine gemeinsame Personen-/Mitgliedsidentität für Event Planner, Team Manager und dieses Modul bereitgestellt wird.

## Current Repository State

Projektpfad:

`projects/member-engagement/`

Aktueller Stand:

- noch kein Plugin-Code,
- noch keine produktive Personendatenbank,
- noch kein Abgleich zur bestehenden Mitgliederverwaltung,
- fachlicher Scope in `FUNCTIONAL-SCOPE.md` dokumentiert.

## Verified

- Eine vollständige neue Mitgliederverwaltung ist aktuell **nicht** als Startziel beschlossen.
- Die bestehende Mitgliederverwaltung bleibt zunächst Quelle für Mitgliedschaft, Stammdaten und Beitragsstatus.
- Das neue Modul ergänzt die operative Sicht auf Vereinszugehörigkeit, Engagement, Helfereinsätze, Stundenkonto und Soll-Erfüllung.
- Der Event Planner bleibt fachliche Quelle für konkrete Helferschichten und tatsächlich geleistete Schichtzeiten.
- Das Mitglieder- und Engagement-Modul aggregiert diese Daten personengebunden und periodenbezogen.
- Ein Jahresplan soll Mannschaften, Abteilungen und Gruppen frühzeitig transparent machen, welche Helferaufgaben im Jahresverlauf auf sie zukommen.
- Helferschichten sollen gezielt an Gruppen verteilt werden können, ohne unnötige zusätzliche Registrierung.
- Eine Rabatt-/Nachlass-Berechtigung kann aus anerkannten Stunden und Soll-Regeln ermittelt werden.
- Die tatsächliche Beitragsänderung erfolgt zunächst nicht automatisch, sondern über einen geprüften Abgleich mit der bestehenden Mitgliederverwaltung.

## Open Architecture Questions

### 1. Bestehende Mitgliederverwaltung

Vor Implementierung muss das aktuell verwendete System konkret analysiert werden:

- Welche Daten enthält es?
- Gibt es stabile IDs?
- Welche Export-/Importmöglichkeiten gibt es?
- Gibt es eine API?
- Welche beitragsrelevanten Informationen müssen dort verbleiben?
- Wie werden Änderungen und Konflikte erkannt?

### 2. Gemeinsame Personenidentität

Event Planner, Team Manager und Mitglieder-Modul dürfen nicht jeweils eigene Personendatensätze unabhängig voneinander aufbauen.

Es muss entschieden werden, wo die stabile gemeinsame Person-/Mitgliedsidentität liegt und welche Module sie nur referenzieren.

Diese Entscheidung ist architekturweit relevant und wird vor Implementierung dokumentiert.

### 3. Mannschaften, Abteilungen und Gruppen

Zu klären ist, welche Zuordnungen aus dem Team Manager bzw. einer gemeinsamen Organisationsstruktur kommen und welche im Mitglieder-Modul gepflegt werden.

Doppelpflege ist zu vermeiden.

### 4. Helfer-Jahresplan

Zu klären ist die technische Darstellung des Jahresplans.

Fachlich gilt bereits:

- konkrete Schichten gehören zum Event Planner,
- die Jahresübersicht bündelt Helferbedarf über Events,
- Verantwortlichkeiten können Mannschaften, Abteilungen oder Gruppen zugeordnet werden.

### 5. Zugang für Mitglieder

Zu entscheiden ist, wie Mitglieder offene Schichten und ihr Stundenkonto sicher und einfach erreichen:

- klassisches Konto,
- Magic Link,
- Gruppenlink mit zusätzlicher Personenidentifikation,
- andere einfache Lösung.

Eine zusätzliche Registrierung wird nicht ohne klaren Nutzen eingeführt.

### 6. Soll-Regeln

Vor Implementierung muss der Verein die fachliche Regel bestimmen, unter anderem:

- Anzahl Sollstunden,
- Bemessungszeitraum,
- betroffene Mitgliedsgruppen,
- Altersgrenzen,
- Familien-/Haushaltsregelungen, falls relevant,
- Ausnahmen/Befreiungen,
- Umgang mit zusätzlichen Stunden.

Diese Regeln werden nicht im Code versteckt, sondern nachvollziehbar konfiguriert und historisiert.

### 7. Beitragsnachlass

Zu klären sind:

- Art und Höhe des Nachlasses,
- Zeitpunkt der Ermittlung,
- Freigabeprozess,
- Export-/Abgleichformat,
- spätere mögliche Schnittstelle zur Mitgliederverwaltung.

Keine automatische Beitragsänderung ohne menschliche Freigabe und ausdrücklich beschlossenen Prozess.

### 8. Datenschutz

Vor Speicherung personenbezogener Engagement-Daten müssen Rollen, Sichtbarkeit, Lösch-/Aufbewahrungsregeln und Protokollierung definiert werden.

## Excluded / Not Intended

Für die erste Ausbaustufe nicht vorgesehen:

- vollständiger Beitragseinzug,
- SEPA-Verwaltung,
- Eintritts-/Austrittsprozess als Ersatz des bestehenden Systems,
- komplette Vereinsbuchhaltung,
- zweite unabhängige Helferschichtplanung,
- doppelte Mannschafts-/Personenlisten,
- automatische Beitragsänderungen ohne Prüfung.

## Relevant Decisions & Standards

- `FUNCTIONAL-SCOPE.md`
- `README.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../team-manager/`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../design/ui-standard.md`
- `../../decisions/`

## Next Meaningful Step

Vor dem ersten Plugin-Code:

1. aktuelle Mitgliederverwaltung mit Datenfeldern und Export-/Schnittstellenmöglichkeiten analysieren,
2. gemeinsame Person-/Mitgliedsidentität als Architekturentscheidung definieren,
3. Verantwortungsgrenze Event Planner ↔ Mitglieder-Modul technisch festlegen,
4. minimales Abgleichmodell für Mitglied + Mannschaft/Abteilung + Helferstunden definieren,
5. erst danach MVP-Scope und Testumgebung aufsetzen.

## Update Rule

Diese Datei wird aktualisiert, wenn sich Ziel, Architekturentscheidung, aktiver Entwicklungsstand, Risiko, Last Known Good oder nächster sinnvoller Schritt ändert.
