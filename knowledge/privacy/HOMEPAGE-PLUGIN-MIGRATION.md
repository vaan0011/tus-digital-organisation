# Homepage Plugin Migration – TuS Mingolsheim

## Purpose

Dieses Dokument hält die aktuell vom Vorstand bereitgestellte Plugin-Inventur der produktiven WordPress-Homepage fest und ordnet die Plugins für den geplanten Homepage-Neuaufbau vorläufig ein.

Die Inventur basiert auf Screenshots aus dem WordPress-Backend vom 11.09.2026. In den Screenshots sind 28 Plugins als **aktiv** erkennbar, weil jeweils die Aktion `Deaktivieren` angeboten wird. Ob daneben weitere inaktive Plugins installiert sind, ist damit noch nicht ausgeschlossen.

Die Einordnung ist kein Freibrief zum sofortigen Deaktivieren. Vor jeder Entfernung muss geprüft werden, ob bestehende Seiten, Shortcodes, Widgets, Rollen, Backups oder Prozesse noch davon abhängen.

## Core Principle

> **Alttechnik wird nicht blind gelöscht. Erst Abhängigkeit verstehen, dann Funktion ersetzen, dann sauber entfernen.**

Das Ziel ist eine deutlich kleinere, wartbare Plugin-Landschaft, in der TuS-eigene Fachplugins die führenden Vereinsprozesse übernehmen und generische Drittplugins nur bleiben, wenn sie einen klaren eigenständigen Nutzen haben.

## Main Content

### 1. Migrationsklassen

- `BEHALTEN` – fachlich benötigt und Teil des Zielbilds.
- `HÄRTEN` – bleibt zunächst, benötigt aber Update, Konfigurations- oder Sicherheitsprüfung.
- `ERSETZEN` – Funktion wird durch ein eigenes TuS-Produkt oder eine neue Zielarchitektur übernommen.
- `KONSOLIDIEREN` – mehrere Plugins lösen denselben bzw. stark überlappenden Zweck; auf eine Lösung reduzieren.
- `ENTFERNEN NACH CHECK` – voraussichtlich nicht mehr benötigt, aber Abhängigkeiten zuerst prüfen.
- `OFFEN` – fachlicher oder technischer Nutzen noch nicht ausreichend geklärt.

### 2. Aktuell sichtbare aktive Plugins

| Plugin | Version im Screenshot | Hauptzweck | Vorläufige Richtung | Begründung / Ersatz |
|---|---:|---|---|---|
| User Role Editor | 4.65 | Rollen/Rechte | `KONSOLIDIEREN` | Überlappt mit Advanced Access Manager. Vor Entfernung Custom Roles/Capabilities inventarisieren. Ziel möglichst WordPress-Capabilities + klarer eigener Rollenstandard. |
| Verein Turnierplaner | 3.6.0 | Turnier-, Event- und Helferplanung | `BEHALTEN / HÄRTEN` | Eigenes TuS-Plugin und strategisches Zielsystem. Gegen aktuellen GitHub-Stand/Release abgleichen. |
| WP-PageNavi | 2.94.5 | Pagination | `ENTFERNEN NACH CHECK` | Neuaufbau kann native/gezielte Pagination im Theme bzw. Frontend nutzen. Bestehende Templates prüfen. |
| Yoast Duplicate Post | 4.6 | Inhalte duplizieren / überarbeiten | `OFFEN` | Redaktioneller Komfort, kein Kernsystem. Nur behalten, wenn im realen Redaktionsprozess genutzt. |
| Simply Exclude | 2.0.6.6 | Inhalte/Taxonomien aus Ansichten ausschließen | `ERSETZEN / ENTFERNEN NACH CHECK` | Zielarchitektur soll Abfragen/Inhaltsmodelle bewusst steuern statt über Alt-Plugin-Ausnahmen. |
| Stackable – Gutenberg Blocks | 3.19.9 | zusätzliche Gutenberg-Blöcke | `ERSETZEN / ENTFERNEN NACH CHECK` | Neuer Homepage-Aufbau soll auf kontrolliertem TuS-Designsystem und eigenen Komponenten beruhen. Vorher Block-Nutzung im Legacy-Content prüfen. |
| Timeline Express | 1.8.1 | Timeline | `ERSETZEN` | Historien-/Archivdarstellung soll aus dem TuS-Archiv bzw. einer kontrollierten History-Komponente kommen. |
| Timeline Express – HTML Excerpts Add-on | 1.1.0 | Erweiterung Timeline Express | `ERSETZEN` | Fällt mit Timeline Express weg, sobald die Historienfunktion migriert ist. |
| Timetable and Event Schedule | 2.4.17 | Zeitpläne / Events | `ERSETZEN` | Event Planner und eigenes Platzbelegungs-Plugin übernehmen die fachlichen Quellen. |
| UpdraftPlus | 1.26.5 | Backup/Restore | `KONSOLIDIEREN` | Überschneidung mit BackUpWordPress und ggf. Hosting-Backups. Eine belastbare Backup-/Restore-Strategie auswählen und testen. |
| Jetpack | 15.9.2 | Security/Performance/Marketing/CDN u. a. | `OFFEN / TENDENZ ENTFERNEN` | Funktionsumfang ist sehr breit. Prüfen, welche Module tatsächlich genutzt werden. `i0.wp.com` kann aus Jetpack Site Accelerator stammen und muss technisch verifiziert werden. |
| Kalender | 1.3.18 | Kalenderdarstellung | `ERSETZEN` | Eigene Event-/Platzbelegungsarchitektur macht einen separaten generischen Kalender voraussichtlich überflüssig. |
| linkButton | 1.0 | Link-Button Widget | `ENTFERNEN NACH CHECK` | Einzelfunktion wird durch das Designsystem bzw. native Button-Komponente ersetzt. |
| Logo Showcase with Slick Slider | 3.3.6 | Partner-/Logo-Slider | `ERSETZEN` | Partnerportal/Partnerdaten + eigene PartnerCard/Logo-Komponente sollen die Darstellung übernehmen. |
| Meinturnierplan.de Widget Viewer | 1.1 | externe Turnierpläne/-tabellen | `ERSETZEN` | Eigener Verein Turnierplaner ist künftig führende Quelle für TuS-Turniere. Bestehende Fremdturnier-Use-Cases vorher prüfen. |
| PDF Embedder | 5.0.1 | PDF-Einbettung | `KONSOLIDIEREN` | Überschneidung mit Gutenberg PDF Viewer und DearFlip. Ziel: genau ein bewusstes PDF-/Magazinmuster oder einfacher nativer PDF-Link. |
| Button Widget by Loomisoft | 1.2.1 | Button-Widget | `ENTFERNEN NACH CHECK` | Im neuen Designsystem überflüssig; bestehende Widget-Flächen prüfen. |
| Change Admin Email Setting Without Outbound Email | 5.0 | Workaround Admin-Mailänderung | `ENTFERNEN NACH CHECK` | Sollte entfallen, sobald WordPress-Mailversand/SMTP und offizielle TuS-Absender sauber funktionieren. |
| Colibri Page Builder | 1.0.377 | Page Builder für Colibri | `ERSETZEN NACH MIGRATION` | Aktuelle Site hängt daran. Erst entfernen, wenn neue Homepage und betroffene Seiten vollständig migriert sind. |
| DSGVO All in one for WP | 5.0 | Cookie-/DSGVO-Helfer | `OFFEN / TENDENZ ENTFERNEN` | Ziel ist Privacy by Design ohne unnötige Consent-Schicht. Erst nach Cookie-/Request-Audit entscheiden, ob überhaupt eine Consent-Lösung erforderlich ist. |
| Forminator | 1.55.0 | Formulare | `ERSETZEN / NEU ORDNEN` | Formulare sollen an Rollenpostfächer bzw. kontrollierte Intake-/Poststellenprozesse angebunden werden. Bestehende Formulare und gespeicherte Einträge zuerst inventarisieren. |
| Gutenberg PDF Viewer Block | 1.1 | PDF-Viewer | `KONSOLIDIEREN` | Doppelt zu PDF Embedder/DearFlip. Nutzung in Legacy-Content prüfen. |
| Include Fussball.de Widgets | 4.0.0 | fussball.de Widgets | `ERSETZEN` | Homepage-Zielbild ist kontrollierte Spiel-Datenintegration mit eigenem TuS-Rendering statt generischem Widget-Embed. Übergang erst nach funktionierender MatchCard-Integration. |
| 3D FlipBook : DearFlip Lite | 2.4.30 | Flipbook/PDF-Magazin | `KONSOLIDIEREN / OFFEN` | Kann für Magazinwirkung nützlich sein, konkurriert aber mit zwei weiteren PDF-Plugins. Zielentscheidung für Jubiläumsmagazin/Publikationen treffen. |
| Advanced Access Manager | 7.1.2 | Rollen/Rechte/Zugriff | `KONSOLIDIEREN` | Überlappt mit User Role Editor. Vor Entfernung vorhandene Access Rules, Rollen und Content-Beschränkungen inventarisieren. |
| Advanced Editor Tools | 5.9.2 | Editor-Erweiterungen | `OFFEN` | Nur behalten, wenn reale redaktionelle Funktionen benötigt werden, die der neue Editor nicht abdeckt. |
| Akismet Anti-spam | 5.7 | Spam-Schutz | `OFFEN` | Abhängig von Kommentaren/Formularen. Datenfluss und tatsächlichen Nutzen prüfen; bei neuer Formulararchitektur ggf. ersetzen. |
| BackUpWordPress | 3.14 | Backup | `KONSOLIDIEREN / TENDENZ ENTFERNEN` | Doppelt zu UpdraftPlus und ggf. Hosting-Backup. Vor Entfernung Restore-Fähigkeit und vorhandene Backup-Ziele prüfen. |

### 3. Auffällige Doppelungen / Konsolidierungspakete

#### 3.1 Rollen und Rechte

Aktuell parallel:

- User Role Editor
- Advanced Access Manager

Vor einer Reduktion müssen alle eigenen Rollen, Capabilities, Content-Regeln und Sonderberechtigungen aufgenommen werden. Ziel ist **eine** verständliche Berechtigungslogik, nicht zwei parallele Verwaltungswelten.

#### 3.2 Backups

Aktuell parallel:

- UpdraftPlus
- BackUpWordPress
- möglicherweise zusätzlich Hosting-Backups, noch zu verifizieren

Ziel ist eine dokumentierte Backup-Strategie mit getesteter Wiederherstellung. Mehrere Backup-Plugins sind kein Ersatz für einen Restore-Test.

#### 3.3 PDF / Magazin

Aktuell parallel:

- PDF Embedder
- Gutenberg PDF Viewer Block
- DearFlip Lite

Vor Migration wird geprüft, wo diese Plugins tatsächlich verwendet werden. Danach wird ein bewusstes Muster gewählt. Für normale PDFs kann ein direkter Download/Browser-Viewer genügen; für das Jubiläumsmagazin kann bei echtem Mehrwert eine hochwertige Magazinansicht separat bewertet werden.

#### 3.4 Kalender / Veranstaltungen / Platzbelegung

Aktuell parallel bzw. angrenzend:

- Kalender
- Timetable and Event Schedule
- Google-Calendar-iframe in der Platzbelegung
- Verein Turnierplaner

Zielarchitektur:

- `Verein Turnierplaner / Event Planner` für Vereinsveranstaltungen, Turniere und Helferplanung,
- `TuS Platzbelegung` als eigenes Plugin für Ressourcen/Belegung,
- keine zweite generische Kalenderdatenwelt, wenn Daten bereits in einem führenden TuS-System liegen.

#### 3.5 Layout / Widgets / Komponenten

Aktuell u. a.:

- Colibri Page Builder
- Stackable
- Button Widget by Loomisoft
- linkButton
- WP-PageNavi
- Logo Showcase

Der neue Homepage-Aufbau soll diese fragmentierte UI-Schicht schrittweise durch das gemeinsame TuS Digital Design System und klar definierte Komponenten ersetzen.

### 4. TuS-eigene Zielsysteme als Ersatz

Die Reduktion der Plugin-Landschaft funktioniert nur, weil inzwischen eigene fachliche Zielsysteme existieren bzw. geplant sind:

- Verein Turnierplaner / Event Planner,
- TuS Platzbelegung,
- MatchCard / fussball.de-Integration,
- Partnerportal / PartnerCard,
- zentrale Homepage-Kontaktarchitektur und digitale Poststelle,
- Archiv-/Historienquelle für History-Inhalte,
- gemeinsames TuS Digital Design System.

Ein Drittplugin wird erst entfernt, wenn seine noch benötigte Funktion in einem Zielsystem vorhanden oder bewusst verworfen ist.

### 5. Update- und Sicherheitsregel für die Übergangszeit

Mehrere Screenshots zeigen verfügbare Plugin-Updates. Daraus folgt **keine pauschale Sofort-Aktualisierung aller Plugins in einem Schritt**.

Vorgehen:

1. belastbares Backup + Restore-Möglichkeit bestätigen,
2. Abhängigkeiten und Nutzung des Plugins prüfen,
3. Plugins, die bis zur Migration weiterlaufen müssen, kontrolliert aktualisieren,
4. nach jedem Risikoblock Smoke-Test der wichtigsten Seiten/Funktionen,
5. offensichtlich obsolete Plugins nach Dependency-Check entfernen statt nur dauerhaft veraltet liegen lassen,
6. keine ungenutzten inaktiven Plugins als Dauerbestand behalten.

Besonders alte bzw. lange nicht sichtbar modernisierte Einzelfunktionsplugins werden nicht automatisch als unsicher bezeichnet, erhalten aber erhöhte Wartungsprüfung.

### 6. Developer-Handoff

Mathias soll vor der eigentlichen Reduktion für jedes Plugin mindestens feststellen:

- auf welchen Seiten/Beiträgen/Widgets/Shortcodes es verwendet wird,
- ob Daten in eigenen Tabellen/Post Types gespeichert werden,
- ob externe Requests/Dienste bestehen,
- ob Benutzer/Rollen davon abhängen,
- ob Deaktivierung Daten oder Darstellung zerstört,
- welcher TuS-Ersatz bereits produktiv verfügbar ist,
- welche Tests nach Migration erforderlich sind.

Für die erste Migrationswelle eignen sich nur Plugins mit **klar bestätigter Nichtnutzung** oder vollständig vorhandenem Ersatz.

### 7. Definition of Done

Die Plugin-Migration ist erst abgeschlossen, wenn:

- alle produktiven Plugins inventarisiert sind,
- zusätzliche inaktive Plugins ebenfalls geprüft wurden,
- jede Funktion einem Zielsystem oder einer bewussten Entfernung zugeordnet ist,
- Doppelungen aufgelöst sind,
- Backup/Restore belastbar ist,
- Rollen/Rechte nach Konsolidierung funktionieren,
- bestehende Inhalte keine kaputten Shortcodes/Widgets hinterlassen,
- externe Datenflüsse nach der Migration erneut geprüft wurden,
- die finale Datenschutzerklärung nur noch tatsächlich verwendete Technik beschreibt.

## Relationship to other documents

- `HOMEPAGE-TECHNICAL-INVENTORY.md`
- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `../../design/homepage-standard.md`
- `../../projects/platzbelegung/README.md`
- `../../projects/event-planner/`
- `../../roles/wordpress-developer/START-PROMPT.md`

## Future Development

Nach der produktiven Dependency-Prüfung wird aus dieser vorläufigen Matrix eine konkrete Migrationsreihenfolge. Dauerhaft relevante Entscheidungen wandern anschließend in die jeweiligen Projektzustände bzw. Architekturentscheidungen; diese Datei bleibt als Übergabe- und Bereinigungsnachweis bestehen.