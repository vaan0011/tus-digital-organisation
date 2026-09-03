# Iteration & Progress Standard

## Purpose

Dieses Dokument verhindert, dass Projekte und Mitarbeiter in wiederholte Lösungsversuche, vergessene Entscheidungen oder unproduktive Schleifen geraten.

Es gilt für Entwicklungsarbeit, Organisationsarbeit und längere Chat-basierte Zusammenarbeit.

## Core Principle

Ein weiterer Versuch ist nur dann gerechtfertigt, wenn wir durch den vorherigen Versuch etwas gelernt haben.

Wenn wir zweimal dasselbe Problem bearbeiten, ohne unseren Wissensstand zu verändern, stoppen wir die Umsetzung und überprüfen unsere Annahmen.

## Main Content

### 1. Jede Aufgabe braucht ein überprüfbares Ziel

Vor der Umsetzung werden festgehalten:

- gewünschtes Ergebnis,
- Scope,
- Erfolgskriterium,
- relevanter letzter stabiler Stand.

Ein Ziel wird so formuliert, dass später eindeutig geprüft werden kann, ob es erreicht wurde.

### 2. Eine Hypothese nach der anderen

Bei unklaren Fehlerursachen oder offenen Fragen wird jeweils eine konkrete Hypothese formuliert.

Der nächste Schritt soll diese Hypothese bestätigen oder widerlegen.

Mehrere unabhängige Änderungen gleichzeitig werden vermieden, wenn dadurch die Ursache später nicht mehr nachvollziehbar wäre.

### 3. Zwei-Versuche-Regel

Zwei erfolglose Versuche sind erlaubt, wenn sie neue Erkenntnisse liefern.

Wenn nach zwei Versuchen keine neue Erkenntnis entstanden ist, wird nicht weiter verändert.

Stattdessen wird dokumentiert:

- Was wissen wir sicher?
- Was wurde bereits versucht?
- Was wurde ausgeschlossen?
- Welche Annahme könnte falsch sein?
- Was ist der letzte nachweislich funktionierende Zustand?

Erst danach wird ein neuer Lösungsweg gewählt.

### 4. Jede Iteration muss Wissen erzeugen

Ein Versuch ist sinnvoll, wenn mindestens eines zutrifft:

- das Ziel wurde erreicht,
- eine Hypothese wurde bestätigt,
- eine Hypothese wurde widerlegt,
- eine Ursache wurde ausgeschlossen,
- neues relevantes Wissen ist entstanden.

Reine Wiederholung ohne neue Erkenntnis ist keine Iteration.

### 5. Last Known Good

Bei veränderbaren Systemen wird ein letzter nachweislich funktionierender Stand festgehalten.

Bei Fehlern wird bevorzugt gegen diesen Stand verglichen, statt weitere unkontrollierte Änderungen aufzubauen.

Ein neuer Last Known Good entsteht erst nach erfolgreicher Prüfung.

### 6. Entscheidungen werden nicht stillschweigend wieder geöffnet

Langfristig relevante Entscheidungen werden im Ordner `decisions/` dokumentiert.

Eine bestehende Entscheidung wird nur erneut diskutiert, wenn mindestens eines vorliegt:

- neue Anforderung,
- neue belastbare Information,
- nachgewiesener Nachteil,
- relevante Änderung des Umfelds.

Geschmack, Vergessen oder ein neuer Chat sind keine ausreichenden Gründe.

### 7. Projekt-Checkpoint

Länger laufende Projekte besitzen eine kompakte `PROJECT-STATE.md`.

Sie enthält mindestens:

- aktuelles Ziel,
- Last Known Good,
- verifizierten Stand,
- offene Probleme,
- bereits getestete und ausgeschlossene Wege,
- relevante Entscheidungen,
- aktiven Branch oder PR, falls vorhanden,
- nächsten sinnvollen Schritt.

Die Datei ist kein Tagebuch. Sie wird nur aktualisiert, wenn sich der relevante Projektzustand verändert.

### 8. Chat ist Arbeitsraum, Repository ist Gedächtnis

Chats dürfen zum Denken, Diskutieren und Umsetzen genutzt werden.

Langfristige Entscheidungen, Standards und Projektzustände dürfen jedoch nicht ausschließlich im Chat verbleiben.

Ein neuer Chat muss aus dem Repository den maßgeblichen Stand rekonstruieren können.

### 9. Checkpoint vor Themenwechsel

Bevor ein längerer Arbeitsstrang endet oder ein größeres neues Thema beginnt, wird geprüft, ob:

- eine Entscheidung gesichert werden muss,
- `PROJECT-STATE.md` aktualisiert werden muss,
- ein neuer Standard entstanden ist,
- offene Risiken sichtbar dokumentiert sind.

## Relationship to other documents

- `employee-operating-standard.md`
- `learning-loop.md`
- `../decisions/README.md`
- `../roles/wordpress-developer/development-standard.md`

## Future Development

Der Standard wird aus realen Projekten erweitert, wenn wiederkehrende Schleifen oder Informationsverluste neue Schutzmechanismen notwendig machen.