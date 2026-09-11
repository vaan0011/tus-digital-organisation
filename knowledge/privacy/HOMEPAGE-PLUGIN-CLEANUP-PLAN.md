# Homepage Plugin Cleanup Plan – TuS Mingolsheim

## Purpose

Dieses Dokument übersetzt die bestätigte Plugin-Inventur der produktiven TuS-Homepage in eine sichere, ausführbare Bereinigungsreihenfolge.

Es ist **kein Auftrag zur sofortigen Massen-Deaktivierung**. Jede Entfernung erfolgt erst nach bestätigter Nichtnutzung oder nach erfolgreicher Migration der abhängigen Funktion.

## Core Principle

> **Erst Wiederherstellbarkeit sichern. Dann Abhängigkeit verstehen. Dann ersetzen. Erst danach entfernen.**

Die bestehende Homepage bleibt während der Migration funktionsfähig. Eine kleinere Plugin-Landschaft ist Ziel, aber nicht auf Kosten von Verfügbarkeit, Inhalten oder Daten.

## Main Content

### 1. Wave 0 – Sicherheitsnetz vor jeder Bereinigung

Bevor das erste Plugin deaktiviert wird, muss Mathias im Produktivsystem:

1. den aktuellen WordPress-/PHP-/Theme-Stand festhalten,
2. alle aktiven **und inaktiven** Plugins erfassen,
3. Backup-Ziel, Backup-Lauf und Wiederherstellungsmöglichkeit prüfen,
4. mindestens einen realen Restore-Weg bestätigen oder auf einer Test-/Staging-Kopie verifizieren,
5. zentrale Smoke-Tests festlegen:
   - Startseite,
   - Navigation,
   - News/Beiträge,
   - Jugend-/Mannschaftsseiten,
   - Platzbelegung,
   - Veranstaltungskalender,
   - Formulare,
   - Partner-/Logo-Darstellung,
   - PDF/Magazin,
   - fussball.de-/Spielinhalte,
   - Login/Admin,
6. bei Plugins mit eigenen Datenmodellen prüfen, ob Deaktivierung Daten nur ausblendet oder tatsächlich verändert/löscht.

**Stop-Kriterium:** Keine Bereinigung, solange Restore-Fähigkeit unklar ist.

### 2. Wave 1 – kleine UI-/Hilfsplugins mit geringer Zielrelevanz

Diese Plugins sind frühe **Prüfkandidaten**, aber erst nach Nutzungssuche in Seiten, Widgets, Shortcodes und Theme:

- `WP-PageNavi`
- `linkButton`
- `Button Widget by Loomisoft`
- `Yoast Duplicate Post`
- `Advanced Editor Tools`

Vorgehen je Plugin:

1. Nutzung suchen,
2. falls keine Nutzung: deaktivieren,
3. Smoke-Test,
4. mindestens einen normalen Redaktions-/Frontend-Durchlauf prüfen,
5. erst anschließend löschen.

`Yoast Duplicate Post` und `Advanced Editor Tools` bleiben bestehen, falls der reale Redaktionsprozess sie weiterhin sinnvoll nutzt.

### 3. Wave 2 – Doppelungen konsolidieren

#### 3.1 Backup

Aktuell:

- `UpdraftPlus`
- `BackUpWordPress`
- mögliche Hosting-Backups noch separat zu bestätigen

Ziel:

- genau eine dokumentierte operative Backup-/Restore-Strategie,
- kein Parallelbetrieb mehrerer Plugins ohne klaren Zweck.

Reihenfolge:

1. Backup-Ziele und Zeitpläne vergleichen,
2. Restore testen,
3. Zielsystem auswählen,
4. nicht benötigtes Backup-Plugin deaktivieren,
5. Restore/Backup erneut prüfen,
6. erst danach entfernen.

#### 3.2 Rollen und Rechte

Aktuell:

- `User Role Editor`
- `Advanced Access Manager`

Vor Konsolidierung zwingend inventarisieren:

- Custom Roles,
- Custom Capabilities,
- Content-/Seitenzugriffsregeln,
- Sonderrechte von Redakteuren, Trainern, Event-/Plugin-Rollen,
- Abhängigkeiten eigener Plugins.

**Stop-Kriterium:** Keine Entfernung, solange nicht klar ist, welches Plugin welche produktive Regel erzeugt.

### 4. Wave 3 – PDF-/Publikationslandschaft vereinfachen

Aktuell:

- `PDF Embedder`
- `Gutenberg PDF Viewer Block`
- `3D FlipBook : DearFlip Lite`

Ziel:

- normale PDFs möglichst über eine einfache Standarddarstellung bzw. Download/Browser-Viewer,
- nur dort eine Spezialdarstellung, wo echter Mehrwert besteht,
- Jubiläumsmagazin ggf. bewusst separat behandeln.

Vor Entfernung:

- bestehende Beiträge/Seiten auf Blocks/Shortcodes prüfen,
- relevante PDFs dokumentieren,
- Ersatzdarstellung testen,
- Legacy-Inhalte migrieren.

### 5. Wave 4 – fachliche Altplugins durch TuS-Zielsysteme ersetzen

Diese Plugins werden **erst entfernt, wenn der fachliche Ersatz produktiv vorhanden ist**:

- `Kalender` → Event Planner / neue Eventarchitektur
- `Timetable and Event Schedule` → Event Planner + TuS Platzbelegung
- Google-Calendar-iframe → eigenes Plugin `TuS Platzbelegung`
- `Meinturnierplan.de Widget Viewer` → Verein Turnierplaner, soweit der reale Use Case abgedeckt ist
- `Include Fussball.de Widgets` → kontrollierte MatchCard-/Spieldatenintegration
- `Logo Showcase with Slick Slider` → Partnerportal-/PartnerCard-Komponente
- `Timeline Express` + HTML Excerpts Add-on → Archiv-/Historienkomponente

Für jedes Plugin gilt:

`Ersatz produktiv → Inhaltsmigration → Vergleichstest → Altplugin deaktivieren → Smoke-Test → entfernen`

### 6. Wave 5 – Layout-/Page-Builder-Altlasten

Spät migrieren:

- `Colibri Page Builder`
- `Stackable – Gutenberg Blocks`
- ggf. weitere Layout-/Widget-Abhängigkeiten

Diese Plugins können große Teile der bestehenden Homepage rendern. Sie werden nicht als normale Cleanup-Kandidaten behandelt.

Ziel:

- neue Homepage bzw. betroffene Seiten vollständig im TuS-Zielsystem aufbauen,
- Legacy-Blöcke/Shortcodes identifizieren,
- Seite für Seite migrieren,
- erst nach vollständiger Ablösung den Builder entfernen.

**Stop-Kriterium:** Keine Deaktivierung von Colibri/Stackable auf Produktion, solange noch aktive Seiten davon abhängen.

### 7. Wave 6 – Formulare, Privacy, Anti-Spam und externe Dienste

Gemeinsam prüfen:

- `Forminator`
- `DSGVO All in one for WP`
- `Akismet Anti-spam`
- `Jetpack`

Diese Plugins bilden möglicherweise zusammen Datenflüsse, Cookies, Spam-Schutz, Formularspeicherung, CDN und weitere externe Funktionen ab.

Reihenfolge:

1. aktive Formulare und gespeicherte Einträge inventarisieren,
2. Empfänger und E-Mail-Versand prüfen,
3. externe Requests/Cookies/Storage aufnehmen,
4. Jetpack-Module einzeln bestimmen,
5. klären, ob `i0.wp.com` aus Jetpack Site Accelerator stammt,
6. künftige Formular-/Poststellenarchitektur definieren,
7. nur tatsächlich benötigte Funktionen in die Zielarchitektur übernehmen,
8. Datenschutzerklärung aus dem finalen realen Zustand ableiten.

**Kein Plugin bleibt allein deshalb installiert, weil seine Datenschutzerklärung es erwähnt.** Dokumentation folgt der Technik, nicht umgekehrt.

### 8. Update-Regel während der Migration

Plugins, die noch produktiv benötigt werden, dürfen nicht monatelang ungepflegt bleiben, nur weil sie später ersetzt werden.

Für produktiv benötigte Plugins gilt:

- Update-Risiko und Changelog prüfen,
- Backup/Restore vor kritischen Updates sicherstellen,
- Updates in kleinen Blöcken,
- Smoke-Test nach jedem Risikoblock,
- nicht gleichzeitig Update + Migration + Datenmodelländerung vermischen.

### 9. Arbeitsstatus je Plugin

Mathias pflegt für aktive Bereinigungsarbeit je Plugin nur den notwendigen Status:

- `NUTZUNG OFFEN`
- `ABHÄNGIGKEIT BESTÄTIGT`
- `ERSATZ FEHLT`
- `ERSATZ BEREIT`
- `DEAKTIVIERUNG GETESTET`
- `ENTFERNT`
- `BLEIBT`

Keine zweite komplexe Plugin-Datenbank aufbauen. Die Migrationsmatrix und konkrete Projektzustände bleiben die führenden Quellen.

### 10. Definition of Done der ersten Bereinigungsphase

Die erste Phase ist abgeschlossen, wenn:

- Backup-/Restore-Fähigkeit bestätigt ist,
- inaktive Plugins ebenfalls inventarisiert sind,
- die kleinen UI-/Hilfsplugins auf tatsächliche Nutzung geprüft sind,
- Backup-Doppelung entschieden ist,
- Rollen-/Rechte-Doppelung vollständig verstanden ist,
- keine Entfernung kaputte Seiten, Shortcodes oder Rechte hinterlassen hat,
- der nächste fachliche Ersatzblock klar priorisiert ist.

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

Nach jeder tatsächlich ausgeführten Bereinigungswelle werden nur belastbare Ergebnisse zurückgeschrieben: entfernte Plugins, verbleibende Abhängigkeiten, gewählte Zielsysteme und offene Risiken.

Der nächste operative Entwicklerauftrag ist **Wave 0 + Dependency-Check der Wave-1-Kandidaten**. Eine produktive Deaktivierung erfolgt erst nach bestätigter Wiederherstellbarkeit und klarer Nichtnutzung.