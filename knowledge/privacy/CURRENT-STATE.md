# Datenschutz & Informationsschutz – Current State

## Purpose

Dieses Dokument hält den aktuellen organisationsweiten Arbeitsstand zu Datenschutz und Informationsschutz der TuS Digital Organisation fest.

Es enthält keine sensiblen Falldaten und ersetzt weder Rechtsberatung noch eine formelle Datenschutzbeauftragten-Benennung.

## Core Principle

> **Personenbezogene Daten gehören nur dorthin, wo sie für einen klaren Zweck gebraucht und angemessen geschützt werden.**

## Main Content

### 1. Aktueller Reifegrad

Mit der Rolle `Data Protection & Information Protection Manager` ist Datenschutz als Querschnittsverantwortung im TuS-OS verankert.

Für die Homepage liegen inzwischen vor:

- `HOMEPAGE-PRIVACY-CHECK.md`,
- `HOMEPAGE-CONTACT-INVENTORY.md`,
- `HOMEPAGE-TECHNICAL-INVENTORY.md`,
- `HOMEPAGE-PLUGIN-MIGRATION.md`,
- `HOMEPAGE-PLUGIN-CLEANUP-PLAN.md` als **späterer** Migrations-/Abschaltplan.

Der wichtige aktuelle Architekturpunkt lautet: **Mathias hat keinen produktiven WordPress-Backendzugriff und entwickelt zunächst die TuS-eigenen Plugins und Homepage-Komponenten.** Die bestehende Altinstallation wird nicht jetzt bereinigt, sondern später funktionsweise migriert, sobald ein Ersatz fertig ist und eine autorisierte Backend-Person die produktive Umstellung begleitet.

### 2. Bekannte relevante Systeme / Bereiche

Besonders relevant:

- WordPress-Homepage und Plugins,
- Event Planner,
- geplante TuS Platzbelegung,
- Partner-CRM / Partnerportal,
- Mitglieder- und Teamdaten,
- Google Drive,
- GitHub,
- IONOS-E-Mail,
- geplante n8n-Poststelle,
- Archiv/Medien/Fotos,
- Kinder- und Jugendschutz.

### 3. Verbindliche Architekturentscheidungen

- GitHub ist Organisationswissen, keine operative personenbezogene Datenbank.
- sensible/personenbezogene Inhalte gehören in geeignete geschützte Systeme.
- Homepage-Kontaktwege sollen auf offizielle Rollenadressen konzentriert werden.
- persönliche Mobilnummern/private Mailadressen werden nicht automatisch migriert.
- die Platzbelegung wird ein eigenes TuS-WordPress-Plugin; Google Calendar iframe ist nicht das Zielmodell.
- Homepage V1 soll möglichst ohne unnötiges Marketing-/Verhaltens-Tracking auskommen.
- externe Embeds/Dienste werden bewusst und datensparsam eingesetzt.
- konkrete Kinderschutzmeldungen laufen nicht durch die normale KI-/n8n-Poststelle.
- produktive WordPress-Administration ist von der Pluginentwicklung getrennt.

### 4. Homepage – bestätigter Ist-Stand

Bekannt sind unter anderem:

- WordPress / Colibri als heutige Basis,
- 28 aktive Plugins aus Backend-Screenshots,
- Forminator aktiv,
- Jetpack aktiv,
- zwei Rollen-/Rechte-Plugins,
- zwei Backup-Plugins,
- mehrere PDF-/Flipbook-Lösungen,
- mehrere Kalender-/Event-/Belegungswege,
- fussball.de-Widget-Plugin,
- Google-Calendar-iframe bei Platzbelegung,
- bestehende rollenbasierte IONOS-Adressen,
- alte Datenschutzerklärung mit Google-Analytics-Angabe, tatsächliche Aktivität noch offen.

Die Altplugin-Landschaft dient aktuell vor allem als Anforderungs- und Migrationskarte für die neuen TuS-Produkte.

### 5. Aktuelle Priorität Homepage / WordPress

Aktuell **nicht** priorisiert:

- Altplugins deaktivieren/löschen,
- Backend-Cleanup,
- Backup-/Restore-Tests durch Mathias,
- Benutzer-/Rollenbereinigung durch Mathias.

Aktuell priorisiert:

1. TuS-eigene Plugins und Homepage-Komponenten entwickeln,
2. Event Planner weiterentwickeln,
3. TuS Platzbelegung entwickeln,
4. MatchCard-/Spieldatenintegration vorbereiten,
5. Kontakt-/Formulararchitektur auf offizielle Rollenwege ausrichten,
6. Partner-/Sponsor-Komponenten entwickeln,
7. Privacy by Design direkt in die neuen Produkte einbauen.

Wenn für eine konkrete Entwicklung Information aus der Altinstallation benötigt wird, wird sie gezielt beim Nutzer bzw. einer autorisierten Backend-Person angefordert.

### 6. Spätere produktive Migration

Sobald ein Zielsystem abnahmefähig ist:

- Mathias liefert Ersatzfunktion, Migrationshinweise und Tests,
- eine autorisierte Backend-Person führt produktive Änderungen aus,
- David prüft relevante Datenflüsse/Privacy-Auswirkungen,
- Altplugin wird erst nach erfolgreichem Vergleichstest und bestätigter Wiederherstellbarkeit abgeschaltet.

### 7. IONOS / Kontaktstruktur

Bestätigte nicht-persönliche Adressen existieren bereits, unter anderem für Geschäftsstelle, Mitgliederverwaltung, Jugendleitung, Senioren/Aktive, Presse, Datenschutz, Finanzen, Turniere und weitere Fach-/Systemzwecke.

Starke neue Kandidaten bleiben insbesondere:

- `redaktion@...`,
- genau eine Partneradresse (`partner@...` oder `sponsoring@...`).

Die endgültige Routing-/Mailbox-/Alias-/Automationsentscheidung bleibt noch offen.

### 8. Weitere Datenschutz-Prioritäten

Nach bzw. parallel zur produktorientierten Homepage-Arbeit:

- IONOS-/Poststellenarchitektur festlegen,
- Legacy Contact Cleanup bei Homepage-Migration,
- organisationsweite Daten-/Berechtigungsinventur,
- Verzeichnis von Verarbeitungstätigkeiten aus realen Datenflüssen,
- Dienstleister-/AVV-Check,
- Lösch-/Aufbewahrungslogik,
- Datenpannen-/Betroffenenprozess,
- formelle DSB-Frage belastbar klären.

### 9. Bewusst nicht in GitHub

Nicht hier dokumentiert werden:

- Mitgliederlisten,
- konkrete Kinderschutzmeldungen,
- Gesundheitsdaten,
- Führungszeugnisinhalte,
- Zugangsdaten,
- konkrete personenbezogene Datenpannenfälle,
- sensible Betroffenenanfragen,
- Backup-/Datenbankdateien.

## Relationship to other documents

- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `HOMEPAGE-TECHNICAL-INVENTORY.md`
- `HOMEPAGE-PLUGIN-MIGRATION.md`
- `HOMEPAGE-PLUGIN-CLEANUP-PLAN.md`
- `../../design/homepage-contact-architecture.md`
- `../../roles/data-protection-manager/role.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../projects/platzbelegung/PROJECT-STATE.md`
- `../../projects/event-planner/`

## Future Development

Der nächste Fortschritt im Homepage-/WordPress-Bereich entsteht jetzt primär durch **Entwicklung der TuS-Zielplugins**. Backend-Inventur und Plugin-Abschaltung werden später bedarfsgerecht für die jeweils konkrete Migration ergänzt.