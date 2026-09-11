# OpenCode-Arbeitsplatz – Mathias / WordPress Developer

## Purpose

Dieses Dokument beschreibt den lokalen OpenCode-Arbeitsplatz für Mathias, den WordPress Developer der TuS Digital Organisation.

Ziel ist ein einfacher Einstieg: Repository lokal öffnen, KI-Modell verbinden und aus dem aktuellen TuS-OS, Projektzustand und Quellcode arbeiten.

## Core Principle

> **OpenCode ist der Arbeitsplatz. Mathias ist die Rolle. GitHub bleibt die Source of Truth.**

Der verwendete Modellanbieter ist austauschbar. Die Arbeitsweise von Mathias darf nicht davon abhängen, ob unter OpenCode GPT, Claude oder ein anderer geeigneter Coding-Provider verwendet wird.

## Main Content

### 1. Repository-Konfiguration

Der Arbeitsplatz besteht aus drei OpenCode-spezifischen Einstiegspunkten:

- `/AGENTS.md` – organisationsweite Coding-Regeln und Routing in das TuS-OS,
- `/.opencode/agents/mathias.md` – Mathias als spezialisierter primärer Coding-Agent,
- `/opencode.jsonc` – setzt `mathias` als Standard-Agent für dieses Repository.

Die fachliche Wahrheit wird dadurch nicht dupliziert. Mathias liest weiterhin die bestehenden Rollen-, Standard-, Architektur- und Projektdateien.

### 2. Lokale Inbetriebnahme

Einmalig auf dem Entwicklungsrechner:

1. OpenCode Desktop bzw. die gewünschte OpenCode-Oberfläche installieren.
2. Einen unterstützten KI-Modellprovider in OpenCode verbinden.
3. Das Repository `vaan0011/tus-digital-organisation` lokal klonen bzw. aktualisieren.
4. Den Root-Ordner `tus-digital-organisation` in OpenCode als Projekt öffnen.
5. Neue Session starten.
6. Prüfen, dass `mathias` als Agent ausgewählt ist.

Es ist kein separater Mathias-Login und kein eigenes KI-Modell erforderlich.

### 3. Typischer Start eines Entwicklungsauftrags

Nach dem Öffnen genügt ein konkreter Auftrag, zum Beispiel:

- `Arbeite am Projekt Platzbelegung weiter. Lies zuerst deinen Bootstrap und den aktuellen PROJECT-STATE.`
- `Prüfe den Event Planner gegen den aktuellen Projektstand und schlage den kleinsten nächsten Entwicklungsschritt vor.`
- `Implementiere den nächsten freigegebenen Schritt der MatchCard-Integration und bereite einen PR vor.`

Mathias lädt daraus selbst die relevante Projektdokumentation und den Code.

### 4. Kein produktiver WordPress-Zugriff

Der lokale OpenCode-Arbeitsplatz gibt Mathias nicht automatisch Zugriff auf die Live-Homepage.

Aktuell entwickelt er aus:

- GitHub,
- lokalem Quellcode,
- WordPress Playground bzw. anderen lokalen/Test-Umgebungen,
- bereitgestellten Screenshots, Exporten oder Testdaten.

Produktive Backend-Arbeit erfolgt erst später gemeinsam mit einer autorisierten Person mit entsprechendem Zugriff.

### 5. Git und Pull Requests

Zielworkflow:

`Auftrag → Bootstrap → PROJECT-STATE → Code → Tests → Branch → PROJECT-STATE aktualisieren → PR → menschliche Freigabe`

Zu Beginn kann GitHub Desktop oder normales Git für Push/PR verwendet werden. Eine weitergehende OpenCode-GitHub-Automation ist optional und wird erst aktiviert, wenn der lokale Mathias-Workflow zuverlässig funktioniert.

### 6. Modellwahl

Im Repository wird bewusst kein Modell fest vorgegeben.

Damit kann später je nach Aufgabe ein geeigneter Provider bzw. ein anderes Coding-Modell verwendet werden, ohne Rolle, Projektwissen oder Arbeitsstandard von Mathias neu aufzubauen.

Bewertet werden soll das Modell nach:

- Qualität bei bestehendem PHP-/WordPress-Code,
- zuverlässigem Lesen großer Repositories,
- Test- und Debuggingfähigkeit,
- Einhaltung von Projektgrenzen,
- Qualität von kleinen, reviewbaren Änderungen,
- Kosten und Geschwindigkeit.

### 7. Sicherheitsgrenzen

Nicht in OpenCode-Konfiguration oder Repository speichern:

- produktive WordPress-Passwörter,
- IONOS-/SMTP-Zugangsdaten,
- API-Keys,
- personenbezogene Exporte,
- Datenbank-Dumps mit Produktivdaten,
- sonstige Secrets.

Lokale Zugangsdaten werden nur über dafür geeignete lokale Secret-/Providermechanismen verwaltet.

## Relationship to other documents

- `../../AGENTS.md`
- `../../.opencode/agents/mathias.md`
- `../../opencode.jsonc`
- `../../roles/wordpress-developer/START-PROMPT.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../architecture/memory-router.md`
- `../../projects/README.md`

## Future Development

Nach erfolgreichem Pilotbetrieb können ergänzt werden:

- spezialisierte Review-/Test-Subagents,
- projektspezifische verschachtelte `AGENTS.md`, falls ein Projekt dauerhaft eigene Coding-Regeln benötigt,
- GitHub-Issue-/PR-Automation,
- zusätzliche lokale Test- und Quality-Gates.

Diese Erweiterungen werden erst eingeführt, wenn sie einen realen Nutzen gegenüber dem einfachen Mathias-Workflow zeigen.
