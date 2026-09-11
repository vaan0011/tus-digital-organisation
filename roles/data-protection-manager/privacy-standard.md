# Privacy & Information Protection Standard

## Purpose

Dieser Standard definiert die verbindliche Arbeitsweise für Datenschutz- und Informationsschutzprüfungen innerhalb der TuS Digital Organisation.

Er soll sicherstellen, dass neue digitale Prozesse nicht unnötig personenbezogene Daten sammeln, verteilen oder dauerhaft speichern und dass relevante Risiken vor produktiver Nutzung sichtbar werden.

## Core Principle

> **So wenig personenbezogene Daten wie nötig, so klarer Zweck wie möglich, so wenige Zugriffe wie sinnvoll.**

Datenschutz ist kein Dokument, sondern eine Eigenschaft des tatsächlichen Prozesses.

## Main Content

### 1. Vor jeder neuen Verarbeitung

Vor Einführung eines neuen Formulars, Plugins, Datenfeldes, Workflows, Tools oder Dienstleisters wird mindestens geklärt:

- Welcher konkrete Zweck wird verfolgt?
- Welche personenbezogenen Daten sind dafür wirklich erforderlich?
- Welche Daten können weggelassen oder später erhoben werden?
- Wer ist betroffen?
- Sind Kinder/Jugendliche oder besondere Kategorien personenbezogener Daten betroffen?
- Wer benötigt Zugriff?
- Wohin fließen die Daten?
- Welche externen Anbieter erhalten Zugriff oder verarbeiten Daten?
- Wie lange werden die Daten benötigt?
- Wie werden sie gelöscht oder anonymisiert?
- Welche Information muss die betroffene Person erhalten?
- Welche rechtliche/vertragliche Prüfung ist noch offen?

Kein Feld wird mit „könnte später nützlich sein“ als alleiniger Begründung aufgenommen.

### 2. Source of Truth und Dateninseln

Personenbezogene Daten werden nicht ohne konkreten Grund in mehreren Systemen parallel gepflegt.

Bei jedem neuen Vorhaben wird geprüft:

- existiert bereits eine führende Datenquelle,
- kann auf bestehende Daten sicher referenziert werden,
- welcher Datensatz ist führend,
- wie werden Korrektur und Löschung systemübergreifend behandelt,
- ob eine Kopie tatsächlich notwendig ist.

GitHub ist **keine operative personenbezogene Datenbank**.

### 3. Datenklassen

Für die praktische Arbeit werden mindestens drei Schutzklassen unterschieden:

#### A – öffentlich / unkritisch

Beispiele:

- freigegebene öffentliche Vereinsinformationen,
- öffentliche Ansprechpartnerdaten in ihrer offiziellen Funktion,
- veröffentlichte Spielinformationen,
- freigegebene Partner-/Projektinformationen.

#### B – intern / personenbezogen

Beispiele:

- Mitgliederkontaktdaten,
- interne Ansprechpartnerdaten,
- CRM-Kommunikationsstände,
- Trainer-/Betreuerlisten,
- nicht veröffentlichte Teilnehmerdaten.

Zugriff nur nach Rollenbedarf.

#### C – besonders geschützt / hochsensibel

Beispiele:

- Kinderschutz- und Verdachtsfälle,
- Gesundheitsdaten,
- Führungszeugnisinformationen,
- Bank-, Lohn- und Sozialleistungsdaten,
- Zugangsdaten/Secrets,
- Datenschutzvorfälle mit konkreten Betroffenen,
- sensible Betroffenenanfragen.

Diese Daten dürfen nicht in normale GitHub-Dateien, öffentliche Issues, Standard-Chatprompts oder breit zugängliche Automationsqueues geschrieben werden.

### 4. Berechtigungsprinzip

Zugriffe folgen `Need to know` und `Least Privilege`:

- nur Rollen mit tatsächlichem Arbeitsbedarf erhalten Zugriff,
- Sammelkonten und gemeinsam genutzte Zugangsdaten werden vermieden,
- Rollenwechsel oder Ausscheiden müssen zu einer Rechteprüfung führen,
- administrative Rechte werden nicht vergeben, wenn normale Rechte ausreichen,
- besonders geschützte Bereiche erhalten separate Berechtigungen.

### 5. Externe Dienstleister / Auftragsverarbeitung

Bei neuen Diensten wird vor produktiver Nutzung geprüft:

- verarbeitet der Anbieter personenbezogene Daten für den TuS,
- welche Daten und Zwecke sind betroffen,
- welche Vertrags-/AV-Unterlagen sind erforderlich bzw. vorhanden,
- wo werden Daten verarbeitet,
- welche Unterauftragnehmer/Empfänger sind relevant,
- welche Lösch-/Exportmöglichkeiten bestehen,
- welche Sicherheits- und Zugriffseinstellungen können konfiguriert werden.

Verträge und sensible Vertragsdaten werden nicht unnötig in GitHub dupliziert.

### 6. Transparenz und Datenerhebung

Formulare und Prozesse sollen:

- verständlich erklären, wofür Daten benötigt werden,
- Pflichtfelder auf das notwendige Minimum beschränken,
- Einwilligung und vertraglich/gesetzlich notwendige Daten nicht vermischen,
- keine vorangekreuzten optionalen Einwilligungen verwenden,
- relevante Datenschutzinformationen erreichbar machen,
- keine überraschende Weiterverwendung vorsehen.

### 7. Kinder und Jugendliche

Bei Minderjährigen gilt erhöhte Schutzprüfung.

Insbesondere werden geprüft:

- Notwendigkeit der Datenerhebung,
- Zugriffsberechtigungen,
- Veröffentlichung von Namen/Bildern,
- Gruppen-/Messenger-Kommunikation,
- Eltern-/Sorgeberechtigtenprozesse soweit erforderlich,
- Schnittstelle zum Kinder- und Jugendschutzkonzept.

Konkrete Schutzfallmeldungen laufen nicht durch normale KI-/n8n-Klassifizierungsworkflows.

### 8. Fotos, Videos und Veröffentlichungen

Vor wiederkehrender Veröffentlichung personenbezogener Medien wird geklärt:

- Zweck und Kontext,
- betroffene Personengruppe,
- notwendige Rechts-/Einwilligungsprüfung,
- Umgang mit Widerruf/Widerspruch bzw. Löschwünschen,
- Ablage der Originale und Freigaben,
- Vermeidung unnötig sensibler Begleitinformationen.

### 9. E-Mail und digitale Poststelle

Bei der geplanten IONOS-/n8n-Poststelle gilt:

- rollenbasierte Adressen sind organisatorisch möglich,
- nur der notwendige Mailinhalt wird an nachgelagerte Systeme übergeben,
- Anhänge werden nicht automatisch in breit zugängliche Arbeitsbereiche kopiert,
- hochsensible Postfächer erhalten separate Routing-Regeln,
- Kinderschutz-, Datenschutzvorfall- oder andere Schutzfalladressen werden nicht wie normale Redaktions-/Förderpost automatisiert verarbeitet,
- Aufbewahrung und Löschung von Eingangsmails werden pro Prozess definiert.

### 10. WordPress, Formulare und APIs

Vor produktiver Freigabe neuer Funktionen werden – passend zum Risiko – geprüft:

- Eingabevalidierung,
- Ausgabe-Escaping,
- Authentifizierung und Berechtigungen,
- Nonces/CSRF-Schutz,
- Protokollierung und unnötige Logs,
- Datenbankfelder und Löschbarkeit,
- externe Requests/APIs,
- Uploads und Dateizugriffe,
- Tracking/Cookies/Einbindungen,
- Datenexport und Auskunftsfähigkeit.

### 11. Aufbewahrung und Löschung

Jede relevante Verarbeitung benötigt eine nachvollziehbare Löschlogik.

Mindestens wird geklärt:

- wann der operative Zweck endet,
- ob andere Aufbewahrungspflichten geprüft werden müssen,
- welches System führend löscht,
- ob Kopien/Backups/Exporte betroffen sind,
- wer Löschung auslöst oder regelmäßig prüft.

Keine pauschale „für immer“-Speicherung ohne belastbaren Grund.

### 12. Betroffenenrechte

Auskunfts-, Berichtigungs-, Lösch-, Einschränkungs-, Widerspruchs- und sonstige Anfragen werden nicht improvisiert beantwortet.

Der Ablauf muss mindestens sicherstellen:

- Identität bzw. Berechtigung angemessen prüfen,
- Anfrage und Frist nachvollziehbar dokumentieren,
- betroffene Systeme identifizieren,
- keine Daten anderer Personen unzulässig offenlegen,
- rechtlich strittige Fälle eskalieren.

### 13. Datenschutzverletzungen

Bei möglicher Datenschutzverletzung gilt:

1. Schaden begrenzen,
2. relevante Fakten sichern,
3. keine Details unnötig verbreiten,
4. zuständige menschliche Verantwortung unverzüglich einschalten,
5. Risiko und mögliche Meldepflicht fachlich/rechtlich prüfen,
6. Entscheidungen und Maßnahmen geschützt dokumentieren.

Eine KI-Rolle entscheidet nicht allein über eine Behördenmeldung.

### 14. Datenschutz-Folgenabschätzung / Hochrisiko

Wenn eine Verarbeitung voraussichtlich ein hohes Risiko für Rechte und Freiheiten natürlicher Personen erzeugen könnte, wird nicht einfach weiterimplementiert.

Die Rolle markiert den Vorgang als `DSFA-/Hochrisiko-Prüfung erforderlich` und eskaliert ihn zur qualifizierten menschlichen Prüfung.

### 15. Privacy Check als Projekt-Handoff

Ein Projekt kann den Datenschutzstatus kompakt führen als:

- `nicht relevant`,
- `Privacy Check offen`,
- `Privacy Check durchgeführt – Maßnahmen offen`,
- `Privacy Check durchgeführt – keine wesentlichen offenen Punkte`,
- `eskaliert / rechtliche Prüfung erforderlich`.

Ein solcher Status ersetzt keine konkrete Prüfung, macht aber Abhängigkeiten sichtbar.

## Relationship to other documents

- `role.md`
- `START-PROMPT.md`
- `../../knowledge/privacy/CURRENT-STATE.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../standards/approval-and-escalation.md`
- `../../projects/kinder-jugendschutz/README.md`
- `../../architecture/stability-and-simplicity.md`

## Future Development

Aus realen Prüfungen sollen schrittweise wiederverwendbare Checklisten für Mitgliederverwaltung, WordPress/Formulare, E-Mail/n8n, Fotos/Medien, Partner-CRM und Kinder-/Jugenddaten entstehen. Der Standard bleibt praxisnah und wird nicht zu einem juristischen Volltextarchiv ausgebaut.
