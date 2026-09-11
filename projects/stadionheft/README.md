# Projekt: Stadionheft / Spieltagsmagazin Herren

## Purpose

Dieses Projekt automatisiert die wiederkehrende Erstellung der Stadionzeitschrift zu den Heimspieltagen der Herrenmannschaften des TuS Mingolsheim.

Ziel ist nicht, bei jedem Heimspiel ein neues Heft manuell zu bauen. Eine freigegebene Druckvorlage mit verbindlichem TuS-Design, festen Anzeigenflächen und wiederkehrender Seitenlogik wird aus aktuellen Sources of Truth mit geprüften Inhalten befüllt und anschließend als druckfertige Ausgabe bereitgestellt.

## Core Principle

> **Einmal gestalten. Pro Spieltag automatisch mit belastbaren Inhalten füllen. Vor Druck prüfen.**

Design, Logos, Schriften und Partneranzeigen werden nicht generativ nachgebaut oder verändert. Variable Inhalte werden aus führenden Quellen übernommen, redaktionell aufbereitet und vor Veröffentlichung geprüft.

## Main Content

### 1. Zielbild

Vor einem Herren-Heimspiel entsteht aus einem festen Produktionslauf eine neue Ausgabe des Stadionhefts.

Der Lauf verbindet insbesondere:

- aktuelle Spiel- und Tabellendaten,
- Mannschafts- und Gegnerinformationen,
- Statistiken zum aktuellen Gegner,
- redaktionelle Vorstellung des Gegners,
- den Spielbericht des vorherigen Spieltags,
- historische TuS-Inhalte aus dem Archiv,
- aktuelle TuS-News, Projekte und Aufrufe,
- anstehende Veranstaltungen,
- bestehende und für die Ausgabe freigegebene Partneranzeigen,
- die verbindliche Stadionheft-Druckvorlage.

### 2. Geplante Inhaltsbausteine

Eine Ausgabe kann abhängig vom Umfang insbesondere enthalten:

1. Titel / Heimspielankündigung,
2. Begrüßung / Editorial,
3. Spieltag auf einen Blick,
4. aktuelle Tabelle,
5. Mannschaft / Kader,
6. Gegnerportrait,
7. Statistik / direkte Duelle / aktuelle Form, soweit belastbar verfügbar,
8. Rückblick auf den vorherigen Spieltag,
9. `Aus dem TuS-Archiv` – Anekdote, historisches Spiel, Person, Statistik oder Jahrestag,
10. `TuS aktuell` – Projekte, Vereinsnews, Aufrufe,
11. nächste Veranstaltungen,
12. Partneranzeigen und Partnerhinweise,
13. weitere feste Vereins- und Serviceinformationen.

Die Seitenzahl und konkrete Reihenfolge werden nach Analyse der bestehenden Druckvorlage verbindlich festgelegt.

### 3. Führende Quellen

| Inhalt | Führende Quelle / zuständige Rolle |
|---|---|
| Spieltermine, Tabelle, Gegner, offizielle Spieldaten | `fussball.de` / Matchday Editor |
| letzter Spielbericht | Google-Drive-Spielberichtsarchiv / Matchday Editor |
| historische Inhalte | `TuS Historie – Quellenindex` und zugehörige Arbeitsprodukte / Archivist |
| Projektnews | jeweilige `PROJECT-STATE.md` / Project Portfolio Manager |
| Veranstaltungen | TuS Event Planner bzw. bis zur vollständigen Integration aktuelle verbindliche Veranstaltungsquelle |
| Partnerstatus / Anzeigenberechtigung | Partnership Manager / operative Partnerquelle |
| Partneranzeigen | freigegebene Original-Anzeigendateien auf Google Drive |
| Design / Druckvorlage | freigegebene Originalvorlage / Graphic Designer |
| Logos und Brand Assets | zentrale TuS-Brand-Assets |

### 4. Rollen und Handoffs

- **Matchday Editor:** aktuelle sportliche Fakten, Gegnertext, Tabellen-/Statistikprüfung und Rückblick.
- **Archivist:** gezielte historische Recherche passend zum Gegner, Spieltag oder Datum; nur belegte Inhalte.
- **Partnership Manager:** welche Partneranzeigen aktuell verwendet werden dürfen; keine veralteten oder ungeklärten Anzeigen automatisch ausspielen.
- **Graphic Designer:** Masterlayout, Satzregeln, Bild-/Anzeigenplätze, Druckparameter und visuelle Qualitätskontrolle.
- **Project Portfolio Manager:** relevante TuS-Projekte und veröffentlichbare aktuelle Projektstände.
- **Event Planner / zuständige Veranstaltungsquelle:** kommende Veranstaltungen.
- **WordPress Developer / technische Entwicklung:** spätere Datenadapter, Produktionsworkflow und gegebenenfalls Ausgabe-/Downloadbereich.

### 5. Automatisierungsprinzip

Langfristiges Ziel:

```text
Nächstes Herren-Heimspiel erkannt
        ↓
Content-Paket erzeugen
        ↓
Spieldaten + Tabelle + Gegner
        ↓
letzter Spielbericht
        ↓
Archiv-Briefing und historischer Beitrag
        ↓
TuS-News / Projekte / Veranstaltungen
        ↓
aktuelle freigegebene Anzeigen
        ↓
Mastervorlage automatisch befüllen
        ↓
Fakten-, Anzeigen- und Layoutcheck
        ↓
druckfertiges PDF
```

Die Automatisierung ersetzt nicht den finalen Qualitätscheck vor Druck.

### 6. Bereits bekannte vorhandene Quellen

Auf Google Drive wurden bereits gefunden:

- `Stadionheft.xlsx` – historische Stadionheft-/Anzeigen- bzw. Abrechnungsdaten; als Bestandsquelle zu prüfen, nicht automatisch als Layout-Master zu behandeln,
- vorhandene vollständige Spielberichte,
- `TuS Historie – Quellenindex`,
- `Werbeflaechen-Inventar Sportpark 2026`,
- Partner-/Sponsoring-Arbeitsstände.

Die vom Nutzer genannte aktuelle Druckvorlage sowie die aktuellen Originalanzeigen müssen im Discovery-Schritt eindeutig identifiziert und als verbindliche Produktionsassets referenziert werden.

### 7. Qualitätsregeln

- keine erfundenen Statistiken, historischen Aussagen oder Gegnerinformationen,
- keine generativ rekonstruierten Logos oder Partneranzeigen,
- keine automatische Verwendung einer Anzeige ohne bestätigten aktuellen Status,
- historische Rankings/Anekdoten nur auf Basis erschlossener Quellen,
- Druckvorlage und Satzregeln bleiben stabil,
- variable Inhalte müssen in definierte Text-/Bildbereiche passen,
- finale Ausgabe erhält einen Fakten-, Anzeigen-, Bildrechte- und Druckcheck.

## Relationship to other documents

- `PROJECT-STATE.md`
- `PRODUCTION-STANDARD.md`
- `../../roles/matchday-editor/`
- `../../roles/archivist/`
- `../../roles/graphic-designer/`
- `../../roles/partnership-manager/`
- `../event-planner/`
- `../../design/`

## Future Development

Nach Identifikation und Analyse der realen Mastervorlage wird zunächst eine einzige Ausgabe als Pilot produziert. Erst wenn der Satz reproduzierbar funktioniert, wird der Ablauf weiter automatisiert und gegebenenfalls als wiederkehrende Runtime eingerichtet.