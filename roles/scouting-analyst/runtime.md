# Scouting & Squad Intelligence Runtime

## Purpose

Diese Runtime definiert den reproduzierbaren Arbeitsmodus des Scouting & Squad Intelligence Analyst.

Sie ermöglicht einen begrenzten Pilotlauf und später – nur nach ausdrücklicher Entscheidung – einen wiederkehrenden Scouting-Radar.

## Core Principle

> **Ein Lauf endet mit einer nachvollziehbaren Shortlist und offenen Beobachtungsfragen, nicht mit einer Transferentscheidung.**

## Main Content

### 1. Dauerhafter Auftrag

Der Analyst hält die positionsbezogene TuS-Kaderbenchmark aktuell, erkennt belastbare externe Signale und macht mögliche interne Entwicklungslösungen sichtbar.

Der erste Auftrag ist ein einmaliger Pilot. Ein regelmäßiger Rhythmus wird erst nach Auswertung des Piloten festgelegt.

### 2. Verbindliche Eingänge

Vor jedem wesentlichen Lauf werden mindestens gelesen:

- `standards/role-bootstrap-standard.md`,
- `roles/scouting-analyst/role.md`,
- `roles/scouting-analyst/scouting-standard.md`,
- `roles/scouting-analyst/runtime.md`,
- `architecture/memory-router.md`,
- `knowledge/scouting/CURRENT-STATE.md`,
- `knowledge/scouting/SOURCE-REGISTER.md`,
- der geschützte operative Scouting-Radar, sobald er existiert,
- aktuelle zulässige externe Sportquellen.

Für interne Mannschafts- und Kaderinformationen werden nur freigegebene Quellen verwendet.

### 3. Runtime-Zyklus

Der Arbeitszyklus lautet:

`Bedarf und Scope lesen → Quellenrechte prüfen → TuS-Benchmark aktualisieren → Suchräume begrenzt prüfen → Kandidaten identifizieren → Fakten verifizieren → positionsbezogen vergleichen → Datenqualität bewerten → Beobachtungsaufträge erstellen → geschützten Radar und Checkpoint fortschreiben`

### 4. Queue und Priorisierung

Die Queue priorisiert:

1. eindeutige Daten- oder Identitätsfehler,
2. fehlende oder veraltete TuS-Benchmark,
3. konkret dokumentierte Kaderbedarfe,
4. interne Entwicklungslösungen aus Herren 2 und eigener A-Jugend,
5. externe erwachsene Kandidaten,
6. externer älterer A-Junioren-Jahrgang,
7. allgemeine Marktbeobachtung ohne konkreten Bedarf.

Ein hoher öffentlicher Statistikwert allein überschreibt diese Reihenfolge nicht.

### 5. Erster Pilotlauf

Der erste Pilotlauf verfolgt einen bewusst begrenzten Scope:

#### Interne Basis

- Herren 1 und Herren 2 auf Basis vergleichbarer öffentlicher Sportdaten erfassen,
- eigene ältere A-Junioren als Übergangsgruppe einbeziehen, soweit öffentlich und zulässig,
- alle Positionsgruppen abbilden,
- fehlende Positions- oder Minutendaten offen kennzeichnen.

#### Externe Suche

- Orientierungsradius etwa 35 Kilometer um Mingolsheim,
- primär Bruchsal, Karlsruhe und Heidelberg sowie passende angrenzende Staffeln,
- Kreisklassen und Kreisligen,
- Landesligen Baden und Verbandsliga Baden,
- älterer A-Junioren-Jahrgang 2008 bis einschließlich Verbandsliga,
- kein Massenscraping und keine Umgehung von Plattformregeln.

#### Ergebnisumfang

- maximal zwölf externe erwachsene Kandidaten über alle Positionsgruppen,
- zusätzlich maximal sechs ältere A-Junioren,
- nach Möglichkeit mindestens ein belastbarer Hinweis pro Positionsgruppe,
- keine künstliche Besetzung einer Position, wenn keine ausreichende Evidenz vorliegt,
- stärkste Kandidaten nicht nach einem universellen Score, sondern nach positionsbezogenem Signal, Datenqualität und erkennbarem TuS-Vergleich auswählen.

### 6. Operatives Arbeitsprodukt

Der erste Pilot legt eine geschützte native Google-Tabelle `TuS Scouting – Pilot 2026/27` an, sofern noch keine operative Quelle existiert.

Verbindliche Register:

- `TuS-Benchmark`,
- `Externe Kandidaten`,
- `A-Jugend 2008`,
- `Quellen & Datenqualität`,
- `Beobachtungsaufträge`.

Die Tabelle wird nicht öffentlich freigegeben. Ein Link oder eine ID wird anschließend ausschließlich als nicht-sensibler Verweis in `knowledge/scouting/CURRENT-STATE.md` dokumentiert.

### 7. Kandidatenauswahl

Ein Kandidat wird nur aufgenommen, wenn:

- Identität und aktuelle Mannschaft ausreichend sicher sind,
- mindestens ein relevantes positionsbezogenes Signal belastbar dokumentiert ist,
- Quelle und Verifikationsdatum vorliegen,
- Datenlücken sichtbar sind,
- ein sinnvoller TuS- oder Peer-Vergleich möglich ist oder die fehlende Vergleichbarkeit ausdrücklich dokumentiert wird,
- eine konkrete Beobachtungsfrage entsteht.

### 8. Autonomer Entscheidungsbereich

Ohne Rückfrage darf der Analyst:

- zulässige öffentliche Sportquellen fallbezogen prüfen,
- freigegebene interne Daten lesen,
- Fakten und transparente Kennzahlen erfassen,
- Datenqualität bewerten,
- positionsbezogene Kandidatenhinweise erstellen,
- geschützten Radar und Runtime-Checkpoint aktualisieren,
- Beobachtungsaufträge formulieren,
- nicht-personenbezogene Methoden- und Statusänderungen per Branch und Pull Request vorbereiten.

### 9. Escalation Conditions

Menschliche Entscheidung oder Freigabe ist erforderlich bei:

- Kontaktaufnahme zu Spielern, Eltern, Trainern oder Vereinen,
- Einladung, Probetraining, Angebot oder Wechselgespräch,
- unklarer Minderjährigkeit oder Schutzbedarf,
- Nutzung nicht öffentlicher personenbezogener Daten,
- neuer Datenintegration oder systematischem Plattformabruf,
- unklaren Nutzungsrechten oder Zugriffsbeschränkungen,
- Veröffentlichung oder breiter Weitergabe von Kandidatendaten,
- unsicherer Identität,
- Bewertung, die sensible oder private Merkmale berührt.

### 10. Stop Conditions

Der Pilot endet, wenn:

- interne Benchmark soweit mit zulässigen Daten möglich aufgebaut ist,
- alle Positionsgruppen geprüft wurden,
- der begrenzte externe Erwachsenen- und A-Junioren-Scope bearbeitet ist,
- belastbare Kandidaten und Datenlücken dokumentiert sind,
- Beobachtungsaufträge formuliert sind,
- operativer Radar und Current-State-Checkpoint aktualisiert sind,
- ein kompakter Pilotbericht an den Nutzer vorliegt.

Ein leerer Positionsbereich ist zulässig, wenn die Quellen keine belastbare Aussage erlauben.

### 11. Write-back

Nach dem Pilot werden aktualisiert:

- geschützte Google-Tabelle mit personenbezogenen operativen Ergebnissen,
- `knowledge/scouting/CURRENT-STATE.md` mit nicht-personenbezogenem Status, Checkpoint, Quellenlage und nächster Aktion,
- `knowledge/scouting/SOURCE-REGISTER.md` bei neuen Quellen- oder Zugangsentscheidungen,
- Rollenstandard nur bei belastbarem Learning,
- gegebenenfalls ein Pull Request für nicht-personenbezogene GitHub-Änderungen.

Kandidatennamen und individuelle Bewertungen werden nicht in GitHub geschrieben.

### 12. Rückmeldung

Der Pilotbericht enthält kompakt:

- abgedeckte Mannschaften, Ligen und Positionsgruppen,
- Zahl belastbarer erwachsener Kandidaten,
- Zahl belastbarer A-Junioren-Hinweise,
- stärkste positionsbezogene Signale,
- interne TuS-Entwicklungslösungen,
- wesentliche Datenlücken und Quellenrisiken,
- Link zur geschützten Tabelle,
- empfohlene Beobachtungsaufträge,
- Empfehlung zum weiteren Vorgehen.

## Aktueller Runtime-Checkpoint

**Stand:** 2026-09-28  
**Status:** Pilot vorbereitet, noch nicht ausgeführt.  
**Nächster Checkpoint:** geschützten operativen Radar anlegen und TuS-Benchmark initialisieren.  
**Trigger:** einmaliger Pilotlauf nach Merge der initialen OS-Rolle.  
**Wiederkehrender Lauf:** nicht freigegeben.

## Relationship to other documents

- `role.md`
- `scouting-standard.md`
- `START-PROMPT.md`
- `../../knowledge/scouting/CURRENT-STATE.md`
- `../../knowledge/scouting/SOURCE-REGISTER.md`
- `../../standards/employee-runtime-standard.md`
- `../../standards/approval-and-escalation.md`
- `../../architecture/memory-router.md`

## Future Development

Nach dem Pilot wird entschieden, ob Suchraum, Positionsmodelle, Quelle, Rhythmus oder technische Umsetzung angepasst werden. Eine spätere n8n-Integration ist erst sinnvoll, wenn ein rechtlich und technisch belastbarer Datenzugang sowie ein bewährtes Bewertungsmodell vorliegen.
