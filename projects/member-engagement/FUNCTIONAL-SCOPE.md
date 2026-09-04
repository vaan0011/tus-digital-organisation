# TuS Mitglieder & Engagement – Functional Scope

## Purpose

Dieses Dokument beschreibt das fachliche Zielbild des TuS Mitglieder- und Engagement-Moduls.

Das Modul soll dem Verein verlässlich zeigen, welche Mitglieder in welchen Bereichen aktiv sind, welche Helfereinsätze geleistet wurden, wie sich Helferstunden über ein Jahr entwickeln und wer ein festgelegtes Helfersoll erfüllt hat.

Dabei wird nicht automatisch eine zweite vollständige Mitgliederverwaltung aufgebaut. Bestehende Mitgliedsstammdaten werden möglichst aus der aktuell verwendeten Mitgliederverwaltung übernommen oder mit ihr abgeglichen.

## Core Principle

**Die Mitgliederverwaltung beantwortet: Wer ist Mitglied? Das Engagement-Modul beantwortet: Wer macht was im Verein?**

Diese Trennung gilt, solange die bestehende Mitgliederverwaltung ihre Aufgaben zuverlässig erfüllt.

Der Event Planner bleibt zuständig für die Planung konkreter Helferschichten. Das Mitglieder- und Engagement-Modul führt die personengebundene Historie und Jahresauswertung zusammen.

## Main Content

### 1. Gemeinsame Mitgliedsidentität

Jede relevante Person erhält eine stabile interne Identität, über die Informationen aus verschiedenen TuS-Systemen zusammengeführt werden können.

Dazu gehören insbesondere:

- Mitgliedsbezug zur bestehenden Mitgliederverwaltung,
- Name und für den jeweiligen Zweck notwendige Kontaktdaten,
- Mitgliedsstatus,
- Abteilungen,
- Mannschaften oder Gruppen,
- Funktionen und Rollen,
- Helfereinsätze,
- geleistete Stunden,
- Soll-Erfüllung und daraus abgeleitete Berechtigungen.

Personen dürfen nicht in Event Planner, Team Manager und Mitglieder-Modul unabhängig voneinander als unterschiedliche Datensätze entstehen.

### 2. Abgleich mit der bestehenden Mitgliederverwaltung

Die bestehende Mitgliederverwaltung bleibt zunächst die fachliche Quelle für:

- Mitgliedschaft,
- offizielle Stammdaten,
- Beitragsstatus,
- Eintritt/Austritt,
- beitragsrelevante Grundinformationen.

Das neue Modul soll diese Daten nicht ohne Grund duplizieren.

Mindestens erforderlich ist ein verlässlicher Abgleich, zunächst gegebenenfalls über Import/Export. Eine API- oder direkte Integration wird nur umgesetzt, wenn das bestehende System dies stabil und sinnvoll unterstützt.

Abweichungen zwischen beiden Systemen müssen sichtbar werden und dürfen nicht still überschrieben werden.

### 3. Vereinszugehörigkeit und Engagement

Das Modul soll abbilden können, wo und in welcher Form eine Person im TuS aktiv ist.

Beispiele:

- Spielerin oder Spieler,
- Trainer oder Betreuer,
- Vorstands-/Organisationsfunktion,
- Mitglied einer Abteilung,
- Helfer bei Veranstaltungen,
- regelmäßige Aufgabe,
- projektbezogene Unterstützung.

Ziel ist keine lückenlose Personalakte, sondern eine praktische Sicht auf Vereinsengagement.

### 4. Helferschichten: klare Verantwortung zwischen Modulen

Der Event Planner bleibt die fachliche Quelle für konkrete Helferschichten.

Dort werden insbesondere gepflegt:

- Event,
- Aufgabe,
- Datum und Uhrzeit,
- benötigte Anzahl Helfer,
- Zuordnung zu Mannschaft, Abteilung oder Gruppe,
- Anmeldung bzw. Besetzung,
- tatsächlich geleistete Zeit.

Das Mitglieder- und Engagement-Modul übernimmt daraus die personengebundene Auswertung.

Dadurch entsteht keine zweite Schichtplanung.

### 5. Jahresplan für Helferbedarf

Über die einzelnen Events hinaus soll ein Jahresplan sichtbar machen, welche Mannschaften, Abteilungen oder Gruppen im Laufe eines Jahres für welche Helferbereiche vorgesehen sind.

Der Jahresplan kann beispielsweise zeigen:

- Veranstaltung,
- Zeitraum,
- Aufgabe oder Helferbereich,
- zuständige Mannschaft/Abteilung/Gruppe,
- erwarteter Helferbedarf,
- Planungsstatus,
- offene Besetzung.

Die konkrete Schicht bleibt im Event Planner. Die Jahresübersicht bündelt diese Planung über alle Veranstaltungen.

Ziel ist frühzeitige Transparenz statt kurzfristiger Einzelaufrufe.

### 6. Verteilung von Helferschichten an Gruppen

Helferschichten eines Events sollen gezielt an eine Mannschaft, Abteilung oder definierte Gruppe verteilt werden können.

Die Gruppe erhält einen einfachen Zugang zu den für sie relevanten offenen Schichten.

Die technische Form wird erst später festgelegt. Denkbar sind beispielsweise:

- persönlicher Mitgliederbereich,
- sicherer Gruppenlink,
- Magic Link,
- direkte Einladung per E-Mail.

Der Zugang soll einfach sein und keine unnötige zusätzliche Registrierung erzwingen.

### 7. Anmeldung zu Helferschichten

Ein Mitglied soll sich mit möglichst wenigen Schritten für eine angebotene Schicht anmelden können.

Dabei muss zuverlässig erkannt werden, welcher Person die Anmeldung zugeordnet wird.

Das System soll mindestens unterscheiden können zwischen:

- geplant,
- angemeldet,
- bestätigt,
- tatsächlich geleistet,
- storniert/nicht geleistet.

Nur tatsächlich bestätigte bzw. geleistete Zeiten fließen in die Stundenbilanz ein.

### 8. Persönliches Helferstundenkonto

Für jede Person soll nachvollziehbar sein:

- bei welchen Veranstaltungen geholfen wurde,
- welche Aufgaben übernommen wurden,
- welche Zeit geplant war,
- welche Zeit tatsächlich geleistet wurde,
- wie viele Stunden im aktuellen Bemessungszeitraum insgesamt anerkannt sind.

Korrekturen müssen nachvollziehbar sein. Stunden dürfen nicht ohne Berechtigung still geändert werden.

### 9. Helfersoll

Der Verein soll Regeln für ein Helfersoll definieren können.

Eine Regel kann beispielsweise abhängen von:

- Bemessungszeitraum,
- Mitgliedsgruppe,
- Alter,
- Mannschaft/Abteilung,
- Familienkonstellation,
- besonderen Ausnahmen.

Diese Details werden nicht vorweggenommen. Wichtig ist zunächst, dass Soll und tatsächlich anerkannte Stunden getrennt und nachvollziehbar gespeichert werden.

### 10. Rabatt-/Nachlass-Berechtigung

Erreicht eine Person das definierte Helfersoll, kann sie als berechtigt für einen festgelegten Nachlass auf den Mitgliedsbeitrag markiert werden.

Das Modul soll dafür eine belastbare Auswertung liefern:

- Sollstunden,
- anerkannte Ist-Stunden,
- Status `Soll erfüllt` / `noch offen`,
- relevante Periode,
- gegebenenfalls genehmigte Ausnahme,
- daraus abgeleitete Rabatt-Berechtigung.

Die tatsächliche Beitragsänderung wird zunächst nicht automatisch ausgeführt.

Stattdessen wird eine geprüfte Liste bzw. ein Export für den Abgleich mit der bestehenden Mitgliederverwaltung bereitgestellt.

Eine direkte Beitragsänderung oder Schnittstelle wird erst nach ausdrücklich beschlossener Finanz-/Mitgliederlogik umgesetzt.

### 11. Mitgliederansicht

Ein Mitglied soll perspektivisch selbst nachvollziehen können:

- welche Helferschichten offen sind,
- wofür es angemeldet ist,
- welche Einsätze bereits geleistet wurden,
- wie viele Stunden anerkannt wurden,
- wie weit das persönliche Soll erfüllt ist.

Die Oberfläche soll einfach und mobil nutzbar sein.

Ob dafür ein klassisches Benutzerkonto oder ein einfacherer sicherer Zugang verwendet wird, ist noch offen.

### 12. Sicht für Mannschaften und Abteilungen

Berechtigte Verantwortliche sollen für ihre Mannschaft oder Abteilung sehen können:

- welche Helferaufgaben im Jahresplan vorgesehen sind,
- welche Schichten bereits besetzt sind,
- wo noch Personen fehlen,
- wie sich die geleisteten Stunden innerhalb der Gruppe verteilen.

Personenbezogene Daten werden nur gezeigt, soweit sie für die jeweilige Aufgabe erforderlich sind.

### 13. Historie

Die Engagement-Historie soll über Jahre nachvollziehbar bleiben.

Damit kann später beantwortet werden:

- wer regelmäßig Verantwortung übernimmt,
- welche Mannschaften/Abteilungen welche Helferbereiche getragen haben,
- wie hoch der tatsächliche Helferaufwand bestimmter Veranstaltungen war,
- welche Soll-Regeln in welchem Zeitraum galten,
- wer aufgrund welcher Stunden eine Berechtigung erhalten hat.

Historische Daten werden nicht durch neue Jahresregeln rückwirkend verfälscht.

### 14. Datenschutz und Berechtigungen

Das Modul verarbeitet personenbezogene Vereinsdaten und benötigt deshalb klare Zugriffsregeln.

Grundprinzipien:

- nur notwendige Daten speichern,
- sensible Daten nicht öffentlich anzeigen,
- Mitglieder sehen grundsätzlich ihre eigenen Engagement-Daten,
- Gruppenverantwortliche sehen nur die für ihre Aufgabe erforderlichen Informationen,
- administrative Änderungen werden nachvollziehbar durchgeführt,
- Exporte mit personenbezogenen Daten werden nur berechtigten Personen bereitgestellt.

Vor Implementierung werden Rollen, Aufbewahrung und Löschregeln konkret definiert.

### 15. Keine vollständige Mitgliederverwaltung ohne bewusste Entscheidung

Folgende Funktionen gehören **nicht automatisch** in die erste Ausbaustufe:

- Eintrittsanträge,
- SEPA-Mandate,
- Beitragseinzug,
- Beitragsarten und vollständige Beitragsabrechnung,
- Kündigungen/Austritte,
- Familienmitgliedschaften als vollständige Beitragslogik,
- steuer-/buchhaltungsrelevante Prozesse.

Soll das bestehende Mitgliederverwaltungssystem später ersetzt werden, wird dafür eine eigene Architekturentscheidung getroffen.

### 16. Entscheidungskriterien für einen möglichen späteren Ausbau

Eine vollständige Mitgliederverwaltung wird nur erwogen, wenn mindestens mehrere der folgenden Punkte dauerhaft zutreffen:

- die bestehende Lösung verursacht relevante Doppelpflege,
- wichtige Daten können nicht zuverlässig integriert werden,
- notwendige Prozesse sind im Altsystem nicht sinnvoll abbildbar,
- Exporte/Importe sind dauerhaft fehleranfällig,
- Kosten oder Wartungsaufwand stehen nicht mehr im Verhältnis zum Nutzen,
- eine neue Lösung kann ohne unnötiges Risiko mindestens denselben Funktionsumfang zuverlässig übernehmen.

Bis dahin gilt Integration vor Ersatz.

### 17. Erfolgskriterien

Das Modul ist fachlich erfolgreich, wenn der TuS zuverlässig beantworten kann:

- Welche Mitglieder gehören zu welcher Mannschaft/Abteilung/Gruppe?
- Welche Helferschichten sind im Jahresverlauf vorgesehen?
- Wer hat sich für welche Schicht angemeldet?
- Wer hat tatsächlich wie viele Stunden geleistet?
- Wer hat sein Helfersoll erfüllt?
- Welche Personen sind für einen Beitragsnachlass berechtigt?
- Stimmen diese Personen mit der bestehenden Mitgliederverwaltung überein?

Und wenn Mitglieder ihre eigenen Einsätze und ihren Stundenstand ohne zusätzliche Zettel, private Excel-Listen oder Rückfragen nachvollziehen können.

## Relationship to other documents

- `README.md` beschreibt Zweck und Einstieg.
- `PROJECT-STATE.md` hält aktuelle Entscheidungen und offene Architekturfragen fest.
- `../event-planner/FUNCTIONAL-SCOPE.md` bleibt fachliche Quelle für Events und konkrete Helferschichten.
- `../team-manager/` benötigt gemeinsame Personen- und Mannschaftsbezüge.
- `../../standards/approval-and-escalation.md` gilt insbesondere für personenbezogene und beitragsrelevante Änderungen.
- `../../design/ui-standard.md` definiert die gemeinsame TuS-UI.

Dieses Dokument ist die fachliche Quelle für den langfristig vorgesehenen Funktionsumfang des Mitglieder- und Engagement-Moduls.

## Future Development

Eine sinnvolle grobe Reihenfolge ist:

1. bestehende Mitgliederverwaltung analysieren und Abgleichweg definieren,
2. gemeinsame Personen-/Mitgliedsidentität festlegen,
3. Mannschafts-/Abteilungs-/Gruppenzuordnungen anbinden,
4. Helferstunden aus dem Event Planner personengenau übernehmen,
5. Jahresübersicht und persönliches Stundenkonto aufbauen,
6. Soll-Regeln und Rabatt-Berechtigung ergänzen,
7. einfache Mitglieder-/Gruppenansicht für offene Schichten ergänzen,
8. erst danach entscheiden, ob eine vollständige Mitgliederverwaltung überhaupt nötig ist.

Jeder Schritt bleibt klein, testbar und nachvollziehbar.
