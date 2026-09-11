# Homepage Technical Inventory – TuS Mingolsheim

## Purpose

Dieses Dokument hält die technisch bestätigte bzw. noch zu bestätigende Ist-Situation der aktuellen TuS-Mingolsheim-Homepage fest und definiert, welche Informationen für die spätere Migration benötigt werden.

Es ist kein vollständiger Security-Scan und **kein aktueller Backend-Arbeitsauftrag an den WordPress Developer**. Mathias hat derzeit keinen produktiven WordPress-Backendzugriff und arbeitet zunächst an den TuS-eigenen Zielplugins und Homepage-Komponenten.

Stand: 11.09.2026.

## Core Principle

> **Technische Entscheidungen basieren auf dem echten Produktivsystem – aber produktive Administration und Plugin-Entwicklung sind zwei getrennte Arbeitsphasen.**

Die heute bekannte Altinstallation liefert Anforderungen und Migrationskontext. Produktive Änderungen erfolgen erst später mit einer autorisierten Backend-Person.

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

Noch nicht bestätigt ist, ob zusätzlich inaktive bzw. Must-use Plugins installiert sind.

### 2. Bekannte externe bzw. datenschutzrelevante Abhängigkeiten

#### Google Calendar / Platzbelegung

Aktuell direkte Einbettung von `calendar.google.com`.

Migrationsentscheidung: `ERSETZEN` durch das eigene Projekt `TuS Platzbelegung`.

#### `i0.wp.com` / Jetpack-nahe Bildauslieferung

Externer Ressourcenabruf wurde beobachtet. `Jetpack` ist als aktives Plugin bestätigt.

Noch offen:

- ob Jetpack Site Accelerator/Image CDN tatsächlich Ursache ist,
- welche Jetpack-Module aktiv sind,
- ob ein fachlicher Nutzen besteht.

#### Google Analytics

Die Datenschutzerklärung behauptet die Nutzung; technische Aktivität ist weiterhin nicht bestätigt.

Ziel Homepage V1: kein Marketing-/Verhaltens-Tracking als Default.

#### Social Media

Normale Links zu Facebook/Instagram sind bestätigt und bleiben das bevorzugte einfache Muster.

#### Formulare

`Forminator` ist aktiv. Die konkreten Datenflüsse, Empfänger, Speicherung und Integrationen sind noch nicht vollständig bekannt.

Die Zielrichtung bleibt: Formulare in die offizielle Rollenpostfach-/Poststellenarchitektur überführen und nur notwendige Daten erfassen.

### 3. Plugin-Inventur

Die bereitgestellten Backend-Screenshots zeigen 28 aktive Plugins. Die sichtbaren Versionen, Doppelungen und vorläufigen Migrationsentscheidungen stehen in `HOMEPAGE-PLUGIN-MIGRATION.md`.

Wesentliche Cluster:

- Rollen/Rechte: User Role Editor + Advanced Access Manager,
- Backups: UpdraftPlus + BackUpWordPress,
- PDF/Flipbook: PDF Embedder + Gutenberg PDF Viewer Block + DearFlip,
- Kalender/Event/Belegung: Kalender + Timetable and Event Schedule + Google Calendar + eigene Event-/Platzbelegungsziele,
- Layout/Widgets: Colibri, Stackable, Button-/Link-Widgets, WP-PageNavi, Logo Showcase,
- Form/Privacy/externe Dienste: Forminator, DSGVO All in one for WP, Jetpack, Akismet,
- Spiel-/Turnierdaten: Include Fussball.de Widgets, Meinturnierplan.de Widget Viewer, eigener Verein Turnierplaner.

### 4. Informationen, die später noch aus dem Produktivsystem benötigt werden

Diese Punkte werden erst erhoben, wenn sie für eine konkrete Migration notwendig sind oder eine autorisierte Backend-Person die Inventur durchführen kann:

- zusätzliche inaktive/MU-Plugins,
- WordPress-/PHP-/Theme-/Hosting-Stand,
- Plugin-Abhängigkeiten,
- aktive Shortcodes/Widgets/Blocks,
- Custom Post Types/Taxonomien/Tabellen,
- eigene Rollen/Capabilities,
- Benutzer-/Berechtigungsmodell,
- Forminator-Formulare, Empfänger und Speicherung,
- WordPress-Mailversand,
- Cookies/Local Storage/Session Storage,
- externe Network-Requests,
- Analytics/Tag Manager/Consent,
- Jetpack-Module,
- Backup-/Restore-Strategie,
- Hosting-Logs, Staging und CDN/Proxy/WAF soweit vorhanden.

Keine Secrets oder personenbezogenen Detaildaten gehören in GitHub.

### 5. Arbeitsmodell ohne Backendzugriff

Mathias entwickelt die Zielsysteme aus GitHub und den Projektzuständen heraus.

Wenn für eine konkrete Pluginentwicklung Wissen über die Altinstallation nötig ist, fordert er **gezielt** an, was er braucht, zum Beispiel:

- Screenshot einer Plugin-Konfiguration,
- Liste verwendeter Shortcodes,
- Beispielseite,
- anonymisierte Struktur eines Formulars,
- bestätigte aktuelle URL/Frontend-Ausgabe,
- Export einer nicht sensiblen Konfiguration, sofern sicher möglich.

Er führt nicht selbst auf Produktion aus, solange kein expliziter Backendzugriff bereitgestellt wurde:

- Plugin-Deaktivierung oder -Löschung,
- Benutzer-/Rollenänderung,
- Backup/Restore,
- Hosting-/Serveränderung,
- produktive Formular-/Mailänderung,
- Cookie-/Consent-Konfiguration.

### 6. Spätere Migrationsphase

Erst wenn ein TuS-Zielsystem abnahmefähig ist, wird der jeweilige Altbestand migriert.

Verantwortung:

- **Mathias:** Ersatzfunktion, technische Migrationshinweise, Tests, ggf. Anpassungen am eigenen Plugin.
- **Autorisierte Backend-Person:** produktive Installation, Backup/Restore, Deaktivierung/Löschung, Hosting-/Benutzer-/Mailänderungen.
- **David:** Privacy-/Datenflussprüfung bei relevanten Änderungen.

Der Ablauf steht in `HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`.

### 7. Priorität für die aktuelle Entwicklungsphase

Aktuell zählt nicht die Reduktion der Pluginzahl, sondern das Fertigstellen der strategischen TuS-Zielsysteme.

Besonders relevant sind:

1. Event Planner weiterentwickeln,
2. TuS Platzbelegung entwickeln,
3. Homepage-Komponenten und Kontaktarchitektur umsetzen,
4. MatchCard-/Spieldatenintegration entwickeln,
5. Partner-/Sponsor-Komponenten anbinden,
6. erst danach konkrete Altplugins funktionsweise ablösen.

### 8. Was nicht in GitHub gehört

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

Die technische Inventur wird schrittweise ergänzt, wenn reale Informationen für eine konkrete Migration gebraucht werden. Sie ist **kein Blocker für die aktuelle Pluginentwicklung**.

Der nächste Fortschritt liegt deshalb in den TuS-eigenen WordPress-Projekten. Produktive Backend-Bereinigung folgt später funktionsweise, sobald ein Ersatz fertig und eine autorisierte Backend-Person verfügbar ist.