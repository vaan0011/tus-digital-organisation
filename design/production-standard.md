# Design Production Standard

## Purpose

Dieser Standard definiert die verbindliche Produktionsweise für finale TuS-Grafiken, Reinzeichnungen und Druckdateien.

Er schließt die Lücke zwischen kreativem Entwurf und technisch sauberer Endproduktion. Ziel ist reproduzierbare Qualität ohne verfälschte Logos, improvisierte Typografie, unsaubere Geometrie oder unnötige Generierungsschleifen.

## Core Principle

> **Entwurf wird gestaltet. Produktion wird konstruiert.**

Generative Werkzeuge dürfen Ideen und Bildbestandteile erzeugen. Verbindliche Markenassets, exakte Texte, Typografie und kritische Geometrien werden in der finalen Produktion kontrolliert gesetzt und nicht generativ rekonstruiert.

## Main Content

### 1. Drei klar getrennte Artefaktstufen

Jede mehrstufige Designaufgabe unterscheidet mindestens:

1. **Konzept / Entwurf** – gestalterische Richtung, Hierarchie, Komposition und Wirkung.
2. **Reinzeichnung** – präziser Aufbau mit verbindlichen Assets, Schriften, Texten, Abständen und Geometrien.
3. **Produktionsdatei** – technisch geprüfte Datei für den konkreten Ausgabe- oder Druckprozess.

Ein Mockup oder generiertes Bild ist nicht automatisch eine Reinzeichnung. Eine Reinzeichnung ist nicht automatisch eine geprüfte Produktionsdatei.

### 2. Produktionsmodus beginnt erst nach freigegebener Richtung

Vor der Reinzeichnung muss die gestalterische Richtung ausreichend geklärt sein.

Ab diesem Punkt werden freigegebene Bestandteile als `Locked Elements` behandelt. Änderungen an anderen Details dürfen diese Elemente nicht unbeabsichtigt verändern.

Im Produktionsmodus wird nicht mehr frei exploriert. Änderungen werden gezielt und lokal umgesetzt.

### 3. Offizielle Logos werden ausschließlich platziert

Für das TuS-Logo gelten die Originalassets unter `design/logo/`.

Das Logo wird in einer Produktionsdatei:

- aus der Originaldatei eingebunden,
- nicht nachgezeichnet,
- nicht durch ein generatives Modell rekonstruiert,
- nicht automatisch stilisiert,
- nicht durch ein ähnlich aussehendes Logo ersetzt,
- nicht verzerrt,
- nicht ohne Freigabe umgefärbt.

Wenn das verfügbare Originalasset für das geplante Produktionsformat technisch nicht ausreicht, wird dieser Mangel sichtbar eskaliert. Es wird kein vermeintlich passendes Ersatzlogo erzeugt.

Dasselbe gilt für Partner- und Sponsorenlogos.

### 4. Exakte Texte werden gesetzt, nicht generiert

Finale Texte werden mit einem kontrollierten Text- oder Vektorwerkzeug gesetzt.

Das gilt insbesondere für:

- Vereinsnamen,
- Ortsnamen,
- Jahreszahlen,
- Slogans,
- Koordinaten,
- Namen,
- Spielinformationen,
- Preise,
- URLs,
- Partnernamen.

Vor Produktion werden Wortlaut, Groß-/Kleinschreibung, Sonderzeichen und Zeichensetzung gegen das Briefing bzw. die verbindliche Quelle geprüft.

### 5. Typografie ist Geometrie

Typografie wird nicht nur auf den richtigen Font geprüft, sondern auch auf saubere Konstruktion.

Zu prüfen sind mindestens:

- Schriftfamilie und Schriftschnitt,
- Größe,
- Laufweite / Tracking,
- Kerning bei auffälligen Buchstabenpaaren,
- Zeilenabstand,
- horizontale und vertikale Ausrichtung,
- optische Balance,
- konsistente Baseline.

Wenn die verbindliche Schrift noch nicht sicher identifiziert oder verfügbar ist, wird vor finaler Produktion gestoppt und geklärt. Es gibt keine stille Font-Substitution.

### 6. Bogen-, Kreis- und Pfadtext wird konstruiert

Text, der entlang eines Bogens, Kreises oder anderen Pfades verläuft, wird als echter Pfadtext bzw. mit einer reproduzierbaren geometrischen Methode gesetzt.

Nicht zulässig als finale Produktionsmethode sind:

- einzeln nach Augenmaß rotierte Buchstaben,
- generativ erzeugter Bogen-Text,
- perspektivisch verzerrte Rastertexte als Ersatz für Pfadtext,
- uneinheitliche Baselines oder zufällige Buchstabenrotationen.

Bei Pfadtext werden mindestens geprüft:

- gemeinsamer Radius bzw. definierter Pfad,
- konsistente Baseline,
- gleichmäßige optische Laufweite,
- zentrierte Platzierung,
- symmetrische Anfangs- und Endposition,
- keine ungewollten Rotationssprünge einzelner Zeichen.

### 7. Kritische Geometrien werden deterministisch aufgebaut

Rahmen, Kreise, Linien, Raster, Abstände, Symmetrien, Koordinatensysteme und wiederkehrende Formen werden mit Layout-/Vektorwerkzeugen oder reproduzierbarer technischer Konstruktion erzeugt.

Wenn ein Element exakt sein muss, ist freie Bildgenerierung nicht die Produktionsmethode.

### 8. Generative Bestandteile bleiben isoliert

Generative Werkzeuge dürfen beispielsweise liefern:

- Illustrationen,
- Texturen,
- Hintergründe,
- atmosphärische Bildbestandteile,
- freie Formen,
- Mockup-Szenen.

Diese Bestandteile werden möglichst getrennt von Logos, Text und exakter Geometrie erzeugt und anschließend komponiert.

Ein generatives Gesamtbild mit eingebautem Fantasielogo oder fehlerhaftem Text wird nicht dadurch produktionsfähig, dass der Rest des Bildes gut aussieht.

### 9. Kleinste geeignete Änderungsmethode

Im Produktionsmodus gilt:

> **Korrigiere das fehlerhafte Element – regeneriere nicht das gesamte Design.**

Beispiele:

- falsches Logo → Originalasset ersetzen,
- falscher Text → Textebene korrigieren,
- unsauberer Bogen → Pfadtext neu konstruieren,
- falscher Abstand → Layoutparameter korrigieren,
- Hintergrundproblem → nur Hintergrund bearbeiten.

Die Zwei-Versuche-Regel aus dem Iteration & Progress Standard gilt ausdrücklich auch für Designproduktion.

### 10. Geeignete Produktionswerkzeuge

Für Reinzeichnung und Produktionsdaten wird ein Werkzeug verwendet, das die jeweils benötigte Präzision zuverlässig unterstützt, insbesondere:

- Vektor-/Layoutsoftware,
- kontrollierte SVG-Erzeugung,
- professionelle Seiten-/Drucklayoutsoftware,
- andere Werkzeuge mit echten Text-, Pfad-, Ebenen- und Exportfunktionen.

Ein Bildgenerator allein ist kein ausreichendes Reinzeichnungswerkzeug für markenkritische Druckdateien.

Die konkrete Software darf wechseln. Die Qualitätsanforderung bleibt.

### 11. Produktionsdatei und Ausgabeformat

Das erforderliche Ausgabeformat wird vor der finalen Erstellung geklärt.

Je nach Produkt können insbesondere relevant sein:

- SVG,
- PDF,
- druckfähiges PDF nach Vorgabe des Produzenten,
- hochauflösendes PNG,
- andere vom Produzenten ausdrücklich verlangte Formate.

Produktionsparameter werden nicht geraten. Wenn Druckerei oder Ausstatter Vorgaben zu Beschnitt, Farbprofil, Mindestauflösung, Maximalformat, Transparenz, Sonderfarben oder Konturen macht, haben diese technischen Vorgaben Vorrang.

### 12. Rasterassets werden nicht blind vektorisiert

Liegt ein verbindliches Logo oder anderes Locked Asset nur als Rasterdatei vor, wird es nicht automatisch durch Nachzeichnen oder KI-Vektorisierung verändert.

Ist für die Produktion zwingend ein Vektorformat erforderlich, wird eine offizielle Vektorquelle beschafft oder eine kontrollierte, ausdrücklich freigegebene Ableitung erstellt.

### 13. Preflight ist Pflicht

Keine finale Druck- oder Produktionsdatei gilt als fertig, bevor die `print-preflight-checklist.md` abgearbeitet wurde.

Der Preflight umfasst mindestens:

- Brand Check,
- Content Check,
- Typography & Geometry Check,
- Technical Check,
- Visual QA.

### 14. Visuelle QA ist eigenständig

Eine Datei kann technisch korrekt exportiert und trotzdem gestalterisch schlecht sein.

Vor Freigabe wird deshalb die finale Ausgabe visuell geprüft, nicht nur ihre technischen Parameter.

Insbesondere werden kontrolliert:

- wirkt der Satz sauber und professionell,
- sind Bögen, Abstände und Achsen wirklich ruhig,
- sind Größenverhältnisse ausgewogen,
- gibt es sichtbare Artefakte oder unscharfe Elemente,
- stimmen Entwurf und Reinzeichnung in der Wirkung überein,
- wurden Locked Elements unverändert übernommen.

### 15. Qualitätsfehler führen nicht zu Improvisation

Wenn ein finales Ergebnis offensichtlich unter dem Qualitätsniveau der freigegebenen Richtung liegt, wird es nicht als Produktionsdatei ausgegeben.

Stattdessen wird der konkrete Fehler benannt und die Produktionsmethode angepasst.

Ein sichtbarer Mangel wird nicht mit Formulierungen wie „druckfertig“, „final“ oder „produktionsbereit“ überdeckt.

### 16. Definition of Done für Produktionsdateien

Eine Produktionsdatei ist erst abgeschlossen, wenn:

- die Approved Direction eingehalten ist,
- alle Locked Assets aus ihren verbindlichen Quellen stammen,
- Texte korrekt gesetzt sind,
- Typografie und kritische Geometrie sauber konstruiert sind,
- keine markenkritischen Elemente generativ rekonstruiert wurden,
- das Ausgabeformat zum vorgesehenen Produktionsprozess passt,
- der Preflight vollständig bestanden ist,
- die visuelle QA bestanden ist,
- erforderliche menschliche Freigaben vorliegen.

## Relationship to other documents

- `README.md`
- `design-workflow.md`
- `generative-design-standard.md`
- `print-preflight-checklist.md`
- `logo.md`
- `typography.md`
- `colors.md`
- `product-types.md`
- `../roles/graphic-designer/role.md`
- `../standards/iteration-and-progress.md`
- `../standards/approval-and-escalation.md`
- `../decisions/ADR-0004-brand-controlled-design-production.md`

## Future Development

Der Standard wird anhand realer Produktionsfälle weiterentwickelt. Wiederkehrende technische Anforderungen einzelner Produktklassen oder Produzenten werden nur dann ergänzt, wenn sie tatsächlich wiederverwendbar sind.

Produktvorlagen entstehen aus erfolgreich produzierten realen Designs – nicht als Selbstzweck vor der ersten belastbaren Produktion.