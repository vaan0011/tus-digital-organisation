# Google-Drive-Ablagestandard

Stand: 12.10.2026. Gilt für alle Rollen, Chats und automatisierten Runs mit TuS-Drive-Ausgaben.

## Verbindliche Regel

Eine Datei ist erst fertig gespeichert, wenn ihr Inhalt und ihr fachlich richtiger Elternordner erfolgreich zurückgelesen wurden. Das Hauptverzeichnis und der Ordner `ChatGPT` sind keine Ergebnisablage.

## Ablauf bei jedem Schreibvorgang

1. Dokumenttyp und Fachbereich bestimmen; Zielordner aus `google-drive-folders.json` auswählen. Für ein konkretes Projekt den vorhandenen Projektordner verwenden.
2. Zielordner per ID prüfen. Bei fehlendem Zugriff/ungeklärter Zuordnung einen konkreten Blocker dokumentieren; keinen Ersatz im Hauptverzeichnis anlegen.
3. Bestehende Datei anhand ID oder fachlichem Schlüssel (Projekt, Quelle, Saison/Spiel, Dokumenttyp) suchen. Vorhandene Arbeitsprodukte aktualisieren; keine neue Kopie pro Lauf.
4. Neue Datei direkt im Zielordner erstellen/importieren. Falls ein Werkzeug technisch zunächst ohne Zielordner erzeugt, die zurückgegebene Datei sofort mit verifiziertem `addParents` und `removeParents` zuordnen, bevor Erfolg gemeldet wird. Unbeteiligte Eltern erhalten.
5. Inhalt schreiben und zurücklesen: native Docs einschließlich Tabs dürfen nicht leer sein; Tabellen müssen die erwarteten Register/Daten enthalten; Uploads müssen zum erwarteten Typ/Inhalt passen. Dateititel oder Listengröße allein sind kein Inhaltsnachweis.
6. Metadaten zurücklesen: erwartete Datei-ID, Name, Typ und Ziel-Eltern-ID prüfen; bei Verschiebungen auch entfernten Ausgangseltern prüfen. Bestehende Zugriffsrechte erhalten.
7. Erst dann Arbeitsprodukt-Link und Checkpoint in die fachliche Source of Truth schreiben. Bei Fehlern nicht `fertig`/`gespeichert` melden; vorhandene Datei reparieren oder Blocker mit ID und nächster Aktion dokumentieren.

## Zuordnung und Versionen

- Konkrete Projektarbeit gehört in den jeweiligen Projektordner; rollenübergreifende Unterlagen bleiben im Fachbereich.
- Archivregister und operative Checkpoints bleiben im bestehenden Quellenindex. Transkriptionen gehören in den registrierten Transkriptionsordner, Gegner-Dossiers in ihren Fachordner. Zusätzliche Backfill-/Prüfdokumente gehören in das Arbeitsarchiv und entstehen nur, wenn sie echte neue Arbeit dokumentieren.
- Partnerstrategie und Akquise-Arbeitsbuch sind unterschiedliche Dokumenttypen. Operative CRM-Daten bleiben im bestehenden CRM mit derselben Datei-ID; das aktive CRM gehört nicht in `90_ARCHIV`.
- Förderunterlagen gehören nach `Projekte/Förderprogramme`; rechtsverbindliche Gemeinnützigkeitsnachweise verbleiben unter `Vorstand/Gemeinnützigkeit` und werden referenziert.
- Scouting bleibt im bestehenden geschützten Pilot-Sheet unter `Projekte/Team Manager`.
- Spielberichte bleiben im bestehenden Spielberichtsordner, Audio und Transkripte unter `Trainerkommentare`; Voll- und Ortsblattfassung bleiben getrennte Ergebnisse.
- Merch nutzt die vorhandenen Produktordner und Freigabestufen. Referenzen sind keine freigegebenen Produktionsdateien.
- Namen möglichst `YYYY-MM-DD – Thema – Dokumenttyp`; Saison/Quelle/Status bei Bedarf ergänzen. Historische Originalnamen und Quellen-IDs nachvollziehbar erhalten.
- PDF-Ausgabe, bearbeitbares Original, Audio und Transkript sind keine automatisch zu löschenden Dubletten. Keine Löschung oder Zusammenführung allein nach Namen/Größe.
- Original-IDs und Links erhalten; keine unnötigen Kopien/Exporte. Technische Sicherungsrepositories nicht als Dokumentablage behandeln.

## Umsetzung am 12.10.2026

25 vorhandene Dateien wurden mit unveränderten IDs und Inhalten verschoben und einzeln per Metadaten-Rücklese geprüft. Das Hauptverzeichnis enthält anschließend keine losen Dateien. Als einzige Ergänzung zur vorhandenen Ordnerstruktur entstand `Projekte/Förderprogramme`.

Neun leere Archivdokumente wurden zur fachlich richtigen Arbeitsablage verschoben, aber dadurch nicht inhaltlich repariert. Sie dürfen nicht als Nachweis erledigter Archivarbeit gelten. Versionshistorie/Quellenprüfung und Wiederherstellung sind ein gesonderter fachlicher Auftrag. Die 23 historischen PDF-Paare bleiben unverändert, bis Byteidentität, Referenzen und Berechtigungen geprüft sind.

## Verbindliches Zielordnerverzeichnis

Die live geprüften Ordner-IDs stehen in [google-drive-folders.json](google-drive-folders.json). Namen dienen der Orientierung; die ID ist der technische Schlüssel. Vor jedem Schreiben Erreichbarkeit und tatsächlichen Zielordner erneut prüfen.
