# TuS Tauschbörse – Project State

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für die TuS Tauschbörse.

Sie hält nur den aktuellen verifizierten Projektstand, offene Architektur-/Produktfragen und den nächsten sinnvollen Schritt fest.

## Current Goal

Das fachliche Zielbild und der einfache konto-freie Vermittlungsprozess werden konkretisiert, bevor Plugin-Code entsteht.

## Current Repository State

Projektpfad:

`projects/reuse-marketplace/`

Plugin-Code:

Noch nicht vorhanden.

Der initiale fachliche Scope wurde über PR #18 nach `main` übernommen. Es gibt aktuell keinen aktiven Implementierungsbranch.

## Last Known Good

Noch nicht vorhanden, da noch keine technische Implementierung existiert.

## Verified / Decided

- Öffentlicher Produktname: `TuS Tauschbörse`.
- Das Projekt soll gut erhaltene Fußball- und Vereinsausrüstung weitervermitteln.
- Die drei Ziele Nachhaltigkeit, Soziales und Gemeinschaft sind gleichwertiger Teil des Produktzwecks.
- Eine dauerhafte Benutzerregistrierung ist für den vorgesehenen Standardablauf nicht gewünscht.
- Persönliche Kontaktdaten von Anbieter und Interessent werden nicht öffentlich angezeigt.
- Anbieter sollen ihr Angebot über eine verifizierte Kontaktadresse und einen sicheren Verwaltungslink kontrollieren können.
- Interessenten verwenden eine einfache Aktion wie `Will ich haben` und geben ihre Kontaktdaten nur für diesen Vermittlungsvorgang an.
- Die Interessenten-Kontaktdaten werden an den Anbieter übermittelt; die Plattform benötigt keinen eigenen Chat.
- Nach erfolgreicher Weitergabe kann der Anbieter die Anzeige schließen; geschlossene Angebote verschwinden aus der öffentlichen aktiven Übersicht.
- `Kinder von Atibie` wird als eigener Spendenweg neben privater Weitergabe/Verkauf sichtbar integriert.
- Der initiale Scope ist über PR #18 auf `main` dokumentiert.

## Open

Vor Implementierung sind noch verbindlich zu klären:

- welche Kontaktmethode für Verifizierung zwingend erforderlich ist, insbesondere E-Mail als Mindestkanal,
- konkreter Magic-Link-/Token-Lebenszyklus,
- genaue Pflichtfelder und Kategorien,
- maximale Anzahl/Größe/Bildformate,
- Lösch- und Aufbewahrungsfristen,
- Datenschutztext und Verantwortlichkeiten,
- minimal notwendiger Spam-/Missbrauchsschutz,
- ob Anzeigen nach Kontaktverifizierung direkt veröffentlicht oder zusätzlich moderiert werden,
- wie genau der TuS-Spendenprozess für `Kinder von Atibie` organisatorisch funktioniert,
- wann und wie ein Anbieter nach einer Interessensbekundung an das Schließen einer erledigten Anzeige erinnert wird.

## Excluded / Not Planned

- keine allgemeine kommerzielle Kleinanzeigenplattform,
- keine öffentliche Anzeige privater Kontaktinformationen,
- kein dauerhaftes Benutzerkonto nur für einen einzelnen Vorgang,
- kein interner Messenger/Chat, solange direkte Kontaktvermittlung ausreicht,
- keine unnötige Profil- oder Nutzerhistorie.

## Relevant Documents

- `README.md`
- `FUNCTIONAL-SCOPE.md`
- `../../design/design-principles.md`
- `../../design/ui-standard.md`
- `../../standards/employee-operating-standard.md`
- `../../standards/approval-and-escalation.md`
- `../../roles/wordpress-developer/development-standard.md`

## Active Development

Kein aktiver Entwicklungsbranch. Der initiale Dokumentationsscope ist gemergt; funktionaler Plugin-Code wurde noch nicht begonnen.

## Next Meaningful Step

1. den konto-freien Prozess als kleinen technischen Ablauf entwerfen,
2. Datenschutz und Missbrauchsschutz auf das absolute notwendige Maß konkretisieren,
3. `Kinder von Atibie`-Spendenprozess mit dem realen TuS-Ablauf abgleichen,
4. erst danach ein minimales MVP definieren und technisch umsetzen.

## Update Rule

Diese Datei wird aktualisiert, wenn sich Ziel, zentrale Entscheidung, offener Blocker, aktiver Branch/PR oder nächster sinnvoller Schritt wesentlich verändert.