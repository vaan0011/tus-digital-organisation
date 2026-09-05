# TuS Partner Hub – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für den TuS Partner Hub.

Sie dokumentiert den aktuellen Stand, offene Architekturfragen und den nächsten sinnvollen Schritt. Sie ist kein Aktivitätstagebuch.

## Current Goal

Das fachliche Zielbild ist definiert. Vor der technischen Implementierung müssen die gemeinsame Datenbasis, Rollen/Freigaben und die Schnittstellen zu bestehenden TuS-Systemen geklärt werden.

## Current Repository State

Projektpfad:

`projects/partner-hub/`

Aktueller Stand:

- noch kein Plugin-Code,
- noch keine produktive Datenstruktur,
- noch keine Login-/Rollenimplementierung,
- fachlicher Scope in `FUNCTIONAL-SCOPE.md` dokumentiert.

## Verified

- Der Partner Hub soll als geschütztes Frontend-Portal mit Login funktionieren.
- Partner benötigen für den laufenden Betrieb keinen WordPress-Backend-Zugriff.
- Die Oberfläche wird vollständig deutsch umgesetzt.
- Einfachheit, wenige Schritte und klar erkennbare nächste Aktionen sind verbindliche UX-Leitplanken.
- Partnerschaft wird als langfristige Zusammenarbeit verstanden, nicht als reine Werbeflächenverwaltung.
- Partner sollen Transparenz über Verwendung und Wirkung ihres Engagements erhalten.
- Angebote, Jobs, Inhalte, Einladungen, Projektbeteiligung und Partnernetzwerk gehören zum fachlichen Zielbild.
- Kampagnen sind als verbindender Baustein für zeitlich begrenzte gemeinsame Aktivitäten vorgesehen.

## Open Architecture Questions

### 1. Zentrale Partnerdaten

Vor Implementierung ist zu entscheiden, welche Partnerdaten als gemeinsame fachliche Quelle außerhalb des Plugins liegen müssen und welche ausschließlich im Partner Hub geführt werden.

Doppelpflege mit späteren Sponsoring-, Website-, Event- oder Kommunikationsfunktionen ist zu vermeiden.

### 2. Login und Rollen

Zu klären sind mindestens:

- Partnerbenutzer und mehrere Ansprechpartner je Unternehmen,
- interne TuS-Rollen,
- Freigaberechte,
- Sichtbarkeit sensibler Daten,
- sicherer Passwort-/Account-Lifecycle.

### 3. Veröffentlichung von Partnerinhalten

Angebote, Jobs und andere öffentliche Partnerinhalte sollen durch Partner vorbereitet werden können.

Der genaue Freigabeprozess vor Veröffentlichung muss festgelegt werden, einschließlich:

- wer freigeben darf,
- welche Inhalte automatisch ablaufen,
- welche Änderungen erneut freigegeben werden müssen.

### 4. Transparenz und Finanzbezug

Der Partner Hub soll verständlich zeigen, wo Engagement eingesetzt wurde und welche Wirkung entstanden ist.

Vor Implementierung ist zu klären, welche Daten aus bestehenden Finanz-/Projektquellen übernommen werden können und welche manuell als partnerbezogene Wirkungsinformation gepflegt werden.

Der Hub baut keine zweite Vereinsbuchhaltung.

### 5. Content- und Medienrechte

Für Bilder, Logos, Status-Badges und Textbausteine müssen Nutzungsrechte, Gültigkeit und Freigaben nachvollziehbar sein.

Offizielle TuS-Markenassets bleiben an `../../design/logo.md` und weitere zentrale Designstandards gebunden.

### 6. Kommunikation und Einladungen

Zu entscheiden ist, ob der Hub selbst E-Mails versendet oder eine gemeinsame zentrale Kommunikationsfunktion der TuS Digital Organisation verwendet.

Keine projektlokale Versandlösung wird vor dieser Entscheidung dauerhaft etabliert.

### 7. Partnernetzwerk

Für die Vernetzung zwischen Partnern müssen Opt-in, Kontaktfreigaben und Vermittlungslogik festgelegt werden.

Es ist ausdrücklich kein vollwertiges soziales Netzwerk oder interner Chat vorgesehen.

### 8. TuS-Projekte und Kampagnen

Vor Implementierung ist zu prüfen, welche Projekt-/Eventdaten aus anderen TuS-Modulen referenziert werden können, damit Projekte, Veranstaltungen und Kampagnen nicht doppelt angelegt werden.

## Excluded / Not Intended

- kein notwendiger WordPress-Backend-Zugriff für Partner,
- kein eigenes soziales Netzwerk mit Feed, Likes oder Chat,
- keine zweite Vereinsbuchhaltung,
- keine unmoderierte automatische Veröffentlichung aller Partnerinhalte,
- keine Funktionssammlung ohne klaren praktischen Nutzen,
- keine doppelte Dateneingabe, wenn Informationen bereits zuverlässig vorhanden sind.

## Relevant Decisions & Standards

- `FUNCTIONAL-SCOPE.md`
- `README.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/approval-and-escalation.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../design/logo.md`
- `../../decisions/`

## Next Meaningful Step

Vor dem ersten Plugin-Code:

1. gemeinsame Partner-Datenquelle und Abgrenzung zu anderen TuS-Modulen definieren,
2. Rollen- und Freigabemodell definieren,
3. minimales Datenmodell für Partnerprofil, Status, Leistungen und Wirkungsübersicht festlegen,
4. daraus einen ersten kleinen MVP-Scope ableiten,
5. erst danach mit Plugin-Gerüst und reproduzierbarer Testumgebung beginnen.

## Update Rule

Diese Datei wird aktualisiert, wenn sich Ziel, Architekturentscheidung, aktiver Entwicklungsstand, Risiko, Last Known Good oder nächster sinnvoller Schritt ändert.
