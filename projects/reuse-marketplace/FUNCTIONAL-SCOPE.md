# TuS Tauschbörse – Functional Scope

## Purpose

Die TuS Tauschbörse soll gut erhaltene Fußball- und Vereinsausrüstung länger nutzbar machen und Familien einen einfachen Weg bieten, nicht mehr benötigte Sachen weiterzugeben.

Sie verbindet drei Ziele:

- **Nachhaltigkeit:** brauchbare Ausrüstung wird weiterverwendet statt entsorgt,
- **Soziales:** geeignete Sachen können alternativ für die TuS-Hilfe `Kinder von Atibie` gespendet werden,
- **Gemeinschaft:** Mitglieder und Familien helfen sich untereinander unkompliziert.

Typische Gegenstände sind insbesondere Fußballschuhe, Schienbeinschoner und Sport-/Vereinskleidung.

## Core Principle

**Kein Benutzerkonto für einen einfachen privaten Weitergabevorgang.**

Anbieter und Interessenten sollen ihre jeweilige Aktion über kurze Formulare erledigen können. Die nötige Sicherheit entsteht über Verifizierung, geschützte Verwaltungslinks und klare Datenflüsse statt über eine dauerhafte Registrierung.

Persönliche Kontaktdaten sind niemals Bestandteil der öffentlichen Anzeige.

## Main Content

### 1. Einstiegsseite

Die öffentliche Tauschbörse bietet zwei klar erkennbare Wege:

1. **Weitergeben / verkaufen / verschenken** – ein öffentliches Angebot einstellen.
2. **Für Kinder von Atibie spenden** – zum TuS-Spendenweg für geeignete Ausrüstung wechseln.

Der Spendenweg muss nicht automatisch eine öffentliche Anzeige erzeugen.

### 2. Angebot einstellen

Ein Angebot wird über ein kurzes öffentliches Formular angelegt.

Mindestens vorgesehen sind:

- Titel,
- Kategorie,
- kurze Beschreibung,
- Größe, sofern relevant,
- Zustand,
- Art der Weitergabe, mindestens `Verschenken` oder `Verkaufen`,
- Preis, falls Verkauf,
- ein oder mehrere Bilder,
- Name des Anbieters,
- verifizierbare Kontaktadresse,
- optional weitere Kontaktmöglichkeit, wenn fachlich sinnvoll.

Die Kontaktdaten gehören zum internen Vorgang und werden nicht öffentlich angezeigt.

### 3. Keine Registrierung – Verifizierung per Verwaltungslink

Nach dem Absenden wird die angegebene Kontaktadresse verifiziert.

Bevorzugtes Grundmuster:

- Anbieter erhält eine Nachricht mit einem einmaligen bzw. sicheren Verwaltungslink,
- erst nach Verifizierung wird das Angebot veröffentlicht,
- derselbe geschützte Verwaltungsweg ermöglicht später Bearbeiten, Reservieren oder Schließen,
- es wird kein dauerhaftes Benutzerkonto angelegt.

Der konkrete technische Token-/Magic-Link-Mechanismus wird vor Implementierung sicherheitstechnisch geprüft.

### 4. Öffentliche Angebotsübersicht

Aktive Angebote erscheinen in einer öffentlichen Übersicht auf der TuS-Homepage.

Die Übersicht soll einfach filter- und erfassbar sein, z. B. nach:

- Kategorie,
- Größe,
- `Verschenken` / `Verkaufen`,
- Status.

Eine Anzeige zeigt nur die für die Entscheidung nötigen Informationen, insbesondere Bilder, Beschreibung, Zustand, Größe und ggf. Preis.

Nicht öffentlich sind insbesondere:

- E-Mail-Adresse,
- Telefonnummer,
- interne Verwaltungslinks,
- sonstige personenbezogene Backend-Daten.

### 5. Interesse bekunden – „Will ich haben“

Jede aktive Anzeige bietet eine klare Aktion wie `Will ich haben`.

Der Interessent gibt anschließend mindestens an:

- Name,
- eine Kontaktmöglichkeit,
- optional eine kurze Nachricht.

Diese Angaben werden nicht veröffentlicht.

Nach Absenden erhält der Anbieter die Kontaktdaten des Interessenten über den vom System vorgesehenen Kommunikationsweg. Anbieter und Interessent klären Übergabe, Bezahlung oder sonstige Details anschließend direkt miteinander.

Die Tauschbörse selbst muss dafür keinen internen Chat aufbauen.

### 6. Status und Abschluss

Ein Angebot hat einen einfachen Lebenszyklus.

Mindestens relevante Zustände:

- `aktiv`,
- optional `reserviert`,
- `abgeschlossen` / `geschlossen`.

Nach einer erfolgreichen Weitergabe soll der Anbieter über seinen sicheren Verwaltungsweg gefragt bzw. erinnert werden, ob das Angebot geschlossen werden kann.

Bestätigt der Anbieter den Abschluss:

- wird das Angebot als geschlossen markiert,
- es verschwindet aus der öffentlichen aktiven Übersicht,
- notwendige interne Daten werden nur entsprechend der festgelegten Aufbewahrungsregel gespeichert.

Der genaue Zeitpunkt eines automatischen Follow-ups wird erst bei der technischen Planung festgelegt; er darf den Nutzer nicht unnötig belästigen.

### 7. Ghana-Hilfe „Kinder von Atibie“

Die Tauschbörse soll die bestehende soziale TuS-Hilfe sichtbar integrieren.

Bei geeigneter Ausrüstung kann der Nutzer statt einer öffentlichen Anzeige den Weg `Für Kinder von Atibie spenden` wählen.

Dieser Weg soll mindestens:

- kurz erklären, welche Dinge geeignet sind,
- die aktuelle TuS-Abgabe-/Kontaktmöglichkeit anzeigen,
- möglichst ohne doppelte Dateneingabe funktionieren.

Wie der konkrete Spendenprozess organisatorisch abgewickelt wird, wird separat mit dem verantwortlichen TuS-Prozess abgestimmt.

### 8. Datenschutz

Das Projekt verarbeitet personenbezogene Kontaktdaten und muss deshalb besonders sparsam sein.

Verbindliche Leitplanken:

- nur Daten erheben, die für Vermittlung und Verwaltung wirklich benötigt werden,
- keine persönlichen Kontaktdaten öffentlich anzeigen,
- Anbieter-Kontaktdaten nur intern und für berechtigte Administratoren zugänglich machen,
- Interessenten-Kontaktdaten nur für den konkreten Kontaktvorgang verwenden,
- klare Datenschutzhinweise vor Absenden der Formulare,
- definierte Lösch- bzw. Aufbewahrungsregeln für geschlossene Anzeigen und Kontaktanfragen,
- keine unnötige Profilbildung oder dauerhafte Nutzerkonten.

Die konkrete Datenschutzprüfung erfolgt vor Produktivsetzung nach den geltenden TuS-Standards.

### 9. Missbrauchsschutz

Die geringe Einstiegshürde darf nicht zu einer offenen Spam-Schnittstelle werden.

Vor Implementierung werden einfache, wartbare Schutzmaßnahmen festgelegt, insbesondere eine Kombination aus:

- Kontaktverifizierung,
- Honeypot und/oder CAPTCHA nur soweit nötig,
- Rate Limits,
- Prüfung von Bildformat und Dateigröße,
- administrativer Möglichkeit zum Sperren oder Entfernen ungeeigneter Anzeigen.

Der Missbrauchsschutz soll möglichst unsichtbar bleiben, solange ein normaler Nutzer sich regelkonform verhält.

### 10. Administration

Im WordPress-Backend sollen berechtigte TuS-Verantwortliche mindestens sehen und verwalten können:

- aktive und geschlossene Anzeigen,
- Anbieter-Kontaktdaten,
- Status,
- eingegangene Interessensbekundungen soweit für Support nötig,
- problematische oder gemeldete Inhalte,
- Löschung bzw. Deaktivierung einer Anzeige.

Das Backend ist kein CRM. Es enthält nur die Daten, die zur sicheren Durchführung der Tauschbörse erforderlich sind.

### 11. Vereinfachungsregeln

Für die Tauschbörse gelten folgende Produktregeln:

- keine Registrierung, solange der Vorgang sicher ohne Konto lösbar ist,
- kein interner Chat, wenn eine sichere Kontaktvermittlung genügt,
- keine öffentliche Anzeige persönlicher Kontaktdaten,
- möglichst wenige Pflichtfelder,
- Bilder direkt im Formular hochladen,
- mobile Nutzung als primärer Anwendungsfall berücksichtigen,
- ein Angebot soll in wenigen Minuten eingestellt werden können,
- kein Ausbau zu einer allgemeinen kommerziellen Kleinanzeigenplattform.

### 12. Erfolgskriterien

Das Zielbild ist erreicht, wenn ein TuS-Mitglied oder Elternteil ohne Benutzerkonto in wenigen Minuten ein gebrauchtes Sportteil einstellen kann und Interessenten ebenso einfach Kontakt aufnehmen können.

Erfolgreich ist das Projekt insbesondere, wenn:

- brauchbare Ausrüstung leichter weiterverwendet wird,
- Kontaktdaten geschützt bleiben,
- der Verein keinen manuellen Vermittlungsaufwand für jeden Vorgang hat,
- abgeschlossene Anzeigen zuverlässig aus der aktiven Übersicht verschwinden,
- die Ghana-Hilfe als echte Alternative zur privaten Weitergabe sichtbar ist.

## Relationship to other documents

- `README.md` beschreibt Zweck und Einstieg in das Projekt.
- `PROJECT-STATE.md` hält den aktuellen Entwicklungsstand und offene Entscheidungen fest.
- `../../design/ui-standard.md` definiert die gemeinsamen TuS-UI-Muster.
- `../../standards/approval-and-escalation.md` ist für Datenschutz, Veröffentlichung und irreversible Änderungen relevant.
- `../../roles/wordpress-developer/development-standard.md` definiert den technischen Entwicklungsstandard.

## Future Development

Vor dem ersten Plugin-Code sind insbesondere zu entscheiden bzw. zu verifizieren:

1. genaue Kontaktmethode für Verifizierung und Benachrichtigungen,
2. sicherer Magic-Link-/Token-Lebenszyklus,
3. minimale Pflichtfelder und Kategorien,
4. Bildgrenzen und Speicherung,
5. Lösch- und Aufbewahrungsfristen,
6. notwendiger Missbrauchsschutz,
7. konkreter TuS-Prozess für `Kinder von Atibie`,
8. ob und wann ein automatisches Abschluss-Follow-up versendet wird.

Die Umsetzung erfolgt anschließend in kleinen, testbaren Einzel-PRs.