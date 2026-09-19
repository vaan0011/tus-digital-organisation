# Backend UI Component Standard

## Purpose

Dieser Standard definiert die gemeinsamen visuellen und interaktiven Bausteine für interne WordPress-Backend-Oberflächen der TuS Digital Organisation.

Er ergänzt den `backend-form-standard.md`: Der Form Standard beschreibt die gemeinsame Formularsprache; dieses Dokument beschreibt die wiederverwendbaren UI-Komponenten, aus denen diese Oberflächen aufgebaut werden.

Ziel ist, dass sich neue Module vertraut anfühlen, bestehende Muster wiederverwendet werden und nicht jedes Plugin eigene Buttons, Felder, Karten, Statusanzeigen oder Sortierlogiken erfindet.

## Core Principle

**Bewährte Backend-Komponenten werden wiederverwendet und nur dann erweitert, wenn ein echter fachlicher Bedarf entsteht.**

Der Event Planner ist die aktuelle Referenzimplementierung für diese Backend-Komponenten.

## Main Content

### 1. Allgemeine Struktur

Interne Arbeitsoberflächen verwenden eine ruhige, klare Informationshierarchie:

1. Seitentitel und kurze Erklärung,
2. kontextbezogene Navigation oder Hauptaktionen,
3. übergeordneter Status bzw. Fortschritt,
4. kompakte Fachkarten bzw. Übersichten,
5. aufklappbare Detail- und Arbeitsbereiche,
6. untergeordnete wiederholbare Einträge.

Zusätzliche Verschachtelung wird vermieden, wenn sie keinen fachlichen Nutzen hat.

### 2. Karten und Blöcke

Zusammengehörige Inhalte werden in klaren Karten oder Blöcken dargestellt.

Verbindlich:

- weiße bzw. neutrale Oberfläche,
- dezenter Border,
- ruhige abgerundete Ecken,
- ausreichender Innenabstand,
- klar erkennbare Überschrift,
- keine dekorative Komplexität ohne Nutzwert,
- zusammengehörige Informationen bleiben in derselben Karte,
- Detailbereiche dürfen ein- und ausklappbar sein.

Ein eingeklappter Arbeitsblock zeigt mindestens seine Überschrift und – wenn sinnvoll – eine kompakte Zusammenfassung, z. B. Anzahl Einträge.

### 3. Primäre und sekundäre Buttons

Primäre Aktionen sind klar von sekundären Aktionen unterscheidbar.

Verbindlich:

- primäre Aktion: gefüllter Primary-Button,
- sekundäre Aktion: Outline-/neutraler Button,
- gleiche Aktion verwendet projektübergreifend dasselbe Muster,
- Buttons werden nicht nur wegen optischer Abwechslung unterschiedlich gestaltet,
- wichtige Mobile-Aktionen sollen mindestens `48px` hoch sein,
- wichtige Touch-Ziele mindestens `44 × 44 CSS-Pixel`.

Beschriftungen sind fachlich und handlungsorientiert, z. B. `Event anlegen`, `Programm speichern`, `Öffnen`.

### 4. Hinzufügen-Muster

Wiederholbare Einträge verwenden ein gemeinsames Hinzufügen-Muster:

- sichtbares Plus-Symbol in einer klar begrenzten quadratischen Aktionsfläche,
- daneben eine verständliche Bezeichnung,
- z. B. `Neuen Tag hinzufügen`, `Aufbau hinzufügen`, `Neuen Sponsor hinzufügen`.

Das Plus-Muster wird für dieselbe Interaktionsart nicht in verschiedenen Modulen unterschiedlich gestaltet.

Die sichtbare Icon-Fläche darf kleiner als das gesamte Touch-Ziel sein; die gesamte interaktive Fläche erfüllt jedoch mindestens `44 × 44 CSS-Pixel`.

### 5. Icon-Aktionen

Kompakte CRUD-Aktionen dürfen als Icon-Buttons dargestellt werden, wenn ihre Bedeutung im Kontext eindeutig ist.

Standardreihenfolge bei bearbeitbaren Containern:

1. Auf-/Zuklappen,
2. Bearbeiten,
3. Speichern bzw. Bestätigen,
4. Löschen.

Verbindlich:

- gleiche Größe und Ausrichtung innerhalb einer Aktionsgruppe,
- mindestens `44 × 44 CSS-Pixel` für wichtige Aktionen,
- sichtbarer Hover-/Focus-Zustand,
- eindeutiger zugänglicher Name (`aria-label`, `title` oder sichtbarer Text),
- destruktive Aktionen sind eindeutig gekennzeichnet,
- Löschen verwendet keine neutrale Erfolgsfarbe.

### 6. Formfelder

Textfelder, URL-Felder, Datumsfelder, Selects und Upload-Auswahl folgen derselben visuellen Form-Sprache.

Verbindlich:

- sichtbares Label oberhalb bzw. klar zugeordnet,
- identische Control-Höhe innerhalb einer Zeile,
- gleiche Border- und Radius-Logik,
- gleiche Fokusdarstellung,
- gleiche Innenabstände,
- volle verfügbare Breite innerhalb der vorgesehenen Spalte,
- gleichartige Felder in einer wiederholbaren Zeile werden gleichwertig ausgerichtet.

Upload-Auswahl, Textfeld und URL-Feld dürfen fachlich unterschiedlich funktionieren, sollen in derselben Zeile jedoch dieselbe visuelle Höhe und Grundlinie besitzen.

URL-Felder verwenden zusätzlich den `URL-INPUT-STANDARD.md`.

Datumsfelder verwenden zusätzlich die Datumsregeln aus `ui-standard.md`.

### 7. Formlayout und Spalten

Zusammengehörige Felder dürfen auf Desktop in zwei oder mehr Spalten dargestellt werden, wenn dies die Bedienung vereinfacht.

Verbindlich:

- Spalten ergeben sich aus fachlicher Gruppierung, nicht aus optischer Füllung,
- wiederholbare gleichwertige Felder erhalten möglichst gleichwertige Spaltenbreiten,
- auf kleinen Displays erfolgt ein sauberer Reflow auf eine Spalte,
- Aktionen stehen auf derselben visuellen Grundlinie wie der zugehörige Datensatz.

### 8. Wiederholbare Zeilen und Containergruppen

Wiederholbare Datensätze wie Sponsoren, Event-Tage, Ansprechpartner oder Helferschichten verwenden strukturierte Zeilen oder Container.

Verbindlich:

- jeder Eintrag ist klar vom nächsten getrennt,
- Felder sind eindeutig beschriftet,
- Aktionen gehören sichtbar zum jeweiligen Eintrag,
- neue Einträge verwenden dasselbe Layout wie bestehende Einträge,
- keine Sammel-Textfelder für fachlich einzeln bearbeitbare Daten,
- Persistenz erfolgt über die fachliche Datenquelle, nicht über Session- oder reine UI-Zustände.

### 9. Auf- und zuklappbare Arbeitsbereiche

Komplexe Arbeitsbereiche dürfen komplett ein- und ausklappbar sein.

Verbindlich:

- Überschrift bleibt im eingeklappten Zustand sichtbar,
- Chevron/Toggle bleibt an einer stabilen Position,
- das Einklappen verändert keine Fachdaten,
- untergeordnete Container dürfen unabhängig davon eigene Toggle-Zustände besitzen,
- UI-Zustand muss nur dann persistent gespeichert werden, wenn daraus ein echter Nutzwert entsteht.

### 10. Sortierung und Reihenfolge

Wenn Daten eine natürliche fachliche Reihenfolge besitzen, wird die Darstellung daraus abgeleitet.

Verbindlich:

- Datumsobjekte werden chronologisch dargestellt,
- bei Datumsänderung wird die Reihenfolge nach dem Speichern neu berechnet,
- sichtbare Nummerierungen wie `Tag 1`, `Tag 2`, … werden aus der fachlichen Reihenfolge abgeleitet und nicht unabhängig davon gepflegt,
- bei identischem Sortierwert existiert ein dokumentierter stabiler Tie-Breaker,
- die Sortierung darf keine zweite fachliche Source of Truth erzeugen.

Referenz Event Planner bei gleichem Datum:

`Aufbau → Eventtag → Abbau`.

### 11. Kompakte Kennzahlen in Übersichtszeilen

Wenn ein eingeklappter Container relevante Untereinträge enthält, darf deren Anzahl direkt in der Kopfzeile angezeigt werden.

Beispiele:

- `0 Programmpunkte`,
- `1 Programmpunkt`,
- `4 Programmpunkte`,
- später analog z. B. `3 Schichten` oder `2 offene Aufgaben`.

Verbindlich:

- nur fachlich echte Untereinträge zählen,
- technische Hilfseinträge werden nicht mitgezählt,
- Singular/Plural wird verständlich dargestellt,
- Kennzahlen dienen der Orientierung und ersetzen keine Detailansicht.

### 12. Status- und Fortschrittskacheln

Statuskacheln folgen dem zentralen Zustandsmodell:

- Grau = noch nicht begonnen / neutral,
- Blau = geplant / in Bearbeitung,
- Gelb/Orange = teilweise erledigt / Aufmerksamkeit nötig,
- Grün = vollständig erfüllt,
- Rot = echter kritischer Zustand.

Rot ist kein normaler Planungsschritt.

Farbe vermittelt den Zustand nie allein. Jede Kachel enthält zusätzlich eine verständliche Textaussage.

Fachliche Kennzahlen werden aus persistenten Daten abgeleitet und nicht manuell als separater Status gepflegt, wenn dies vermeidbar ist.

### 13. Typografie

Backend-Komponenten verwenden eine klare, wiedererkennbare Hierarchie.

Verbindlich:

- Seitentitel deutlich größer als Bereichsüberschriften,
- Bereichsüberschrift größer als Feld-/Zeilenüberschrift,
- Labels klar lesbar und semibold bzw. ausreichend hervorgehoben,
- Hilfetexte visuell zurückgenommen,
- keine projektspezifische Schriftfamilie nur für einzelne Plugins.

Die konkrete Backend-Typografie orientiert sich an WordPress bzw. neutralen Systemschriften.

### 14. Spacing

Neue Komponenten orientieren sich an der gemeinsamen Spacing-Skala aus `ui-standard.md`:

`4 / 8 / 12 / 16 / 24 / 32 / 48 px`.

Bestehende bewährte Event-Planner-Abstände dürfen weiterverwendet werden; neue willkürliche Einzelwerte werden vermieden.

### 15. Responsive Verhalten

Backend-Komponenten müssen auf kleineren Viewports sinnvoll umbrechen.

Verbindlich:

- mehrspaltige Formulare werden auf eine Spalte reduziert,
- Aktionsgruppen dürfen umbrechen,
- Felder behalten ausreichend Breite,
- Touch-Ziele bleiben erreichbar,
- keine horizontale Scrollpflicht für normale Formulararbeit,
- zentrale Aktion und Information bleiben zuerst sichtbar.

### 16. Accessibility und Fokus

Alle neuen Komponenten beachten mindestens:

- Tastaturbedienbarkeit,
- sichtbaren Fokus,
- verständliche zugängliche Namen,
- programmatisch zugeordnete Labels,
- Farbe nie als einziger Informationsträger,
- ausreichende Touch-Ziele,
- verständliche Reihenfolge im DOM.

### 17. Create/Edit-Konsistenz

Anlegen und Bearbeiten derselben Fachentität verwenden dieselben UI-Komponenten.

Das betrifft insbesondere:

- Karten,
- Feldgruppen,
- Labels,
- Control-Höhen,
- Buttons,
- wiederholbare Zeilen,
- Uploads,
- Checkboxen,
- URL- und Datumsfelder.

Die fachlichen Felder dürfen variieren; die Bedienlogik nicht ohne Grund.

### 18. Referenzimplementierung Event Planner

Aktuell bewährte Referenzmuster sind insbesondere:

- Event-Dashboard-Karten,
- Event-Create-/Edit-Formulare,
- Plus-Muster für wiederholbare Einträge,
- CRUD-Iconleiste der Event-Tage,
- aufklappbarer Block `Programmpunkte und Ablaufplanung`,
- Tagescontainer mit abgeleiteter Datums-Sortierung,
- Programmpunkt-Kennzahl je Tag,
- zeilenweise Sponsorpflege,
- Status-/Fortschrittskacheln.

Diese Muster dürfen von anderen Backend-Modulen übernommen werden, ohne ein neues projektspezifisches UI-System aufzubauen.

### 19. Neue Komponenten

Ein neues UI-Muster wird nicht sofort organisationsweiter Standard.

Vorgehen:

1. bestehende Komponente prüfen,
2. bestehendes Muster wenn möglich erweitern,
3. neues Muster in einem realen Anwendungsfall erproben,
4. erst nach bewährter Nutzung in diesen Standard aufnehmen.

## Relationship to other documents

- `ui-standard.md`
- `backend-form-standard.md`
- `design-principles.md`
- `../standards/data-persistence-and-database-standard.md`
- `../projects/event-planner/EVENT-FORM-UI.md`
- `../projects/event-planner/EVENT-EDIT-UI.md`
- `../projects/event-planner/EVENT-DAY-PLANNING.md`
- `../projects/event-planner/STATUS-COLOR-STANDARD.md`

## Future Development

Die nächsten Backend-Module sollen diese Komponenten zuerst wiederverwenden. Wenn sich konkrete gemeinsame CSS-/JS-Komponenten mehrfach bewähren, können sie später technisch in ein gemeinsames Core-UI-Paket überführt werden. Eine solche technische Abstraktion wird erst eingeführt, wenn sie real benötigt wird.