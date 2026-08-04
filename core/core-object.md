# Core Object

## Purpose

Dieses Dokument definiert die gemeinsamen Eigenschaften aller Core-Objekte der TuS Digital Organisation.

Es bildet die Grundlage für ein konsistentes Domänenmodell und verhindert Redundanzen.

---

## Core Principle

Jedes Core-Objekt folgt denselben grundlegenden Regeln.

Spezialisierungen ergänzen diese Eigenschaften, ersetzen sie jedoch nicht.

---

## Gemeinsame Eigenschaften

Jedes Core-Objekt besitzt:

### Identität

- eindeutige ID
- Typ
- Name oder Bezeichnung

---

### Lebenszyklus

- erstellt
- geändert
- aktiviert
- archiviert

Optional:

- gelöscht
- wiederhergestellt

---

### Verantwortlichkeit

Jedes Objekt besitzt mindestens einen Verantwortlichen.

Weitere Personen, Rollen oder digitale Mitarbeiter können beteiligt sein.

---

### Beziehungen

Jedes Objekt kann Beziehungen zu anderen Objekten besitzen.

Beziehungen sind eigenständige Domänenobjekte.

---

### Ereignisse

Jedes Objekt erzeugt fachliche Ereignisse.

Diese können Prozesse und Automatisierungen auslösen.

---

### Historie

Alle relevanten Änderungen werden nachvollziehbar gespeichert.

Die Historie dient Transparenz, Lernen und Nachvollziehbarkeit.

---

### Workspaces

Ein Objekt kann gleichzeitig Bestandteil mehrerer Workspaces sein.

Der Workspace bestimmt den fachlichen Kontext.

---

### Berechtigungen

Berechtigungen entstehen aus:

- Rolle
- Verantwortung
- Kontext

Nicht aus festen Benutzergruppen.

---

### Wissen

Jedes Objekt kann Wissen erzeugen oder mit Wissenseinträgen verbunden werden.

Dadurch wächst das Organisationswissen kontinuierlich.

---

### Kommunikation

Jedes Objekt kann Kommunikationsprozesse auslösen oder empfangen.

Beispiele:

- Benachrichtigungen
- E-Mails
- Social Media
- Dokumente
- Kommentare

---

## Relationship to other documents

Alle Core-Objekte bauen auf diesem Dokument auf.

---

## Future Development

Neue gemeinsame Eigenschaften werden ausschließlich hier ergänzt und anschließend automatisch von allen Core-Objekten übernommen.