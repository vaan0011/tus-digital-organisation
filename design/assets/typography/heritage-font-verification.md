# Heritage Font Verification

## Purpose

Dieses Dokument hält den Verifikationsstand der in der Heritage-Classic-Referenz genannten Schriften fest. Ziel ist, vor dem Aufbau eines finalen Vektor-Artworks eindeutig zu klären, welche Fontdateien und Lizenzen tatsächlich benötigt werden.

## Core principle

**Ein Fontname in einem Mockup ist ein Hinweis, keine automatisch freigegebene Produktionsquelle.**

Die verwendete Schrift muss visuell, technisch und lizenzrechtlich eindeutig bestimmt werden.

## Main content

### 1. `MINGOLSHEIM` – COLLEGE BLOCK

Die Heritage-Classic-Referenz nennt `COLLEGE BLOCK (Bold, Arched)`.

Öffentliche Recherche findet unter anderem die kommerzielle Familie **Collegeblock 2** von Sharkshock / Dennis Ludlow. Diese Familie ist ausdrücklich für College-/Sportswear-Anwendungen positioniert und wird kommerziell lizenziert.

Status: `Reference Candidate – nicht verifiziert`.

Offene Punkte:

- Ist `Collegeblock 2` tatsächlich dieselbe Schrift, die in der Referenz benutzt wurde?
- Falls ja: welcher konkrete Schnitt?
- Wurde der Bogen durch die Schrift selbst oder durch eine Layout-/Warp-Funktion erzeugt?
- Besteht bereits eine gültige TuS-/Designer-Lizenz?
- Darf die Schrift für Merch-Artwork und an den Ausstatter weitergegeben werden oder müssen vor Übergabe Pfade erzeugt werden?

Bis diese Punkte geklärt sind, darf `Collegeblock 2` nicht stillschweigend als Approved gesetzt werden.

### 2. `EST. 1901` / `TURN- UND SPORTVEREIN` – DIN CONDENSED BOLD

Die Heritage-Classic-Referenz nennt `DIN CONDENSED BOLD`.

`DIN Condensed` existiert in unterschiedlichen kommerziellen Interpretationen/Angeboten. Öffentliche Font-Marktplätze führen beispielsweise eine Familie von ParaType mit Desktop-Lizenz für traditionelle Grafikdesign- und Printanwendungen.

Status: `Reference Candidate – Foundry/Version nicht verifiziert`.

Offene Punkte:

- Welche konkrete DIN-Condensed-Familie wurde im ursprünglichen Entwurf verwendet?
- Welcher Schnitt entspricht exakt der Referenz?
- Besteht eine gültige Lizenz?
- Werden finale Produktionsdateien mit Text in Pfade umgewandelt?

### 3. Lizenzregel für TuS Merch

Für die Produktion benötigen wir keine Fontdateien im Repository, solange das finale Artwork als Vektorpfade übergeben wird.

Fontdateien selbst werden nicht ins öffentliche Repository eingecheckt, sofern Lizenz und Weitergaberecht dies nicht ausdrücklich erlauben.

Das Produktionsziel lautet daher:

1. Font auf einem lizenzierten Arbeitsplatz verwenden,
2. Artwork kontrolliert erstellen,
3. finale Schrift in Pfade/Kurven umwandeln,
4. Vektor-PDF/SVG prüfen,
5. nur die daraus erzeugten Produktionsdateien an den Ausstatter übergeben.

### 4. Aktueller Blocker

Ein finaler `Approved Artwork`-Status für Heritage Classic ist erst möglich, wenn die beiden Fontquellen eindeutig feststehen.

Bis dahin kann die Geometrie dokumentiert und ein Rekonstruktions-Proof erstellt werden, aber keine Produktionsdatei als final freigegeben werden.

## Relationship to other documents

- `../../typography.md`
- `../../design-production-system.md`
- `../../merch/artwork/heritage-classic/artwork-spec-v1.md`

## Future development

Sobald die Original-/Quelldateien des ursprünglichen Heritage-Entwurfs oder die tatsächlich verwendeten Fonts verfügbar sind, werden Fontname, Foundry, Schnitt, Lizenzstatus und Freigabestatus ergänzt.