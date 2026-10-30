# Event Planner – Offline-Ticketverkauf und grafischer Saalplan

## Purpose

Die Winterfeier verkauft Eintrittskarten **persönlich, nicht online**. Dieses Modul soll das bisherige grafisch angeordnete Excel-Saalblatt im bestehenden TuS Event Planner ersetzen: Verkäufer sehen sofort, welche Tische und Sitzplätze frei, reserviert oder verkauft sind.

## Core Principle

**Der Saalplan ist die gemeinsame, stets aktuelle Arbeitsansicht für den persönlichen Kartenverkauf.** Es entsteht kein Shop und kein zweites Eventsystem. Jeder Sitzplatz und jeder Verkauf gehört zu einem bereits existierenden Event.

Dieses Dokument konkretisiert den vorhandenen fachlichen Rahmen `plugins/event-manager/ticketing.md` für den aktuellen WordPress Event Planner.

## Ausgangslage / noch fehlende Vorlage (30.10.2026)

- Nutzer bestätigt: Bisher wurde ein **grafisch wie der reale Saal aufgebautes Excel-Blatt** mit Tisch-/Sitzplatznummern verwendet; verkaufte Plätze wurden darin markiert.
- In den derzeit verbundenen Google-Drive-Dateien ließ sich das betreffende Excel-Blatt **nicht eindeutig finden**. Die beiden gefundenen Ordner `Winterfeier` enthalten Fotos; unter den zugänglichen Excel- und Google-Sheets-Dateien erschien kein passender Saalplan.
- Deshalb **keine Tischanzahl, Sitzanzahl, Tischgeometrie oder Nummernfolge annehmen**.
- Das Original-Excel (alternativ ein lesbarer Export des tatsächlichen Plans) wird vor dem Nachbau der Saalgeometrie benötigt. Erst danach Layout mit realem Saalplan abgleichen und freigeben.
- Plugin-Code auf `main` am Prüfzeitpunkt: Header und Konstante `VTP_VERSION` in `verein-turnierplaner.php` zeigen `3.8.49`; `PROJECT-STATE.md` führt noch `3.8.45`. Bei der Implementierung neu von `main` lesen, Versionsangaben abgleichen.

## Geplanter Arbeitsablauf (MVP)

1. Mitarbeiter öffnet ein vorhandenes **Event** (z. B. Winterfeier) und darin den Arbeitsbereich **Ticketverkauf**.
2. Sichtbar ist ein **grafischer, maßstäblich nicht zwingend exakter, aber räumlich originalgetreuer Saalplan** mit Bühne/Eingängen/wegen, Tischen und klickbaren einzelnen Sitzplätzen. Tisch- und Platznummern müssen der Originalvorlage entsprechen.
3. Die farb- **und textlich** gekennzeichneten Zustände sind: **frei**, **reserviert**, **verkauft**, **gesperrt** (z. B. nicht verfügbar).
4. Verkäufer wählt einen oder mehrere noch freie Plätze an, sieht Tisch-/Platznummern und bestätigt **Reservieren** oder **Verkaufen**. Mehrfachauswahl muss einen zusammenhängenden Vorgang ermöglichen; keine Pflicht, jeden Sitz einzeln zu öffnen.
5. Für den Vorgang werden – soweit tatsächlich benötigt – Käufername, optional eine interne Notiz, optional Einzel-/Gesamtpreis, Zahlung **offen/bezahlt** und der bearbeitende WordPress-Benutzer dokumentiert. Kein Pflichtfeld für E-Mail/Telefon.
6. Reservierte Plätze können später als verkauft übernommen werden; Verkäufe/Reservierungen lassen sich durch berechtigte Nutzer mit expliziter Bestätigung rückgängig machen bzw. korrigieren. Zahlungsstatus ist **nicht** mit Sitzplatzstatus identisch.
7. Die Karte aktualisiert sich nach bestätigtem Speichern aus der Datenbank. Beim erneuten Öffnen, in anderem Browser oder durch zweiten Bearbeiter muss derselbe belegte Stand erscheinen.
8. Oberhalb/neben dem Plan stehen Zähler: **Gesamt**, **frei**, **reserviert**, **verkauft**, **gesperrt** sowie optionale Zahlungsübersicht. Die Zähler werden aus Datensätzen berechnet und nie parallel manuell gepflegt.
9. Ein druckbarer/exportierbarer Überblick zeigt mindestens **Tisch – Sitz – Status**; personenbezogene Details nur in geschützten internen Listen.

## Grafischer Saalplan – Bearbeitung

- Der konkrete Plan wird initial aus der Excel-Vorlage **fachlich überprüft** übertragen. Zusammengeführte Zellen, Farbmarkierungen oder Shapes der Excel-Datei dürfen nicht blind als verlässliche Sitzkoordinaten ausgelegt werden.
- Tische sind im Plan verschiebbar; bei Bedarf sind Sitze pro Tisch und die Reihenfolge individuell einstellbar. Tisch- und Sitz-ID bleiben **stabil**; eine reine Verschiebung verändert keine Buchungen.
- Die Verwaltungsoberfläche bietet zwischen **Saalplan bearbeiten** und **Karten verkaufen** einen klaren Moduswechsel. Layoutänderungen benötigen eine bewusste Speicheraktion.
- Saalplan ist **eventbezogen** (Winterfeier dieses Jahres), kann aber perspektivisch als Vorlage für eine spätere Veranstaltung kopiert werden, **ohne** alte Verkaufsdaten zu übernehmen.
- Nach Verkaufsbeginn dürfen bereits belegte Plätze nicht stillschweigend durch Layoutänderungen verschwinden.

## Fachliche Zustände und Regeln

| Status | Bedeutung | Zulässige Standardaktion |
| --- | --- | --- |
| frei | aktuell keinem aktiven Vorgang zugewiesen | reservieren, verkaufen, sperren |
| reserviert | Platz vorläufig zugeordnet, Zahlung nicht impliziert | als verkauft bestätigen, Reservierung aufheben |
| verkauft | Karte persönlich vergeben, Zahlung separat dokumentiert | nur durch bewusste Korrektur stornieren |
| gesperrt | kein Verkauf möglich | entsperren |

- **Kein Doppelverkauf**: Konflikte bei zwei gleichzeitig arbeitenden Benutzern serverseitig verhindern. Bei einer Mehrfachauswahl werden **alle** gewünschten Plätze in **einer** atomaren Operation übernommen oder **kein** Platz. Kein nur im Browser markierter Sitz gilt bereits als verkauft.
- Speicherkonflikte klar anzeigen (z. B. `Tisch 4, Platz 2 wurde inzwischen verkauft`), aktuelle Verfügbarkeit neu laden.
- Jede relevante Änderung braucht eine nachvollziehbare Spur mit Benutzer, Zeitpunkt, Aktion und Platzreferenzen. Keine personenbezogenen Änderungen ungeprüft in öffentliche Logs oder GitHub.
- Rücknahme einer Buchung und Erstattung einer Zahlung sind getrennte fachliche Schritte; das Modul darf keine tatsächliche Bar- oder Bankzahlung vortäuschen.

## Datenmodell und Integration

- **Source of Truth: WordPress-/Plugin-Datenbank.** Bestehende `vtp_events`-IDs als Eventreferenz wiederverwenden. Neue strukturierte Tabellen für Layout/Tische/Sitze und Buchungs-/Zahlungsstatus nach Prüfung der aktuellen VTP-DB-Struktur; kein Excel, JSON in einer Optionszelle oder JavaScript-Speicher als operative Datenquelle.
- Nummern/Koordinaten im Layout von Status/Buchung trennen. Ein Saalplanobjekt ist nicht dasselbe wie eine verkaufte Eintrittskarte.
- Ein Käufer kann mehrere Sitze in einem Verkauf erhalten. Bearbeitung und Storno müssen diesen Zusammenhang nachvollziehbar halten.
- Bestehende Event-Daten, Turniere, Helferschichten, Vorlagen und Dashboardfunktionen dürfen nicht verändert werden.
- Für vertrauliche Kartenverkaufsdaten nur angemeldete, konkret autorisierte WordPress-Benutzer. Nonces, Capabilities, serverseitige Validierung, prepared SQL und Ausgabescaping sind verpflichtend.
- Personenbezogene Daten minimieren; kein öffentlicher Link zum internen Käufer-/Zahlungsregister. Datenschutzinformation, Berechtigungen und Lösch-/Aufbewahrungsregel vor Produktivfreigabe klären.
- Bestehende TuS-Backend-Formulare, Statusmuster, Tastaturbedienbarkeit, Touch- und Responsive-Regeln verwenden.

## Bewusste Grenzen des MVP

**Nicht enthalten:** Online-Shop, öffentliche Sitzplatzreservierung, Bezahlgateway, QR-Scanner, E-Mail-Versand, Rechnungsstellung, personalisierte Tickets als PDF, automatische Reservierungsfristen, Namensschilder, Gastronomie-/Menüverwaltung. Diese Themen aus dem generellen Ticketing-Zielbild bleiben gesonderte spätere Entscheidungen.

## Umsetzung in kleinen, prüfbaren Schritten

1. **Saalplan verifizieren:** Original-Excel beschaffen, alle Tische/Sitze/Orientierungen und Statusfarben aufnehmen, Unklarheiten markieren; einmalige Freigabe der Geometrie.
2. **Daten und Backend:** Eventanbindung, DB-Schema mit Migration und Indizes, Berechtigungen, Statuswechsel, konkurrierende Verkäufe und Tests.
3. **Interaktive Planansicht:** grafische Tische/Sitze, Mehrfachauswahl, Reservieren/Verkaufen/Korrigieren; responsiv und per Tastatur nutzbar.
4. **Betriebliche Auswertung:** Belegungszahlen, Liste je Tisch, Ausdruck/CSV und Storno-/Änderungsnachvollziehbarkeit.
5. **Pilot:** mit Testdaten von mehreren Benutzern durchspielen, dann erst reale Winterfeier-Daten übernehmen. Keine Veröffentlichung/Installation in Produktion ohne Freigabe.

## Abnahmekriterien

- Der Plan entspricht der bereitgestellten Excel-Geometrie inkl. aller **realen** Tisch-/Platznummern; keine erfundenen Positionen.
- Ein Verkäufer kann mehrere konkrete freie Sitze in einem Vorgang an eine Person verkaufen.
- Nach Speichern/Neuladen erscheint jeder Sitz verlässlich mit richtigem Status und zugehöriger interner Buchung.
- Zwei Verkäufer können denselben Sitz nicht gleichzeitig verkaufen.
- Reservierte und verkaufte Sitze sind unabhängig vom Zahlungsstatus unterscheidbar.
- Rücknahmen sind bestätigt und protokolliert; betroffene Plätze werden korrekt wieder frei.
- Übersichtszähler, Platzliste und grafische Ansicht zeigen denselben Datenstand.
- Nur berechtigte Benutzer sehen Käufer-/Zahlungsdaten; mobile/Tablet-Ansicht und Keyboard-Pfade sind brauchbar.
- Vorhandene Plugin-Funktionen bestehen Regressionstests.
- Ein PR mit Tests, Migration und dokumentierter Einschränkung liegt vor; Merge und Deployment bleiben separate Freigaben.

## Related Documents

- `plugins/event-manager/ticketing.md`
- `plugins/event-manager/data-model.md`
- `projects/event-planner/FUNCTIONAL-SCOPE.md`
- `projects/event-planner/DATA-PERSISTENCE.md`
- `projects/event-planner/STATUS-COLOR-STANDARD.md`
- `projects/event-planner/PROJECT-STATE.md`
- `design/backend-form-standard.md`
- `roles/data-protection-manager/privacy-standard.md`
