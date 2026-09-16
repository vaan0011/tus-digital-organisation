# ADR-0012 – Matchdaten als Modul des Team Managers

## Status

Accepted

## Date

2026-09-16

## Scope

TuS Team Manager, öffentliche WordPress-Homepage, Matchday Editor und alle künftigen Verbraucher von Spielansetzungen und Ergebnissen.

## Context

Die öffentliche Homepage soll die nächsten TuS-Spiele automatisch im freigegebenen TuS-Design anzeigen. Die bisherigen FUSSBALL.DE-Widgets sind dafür keine belastbare Zielbasis, weil Widget-Codes saisonbezogen sein können, die Darstellung fremdgesteuert bleibt und das bisher verwendete WordPress-Plugin nicht mehr als sichere Grundlage gilt.

Die offizielle FUSSBALL.DE-FAQ nennt derzeit keine direkte API. Für automatisierte Datenlieferungen von Ergebnissen, Tabellen, Spielberichten und Spielplänen verweist FUSSBALL.DE auf Sportmedia und einen automatisierten Versand per SFTP.

Gleichzeitig existiert mit dem Matchday Editor bereits ein redaktioneller Prozess, der Spieldaten auf FUSSBALL.DE verifiziert und daraus Berichte erstellt. Dessen `season-state.md` ist laut Runtime jedoch redaktionelles Gedächtnis und keine öffentliche Homepage-Datenbank.

`ADR-0011` trennt die Verantwortungen bereits grundsätzlich: Das Theme liefert Look und Layout; Fachplugins liefern Daten, Funktionen und dynamische Blöcke.

## Problem

Es muss verbindlich entschieden werden:

- welches System die automatisiert bezogenen Matchdaten besitzt,
- wie die Homepage ohne saisonale Widget-Codes versorgt wird,
- ob ein separates Matchplugin oder der Team Manager zuständig ist,
- welche Rolle der Matchday Editor in diesem Datenfluss übernimmt,
- wie Saisonwechsel, Quellausfälle und mehrdeutige Mannschaftszuordnungen behandelt werden.

## Decision

### 1. Fachliche Zuständigkeit

Die Matchdaten-Funktion wird als abgegrenztes Modul des TuS Team Managers entwickelt.

Der Team Manager verantwortet bereits Mannschaftsidentität, Saisonbezug, öffentliche Bezeichnung und externe Mannschaftszuordnung. Das Matchdaten-Modul ergänzt diese Verantwortung um die lokale Projektion externer Spielansetzungen und Ergebnisse.

Es wird zunächst kein separates, paralleles Matchplugin und keine Matchdatenhaltung im Theme oder im Homepage-Komponentenplugin aufgebaut.

### 2. Externe Datenlieferung

Der bevorzugte produktive Transportweg ist eine offizielle automatisierte Datenlieferung über Sportmedia per SFTP.

Vor dem produktiven Connector müssen mindestens Zugang, Datenformat, Nutzungsbedingungen, Kosten, Aktualisierungsrhythmus, verfügbare Felder und Beispielwerte verifiziert werden.

Eine direkte FUSSBALL.DE-API wird nicht vorausgesetzt, weil FUSSBALL.DE selbst derzeit erklärt, dass eine direkte Schnittstelle nicht möglich ist.

HTML-Scraping öffentlicher FUSSBALL.DE-Seiten oder die Nutzung inoffizieller Endpunkte ist keine freigegebene Dauerarchitektur. Ein zeitlich begrenzter technischer Spike ist nur zulässig, wenn er keine produktive Abhängigkeit schafft und seine rechtliche sowie technische Bewertung dokumentiert wird.

### 3. Connector-Grenze

Das Matchdaten-Modul trennt Transport und Fachmodell.

Ein Provider-Connector übernimmt den externen Abruf. Normalisierung, Mannschaftszuordnung, Persistenz, Auswahlregeln und öffentliche Ausgabe bleiben providerunabhängig.

Dadurch kann ein verifizierter Transport später ersetzt werden, ohne das Theme, den Homepage-Block oder das interne Matchmodell neu zu bauen.

### 4. Lokale Projektion

Externe Spieldaten werden geplant serverseitig synchronisiert und als regenerierbare lokale Projektion gespeichert.

Verbindlich sind:

- keine externen Live-Requests bei öffentlichen Seitenaufrufen,
- idempotente Aktualisierung anhand stabiler externer Spielkennungen,
- letzter erfolgreicher Datenstand bleibt bei vorübergehendem Quellausfall verfügbar,
- interner Status für letzten erfolgreichen Lauf, Fehler und manuellen Retry,
- keine manuelle Doppelpflege der Spiele in WordPress-Seiten.

### 5. Öffentliche Homepage

Das Matchdaten-Modul liefert einen serverseitig gerenderten dynamischen Block beziehungsweise eine stabile Render-Schnittstelle für „Nächste Spiele“.

Das aktive Theme liefert ausschließlich Gestaltung, responsive Regeln und Brand-Tokens. Ein Theme-Wechsel verändert weder Import noch Matchdatenmodell.

Die Standardauswahl umfasst die nächsten sieben Kalendertage und verwendet die im Homepage-Projekt festgelegten öffentlichen Mannschaftsbezeichnungen und Prioritäten.

### 6. Matchday Editor

Der Matchday Editor darf dieselbe normalisierte Matchdatenbasis über eine dokumentierte lesende Schnittstelle verwenden.

Er bleibt verantwortlich für:

- redaktionelle Erkennung neuer abgeschlossener Spiele,
- zusätzliche Faktenprüfung für Berichte,
- Erstellung und Ablage der Berichtsfassungen,
- Fortschreibung des redaktionellen Saisonstands.

Er ist nicht verantwortlich für:

- die Versorgung des Homepage-Spieleblocks,
- das Schreiben kommender Spiele nach WordPress,
- die technische Quellsynchronisation,
- die öffentliche Matchdatenbank.

Bis die gemeinsame Schnittstelle verfügbar ist, bleibt die direkte Faktenprüfung auf FUSSBALL.DE Teil seiner Runtime.

### 7. Saisonwechsel

Ein Saisonwechsel erfordert keinen neuen Widget-Code und keine Theme-Änderung.

Externe Mannschaftszuordnungen werden saisonbezogen geführt. Das System darf Zuordnungen vorschlagen, veröffentlicht eine mehrdeutige oder geänderte Zuordnung aber erst nach fachlicher Bestätigung. Historische Zuordnungen und Matchdaten werden nicht rückwirkend überschrieben.

## Rationale

Diese Entscheidung:

- vermeidet eine zweite Mannschafts- und Matchdatenwelt,
- nutzt die bereits geplante Saison- und Mannschaftslogik des Team Managers,
- entkoppelt das Homepage-Design von der externen Datenquelle,
- beseitigt saisonale Widget-Codes aus der Zielarchitektur,
- ermöglicht Homepage und Matchday Editor dieselbe belastbare Datenbasis,
- erhält die redaktionelle Verantwortung des Matchday Editors,
- erlaubt einen späteren Providerwechsel hinter einer stabilen Connector-Grenze.

## Alternatives Considered

### Offizielle FUSSBALL.DE-Widgets dauerhaft einbetten

Verworfen als Zielarchitektur, weil Codes und Konfiguration saisonbezogen sein können, Darstellung und Ladeverhalten extern kontrolliert werden und keine gemeinsame interne Datenbasis für weitere TuS-Prozesse entsteht.

### Öffentliche FUSSBALL.DE-Seiten dauerhaft scrapen

Verworfen als ungeprüfter Standard, weil keine offizielle direkte API angeboten wird und Seitenstruktur, Nutzungsbedingungen und Zugriffsschutz eine fragile produktive Abhängigkeit erzeugen können.

### Matchday Editor als Homepage-Datenlieferant verwenden

Verworfen, weil dadurch ein redaktioneller Agent zur operativen Website-Infrastruktur würde und `season-state.md` entgegen seiner definierten Aufgabe zur öffentlichen Datenbank würde.

### Eigenständiges TuS-Matchplugin entwickeln

Zunächst verworfen, weil Mannschaftsidentität, Saison und externe Zuordnung bereits im Team Manager liegen. Diese Alternative kann erneut bewertet werden, wenn eine reale Implementierung eine nicht tragfähige Kopplung nachweist.

### Spiele manuell in WordPress pflegen

Verworfen wegen Doppelpflege, Fehlergefahr und unnötigem Aufwand an jedem Spieltag und Saisonwechsel.

## Consequences

- Das erste Matchdaten-Inkrement entsteht im Team-Manager-Projekt.
- Vor Connector-Code ist der Sportmedia-Zugang zu klären und mit Beispieldaten zu prüfen.
- Das Modul benötigt ein providerunabhängiges normalisiertes Matchmodell.
- Der Homepage-Block liest ausschließlich die lokale Projektion.
- Der Matchday Editor erhält später eine lesende Schnittstelle, ohne Schreibverantwortung für die Homepage.
- Saisonwechsel benötigen gegebenenfalls eine fachliche Mapping-Prüfung, aber keinen neuen Widget- oder Theme-Code.
- Falls Sportmedia nicht wirtschaftlich oder technisch tragfähig ist, stoppt der produktive Import bis zu einer neuen dokumentierten Transportentscheidung.

## Reopen Conditions

Die Entscheidung wird erneut geprüft, wenn:

- FUSSBALL.DE eine dokumentierte direkte API mit geeigneten Nutzungsbedingungen bereitstellt,
- Sportmedia keine für den TuS tragfähige Lieferung anbietet,
- ein anderer offizieller Provider nachweislich stabiler oder wirtschaftlicher ist,
- die Team-Manager-Modulgrenze in der Implementierung zu unvertretbarer Kopplung führt,
- neue rechtliche oder datenschutzbezogene Anforderungen entstehen.

Ein neues Widget, ein saisonaler Linkwechsel oder ein kurzfristig funktionierender inoffizieller Endpoint reichen nicht aus.

## Supersedes / Superseded by

Keine.

## Related Documents

- `ADR-0011-wordpress-theme-and-domain-content-boundary.md`
- `../projects/team-manager/MATCH-DATA-MODULE.md`
- `../projects/team-manager/FUNCTIONAL-SCOPE.md`
- `../projects/team-manager/PROJECT-STATE.md`
- `../projects/homepage/FUSSBALL-DE-INTEGRATION.md`
- `../projects/homepage/ARCHITECTURE.md`
- `../roles/matchday-editor/runtime.md`

## Notes

Offizielle Ausgangsquelle zum Stand der Schnittstelle:

- https://next.fussball.de/faq – Abschnitt „Gibt es eine Schnittstelle/API“
