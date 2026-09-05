# Event Planner – Data Persistence

## Purpose

Dieses Dokument definiert die verbindliche Datenhaltungsregel für den TuS Event Planner.

Es verhindert, dass fachlich dauerhafte Informationen nur in Sessions, temporären Browser-Zuständen, Query-Parametern, JavaScript-Speichern oder vergleichbaren flüchtigen Mechanismen gehalten werden.

## Core Principle

**Alles, was fachlich dauerhaft vorhanden sein muss, wird dauerhaft in der Datenbank gespeichert.**

Persistente Event-Daten dürfen nicht von einer Browser-Session, einer Session-ID oder einem einzelnen Seitenaufruf abhängen.

Nach einem erfolgreichen Speichervorgang müssen die Daten auch dann weiterhin vorhanden sein, wenn:

- die Seite neu geladen wird,
- der Browser geschlossen wird,
- die Sitzung endet,
- sich ein anderer berechtigter Benutzer anmeldet,
- das Event Tage oder Monate später erneut geöffnet wird.

## Main Content

### 1. Datenbank als fachliche Quelle

Für dauerhafte fachliche Informationen ist die WordPress-/Plugin-Datenbank die maßgebliche Laufzeitquelle.

Dazu gehören insbesondere:

- Event-Stammdaten,
- Event-Art,
- Start- und Enddatum,
- Veranstaltungsort,
- Beschreibung und zusätzliche Links,
- öffentliche Kalender-Sichtbarkeit,
- Camp-spezifische Informationen,
- Event-Tage und Programmpunkte,
- Turnierdaten,
- Teams, Gruppen, Spiele und Ergebnisse,
- Event-Aufgaben und Checklisten,
- Helferbedarf und Helferschichten,
- Anmeldungen und bestätigte Einsatzzeiten,
- Bestellungen,
- eventbezogene Ausgaben,
- Event-Templates,
- eventbezogene Sponsoreninformationen,
- Status- und Archivinformationen,
- alle weiteren Informationen, die nach einem abgeschlossenen Speichervorgang verlässlich wieder verfügbar sein müssen.

Die konkrete Tabellen- und Relationsstruktur wird jeweils so einfach wie möglich gehalten, muss aber die fachliche Information dauerhaft und nachvollziehbar abbilden.

### 2. Formularfelder

Ein Formularfeld, dessen Inhalt Teil des dauerhaften fachlichen Datensatzes ist, muss beim vorgesehenen Speichervorgang in der Datenbank persistiert werden.

Ein sichtbares Formularfeld darf nicht nur deshalb existieren, weil sein Wert kurzfristig in einer Session oder im Browser gehalten werden kann.

Für jedes dauerhaft relevante neue Formularfeld wird vor Implementierung geklärt:

1. Zu welchem fachlichen Objekt gehört der Wert?
2. Wo wird der Wert dauerhaft gespeichert?
3. Wie wird er beim erneuten Öffnen geladen?
4. Wie wird bestehender Datenbestand bei einer Schemaänderung geschützt oder migriert?
5. Wie wird Speichern und erneutes Laden im Test verifiziert?

### 3. Sessions und temporärer Zustand

Sessions oder andere temporäre Zustände dürfen nur für wirklich flüchtige technische bzw. UI-Zwecke verwendet werden.

Beispiele für zulässigen temporären Zustand können sein:

- kurzfristige UI-Auswahl vor einem endgültigen Speichervorgang,
- einmalige Meldungen nach einem Redirect,
- technische Nonces/Sicherheitsmechanismen,
- noch nicht abgeschickte Zwischenzustände, sofern ein Verlust ausdrücklich akzeptabel ist.

Sie dürfen **nicht** als Source of Truth für dauerhafte Fachdaten dienen.

Insbesondere unzulässig ist die Logik:

> Die Information ist dauerhaft wichtig, wird aber nur über eine Session-ID wiedergefunden.

### 4. Medien und Uploads

Bilder und Dateien werden über geeignete dauerhafte WordPress-Medien-/Dateimechanismen gespeichert.

Der zugehörige fachliche Datensatz speichert eine stabile Referenz, beispielsweise eine WordPress-Attachment-ID oder eine andere ausdrücklich definierte dauerhafte Referenz.

Ein nur temporärer Upload-Pfad oder ein Browserzustand reicht nicht als dauerhafte Medienreferenz.

### 5. Strukturierte Daten statt Sammelfelder

Dauerhafte Informationen werden entsprechend ihrer fachlichen Struktur gespeichert.

Wenn Informationen später einzeln gesucht, bearbeitet, ausgewertet oder wiederverwendet werden sollen, dürfen sie nicht nur als unstrukturiertes Sammelfeld persistiert werden.

Beispiel Event-Sponsoren:

- Name,
- Logo-/Medienreferenz,
- Homepage-Link

sind fachlich getrennte Werte und sollen entsprechend strukturiert gespeichert werden.

### 6. Speichern bedeutet dauerhaft speichern

Eine erfolgreiche Benutzeraktion wie `Event anlegen`, `Speichern`, `Aktualisieren` oder eine vergleichbare fachliche Aktion bedeutet:

**Die bestätigten fachlichen Daten sind danach dauerhaft persistiert.**

Ein UI-Erfolgshinweis darf nicht angezeigt werden, wenn die relevanten Daten nur im temporären Zustand angekommen sind.

### 7. Persistenz als Testkriterium

Bei neuen oder geänderten persistenten Feldern reicht es nicht, nur zu prüfen, ob der Wert direkt nach Eingabe sichtbar ist.

Mindestens geprüft wird:

1. Wert eingeben,
2. speichern,
3. Seite neu laden bzw. Objekt verlassen,
4. Objekt erneut öffnen,
5. gespeicherten Wert vergleichen.

Bei relevanten Relationen oder Listen – beispielsweise Sponsoren, Aufgaben, Schichten oder Bestellungen – wird zusätzlich geprüft, dass mehrere Einträge, Änderungen und Löschungen korrekt erhalten bleiben.

### 8. Schemaänderungen und Rückwärtskompatibilität

Neue dauerhafte Felder oder strukturierte Daten können Datenbankänderungen erforderlich machen.

Dabei gelten die bestehenden Entwicklungsstandards für Migrationen und Datenerhalt.

Insbesondere:

- bestehende Daten werden nicht still verworfen,
- Migrationen sind nachvollziehbar,
- bei strukturellen Änderungen wird ein Rückweg oder mindestens ein klarer Schutz des Altbestands berücksichtigt,
- bestehende produktive Inhalte werden vor einer Migration analysiert,
- eine Datenbankänderung wird nicht durch Session-/Browser-Tricks vermieden, wenn fachlich dauerhafte Persistenz notwendig ist.

## Relationship to other documents

- `FUNCTIONAL-SCOPE.md` beschreibt die fachlich benötigten Informationen.
- `EVENT-FORM-UI.md` beschreibt die Struktur der Event-Anlage und verweist für dauerhafte Formularwerte auf diese Regel.
- `PROJECT-STATE.md` hält aktuelle Persistenzentscheidungen und offene Migrationen fest.
- `SMOKE-TEST.md` prüft grundlegende Speicher- und Wiederladefähigkeit.
- `../../roles/wordpress-developer/development-standard.md` definiert die allgemeinen Anforderungen an Datenbankänderungen, Migrationen und Tests.

## Future Development

Bei jeder neuen Event-Planner-Funktion wird die Frage nach der dauerhaften Datenquelle **vor** der UI-Implementierung beantwortet.

Quick-&-dirty-Zwischenlösungen mit Session-IDs oder flüchtigem Browserzustand dürfen nicht zu einer dauerhaften Architektur werden.
