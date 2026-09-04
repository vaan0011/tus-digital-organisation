# TuS Partner Hub – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für den TuS Partner Hub.

Sie dokumentiert den aktuellen Stand, offene Architekturfragen und den nächsten sinnvollen Schritt. Sie ist kein Aktivitätstagebuch.

## Current Goal

Das fachliche Zielbild ist definiert und die Abgrenzung zum internen Partnerportal ist beschlossen.

Vor der technischen Implementierung müssen insbesondere die gemeinsame Partnerdatenbasis, Rollen/Freigaben und die Schnittstellen zu bestehenden TuS-Systemen geklärt werden.

## Current Repository State

Projektpfad:

`projects/partner-hub/`

Aktueller Stand:

- noch kein Plugin-Code,
- noch keine produktive Datenstruktur,
- noch keine Login-/Rollenimplementierung,
- fachlicher Scope in `FUNCTIONAL-SCOPE.md` dokumentiert,
- Produktabgrenzung zu Partnerportal und öffentlicher Partnerseite in ADR-0006 beschlossen.

## Verified

- Der Partner Hub ist die **partnerseitige Oberfläche für bestehende Partner**.
- Das interne Partnerportal bleibt das **Arbeitswerkzeug des TuS** für Akquise, Journey, Aufgaben, Historie, Partnerprodukte, Assets und interne Kampagnenarbeit.
- Die öffentliche Partnerseite dient der Gewinnung neuer Interessenten und führt strukturierte Anfragen in die interne Partnerarbeit.
- Die drei Zugänge sind keine getrennten Datenwelten, sondern nutzen gemeinsame fachliche Quellen.
- Der Partner Hub funktioniert als geschütztes Frontend-Portal mit Login.
- Partner benötigen für den laufenden Betrieb keinen WordPress-Backend-Zugriff.
- Die Oberfläche wird vollständig deutsch umgesetzt.
- Einfachheit, wenige Schritte und klar erkennbare nächste Aktionen sind verbindliche UX-Leitplanken.
- Partnerschaft wird als langfristige Zusammenarbeit verstanden, nicht als reine Werbeflächenverwaltung.
- Partner sollen ihre priorisierten Unternehmensziele innerhalb der Partnerschaft sehen können.
- Partner sollen Transparenz über Verwendung und Wirkung ihres Engagements erhalten.
- Vereinbarte Leistungen sollen einen einfachen Nutzungs-/Erfüllungsstatus erhalten, damit Leistungen und Möglichkeiten nicht vergessen werden.
- Ein kompakter jährlicher Partner-Check-in soll Wirkung, neue Ziele und Verlängerung miteinander verbinden.
- Angebote, Jobs, Inhalte, Einladungen, Projektbeteiligung und Partnernetzwerk gehören zum fachlichen Zielbild.
- Kampagnen sind als verbindender Baustein für zeitlich begrenzte gemeinsame Aktivitäten vorgesehen.

## Open Architecture Questions

### 1. Gemeinsame Partnerdatenbasis

Vor Implementierung ist festzulegen, wo die fachliche Quelle für Partner, Ansprechpartner, Partnerschaft, Partnerziele, Leistungen und Historie liegt.

Partnerportal und Partner Hub dürfen dafür keine voneinander unabhängigen Kopien pflegen.

### 2. Objektverantwortung zwischen TuS-Modulen

Für gemeinsam genutzte Objekte muss die fachliche Quelle eindeutig sein.

Beispiel:

- Event Planner = fachliche Quelle eines Events,
- Partner Hub = partnerbezogene Ansicht bzw. Beteiligung,
- Homepage = öffentliche Darstellung,
- Partnerportal = interne Partnerarbeit.

Dieselbe Logik ist für Projekte, Kampagnen, Jobs, Angebote und weitere gemeinsame Objekte festzulegen.

### 3. Login und Rollen

Zu klären sind mindestens:

- Partnerbenutzer und mehrere Ansprechpartner je Unternehmen,
- interne TuS-Rollen,
- Freigaberechte,
- Sichtbarkeit sensibler Daten,
- sicherer Passwort-/Account-Lifecycle.

### 4. Veröffentlichung von Partnerinhalten

Angebote, Jobs und andere öffentliche Partnerinhalte sollen durch Partner vorbereitet werden können.

Der genaue Freigabeprozess vor Veröffentlichung muss festgelegt werden, einschließlich:

- wer freigeben darf,
- welche Inhalte automatisch ablaufen,
- welche Änderungen erneut freigegeben werden müssen,
- wie freigegebene Inhalte ohne Doppelpflege auf der Homepage erscheinen.

### 5. Leistungserfüllung

Zu definieren ist ein möglichst kleines gemeinsames Modell für vereinbarte Leistungen und deren Status.

Es soll operative Klarheit schaffen, aber keine zweite Leistungsbuchhaltung erzeugen.

### 6. Transparenz und Finanzbezug

Der Partner Hub soll verständlich zeigen, wo Engagement eingesetzt wurde und welche Wirkung entstanden ist.

Vor Implementierung ist zu klären, welche Daten aus bestehenden Finanz-/Projektquellen übernommen werden können und welche als partnerbezogene Wirkungsinformation gepflegt werden.

Der Hub baut keine zweite Vereinsbuchhaltung.

### 7. Content- und Medienrechte

Für Bilder, Logos, Status-Badges und Textbausteine müssen Nutzungsrechte, Gültigkeit und Freigaben nachvollziehbar sein.

Offizielle TuS-Markenassets bleiben an `../../design/logo.md` und weitere zentrale Designstandards gebunden.

### 8. Kommunikation und Einladungen

Zu entscheiden ist, ob der Hub selbst E-Mails versendet oder eine gemeinsame zentrale Kommunikationsfunktion der TuS Digital Organisation verwendet.

Keine projektlokale Versandlösung wird vor dieser Entscheidung dauerhaft etabliert.

### 9. Partnernetzwerk

Für die Vernetzung zwischen Partnern müssen Opt-in, Kontaktfreigaben und Vermittlungslogik festgelegt werden.

Es ist ausdrücklich kein vollwertiges soziales Netzwerk oder interner Chat vorgesehen.

## Excluded / Not Intended

- kein notwendiger WordPress-Backend-Zugriff für Partner,
- kein eigenes soziales Netzwerk mit Feed, Likes oder Chat,
- keine zweite Vereinsbuchhaltung,
- kein zweites internes CRM neben dem Partnerportal,
- keine unmoderierte automatische Veröffentlichung aller Partnerinhalte,
- keine Funktionssammlung ohne klaren praktischen Nutzen,
- keine doppelte Dateneingabe, wenn Informationen bereits zuverlässig vorhanden sind.

## Relevant Decisions & Standards

- `FUNCTIONAL-SCOPE.md`
- `README.md`
- `../partner-portal/PROJECT-STATE.md`
- `../../decisions/ADR-0006-partnerportal-und-partner-hub-abgrenzung.md`
- `../../roles/partnership-manager/role.md`
- `../../roles/partnership-manager/partnership-standard.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`

## Next Meaningful Step

Vor dem ersten Plugin-Code:

1. gemeinsame Partnerdatenquelle und Objektverantwortung definieren,
2. Rollen- und Freigabemodell definieren,
3. minimales Datenmodell für Partnerprofil, Partnerziele, Leistungen und Erfüllungsstatus festlegen,
4. die Datenübergänge Partnerportal ↔ Partner Hub ↔ Homepage/Event Planner festlegen,
5. daraus einen ersten kleinen MVP-Scope ableiten,
6. erst danach mit Plugin-Gerüst und reproduzierbarer Testumgebung beginnen.

## Update Rule

Diese Datei wird aktualisiert, wenn sich Ziel, Architekturentscheidung, aktiver Entwicklungsstand, Risiko, Last Known Good oder nächster sinnvoller Schritt ändert.
