# Systemlandschaft: n8n und Datensicherung

Stand: 2. Oktober 2026. Dieses Dokument beschreibt die tatsächlich eingerichtete n8n-Umgebung des TuS und ihre Sicherung. Es ergänzt die [organisationsweite Systemübersicht](system-overview.md). Änderungen am Server sollten hier nachgetragen werden.

## Komponenten

| Ort / Dienst | Aufgabe | Aktueller Stand |
| --- | --- | --- |
| IONOS (1&1), Ubuntu-Server | Betrieb der Automatisierungsplattform | Docker Compose betreibt n8n, PostgreSQL, Traefik und eine vorgeschaltete Authentifizierung (Authgate). |
| n8n | Workflows und Integrationen | Anwendungsdaten liegen in PostgreSQL; lokale n8n-Dateien enthalten unter anderem die Konfiguration und den Schlüssel zum Entschlüsseln gespeicherter Zugangsdaten. |
| Traefik und Authgate | HTTPS und Zugang zur Weboberfläche | Traefik terminiert HTTPS; Authgate schützt die Anwendung zusätzlich vor dem n8n-Login. |
| Google Cloud | Autorisierung für Google Drive | Ein Projekt mit aktivierter Drive API und OAuth-Client erlaubt `rclone` den Zugriff. Dort werden keine n8n-Backups gespeichert. |
| Google Drive | Externe Sicherung | `restic` speichert verschlüsselte Sicherungen im Ordner `TuS-n8n-Backup/restic`; `rclone` stellt die Verbindung her. |
| IONOS Mail Basic | Backup-Warnungen | Das Postfach `n8n@tus-mingolsheim.de` sendet und empfängt Warnungen bei fehlgeschlagenen Backups. |
| Passwortmanager | Wiederherstellungsschlüssel | Das separate Passwort des restic-Repositorys ist privat hinterlegt. Ohne dieses Passwort sind die Drive-Sicherungen nicht wiederherstellbar. |
| Mac des Betreibers | Frühere Zusatzkopie | Die manuelle, mit GPG verschlüsselte Sicherung vom 29. September 2026 wurde dorthin kopiert. Sie wird für die tägliche Sicherung nicht gebraucht; ob sie inzwischen gelöscht wurde, ist nicht bestätigt. |
| GitHub | Dokumentation und Entwicklung | Dieses Repository enthält die Systemdokumentation. Hier liegen weder produktive n8n-Daten noch Backup-Schlüssel. |

Die frühere IONOS/Acronis-Backup-Lösung ist für diesen Server **nicht aktiv**. Die hier beschriebene automatische Sicherung läuft über `restic` und Google Drive.

## Datenfluss und Zeitplan

1. Auf dem Server erstellt der Backup-Dienst mit `pg_dumpall` einen logischen Export der PostgreSQL-Datenbank.
2. `restic` sichert diesen Export sowie die n8n-Dateien, Authgate-Dateien, das HTTPS-Zertifikatsverzeichnis von Traefik und die für den Betrieb benötigten Konfigurationsdateien. Die laufenden PostgreSQL-Datendateien und rotierende n8n-Logs werden ausgelassen.
3. `rclone` überträgt das verschlüsselte restic-Repository nach Google Drive. Der temporäre Datenbankexport wird nach dem Backup vom Server entfernt.
4. `restic forget --prune` hält **7 tägliche, 4 wöchentliche und 6 monatliche** Sicherungspunkte vor. Das ist eine Aufbewahrungsregel, keine Garantie für eine bestimmte Zahl an Tagen mit erfolgreichen Backups.

Der systemd-Timer `tus-n8n-backup.timer` startet täglich um **03:00 UTC** (05:00 Uhr deutscher Sommerzeit bzw. 04:00 Uhr Winterzeit) den Dienst `tus-n8n-backup.service`. Das ausführende Skript liegt unter `/usr/local/sbin/tus-n8n-backup`. Fehler und Ausgaben sind im systemd-Journal des Dienstes einsehbar. Wenn der Backup-Dienst nach seinen Wiederholungsversuchen in den Fehlerzustand wechselt, startet `OnFailure=` den Dienst `tus-n8n-backup-alert.service`. Dieser sendet über IONOS SMTP eine Warnmail an `n8n@tus-mingolsheim.de` und versucht den Versand bei SMTP-Fehlern alle 10 Minuten erneut. Die Mail-Konfiguration und das Postfachpasswort liegen nur auf dem Server in einem root-geschützten Verzeichnis; sie gehören nicht in GitHub. Derzeit werden keine täglichen Erfolgsmails verschickt. Bei einem vollständigen Serverausfall kann dieser serverseitige Alarm nicht senden.

## Bisher geprüft

- Der Backup-Lauf wurde manuell und anschließend über den systemd-Dienst erfolgreich ausgeführt; dabei entstanden zwei restic-Snapshots.
- Dateien aus einem Snapshot wurden in ein temporäres Verzeichnis zurückgespielt und auf Vorhandensein geprüft.
- Der Timer ist aktiviert; der erste reguläre Lauf ist für den **3. Oktober 2026 um 03:00 UTC** vorgesehen. Sein Erfolg ist zum Stand dieses Dokuments noch nicht belegt.
- Der SMTP-Versand und das Warnskript wurden mit Testmails geprüft. `systemd-analyze verify` zeigte keine Fehler in den Backup- und Alarmdiensten, und `systemctl show` bestätigte die `OnFailure`-Verknüpfung. Ein tatsächlicher Backup-Fehler wurde für diesen Test nicht ausgelöst.
- Ein vollständiger Wiederanlauf auf einem neuen Server einschließlich PostgreSQL-Import und n8n-Login wurde noch nicht getestet.

## Wiederherstellung und Zugang

Für eine Wiederherstellung benötigt eine berechtigte Person Zugriff auf das Google-Konto mit dem Drive-Ordner, eine funktionierende `rclone`-Autorisierung und das **restic-Passwort** aus dem Passwortmanager. Falls der Server ausfällt, muss die Drive-Verbindung auf einem Ersatzsystem neu eingerichtet werden. Aus dem Snapshot müssen Datenbankexport **und** n8n-Konfigurationsdateien gemeinsam wiederhergestellt werden, damit gespeicherte n8n-Zugangsdaten weiter entschlüsselbar sind.

Die ältere manuelle Sicherung ist eine **separate GPG-Datei** mit einer anderen Passphrase. Sie liegt nach dem zuletzt bestätigten Stand verschlüsselt auf dem Server und wurde auf den Mac kopiert; sie gehört nicht zum automatischen restic-Verfahren. Für den laufenden Betrieb genügt das Google-Drive-Backup samt sicher verwahrtem restic-Passwort. Die Entscheidung, die alte lokale Datei zu löschen, wurde besprochen; die tatsächliche Löschung wurde nicht bestätigt.

Keine Passwörter, OAuth-Tokens, privaten Schlüssel, Datenbankexports oder produktiven Konfigurationsinhalte in dieses öffentliche Repository eintragen.
