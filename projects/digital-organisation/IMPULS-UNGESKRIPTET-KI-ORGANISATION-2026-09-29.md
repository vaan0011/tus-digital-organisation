# Quellenimpuls – {ungeskriptet} mit Dominic von Proeck: KI-Organisation und TuS OS

## Purpose

Dieses Inhaltsprotokoll hält die für den TuS relevanten Aussagen des Interviews „Was er mir über KI erzählte, hat mich schockiert“ fest und gleicht sie mit den bestehenden TuS-OS-Quellen ab. Es ist eine Auswertung der verfügbaren Transkription, kein Wortprotokoll und keine neue verbindliche Architekturentscheidung.

## Core Principle

> **Erst den Vereinsprozess und die menschliche Verantwortung klären; danach Rolle, Gedächtnis, Qualitätsprüfung und technische Ausführung passend verbinden.**

## Main Content

### Quelle und Verlässlichkeit

- Original: [{ungeskriptet} by Ben – Interview mit Dominic von Proeck](https://www.youtube.com/watch?v=8RDnKQ-cTKg), veröffentlicht am 15.07.2026, Laufzeit 2:33:36.
- Arbeitsgrundlage: [öffentliches maschinelles Transkript bei SozAI](https://sozai.app/transcript/ki-story-shocked-me/) und die Kapitel/Beschreibung auf der YouTube-Seite; abgeglichen am 29.09.2026.
- Das Transkript enthält deutliche Wortfehler und ordnet den gesamten Dialog nur einem Sprecher zu. Zeitangaben und Aussagen sind deshalb sinngemäß zu lesen; Zahlen, Studien- und Produktbehauptungen des Gastes wurden hier nicht unabhängig verifiziert. Für genaue Zitate ist das Originalvideo maßgeblich.

### Thematisches Inhaltsprotokoll

| Stelle | Aussage im Interview, sinngemäß |
|---|---|
| 22:47–32:00 | Spezialisierte, benannte KI-Kollegen geben Menschen einen klaren Ansprechpartner. Ein Versuch, viele Aufgaben über eine einzige „Super-KI“ abzudecken, führte laut Gast zu zu großer Breite. Ein unnötig komplizierter Agentenprozess wurde in einem anderen Fall wieder durch eine einfache Shoplösung ersetzt. |
| 23:26–24:11 | KI übernimmt Vorbereitung und lästige Routine. Persönliche Kommentare, Direktnachrichten und Gespräche mit Kunden hält das Unternehmen bewusst bei Menschen. |
| 50:27–56:00 | Neue KI-Rollen entstehen aus einem konkreten Engpass. Es folgen Rollenentwurf, Onboarding, Feedback und eine Erprobung. Die Qualität wird mit Angriffen auf Sicherheit, Fakten und Außenwirkung geprüft, bevor Menschen die Freigabe beurteilen. |
| 59:20–68:00 | Skills beschreiben Arbeitsweisen; rollenspezifisches Gedächtnis enthält Erfahrungen aus der Zusammenarbeit. Für Recherche, Erstellung, kritische Prüfung und Koordination werden unterschiedliche Perspektiven gebraucht. Ein einzelnes allgemeines Gedächtnis erschwert diese Trennung. |
| 70:49–79:00 | Nutzer sprechen im gewohnten Kommunikationskanal mit einer Rolle. Identität, explizite Regeln, Gedächtnis und Skills werden als eigene Bausteine gehalten; n8n setzt geeignete, bewährte Abläufe um. Einfachere Agenten werden zuerst fachlich ausprobiert. |
| 130:00–140:00 | Der Gast empfiehlt ausdrücklich, den eigenen Zweck und die schmerzhaften Arbeitsfälle zuerst zu klären. Ein kleines Team benötigt nicht dieselbe Komplexität wie sein Unternehmen. Prozesse, Qualitätsstandards und Kultur bestimmen den Nutzen stärker als die Wahl eines einzelnen Tools. |

### Abgleich mit dem aktuellen TuS OS

| Interview-Impuls | Bereits im TuS OS | Konkrete Folgerung für den TuS |
|---|---|---|
| Ansprechpartner mit begrenztem Auftrag | Rolle und konkreter Mitarbeiter sind getrennt; Runtimes haben Auftrag und Entscheidungsgrenzen. | Bestehende Rollen wie Archivist und Scouting Analyst an realen Übergaben testen, statt aus dem Podcast weitere Namen oder Abteilungen abzuleiten. |
| Gedächtnis bleibt bei der Organisation | GitHub/Drive und fachliche Register sind Sources of Truth; der [Memory Router](../../architecture/memory-router.md) lädt aufgabenbezogen Kontext. | Feedback aus Läufen an der zuständigen Quelle sichern. Ein Chatverlauf oder ein n8n-Workflow soll nicht zum einzigen Gedächtnis werden. |
| Skills und Rollen sind verschiedene Bausteine | Das TuS OS unterscheidet Rollenauftrag, Standards, Skills und Runtime. | Einen wiederverwendbaren Arbeitsschritt als Skill pflegen; den verantwortlichen Ansprechpartner als Rolle mit eigener Grenze belassen. |
| Erprobung und unabhängige Qualitätsprüfung | [Learning Loop](../../standards/learning-loop.md), [Agent Quality Loop](../../standards/agent-quality-loop.md) und das synthetische Scouting-Prüfset bestehen. | Beim Scouting zuerst Pilotbefund und fachliche Kommentare der Sportlichen Leitung auswerten, dann das Prüfset durchführen und erst danach über weitere Autonomie entscheiden. Die im Interview genannte einmonatige Probezeit ist kein TuS-Standard. |
| Technische Ausführung nach fachlicher Bewährung | Der [Runtime-Standard](../../standards/employee-runtime-standard.md) definiert Queue, Checkpoint, Stop- und Eskalationsbedingungen; n8n ist als möglicher Ausführungskanal vorgesehen. | Für einen kleinen, stabilen Lauf Trigger, erlaubte Aktion, menschliche Freigabe, Protokoll und Write-back festlegen. Erst dann einen n8n-Workflow bauen; Rollenwissen bleibt außerhalb des Workflows austauschbar. |
| Menschlicher Beziehungspunkt | [Approval & Escalation](../../standards/approval-and-escalation.md) schützt Veröffentlichung und folgenreiche externe Kommunikation. | Bei Mitgliedern, Eltern, Spielern und Partnern festlegen, wann eine Antwort persönlich sein muss. Routine kann vorbereitet werden; die Freigabegrenzen werden durch diesen Podcast nicht geändert. |
| Problem vor Werkzeug | Das [Aufbauprojekt](README.md) und sein [Projektzustand](PROJECT-STATE.md) priorisieren Vereinsnutzen, Einfachheit und reale Piloten. | Nächste Kandidaten aus wiederkehrender Belastung der Geschäftsstelle und des Ehrenamts wählen. Eine große Agentenzahl, „6–8 Direct Reports“ oder ein komplettes Plattformbild sind keine Zielgrößen für den TuS. |

### Vorschlag für den nächsten überprüfbaren Schritt

Den schon angelegten **Scouting-Piloten** als Beispiel für den Weg vom Agenten zur verlässlichen Zusammenarbeit verwenden: Quellenlage und Ergebnisqualität prüfen, die Kommentare der Sportlichen Leitung in der geschützten Tabelle auswerten, Fehlerbilder und Verbesserungsideen ohne Personendaten im TuS OS dokumentieren und anschließend das vorhandene Prüfset anwenden. Erst eine freigegebene, reproduzierbare Variante sollte als regelmäßiger n8n-Lauf konkretisiert werden. Diese Reihenfolge ist eine TuS-Ableitung aus Interview und bestehenden Standards, kein im Podcast vorgegebenes Rezept.

## Relationship to other documents

- [Projektzustand Aufbau Digitale Vereinsorganisation](PROJECT-STATE.md)
- [Bots & Bosses – menschliche Entscheidungsrollen](IMPULS-BOTS-AND-BOSSES-2026-09-29.md)
- [Second Brain Standard](../../knowledge/SECOND-BRAIN-STANDARD.md)
- [Scouting Current State](../../knowledge/scouting/CURRENT-STATE.md)
- [Agent Quality Loop](../../standards/agent-quality-loop.md)

## Future Development

Bei realen TuS-Läufen wird geprüft, welche der beschriebenen Übergaben tatsächlich helfen und welche zusätzliche Komplexität erzeugen. Nur bestätigte Erkenntnisse werden in Rolle, Runtime, Fachzustand oder Standard zurückgeschrieben. Externe Beispiele bleiben als solche gekennzeichnet.
