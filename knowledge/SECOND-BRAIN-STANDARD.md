# Second Brain Standard

## Purpose

Dieser Standard definiert, wie die TuS Digital Organisation dauerhaft relevantes Wissen aus Chats, Projekten, Quellen und realer Arbeit bewahrt, einordnet und wiederverwendbar macht.

Er verhindert insbesondere, dass neue Chats bekannte Sachverhalte erneut rekonstruieren, bereits entschiedene Fragen wieder öffnen oder verworfene Ansätze als neue Ideen präsentieren.

## Core Principle

> **Wissen wird dort gesichert, wo zukünftige Arbeit es wiederfinden und richtig einordnen kann.**

Der Chat ist Arbeitsoberfläche. Die dauerhafte Wahrheit liegt in der fachlich zuständigen Source of Truth.

## Main Content

### 1. Was in das Second Brain gehört

Ein Inhalt wird dauerhaft gesichert, wenn er mindestens eines erfüllt:

- beeinflusst zukünftige Entscheidungen,
- verhindert Wiederholungsfehler oder Doppelarbeit,
- beschreibt einen fortzusetzenden Arbeitsstand,
- erklärt eine wichtige fachliche oder organisatorische Entscheidung,
- ist für mehrere Aufgaben, Rollen oder Projekte wiederverwendbar,
- dokumentiert einen bewusst verworfenen Weg,
- enthält eine relevante Erfahrung oder ein belastbares Lesson Learned,
- ist ein fachlicher Fakt, der später zuverlässig benötigt wird.

Nicht dauerhaft gesichert werden müssen bloße Gesprächsübergänge, spontane Formulierungsvarianten, Zwischenideen ohne weitere Relevanz oder Informationen, die bereits sauber kanonisch vorhanden sind.

### 2. Wissensarten

#### Fact

Belastbare Information mit nachvollziehbarer Quelle.

#### Decision

Verbindlich getroffene Entscheidung. Langfristige oder querschnittliche Entscheidungen gehören grundsätzlich in `decisions/`.

#### Current State

Der letzte belastbare operative Stand einer Domäne oder eines Projekts. Er enthält insbesondere, wo Arbeit steht und was als Nächstes sinnvoll ist.

#### Open Question

Eine bewusst noch nicht entschiedene Frage. Sie darf nicht stillschweigend als Fakt behandelt werden.

#### Rejected

Ein geprüfter und verworfener Ansatz. Er wird mit Grund festgehalten, wenn andernfalls realistisch ist, dass die gleiche Schleife erneut beginnt.

#### Lesson Learned

Eine Erkenntnis aus realer Arbeit, die zukünftige Arbeit besser, schneller oder sicherer macht.

#### Hypothesis

Eine plausible, noch nicht bestätigte Annahme. Sie bleibt sichtbar von Fakten getrennt.

#### Superseded

Ein früher gültiger Stand, der durch einen neueren ersetzt wurde. Historisch relevante Vorgänger werden nicht so gelöscht, dass die Entwicklung unverständlich wird.

### 3. Canonical Source Rule

Jede dauerhaft relevante Information besitzt eine fachlich verantwortliche Quelle.

Vor dem Anlegen neuer Wissensdateien wird geprüft:

1. Existiert bereits eine passende kanonische Quelle?
2. Gehört die Information in einen Projektzustand?
3. Gehört sie in eine ADR?
4. Gehört sie in einen Rollen- oder Fachstandard?
5. Gehört sie in ein bestehendes fachliches Register oder eine bestehende Wissensdomäne?
6. Liegt die fachlich richtige Source of Truth außerhalb GitHub, etwa in Google Drive oder einer strukturierten Tabelle?

Nur wenn keine bestehende Quelle geeignet ist, entsteht eine neue Wissensstruktur.

### 4. Chat-to-Brain-Migration

Chats werden nicht als Gesprächsprotokoll archiviert.

Bei relevanten Chatabschnitten wird folgende Verdichtung angewendet:

```text
Arbeitsdialog
  ↓
Was ist dauerhaft relevant?
  ↓
Fact | Decision | Current State | Open Question | Rejected | Lesson | Hypothesis
  ↓
Existiert bereits eine kanonische Quelle?
  ↓
Ja: aktualisieren / verknüpfen
Nein: kleinste sinnvolle neue Quelle anlegen
  ↓
Beziehungen zu Rolle, Projekt, Standard, Skill oder Runtime herstellen
```

Die Formulierung wird aus dem Gesprächskontext gelöst. Entscheidend ist die fachliche Aussage, nicht die Reihenfolge des Chats.

### 5. Anti-Loop Rule

> **Eine bereits entschiedene oder verworfene Frage wird nicht allein deshalb neu geöffnet, weil ein neuer Chat beginnt, ein anderer Mitarbeiter arbeitet oder die frühere Diskussion nicht erinnert wird.**

Eine Neubewertung ist zulässig, wenn mindestens eines gilt:

- neue belastbare Evidenz,
- relevante geänderte Randbedingungen,
- nachgewiesener Nachteil des bisherigen Wegs,
- neue Anforderung,
- ausdrückliche menschliche Entscheidung zur Neubewertung.

Bei einer Neubewertung wird festgehalten:

- welche frühere Entscheidung oder Ablehnung betroffen ist,
- was sich geändert hat,
- warum dies eine erneute Prüfung rechtfertigt,
- welches neue Ergebnis gilt.

### 6. Conflict Rule

Widersprüchliche Informationen werden nicht künstlich vereinheitlicht.

Bei Konflikten wird geprüft:

1. Welche Quelle ist fachlich zuständig?
2. Welche Information ist aktueller?
3. Welche Information ist besser belegt?
4. Handelt es sich um unterschiedliche Zeitstände oder Scopes?

Bleibt der Konflikt offen, wird er als Unsicherheit oder Open Question dokumentiert.

### 7. Write-back Rule

Relevante Arbeit endet nicht mit einer guten Chat-Antwort.

Wenn sich durch die Arbeit ein dauerhafter Zustand verändert, wird die zuständige Source of Truth aktualisiert. Besonders wichtig sind:

- neue Entscheidung,
- neuer Projekt- oder Fachstand,
- erledigter oder neuer nächster Schritt,
- neues Lesson Learned,
- neu verworfener Weg,
- veränderter Blocker,
- relevante Abhängigkeit.

### 8. Current-State Quality

Ein Current State muss einen neuen Chat ohne Rekonstruktion aus Altgesprächen arbeitsfähig machen.

Er soll mindestens erkennen lassen:

- was gilt,
- was bereits erledigt ist,
- was offen ist,
- was als Nächstes sinnvoll ist,
- welche Quellen und Entscheidungen maßgeblich sind,
- welche Blocker oder Risiken bestehen.

`Weiter`, `noch prüfen` oder `wir waren schon ziemlich weit` sind keine ausreichenden Checkpoints.

### 9. Rejected / Do-not-revisit Quality

Ein verworfener Ansatz soll knapp beantworten:

- Was wurde erwogen?
- Warum wurde es verworfen?
- Welche Alternative gilt stattdessen?
- Unter welchen Bedingungen dürfte man es sinnvoll wieder öffnen?

Damit wird Ablehnung zu nutzbarem Organisationswissen statt zu verlorener Frustration.

### 10. Herkunft und Verifikation

Bei wichtigen Fakten muss nachvollziehbar bleiben, woher sie stammen.

Mögliche Quellen sind:

- verbindliche GitHub-Dateien,
- Originaldokumente in Google Drive,
- offizielle externe Primärquellen,
- fachliche Register,
- ausdrücklich getroffene menschliche Entscheidungen,
- nachvollziehbar dokumentierte reale Arbeit.

Eine Chat-Aussage allein wird nicht automatisch zu einem belastbaren Fakt.

### 11. Privacy Boundary

Vertrauliche, personenbezogene, finanzielle, vertragliche oder anderweitig schutzbedürftige Inhalte werden nicht allein zum Zweck des Second Brain in ein öffentliches Repository kopiert.

GitHub kann stattdessen den nicht-sensiblen Zustand und einen Verweis auf den geschützten Artefaktraum enthalten.

### 12. Wissenspflege

Das Second Brain wird nicht über periodische Komplettüberarbeitung gepflegt, sondern durch realen Gebrauch:

- neue Arbeit liest vorhandenes Wissen,
- neue Erkenntnisse werden zurückgeschrieben,
- veraltete Aussagen werden als ersetzt kenntlich gemacht,
- Doppelungen werden bei Berührung konsolidiert,
- neue Strukturen entstehen nur aus echtem Bedarf.

## Relationship to other documents

- `README.md`
- `../architecture/memory-router.md`
- `../architecture/knowledge-graph.md`
- `../architecture/tus-os-inventory.md`
- `../core/objects/knowledge-entry.md`
- `../decisions/README.md`
- `../standards/employee-operating-standard.md`
- `../standards/learning-loop.md`
- `../standards/employee-runtime-standard.md`

## Future Development

Der Standard wird anhand der Migration realer TuS-Chats weiter geschärft.

Erste priorisierte Migrationsfelder sind Brand/Merch, Archiv, Homepage/Kommunikation und Matchday-Wissen. Funding und Sponsoring dienen als bereits fortgeschrittene Referenzdomänen.