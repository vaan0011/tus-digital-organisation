# Homepage Technical Inventory – TuS Mingolsheim

## Purpose

Dieses Dokument hält die technisch bestätigte bzw. noch zu bestätigende Ist-Situation der aktuellen TuS-Mingolsheim-Homepage fest und definiert die produktive Backend-Inventur für den WordPress Developer.

Es ist kein vollständiger Security-Scan. Öffentliche Beobachtungen, Backend-Screenshots und noch offene Punkte werden bewusst voneinander getrennt.

Stand: 11.09.2026.

## Core Principle

> **Technische Entscheidungen basieren auf dem echten Produktivsystem – nicht auf Vermutung, Generator-Text oder Plugin-Namen allein.**

Ein Plugin wird nicht blind entfernt, nur weil seine Funktion im Zielbild ersetzt wird. Zuerst werden Nutzung und Abhängigkeiten bestätigt.

## Main Content

### 1. Bestätigter technischer Rahmen

Belastbar bekannt:

- die Website läuft auf WordPress,
- Colibri ist als aktuelle Website-/Page-Builder-Basis sichtbar und `Colibri Page Builder` ist aktiv,
- die Website wird über HTTPS ausgeliefert,
- Facebook und Instagram sind aktuell als normale externe Links vorhanden,
- die Platzbelegung verwendet einen direkten Google-Calendar-iframe,
- auf der Platzbelegungsseite wurden Ressourcen über `i0.wp.com` beobachtet,
- die Datenschutzerklärung beschreibt Google Analytics, dessen tatsächliche technische Aktivität aber noch nicht bestätigt ist,
- es bestehen Kontaktformularprozesse; `Forminator` ist als aktives Formularplugin bestätigt,
- der Vorstand hat Backend-Screenshots bereitgestellt, auf denen 28 aktive Plugins sichtbar sind,
- die vollständige vorläufige Plugin-Migrationsmatrix steht in `HOMEPAGE-PLUGIN-MIGRATION.md`.

Noch nicht bestätigt ist, ob zusätzlich inaktive Plugins installiert sind.

### 2. Bekannte externe bzw. datenschutzrelevante Abhängigkeiten

#### 2.1 Google Calendar / Platzbelegung

Aktuell direkte Einbettung von `calendar.google.com`.

Migrationsentscheidung: `ERSETZEN`.

Ziel:

- eigenes Projekt `TuS Platzbelegung`,
- eigenes TuS-Rendering,
- keine direkte Google-iframe-Kernlösung.

#### 2.2 `i0.wp.com` / Jetpack-nahe Bildauslieferung

Externer Ressourcenabruf wurde öffentlich beobachtet. `Jetpack` ist im Backend als aktives Plugin bestätigt.

Noch zu prüfen:

- ob Jetpack Site Accelerator/Image CDN tatsächlich Ursache ist,
- welche Jetpack-Module aktiv sind,
- auf welchen Seiten externe Medien ausgeliefert werden,
- ob ein fachlicher Nutzen besteht.

Migrationsentscheidung aktuell: `OFFEN / TENDENZ REDUZIEREN ODER ENTFERNEN`.

#### 2.3 Google Analytics

Die Datenschutzerklärung behauptet die Nutzung; technische Aktivität ist weiterhin nicht bestätigt.

Zu prüfen:

- Plugin, Theme-Code oder manuell eingebautes Skript,
- Google Tag Manager,
- Requests beim Seitenaufruf,
- Cookies/Storage,
- Consent-Mechanismus,
- Eigentümer/Berechtigungen des Kontos.

Migrationsentscheidung: `OFFEN`.

Ziel Homepage V1: kein Marketing-/Verhaltens-Tracking als Default.

#### 2.4 Social Media

Normale Links zu Facebook/Instagram sind bestätigt.

Migrationsentscheidung: `BEHALTEN`.

Direkte Social-Embeds bleiben nicht das Standardmodell.

#### 2.5 Formulare

`Forminator` ist aktiv. Damit ist das Formularplugin identifiziert, die konkreten Datenflüsse aber noch nicht.

Zu prüfen:

- alle aktiven Formulare,
- Pflichtfelder und Uploads,
- Zieladressen/Empfänger,
- Speicherung in WordPress/Plugin-Tabellen,
- Spam-Schutz,
- externe Integrationen,
- Aufbewahrung/Löschung,
- Altformulare,
- Übergang auf offizielle Rollenadressen bzw. digitale Poststelle.

Migrationsentscheidung: `ERSETZEN / NEU ORDNEN`, sobald die Zielprozesse belastbar sind.

### 3. Plugin-Inventur

#### 3.1 Bestätigter Snapshot

Die am 11.09.2026 bereitgestellten Backend-Screenshots zeigen 28 aktive Plugins. Die sichtbaren Versionen, Doppelungen und vorläufigen Migrationsentscheidungen stehen vollständig in:

`HOMEPAGE-PLUGIN-MIGRATION.md`

Wesentliche Cluster:

- Rollen/Rechte: User Role Editor + Advanced Access Manager,
- Backups: UpdraftPlus + BackUpWordPress,
- PDF/Flipbook: PDF Embedder + Gutenberg PDF Viewer Block + DearFlip,
- Kalender/Event/Belegung: Kalender + Timetable and Event Schedule + Google Calendar + eigene Event-/Platzbelegungsziele,
- Layout/Widgets: Colibri, Stackable, Button-/Link-Widgets, WP-PageNavi, Logo Showcase,
- Form/Privacy/externe Dienste: Forminator, DSGVO All in one for WP, Jetpack, Akismet,
- Spiel-/Turnierdaten: Include Fussball.de Widgets, Meinturnierplan.de Widget Viewer, eigener Verein Turnierplaner.

#### 3.2 Noch zu prüfen

- zusätzliche inaktive Plugins,
- Must-use Plugins,
- Plugin-Abhängigkeiten,
- aktive Shortcodes/Widgets/Blocks,
- Custom Post Types/Taxonomien/Tabellen,
- eigene Rollen/Capabilities,
- externe Requests je Plugin,
- Update-/Wartungsstatus,
- ob Daten nach Deaktivierung weiterhin benötigt werden.

### 4. Rollen und Berechtigungen

Im Plugin-Snapshot sind zwei aktive Berechtigungswerkzeuge bestätigt:

- User Role Editor,
- Advanced Access Manager.

Damit ist ein konkreter Konsolidierungsbereich vorhanden.

Vor Änderungen prüfen:

- WordPress-Benutzer und Administratoren,
- ehemalige Funktionsträger,
- Sammelaccounts,
- Custom Roles/Capabilities,
- AAM-spezifische Content-/Access-Regeln,
- unnötig hohe Rechte,
- Account-Prozess bei Rollenwechsel/Austritt,
- 2FA/MFA-Möglichkeiten.

Keine personenbezogene Benutzerliste nach GitHub kopieren.

### 5. Backup / Restore

Aktiv bestätigt:

- UpdraftPlus,
- BackUpWordPress.

Zusätzlich ist zu prüfen, ob IONOS/Hosting selbst Backups bereitstellt.

Vor Plugin-Bereinigung muss feststehen:

- welches System führend ist,
- Speicherziel,
- Aufbewahrung,
- Zugriff,
- Verschlüsselung soweit relevant,
- ob ein Restore tatsächlich getestet werden kann.

Mehrere Backup-Plugins ohne getestete Wiederherstellung gelten nicht als belastbare Strategie.

### 6. Cookies / Storage / externe Requests

Technisch im Browser auf repräsentativen Seiten prüfen:

- Cookies vor Interaktion,
- Cookies nach ggf. erteilter Einwilligung,
- Local Storage,
- Session Storage,
- weitere Endgerätezugriffe,
- externe Network-Domains,
- Quelle/Zweck/Laufzeit.

Mindestens prüfen:

- Startseite,
- Impressum/Datenschutz,
- Platzbelegung,
- Eltern-/Jugendseiten,
- Formularseiten,
- Artikel mit PDF/Flipbook/Medien,
- Partnerseite,
- Seiten mit fussball.de-Widgets,
- Turnierseiten.

### 7. WordPress Core / Theme / Hosting

Noch im Backend bzw. Hosting aufzunehmen:

- WordPress-Version,
- PHP-Version,
- Theme/Child Theme,
- Colibri-Anpassungen,
- Datenbankversion soweit relevant,
- nicht mehr genutzte Themes,
- Hostinganbieter/Vertragspartner,
- Server-/Access-/Error-Logs,
- Log-Aufbewahrung,
- Staging/Testsysteme,
- CDN/Proxy/WAF,
- Hosting-Backup.

Keine Secrets in GitHub dokumentieren.

### 8. E-Mail-Versand aus WordPress

Zu prüfen:

- PHP-Mail / SMTP / Plugin / externer Dienst,
- aktuelle Absenderadresse,
- Reply-To,
- Zustell-/Fehlerverhalten,
- Logging,
- Zugangsdatenablage,
- Forminator-Mailversand,
- Übergang auf offizielle TuS-Rollenadressen.

Das aktive Plugin `Change Admin Email Setting Without Outbound Email` ist ein Hinweis auf eine frühere/aktuelle Mail-Konfigurationsproblematik und soll nach sauberem Mailsetup voraussichtlich entfallen.

### 9. Medien / PDFs / CDN

Zu prüfen:

- Media Library und Altdateien,
- personenbezogene Dateinamen/Metadaten,
- Thumbnails,
- Jetpack/WordPress.com-CDN-Kopien,
- Löschwirkung,
- Jugendfotos,
- tatsächliche Nutzung der drei PDF-/Flipbook-Plugins.

Für das Jubiläumsmagazin wird bewusst entschieden, ob eine echte Flipbook-Ansicht Mehrwert bringt. Diese Entscheidung rechtfertigt nicht drei parallele PDF-Plugins.

### 10. Migrationsklassen

Für jede technische Komponente wird genau eine Arbeitsrichtung vergeben:

- `BEHALTEN`
- `HÄRTEN`
- `ERSETZEN`
- `KONSOLIDIEREN`
- `ENTFERNEN`
- `OFFEN`

Die Entscheidung berücksichtigt Datenschutz, Sicherheit, Funktion, Wartbarkeit, UX, Kosten und bestehende Abhängigkeiten.

### 11. Developer-Handoff – konkrete Reihenfolge

Mathias arbeitet bei der bestehenden Homepage in dieser Reihenfolge:

1. Plugin-Snapshot gegen die echte Pluginseite vervollständigen, insbesondere inaktive/MU-Plugins.
2. Für jedes Altplugin Nutzung in Seiten, Blocks, Widgets, Shortcodes, Rollen und Datenstrukturen ermitteln.
3. WordPress/Core/Theme/PHP/Hosting aufnehmen.
4. Benutzer-/Rollenmodell prüfen.
5. Forminator-Formulare, Empfänger und Speicherung inventarisieren.
6. WordPress-Mailversand prüfen.
7. Cookies/Storage und externe Requests im Browser messen.
8. Jetpack-Module, Analytics/Tag Manager und Consent technisch verifizieren.
9. Backup-/Restore-Strategie festlegen und vor Bereinigung absichern.
10. Erst dann erste kontrollierte Plugin-Migrations-/Entfernungswelle planen.
11. Nach jeder Welle Smoke-Test und erneuter Request-/Privacy-Check.
12. Bestätigte Fakten und Migrationsentscheidungen in die fachlich richtige Source of Truth zurückschreiben.

### 12. Was nicht in GitHub gehört

Nicht dokumentieren:

- Passwörter,
- API-Keys,
- SMTP-Zugangsdaten,
- Dienstzugänge,
- vollständige personenbezogene Benutzerlisten,
- konkrete Formularinhalte,
- sensible Logauszüge,
- Backup-Dateien,
- Datenbankexports.

### 13. Definition of Done

Die technische Homepage-Inventur ist abgeschlossen, wenn:

- aktive und inaktive Plugins vollständig aufgenommen sind,
- Plugin-Abhängigkeiten bekannt sind,
- WordPress/Core/Theme/PHP/Hosting bekannt sind,
- Rollen/Berechtigungen geprüft sind,
- Formulare und E-Mail-Datenflüsse bekannt sind,
- Cookies/Storage und externe Requests gemessen sind,
- Analytics/Jetpack/Consent-Status bestätigt ist,
- Backup/Restore geklärt ist,
- jede relevante Komponente eine Migrationsentscheidung hat,
- keine Secrets oder unnötigen personenbezogenen Daten in GitHub liegen,
- Mathias und David denselben bestätigten Ausgangspunkt verwenden.

## Relationship to other documents

- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `HOMEPAGE-PLUGIN-MIGRATION.md`
- `CURRENT-STATE.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../projects/platzbelegung/README.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../roles/data-protection-manager/privacy-standard.md`

## Future Development

Der Plugin-Snapshot ist jetzt vorhanden. Der nächste technische Fortschritt ist der Dependency-Check im echten WordPress-System, nicht eine weitere abstrakte Liste.

Danach folgen kontrollierte Plugin-Konsolidierung, Homepage-P0-Bereinigung und schließlich die Migration auf die neue Homepage-Architektur. Die finale Datenschutzerklärung wird erst aus dem tatsächlich verbleibenden Produktivsystem abgeleitet.