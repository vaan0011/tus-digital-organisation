# Homepage Technical Inventory – TuS Mingolsheim

## Purpose

Dieses Dokument hält die öffentlich belastbar feststellbare technische Ist-Situation der aktuellen TuS-Mingolsheim-Homepage fest und definiert die noch notwendige Backend-Inventur für den WordPress Developer.

Es ist kein vollständiger Security-Scan und ersetzt keine Prüfung im WordPress-/Hosting-Backend. Öffentlich nicht verifizierbare Punkte werden ausdrücklich als offen behandelt.

Stand: 11.09.2026.

## Core Principle

> **Öffentliche Beobachtung liefert Hinweise. Verbindliche technische Wahrheit entsteht erst aus dem produktiven WordPress-/Hosting-System.**

Kein Plugin, Cookie, Trackingdienst, Formularziel oder externer Datenfluss wird allein aufgrund alter Datenschutzerklärung, Theme-Footer oder Vermutung als aktiv angenommen.

## Main Content

### 1. Öffentlich bestätigter technischer Rahmen

Öffentlich belastbar sichtbar:

- die Website läuft auf WordPress,
- der öffentliche Footer nennt `Colibri` als verwendete Website-/Theme-Basis,
- die Website wird über HTTPS ausgeliefert,
- Facebook und Instagram sind auf der Startseite als externe Links vorhanden,
- die Startseite verweist auf Veranstaltungskalender, Platzbelegung, Service/Kontakt und weitere Vereinsbereiche,
- die Platzbelegung verwendet aktuell mindestens einen direkten Google-Calendar-iframe,
- auf der Platzbelegungsseite sind externe Bildressourcen über `i0.wp.com` beobachtet worden,
- die Datenschutzerklärung beschreibt Google Analytics, obwohl die öffentliche Prüfung nicht bestätigt, dass Analytics aktuell technisch geladen wird,
- die Datenschutzerklärung basiert sichtbar auf einem älteren Generator-/Standardtext und bildet deshalb nicht automatisch den realen aktuellen Technikstand ab,
- die Homepage verweist auf ein Kontaktformular auf der Elternseite; die konkrete technische Formularimplementierung ist öffentlich nicht zuverlässig bestimmbar.

### 2. Öffentlich beobachtbare externe Abhängigkeiten

#### 2.1 Google Calendar

Aktuell wird auf `Platzbelegung` ein Kalender von `calendar.google.com` direkt eingebunden.

Status:

- technisch öffentlich sichtbar,
- für den Neuaufbau bereits als unerwünschtes Zielmodell markiert,
- wird durch das Projekt `TuS Platzbelegung` ersetzt.

Ziel:

- eigenes WordPress-Plugin,
- eigenes TuS-Rendering,
- keine direkte Google-iframe-Kernlösung.

#### 2.2 WordPress.com-/Jetpack-nahe Bildauslieferung

Auf der aktuellen Platzbelegungsseite wurden Ressourcen über `i0.wp.com` beobachtet.

Status:

- externer Ressourcenabruf öffentlich sichtbar,
- Ursache/Plugin/Feature noch nicht verifiziert,
- Umfang über die gesamte Website unbekannt.

Backend-Prüfung erforderlich:

- welches Plugin/Feature erzeugt die URLs,
- ob Jetpack bzw. WordPress.com Image CDN aktiv ist,
- ob weitere Medien darüber ausgeliefert werden,
- ob die Funktion künftig benötigt wird.

Ziel für den Neuaufbau:

- normale TuS-Assets bevorzugt lokal bzw. über bewusst freigegebenes Hosting/CDN ausliefern,
- externe CDN-Nutzung nicht als unbeabsichtigten Plugin-Default übernehmen.

#### 2.3 Google Analytics

Die aktuelle Datenschutzerklärung behauptet die Nutzung von Google Analytics.

Status:

- Dokumentationshinweis vorhanden,
- technische Aktivität öffentlich noch nicht bestätigt,
- deshalb weder als aktiv noch als inaktiv zu behandeln.

Backend-/Browserprüfung erforderlich:

- Analytics-Plugin oder manuell eingebautes Skript,
- Tracking-ID / Property nur intern dokumentieren, sofern benötigt,
- Requests beim Seitenaufruf vor und nach Einwilligung,
- Cookies/Storage,
- Tag Manager oder weitere Marketing-Tags,
- Consent-Mechanismus,
- Vertrag-/Kontoeigentümer und Berechtigungen.

Ziel Homepage V1:

- kein Marketing-/Verhaltens-Tracking ohne konkrete fachliche Entscheidung und abgeschlossenen Privacy Check.

#### 2.4 Social Media

Facebook und Instagram sind als normale externe Links sichtbar.

Status:

- datenschutzseitig einfaches Muster,
- kein öffentlich belastbar bestätigter automatisch ladender Social Feed im derzeit geprüften Startseiteninhalt.

Ziel:

- Links oder lokal/serverseitig kontrollierte Teaser bevorzugen,
- echte Social-Media-Embeds nicht ungefragt beim Seitenaufruf laden.

#### 2.5 Kontaktformulare

Die Startseite verweist für Elternfragen auf ein Kontaktformular auf der Elternseite.

Öffentlich konnte die technische Formularlösung nicht belastbar identifiziert werden.

Backend-Prüfung erforderlich:

- verwendetes Formularplugin,
- aktive Formulare,
- Pflichtfelder,
- Formularziele / Empfänger,
- gespeicherte Einträge in WordPress-Datenbank oder Plugin-Tabellen,
- E-Mail-Versandweg,
- Spam-Schutz/CAPTCHA,
- Drittanbieterrequests,
- Aufbewahrung/Löschung,
- Altformulare und obsolete Formularziele.

### 3. Nicht öffentlich belastbar feststellbar – Backend-Inventur erforderlich

Folgende Punkte werden nicht geraten, sondern müssen im echten System geprüft werden:

#### 3.1 Hosting und Server

- Hostinganbieter und Vertragspartner,
- produktive Domain-/DNS-Zuordnung,
- PHP-Version,
- Datenbanktyp/-Version soweit relevant,
- Server-/Access-/Error-Logs,
- Log-Aufbewahrung,
- Backup-System,
- Backup-Aufbewahrung und Zugriffsberechtigung,
- Staging-/Testsysteme,
- CDN/Proxy/WAF falls vorhanden.

Keine Zugangsdaten oder Secrets in GitHub dokumentieren.

#### 3.2 WordPress Core / Theme

- WordPress-Version,
- Theme und Child Theme,
- Colibri-Komponenten und tatsächliche Rolle,
- individuell angepasste Theme-Dateien,
- Update-Status,
- nicht mehr genutzte Themes.

#### 3.3 Plugins

Vollständige Liste erstellen mit mindestens:

- Pluginname,
- Version,
- aktiv/inaktiv,
- Zweck,
- Owner/Verantwortung,
- verarbeitet personenbezogene Daten ja/nein/unklar,
- externe Requests ja/nein/unklar,
- Cookies/Storage ja/nein/unklar,
- Update-/Wartungsstatus,
- künftig übernehmen / ersetzen / entfernen / prüfen.

Inaktive Altplugins gehören ebenfalls in die Inventur, weil sie Angriffsfläche und technische Altlasten darstellen können.

#### 3.4 Benutzer und Berechtigungen

Prüfen:

- bestehende WordPress-Benutzer,
- Rollen,
- Administratoren,
- ehemalige Funktionsträger,
- Sammelaccounts,
- unnötig hohe Rechte,
- MFA-/2FA-Möglichkeiten,
- Passwort-/Account-Prozess bei Rollenwechsel/Austritt.

Personenbezogene Benutzerlisten werden nicht in eine öffentliche GitHub-Datei kopiert. In GitHub reichen aggregierte Befunde, Regeln und offene Maßnahmen.

#### 3.5 Cookies / Storage / Browserzugriffe

Technisch im Browser prüfen:

- Cookies vor Zustimmung,
- Cookies nach Zustimmung,
- Local Storage,
- Session Storage,
- sonstige Endgerätezugriffe,
- Quelle/Zweck/Laufzeit,
- notwendige vs. optionale Speicherung.

Ergebnis muss mit der späteren Datenschutzerklärung und ggf. Consent-Lösung übereinstimmen.

#### 3.6 Externe Requests

Auf repräsentativen Seiten Network-Requests aufnehmen, insbesondere:

- Startseite,
- Impressum/Datenschutz,
- Platzbelegung,
- Eltern-/Jugendseite,
- Formularseiten,
- Artikel mit Medien,
- Partnerseite,
- Shop-/externe Weiterleitungen soweit relevant.

Pro externer Domain klären:

- Zweck,
- welche Daten technisch übertragen werden können,
- Anbieter/Dienstleister,
- notwendig oder ersetzbar,
- direkt beim Laden oder erst nach Nutzeraktion.

#### 3.7 Formulare und Uploads

Alle aktiven Formulare und Uploadwege inventarisieren.

Prüfen:

- Zweck,
- Datenfelder,
- Minderjährige betroffen,
- Uploads möglich,
- Zielsystem,
- E-Mail-Empfänger,
- Datenbankkopie,
- Spam-Schutz,
- Aufbewahrung,
- Löschbarkeit,
- Auskunftsfähigkeit,
- Übergang zur künftigen IONOS-/n8n-Poststelle.

#### 3.8 E-Mail-Versand aus WordPress

Prüfen:

- PHP-Mail / SMTP / Plugin / externer Dienst,
- Absenderadresse,
- Reply-To,
- Fehler-/Bounce-Verhalten,
- Logging,
- Zugangsdatenablage,
- Übergang auf offizielle TuS-Rollenadressen.

#### 3.9 Medien / Fotos

Prüfen:

- Media Library,
- alte nicht mehr benötigte Dateien,
- personenbezogene Dateinamen/Metadaten,
- Vorschaubilder/Thumbnails,
- externe CDN-Kopien,
- Löschwirkung bei Medienentfernung,
- besonders Jugendfotos und alte personenbezogene Inhalte.

### 4. Migrationsentscheidung je technischer Komponente

Für jeden gefundenen Dienst, Plugin oder externen Datenfluss wird genau eine Arbeitsentscheidung vergeben:

- `BEHALTEN` – fachlich benötigt und angemessen konfiguriert,
- `HÄRTEN` – bleibt, benötigt aber Sicherheits-/Privacy-/Berechtigungsänderung,
- `ERSETZEN` – fachlich benötigt, aktuelle technische Lösung ist nicht das Zielmodell,
- `ENTFERNEN` – kein belastbarer Nutzen mehr,
- `OFFEN` – technische/fachliche Prüfung fehlt.

Die Entscheidung wird nicht allein aus Datenschutzsicht getroffen. Funktion, Wartbarkeit, Kosten, UX und Architektur werden gemeinsam berücksichtigt.

### 5. Bereits erkennbare Migrationsrichtungen

#### Platzbelegung

`ERSETZEN`

Google-Calendar-iframe wird durch das eigene Projekt `TuS Platzbelegung` ersetzt.

#### Google Analytics

`OFFEN`

Erst technisch feststellen, ob Analytics überhaupt aktiv ist. Homepage V1 benötigt Analytics nicht als Default.

#### i0.wp.com / externer Bildweg

`OFFEN`

Ursache und tatsächlichen Nutzen prüfen. Für Standardassets lokales bzw. bewusst freigegebenes Hosting bevorzugen.

#### Social Links

`BEHALTEN`

Normale Links zu Social Media sind grundsätzlich ein einfaches, kontrollierbares Muster.

#### Alte Datenschutzerklärung

`ERSETZEN`

Die finale Datenschutzerklärung wird aus dem realen produktiven Technik- und Datenflussinventar abgeleitet.

#### Kontaktformulare

`OFFEN / NEU ORDNEN`

Bestehende Implementierung, Empfänger und Speicherung inventarisieren; danach in die neue Rollenpostfach-/Intake-Architektur überführen.

### 6. Developer-Handoff – konkrete Reihenfolge

Der WordPress Developer führt die technische Inventur vor größeren Homepage-Migrationsarbeiten in dieser Reihenfolge aus:

1. vollständige Plugin-/Theme-/WordPress-Inventur,
2. Benutzer-/Rollenprüfung ohne Veröffentlichung personenbezogener Detaildaten,
3. Formularinventur inkl. Empfänger und Datenspeicherung,
4. Browser-Check Cookies/Storage,
5. Network-Check externe Requests auf repräsentativen Seiten,
6. Hosting-/Logs-/Backups/Staging aufnehmen,
7. jede Komponente als `BEHALTEN / HÄRTEN / ERSETZEN / ENTFERNEN / OFFEN` klassifizieren,
8. Datenschutz- und Sicherheitsauffälligkeiten an Data Protection Manager zurückgeben,
9. daraus Migrationsplan und spätere echte Datenschutzerklärung ableiten.

### 7. Was nicht in GitHub gehört

Nicht in dieses Inventar schreiben:

- Passwörter,
- API-Keys,
- SMTP-Zugangsdaten,
- Analytics-/Dienstzugänge,
- vollständige personenbezogene Benutzerlisten,
- konkrete Formularinhalte,
- sensible Logauszüge mit personenbezogenen Details,
- Backup-Dateien,
- Datenbankexports.

GitHub dokumentiert Struktur, technische Fakten, Entscheidungen und offene Maßnahmen.

### 8. Definition of Done der technischen Homepage-Inventur

Die Inventur ist abgeschlossen, wenn:

- WordPress/Core/Theme/Plugins vollständig aufgenommen sind,
- aktive Formulare und deren Datenflüsse bekannt sind,
- Cookies/Storage technisch geprüft sind,
- externe Browserrequests bekannt sind,
- Hosting/Logs/Backups/Staging dokumentiert sind,
- Benutzer-/Berechtigungsmodell geprüft ist,
- bekannte externe Dienstleister sichtbar sind,
- jede relevante Komponente eine Migrationsentscheidung hat,
- offene rechtliche/vertragliche/Privacy-Punkte markiert sind,
- keine Secrets oder unnötigen personenbezogenen Details in GitHub gelandet sind,
- Mathias und David denselben bestätigten technischen Ausgangspunkt verwenden.

## Relationship to other documents

- `HOMEPAGE-PRIVACY-CHECK.md`
- `HOMEPAGE-CONTACT-INVENTORY.md`
- `CURRENT-STATE.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../projects/platzbelegung/README.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../roles/data-protection-manager/privacy-standard.md`

## Future Development

Nach der Backend-Inventur wird dieses Dokument nicht zu einem dauerhaften Plugin-Katalog aufgebläht. Dauerhafte Architektur- und Privacy-Entscheidungen werden in die zuständigen Standards, Projektzustände oder ADRs zurückgeführt.

Die unmittelbar nächsten Entscheidungen bleiben:

- IONOS-/Rollenpostfach-Struktur,
- produktive technische Homepage-Inventur durch den WordPress Developer,
- anschließende P0-Bereinigung der bestehenden Website und Migrationsplanung für den Neuaufbau.
