# Projekt: TuS Platzbelegung

## Purpose

Dieses Projekt entwickelt eine eigene WordPress-Lösung für die öffentliche und interne Darstellung der Platz- und Hallenbelegung des TuS Mingolsheim.

Die aktuelle direkte Google-Kalender-Einbettung auf der Homepage soll durch ein eigenes TuS-Plugin mit kontrollierter Datenhaltung bzw. kontrollierten Schnittstellen ersetzt werden.

Das Plugin ist Teil der öffentlichen Homepage, bleibt technisch aber ein eigenständiges Produkt mit klarer Verantwortung und eigenem Datenmodell.

## Core Principle

> **Belegung einmal pflegen, überall verständlich darstellen – ohne fremdes iframe als Kernfunktion.**

Die Platzbelegung soll zuverlässig, mobil gut nutzbar und langfristig mit Team Manager, Event Planner und Spielplandaten integrierbar sein, ohne eine zweite unkontrollierte Kalenderwelt aufzubauen.

## Main Content

### 1. Ausgangslage

Die aktuelle Homepage zeigt den Spielbetrieb über einen direkten Google-Calendar-iframe. Weitere Trainings- und Winterbelegungen werden teilweise als statische Bilder dargestellt.

Nachteile dieses Zustands:

- uneinheitliche Darstellung,
- direkte Drittanbieter-Einbindung im Browser,
- eingeschränkte mobile UX,
- statische Bilder können veralten,
- keine gemeinsame Datenlogik für Plätze, Hallen, Teams, Spiele und Veranstaltungen,
- keine saubere Grundlage für spätere Automatisierung.

### 2. Zielbild

Die Homepage erhält ein eigenes WordPress-Plugin `TuS Platzbelegung`.

Öffentliche Nutzer sehen eine moderne TuS-Oberfläche für die aktuelle und kommende Belegung von Sportflächen und Hallen.

Das Plugin soll perspektivisch mindestens unterscheiden können zwischen:

- wiederkehrenden Trainingszeiten,
- Heimspielen,
- Turnieren und Veranstaltungen,
- Sonderbelegungen,
- saisonalen bzw. Winterbelegungen,
- Sperrungen oder nicht verfügbaren Flächen.

### 3. Ressourcenmodell

Sportstätten und Ressourcen werden konfigurierbar geführt und nicht hart im Frontend programmiert.

Beispiele können sein:

- Hauptspielfeld,
- Trainingsplatz,
- Kunstrasen,
- Hallen,
- weitere zukünftig relevante Flächen.

Die finale Ressourcenliste wird aus dem realen TuS-Betrieb aufgenommen.

### 4. Belegungsobjekt

Ein Belegungseintrag benötigt mindestens ein belastbares fachliches Modell für:

- Ressource,
- Datum,
- Beginn,
- Ende,
- Typ der Belegung,
- öffentliche Bezeichnung,
- Wiederholung bzw. Serienlogik, falls relevant,
- Status,
- Quelle / Referenz,
- Sichtbarkeit.

Personenbezogene Trainer- oder Teilnehmerdaten gehören nicht automatisch in die öffentliche Platzbelegung.

### 5. Öffentliche UX

Die öffentliche Ansicht soll insbesondere unterstützen:

- heute / diese Woche,
- Auswahl nach Platz bzw. Halle,
- schnelle Erkennung frei / belegt,
- verständliche Darstellung auf Smartphone,
- Training, Spiel und Veranstaltung visuell unterscheidbar,
- klarer Zeitraum und Ort,
- keine typische WordPress-Backend-Optik.

Die genaue UI folgt dem TuS Digital Design System und dem Homepage Standard.

### 6. Pflege und Berechtigungen

Die Platzbelegung darf nicht voraussetzen, dass Ehrenamtliche im normalen WordPress-Backend arbeiten müssen.

Für spätere Pflege ist eine einfache geschützte Bedienoberfläche vorzusehen.

Berechtigungen folgen Rollenbedarf und Least Privilege.

### 7. Datenquellen und Integrationen

Vor Implementierung wird entschieden, welche Informationen im Platzbelegungs-Plugin führend sind und welche nur referenziert bzw. synchronisiert werden.

Perspektivische Integrationen:

- `Team Manager` für Mannschaften und Trainingszeiten,
- `fussball.de` bzw. kontrollierte Spielplandaten für Heimspiele,
- `Event Planner` für Veranstaltungen,
- mögliche bestehende Kalenderdaten als einmalige Migration oder kontrollierte Übergangsschnittstelle.

Wichtig:

> Das Plugin darf keine zweite manuell gepflegte Kopie von Daten erzeugen, wenn eine fachlich führende Quelle bereits existiert.

Eine mögliche Google-Kalender-Synchronisation wäre nur eine kontrollierte serverseitige Adapterlösung bzw. Übergangslösung. Der Browser lädt nicht direkt den Google-Kalender als Kernoberfläche.

### 8. Datenschutz und Informationsschutz

Öffentlich werden nur die für die Belegungsinformation notwendigen Daten gezeigt.

Standardmäßig nicht öffentlich:

- private Telefonnummern,
- private oder personengebundene E-Mail-Adressen,
- Teilnehmerlisten,
- interne Notizen,
- Zugangsdaten,
- sensible Organisationsinformationen.

Technisch sind Eingabevalidierung, Berechtigungsprüfung, CSRF-/Nonce-Schutz, Ausgabe-Escaping und angemessene Protokollierung zu berücksichtigen.

### 9. MVP

Ein erster MVP soll bewusst klein bleiben:

1. konfigurierbare Ressourcen,
2. wiederkehrende und einmalige Belegungen,
3. moderne öffentliche Wochen-/Tagesansicht,
4. mobile Darstellung,
5. einfache geschützte Pflege,
6. keine direkten Drittanbieter-iframes,
7. saubere Export-/Integrationsgrenze für spätere Automatisierung.

### 10. Bewusste Nicht-Ziele des ersten MVP

Nicht automatisch Teil von V1:

- öffentliches Buchungsportal,
- Bezahlfunktionen,
- Zutrittskontrolle,
- vollautomatische Optimierung von Trainingsplänen,
- komplexes Ressourcenmanagement für externe Vermietung,
- parallele Mitglieder- oder Mannschaftsdatenbank.

## Relationship to other documents

- `PROJECT-STATE.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../event-planner/`
- `../team-manager/`

## Future Development

Nach der Discovery wird entschieden:

1. welche Ressourcen tatsächlich geführt werden,
2. welche Quelle für Trainingsbelegungen heute existiert,
3. welche Daten aus Spielplan und Event Planner automatisch einfließen können,
4. welches minimale Datenmodell dafür genügt,
5. wie der bestehende Google-Kalender bzw. statische Belegungsbilder abgelöst werden,
6. wie die geschützte Pflegeoberfläche gestaltet wird.

Erst danach beginnt die eigentliche Plugin-Implementierung in kleinen, prüfbaren PRs.
