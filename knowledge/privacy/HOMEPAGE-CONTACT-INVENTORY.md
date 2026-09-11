# Homepage-Kontaktinventur – TuS Mingolsheim

## Purpose

Dieses Dokument hält die öffentlich sichtbaren Kontaktwege der bestehenden TuS-Mingolsheim-Homepage als Arbeitsinventur fest und leitet daraus Anforderungen für die künftige IONOS-E-Mail-Struktur sowie den Homepage-Neuaufbau ab.

Es ist keine abschließende Postfachentscheidung. Die konkrete IONOS-Struktur wird separat beschlossen.

Persönliche Telefonnummern oder personengebundene Kontaktdaten werden in diesem Dokument bewusst nicht erneut ausgeschrieben. Es genügt für die organisatorische Bereinigung zu dokumentieren, auf welcher Seite solche Daten öffentlich vorkommen.

Stand der öffentlichen Prüfung: 11.09.2026.

## Core Principle

> **Eine öffentliche Kontaktmöglichkeit gehört dauerhaft zur Aufgabe – nicht zur Person, die sie gerade ausübt.**

Der TuS soll für Außenstehende einfach erreichbar sein, ohne persönliche Mobilnummern, private Mailadressen oder veraltete Zuständigkeiten als dauerhafte Vereinsinfrastruktur zu verwenden.

## Main Content

### 1. Bestätigte bestehende rollenbasierte TuS-Adressen

Bei der öffentlichen Prüfung wurden folgende bereits verwendete Rollenadressen bestätigt:

| Öffentlicher Zweck | Bestehende Adresse | Aktueller Befund | Zielrichtung |
|---|---|---|---|
| Allgemeine Vereinsanfragen / Geschäftsstelle | `geschaeftsstelle@tus-mingolsheim.de` | auf Startseite, Service und Impressum verwendet | als zentraler allgemeiner Eingang beibehalten |
| Mitgliedschaft / Mitgliederverwaltung | `mitgliederverwaltung@tus-mingolsheim.de` | Service-Seite | als eigener fachlicher Eingang beibehalten |
| Jugend / Eltern / Probetraining / Schiedsrichter / FSJ | `jugendleitung@tus-mingolsheim.de` | auf mehreren Jugend- und Informationsseiten verwendet | als stabiler Jugend-Eingang beibehalten; interne Verteilung später differenzieren |
| Aktiver Spielbetrieb | `senioren@tus-mingolsheim.de` | Seite `Aktive` | fachlich brauchbar, Bezeichnung bei neuer Mailstruktur auf Verständlichkeit prüfen |
| Datenschutzfragen | `datenschutz@tus-mingolsheim.de` | Datenschutzerklärung | Adresse kann grundsätzlich bleiben; öffentliche Bezeichnung zunächst `Datenschutzkontakt`, solange kein formell bestellter DSB bestätigt ist |

Diese Adressen sind ein guter Ausgangspunkt. Sie zeigen, dass der TuS bereits teilweise rollenbasiert arbeitet.

### 2. Öffentliche persönliche Kontaktdaten – Bereinigungsbedarf

Die bestehende Website veröffentlicht an mehreren Stellen persönliche Mobilnummern bzw. personengebundene Direktkontakte.

Belastbar festgestellt wurde dies unter anderem auf:

- `verein/vorstandschaft/` – persönliche Mobilnummern mehrerer Vorstands- und Abteilungsfunktionen,
- `spielbetrieb/1-mannschaft/` – persönliche Mobilnummer im Trainerteam,
- `verein/forderverein/` – persönliche Mobilnummern von Funktionsträgern,
- älteren Veranstaltungsbeiträgen, insbesondere Winterfeier-/Kartenvorverkaufsartikeln – persönliche Mobilnummern für damaligen Kartenverkauf.

Für den Homepage-Neuaufbau gilt:

- persönliche Mobilnummern werden nicht automatisch migriert,
- eine Telefonnummer wird nur veröffentlicht, wenn ein aktueller, klarer operativer Zweck besteht und die betroffene Person dies bewusst freigibt,
- Vorstands-, Trainer- und Funktionsträgerseiten zeigen primär Name und Rolle; Kontakt erfolgt über offizielle Rollenwege,
- historische Beiträge werden ebenfalls auf obsolete persönliche Kontaktdaten geprüft.

### 3. Legacy-Content ist Teil der Kontaktbereinigung

Eine neue Kontaktseite allein löst das Problem nicht.

Alte WordPress-Beiträge und Unterseiten bleiben weiterhin öffentlich erreichbar und können von Suchmaschinen indexiert sein. Deshalb braucht der Homepage-Neuaufbau einen eigenen `Legacy Contact Cleanup`.

Mindestens zu prüfen sind:

- alte Event- und Ticketverkaufsbeiträge,
- alte Mannschaftsseiten,
- frühere Trainer-/Funktionärsseiten,
- Förderverein-/Abteilungsseiten,
- ältere Kontakt- und Impressumsvarianten,
- alte Formulare bzw. Formularziele.

Bei historischen Artikeln soll der redaktionelle Inhalt grundsätzlich erhalten bleiben können. Veraltete persönliche Telefonnummern und obsolete direkte Kontaktwege können jedoch entfernt oder durch einen aktuellen Rollenweg ersetzt werden, wenn sie für den historischen Inhalt keinen bleibenden Wert haben.

### 4. Inkonsistente Nutzerführung

Die aktuelle Homepage verwendet teilweise unterschiedliche Muster für dasselbe Anliegen.

Beispiel:

- auf der Startseite wird bei Elternfragen auf ein Kontaktformular verwiesen,
- die Elternseite selbst verweist am Ende auf `jugendleitung@...`.

Ziel ist künftig ein konsistenter Weg:

`Anliegen → offizieller Rollenweg → interner Prozess`

Der Besucher muss nicht wissen, ob hinter diesem Weg ein Formular, ein Postfach, ein Alias oder später eine interne Intake-Schnittstelle steckt.

### 5. Zielmodell für die IONOS-Planung

Die spätere E-Mail-Struktur sollte drei Ebenen unterscheiden.

#### Ebene A – öffentliche kanonische Rollenadressen

Diese Adressen sind für Besucher sichtbar und überleben Rollen-/Personenwechsel.

Aus heutiger Sicht klar bzw. sehr wahrscheinlich benötigt:

- `geschaeftsstelle@...` – allgemeine Vereinsanfragen,
- `mitgliederverwaltung@...` – Mitgliedschaft / Datenänderung / Kündigung,
- `jugendleitung@...` bzw. eine später bewusst vereinfachte Jugendadresse – Jugend / Eltern / Probetraining,
- `senioren@...` oder eine verständlichere künftige Sport-/Aktive-Adresse – Erwachsenen-Spielbetrieb,
- `datenschutz@...` – Datenschutzkontakt.

Aus den neuen digitalen Prozessen starke Kandidaten:

- `redaktion@...` – Spielberichte, Vereinsnews, redaktionelle Einreichungen,
- `partner@...` oder `sponsoring@...` – öffentlicher Partnerkontakt; genau eine kanonische Variante festlegen,
- `veranstaltungen@...` – Veranstaltungsanfragen, sofern der reale Eingang dies rechtfertigt.

Noch zu entscheiden statt vorschnell anzulegen:

- separate Adressen für Sportpark, Wirtschaft, einzelne Abteilungen, Schiedsrichter oder Platzbelegung,
- ob diese Themen ein eigenes öffentliches Postfach brauchen oder intern aus einem übergeordneten Rollenpostfach verteilt werden.

#### Ebene B – operative Rollenpostfächer / Arbeitsadressen

Diese können für digitale Mitarbeiter und interne Workflows sinnvoll sein, müssen aber nicht alle öffentlich auf der Homepage stehen.

Kandidaten aus der TuS Digital Organisation:

- `foerderung@...`,
- `archiv@...`,
- ggf. `platzbelegung@...`,
- weitere Fachrollen erst bei realem Arbeitsbedarf.

Ein digitales Mitarbeiterpostfach wird nicht allein deshalb öffentlich, weil es technisch existiert.

#### Ebene C – besonders geschützte menschliche Kontaktwege

Diese Adressen dürfen nicht durch die normale KI-/n8n-Poststelle laufen.

Insbesondere:

- `kinderschutz@...` bzw. ein später festgelegter geschützter Schutzkontakt,
- Eingänge zu konkreten Datenschutzverletzungen oder besonders sensiblen Betroffenenfällen,
- weitere vertrauliche Meldewege, falls organisatorisch erforderlich.

Hier gelten separate Berechtigungen, menschliche Verantwortung und engere Aufbewahrungs-/Routingregeln.

### 6. Ein Postfach ist nicht automatisch eine eigene Mailbox

Bei der späteren IONOS-Entscheidung ist zwischen öffentlicher Adresse und technischer Mailbox zu unterscheiden.

Mögliche Umsetzung je Rolle:

- eigenes echtes Postfach, wenn die Rolle selbstständig senden/empfangen und einen eigenen Bestand benötigt,
- Alias bzw. Weiterleitung, wenn mehrere öffentliche Adressen intern bei derselben verantwortlichen Stelle zusammenlaufen können,
- kontrollierter Formular-/Workflow-Eingang, wenn kein klassischer Mailbestand erforderlich ist.

Ziel ist nicht möglichst viele Postfächer anzulegen, sondern **so wenige wie möglich und so viele wie nötig**.

### 7. Empfohlene Kontaktlogik der neuen Homepage

Die Homepage soll nicht die vollständige Mailstruktur offenlegen, sondern nach Nutzeranliegen führen.

Beispiel:

| Nutzeranliegen | Öffentlicher Weg | Interne Zielrolle |
|---|---|---|
| Allgemeine Frage | Geschäftsstelle | Geschäftsstelle / Triage |
| Mitglied werden / Daten ändern / kündigen | Mitgliederverwaltung | Mitgliederverwaltung |
| Mein Kind möchte Fußball spielen | Jugend | Jugendleitung / Jugendkoordination |
| Herren-/Aktivenspielbetrieb | Aktive / Sport | Sportliche Verantwortung |
| Spielbericht / Vereinsmeldung einreichen | Redaktion | Matchday Editor / Redaktion |
| Partner werden | Partner-Fit-Check / Partnerkontakt | Partnership Manager |
| Veranstaltung | Event-/Veranstaltungskontakt | Event-Verantwortung |
| Datenschutzfrage | Datenschutzkontakt | Datenschutz-Verantwortung / Mensch |
| Kinderschutz / Schutzmeldung | gesonderter geschützter Meldeweg | ausschließlich freigegebene menschliche Vertrauenspersonen |

Die tatsächlichen Mailadressen werden erst nach der IONOS-Entscheidung verbindlich in diese Matrix eingetragen.

### 8. Entwickler-Handoff

Für den WordPress Developer gilt beim Homepage-Neuaufbau:

1. Keine persönlichen Telefonnummern oder privaten E-Mail-Adressen aus dem Altbestand automatisch migrieren.
2. Öffentliche Kontaktziele über logische Rollen-/Kontakt-IDs modellieren, nicht dieselbe E-Mail-Adresse in vielen Templates hardcoden.
3. Eine zentrale Kontaktkonfiguration vorsehen, aus der Seiten und Komponenten die freigegebenen öffentlichen Wege beziehen können.
4. Formulare an logische Zielrollen bzw. eine kontrollierte Intake-Schnittstelle routen; Zieladressen nicht als verteilte Template-Konstanten pflegen.
5. Rollenwechsel sollen ohne Massenänderungen an Seiten möglich sein.
6. Vor Go-live automatisiert bzw. halbautomatisiert nach öffentlichen Mailadressen und Telefonnummern im migrierten Content suchen und Treffer manuell prüfen.
7. Historische Beiträge in den Legacy-Contact-Cleanup einbeziehen.
8. Kontaktmöglichkeiten auf Mobile genauso klar und sparsam gestalten wie auf Desktop.
9. Geschützte Kontaktwege nicht in die normale öffentliche Formular-/Automationslogik einbauen.

### 9. Nächster organisatorischer Schritt

Vor produktiver Umsetzung wird gemeinsam die IONOS-Struktur beschlossen.

Dafür ist nun nicht mehr bei null zu beginnen. Die Entscheidung kann auf dieser Inventur basieren:

1. bestehende Rollenadressen bestätigen oder ersetzen,
2. neue öffentliche Rollenadressen auswählen,
3. interne Arbeitsadressen auswählen,
4. geschützte menschliche Adressen definieren,
5. je Adresse festlegen: echtes Postfach, Alias/Weiterleitung oder Workflow-Eingang,
6. Owner und Vertretung festlegen,
7. Automationsfähigkeit festlegen,
8. Aufbewahrung/Löschung je Eingang festlegen.

## Relationship to other documents

- `CURRENT-STATE.md`
- `HOMEPAGE-PRIVACY-CHECK.md`
- `../../design/homepage-contact-architecture.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../projects/platzbelegung/PROJECT-STATE.md`

## Future Development

Nach der IONOS-Entscheidung wird aus dieser Inventur eine verbindliche Mailrouting-Matrix mit `Adresse → Zweck → Owner → Vertretung → Automationsklasse → Source of Truth → Aufbewahrung`.

Danach kann die Homepage-Kontaktarchitektur die konkreten Rollenpostfächer referenzieren, ohne einzelne persönliche Adressen in Content und Templates zu verteilen.
