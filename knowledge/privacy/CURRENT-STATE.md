# Datenschutz & Informationsschutz – Current State

## Purpose

Dieses Dokument hält den aktuellen organisationsweiten Arbeitsstand zu Datenschutz und Informationsschutz der TuS Digital Organisation fest.

Es enthält keine sensiblen Falldaten und ersetzt weder Rechtsberatung noch eine formelle Datenschutzbeauftragten-Benennung.

## Core Principle

> **Personenbezogene Daten gehören nur dorthin, wo sie für einen klaren Zweck gebraucht und angemessen geschützt werden.**

## Main Content

### 1. Aktueller Reifegrad

Der TuS hat mehrere digitale Fachsysteme, Projektideen und Automationspfade im Aufbau. Datenschutz ist bisher in einzelnen Standards und Projekten berücksichtigt, aber noch nicht als eigener Querschnittsbereich systematisch konsolidiert.

Mit der Rolle `Data Protection & Information Protection Manager` wird diese Querschnittsverantwortung erstmals dauerhaft gebündelt.

Der erste konkrete Privacy Check wurde am 11.09.2026 auf die öffentliche TuS-Homepage priorisiert. Die Ergebnisse und der Developer-Handoff liegen in `HOMEPAGE-PRIVACY-CHECK.md`.

Als zweiter Homepage-Schritt wurde die öffentlich sichtbare Kontaktlandschaft inventarisiert. Der belastbare Arbeitsstand und die Ableitung für die spätere IONOS-Struktur liegen in `HOMEPAGE-CONTACT-INVENTORY.md`.

Als dritter Homepage-Schritt wurde die öffentlich feststellbare technische Ist-Situation aufgenommen und eine verbindliche Backend-Inventur für den WordPress Developer definiert. Der Arbeitsstand liegt in `HOMEPAGE-TECHNICAL-INVENTORY.md`.

### 2. Bekannte relevante Systeme / Bereiche

Für die erste Datenschutz-Inventur sind insbesondere zu prüfen:

- bestehende Mitgliederverwaltung und Mitgliederdaten,
- Google Drive inklusive geschützter Bereiche und Freigaben,
- GitHub als Organisations- und Entwicklungswissen,
- WordPress-Homepage und Plugins,
- Event Planner,
- Partner-CRM und spätere Partnerportal-/Partner-Hub-Funktionen,
- Team Manager und zukünftige Mannschafts-/Personenmodelle,
- E-Mail bei IONOS,
- geplanter n8n-E-Mail-/Workflow-Flur,
- ChatGPT-/KI-gestützte Arbeitsprozesse,
- Canva bzw. Medien-/Designprozesse soweit personenbezogene Inhalte verarbeitet werden,
- Archiv- und Veröffentlichungsprozesse,
- Spielberichte, Fotos und Social-Media-Veröffentlichungen,
- Kinder- und Jugendschutzprozess,
- Beschäftigten-/Lohn-/Förderdaten im Kontext Sportparkteam.

Die Liste ist ein Startinventar und noch kein bestätigtes Verzeichnis von Verarbeitungstätigkeiten.

### 3. Bekannte Architekturentscheidungen

Bereits verbindlich bzw. fachlich gesetzt:

- GitHub ist Organisationswissen und **keine operative personenbezogene Datenbank**.
- Vertrauliche, personenbezogene, finanzielle oder vertragliche Dateien gehören in angemessen geschützte Bereiche und nicht allein wegen der Projektablage nach GitHub.
- Die geplante digitale TuS-Poststelle soll rollenbasierte IONOS-Adressen nutzen und n8n als Orchestrierungsschicht verwenden.
- Hochsensible Postfächer bzw. Schutzfallprozesse dürfen nicht automatisch in normale KI-/n8n-Queues laufen.
- Konkrete Kinderschutzmeldungen werden besonders geschützt und menschlich verantwortet verarbeitet.
- Öffentliche Homepage-Formulare sollen serverseitig validiert und technisch sauber gegen Missbrauch abgesichert werden.
- Neue Systeme sollen keine unnötigen parallelen Personen- oder Partnerdatenwelten erzeugen.
- Für die neue Homepage ist Privacy-by-Design das Ziel: möglichst keine unnötigen Drittanbieter-Embeds, kein beiläufiges Tracking und kein pauschales Cookie-Banner ohne tatsächlichen Bedarf.
- Die neue Homepage soll fachlich führende Daten möglichst über kontrollierte serverseitige Adapter bzw. eigene Darstellung nutzen, statt Besucherbrowser direkt an Drittanbieter-iframes oder Skripte zu koppeln.
- Öffentliche Kontaktwege sollen rollenbasiert und auf offizielle TuS-Adressen konzentriert werden; persönliche Mobilnummern und private Adressen sind nicht das Standardmodell.
- Die Platzbelegung wird als eigenes WordPress-Plugin umgesetzt; ein direkt eingebetteter Google-Kalender ist nicht das Zielmodell.
- Öffentliche Technikbeobachtung ist Hinweis, aber keine automatische Source of Truth für Plugins, Tracking, Cookies oder Hosting. Diese Punkte werden im produktiven System verifiziert.

### 4. Formelle Datenschutzbeauftragten-Frage

Noch offen ist, ob der TuS aufgrund der tatsächlichen organisatorischen und technischen Situation zur formellen Benennung eines Datenschutzbeauftragten verpflichtet ist oder eine freiwillige Benennung sinnvoll wäre.

Dafür ist eine belastbare Bestandsaufnahme erforderlich, insbesondere:

- wie viele Personen beim TuS regelmäßig und dauerhaft automatisiert personenbezogene Daten verarbeiten,
- ob Verarbeitungsvorgänge bestehen, die eine Datenschutz-Folgenabschätzung erfordern könnten,
- ob weitere Kriterien aus Art. 37 DSGVO einschlägig sind,
- welche Interessenkonflikte bei möglichen internen Personen bestehen würden.

Bis zur Entscheidung wird die interne Rolle nicht als formell bestellter DSB bezeichnet.

Die aktuelle öffentliche Homepage verwendet derzeit dennoch die Bezeichnung `Datenschutzbeauftragter`. Diese öffentliche Formulierung ist als P0-Korrektur markiert, sofern keine formelle Bestellung nachgewiesen wird.

### 5. Homepage Privacy Check – 11.09.2026

Belastbar öffentlich festgestellt:

- die aktuelle Datenschutzseite beschreibt Google Analytics mit `berechtigtem Interesse`; ob Analytics technisch noch aktiv ist, ist noch zu verifizieren,
- die aktuelle Cookie-Erklärung ist generisch und auf Browser-Einstellungen ausgerichtet,
- die aktuelle Seite bezeichnet `datenschutz@tus-mingolsheim.de` als Kontakt des `Datenschutzbeauftragten`, obwohl der formelle Status noch offen ist,
- das Impressum referenziert noch `§ 55 Abs. 2 RStV`; die aktuelle medienrechtliche Referenz ist zu aktualisieren,
- die Seite `Platzbelegung` lädt einen iframe von `calendar.google.com`,
- auf derselben Seite sind externe Bildressourcen über `i0.wp.com` sichtbar,
- Facebook und Instagram sind auf der Startseite als normale externe Links vorhanden; dieses Muster ist datenschutzseitig einfacher als ein automatisch ladender Social Feed.

Die vollständige Bewertung, Prioritäten und Entwicklerregeln stehen in `HOMEPAGE-PRIVACY-CHECK.md`.

### 6. Homepage-Kontaktinventur – 11.09.2026

Öffentlich bestätigt sind bereits mehrere sinnvolle Rollenadressen, insbesondere:

- Geschäftsstelle,
- Mitgliederverwaltung,
- Jugendleitung,
- Aktive/Senioren,
- Datenschutzkontakt.

Gleichzeitig finden sich auf bestehenden Seiten und älteren Beiträgen weiterhin persönliche Mobilnummern bzw. personengebundene Direktkontakte, insbesondere bei Vorstands-/Funktionsseiten, einzelnen Mannschaftsseiten, Fördervereinsseiten und historischen Veranstaltungsbeiträgen.

Wesentliche Konsequenz:

- nicht nur die neue Kontaktseite, sondern auch migrierter Legacy-Content muss auf obsolete persönliche Kontaktdaten geprüft werden,
- die spätere IONOS-Struktur wird in öffentliche Rollenadressen, operative interne Rollenpostfächer und besonders geschützte menschliche Kontaktwege getrennt,
- eine öffentliche Adresse muss technisch nicht zwingend ein eigenes Postfach sein; Alias, Weiterleitung oder kontrollierter Workflow sind je Zweck zu entscheiden,
- die vollständige Arbeitsinventur steht in `HOMEPAGE-CONTACT-INVENTORY.md`.

### 7. Homepage Technical Inventory – 11.09.2026

Öffentlich belastbar bzw. als Arbeitsbefund festgehalten:

- die Website läuft auf WordPress,
- der öffentliche Footer nennt Colibri,
- die Platzbelegung verwendet einen direkten Google-Calendar-iframe,
- auf der Platzbelegungsseite wurden externe Bildressourcen über `i0.wp.com` beobachtet,
- die Datenschutzerklärung behauptet Google Analytics, die technische Aktivität ist jedoch noch nicht bestätigt,
- Facebook und Instagram sind als normale externe Links sichtbar,
- die Homepage verweist auf mindestens einen Kontaktformularprozess; dessen technische Implementierung ist öffentlich nicht belastbar identifiziert.

Noch im produktiven System zu verifizieren sind insbesondere:

- WordPress-/PHP-/Theme-Stand,
- vollständige Pluginliste,
- Benutzer und Berechtigungen,
- aktive Formulare und deren Empfänger/Speicherung,
- Cookies/Local Storage/Session Storage,
- externe Network-Requests,
- Analytics/Tag Manager/Consent tatsächlich aktiv oder nicht,
- Hosting, Serverlogs, Backups und Staging,
- E-Mail-Versand aus WordPress,
- Medien-/CDN-Konfiguration.

Die genaue Prüflogik und Migrationsklassifikation `BEHALTEN / HÄRTEN / ERSETZEN / ENTFERNEN / OFFEN` stehen in `HOMEPAGE-TECHNICAL-INVENTORY.md`.

### 8. Erste operative Prioritäten

1. **Homepage P0 und technische Backend-Inventur abarbeiten**
   - Google-Analytics-Ist technisch verifizieren,
   - öffentliche DSB-Bezeichnung prüfen/korrigieren,
   - Impressumsreferenz aktualisieren,
   - WordPress/Core/Theme/Plugins inventarisieren,
   - Formulare und Empfänger prüfen,
   - Cookies/Storage und externe Requests technisch prüfen,
   - Hosting/Logs/Backups/Staging aufnehmen,
   - Benutzer/Berechtigungen prüfen,
   - Komponenten für Migration klassifizieren.

2. **IONOS-/Kontaktstruktur entscheiden**
   - bestehende Rollenadressen bestätigen,
   - benötigte neue öffentliche Rollenadressen festlegen,
   - operative interne Rollenpostfächer festlegen,
   - sensible menschliche Sonderwege definieren,
   - pro Adresse Mailbox/Alias/Weiterleitung/Workflow, Owner, Vertretung und Automationsklasse bestimmen.

3. **Legacy Contact Cleanup für Homepage-Migration vorbereiten**
   - alte persönliche Telefonnummern,
   - personengebundene Mailadressen,
   - alte Event-/Ticketkontakte,
   - alte Mannschafts-/Trainerkontakte,
   - veraltete Formulare und Formularziele.

4. **Datenschutz-Inventur erstellen**
   - Systeme,
   - Zwecke,
   - Datenkategorien,
   - betroffene Gruppen,
   - Owner,
   - Empfänger/Dienstleister,
   - Speicherorte.

5. **Berechtigungsinventur starten**
   - besonders Google Drive, WordPress, Partnerdaten und künftige E-Mail-Queues.

6. **Verzeichnis der Verarbeitungstätigkeiten vorbereiten**
   - nicht als Papierübung, sondern aus den realen Datenflüssen.

7. **Dienstleister-/AVV-Check**
   - nur für tatsächlich personenbezogene Verarbeitungen und aktuell genutzte Systeme.

8. **Lösch-/Aufbewahrungslogik priorisieren**
   - Mitgliederdaten,
   - Kontakte/CRM,
   - E-Mail-Eingänge,
   - Event-/Teilnehmerdaten,
   - Formulare,
   - Fotos/Medien,
   - sensible Sonderbereiche.

9. **E-Mail-/n8n-Architektur vor produktiver Automatisierung prüfen**
   - `redaktion@` kann Pilot werden,
   - Schutzfall- und sensible Postfächer separat behandeln.

10. **Privacy Check in Entwicklungsprojekte integrieren**
   - insbesondere Mitglieder & Engagement,
   - Team Manager,
   - Partnerportal/Partner Hub,
   - Homepage-Formulare,
   - Event Planner,
   - Tauschbörse.

11. **Datenpannen- und Betroffenenprozess definieren**
   - Zuständigkeit,
   - sicherer Dokumentationsweg,
   - Eskalationslogik,
   - Fristenmanagement.

### 9. Aktuelle wichtige Abhängigkeiten

#### Homepage / WordPress

Die Homepage ist aktuell der erste aktive Privacy-Schwerpunkt.

Für den Neuaufbau gelten `HOMEPAGE-PRIVACY-CHECK.md`, `HOMEPAGE-CONTACT-INVENTORY.md`, `HOMEPAGE-TECHNICAL-INVENTORY.md` und `../../design/homepage-contact-architecture.md`. Der WordPress Developer liest diese Quellen bei Homepage-Arbeit verbindlich mit.

Vor Go-live muss die tatsächliche technische Konfiguration der produktiven Website inventarisiert sein; erst daraus wird die finale Datenschutzerklärung abgeleitet.

#### Kinder- und Jugendschutz

Das Schutzkonzept benötigt getrennte, menschlich verantwortete Meldewege. Datenschutz unterstützt Zugriffs-, Aufbewahrungs- und Dokumentationsregeln, entscheidet aber nicht selbst über Schutzfallinterventionen.

#### Digitale Poststelle

Vor produktiver n8n-Anbindung müssen Datenminimierung, Routing, Zugriff, Aufbewahrung, Anhänge und hochsensible Sonderwege definiert sein.

Die Homepage-Kontaktinventur ist jetzt die fachliche Eingangsbasis für die spätere IONOS-/Poststellenentscheidung.

#### Mitglieder & Engagement / Team Manager

Diese Projekte dürfen keine parallele Personenidentität aufbauen. Vor Umsetzung muss klar sein, welche Personen-/Mitgliedsdaten führend sind und welche Systeme nur referenzieren.

#### Partnerportal / Partner Hub

Das bestehende geschützte Partner-CRM ist operative Zwischen-Source-of-Truth. Öffentliche Partneranfragen dürfen keine unkontrollierte zweite Datenhaltung erzeugen.

### 10. Bewusst nicht in GitHub

Nicht hier dokumentiert werden:

- konkrete Mitgliederlisten,
- individuelle Kinderschutzmeldungen,
- Gesundheitsdaten,
- Führungszeugnisinhalte,
- konkrete Lohn-/Sozialleistungsdaten,
- Zugangsdaten,
- konkrete personenbezogene Datenpannenfälle,
- sensible Betroffenenanfragen.

## Relationship to other documents

- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `HOMEPAGE-TECHNICAL-INVENTORY.md`
- `../../design/homepage-contact-architecture.md`
- `../../roles/data-protection-manager/role.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../../roles/data-protection-manager/START-PROMPT.md`
- `../../standards/child-youth-protection-standard.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../projects/PROJECT-PORTFOLIO.md`
- `../../architecture/memory-router.md`

## Future Development

Als nächstes folgen zwei parallel vorbereitete Schritte:

1. gemeinsame Entscheidung der IONOS-/Rollenpostfach-Struktur auf Basis der Kontaktinventur,
2. produktive Backend-Inventur von WordPress, Plugins, Cookies/Storage, externen Requests, Hosting/Logs/Backups, Formularen und Berechtigungen durch den WordPress Developer.

Danach werden die P0-Altlasten der bestehenden Homepage bereinigt und aus dem realen System schrittweise Verarbeitungstätigkeiten, Dienstleister-/AVV-Status sowie Lösch- und Aufbewahrungsregeln abgeleitet.
