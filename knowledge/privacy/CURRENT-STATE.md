# Datenschutz & Informationsschutz – Current State

## Purpose

Dieses Dokument hält den aktuellen organisationsweiten Arbeitsstand zu Datenschutz und Informationsschutz der TuS Digital Organisation fest.

Es enthält keine sensiblen Falldaten und ersetzt weder Rechtsberatung noch eine formelle Datenschutzbeauftragten-Benennung.

## Core Principle

> **Personenbezogene Daten gehören nur dorthin, wo sie für einen klaren Zweck gebraucht und angemessen geschützt werden.**

## Main Content

### 1. Aktueller Reifegrad

Mit der Rolle `Data Protection & Information Protection Manager` ist Datenschutz erstmals als dauerhafte Querschnittsverantwortung im TuS-OS verankert.

Erster aktiver Schwerpunkt ist die öffentliche Homepage. Dafür liegen inzwischen vier belastbare Arbeitsquellen vor:

1. `HOMEPAGE-PRIVACY-CHECK.md` – rechtlich/technische Privacy-by-Design-Anforderungen,
2. `HOMEPAGE-CONTACT-INVENTORY.md` – öffentliche Kontaktwege und bestehende IONOS-Adressen,
3. `HOMEPAGE-TECHNICAL-INVENTORY.md` – technische Backend-Prüflogik,
4. `HOMEPAGE-PLUGIN-MIGRATION.md` – aktuelle Plugin-Inventur und Migrationsmatrix.

Der WordPress Developer liest diese Quellen bei Homepage-Arbeit verbindlich mit.

### 2. Bekannte relevante Systeme / Bereiche

Für die organisationsweite Datenschutz-Inventur sind insbesondere relevant:

- Mitgliederverwaltung und Mitgliederdaten,
- Google Drive inklusive Freigaben und geschützter Bereiche,
- GitHub als Organisations- und Entwicklungswissen,
- WordPress-Homepage und Plugins,
- Event Planner,
- Platzbelegung,
- Partner-CRM / Partnerportal / Partner Hub,
- Team Manager und künftige Personen-/Mannschaftsmodelle,
- IONOS-E-Mail,
- geplanter n8n-E-Mail-/Workflow-Flur,
- ChatGPT-/KI-gestützte Arbeitsprozesse,
- Canva und Medien-/Designprozesse soweit personenbezogene Inhalte betroffen sind,
- Archiv- und Veröffentlichungsprozesse,
- Spielberichte, Fotos und Social Media,
- Kinder- und Jugendschutz,
- Beschäftigten-/Lohn-/Förderdaten im Kontext Sportparkteam.

Die Liste ist ein Startinventar und noch kein vollständiges Verzeichnis von Verarbeitungstätigkeiten.

### 3. Verbindliche Architekturentscheidungen

Bereits gesetzt:

- GitHub ist Organisationswissen und **keine operative personenbezogene Datenbank**.
- Sensible, personenbezogene, finanzielle oder vertragliche Inhalte gehören in angemessen geschützte Systeme.
- Die geplante digitale TuS-Poststelle soll rollenbasierte IONOS-Adressen und n8n als Orchestrierungsschicht verwenden.
- Hochsensible Eingänge, insbesondere konkrete Kinderschutzmeldungen, dürfen nicht durch normale KI-/n8n-Queues laufen.
- Homepage-Formulare sollen minimal, serverseitig validiert und an kontrollierte Rollen-/Intake-Ziele geroutet werden.
- Öffentliche Standardkontakte werden an Rollen statt Personen gebunden.
- Die neue Homepage startet möglichst ohne Marketing-/Verhaltens-Tracking.
- Drittanbieter-iframes und beiläufige externe Skripte sind nicht das Zielmodell.
- Daten aus fachlich führenden Systemen werden möglichst über kontrollierte Adapter und eigenes TuS-Rendering dargestellt.
- Platzbelegung wird als eigenes WordPress-Plugin umgesetzt.
- Die Plugin-Landschaft soll deutlich reduziert werden; eigene TuS-Fachplugins ersetzen generische Altplugins, sobald der Ersatz belastbar ist.

### 4. Formelle Datenschutzbeauftragten-Frage

Noch offen ist, ob der TuS formal einen Datenschutzbeauftragten benennen muss oder freiwillig benennen sollte.

Dafür sind insbesondere noch belastbar festzustellen:

- wie viele Personen regelmäßig und dauerhaft automatisiert personenbezogene Daten verarbeiten,
- ob Verarbeitungsvorgänge bestehen, die eine Datenschutz-Folgenabschätzung erfordern könnten,
- ob weitere Kriterien aus Art. 37 DSGVO bzw. § 38 BDSG einschlägig sind,
- ob bei möglichen internen Kandidaten Interessenkonflikte bestehen.

Bis zur Entscheidung wird die interne Rolle nicht als formell bestellter DSB bezeichnet.

Die bestehende Homepage verwendet derzeit trotzdem die Bezeichnung `Datenschutzbeauftragter`; dies bleibt P0-Korrektur, sofern keine formelle Bestellung nachgewiesen wird.

### 5. Homepage Privacy Check

Belastbar öffentlich festgestellt:

- die aktuelle Datenschutzerklärung beschreibt Google Analytics mit `berechtigtem Interesse`; ob Analytics technisch aktuell aktiv ist, ist noch zu verifizieren,
- die aktuelle Cookie-Erklärung ist generisch und bildet den realen Technikstand nicht verlässlich ab,
- das Impressum referenziert noch `§ 55 Abs. 2 RStV`,
- die Seite `Platzbelegung` lädt einen direkten Google-Calendar-iframe,
- auf derselben Seite wurden Ressourcen über `i0.wp.com` beobachtet,
- Facebook und Instagram sind als normale externe Links eingebunden.

Ziel Homepage V1:

- kein unnötiges Tracking,
- kein Cookie-Banner ohne tatsächlichen Bedarf,
- lokale bzw. bewusst freigegebene Assets,
- keine ungefragten Social-/Google-/Video-Embeds,
- finale Datenschutzerklärung aus dem realen Produktivsystem statt aus pauschalem Generatortext.

### 6. Homepage-Kontakte und vorhandene IONOS-Struktur

Der Vorstand hat folgende bereits angelegte nicht-persönliche Adressen bestätigt; Domain jeweils `@tus-mingolsheim.de`:

- `admin`
- `adobe`
- `ah`
- `anrufbeantworter`
- `damengymnastik`
- `datenschutz`
- `finanzen`
- `geschaeftsstelle`
- `instagram`
- `jugendleitung`
- `mitgliederverwaltung`
- `presse`
- `senioren`
- `theater`
- `turniere`

Bereits gut nutzbare öffentliche Rollenwege sind insbesondere Geschäftsstelle, Mitgliederverwaltung, Jugendleitung, Senioren/Aktive, Presse, Datenschutz sowie fachlich passende Abteilungs-/Turnieradressen.

System-/Dienstadressen wie `admin@`, `adobe@` oder `instagram@` sind keine öffentlichen Homepage-Kontakte.

Starke neue Kandidaten mit bereits realem Prozessbedarf:

- `redaktion@...` – redaktionelle Einreichungen, Spielberichte, Matchday-/Stadionheft-Prozesse; getrennt von `presse@...`,
- genau eine kanonische Partneradresse: `partner@...` oder `sponsoring@...`.

Interne Arbeitsadressen wie `foerderung@...` oder `archiv@...` werden nur angelegt, wenn der reale Workflow sie benötigt.

Ein späterer Kinderschutzkontakt ist besonders geschützt und nicht Teil der normalen KI-/n8n-Poststelle.

Noch offen pro bestehender/neuer Adresse:

- Mailbox / Alias / Weiterleitung / Workflow,
- Owner,
- Vertretung,
- öffentliche Sichtbarkeit,
- Automationsklasse,
- Aufbewahrung/Löschung.

### 7. Homepage Plugin Snapshot – 11.09.2026

Vom Vorstand wurden Screenshots des aktuellen WordPress-Backends bereitgestellt. Darauf sind **28 aktive Plugins** erkennbar. Ob zusätzlich inaktive Plugins installiert sind, ist noch zu prüfen.

Vollständige Matrix: `HOMEPAGE-PLUGIN-MIGRATION.md`.

Besonders relevante Cluster:

#### Eigene TuS-Lösung

- `Verein Turnierplaner` – behalten und gegen aktuellen GitHub-/Release-Stand härten.

#### Kalender / Events / Belegung

- `Kalender`
- `Timetable and Event Schedule`
- bestehender Google-Calendar-iframe

Ziel: durch Event Planner und eigenes Platzbelegungs-Plugin ersetzen.

#### Spielplandaten

- `Include Fussball.de Widgets`

Ziel: kontrollierte MatchCard-/fussball.de-Integration mit eigenem TuS-Rendering; bestehendes Widget erst nach funktionierendem Ersatz entfernen.

#### Partnerdarstellung

- `Logo Showcase with Slick Slider`

Ziel: Partnerportal/Partnerdaten + eigene PartnerCard/Logo-Komponente.

#### Rollen/Rechte – Doppelung

- `User Role Editor`
- `Advanced Access Manager`

Vor Reduktion müssen Custom Roles, Capabilities und Access Rules aufgenommen werden.

#### Backups – Doppelung

- `UpdraftPlus`
- `BackUpWordPress`
- ggf. Hosting-Backups noch zu verifizieren

Ziel: eine belastbare Backup-/Restore-Strategie mit getestetem Restore.

#### PDF / Magazin – Dreifachlösung

- `PDF Embedder`
- `Gutenberg PDF Viewer Block`
- `3D FlipBook : DearFlip Lite`

Ziel: auf ein bewusstes Muster reduzieren; für normale PDFs kann ein nativer Weg genügen, Magazinansicht nur bei echtem Mehrwert separat.

#### Layout / Alt-UI

- `Colibri Page Builder`
- `Stackable – Gutenberg Blocks`
- `Button Widget by Loomisoft`
- `linkButton`
- `WP-PageNavi`

Diese werden nicht blind entfernt, weil bestehende Seiten davon abhängen können. Der Homepage-Neuaufbau soll sie schrittweise durch das TuS Digital Design System und definierte Komponenten ersetzen.

#### Formulare / Privacy / externe Dienste

- `Forminator`
- `DSGVO All in one for WP`
- `Jetpack`
- `Akismet`

Hier sind Datenfluss, tatsächliche Nutzung, externe Requests, Speicherung und künftiger Bedarf zu prüfen. `i0.wp.com` kann mit Jetpack zusammenhängen, ist aber noch technisch zu bestätigen.

### 8. Noch offene technische Backend-Inventur

Trotz Plugin-Screenshots fehlen noch folgende produktive Fakten:

- WordPress-/PHP-/Theme-Versionen und Child-Theme/Customizations,
- zusätzliche inaktive Plugins,
- Seiten/Shortcodes/Widgets, die von jedem Plugin abhängen,
- Benutzer, Administratoren, Rollen und ehemalige Accounts,
- aktive Formulare, Empfänger, gespeicherte Einträge und Uploads,
- WordPress-Mailversand / SMTP / Absender,
- Cookies, Local Storage und Session Storage,
- externe Browserrequests auf repräsentativen Seiten,
- Analytics/Tag Manager/Consent tatsächlich aktiv oder nicht,
- aktive Jetpack-Module,
- Hosting, Serverlogs, Backups, Backup-Ziele, Staging und Restore-Fähigkeit,
- Medien-/CDN-Konfiguration.

Jede technische Komponente erhält danach eine Migrationsentscheidung:

`BEHALTEN / HÄRTEN / ERSETZEN / KONSOLIDIEREN / ENTFERNEN / OFFEN`.

### 9. Aktuelle operative Prioritäten

1. **Plugin-Dependency-Check durch Mathias**
   - Nutzung je Plugin/Shortcode/Widget prüfen,
   - Doppelungen auflösen planen,
   - TuS-Ersatz je Funktion bestätigen,
   - keine Massen-Deaktivierung ohne Test.

2. **Homepage-P0 technisch verifizieren**
   - Google Analytics tatsächlich aktiv oder nicht,
   - Jetpack/CDN und `i0.wp.com`,
   - Forminator-Datenfluss,
   - DSGVO-/Consent-Plugin reale Funktion,
   - Impressum/DSB-Bezeichnung korrigieren.

3. **Backup/Restore vor Bereinigung absichern**
   - UpdraftPlus / BackUpWordPress / Hosting-Backup vergleichen,
   - Zielbestand festlegen,
   - Restore testbar machen.

4. **IONOS-/Routing-Matrix beschließen**
   - vorhandene Adressen klassifizieren,
   - `redaktion@` und Partnerkontakt entscheiden,
   - Owner/Vertretung/Automationsklasse festlegen.

5. **Legacy Contact Cleanup vorbereiten**
   - alte persönliche Telefonnummern,
   - personengebundene Mailadressen,
   - Event-/Ticketkontakte,
   - alte Trainer-/Mannschaftskontakte,
   - veraltete Formularziele.

6. **Danach organisationsweite Datenschutz-Inventur fortführen**
   - Berechtigungen,
   - Verarbeitungstätigkeiten,
   - Dienstleister/AVV,
   - Lösch-/Aufbewahrungslogik,
   - Datenpannen-/Betroffenenprozess.

### 10. Aktuelle wichtige Abhängigkeiten

#### Homepage / WordPress

Die Homepage bleibt erster aktiver Privacy-Schwerpunkt. Der WordPress Developer arbeitet mit den vier genannten Homepage-/Plugin-Quellen und schreibt bestätigte technische Fakten zurück.

#### Digitale Poststelle

Vor produktiver n8n-Anbindung müssen Datenminimierung, Routing, Zugriff, Aufbewahrung und sensible Sonderwege verbindlich sein. `redaktion@` bleibt geeigneter Pilot für einen normalen redaktionellen Eingang.

#### Kinder- und Jugendschutz

Schutzmeldungen benötigen getrennte menschliche Meldewege. Datenschutz unterstützt Zugriff und Dokumentation, übernimmt aber nicht die Schutzfallentscheidung.

#### Mitglieder & Engagement / Team Manager

Keine parallele Personenidentität aufbauen. Führende Datenquelle und Referenzmodell müssen vor Umsetzung geklärt werden.

#### Partnerportal / Partner Hub

Das geschützte Partner-CRM bleibt operative Zwischen-Source-of-Truth. Öffentliche Partneranfragen dürfen keine unkontrollierte zweite Datenhaltung erzeugen.

### 11. Bewusst nicht in GitHub

Nicht hier dokumentiert werden:

- Passwörter oder API-/SMTP-Zugangsdaten,
- konkrete Mitgliederlisten,
- vollständige WordPress-Benutzerlisten,
- Formularinhalte,
- individuelle Kinderschutzmeldungen,
- Gesundheitsdaten,
- Führungszeugnisinhalte,
- konkrete Lohn-/Sozialleistungsdaten,
- konkrete personenbezogene Datenpannenfälle,
- sensible Betroffenenanfragen.

## Relationship to other documents

- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `HOMEPAGE-TECHNICAL-INVENTORY.md`
- `HOMEPAGE-PLUGIN-MIGRATION.md`
- `../../design/homepage-contact-architecture.md`
- `../../roles/data-protection-manager/role.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../standards/child-youth-protection-standard.md`
- `../../projects/platzbelegung/PROJECT-STATE.md`
- `../../projects/PROJECT-PORTFOLIO.md`
- `../../architecture/memory-router.md`

## Future Development

Der nächste belastbare Fortschritt entsteht jetzt nicht durch weitere Vermutungen, sondern durch Mathias' produktiven Dependency-/Backend-Check und die gemeinsame Entscheidung der IONOS-Routing-Matrix.

Danach werden Homepage-P0-Maßnahmen und die erste kontrollierte Plugin-Bereinigungswelle umgesetzt. Erst aus dem danach real eingesetzten System wird die finale Datenschutzerklärung abgeleitet.