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
- Sperrungen oder nicht verfügbaren Flächen,
- Auslastung und freien Trainingskapazitäten je Ressource.

### 3. Ressourcenmodell

Sportstätten und Ressourcen werden konfigurierbar geführt und nicht hart im Frontend programmiert.

Verifizierte Ressourcen sind insbesondere:

- Hauptplatz,
- Trainingsfeld 1 mit Q1 und Q2,
- Trainingsfeld 2 mit Q3 und Q4,
- Kunstrasen-Kleinfeld,
- Schönbornhalle,
- Ohrenberghalle,
- externe Trainingsstätten bei Partnervereinen.

Weitere Ressourcen und echte Hallenteilflächen bleiben konfigurierbar.

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

### 5. Auslastung, Sondertermine und Sperrungen

Die Platzbelegung berechnet die Auslastung von Q1–Q4, Kunstrasen-Kleinfeld und Hallen aus definierten Verfügbarkeitszeiten, bestätigten Belegungen und Sperrungen.

Sie unterstützt insbesondere:

- Nutzungs-, Sperr- und freie Kapazität je Ressource,
- zusammenhängende freie Zeitfenster für zusätzliche Trainingsgruppen,
- Auswahl nach Außen-/Winterperiode, Woche und gewünschter Trainingsdauer,
- Hallen-Sondertermine aus gelieferten Listen mit Importvorschau,
- einmalige und wiederkehrende Sperrungen einzelner Quadranten oder übergeordneter Ressourcen,
- hierarchische Sperrwirkung von Platz zu Quadrant.

Die verbindliche Fachlogik steht in `CAPACITY-AND-BLOCKING.md`.

### 6. Öffentliche UX

Die öffentliche Ansicht soll insbesondere unterstützen:

- heute / diese Woche,
- Auswahl nach Platz bzw. Halle,
- schnelle Erkennung frei / belegt,
- verständliche Darstellung auf Smartphone,
- Training, Spiel und Veranstaltung visuell unterscheidbar,
- klarer Zeitraum und Ort,
- keine typische WordPress-Backend-Optik.

Die genaue UI folgt dem TuS Digital Design System und dem Homepage Standard.

### 7. Pflege und Berechtigungen

Die Platzbelegung darf nicht voraussetzen, dass Ehrenamtliche im normalen WordPress-Backend arbeiten müssen.

Für spätere Pflege ist eine einfache geschützte Bedienoberfläche vorzusehen.

Berechtigungen folgen Rollenbedarf und Least Privilege.

### 8. Datenquellen und Integrationen

Vor Implementierung wird entschieden, welche Informationen im Platzbelegungs-Plugin führend sind und welche nur referenziert bzw. synchronisiert werden.

Perspektivische Integrationen:

- `Team Manager` für Mannschaften und Trainingszeiten,
- `fussball.de` bzw. kontrollierte Spielplandaten für Heimspiele,
- `Event Planner` für Veranstaltungen,
- mögliche bestehende Kalenderdaten als einmalige Migration oder kontrollierte Übergangsschnittstelle.

Wichtig:

> Das Plugin darf keine zweite manuell gepflegte Kopie von Daten erzeugen, wenn eine fachlich führende Quelle bereits existiert.

Eine mögliche Google-Kalender-Synchronisation wäre nur eine kontrollierte serverseitige Adapterlösung bzw. Übergangslösung. Der Browser lädt nicht direkt den Google-Kalender als Kernoberfläche.

### 9. Datenschutz und Informationsschutz

Öffentlich werden nur die für die Belegungsinformation notwendigen Daten gezeigt.

Standardmäßig nicht öffentlich:

- private Telefonnummern,
- private oder personengebundene E-Mail-Adressen,
- Teilnehmerlisten,
- interne Notizen,
- Zugangsdaten,
- sensible Organisationsinformationen.

Technisch sind Eingabevalidierung, Berechtigungsprüfung, CSRF-/Nonce-Schutz, Ausgabe-Escaping und angemessene Protokollierung zu berücksichtigen.

### 10. MVP

Ein erster MVP soll bewusst klein bleiben:

1. konfigurierbare Ressourcen und Verfügbarkeitsfenster,
2. wiederkehrende und einmalige Belegungen,
3. einmalige und wiederkehrende Sperrungen,
4. manuelle Sondertermine und Importvorschau für eine reale Hallenliste,
5. interne Auslastungsanalyse und Suche nach freien Trainingsfenstern,
6. moderne öffentliche Wochen-/Tagesansicht,
7. mobile Darstellung,
8. einfache geschützte Pflege,
9. keine direkten Drittanbieter-iframes,
10. saubere Export-/Integrationsgrenze für spätere Automatisierung.

### 11. Bewusste Nicht-Ziele des ersten MVP

Nicht automatisch Teil von V1:

- öffentliches Buchungsportal,
- Bezahlfunktionen,
- Zutrittskontrolle,
- vollautomatische Optimierung von Trainingsplänen,
- komplexes Ressourcenmanagement für externe Vermietung,
- parallele Mitglieder- oder Mannschaftsdatenbank.

## Relationship to other documents

- `PROJECT-STATE.md`
- `CAPACITY-AND-BLOCKING.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../../knowledge/privacy/HOMEPAGE-PRIVACY-CHECK.md`
- `../../roles/wordpress-developer/role.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../event-planner/`
- `../team-manager/`

## Future Development

Als nächste Discovery-Schritte werden die Verfügbarkeitsrahmen je Ressource, die reale Hallen-Sonderterminliste, Berechtigungen für Sperrungen und die Übergangsdaten aus dem heutigen Kalender aufgenommen. Danach entsteht das in `CAPACITY-AND-BLOCKING.md` definierte kleine, testbare Inkrement in einem eigenen Pull Request.
