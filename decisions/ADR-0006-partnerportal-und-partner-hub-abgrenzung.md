# ADR-0006: Partnerportal und Partner Hub klar abgrenzen

## Status

Accepted

## Date

2026-09-04

## Scope

TuS Digital Organisation – Sponsoring / Partnerships, Partnerportal, Partner Hub, öffentliche Partnerseite und gemeinsam genutzte Partnerdaten.

## Context

Für die digitale Partnerarbeit existieren zwei fachlich weit entwickelte Projektbereiche:

- `projects/partner-portal/`
- `projects/partner-hub/`

Beide Konzepte enthielten teilweise ähnliche Funktionen rund um Partnerprofile, Kampagnen, Wirkung, Kommunikation und Partnerpflege.

Gleichzeitig gilt organisationsweit das Prinzip, Informationen nur einmal fachlich zu pflegen und keine parallelen Systeme ohne klaren Nutzen aufzubauen.

## Problem

Vor einer technischen Implementierung musste geklärt werden, ob Partnerportal und Partner Hub dasselbe Produkt, zwei unabhängige Produkte oder zwei klar getrennte Zugänge zu einer gemeinsamen Partnerdatenbasis darstellen.

Ohne diese Entscheidung drohten:

- doppelte Partnerdaten,
- doppelte Pflege von Events, Projekten, Jobs oder Kampagnen,
- überschneidende Benutzeroberflächen,
- unklare Verantwortlichkeit,
- unnötige technische und organisatorische Komplexität.

## Decision

Die Partnerarbeit wird künftig in drei klar getrennte Zugänge gegliedert:

1. **Öffentliche Partnerseite**  
   dient der Gewinnung neuer Interessenten, fragt Unternehmensziele ab und überführt strukturierte Anfragen in die interne Partnerarbeit.

2. **Internes Partnerportal**  
   ist das Arbeitswerkzeug des TuS für Interessenten, Partner Journey, Aufgaben, Wiedervorlagen, Partnerziele, Partnerprodukte, Assets, Historie, Kampagnenplanung und interne Auswertung.

3. **Partner Hub**  
   ist die partnerseitige Oberfläche für bestehende Partner. Dort verstehen und nutzen Partner ihre Partnerschaft, sehen Ziele, Leistungen, Wirkung, Projekte, Kampagnen und Inhalte und können unter anderem Jobs, Angebote, Rückmeldungen und Kooperationsinteressen einbringen.

Die verbindliche Prozesslogik lautet:

> **öffentlich gewinnen → intern managen → im Partner Hub gemeinsam nutzen**

Diese drei Zugänge bilden **keine getrennten Datenwelten**.

Für gemeinsam genutzte Informationen gilt eine fachliche Quelle der Wahrheit. Partner, Ansprechpartner, Partnerschaft, Partnerziele, Leistungen, Veranstaltungen, Projekte, Kampagnen, Jobs und Angebote werden nicht unabhängig in mehreren Modulen gepflegt.

Die konkrete technische Datenarchitektur wird separat entschieden. Diese ADR legt die fachliche Verantwortung und Produktabgrenzung fest, nicht die technische Implementierung.

## Rationale

Die Aufteilung folgt dem tatsächlichen Nutzungskontext:

- Interessenten benötigen einen einfachen öffentlichen Einstieg.
- Das TuS-Team benötigt ein effizientes internes Arbeitswerkzeug.
- Bestehende Partner benötigen eine verständliche Oberfläche, um ihre Partnerschaft aktiv zu nutzen.

Dadurch kann jede Oberfläche auf wenige relevante Aufgaben fokussiert werden, während gemeinsame Daten wiederverwendet werden.

Die Lösung unterstützt insbesondere die bestehenden Prinzipien:

- Aus Sponsoren werden Partner.
- Einfachheit ist Qualität.
- Das System soll Arbeit abnehmen und keine neue Verwaltung erzeugen.
- Informationen werden nur einmal fachlich gepflegt.
- Oberflächen folgen der Domäne und sind nicht selbst die fachliche Quelle.

## Alternatives Considered

### Partnerportal und Partner Hub als dasselbe Frontend

Nicht gewählt, weil interne TuS-Arbeit und partnerseitiger Self-Service unterschiedliche Nutzer, Berechtigungen, Aufgaben und Informationsbedürfnisse besitzen. Eine gemeinsame Oberfläche würde unnötig komplex.

### Partnerportal und Partner Hub als vollständig unabhängige Systeme

Nicht gewählt, weil dadurch dieselben Partner-, Projekt-, Event- und Leistungsdaten mehrfach gepflegt werden müssten.

### Partner Hub vollständig in das Partnerportal integrieren

Nicht gewählt, weil die fachliche Trennung der Nutzerkontexte wertvoll bleibt. Die gemeinsame Datenbasis macht eine Verschmelzung der Oberflächen nicht erforderlich.

## Consequences

Positive Auswirkungen:

- klare Verantwortlichkeit der drei Zugänge,
- weniger Funktionsüberladung je Oberfläche,
- keine geplante Doppelpflege gemeinsamer Partnerdaten,
- klare Grundlage für Rollen und Berechtigungen,
- bessere Trennung interner und partnerseitiger Informationen,
- nachvollziehbare Schnittstellen zu Event Planner, Homepage und weiteren Modulen.

Zu lösende Folgefragen:

- technische gemeinsame Partnerdatenbasis,
- fachliche Objektverantwortung je TuS-Modul,
- Rollen- und Freigabemodell,
- gemeinsame Authentifizierung bzw. Account-Lifecycle,
- Veröffentlichung freigegebener Partnerinhalte auf der Homepage,
- konkrete MVP-Grenzen von Partnerportal und Partner Hub.

## Reopen Conditions

Diese Entscheidung wird nur erneut geprüft, wenn mindestens einer der folgenden Punkte belastbar eintritt:

- die getrennten Nutzerkontexte erzeugen nachweislich mehr Aufwand als Nutzen,
- eine neue zentrale Plattform macht die fachliche Trennung technisch oder organisatorisch unzweckmäßig,
- neue Datenschutz- oder Sicherheitsanforderungen verlangen eine andere Struktur,
- reale Nutzung zeigt, dass eine der beiden geschützten Oberflächen dauerhaft keinen eigenständigen Zweck erfüllt.

Ein neuer Chat, ein neuer Entwickler oder eine andere technische Präferenz reichen nicht aus.

## Supersedes / Superseded by

Keine vorherige ADR wird ersetzt.

Die zuvor offene Abgrenzungsfrage in den Sponsoring- und Projekt-Current-States wird durch diese Entscheidung geschlossen.

## Related Documents

- `../knowledge/sponsoring/README.md`
- `../knowledge/sponsoring/CURRENT-STATE.md`
- `../projects/partner-portal/README.md`
- `../projects/partner-portal/PROJECT-STATE.md`
- `../projects/partner-hub/README.md`
- `../projects/partner-hub/FUNCTIONAL-SCOPE.md`
- `../projects/partner-hub/PROJECT-STATE.md`
- `../architecture/stability-and-simplicity.md`
- `ADR-0005-partnership-manager-and-sponsoring-memory.md`

## Notes

Die Entscheidung sagt bewusst nicht, ob Partnerportal und Partner Hub technisch als ein Plugin, mehrere Module oder eine gemeinsame Anwendung umgesetzt werden. Diese technische Entscheidung folgt erst nach Klärung der gemeinsamen Datenbasis und der Modulgrenzen.
