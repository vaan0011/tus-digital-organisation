# Projekt: Neuaufbau TuS-Homepage

## Purpose

Dieses Projekt überführt das freigegebene Homepage-Mockup in eine robuste, responsive und langfristig wartbare WordPress-Lösung.

Es verbindet die bestehende TuS-Design- und Homepage-Governance mit den fachlich führenden Systemen für Mannschaften, Spiele, Veranstaltungen, Platzbelegung, Partner und Kontakte.

## Core Principle

> **Das Theme gibt dem TuS seinen Look. WordPress-Inhalte und fachliche Plugins liefern Content, Daten und Funktionen.**

Die Homepage bereitet bestehende fachliche Informationen auf. Sie erzeugt keine zweite manuelle Datenpflege.

## Main Content

### 1. Projektumfang

Zum Projekt gehören:

- das eigene WordPress-Block-Theme `tus-mingolsheim`,
- die technische Überführung des freigegebenen UI-Mockups,
- responsive Templates und Komponenten für Desktop, Tablet und Smartphone,
- ein kleines Begleitplugin `tus-homepage-components`, soweit homepagebezogene Funktionen nicht durch WordPress Core oder ein Fachplugin abgedeckt werden,
- Integrationsverträge zu Team Manager, Matchdaten, Event Planner, Platzbelegung und Partnerdaten,
- kontrollierte Migration bestehender Inhalte und URLs,
- Vorbereitung des späteren Ersatzes von Colibri und überlappenden UI-/Widget-Plugins,
- Staging-, Abnahme- und Go-live-Vorbereitung.

### 2. Verbindliche Architektur

Die dauerhafte Architekturentscheidung steht in:

- `../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md`

Die konkrete technische Aufteilung steht in:

- `VISITOR-FUNCTION-MAP.md`
- `ARCHITECTURE.md`
- `CONTENT-MODEL.md`
- `FUSSBALL-DE-INTEGRATION.md`

### 3. Nicht-Ziele des ersten Inkrements

Nicht Teil des ersten Inkrements sind:

- direkte Änderungen am produktiven WordPress,
- sofortige Abschaltung von Colibri oder Altplugins,
- vollständige Umsetzung aller zukünftigen Fachplugins,
- neuer Page Builder,
- neue parallele Mannschafts-, Event-, Partner- oder Belegungsdatenbanken,
- Marketing-/Verhaltens-Tracking,
- pixelgenaue Finalisierung noch nicht freigegebener Farb- oder Fontwerte.

### 4. Geplanter Code-Ort

Solange kein eigener Deployment-Repository-Bedarf bestätigt ist, liegt der Code nachvollziehbar im Projekt:

- `theme/tus-mingolsheim/`
- `plugin/tus-homepage-components/`

Fachplugin-Code verbleibt in seinem jeweiligen Projekt und wird nicht in den Homepage-Ordner kopiert.

### 5. Umsetzungsreihenfolge

1. Architektur, Inhaltsmodelle und Integrationsgrenzen festlegen.
2. Produktive WordPress-/PHP-Baseline und Staging-Weg bestätigen.
3. FUSSBALL.DE-Zugriffsweg als kleinen technischen Spike verifizieren.
4. Block-Theme-Grundgerüst mit Global Styles, Header, Footer und Grundtemplates aufbauen.
5. Homepage-Komponenten in kleinen Inkrementen umsetzen.
6. Datenblöcke nacheinander mit ihren führenden Fachsystemen verbinden.
7. Inhalte und URLs auf Staging migrieren.
8. Accessibility, Responsive, Performance, Privacy und Smoke Tests durchführen.
9. Erst nach Abnahme produktiv umstellen und Alttechnik schrittweise bereinigen.

### 6. Erfolgskriterien

Das Projekt ist fachlich erfolgreich, wenn:

- das freigegebene Design auf Desktop, Tablet und Smartphone belastbar umgesetzt ist,
- Redakteure normale Inhalte ohne Colibri pflegen können,
- Spiele, Events, Teams, Partner und Platzbelegung nicht doppelt manuell gepflegt werden,
- ein Theme-Wechsel keine Änderung fachlicher Daten oder Plugin-Logik verlangt,
- die Seite WCAG 2.2 AA als Zielstandard erfüllt,
- Kernseiten ohne unnötige Drittanbieter-Embeds funktionieren,
- bestehende wichtige URLs und Inhalte kontrolliert migriert sind,
- produktiver Wechsel mit Backup, Rollback und Smoke Tests abgesichert ist.

## Relationship to other documents

- `PROJECT-STATE.md`
- `VISITOR-FUNCTION-MAP.md`
- `ARCHITECTURE.md`
- `CONTENT-MODEL.md`
- `FUSSBALL-DE-INTEGRATION.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../design/ui-standard.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../knowledge/privacy/HOMEPAGE-TECHNICAL-INVENTORY.md`
- `../../knowledge/privacy/HOMEPAGE-PLUGIN-MIGRATION.md`
- `../../knowledge/privacy/HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`
- `../team-manager/`
- `../event-planner/`
- `../platzbelegung/`

## Future Development

Nach der ersten belastbaren Startseite werden Unterseiten, Mannschaftsseiten, Archiv-/Historienansichten, Partnerdarstellung und Formulare schrittweise migriert. Wiederverwendbare, praktisch bewährte Muster können anschließend in den gemeinsamen UI-Standard übernommen werden.
