# Mitgliedsbescheinigung – Anfrage- und Erstellungsworkflow

## Purpose

Dieses Dokument beschreibt den fachlichen Use Case „Mitgliedsbescheinigung anfordern“ für den TuS Mingolsheim.

Ziel ist ein einfacher digitaler Weg für Mitglieder, eine Bescheinigung über ihre Vereinsmitgliedschaft anzufordern, ohne dass die Geschäftsstelle jede Anfrage vollständig manuell aufnehmen, Daten zusammensuchen und ein Dokument neu erstellen muss.

Die technische Oberfläche kann später über die Homepage, einen Mitgliederbereich, E-Mail oder einen Agenten-/n8n-Workflow bereitgestellt werden. Der fachliche Prozess bleibt unabhängig vom Einstiegskanal gleich.

## Core Principle

> **Die Homepage nimmt die Anfrage an. Die Mitglieder-Source-of-Truth bestätigt die Fakten. Der Workflow erzeugt das Dokument.**

Die Homepage wird nicht zur zweiten Mitgliederverwaltung. Ein Agent darf Mitgliedschaftsdaten nicht erfinden oder aus Freitext ableiten.

## Main Content

### 1. Typischer Nutzerbedarf

Ein Mitglied benötigt eine offizielle TuS-Bescheinigung, beispielsweise für:

- Arbeitgeber,
- Schule oder Ausbildung,
- Behörde,
- Förder- oder Zuschussantrag,
- Versicherung,
- sonstigen persönlichen Nachweis.

Das Mitglied soll die Bescheinigung mit wenigen Schritten anfordern können.

### 2. Minimaler Anfrageinhalt

Die Anfrage soll nur die Daten abfragen, die für Identifikation und Dokumenterstellung notwendig sind.

Mindestens denkbar:

- Vorname und Nachname,
- sichere Identifikation bzw. Abgleichmerkmal,
- gewünschter Verwendungszweck nur dann, wenn er für die Bescheinigung relevant ist,
- gewünschter Zustellweg,
- optional besondere Angabe, die ausdrücklich auf der Bescheinigung erscheinen soll.

Geburtsdatum, Anschrift oder andere zusätzliche personenbezogene Daten werden nicht standardmäßig nur zur Bequemlichkeit abgefragt, wenn eine sichere Identifikation auch anders möglich ist.

Bei minderjährigen Mitgliedern muss der spätere Prozess berücksichtigen, ob die Anfrage durch eine sorgeberechtigte bzw. berechtigte Person gestellt wird.

### 3. Fachlicher Standardablauf

1. Mitglied öffnet den Self-Service-Einstieg, z. B. auf der Homepage.
2. Anfrage wird sicher entgegengenommen.
3. Person wird mit der bestehenden Mitgliederverwaltung bzw. der gemeinsamen Mitgliedsidentität abgeglichen.
4. Aktuelle Mitgliedschaft und die für die Bescheinigung benötigten Fakten werden aus der verbindlichen Mitglieder-Source-of-Truth gelesen.
5. Bei eindeutigem Treffer wird eine freigegebene Dokumentvorlage befüllt.
6. Falls Daten widersprüchlich, unvollständig oder nicht eindeutig sind, wird nicht automatisch erstellt; die Anfrage geht an die Mitgliederverwaltung zur Prüfung.
7. Abhängig vom später festgelegten Freigabemodell wird die Bescheinigung automatisch oder nach menschlicher Freigabe finalisiert.
8. Das Dokument wird über einen geschützten und nachvollziehbaren Zustellweg bereitgestellt.
9. Der Vorgang wird mit minimal notwendigen Metadaten protokolliert, ohne unnötige Dokumentkopien oder personenbezogene Schattenakten zu erzeugen.

### 4. Möglicher Dokumentinhalt

Eine Standard-Mitgliedsbescheinigung kann insbesondere enthalten:

- offizieller Vereinsname,
- Name des Mitglieds,
- Bestätigung einer aktuellen Mitgliedschaft,
- Eintrittsdatum bzw. „Mitglied seit“, sofern fachlich benötigt und in der Source of Truth belastbar vorhanden,
- gegebenenfalls Abteilung oder Mannschaft, sofern ausdrücklich benötigt,
- Ausstellungsdatum,
- offizieller TuS-Absender,
- gegebenenfalls Unterschrift/Freigabevermerk nach beschlossenem Dokumentstandard.

Nicht automatisch aufgenommen werden:

- Beitragsstatus oder konkrete Beitragszahlungen,
- Bankdaten,
- interne Engagement- oder Helferstunden,
- sensible personenbezogene Merkmale,
- weitere Daten, die für den angefragten Nachweis nicht erforderlich sind.

Wenn ausdrücklich eine Beitragszahlungs- oder andere weitergehende Bescheinigung benötigt wird, ist dies fachlich ein gesonderter Dokumenttyp mit eigenem Freigabe- und Datenbedarf.

### 5. Homepage als Einstieg

Die Homepage ist ein geeigneter Einstiegspunkt für den Use Case, weil Mitglieder dort einen klaren Self-Service finden können.

Die Homepage soll dabei nur:

- den Service erklären,
- notwendige Eingaben entgegennehmen,
- die sichere Identifikation einleiten,
- Status bzw. Rückmeldung anzeigen.

Sie soll nicht selbst die fachliche Wahrheit über Mitgliedschaft speichern.

### 6. Agenten-/n8n-Workflow

Ein späterer Workflow kann die manuelle Arbeit deutlich reduzieren.

Mögliche Aufgaben des Workflows:

- Anfrage entgegennehmen und klassifizieren,
- Identität bzw. Mitgliedsdatensatz über die vorgesehene Schnittstelle abgleichen,
- Standardfall von Klärungsfall unterscheiden,
- freigegebene Vorlage mit verifizierten Daten befüllen,
- menschliche Freigabe anfordern, falls notwendig,
- Dokument sicher zustellen,
- Status zurückmelden,
- Vorgang minimal protokollieren.

Der Agent darf nicht:

- Mitgliedschaft aus einer E-Mail-Behauptung als bestätigt behandeln,
- fehlende Eintrittsdaten oder Namen ergänzen bzw. raten,
- Beitrags- oder andere sensible Informationen ohne fachlichen Bedarf einfügen,
- eine nicht vorgesehene rechtsverbindliche oder unterschriftsähnliche Freigabe imitieren.

### 7. Automatisierungsstufen

Der Prozess kann schrittweise eingeführt werden.

#### Stufe A – Anfrage digital, Bearbeitung manuell

- Homepage-/Formularanfrage,
- strukturierte Übergabe an Mitgliederverwaltung,
- Bescheinigung wird manuell erstellt und versendet.

#### Stufe B – Datenprüfung und Dokumententwurf automatisiert

- Mitglied wird automatisch abgeglichen,
- System erzeugt einen Entwurf aus einer kontrollierten Vorlage,
- berechtigte Person prüft und gibt frei.

#### Stufe C – Standardfälle weitgehend automatisiert

Nur wenn Datenquelle, Identifikation, Dokumentvorlage, Berechtigungen und Freigabelogik nachweislich stabil sind:

- eindeutige Standardfälle können ohne manuellen Zwischenschritt erstellt werden,
- Ausnahmefälle bleiben menschlich geprüft.

Eine Vollautomatisierung wird nicht allein deshalb gewählt, weil sie technisch möglich ist.

### 8. Statusmodell

Für den Vorgang reichen voraussichtlich wenige Zustände:

- `Angefragt`
- `Identifikation offen`
- `In Prüfung`
- `Zur Freigabe`
- `Erstellt`
- `Zugestellt`
- `Klärung erforderlich`
- `Abgebrochen`

Das Statusmodell soll nicht unnötig komplex werden.

### 9. Datenschutz und Sicherheit

Die Mitgliedsbescheinigung verarbeitet personenbezogene Daten. Deshalb gelten insbesondere:

- keine öffentliche Ausgabe über erratbare Links,
- keine ungesicherte Zuordnung allein anhand von Name,
- nur erforderliche Daten verarbeiten,
- Berechtigungen für Mitarbeitende klar begrenzen,
- Dokumente und Anfragen nicht unnötig dauerhaft doppelt speichern,
- protokollieren, wer eine Bescheinigung erzeugt bzw. freigegeben hat, soweit dies für Nachvollziehbarkeit erforderlich ist,
- bei minderjährigen Mitgliedern Berechtigung des Antragstellers berücksichtigen.

### 10. Source of Truth

Die bestehende Mitgliederverwaltung bleibt bis zu einer anderen ausdrücklich beschlossenen Architekturentscheidung Quelle für:

- bestehende Mitgliedschaft,
- offizielle Stammdaten,
- Eintritt/Austritt,
- weitere für die Bescheinigung freigegebene Mitgliedsfakten.

Der neue Workflow referenziert diese Daten und baut keine parallele Mitgliederliste auf.

### 11. Erfolgskriterien

Der Use Case ist erfolgreich, wenn:

- ein Mitglied ohne Rückfrage herausfindet, wo es eine Bescheinigung anfordern kann,
- Standardanfragen strukturiert statt per freier E-Mail eingehen,
- Mitgliedsdaten nicht manuell aus mehreren Listen zusammengesucht werden müssen,
- nur verifizierte Daten in der Bescheinigung stehen,
- Ausnahmefälle zuverlässig bei einem Menschen landen,
- die Geschäftsstelle deutlich weniger manuelle Arbeit pro Bescheinigung hat,
- der Prozess mobil einfach nutzbar bleibt.

### 12. Noch offene Entscheidungen

Vor Umsetzung müssen insbesondere geklärt werden:

- konkrete heutige Mitgliederverwaltung und technische Schnittstelle,
- sichere Identifikationsmethode,
- offizieller Inhalt der TuS-Standard-Mitgliedsbescheinigung,
- verwendete Dokumentvorlage,
- ob eine Unterschrift erforderlich ist und wer freigabeberechtigt ist,
- ob Standardfälle automatisch finalisiert werden dürfen,
- geschützter Zustellweg,
- Aufbewahrungs- und Löschregel,
- Behandlung von Anfragen für Minderjährige,
- Abgrenzung zu Beitragszahlungsbescheinigungen oder anderen Nachweistypen.

## Relationship to other documents

- `README.md`
- `FUNCTIONAL-SCOPE.md`
- `PROJECT-STATE.md`
- `../../standards/approval-and-escalation.md`
- `../../design/ui-standard.md`
- `../team-manager/`

Die technische Oberfläche auf der Homepage ist nur ein möglicher Kanal. Die fachliche Verantwortung für Mitgliedsdaten und Bescheinigungslogik bleibt im Mitgliederkontext.

## Future Development

Nach Analyse der bestehenden Mitgliederverwaltung wird zunächst Stufe A oder B als kleinster belastbarer Pilot gewählt.

Wenn der Ablauf im realen Betrieb zuverlässig funktioniert, können weitere standardisierte Mitglieder-Services nach demselben Muster ergänzt werden, ohne für jeden Service eine eigene Datenwelt aufzubauen.
