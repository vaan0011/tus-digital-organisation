# Homepage Standard

## Purpose

Dieses Dokument hält die fachliche und gestalterische Grundlage für den Neuaufbau der öffentlichen TuS-Mingolsheim-Homepage fest.

Die Homepage ist die zentrale digitale Heimat des Vereins. Sie soll aktuelle Informationen, dauerhafte Vereinsinhalte und klare Nutzerwege zusammenführen, ohne Instagram oder Facebook nachzubauen.

Die Spezifikation dient zugleich als Übergabe an Entwicklung und Codex und als praktische Referenz für das entstehende TuS Digital Design System.

## Core Principle

**Weniger zeigen. Besser führen.**

Die Startseite beantwortet schnell drei Fragen:

1. Was ist der TuS?
2. Was passiert gerade?
3. Wie komme ich zu dem, was ich suche?

Jeder Abschnitt hat eine klare Aufgabe. Mobile ist nicht Desktop in schmal.

Eine Homepage-Komponente gilt erst dann als fertig, wenn Desktop-, Tablet- und Smartphone-Verhalten definiert und geprüft sind.

## Main Content

### 1. Marken- und Asset-Regeln

- Hauptfarben des Vereins sind Rot und Weiß. Exakte technische Farbwerte werden ausschließlich aus dem zentralen Brand-Standard übernommen, sobald sie freigegeben sind.
- Das TuS-Logo ist ein Locked Asset.
- Für die Homepage werden ausschließlich die offiziellen Dateien aus `design/logo/` verwendet, insbesondere `tus_logo.png` und `tus_logo_flach.png`.
- Das Logo wird niemals durch generative Bildwerkzeuge neu erzeugt, nachgezeichnet, interpretiert oder verändert.
- Generierte Mockups dürfen nur Layout- und Stilkonzepte liefern. Finale Oberflächen verwenden die Originalassets.
- Finale Websitebilder sollen bevorzugt echte TuS-Personen, Mannschaften, Veranstaltungen, Vereinsgeschichte und den Sportpark zeigen. Generische Fußballmotive sind kein Ersatz für authentisches Vereinsmaterial.

### 2. Rolle der öffentlichen Kanäle

- **Homepage:** zentrale, geordnete und dauerhafte Informationsplattform.
- **Instagram:** schnelle, emotionale und aktuelle Kommunikation.
- **Facebook:** aktuelle Vereinskommunikation und zusätzliche Reichweite.

Die Kanäle teilen eine erkennbare TuS-Identität, verwenden aber nicht zwangsläufig dieselben Layouts.

### 3. Informationsarchitektur der Startseite

Die Startseite verwendet in V1 folgende Reihenfolge:

1. Header
2. Hero
3. Nächste Spiele
4. Schnelleinstiege
5. Aktuelles
6. Jubiläumsmagazin
7. Abteilungen
8. Veranstaltungen
9. Der Verein / Kennzahlen
10. Partner
11. Social Media
12. Service / Footer

Pflicht- oder Förderinformationen bleiben verfügbar, dominieren aber nicht den oberen Startseitenbereich. Ausführliche Informationen können auf passende Unterseiten ausgelagert und von der Startseite kompakt verlinkt werden.

### 4. Header und Navigation

#### Desktop

Primäre Navigation:

- Aktuelles
- Fußball
- Abteilungen
- Verein
- Mitmachen
- Partner
- Service

Ergänzend:

- Shop
- Suche
- Instagram
- Facebook

Fußball erhält aufgrund seiner Größe einen eigenen Hauptpunkt. Andere Abteilungen werden nicht als unwichtiger Rest behandelt.

Unter `Abteilungen` werden die jeweils aktuellen Vereinsbereiche geführt, beispielsweise:

- Damengymnastik
- Theatergruppe
- Freizeitsport
- Sportparkteam
- weitere aktive Abteilungen
- Alle Abteilungen

Die Struktur muss erweiterbar sein und darf nicht technisch auf eine feste Liste beschränkt werden.

#### Mobile

Im mobilen Header stehen im Wesentlichen:

- Original-TuS-Logo
- Suche
- Burger-Menü

Die Navigation öffnet sich als klarer Drawer oder Vollbildbereich. Eine Desktopnavigation wird nicht lediglich verkleinert.

### 5. Hero

Der Hero erzeugt Emotion und Markenwirkung und vermeidet Informationsüberladung.

Referenzrichtung:

- `Seit 1901`
- `Ein Verein. Viele Möglichkeiten.`
- kurze Einordnung von Sport, Kultur und Gemeinschaft
- primäre Aktion `TuS entdecken`
- sekundäre Aktion `Mitmachen`

Der Hero verwendet bevorzugt echte TuS-Fotografie.

Auf Mobile wird das Bild sinnvoll für Hochformat/Crop angepasst. Text und Handlungsoptionen müssen ohne Zoom lesbar und bedienbar sein.

### 6. Nächste Spiele

Spieldaten werden **nicht doppelt manuell in WordPress gepflegt**.

Die fachliche Quelle für Spielinformationen ist `fussball.de`. Die Homepage zieht die relevanten Informationen von dort und stellt sie im TuS-Design aufbereitet dar.

Eine `MatchCard` kann enthalten:

- Mannschaft
- Wettbewerb/Liga
- Heim- und Gastmannschaft
- Vereinswappen, soweit technisch und rechtlich nutzbar
- Datum
- Uhrzeit
- Spielort
- Heim/Auswärts
- Status beziehungsweise Ergebnis nach Spielende

Auf der Startseite werden nicht alle Spiele gleichgewichtig dargestellt. Priorisiert werden insbesondere:

- 1. Mannschaft Herren
- 2. Mannschaft Herren
- Frauen / SpG St. Leon-Mingolsheim
- ausgewählte bzw. nächste Jugendspiele
- zusammengefasster Einstieg zu weiteren Jugendspielen

Jugendspiele dürfen beispielsweise als `8 weitere Jugendspiele diese Woche` zusammengefasst werden.

Desktop kann mehrere Match Cards gleichzeitig zeigen. Mobile zeigt eine reduzierte Auswahl beziehungsweise horizontal swipebare Karten plus `Alle Spiele`.

### 7. Schnelleinstiege

Schnelleinstiege orientieren sich an Nutzerzielen und nicht an der internen Vereinsorganisation.

V1:

- Probetraining – `Ich möchte beim TuS Fußball spielen.`
- Jugend & Eltern – `Mein Kind möchte Fußball spielen.`
- Mithelfen – `Ich möchte mich beim TuS engagieren.`
- Partner werden – `Ich möchte den TuS unterstützen.`

### 8. Aktuelles

WordPress-Beiträge werden redaktionell gewichtet und nicht lediglich als chronologische Liste ausgegeben.

Referenzmuster:

- eine Lead Story
- zwei oder mehrere kleinere News
- `Alle Nachrichten`

Mobile priorisiert die Lead Story und verwendet anschließend kompaktere News Cards.

### 9. Jubiläumsmagazin

Das veröffentlichte Magazin `125 Jahre TuS Magazin V2` ist 2026 ein prominenter Startseiteninhalt und die wichtigste aktuelle Editorial-/Print-Referenz.

Das echte Magazincover wird als Originalasset beziehungsweise kontrolliertes Mockup verwendet und nicht generativ nachgebaut.

Der Einstieg verweist direkt auf die digitale Ausgabe/PDF.

### 10. Abteilungen

Die Homepage kommuniziert ausdrücklich, dass TuS Mingolsheim mehr als Fußball ist.

Mögliche Abteilungs-Cards:

- Fußball
- Damengymnastik
- Theatergruppe
- Freizeitsport
- Sportparkteam
- weitere aktive Vereinsbereiche

Die Darstellung muss dynamisch erweiterbar sein.

Fußball darf prominent sein, ist aber nicht mit dem gesamten Verein gleichzusetzen.

### 11. Veranstaltungen

Veranstaltungen werden perspektivisch aus dem TuS Eventplaner gespeist.

Die Homepage führt keine zweite manuelle Eventdatenbank.

Eine `EventCard` kann enthalten:

- Bild
- Titel
- Datum/Zeitraum
- Ort
- Link zur Veranstaltung

Grundprinzip: **einmal pflegen – mehrfach verwenden.**

### 12. Der Verein und Kennzahlen

Ein emotionaler Vereinsbereich verbindet echte Fotografie mit wenigen aussagekräftigen Kennzahlen.

Aktuelle Referenzwerte, vor Veröffentlichung zu prüfen:

- ca. 670 Mitglieder
- ca. 380 Kinder und Jugendliche
- 30+ Trainer und Betreuer
- 125 Jahre TuS im Jubiläumsjahr 2026

Kennzahlen sollen perspektivisch zentral gepflegt werden und nicht auf mehreren Seiten voneinander unabhängig hardcodiert sein.

### 13. Partner

Die Startseite zeigt eine kuratierte Auswahl von Partnern und keine unstrukturierte Logo-Wand.

Vorgesehene Einstiege:

- Alle Partner
- Partner werden

Perspektivisch können die Daten aus dem Partnerportal kommen.

### 14. Social Media

Instagram kann mit wenigen aktuellen Beiträgen eingebunden werden.

Facebook benötigt keinen zweiten, nahezu identischen Feed. Ein gut sichtbarer Link ist ausreichend, solange kein fachlicher Grund für eine eigene Integration besteht.

### 15. Footer und Service

Der Desktop-Footer bündelt insbesondere:

- Kontakt und Sportpark
- Spielplan
- Veranstaltungen
- Platzbelegung
- Mitgliedschaft
- Downloads
- Ansprechpartner
- Gaststätte
- Shop
- Impressum
- Datenschutz
- Satzung
- Instagram
- Facebook

Auf Mobile werden umfangreiche Linkgruppen bevorzugt als übersichtliche Akkordeons oder gestapelte Bereiche dargestellt.

### 16. Responsive Prinzipien

Responsive Design folgt drei Mechanismen:

#### Reflow

Elemente werden sinnvoll neu angeordnet. Mehrspaltige Desktopbereiche brechen kontrolliert um.

#### Reduce

Mobile muss nicht jede Desktopinformation gleichzeitig zeigen. Zusätzliche Inhalte können über `Alle Spiele`, `Alle Nachrichten`, `Alle Veranstaltungen` usw. erreichbar bleiben.

#### Prioritize

Die wichtigste Information erscheint zuerst. Bei einer Match Card beispielsweise:

1. Mannschaft
2. Gegner
3. Datum und Uhrzeit
4. Ort
5. sekundäre Ligainformationen

Touch-Ziele, Lesbarkeit, Kontrast und Ladezeit sind Teil der Gestaltung und keine nachträgliche Optimierung.

### 17. Gemeinsame UI-Komponenten

Die Homepage dient als praktische Quelle für wiederverwendbare öffentliche TuS-Komponenten.

V1-Kandidaten:

- `TusHeader`
- `TusMobileMenu`
- `HeroSection`
- `MatchCard`
- `NewsCard`
- `EventCard`
- `DepartmentCard`
- `ActionCard`
- `PartnerLogo` / `PartnerCard`
- `StatItem`
- `SectionHeader`
- `TusButton`
- `TusFooter`

Diese Komponenten sollen nicht ausschließlich für die Homepage gedacht werden. Geeignete Muster werden in das gemeinsame TuS Digital Design System übernommen und können unter anderem Eventplaner, Partnerportal und weitere öffentliche TuS-Anwendungen unterstützen.

### 18. Daten- und Systemgrenzen

Zielarchitektur:

```text
WordPress / TuS Frontend
|
|-- fussball.de Integration
|   `-- MatchCard
|
|-- TuS Eventplaner
|   `-- EventCard
|
|-- WordPress Posts
|   `-- NewsCard
|
|-- Abteilungen
|   `-- DepartmentCard
|
`-- Partnerportal (perspektivisch)
    `-- PartnerCard / PartnerLogo
```

Die Homepage soll Daten aus fachlich führenden Systemen aufbereiten, statt dieselben Informationen erneut manuell zu speichern.

### 19. Abnahmekriterien für neue Homepage-Komponenten

Eine neue oder veränderte Komponente gilt erst als designseitig belastbar, wenn mindestens geprüft wurde:

- Originalassets werden korrekt verwendet.
- Desktop-Verhalten ist definiert.
- Tablet-Verhalten ist definiert.
- Mobile-Verhalten ist definiert.
- Touch- und Tastaturbedienung wurden berücksichtigt.
- Informationshierarchie bleibt auf kleinen Displays verständlich.
- unnötige Inhalte werden auf Mobile reduziert statt nur verkleinert.
- Datenquelle und Fallback-Verhalten sind bekannt.
- die Komponente erfindet kein unabhängiges Farb-, Typografie- oder Interaktionssystem.

## Relationship to other documents

- `README.md` – Einstieg in die zentrale Designorganisation
- `brand-identity.md` – übergreifende Markenidentität
- `logo.md` und `logo/` – verbindliche Logo-Regeln und Originalassets
- `colors.md` – Farbdefinitionen
- `typography.md` – Typografie
- `design-principles.md` – übergreifende Gestaltungsprinzipien
- `ui-standard.md` – gemeinsamer Standard für digitale Oberflächen
- `design-workflow.md` – Iterations- und Freigabeprozess
- `generative-design-standard.md` – Grenzen generativer Gestaltung
- `product-types.md` – Einordnung von Website und UI als Produktklassen
- Eventplaner – perspektivische führende Quelle für Veranstaltungsdaten
- Partnerportal – perspektivische führende Quelle für Partnerdaten

## Future Development

Die nächste Ausbaustufe soll nicht weitere Konzeptgrafiken erzeugen, sondern die wiederverwendbaren Komponenten konkretisieren.

Priorität:

1. Header und Mobile Navigation
2. Hero
3. MatchCard inklusive fussball.de-Datenmodell
4. Schnelleinstiege
5. NewsCard und Jubiläumsmodul
6. DepartmentCard
7. EventCard und Eventplaner-Anbindung
8. Footer

Nach praktischer Umsetzung werden bewährte Komponenten, Spacing-Regeln, Breakpoints, Typografie, Icons, Accessibility-Regeln und Design Tokens in `ui-standard.md` beziehungsweise weitere zentrale Standards übernommen.

Nicht jede Homepage-Lösung wird automatisch organisationsweiter Standard. Übernommen werden nur Muster, die sich in realer Nutzung bewähren.