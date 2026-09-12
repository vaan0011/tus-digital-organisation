# Data Persistence & Database Standard

## Purpose

Dieser Standard definiert die organisationsweite Regel für dauerhafte Datenhaltung, Datenmodelle und Datenbankänderungen in Software der TuS Digital Organisation.

Er soll verhindern, dass fachlich wichtige Daten in flüchtigen Zuständen verloren gehen, dass mehrere Plugins dieselbe Wahrheit unabhängig speichern oder dass kurzfristige UI-Entscheidungen das Datenmodell bestimmen.

## Core Principle

> **Dauerhafte Fachdaten besitzen eine dauerhafte fachliche Quelle. Temporärer Zustand bleibt temporär.**

Alles, was nach einem erfolgreichen Speichervorgang später wieder verlässlich benötigt wird, muss unabhängig von Browser, Session, Gerät und Benutzer-Login dauerhaft gespeichert sein.

## Main Content

### 1. Source of Truth vor Tabelle

Vor Implementierung eines neuen Datenfelds oder Datenobjekts wird geklärt:

1. Welches fachliche Objekt besitzt die Information?
2. Welches System ist dafür die führende Source of Truth?
3. Muss die Information überhaupt lokal gespeichert werden?
4. Wer darf sie lesen, ändern und löschen?
5. Wie wird sie über Schnittstellen wiederverwendet, ohne eine zweite Pflegequelle zu erzeugen?

Eine neue Tabelle, ein neues Custom Post Type oder ein neues Optionsfeld ist keine Architekturentscheidung für sich. Zuerst wird die fachliche Verantwortung geklärt.

### 2. Dauerhafte Daten gehören in dauerhafte Speicherung

Dauerhaft relevante Fachdaten dürfen nicht ausschließlich gespeichert oder wiedergefunden werden über:

- PHP-/WordPress-Sessions,
- Session-IDs,
- Cookies,
- URL-/Query-Parameter,
- Local Storage,
- Session Storage,
- JavaScript-Runtime-State,
- versteckte Formularfelder ohne persistente Quelle,
- temporäre Uploadpfade,
- Caches oder Transients.

Nach einer erfolgreichen Aktion wie `Speichern`, `Anlegen`, `Aktualisieren`, `Veröffentlichen` oder einer vergleichbaren fachlichen Aktion müssen die bestätigten Daten dauerhaft persistiert sein.

Sie müssen insbesondere nach Reload, Browser-Neustart, Session-Ende und späterem erneuten Öffnen weiterhin verfügbar sein.

### 3. Zulässiger temporärer Zustand

Temporäre Mechanismen dürfen verwendet werden für tatsächlich flüchtige Zwecke, zum Beispiel:

- noch nicht abgeschickte UI-Zwischenzustände,
- einmalige Meldungen nach Redirect,
- technische Nonces,
- kurzfristige Filter-/Sortierauswahl,
- Cache-Daten, die jederzeit aus der führenden Quelle neu erzeugt werden können.

Temporärer Zustand darf niemals heimlich zum einzigen Speicher fachlich relevanter Informationen werden.

### 4. Wahl des WordPress-Datenmodells

Die einfachste passende WordPress-Lösung wird bevorzugt.

Vor einer eigenen Tabelle wird geprüft, ob der Bedarf robust abgebildet werden kann durch:

- bestehende WordPress-Core-Objekte,
- Custom Post Types,
- Taxonomien,
- Post-/User-/Term-Meta,
- Options/Settings,
- vorhandene TuS-Core-Objekte oder APIs.

Eigene Tabellen sind sinnvoll, wenn beispielsweise strukturierte relationale Daten, größere Mengen, häufige Filter/Sortierungen, fachliche Eindeutigkeit oder Performance dies rechtfertigen.

Die Entscheidung wird bei nichttrivialen Datenmodellen im Projekt dokumentiert.

### 5. Strukturierte Daten bleiben strukturiert

Informationen, die später einzeln gesucht, gefiltert, bearbeitet, referenziert oder ausgewertet werden sollen, werden nicht nur in unstrukturierten Sammelfeldern oder schwer abfragbaren serialisierten Blobs gespeichert.

Beispiele:

- Name, Link und Logo eines Partners sind getrennte fachliche Werte,
- Datum, Status und Ressource einer Belegung sind getrennte fachliche Werte,
- Person, Schicht, Zeitraum und Status einer Helferzuordnung sind getrennte fachliche Werte.

JSON/Serialisierung ist nur sinnvoll, wenn der gesamte Inhalt tatsächlich als eine unteilbare Einheit behandelt wird und keine fachliche Abfrage auf Einzelwerte erforderlich ist.

### 6. IDs und Beziehungen

Fachliche Beziehungen verwenden stabile technische Referenzen und nicht zufällige UI-Zustände oder Anzeigenamen.

Insbesondere:

- Anzeigenamen sind keine verlässlichen Primärschlüssel,
- URLs oder Session-IDs sind keine dauerhaften Objektidentitäten,
- Medien verwenden bevorzugt stabile WordPress-Attachment-IDs bzw. ausdrücklich definierte dauerhafte Referenzen,
- Beziehungen zwischen TuS-Objekten sollen nachvollziehbar und nicht nur implizit in Freitext gespeichert sein.

### 7. Tabellen- und Feldgestaltung

Bei eigenen Tabellen werden mindestens berücksichtigt:

- WordPress-Tabellenpräfix,
- klarer und stabiler Primärschlüssel,
- passende Datentypen statt pauschaler Textfelder,
- `NULL` nur dort, wo `unbekannt/nicht gesetzt` fachlich anders ist als ein leerer Wert,
- sinnvolle Defaultwerte,
- eindeutige Werte/Constraints, wenn fachlich erforderlich,
- Indizes für reale Such-, Join-, Sortier- und Filterpfade,
- nachvollziehbare Statuswerte statt verstreuter Magic Strings,
- Zeit-/Datumswerte nach einer bewusst definierten WordPress-/Projektzeitlogik,
- keine redundanten Kopien von Daten ohne klaren Synchronisations-/Cachezweck.

Indizes werden aus realen Zugriffsmustern abgeleitet, nicht vorsorglich auf jedes Feld gesetzt.

### 8. Datenzugriff

WordPress-Core-APIs werden bevorzugt, wenn sie den Zweck erfüllen.

Bei direktem `$wpdb`-Zugriff gilt:

- dynamische Werte werden über vorbereitete Abfragen bzw. passende `$wpdb`-Methoden verarbeitet,
- Tabellen-/Spaltennamen werden nicht aus ungeprüfter Nutzereingabe zusammengesetzt,
- Leseabfragen laden nur die tatsächlich benötigten Daten,
- große Ergebnislisten werden begrenzt/paginiert,
- N+1-Abfragen werden vermieden,
- Fehlerpfade werden behandelt und nicht still ignoriert.

### 9. Schnittstellen zwischen Plugins

Ein Plugin schreibt nicht direkt in die internen Tabellen eines anderen Plugins, nur weil dies technisch möglich ist.

Pluginübergreifende Nutzung erfolgt bevorzugt über:

- gemeinsam definierte Core-Objekte,
- klar benannte Services/Funktionen,
- WordPress-Hooks,
- REST-/API-Verträge,
- dokumentierte fachliche Ereignisse.

Damit bleiben Datenverantwortung und spätere Migrationen beherrschbar.

### 10. Caches und externe Synchronisation

Caches und lokale Kopien externer Daten dürfen Performance und Ausfallsicherheit verbessern, sind aber keine zweite fachliche Pflegequelle.

Für jede technische Kopie muss klar sein:

- woher sie erzeugt wird,
- wie aktuell sie sein muss,
- wie sie invalidiert/erneuert wird,
- wie das System bei fehlendem oder veraltetem Cache reagiert.

Ein gelöschter Cache muss grundsätzlich regenerierbar sein.

### 11. Migrationen und Schema-Versionen

Datenbankänderungen werden versioniert und reproduzierbar umgesetzt.

Migrationen sollen:

- bestehende Daten erhalten,
- wiederholbar bzw. gegen versehentliche Mehrfachausführung geschützt sein,
- auf einem bekannten Ausgangszustand getestet werden,
- nach Fehlern einen klaren sicheren Zustand hinterlassen,
- Datenverlust nicht als stillen Nebeneffekt akzeptieren,
- bei destruktiven Änderungen eine menschliche Freigabe besitzen.

Wo ein echtes Rollback nicht sinnvoll möglich ist, wird ein sicherer Vorwärtsmigrations-/Wiederherstellungsweg dokumentiert.

Schemaänderungen werden nicht durch Session-, Browser- oder Freitext-Workarounds umgangen, wenn fachlich strukturierte Persistenz notwendig ist.

### 12. Mehrstufige Schreibvorgänge

Wenn ein fachlicher Speichervorgang mehrere zusammengehörige Änderungen ausführt, wird geprüft, wie Teilfehler behandelt werden.

Ziel ist, inkonsistente Zwischenzustände zu vermeiden.

Je nach Fall kommen in Frage:

- Transaktionen, wenn technisch passend,
- kontrollierte Reihenfolge,
- idempotente Operationen,
- Kompensations-/Cleanup-Schritte,
- klare Statuskennzeichnung unvollständiger Vorgänge.

### 13. Löschung, Archivierung und Historie

Datenmodell und Löschlogik werden gemeinsam gedacht.

Vor produktiver Nutzung wird geklärt:

- echte Löschung vs. Archivierung,
- fachlich notwendige Historie,
- Datenschutz-/Aufbewahrungsanforderungen,
- abhängige Datensätze,
- Dateien/Medien,
- Caches/Kopien,
- Export-/Auskunftsfähigkeit bei personenbezogenen Daten.

`Gelöscht` darf nicht nur bedeuten, dass ein Datensatz aus der UI verschwindet, wenn er fachlich oder datenschutzrechtlich tatsächlich entfernt werden muss.

### 14. Persistenztests

Für neue oder geänderte dauerhafte Daten gilt mindestens:

1. Wert/Datenstruktur anlegen,
2. speichern,
3. Seite/Objekt verlassen oder neu laden,
4. erneut öffnen,
5. gespeicherte Werte vergleichen,
6. ändern und erneut prüfen,
7. löschen/archivieren, wenn die Funktion dies vorsieht,
8. Berechtigungsgrenzen prüfen.

Bei Listen/Relationen wird zusätzlich mit mehreren Einträgen, Sortierung, Änderungen und Löschungen getestet.

Migrationen werden mit repräsentativem Altbestand getestet; eine leere Neuinstallation reicht nicht als alleiniger Nachweis.

### 15. Projektdokumentation

Ein Projekt dokumentiert bei nichttrivialer Datenhaltung mindestens:

- führende fachliche Objekte,
- Source of Truth,
- Speicherform,
- relevante Beziehungen,
- wesentliche Indizes/Abfragepfade bei eigenen Tabellen,
- Migrations-/Versionslogik,
- offene Datenrisiken.

Dafür kann eine eigene `DATA-PERSISTENCE.md` existieren. Projektspezifische Dokumente konkretisieren diesen Standard.

## Relationship to other documents

- `software-development-quality-standard.md`
- `../architecture/stability-and-simplicity.md`
- `../architecture/platform-architecture.md`
- `../roles/wordpress-developer/development-standard.md`
- `../roles/data-protection-manager/privacy-standard.md`
- `../projects/event-planner/DATA-PERSISTENCE.md` als bereits bewährte projektspezifische Konkretisierung

## Future Development

Wenn mehrere TuS-Plugins dieselben Core-Objekte produktiv nutzen, wird dieser Standard um konkrete gemeinsame Datenverträge, API-/Event-Schemata und Migrationskonventionen erweitert.

Ein zentrales Datenmodell wird nur dort eingeführt, wo reale gemeinsame Objekte und Zugriffswege dies rechtfertigen; es entsteht keine abstrakte Datenbankarchitektur ohne Produktbedarf.