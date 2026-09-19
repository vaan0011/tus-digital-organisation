# Event Planner – Event-Tage und Ablaufplanung

## Purpose

Dieses Dokument beschreibt die verbindliche Logik für Event-Tage, Aufbau, Abbau und die Zuordnung von Programmpunkten im Event Planner.

## Core Principle

**Tage sind persistente fachliche Objekte und keine rein visuelle Gruppierung.**

Ein Event-Tag besitzt dauerhaft ein Datum, eine Rolle und eine Reihenfolge. Programmpunkte gehören eindeutig zu einem konkreten Event-Tag.

## Main Content

### 1. Tagesrollen

Der Event Planner kennt drei Rollen:

- `event` – normaler Veranstaltungstag,
- `setup` – Aufbau,
- `teardown` – Abbau.

Aufbau und Abbau sind eigenständige Tagescontainer. Dadurch können sie bei Bedarf dasselbe Kalenderdatum wie ein normaler Event-Tag besitzen, ohne mit diesem zusammenzufallen.

**Aufbau und Abbau sind keine Programmpunkt-Typen und besitzen kein eigenes Programm.** Sie werden deshalb nicht im Programmpunkt-Dropdown angeboten und erzeugen beim Anlegen keinen künstlichen Programmpunkt.

### 2. Automatische Initialisierung aus dem Event-Datumsbereich

Beim Anlegen eines Events werden Start- und Enddatum bereits als fachliche Stammdaten gespeichert.

Wenn für ein Event noch keine persistenten Tagescontainer existieren, erzeugt der Ablaufplan beim ersten Öffnen automatisch für **jeden Kalendertag des Event-Datumsbereichs** einen normalen Event-Tag.

Beispiel:

- Startdatum: 19.09.2026
- Enddatum: 22.09.2026

Der Ablaufplan startet automatisch mit:

- Tag 1 – 19.09.2026
- Tag 2 – 20.09.2026
- Tag 3 – 21.09.2026
- Tag 4 – 22.09.2026

Bei einem eintägigen Event entsteht genau ein normaler Event-Tag.

Diese Initialisierung greift nur, solange noch keine eigenen Tagescontainer für das Event existieren. Bereits bearbeitete Ablaufpläne werden nicht automatisch überschrieben oder erneut aus dem Stammdatenbereich aufgebaut.

### 3. Neuer Event-Tag

`Neuen Tag hinzufügen` erzeugt einen normalen Event-Tag.

Der Default ist:

**letzter normaler Event-Tag + 1 Kalendertag**.

Beispiel:

- letzter Event-Tag: 25.10.2026,
- neuer Event-Tag: 26.10.2026,
- nächster neuer Event-Tag: 27.10.2026.

Der Nutzer kann das Datum anschließend normal bearbeiten.

### 4. Aufbau hinzufügen

`Aufbau hinzufügen` erzeugt einen neuen Tagescontainer vom Typ `setup`.

Default:

**frühester vorhandener Tag − 1 Kalendertag**.

Der Container selbst repräsentiert den Aufbau. Es wird **kein Programmpunkt `Aufbau`** angelegt und es gibt innerhalb dieses Containers keine Programmpunkt-Liste.

Für den Aufbau werden ausschließlich folgende Planungsdaten gepflegt:

- Datum,
- Uhrzeit.

Datum und Uhrzeit bleiben editierbar. Der Aufbau darf deshalb auch auf denselben Kalendertag wie der erste eigentliche Event-Tag gelegt werden.

### 5. Abbau hinzufügen

`Abbau hinzufügen` erzeugt einen neuen Tagescontainer vom Typ `teardown`.

Default:

**spätester vorhandener Tag + 1 Kalendertag**.

Der Container selbst repräsentiert den Abbau. Es wird **kein Programmpunkt `Abbau`** angelegt und es gibt innerhalb dieses Containers keine Programmpunkt-Liste.

Für den Abbau werden ausschließlich folgende Planungsdaten gepflegt:

- Datum,
- Uhrzeit.

Datum und Uhrzeit bleiben editierbar. Der Abbau darf deshalb auch auf denselben Kalendertag wie der letzte eigentliche Event-Tag gelegt werden.

### 6. Programmpunkt-Typen

Die Programmpunkt-Auswahl enthält ausschließlich echte Inhalte des Veranstaltungsprogramms.

Aktuell zulässige Typen:

- `Programmpunkt`,
- `Musik`,
- `Spiel`.

`Aufbau` und `Abbau` gehören ausdrücklich nicht in diese Auswahl und erhalten selbst keine Programmpunkte.

### 7. Überschriften

Normale Event-Tage werden nur untereinander nummeriert. Aufbau und Abbau zählen nicht in die `Tag X`-Nummerierung hinein.

Format:

- `Tag 1 – Montag, 19. Oktober 2026`
- `Tag 2 – Dienstag, 20. Oktober 2026`
- `Aufbau – Sonntag, 18. Oktober 2026`
- `Abbau – Mittwoch, 21. Oktober 2026`

### 8. Chronologische Reihenfolge und Programmpunkt-Anzeige

Die Tagesübersicht ist immer chronologisch nach dem eingestellten Datum sortiert.

Wenn ein Nutzer das Datum eines Tages ändert und den Ablauf speichert, wird die Reihenfolge beim Speichern neu bestimmt. Die Nummerierung `Tag 1`, `Tag 2`, … folgt anschließend dieser chronologischen Reihenfolge und nicht der früheren Position im Formular.

Für mehrere Tagescontainer am selben Kalenderdatum gilt die fachliche Reihenfolge:

1. Aufbau,
2. normaler Event-Tag,
3. Abbau.

In der kompakten Kopfzeile eines normalen Event-Tages wird zusätzlich die Zahl der diesem Tag zugeordneten echten Programmpunkte angezeigt, zum Beispiel:

- `0 Programmpunkte`,
- `1 Programmpunkt`,
- `4 Programmpunkte`.

Aufbau- und Abbau-Container erhalten keine Programmpunkt-Kennzahl. Frühere technische Einträge mit `item_type = Aufbau` oder `Abbau` werden nicht als echte Programmpunkte gezählt.

### 9. Bearbeitung und Speichern

Der gesamte Ablaufplan befindet sich bereits im Bearbeitungsmodus. Deshalb gibt es für einzelne Tageszeilen **keinen zusätzlichen Edit- oder Speichern-Modus**.

Für normale Event-Tage gilt:

1. Datum ist direkt über das Datumsfeld bzw. Kalender-Icon editierbar,
2. Aufklappen / Einklappen steuert nur die Sichtbarkeit der Programmpunkte,
3. Programmpunkte können innerhalb des aufgeklappten Tages gepflegt werden,
4. Löschen entfernt den Tagescontainer.

Für Aufbau und Abbau gilt:

1. Datum ist direkt editierbar,
2. Uhrzeit ist direkt editierbar,
3. es gibt keinen Programmbereich und kein Auf-/Zuklappen,
4. Löschen entfernt den Tagescontainer.

**Gespeichert wird der komplette Ablaufplan gesammelt über `Event-Ablauf speichern`.** Separate Edit-Stifte oder Speicher-Buttons pro Zeile sind nicht vorgesehen.

### 10. Persistenz

Event-Tage werden dauerhaft in der Datenbank gespeichert.

Dafür existiert die Tabelle `vtp_event_days` mit mindestens:

- Event-ID,
- Datum,
- Tagesrolle,
- Uhrzeit für Aufbau/Abbau,
- Reihenfolge.

Die Uhrzeit von Aufbau und Abbau wird als Fachdatenwert am jeweiligen Tagescontainer gespeichert. Normale Event-Tage verwenden dieses Feld nicht; deren Uhrzeiten gehören zu den einzelnen Programmpunkten.

Programmpunkte erhalten zusätzlich eine dauerhafte Zuordnung zum konkreten Event-Tag über `event_day_id`.

Serverseitig werden Programmpunkte ausschließlich normalen Event-Tagen zugeordnet. Für `setup` und `teardown` werden keine Programmpunkte gespeichert.

Damit bleiben auch zwei unterschiedliche Tagescontainer mit demselben Kalenderdatum eindeutig unterscheidbar.

Bestehende ältere Eventdaten werden beim Upgrade in normale Event-Tage migriert. Die bisherige `vtp_event_days_<event_id>`-Option bleibt nur als Rückwärtskompatibilitätsabbild bestehen und ist nicht mehr die fachliche Source of Truth.

Bestehende ältere Einträge mit `item_type = Aufbau` oder `Abbau` werden in der UI nicht mehr als reguläre Programmpunkte angeboten oder dargestellt. Die fachliche Repräsentation erfolgt über die Tagesrollen `setup` und `teardown`.

## Relationship to other documents

- `EVENT-EDIT-UI.md`
- `DATA-PERSISTENCE.md`
- `EVENT-FORM-UI.md`
- `PROJECT-STATE.md`

## Future Development

Die Tagesrollen können später für Templates, Aufgaben, Helferbedarf und Schichten genutzt werden. Neue Rollen werden nur eingeführt, wenn sie einen echten wiederkehrenden fachlichen Nutzen besitzen.
