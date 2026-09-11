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

### 4. Formelle Datenschutzbeauftragten-Frage

Noch offen ist, ob der TuS aufgrund der tatsächlichen organisatorischen und technischen Situation zur formellen Benennung eines Datenschutzbeauftragten verpflichtet ist oder eine freiwillige Benennung sinnvoll wäre.

Dafür ist eine belastbare Bestandsaufnahme erforderlich, insbesondere:

- wie viele Personen beim TuS regelmäßig und dauerhaft automatisiert personenbezogene Daten verarbeiten,
- ob Verarbeitungsvorgänge bestehen, die eine Datenschutz-Folgenabschätzung erfordern könnten,
- ob weitere Kriterien aus Art. 37 DSGVO einschlägig sind,
- welche Interessenkonflikte bei möglichen internen Personen bestehen würden.

Bis zur Entscheidung wird die interne Rolle nicht als formell bestellter DSB bezeichnet.

### 5. Erste operative Prioritäten

1. **Datenschutz-Inventur erstellen**
   - Systeme,
   - Zwecke,
   - Datenkategorien,
   - betroffene Gruppen,
   - Owner,
   - Empfänger/Dienstleister,
   - Speicherorte.

2. **Berechtigungsinventur starten**
   - besonders Google Drive, WordPress, Partnerdaten und künftige E-Mail-Queues.

3. **Verzeichnis der Verarbeitungstätigkeiten vorbereiten**
   - nicht als Papierübung, sondern aus den realen Datenflüssen.

4. **Dienstleister-/AVV-Check**
   - nur für tatsächlich personenbezogene Verarbeitungen und aktuell genutzte Systeme.

5. **Lösch-/Aufbewahrungslogik priorisieren**
   - Mitgliederdaten,
   - Kontakte/CRM,
   - E-Mail-Eingänge,
   - Event-/Teilnehmerdaten,
   - Formulare,
   - Fotos/Medien,
   - sensible Sonderbereiche.

6. **E-Mail-/n8n-Architektur vor produktiver Automatisierung prüfen**
   - `redaktion@` kann Pilot werden,
   - Schutzfall- und sensible Postfächer separat behandeln.

7. **Privacy Check in Entwicklungsprojekte integrieren**
   - insbesondere Mitglieder & Engagement,
   - Team Manager,
   - Partnerportal/Partner Hub,
   - Homepage-Formulare,
   - Event Planner,
   - Tauschbörse.

8. **Datenpannen- und Betroffenenprozess definieren**
   - Zuständigkeit,
   - sicherer Dokumentationsweg,
   - Eskalationslogik,
   - Fristenmanagement.

### 6. Aktuelle wichtige Abhängigkeiten

#### Kinder- und Jugendschutz

Das Schutzkonzept benötigt getrennte, menschlich verantwortete Meldewege. Datenschutz unterstützt Zugriffs-, Aufbewahrungs- und Dokumentationsregeln, entscheidet aber nicht selbst über Schutzfallinterventionen.

#### Digitale Poststelle

Vor produktiver n8n-Anbindung müssen Datenminimierung, Routing, Zugriff, Aufbewahrung, Anhänge und hochsensible Sonderwege definiert sein.

#### Mitglieder & Engagement / Team Manager

Diese Projekte dürfen keine parallele Personenidentität aufbauen. Vor Umsetzung muss klar sein, welche Personen-/Mitgliedsdaten führend sind und welche Systeme nur referenzieren.

#### Partnerportal / Partner Hub

Das bestehende geschützte Partner-CRM ist operative Zwischen-Source-of-Truth. Öffentliche Partneranfragen dürfen keine unkontrollierte zweite Datenhaltung erzeugen.

#### WordPress / Homepage

Neue öffentliche Formulare und Nutzerfunktionen benötigen vor produktiver Freigabe einen risikoadäquaten Privacy Check.

### 7. Bewusst nicht in GitHub

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

- `../../roles/data-protection-manager/role.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../../roles/data-protection-manager/START-PROMPT.md`
- `../../standards/child-youth-protection-standard.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../projects/PROJECT-PORTFOLIO.md`
- `../../architecture/memory-router.md`

## Future Development

Nach der ersten Inventur werden aus diesem Current State nur belastbare nächste Schritte weitergeführt. Detailregister wie Verarbeitungstätigkeiten, Dienstleister-/AVV-Status oder Berechtigungsprüfungen erhalten nur dann eigene operative Quellen, wenn sie real benötigt werden und dadurch kein paralleles Bürokratiesystem entsteht.
