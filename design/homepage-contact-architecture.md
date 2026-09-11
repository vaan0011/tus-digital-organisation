# Homepage-Kontaktarchitektur

## Purpose

Dieses Dokument definiert die verbindliche Kontaktarchitektur für den Neuaufbau der öffentlichen TuS-Mingolsheim-Homepage.

Ziel ist, öffentliche Kontaktwege zu vereinfachen, personenbezogene Direktkontakte zu reduzieren und Anfragen dauerhaft an organisatorisch verantwortete TuS-Rollen statt an einzelne Personen zu binden.

Die konkrete finale IONOS-E-Mail-Struktur wird separat festgelegt. Dieses Dokument definiert bereits die Anforderungen, die der WordPress Developer beim Homepage-Neuaufbau berücksichtigen muss.

## Core Principle

> **Öffentliche Kontaktwege gehören zur Rolle, nicht zur Person.**

Ein Besucher soll schnell den richtigen Kontaktweg finden. Der TuS soll gleichzeitig vermeiden, dass private oder personengebundene Kontaktdaten zur dauerhaften Vereinsinfrastruktur werden.

## Main Content

### 1. Aktueller Befund

Die bestehende Homepage verwendet bereits mehrere sinnvolle rollenbasierte TuS-Adressen, unter anderem für Geschäftsstelle, Mitgliederverwaltung, Jugendleitung, Senioren und einzelne Abteilungen.

Daneben bestehen auf einzelnen Seiten noch:

- direkte persönliche Mobilnummern,
- personengebundene E-Mail-Adressen,
- unterschiedliche Kontaktformulare,
- direkte Ansprechpartnerlogik je Mannschaft bzw. Bereich.

Diese Kontaktwege werden beim Neuaufbau nicht ungeprüft übernommen.

### 2. Zielarchitektur

Öffentliche Kontaktmöglichkeiten werden nach Nutzerziel gebündelt.

Beispiele für mögliche Rollenpostfächer sind:

- Geschäftsstelle,
- Mitgliederverwaltung,
- Jugend,
- Sport / Aktive,
- Redaktion,
- Partnerschaften,
- Veranstaltungen,
- Datenschutz,
- einzelne dauerhaft eigenständige Abteilungen.

Die konkrete Adresse und Zahl der Postfächer wird erst mit der neuen IONOS-E-Mail-Struktur verbindlich festgelegt.

### 3. Verbindliche Regeln

Für den Homepage-Neuaufbau gilt:

1. Öffentliche Standardkontakte verwenden ausschließlich freigegebene TuS-Adressen unter `@tus-mingolsheim.de`.
2. Rollenbasierte Adressen werden gegenüber personengebundenen Adressen bevorzugt.
3. Private E-Mail-Adressen externer Anbieter sind keine dauerhaften offiziellen Homepage-Kontakte.
4. Persönliche Mobilnummern werden nicht standardmäßig veröffentlicht.
5. Eine persönliche Telefonnummer wird nur angezeigt, wenn dafür ein klarer operativer Nutzen besteht und die betroffene Person der Veröffentlichung bewusst zugestimmt hat.
6. Ein namentlich genannter Funktionsträger kann öffentlich sichtbar sein, ohne dass dessen persönliche Kontaktdaten veröffentlicht werden müssen.
7. Kontaktformulare routen serverseitig an ein freigegebenes Rollenpostfach bzw. eine freigegebene interne Intake-Schnittstelle.
8. Die Zieladresse eines Formulars wird nicht als personengebundene technische Konstante im Template verdrahtet.
9. Bei Rollenwechseln muss der öffentliche Kontaktweg bestehen bleiben können, ohne Inhalte auf vielen Seiten ändern zu müssen.
10. Hochsensible Kontaktwege, insbesondere Kinderschutz- und Datenschutzvorfälle, erhalten getrennte Routing- und Schutzregeln.

### 4. Nutzerführung statt Kontaktliste

Die Homepage soll Besucher nicht mit einer langen Liste aus Personen, Telefonnummern und E-Mail-Adressen konfrontieren.

Bevorzugtes Muster:

`Anliegen wählen → zuständiger Bereich → offizieller Kontaktweg`

Mögliche Nutzerziele:

- Mitglied werden / Mitgliedschaft ändern,
- Probetraining / Jugend,
- Spielbetrieb / Sport,
- Veranstaltung,
- Partner werden,
- Presse / Redaktion,
- allgemeine Vereinsanfrage,
- Datenschutz.

Der Nutzer muss die interne Vorstands- oder Abteilungsstruktur nicht kennen, um die richtige Stelle zu erreichen.

### 5. Mannschafts- und Jugendseiten

Auf Mannschaftsseiten werden persönliche Trainerdaten nicht automatisch als Standardkontakt veröffentlicht.

Bevorzugt:

- Trainerteam namentlich darstellen, wenn fachlich gewünscht,
- Kontakt über offizielle Jugend-/Team-/Sportadresse oder kontrolliertes Kontaktformular,
- keine privaten Telefonnummern als Standard,
- keine unnötigen direkten Kontaktdaten von Minderjährigen,
- Kontaktformulare mit Datenminimierung und klarer Datenschutzinformation.

Ein teambezogener Kontakt darf technisch auf eine Mannschaft geroutet werden, ohne dass die persönliche Zieladresse öffentlich sichtbar sein muss.

### 6. Vorstand und Funktionsträger

Vorstands- und Funktionsseiten sollen Transparenz über Verantwortlichkeiten schaffen, aber nicht automatisch persönliche Kommunikationsdaten veröffentlichen.

Bevorzugt:

- Name,
- Funktion,
- optional Foto,
- offizieller rollenbezogener Kontaktweg.

Persönliche Telefonnummern oder personengebundene Mailadressen sind Ausnahme, nicht Default.

### 7. Formulare und E-Mail-Poststelle

Kontaktformulare sollen perspektivisch mit der geplanten digitalen TuS-Poststelle zusammenspielen.

Zielbild:

`Homepage-Formular → serverseitige Validierung → Rollenpostfach / kontrollierte Intake-Schnittstelle → zuständiger Prozess`

Dabei gilt:

- minimale Pflichtfelder,
- kein unnötiges Tracking,
- Spam-Schutz mit geringer Datenschutzlast,
- keine personenbezogenen Formularinhalte in GitHub oder öffentlichen Logs,
- definierte Aufbewahrung und Löschung,
- sensible Kategorien nicht in normale Automationsqueues geben.

### 8. Entwickler-Handoff

Vor dem Homepage-Go-live erstellt der WordPress Developer ein Kontaktinventar:

- welche Kontaktmöglichkeiten bestehen heute,
- welche davon werden übernommen,
- welche werden abgeschaltet,
- welches Rollenpostfach ist künftig zuständig,
- welche Formulare existieren,
- wohin werden Formulare geroutet,
- wo sind noch persönliche Daten direkt im Content hinterlegt.

Der Go-live erfolgt erst, wenn die neue IONOS-Rollenstruktur für die benötigten Kontakte feststeht oder ein klarer Übergangsweg dokumentiert ist.

## Relationship to other documents

- `homepage-standard.md`
- `../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../roles/data-protection-manager/privacy-standard.md`
- `../roles/wordpress-developer/development-standard.md`
- `../architecture/stability-and-simplicity.md`

## Future Development

Sobald die neue IONOS-E-Mail-Struktur beschlossen ist, wird dieses Dokument um die verbindliche Zuordnung `Nutzeranliegen → Rollenpostfach → interner Prozess` ergänzt.

Später kann die Homepage zusätzlich eine zentrale Kontaktkomponente verwenden, die Rollen und Kontaktwege aus einer gepflegten Quelle zieht, statt Kontaktdaten auf vielen Seiten zu duplizieren.
