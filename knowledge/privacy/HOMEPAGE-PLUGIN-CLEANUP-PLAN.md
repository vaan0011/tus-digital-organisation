# Homepage Plugin Cleanup Plan – TuS Mingolsheim

## Purpose

Dieses Dokument beschreibt die **spätere** kontrollierte Ablösung der heutigen WordPress-Altplugins, nachdem die benötigten TuS-Zielfunktionen entwickelt und abnahmefähig sind.

Es ist **kein aktueller Arbeitsauftrag an den WordPress Developer für das Produktivsystem**. Mathias hat derzeit keinen WordPress-Backendzugriff und arbeitet primär an der Entwicklung der TuS-eigenen Plugins und Homepage-Komponenten aus GitHub heraus.

Die bestehende Plugin-Inventur dient deshalb aktuell vor allem als **Anforderungskarte**: Sie zeigt, welche heutigen Funktionen später durch eigene TuS-Produkte ersetzt, konsolidiert oder bewusst beibehalten werden müssen.

## Core Principle

> **Erst Zielsystem bauen. Dann kontrolliert migrieren. Erst danach Alttechnik abschalten.**

Produktive Backend-Eingriffe erfolgen erst in einer späteren Migrationsphase durch bzw. gemeinsam mit einer autorisierten Person mit WordPress-/Hostingzugriff.

## Main Content

### 1. Aktuelle Phase – Entwicklung vor Bereinigung

Der aktuelle Schwerpunkt von Mathias ist die Entwicklung und Stabilisierung der TuS-Zielsysteme, insbesondere:

- `Verein Turnierplaner / Event Planner`,
- `TuS Platzbelegung`,
- Homepage-Komponenten und Datenadapter,
- MatchCard / kontrollierte Spielplandatenintegration,
- Partner-/Sponsor-Komponenten,
- Kontakt-/Formularschnittstellen zur späteren Rollenpostfach-/Poststellenarchitektur,
- weitere projektspezifische WordPress-Plugins aus dem Portfolio.

Die Altplugin-Liste hilft dabei zu erkennen, welche Funktionen heute existieren und welche Kompatibilitäts-/Migrationsfälle später berücksichtigt werden müssen.

Mathias führt **nicht** ohne ausdrücklich bereitgestellten Zugang und Auftrag aus:

- Plugin-Deaktivierungen auf Produktion,
- Plugin-Löschungen,
- produktive Benutzer-/Rollenänderungen,
- Backup-/Restore-Operationen,
- Hosting-/Serveränderungen,
- produktive Formular-/Mailänderungen,
- Cookie-/Consent-Konfigurationsänderungen.

### 2. Verantwortungsmodell der späteren Migration

Für die spätere Umstellung werden drei Verantwortungen getrennt:

#### WordPress Developer

Mathias liefert:

- fertige Ersatzfunktion,
- technische Installations-/Migrationshinweise,
- bekannte Daten-/Shortcode-/Widget-Abhängigkeiten,
- Smoke-Test-Kriterien,
- Rückfallhinweise soweit technisch sinnvoll,
- notwendige Änderungen am eigenen Plugin/Frontend.

#### Autorisierte Backend-Person

Eine Person mit produktivem WordPress-/Hostingzugriff führt aus bzw. bestätigt:

- Backups und Restore-Fähigkeit,
- Plugin-/Theme-/Benutzerinventur,
- produktive Deaktivierung/Löschung,
- Formular-/Mail-/Hostingkonfiguration,
- ggf. Staging-/Produktionsmigration.

#### Data Protection & Information Protection Manager

David prüft bei relevanten Änderungen insbesondere:

- Datenflüsse,
- externe Dienste,
- Cookies/Storage,
- Formulare und Empfänger,
- Aufbewahrung/Löschung,
- Auswirkungen auf Datenschutzerklärung und Kontaktarchitektur.

### 3. Spätere Migrationsreihenfolge

Die folgende Reihenfolge wird **erst aktiviert, wenn die jeweilige Ersatzfunktion vorhanden und ein Backend-Migrationsfenster freigegeben ist**.

#### Phase A – Sicherheitsnetz

Vor produktiver Abschaltung:

1. Backup-/Restore-Weg durch autorisierte Backend-Person bestätigen,
2. betroffene Seiten/Funktionen identifizieren,
3. Smoke-Tests festlegen,
4. Ersatzfunktion installiert bzw. abnahmefähig bereitstellen,
5. Rollback-Möglichkeit festlegen.

Ohne bestätigte Wiederherstellbarkeit keine produktive Bereinigung.

#### Phase B – kleine UI-/Hilfsplugins

Spätere Prüfkandidaten:

- `WP-PageNavi`,
- `linkButton`,
- `Button Widget by Loomisoft`,
- `Yoast Duplicate Post`,
- `Advanced Editor Tools`.

Sie werden nur entfernt, wenn ihre tatsächliche Nutzung ausgeschlossen oder vollständig ersetzt ist.

#### Phase C – Doppelungen

Zu konsolidieren:

- `UpdraftPlus` + `BackUpWordPress` + ggf. Hosting-Backup,
- `User Role Editor` + `Advanced Access Manager`,
- `PDF Embedder` + `Gutenberg PDF Viewer Block` + `DearFlip Lite`.

Diese Bereiche werden nicht während der reinen Plugin-Entwicklung angefasst.

#### Phase D – fachliche Altplugins durch TuS-Zielsysteme ersetzen

Geplante Zuordnung:

- `Kalender` → Event Planner / neue Eventarchitektur,
- `Timetable and Event Schedule` → Event Planner + TuS Platzbelegung,
- Google-Calendar-iframe → `TuS Platzbelegung`,
- `Meinturnierplan.de Widget Viewer` → Verein Turnierplaner, soweit der reale Use Case abgedeckt ist,
- `Include Fussball.de Widgets` → MatchCard-/Spieldatenintegration,
- `Logo Showcase with Slick Slider` → Partner-/Sponsor-Komponente,
- `Timeline Express` + HTML Excerpts Add-on → Archiv-/Historienkomponente.

Grundablauf später:

`Ersatz fertig → Test → produktive Migration → Vergleichstest → Altplugin deaktivieren → Smoke-Test → erst danach entfernen`

#### Phase E – Page Builder / Layout

`Colibri Page Builder` und `Stackable` bleiben bis zur vollständigen Migration der davon abhängigen Seiten bestehen.

Sie sind keine aktuellen Cleanup-Aufträge an Mathias, sondern Randbedingung des Homepage-Neuaufbaus.

#### Phase F – Formulare, Privacy und externe Dienste

Gemeinsam später zu bewerten:

- `Forminator`,
- `DSGVO All in one for WP`,
- `Akismet`,
- `Jetpack`.

Hier entscheidet der reale finale Datenfluss. Ziel ist nicht, bestehende Plugins nur wegen ihrer Existenz nachzubauen, sondern die benötigte Funktion möglichst einfach und datensparsam zu lösen.

### 4. Was Mathias heute aus der Plugin-Liste ableiten soll

Bei der Entwicklung eines neuen TuS-Plugins prüft Mathias nur die für sein Projekt relevanten Alt-Funktionen:

- Welche Funktion ersetzt das neue Plugin?
- Welche Daten oder Darstellungen müssen später migriert werden?
- Gibt es Shortcodes, URLs oder Frontend-Verhalten, das beim Übergang berücksichtigt werden sollte?
- Welche externe Abhängigkeit können wir im Zielsystem vermeiden?
- Welche klare Abnahmebedingung zeigt, dass der Ersatz wirklich vollständig ist?

Dafür ist kein produktiver Backendzugriff nötig. Wo reale Alt-Konfigurationen fehlen, wird die Information gezielt beim Nutzer bzw. einer Backend-Person angefordert.

### 5. Stop-Kriterien

Keine produktive Plugin-Abschaltung, wenn mindestens einer dieser Punkte offen ist:

- kein autorisierter Backendzugriff,
- kein bestätigtes Backup/Restore,
- Ersatzfunktion nicht abnahmefähig,
- Nutzung/Abhängigkeit unklar,
- notwendige Datenmigration ungeklärt,
- keine Smoke-Test-Kriterien,
- Privacy-/Datenflussänderung ungeprüft.

### 6. Definition of Done der späteren Plugin-Migration

Die Migration ist abgeschlossen, wenn:

- jede benötigte Alt-Funktion ersetzt oder bewusst verworfen wurde,
- produktive Abhängigkeiten geprüft wurden,
- Doppelungen aufgelöst sind,
- keine kaputten Shortcodes/Widgets/Seiten verbleiben,
- Backup-/Restore-Strategie belastbar ist,
- Rollen/Rechte funktionieren,
- externe Datenflüsse erneut geprüft wurden,
- die finale Datenschutzerklärung nur tatsächlich verwendete Technik beschreibt.

## Relationship to other documents

- `HOMEPAGE-PLUGIN-MIGRATION.md`
- `HOMEPAGE-TECHNICAL-INVENTORY.md`
- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../projects/event-planner/`
- `../../projects/platzbelegung/`
- `../../design/homepage-standard.md`

## Future Development

Der Cleanup-Plan bleibt zunächst **geparkt**, während Mathias die benötigten TuS-Zielplugins entwickelt.

Sobald ein konkretes Zielsystem produktionsreif ist, wird nur der dazugehörige Migrationsblock aktiviert und gemeinsam mit einer autorisierten Backend-Person abgearbeitet. Dadurch vermeiden wir eine große riskante Altplugin-Bereinigung und migrieren stattdessen funktional Schritt für Schritt.