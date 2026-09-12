# Stabilität und Einfachheit

## Purpose

Dieses Dokument beschreibt die Grundsätze für eine stabile, robuste und langfristig wartbare Architektur der TuS Digital Organisation.

Die Plattform soll schlank bleiben und dennoch komplexe Vereinsarbeit wirkungsvoll unterstützen.

---

## Core Principle

Die Plattform wird so einfach wie möglich und nur so komplex wie nötig entwickelt.

Mächtigkeit entsteht nicht durch viele Systeme, Tabellen oder Benutzeroberflächen, sondern durch klare Core-Objekte, bedeutungsvolle Beziehungen und kontextbezogene Nutzung gemeinsamer Informationen.

> **Wir bauen für den realen TuS-Bedarf – nicht für hypothetische Enterprise-Szenarien.**

Robustheit entsteht durch klare Zuständigkeiten, gute Datenmodelle, sichere Fehlerpfade und kontrollierte Erweiterbarkeit; nicht durch vorsorglich eingebaute Komplexität.

---

## Main Content

### Eine fachliche Quelle der Wahrheit

Jede Information besitzt genau eine fachlich verantwortliche Quelle.

Informationen werden nicht unabhängig in mehreren Plugins, Tabellen oder Dateien gepflegt.

Andere Bereiche greifen über Beziehungen und definierte Schnittstellen auf dieselbe Information zu.

### Logische Einmaligkeit statt technischer Einmaligkeit

Eine Information kann technisch mehrfach vorhanden sein, wenn dies für Backups, Zwischenspeicherung, Suche oder Ausfallsicherheit erforderlich ist.

Diese technischen Kopien dürfen jedoch keine eigenständigen Pflegequellen darstellen.

Es muss jederzeit eindeutig sein, welche Quelle fachlich maßgeblich ist.

Caches und technische Kopien müssen aus der führenden Quelle regenerierbar sein.

### Wenige stabile Core-Objekte

Die Plattform basiert auf einer begrenzten Anzahl stabiler Core-Objekte.

Neue Anforderungen werden bevorzugt durch:

- Beziehungen
- Fähigkeiten
- Ereignisse
- Kontexte
- Ansichten

abgebildet und nicht automatisch durch neue Tabellen, Plugins oder Systeme.

### Klare Verantwortung der Komponenten

Jede technische Komponente besitzt eine klar abgegrenzte Aufgabe.

Beispiele:

- Datenbank für strukturierte Domänendaten
- Objektspeicher für Bilder, Videos und Dateien
- Git für Dokumentation und Entwicklung
- n8n für Automatisierungen
- WordPress oder andere Frontends für Benutzeroberflächen

Keine Komponente soll Aufgaben übernehmen, für die bereits eine andere Komponente verantwortlich ist.

Die konkreten Regeln für dauerhafte Daten, Sessions, Tabellen und Migrationen stehen in `../standards/data-persistence-and-database-standard.md`.

### Oberflächen folgen der Domäne

Benutzeroberflächen und UI-Flows bestimmen nicht das Datenmodell.

Sie stellen lediglich kontextbezogene Ansichten auf bestehende Objekte und Beziehungen bereit.

Die Oberfläche darf ausgetauscht werden, ohne dass sich das fachliche Modell ändern muss.

### Robustheit vor Funktionsfülle

Neue Funktionen werden nur ergänzt, wenn sie einen klaren Nutzen schaffen und die Stabilität der Plattform nicht gefährden.

Bevorzugt werden:

- einfache Abläufe
- nachvollziehbare Zuständigkeiten
- geringe Abhängigkeiten
- wiederverwendbare Komponenten
- kontrollierte Erweiterungen
- klare Fehlerbehandlung
- sichere Wiederherstellung

Die konkrete Qualitätsbasis für Security, Accessibility, Responsive, Performance, Fehlerbehandlung, Tests und Entwicklungsökonomie steht in `../standards/software-development-quality-standard.md`.

### Schlankheit vor vorsorglicher Komplexität

Eine Architekturentscheidung muss ihre zusätzliche Komplexität rechtfertigen.

Daher gilt:

- keine Microservice-/Queue-/API-Schicht nur für theoretische spätere Skalierung,
- keine eigene Tabelle, wenn ein bestehendes robustes Datenmodell den Bedarf sauber erfüllt,
- keine zusätzliche Datenkopie ohne klaren Zweck,
- keine dauerhaften Hintergrundprozesse ohne realen fachlichen Trigger,
- keine große Bibliothek für eine kleine native Funktion,
- keine Generalisierung, bevor mindestens ein realer Wiederverwendungsfall erkennbar ist,
- keine Optimierung für Größenordnungen, die beim TuS derzeit nicht plausibel sind.

Erweiterbarkeit bedeutet, eine saubere Grenze und einen verständlichen nächsten Ausbaupunkt zu hinterlassen. Erweiterbarkeit bedeutet nicht, alle später denkbaren Fälle heute schon zu implementieren.

### Ressourcen folgen dem realen Bedarf

CPU, Speicher, Datenbankzugriffe, Netzwerk, externe API-Aufrufe, CI-Läufe, Automationsfrequenzen und KI-/Agent-Laufzeit sind Ressourcen.

Ihre Nutzung wird proportional zum realen Nutzen gestaltet.

- Ereignis-/Trigger-basierte Abläufe werden bevorzugt, wenn sie unnötiges Polling vermeiden.
- Polling wird nur so häufig ausgeführt, wie sich die zugrunde liegende Information sinnvoll ändern kann.
- Daten werden bedarfsgerecht geladen statt vorsorglich vollständig.
- Caching wird dort eingesetzt, wo es nachweisbar wiederholte Arbeit reduziert; nicht als Ersatz für ein sauberes Datenmodell.
- Entwickler- und Agentenläufe enden, wenn das vereinbarte Ergebnis belastbar erreicht ist.

Ressourcenschonung darf keine Security-, Datenintegritäts-, Accessibility- oder Robustheitsanforderung aushebeln.

### Keine unnötigen Integrationen

Eine Integration wird nur eingeführt, wenn ihr Nutzen größer ist als die dadurch entstehende Abhängigkeit und Wartungslast.

Direkte Punkt-zu-Punkt-Verbindungen zwischen vielen Systemen sollen vermieden werden.

Kommunikation erfolgt bevorzugt über gemeinsame Objekte, Schnittstellen und fachliche Ereignisse.

### Ausfallsicherheit

Kritische Informationen müssen durch Backups, Versionierung und nachvollziehbare Historien geschützt werden.

Der Ausfall einer einzelnen Oberfläche oder Automatisierung darf nicht zum Verlust des Organisationswissens führen.

---

## Relationship to other documents

- `platform-architecture.md`
- `knowledge-graph.md`
- `object-lifecycle.md`
- `../standards/software-development-quality-standard.md`
- `../standards/data-persistence-and-database-standard.md`
- `../core/core-object.md`
- `../core/core-principles.md`

---

## Future Development

Die Qualitäts- und Persistenzgrundregeln sind organisationsweit definiert. Weiter auszubauen sind vor allem die betrieblichen Standards für:

- Backup und Wiederherstellung,
- Monitoring/Observability,
- technische Redundanz,
- Ausfallszenarien,
- Incident-/Recovery-Abläufe,
- minimale produktive Betriebsarchitektur.

Diese Betriebsstandards werden aus realen Produkt- und n8n-/WordPress-Betriebserfahrungen konkretisiert und nicht vorsorglich übermodelliert.