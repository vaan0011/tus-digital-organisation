# Neuaufbau TuS-Homepage – Project State

Stand: 2026-09-17 – Besucher- und Funktionslandkarte konsolidiert

## Purpose

Diese Datei ist der kompakte Projekt-Checkpoint für den Neuaufbau der öffentlichen TuS-Mingolsheim-Homepage.

## Core Principle

> **Theme für Look und Layout; führende Inhalte und Fachplugins für Content, Daten und Funktionen.**

## Main Content

### Status

`Aktiv`

### Current Goal

Die akzeptierte visuelle Richtung wird in eine implementierbare WordPress-Zielarchitektur überführt. Als erstes Entwicklungsinkrement werden die technische Zielumgebung, der FUSSBALL.DE-Zugriffsweg und das Block-Theme-Grundgerüst belastbar gemacht.

### Verified

- Ein hochwertiges responsives Homepage-Mockup wurde vom Vorstand als visuelle Richtung bestätigt.
- Der `design/homepage-standard.md` definiert Informationsarchitektur, Nutzerwege und Komponenten der Startseite.
- `VISITOR-FUNCTION-MAP.md` ordnet häufige Besucherfragen den öffentlichen Wegen, führenden Quellen, Komponenten und Fallbacks zu.
- `Schiedsrichter werden` ist als eigener häufig nachgefragter Nutzerweg erkannt; der Google-Drive-Bestand bestätigt Schiedsrichter als sichtbaren Vereinsbereich.
- Der öffentliche Partnerbereich erfüllt zwei getrennte Aufgaben: bestehende Partner sichtbar würdigen und neue Unternehmen über `Partner werden` gewinnen.
- Der `design/ui-standard.md` legt fest, dass öffentliche Plugins Brand-Tokens aus dem aktiven Theme beziehen.
- Barlow ist als verbindliche Digital-/UI-Schrift für die öffentliche Homepage freigegeben.
- Original-TuS-Logos liegen verbindlich unter `design/logo/`.
- Die bestehende Homepage läuft auf WordPress und nutzt Colibri als Page-Builder-Basis.
- 28 aktive Plugins wurden als Migrationskontext inventarisiert.
- FUSSBALL.DE ist fachlich führende Spielquelle; Spiele werden nicht manuell in WordPress doppelt gepflegt.
- Team Manager ist für Mannschaftsidentität, Saisonbezug und externe Mannschaftszuordnung vorgesehen.
- Event Planner ist führende Quelle für Veranstaltungen.
- TuS Platzbelegung wird als eigenes Plugin entwickelt.
- Kontakte sollen rollenbasiert und nicht personengebunden veröffentlicht werden.
- Homepage V1 startet ohne Marketing-/Verhaltens-Tracking und ohne unnötige Drittanbieter-Embeds.
- FUSSBALL.DE bietet weiterhin offizielle Website-Widgets über `Meine Widgets` an.
- FUSSBALL.DE bietet laut offizieller FAQ derzeit keine direkte API an und verweist für automatisierte Datenlieferungen auf Sportmedia per SFTP.
- Das Matchdaten-Modul ist gemäß `ADR-0012` Bestandteil des Team Managers und versorgt Homepage sowie später den Matchday Editor lesend.
- Das heute aktive WordPress-Plugin `Include Fussball.de Widgets` ist seit 07.11.2025 im offiziellen WordPress-Plugin-Verzeichnis wegen eines Sicherheitsproblems geschlossen und ist keine Zielbasis.

### Accepted Decisions

- `ADR-0011` trennt Theme, WordPress-Inhalte und Fachplugins verbindlich.
- `ADR-0012` legt Matchdaten als Team-Manager-Modul mit lokaler Projektion, Homepage-Block und lesender Matchday-Schnittstelle fest.
- Ziel ist ein eigenes Block-Theme `tus-mingolsheim`, kein neuer Page Builder.
- Das Theme enthält keine fachliche Datenhaltung und keine externe Synchronisation.
- Normale redaktionelle Inhalte bleiben in WordPress Core.
- Fachplugins liefern ihre Daten über serverseitig gerenderte dynamische Blöcke oder stabile öffentliche Schnittstellen.
- Ein kleines `tus-homepage-components`-Plugin darf nur homepagebezogene Funktionen ohne bestehende Fachzuständigkeit übernehmen.
- Externe Daten werden nicht bei jedem öffentlichen Seitenaufruf live angefordert.
- FUSSBALL.DE-Daten werden nach verifiziertem Zugriffsweg serverseitig synchronisiert und als lokale, regenerierbare Projektion dargestellt.
- Colibri und Altplugins bleiben bis zu erfolgreicher Staging-Migration unangetastet.
- Die öffentliche Informationsarchitektur folgt Besucherfragen und nicht den Namen interner Plugins.
- `Schiedsrichter werden` erhält einen eigenen, klar auffindbaren Nutzerweg unter `Mitmachen` und einen kontextbezogenen Startseiteneinstieg.
- `Unsere Partner` und `Partner werden` bleiben getrennte öffentliche Aktionen; eine reine Footer- oder Logo-Wand-Darstellung genügt nicht.

### Open

1. Produktive WordPress- und PHP-Version bestätigen.
2. Staging-, Deployment-, Backup- und Rollback-Weg bestätigen.
3. Exakten HEX-/RGB-Wert des Primärrots technisch aus dem freigegebenen Original-Logo verifizieren und in `design/colors.md` registrieren.
4. Sportmedia-Ansprechpartner, Zugang, Bedingungen, mögliche Kosten und repräsentative Beispieldaten sichern.
5. Dateiformat, verfügbare Felder, Statuswerte, Aktualisierungsverhalten und Mannschaftszuordnung im Provider-Spike verifizieren.
6. Endgültige Shop-, Magazin-PDF- und gegebenenfalls Online-Lesen-URLs eintragen.
7. Kommunikations-/Produkt-Owner für die Homepage benennen.
8. Relevante Legacy-Seiten, URLs, Colibri-Templates, Stackable-Blöcke, Shortcodes und Widgets vor Migration inventarisieren.
9. Für `Schiedsrichter werden` fachlichen Content-Owner, rollenbasierten Kontaktweg und aktuelle Verbandsinformationen bestätigen.
10. Übergangsquelle und kuratierte Auswahl für `Unsere Partner` festlegen, bis die gemeinsame Partnerdatenquelle bereitsteht.

### Risks

- Ein nicht dokumentierter FUSSBALL.DE-Zugriff könnte technisch fragil oder nutzungsrechtlich ungeeignet sein.
- Ungeprüfte Colibri-/Plugin-Abhängigkeiten können bei zu früher Abschaltung Inhalte beschädigen.
- Noch nicht freigegebene Farb- und Fontwerte dürfen nicht stillschweigend zum Brand-Standard werden.
- Direkte Theme-Abfragen auf Plugin-Tabellen würden die beschlossene Trennung umgehen.
- Öffentliche Komponenten dürfen bei Ausfall einer externen Quelle nicht die gesamte Startseite blockieren.

### Excluded / Rejected

- kein ungeprüftes Scraping als Architekturstandard,
- keine manuelle WordPress-Spielpflege,
- keine fachlichen Daten im Theme,
- kein neues monolithisches Homepage-Plugin für alle Domänen,
- keine sofortige produktive Colibri-/Plugin-Bereinigung,
- keine generierten oder rekonstruierten TuS-Logos,
- keine externen Requests im kritischen Seitenrendering,
- kein Marketing-Tracking als V1-Default.

### Last Known Good

Die bestehende produktive Homepage bleibt unverändert. Der belastbare neue Stand besteht aus dem freigegebenen Mockup, den bestehenden Homepage-/Privacy-/Migrationsstandards und der dokumentierten Zielarchitektur. Es existiert noch kein neues Theme- oder Homepage-Komponenten-Plugin im Repository.

### Next Meaningful Step

1. Besucher- und Funktionslandkarte prüfen und die bestätigten Ergänzungen in Homepage-Standard und UI-Mockup spiegeln.
2. Sportmedia-Datenzugang und repräsentative Beispieldatei für den TuS klären.
3. Den in `FUSSBALL-DE-INTEGRATION.md` und `../team-manager/MATCH-DATA-MODULE.md` beschriebenen Provider-Spike durchführen.
4. Produktive WordPress-/PHP-Baseline und Staging-Weg bestätigen.
5. Danach das minimale Theme-Inkrement mit `theme.json`, Header, Footer, `index.html`, `front-page.html` und lokalem Original-Logo auf einem eigenen Branch umsetzen.
6. Dieses Inkrement gemäß der vollständigen Viewport-, Browser-, Geräte-, Tastatur- und Accessibility-Matrix aus `design/homepage-standard.md` prüfen.

## Relationship to other documents

- `README.md`
- `VISITOR-FUNCTION-MAP.md`
- `ARCHITECTURE.md`
- `CONTENT-MODEL.md`
- `FUSSBALL-DE-INTEGRATION.md`
- `../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md`
- `../../decisions/ADR-0012-team-manager-match-data-module.md`
- `../../design/homepage-standard.md`
- `../../knowledge/privacy/HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`
- `../team-manager/PROJECT-STATE.md`
- `../team-manager/MATCH-DATA-MODULE.md`
- `../event-planner/PROJECT-STATE.md`
- `../platzbelegung/PROJECT-STATE.md`

## Future Development

Dieser Projektzustand wird aktualisiert, wenn der Matchdaten-Zugriffsweg entschieden, ein Theme-Last-Known-Good aufgebaut, ein Staging-Stand abgenommen oder eine relevante Migrationsgrenze verändert wurde.
