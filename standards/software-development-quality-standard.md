# Software Development Quality Standard

## Purpose

Dieser Standard definiert die verbindliche Qualitätsbasis für neue und geänderte Software der TuS Digital Organisation.

Er gilt insbesondere für WordPress-Plugins, öffentliche Homepage-Komponenten, interne Arbeitsoberflächen, Portale und technische Integrationen.

Der Standard ergänzt projektspezifische Anforderungen. Er ersetzt keine fachliche `PROJECT-STATE.md`, sondern legt die technischen und nichtfunktionalen Mindestanforderungen fest, die jedes Produkt erfüllen muss.

## Core Principle

> **Funktional richtig reicht nicht. TuS-Software muss verständlich, sicher, dauerhaft, zugänglich, performant und wartbar sein.**

Eine kurzfristig funktionierende Lösung darf keine dauerhafte technische Schuld erzeugen, wenn eine einfache robuste Lösung möglich ist.

## Main Content

### 1. Verbindliche Baseline

Für WordPress-Entwicklung gelten zusätzlich die jeweils aktuellen offiziellen WordPress Coding Standards für PHP, JavaScript, CSS und HTML sowie die WordPress Security- und Accessibility-Grundsätze.

Neue oder geänderte TuS-Oberflächen orientieren sich mindestens an WCAG 2.2 Level AA.

Projektspezifische Standards dürfen diese Anforderungen konkretisieren, aber nicht stillschweigend abschwächen.

### 2. Konsistente UI und UX

Für sichtbare Oberflächen gelten:

- `design/design-principles.md`,
- `design/ui-standard.md`,
- zentrale Brand-/Logo-/Farb-/Typografiequellen,
- projektspezifische UI-Spezifikationen, wenn vorhanden.

Backend und Frontend dürfen unterschiedliche Nutzungskontexte besitzen, verwenden aber dieselben grundlegenden TuS-Muster für Typografie, Buttons, Formulare, Status, Abstände, Fehlermeldungen und Interaktionen.

Ein Plugin führt kein eigenes Designsystem ein, wenn ein gemeinsames Muster existiert.

### 3. Responsive Nutzung

Neue Oberflächen werden nicht ausschließlich für Desktop gebaut.

Mindestens geprüft werden:

- Smartphone um 360 CSS-Pixel Breite,
- Tablet um 768 CSS-Pixel Breite,
- Desktop um 1280 CSS-Pixel Breite.

Diese Werte sind Test-Viewports, keine verpflichtenden CSS-Breakpoints.

Mobile bedeutet nicht, Desktop nur schmaler darzustellen. Inhalte dürfen sinnvoll umfließen, reduziert und priorisiert werden.

Touch-Bedienung, Zoom, Hoch-/Querformat und ausreichend große Interaktionsflächen werden berücksichtigt.

### 4. Accessibility

Für neue und wesentlich geänderte UI gilt WCAG 2.2 Level AA als Zielstandard.

Mindestens gelten:

- semantisches HTML vor ARIA-Sonderlösungen,
- vollständige Tastaturbedienbarkeit für interaktive Funktionen,
- sichtbare Fokuszustände,
- sinnvolle Fokusreihenfolge,
- Labels für Formulareingaben,
- verständliche und mit dem Feld verknüpfte Fehlermeldungen,
- Information nicht ausschließlich über Farbe,
- ausreichender Kontrast,
- Alternativtexte für inhaltlich relevante Bilder,
- dekorative Bilder für assistive Technologien korrekt ausblenden,
- Buttons und Links besitzen verständliche Namen,
- Dialoge, Menüs und dynamische Bereiche behalten einen nachvollziehbaren Fokus,
- Inhalte bleiben bei Textvergrößerung und auf kleinen Displays nutzbar,
- Bewegung und Animation werden sparsam eingesetzt und respektieren `prefers-reduced-motion`, wenn relevant.

Accessibility wird bei der Implementierung berücksichtigt und nicht erst nach Fertigstellung aufgesetzt.

### 5. Secure Coding

Eingaben, Berechtigungen und Ausgaben werden grundsätzlich als nicht vertrauenswürdig behandelt.

Für WordPress gilt insbesondere:

- Eingaben möglichst validieren; anschließend passend sanitizen,
- Ausgaben kontextgerecht und so spät wie möglich escapen,
- Schreibvorgänge benötigen geeigneten CSRF-/Nonce-Schutz,
- Nonces ersetzen keine Berechtigungsprüfung,
- jede geschützte Aktion prüft passende Capabilities,
- REST-Endpunkte besitzen eine bewusste `permission_callback`,
- SQL verwendet WordPress-APIs bzw. vorbereitete Abfragen; dynamische Werte werden nicht in SQL-Strings zusammengesetzt,
- keine direkte Änderung von WordPress-Core-Dateien,
- Datei-Uploads prüfen mindestens Berechtigung, Typ, Größe und Speicherziel,
- externe URLs/Requests werden kontrolliert behandelt; Timeouts und Fehlerpfade sind definiert,
- Secrets, Passwörter, API-Keys und produktive Zugangsdaten liegen nicht im Repository, Frontend-Code oder Logs,
- Fehlermeldungen an Nutzer geben keine internen Pfade, SQL-Details, Secrets oder Stacktraces preis,
- Debug-Informationen werden nicht dauerhaft öffentlich ausgeliefert.

### 6. Privacy by Design

Bei personenbezogenen Daten gilt zusätzlich `roles/data-protection-manager/privacy-standard.md`.

Neue Datenfelder, Formulare und Schnittstellen werden auf Zweck, Datenminimierung, Zugriff, Löschung und externe Empfänger geprüft.

GitHub, Testfixtures und Logs enthalten keine unnötigen personenbezogenen Produktivdaten.

### 7. Dauerhafte Datenhaltung

Für dauerhafte Fachdaten gilt `standards/data-persistence-and-database-standard.md`.

Insbesondere dürfen fachlich wichtige Informationen nicht von einer Session-ID, Browser-Session, URL-Query, Local Storage, Session Storage oder einem flüchtigen JavaScript-Zustand als Source of Truth abhängen.

Temporärer Zustand ist nur für tatsächlich temporäre UI-/Technikzwecke zulässig.

### 8. Performance

Performance ist Teil der Definition of Done und keine spätere Schönheitsoptimierung.

Allgemein gilt:

- keine unnötigen Datenbankabfragen in Schleifen,
- Listen und große Datenmengen werden begrenzt, paginiert oder bedarfsgerecht geladen,
- Datenbankabfragen verwenden passende Indizes für reale Lookup-/Sortierpfade,
- externe APIs werden nicht bei jedem Seitenaufruf synchron neu abgefragt, wenn die Information sinnvoll gecacht oder vorab synchronisiert werden kann,
- Caches sind ersetzbar und niemals fachliche Source of Truth,
- CSS/JavaScript/Medien werden nur dort geladen, wo sie benötigt werden,
- Bilder werden passend dimensioniert und moderne WordPress-/Browsermechanismen genutzt,
- langsame oder ausgefallene Drittanbieter dürfen eine Seite nicht unnötig blockieren,
- Hintergrund-/Batch-Verarbeitung wird bevorzugt, wenn eine synchrone Verarbeitung für den Nutzer keinen unmittelbaren Mehrwert besitzt.

Für öffentliche Homepage-Komponenten werden, sobald reale Messung möglich ist, die aktuellen Core-Web-Vitals-Zielwerte als Qualitätsziel verwendet: LCP höchstens 2,5 s, INP höchstens 200 ms und CLS höchstens 0,1 am 75. Perzentil.

Interne Plugins benötigen keine künstliche Lighthouse-Punktzahl, müssen aber flüssig bedienbar bleiben und dürfen nicht durch vermeidbare Requests oder Abfragen blockieren.

### 9. Fehlerbehandlung und Robustheit

Fehlerfälle werden als normaler Systemzustand behandelt.

Mindestens wird berücksichtigt:

- leere Datenbestände,
- ungültige Eingaben,
- fehlende Berechtigungen,
- doppelte Aktionen,
- Netzwerk-/API-Ausfall,
- fehlende oder unerwartete Daten,
- partielle Fehler bei mehrstufigen Schreibvorgängen.

Eine fehlgeschlagene externe Integration soll nach Möglichkeit einen verständlichen Fallback erzeugen und nicht die gesamte Oberfläche unbrauchbar machen.

Schreibvorgänge werden soweit sinnvoll idempotent oder gegen unbeabsichtigte Doppelanlage geschützt.

Logs enthalten nur die für Diagnose erforderlichen Informationen und keine Secrets oder unnötigen personenbezogenen Inhalte.

### 10. Abhängigkeiten

WordPress-/Browser-Standardfunktionen werden bevorzugt, wenn sie den Bedarf robust erfüllen.

Neue Bibliotheken oder externe Dienste benötigen einen klaren Nutzen.

Vor Aufnahme wird geprüft:

- Wartungsstatus,
- Lizenz,
- Sicherheits-/Update-Risiko,
- Größe und Performancewirkung,
- Lock-in,
- Möglichkeit einer einfacheren nativen Lösung.

Eine kleine Funktion rechtfertigt keine große dauerhafte Abhängigkeit.

### 11. Kompatibilität

Unterstützte WordPress-, PHP- und ggf. Browser-Versionen werden pro Plugin/Projekt explizit definiert und nicht stillschweigend angenommen.

WordPress-APIs werden gegenüber unnötigen Eigenimplementierungen bevorzugt, damit Core-Updates möglichst wenig Anpassungsbedarf verursachen.

Upgradepfade berücksichtigen bestehende Daten und Installationen.

### 12. Versionierung, Sprache, Datum und Zeit

Plugin- und Datenbankschemaversionen werden bewusst geführt.

Insbesondere:

- Plugin-Header, zentrale Versionskonstante und Release-Artefakt dürfen nicht unbemerkt unterschiedliche Versionen behaupten,
- eine Datenbankschemaversion wird getrennt geführt, wenn Migrationen nicht allein aus der Pluginversion sicher ableitbar sind,
- ein Versionssprung ersetzt keine Migrationslogik,
- Nutzertexte sind standardmäßig deutsch; WordPress-i18n-Funktionen werden bevorzugt, damit Strings zentral und technisch sauber behandelt werden,
- Datums-/Zeitlogik verwendet WordPress-/Projektzeitfunktionen statt verstreuter Serverzeit-Annahmen,
- Zeitzone und fachliche Bedeutung von Zeitstempeln müssen bei relevanten Funktionen eindeutig sein,
- Anzeigeformat und Speicherformat werden nicht verwechselt.

### 13. Tests und Qualitätsnachweis

Tests richten sich nach Risiko und Änderungstyp. Ein Agent darf einen Test nicht als `PASSED` dokumentieren, wenn er ihn nicht tatsächlich ausgeführt hat.

Je nach Änderung werden mindestens geprüft:

- Happy Path,
- leere Daten / Empty State,
- ungültige Eingabe,
- fehlende Berechtigung,
- Speichern und erneutes Laden dauerhafter Daten,
- relevante Regressionen bestehender Funktionen,
- Desktop/Tablet/Mobile bei sichtbaren Änderungen,
- Tastatur/Fokus und zentrale Accessibility-Pfade,
- externe API-Fehler/Fallbacks,
- Migrationen mit repräsentativem Altbestand.

Wo praktikabel werden automatisierte Tests, PHP-/Syntaxchecks, statische Analyse und WordPress Coding Standards eingesetzt.

WordPress Playground ist ein bevorzugtes reproduzierbares Testmedium für unsere Plugins, ersetzt aber nicht jede fachliche oder gerätespezifische Prüfung.

### 14. Definition of Done für Codeänderungen

Eine Änderung ist erst übergabefähig, wenn:

- Scope und Erfolgskriterium erfüllt sind,
- dauerhafte Daten korrekt persistieren,
- Berechtigungen und Sicherheitsgrenzen geprüft sind,
- relevante Datenschutzanforderungen berücksichtigt sind,
- UI auf den relevanten Gerätegrößen funktioniert,
- relevante Accessibility-Pfade funktionieren,
- keine bekannte vermeidbare Performance-Regression offen ist,
- Fehler-/Empty-/Fallback-Zustände berücksichtigt sind,
- notwendige Tests tatsächlich durchgeführt und dokumentiert wurden,
- Datenbankänderungen einen nachvollziehbaren Migrationsweg besitzen,
- Versionen bei betroffenen Release-/Schemaänderungen konsistent sind,
- Projektzustand/Dokumentation bei dauerhaften Änderungen aktualisiert ist,
- Branch und PR die Änderung nachvollziehbar beschreiben.

## Relationship to other documents

- `data-persistence-and-database-standard.md`
- `../roles/wordpress-developer/development-standard.md`
- `../roles/data-protection-manager/privacy-standard.md`
- `../architecture/stability-and-simplicity.md`
- `../decisions/architecture-checklist.md`
- `../design/design-principles.md`
- `../design/ui-standard.md`
- `../design/brand-identity.md`
- `../design/logo.md`

Externe Referenzstandards:

- WordPress Coding Standards – `developer.wordpress.org/coding-standards/wordpress-coding-standards/`
- WordPress Security APIs – `developer.wordpress.org/apis/security/`
- WordPress Accessibility Coding Standard – WCAG 2.2 Level AA
- W3C WCAG 2.2 – `w3.org/TR/WCAG22/`

## Future Development

Die Regeln sollen schrittweise durch automatisierte Qualitätschecks unterstützt werden, insbesondere WordPress Coding Standards/PHPCS, PHP-Syntaxchecks, Plugin Check und projektspezifische Tests.

Messwerte und Tooling werden erst dann zentral verschärft, wenn sie reproduzierbar in der bestehenden Entwicklungsumgebung laufen; Standards werden nicht durch CI-Scheinprüfungen ersetzt.