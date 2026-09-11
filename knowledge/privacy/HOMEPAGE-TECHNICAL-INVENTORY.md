# Homepage Technical Inventory – TuS Mingolsheim

## Purpose

Dieses Dokument hält die technisch bestätigte bzw. noch zu bestätigende Ist-Situation der aktuellen TuS-Mingolsheim-Homepage fest und definiert, welche Informationen für die spätere produktive Migration benötigt werden.

Es ist kein vollständiger Security-Scan. Öffentliche Beobachtungen, Backend-Screenshots und noch offene Punkte werden bewusst voneinander getrennt.

Wichtig: **Die produktive Backend-Inventur ist derzeit kein Arbeitsauftrag an den WordPress Developer.** Mathias hat keinen produktiven WordPress-Backendzugriff und arbeitet zunächst an den TuS-eigenen Plugins und Homepage-Komponenten. Fehlende Informationen aus der Altinstallation werden bei Bedarf gezielt durch eine autorisierte Backend-Person bereitgestellt.

Stand: 11.09.2026.

## Core Principle

> **Technische Entscheidungen basieren auf dem echten Produktivsystem – aber Plugin-Entwicklung und produktive WordPress-Administration sind getrennte Arbeitsphasen.**

Ein Plugin wird nicht blind entfernt, nur weil seine Funktion im Zielbild ersetzt wird. Zuerst wird die Ersatzfunktion gebaut; die produktive Abhängigkeit wird später vor der tatsächlichen Migration bestätigt.

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

Diese Punkte sind **spätere Migrationsinformationen** und kein Blocker für die aktuelle Entwicklung der TuS-Zielplugins.

### 4. Rollen und Berechtigungen

Im Plugin-Snapshot sind zwei aktive Berechtigungswerkzeuge bestätigt:

- User Role Editor,
- Advanced Access Manager.

Damit ist ein konkreter Konsolidierungsbereich vorhanden.

Vor späteren Änderungen prüfen:

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

Zusätzlich ist später zu prüfen, ob IONOS/Hosting selbst Backups bereitstellt.

Vor produktiver Plugin-Bereinigung muss feststehen:

- welches System führend ist,
- Speicherziel,
- Aufbewahrung,
- Zugriff,
- Verschlüsselung soweit relevant,
- ob ein Restore tatsächlich getestet werden kann.

Mehrere Backup-Plugins ohne getestete Wiederherstellung gelten nicht als belastbare Strategie.

### 6. Cookies / Storage / externe Requests

Vor bzw. bei der späteren produktiven Migration technisch im Browser auf repräsentativen Seiten prüfen:

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

Später im Backend bzw. Hosting aufzunehmen:

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

Später zu prüfen:

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

Später zu prüfen:

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

### 11. Developer-Handoff – aktuelles Arbeitsmodell

Mathias arbeitet **aktuell nicht im produktiven WordPress-Backend**. Sein Auftrag ist zunächst die Entwicklung der Zielsysteme aus GitHub und den jeweiligen Projektzuständen heraus.

Für die aktuelle Entwicklungsphase gilt:

1. relevante Altplugin-Funktion aus der Migrationsmatrix als Anforderung verstehen,
2. eigenes TuS-Zielplugin bzw. Homepage-Komponente entwickeln,
3. Tests und klare Abnahmekriterien bereitstellen,
4. Migrationshinweise dokumentieren,
5. fehlende Informationen aus der Altinstallation gezielt beim Nutzer bzw. einer autorisierten Backend-Person anfordern,
6. keine produktiven Deaktivierungen, Löschungen, Rollen-/Benutzeränderungen, Backup-/Restore-Operationen oder Hostingänderungen ohne ausdrücklich bereitgestellten Zugang und Auftrag durchführen.

Erst wenn ein Ersatz abnahmefähig ist, beginnt die spätere produktive Migrationsphase gemeinsam mit einer autorisierten Backend-Person. Die Reihenfolge und Stop-Kriterien stehen in `HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`.

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

Die **aktuelle Entwicklungsphase** ist nicht davon abhängig, dass die gesamte Altinstallation technisch inventarisiert wurde.

Für eine konkrete spätere Migration ist die notwendige technische Teilinventur abgeschlossen, wenn für die betroffene Funktion:

- relevante Plugin-Abhängigkeiten bekannt sind,
- notwendige Daten-/Shortcode-/Widget-Migration geklärt ist,
- Ersatzfunktion abnahmefähig ist,
- Backup/Restore durch die autorisierte Backend-Person geklärt ist,
- Smoke-Tests definiert sind,
- relevante Privacy-/Datenflussfragen geprüft sind,
- keine Secrets oder unnötigen personenbezogenen Daten in GitHub liegen.

## Relationship to other documents

- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `HOMEPAGE-PLUGIN-MIGRATION.md`
- `HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`
- `CURRENT-STATE.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../projects/platzbelegung/README.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../roles/data-protection-manager/privacy-standard.md`

## Future Development

Der Plugin-Snapshot ist vorhanden und dient jetzt als Migrationskontext. Der nächste technische Fortschritt entsteht durch die **Entwicklung der TuS-eigenen Zielplugins**, nicht durch einen allgemeinen Backend-Cleanup.

Produktive Inventur und Plugin-Konsolidierung erfolgen später bedarfsgerecht pro fertiger Ersatzfunktion. Die finale Datenschutzerklärung wird erst aus dem tatsächlich verbleibenden Produktivsystem abgeleitet.