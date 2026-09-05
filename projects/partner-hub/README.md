# TuS Partner Hub

## Purpose

Der TuS Partner Hub ist die **partnerseitige digitale Oberfläche für bestehende Partner** des TuS Mingolsheim.

Er soll Transparenz schaffen, Partnerschaften aktiv nutzbar machen und die Kommunikation zwischen Verein und Partnern sowie zwischen den Partnern untereinander vereinfachen.

Das interne Arbeitswerkzeug des TuS bleibt das separate `Partnerportal`. Beide Bereiche nutzen gemeinsame fachliche Partnerdaten und erzeugen keine getrennten Datenwelten.

## Core Principle

**Aus Sponsoren werden Partner.**

Der Hub bildet nicht nur Werbeleistungen ab. Er macht sichtbar:

- welche Ziele Partner mit der Partnerschaft verfolgen,
- welchen Beitrag ein Partner leistet,
- welche Wirkung daraus entsteht,
- welche Leistungen bereits genutzt oder erfüllt wurden,
- welche Rechte und Möglichkeiten noch offen sind,
- welche Projekte, Kampagnen, Veranstaltungen oder Kooperationen aktuell passen.

Der Partner arbeitet ausschließlich in einer verständlichen Frontend-Oberfläche mit Login. Für den laufenden Betrieb ist kein Zugriff auf das WordPress-Backend vorgesehen.

Die Prozesslogik lautet:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

## Main Content

Verbindliches fachliches Zielbild:

`FUNCTIONAL-SCOPE.md`

Aktueller Projektstand:

`PROJECT-STATE.md`

Langfristige Produktabgrenzung:

`../../decisions/ADR-0007-partnerportal-und-partner-hub-abgrenzung.md`

Der Functional Scope umfasst insbesondere:

- Partnerprofil und Partnerschaftsübersicht,
- Partnerziele,
- Beitrag, Verwendung und Wirkung,
- Partnerstatus und Partnerrollen,
- Nutzungs-/Erfüllungsstatus vereinbarter Leistungen,
- Angebote und Recruiting,
- Content-Bibliothek,
- Einladungen und Kommunikation,
- Partnernetzwerk,
- Projektbörse,
- Kampagnen,
- jährlichen Partner-Check-in und Weiterentwicklung.

Für Entwicklung und Gestaltung gelten zusätzlich insbesondere:

1. `../../roles/wordpress-developer/role.md`
2. `../../roles/wordpress-developer/development-standard.md`
3. `../../roles/partnership-manager/role.md`
4. `../../roles/partnership-manager/partnership-standard.md`
5. `../../standards/iteration-and-progress.md`
6. `../../standards/approval-and-escalation.md`
7. `../../design/design-principles.md`
8. `../../design/ui-standard.md`
9. `../../design/logo.md`
10. relevante Einträge unter `../../decisions/`

Alle Oberflächen, Felder, Statusbezeichnungen, Navigationen und Arbeitsabläufe des Partner Hubs werden in deutscher Sprache umgesetzt.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md` beschreibt das langfristige fachliche Zielbild.
- `PROJECT-STATE.md` hält nur den aktuellen Entwicklungsstand, offene Architekturfragen und den nächsten sinnvollen Schritt fest.
- `../partner-portal/README.md` beschreibt das interne Arbeitswerkzeug des TuS.
- `../../knowledge/sponsoring/README.md` beschreibt die gemeinsame fachliche Sponsoring-Grundlage.
- `../../decisions/ADR-0007-partnerportal-und-partner-hub-abgrenzung.md` legt die Produktgrenzen verbindlich fest.
- gemeinsame UI-, Architektur- und Freigabestandards liegen außerhalb des Projekts in den zentralen Repository-Standards.

## Future Development

Der Partner Hub wird in kleinen, überprüfbaren Schritten aufgebaut. Neue Funktionen werden nur aufgenommen, wenn sie einen klaren Nutzen für Partner oder TuS haben und keine unnötige Doppelpflege erzeugen.

Vor Implementierung werden gemeinsame Partnerdatenbasis, Objektverantwortung, Rollen/Freigaben und ein kleiner MVP festgelegt.
