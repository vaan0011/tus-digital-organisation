# Homepage Architecture

## Purpose

Dieses Dokument konkretisiert die technische Zielarchitektur des Homepage-Neuaufbaus. Es übersetzt die Trennung aus `ADR-0011` in klare Verantwortungen, Integrationsverträge und Fehlergrenzen.

## Core Principle

> **Die Oberfläche kann wechseln, ohne dass fachliche Daten und Funktionen neu gebaut werden müssen.**

## Main Content

### 1. Architekturschichten

#### Schicht A – TuS-Block-Theme

Das Theme `tus-mingolsheim` liefert:

- Global Styles über `theme.json`,
- semantische Farb-, Typografie-, Spacing- und Form-Tokens,
- Templates und Template Parts,
- Header, Mobile Navigation und Footer,
- Block Patterns für redaktionelle Bereiche,
- rein visuelle Block Styles,
- responsive Layout und Asset-Auslieferung.

Das Theme besitzt keine fachlichen Tabellen, Importjobs oder Geschäftsregeln.

#### Schicht B – WordPress Core Content

WordPress Core liefert:

- Beiträge,
- Seiten,
- Medien,
- Navigationen,
- redaktionelle Blockinhalte,
- Benutzer- und Redaktionsworkflow im vorhandenen WordPress-Rahmen.

#### Schicht C – Fachplugins

Fachplugins liefern ihre Domänen:

- Team Manager: Mannschaft, Saison, Training und externe Teamzuordnung,
- Matchdaten-Adapter: synchronisierte öffentliche Spieldaten,
- Event Planner: Veranstaltungen,
- TuS Platzbelegung: Ressourcen und Belegungen,
- Partnerlösungen: Partnerstammdaten und freigegebene öffentliche Darstellung,
- spätere Archiv-/Historienkomponente: freigegebene historische Inhalte.

Jedes Fachplugin bleibt Source of Truth seiner eigenen Daten und stellt eine stabile öffentliche Render-/Block-Schnittstelle bereit.

#### Schicht D – TuS Homepage Components

Das kleine Begleitplugin darf übernehmen:

- zentrale Vereinskennzahlen, sofern dafür noch keine andere Source of Truth existiert,
- Abteilungs-/Bereichsübersichten aus WordPress-Seiten,
- homepagebezogene Auswahl- und Kompositionslogik,
- konsistente Empty-/Fallback-Blöcke für homepageeigene Inhalte.

Es darf keine zweite Mannschafts-, Spiel-, Event-, Partner-, Kontakt- oder Belegungsdatenwelt anlegen.

#### Schicht E – Externe Quellen

Externe Systeme werden ausschließlich über zuständige Adapter angebunden. Der Browser des Besuchers wird für Kernfunktionen nicht direkt an externe iframes oder Skripte gekoppelt, sofern eine kontrollierte serverseitige Lösung möglich ist.

### 2. Integrationsvertrag zwischen Theme und Plugins

Für öffentliche dynamische Komponenten gilt:

1. Das Fachplugin besitzt Datenzugriff und Renderlogik.
2. Das Plugin liefert semantisches, zugängliches HTML.
3. Das Plugin verwendet gemeinsame strukturelle Klassen beziehungsweise Block-Supports, aber keine eigene Markenpalette.
4. Farben und Typografie kommen aus WordPress Global Styles beziehungsweise den stabilen Theme-Tokens.
5. Das Theme fragt keine internen Plugin-Tabellen direkt ab.
6. Fehlt ein Plugin, darf die gesamte Seite nicht mit einem Fatal Error ausfallen.
7. Empty, Loading, Fehler und veraltete Daten werden fachlich vom Plugin und visuell vom gemeinsamen UI-System behandelt.

### 3. Semantische Theme-Tokens

Die Tokennamen werden früh stabilisiert; konkrete Werte folgen der Brand-Freigabe.

Mindestens vorgesehen:

- Farben: `primary`, `accent`, `base`, `contrast`, `surface`, `muted`, `border`, `success`, `warning`, `error`,
- Typografie: `body`, `heading`,
- Schriftgrößen: kleine Metaebene, Fließtext, Zwischenüberschrift, Abschnittsüberschrift, Hero,
- Abstände entlang der bestehenden 4/8/12/16/24/32/48-Skala,
- Formen für Radius und Schatten nur soweit im freigegebenen UI benötigt.

Die technische Ausgabe erfolgt bevorzugt über von WordPress generierte Preset-Variablen aus `theme.json`. Fachplugins verwenden semantische Rollen und keine fest verdrahteten TuS-Hexwerte oder eigenen Markenfonts.

### 4. Komponentenverantwortung

| Öffentliche Komponente | Daten-/Content-Owner | Render-/Funktions-Owner | Look-Owner |
|---|---|---|---|
| Header / Mobile Navigation / Footer | WordPress Navigation und Seiten | Theme / WordPress Core | Theme |
| Hero | WordPress Startseiteninhalt | WordPress Core / Theme Pattern | Theme |
| Nächste Spiele / MatchCard | FUSSBALL.DE; Team-Mapping im Team Manager | Matchdaten-Adapter bzw. Team Manager | Theme-Tokens |
| Schnelleinstiege | WordPress Startseiteninhalt | WordPress Core / Pattern | Theme |
| Aktuelles / NewsCard | WordPress Beiträge | WordPress Query / Theme Template | Theme |
| Jubiläumsmagazin | WordPress Seite + Media/PDF | WordPress Core / Pattern | Theme |
| Abteilungen | WordPress Abteilungsseiten | Homepage Components | Theme-Tokens |
| Veranstaltungen / EventCard | Event Planner | Event Planner | Theme-Tokens |
| Vereinskennzahlen | zentrale Homepage-Konfiguration | Homepage Components | Theme-Tokens |
| Partnerauswahl | Partnerdatenquelle; Übergang kontrolliert redaktionell | Partnerkomponente | Theme-Tokens |
| Social Links | WordPress Navigation | WordPress Core | Theme |
| Kontakt | freigegebene Rollenpostfächer / Kontaktarchitektur | spätere Kontaktkomponente/Formularlösung | Theme-Tokens |
| Platzbelegung | TuS Platzbelegung | TuS Platzbelegung | Theme-Tokens |

### 5. Block-Theme-Struktur

Minimaler geplanter Theme-Aufbau:

```text
theme/tus-mingolsheim/
|-- style.css
|-- theme.json
|-- functions.php
|-- templates/
|   |-- index.html
|   |-- front-page.html
|   |-- page.html
|   |-- single.html
|   |-- archive.html
|   |-- search.html
|   `-- 404.html
|-- parts/
|   |-- header.html
|   `-- footer.html
|-- patterns/
|-- assets/
|   |-- css/
|   |-- js/
|   |-- fonts/
|   `-- images/
`-- README.md
```

`functions.php` bleibt klein und enthält nur Theme-Setup beziehungsweise technisch notwendige Asset-/Pattern-Registrierung. Fachfunktionalität wandert nicht dorthin.

### 6. Fehler- und Fallback-Architektur

- Externe APIs werden nicht synchron bei jedem Seitenaufruf aufgerufen.
- Synchronisierte externe Daten behalten einen nachvollziehbaren letzten erfolgreichen Stand.
- Ein Fachblock zeigt bei fehlenden Daten einen klaren Empty State oder einen Link zur führenden Quelle.
- Technische Fehlerdetails erscheinen nicht öffentlich.
- Redakteure beziehungsweise Administratoren erhalten einen diagnostizierbaren Status und eine manuelle Retry-Möglichkeit, sofern eine Synchronisation betroffen ist.
- Ein einzelner ausgefallener Datenblock darf Header, Navigation, News und andere Startseitenbereiche nicht blockieren.

### 7. Performance

- serverseitiges Rendering für dynamische Kernblöcke,
- kontextbezogenes Laden von CSS und JavaScript,
- keine externe Live-Abhängigkeit im Critical Rendering Path,
- passende responsive Bildgrößen und moderne WordPress-Medienfunktionen,
- lokale Fonts nach Lizenz-/Brand-Freigabe,
- keine große UI-Bibliothek ohne konkreten Bedarf,
- reale Messung von LCP, INP und CLS auf Staging vor Go-live.

### 8. Accessibility und Responsive

Neue Komponenten werden mindestens geprüft auf:

- 360 px,
- 768 px,
- 1280 px,
- Tastaturbedienung,
- sichtbaren Fokus,
- sinnvolle Überschriftenstruktur,
- Alternativtexte und dekorative Bilder,
- Kontrast,
- 200-%-Vergrößerung,
- reduzierte Bewegung, sofern Animationen vorhanden sind,
- Empty-, Fehler- und lange Inhaltszustände.

WCAG 2.2 AA ist Zielstandard.

### 9. Migration und Betrieb

Die neue Architektur wird parallel zur bestehenden Homepage auf Staging aufgebaut.

Migrationsregel:

`Zielkomponente fertig → Daten/Content migrieren → Vergleichs- und Smoke-Test → produktiv umstellen → Alt-Abhängigkeit deaktivieren → erneut testen`

Colibri, Stackable und weitere Altplugins werden nicht entfernt, solange noch produktive Inhalte davon abhängen.

## Relationship to other documents

- `README.md`
- `PROJECT-STATE.md`
- `CONTENT-MODEL.md`
- `FUSSBALL-DE-INTEGRATION.md`
- `../../decisions/ADR-0011-wordpress-theme-and-domain-content-boundary.md`
- `../../architecture/platform-architecture.md`
- `../../architecture/stability-and-simplicity.md`
- `../../design/ui-standard.md`
- `../../standards/software-development-quality-standard.md`
- `../../standards/data-persistence-and-database-standard.md`

## Future Development

Konkrete Block-Slugs, REST-Routen und technische Interfaces werden erst im jeweils kleinsten Implementierungsinkrement festgelegt. Bewährte Komponenten können später in den gemeinsamen UI-Standard übernommen werden.
