# Project Portfolio Working Standard

## Purpose

Dieser Standard definiert, wie relevante TuS-Projekte und Vorhaben organisationsweit sichtbar, aktuell und widerspruchsfrei gehalten werden.

## Core Principle

Das Portfolio ist ein Navigationssystem, kein zweites Projektmanagement-System.

> **Details bleiben im Projekt. Überblick bleibt im Portfolio.**

## Main Content

### 1. Projektquellen zuerst lesen

Vor einer Portfolio-Aktualisierung werden die vorhandenen Projektquellen geprüft, insbesondere:

- `PROJECT-STATE.md`,
- `README.md`,
- `FUNCTIONAL-SCOPE.md`, wenn relevant,
- relevante ADRs,
- fachliche Wissensdokumente.

Der Portfolio Manager erfindet keinen Status aus Ordnernamen oder Chatgefühl.

### 2. Portfoliokategorien

Ein Vorhaben wird einer der folgenden Kategorien zugeordnet:

- `Kandidat` – relevantes Vorhaben, aber Projektstatus/Scope/Owner noch nicht ausreichend geklärt,
- `Discovery` – Problem, Zielbild oder Machbarkeit werden aktiv geklärt,
- `Geplant` – Scope und nächster Startschritt sind ausreichend klar, Umsetzung noch nicht aktiv,
- `Aktiv` – konkrete Umsetzung läuft,
- `Blockiert` – Fortschritt hängt an einer klaren ungelösten Abhängigkeit,
- `Pausiert` – bewusst zurückgestellt,
- `Abgeschlossen` – Ziel erreicht und Übergabe/Abschluss dokumentiert,
- `Verworfen` – bewusst nicht weiterverfolgt; Begründung bleibt nachvollziehbar.

Statuswerte werden nicht allein geändert, um Fortschritt besser aussehen zu lassen.

### 3. Minimale Portfolioinformationen

Für jedes formale Projekt werden zentral nur folgende Informationen geführt:

- Projektname,
- Verantwortungsbereich / fachlicher Owner,
- Portfolio-Status,
- verbindliche Detailquelle,
- aktueller nächster Schritt oder Meilenstein,
- wesentliche Abhängigkeit / Blockade,
- relevante Querschnittsrollen, wenn nötig.

Detaillierte Aufgabenlisten, Chronologien oder vollständige Projektbeschreibungen gehören nicht ins zentrale Portfolio.

### 4. Projektaufnahme

Ein neues formales Projekt wird nur aufgenommen, wenn ein konkretes Vorhaben existiert.

Vor Anlage eines neuen Projektordners wird geprüft:

- existiert bereits ein fachlich gleiches oder stark überlappendes Projekt?
- ist das Vorhaben mehr als eine einzelne Aufgabe?
- gibt es ein klares Ziel oder Problem?
- ist ein verantwortlicher Bereich erkennbar?
- braucht das Vorhaben einen eigenen dauerhaften Projektzustand?

Wenn diese Fragen noch nicht ausreichend beantwortet sind, bleibt das Vorhaben zunächst `Kandidat`.

### 5. Projektordner

Ein relevantes formales Projekt unter `projects/` besitzt mindestens:

- `README.md` – dauerhafter Zweck und fachlicher Rahmen,
- `PROJECT-STATE.md` – aktueller operativer Zustand.

Zusätzliche Dokumente wie `FUNCTIONAL-SCOPE.md`, Architektur-, Finanzierungs- oder Designunterlagen entstehen nur bei echtem Bedarf.

### 6. PROJECT-STATE bleibt Detailquelle

Der `PROJECT-STATE.md` enthält den aktuellen fachlichen und operativen Projektstand.

Das Portfolio verweist darauf und kopiert ihn nicht.

Wenn Portfolio und Projektzustand widersprechen, wird die Ursache geklärt; es wird nicht stillschweigend eine dritte Wahrheit erzeugt.

### 7. Aktualitätsprüfung

Ein Projektzustand ist prüfbedürftig, wenn beispielsweise:

- aktive Arbeit im Repository stattfindet, aber der nächste Schritt veraltet wirkt,
- ein PR oder relevanter Beschluss den dokumentierten Stand verändert hat,
- ein Projekt als aktiv geführt wird, aber keine erkennbare Fortsetzung existiert,
- ein Projekt eine Abhängigkeit gelöst hat, aber weiterhin als blockiert geführt wird,
- andere Rollen bereits mit einem veralteten Projektstand arbeiten.

Der Portfolio Manager fordert bzw. erstellt keine künstlichen Statusupdates ohne reale Zustandsänderung.

### 8. Überschneidungen

Werden zwei Vorhaben mit stark überlappendem Zielbild erkannt, wird dies im Portfolio sichtbar markiert.

Vor weiterer paralleler Umsetzung ist zu klären:

- sind es wirklich zwei Produkte/Projekte,
- ist eines Teil des anderen,
- sollen sie zusammengeführt werden,
- oder ersetzt eines das andere?

Der Portfolio Manager entscheidet diese fachliche Frage nicht allein, sorgt aber dafür, dass sie nicht unsichtbar bleibt.

### 9. Abhängigkeiten

Relevante Abhängigkeiten werden nur dann im Portfolio geführt, wenn sie den nächsten sinnvollen Schritt beeinflussen.

Typische Beispiele:

- Architekturentscheidung,
- Budget/Freigabe,
- Förderentscheidung,
- Genehmigung,
- externe Datenquelle,
- andere TuS-Projekte,
- Design-/Content-Zulieferung,
- rechtliche/steuerliche Prüfung.

### 10. Zusammenarbeit mit Funding & Grants

Der Funding & Grants Manager verwendet das Portfolio als zentrale Quelle für reale TuS-Vorhaben.

Der Project Portfolio Manager markiert deshalb Projekte oder Kandidaten mit möglichem Förderbezug, ohne selbst Förderfähigkeit zu behaupten.

### 11. Zusammenarbeit mit Partnership Manager

Projekte mit relevantem Finanzierungs-, Aktivierungs- oder Partnerpotenzial können an Sponsoring/Partnerships verknüpft werden.

Der Project Portfolio Manager entscheidet nicht, welches Partnerangebot entsteht.

### 12. Projektabschluss

Vor Status `Abgeschlossen` wird geprüft:

- Ziel bzw. vereinbarter Scope erreicht oder bewusst beendet,
- offene Restpunkte transparent,
- relevante Ergebnisse/Assets/Entscheidungen dauerhaft abgelegt,
- ggf. Betrieb/Verantwortung übergeben,
- Lernpunkte gesichert, wenn organisationsweit relevant.

### 13. Keine versteckten Projekte

Wenn eine Rolle über mehrere Arbeitsschritte an einem dauerhaften relevanten Vorhaben arbeitet, das andere Bereiche betrifft oder auf das später zurückgegriffen werden muss, prüft der Portfolio Manager, ob es als Projekt/Kandidat sichtbar werden sollte.

Wichtige Vorhaben sollen nicht nur als lange Chatverläufe existieren.

## Relationship to other documents

- `role.md`
- `../../projects/README.md`
- `../../projects/PROJECT-PORTFOLIO.md`
- `../../standards/iteration-and-progress.md`
- `../../standards/learning-loop.md`
- `../../decisions/ADR-0002-project-state-and-last-known-good.md`

## Future Development

Der Standard wird erst erweitert, wenn reale Portfolioarbeit neue wiederkehrende Probleme zeigt. Ziel bleibt minimale Pflege bei maximaler Orientierung.