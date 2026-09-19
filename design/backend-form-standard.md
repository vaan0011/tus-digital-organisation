# Backend Form Standard

## Purpose

Dieser Standard definiert die gemeinsame Form-Sprache für interne WordPress-Backend-Oberflächen der TuS Digital Organisation.

Ziel ist, dass Nutzer beim Anlegen und Bearbeiten derselben fachlichen Einheit nicht zwei unterschiedliche Bedienmuster lernen müssen.

Die konkreten wiederverwendbaren UI-Bausteine – Buttons, Icon-Aktionen, Eingabefelder, Karten, Statuskacheln, Hinzufügen-Muster, aufklappbare Blöcke und Sortierregeln – sind ergänzend im `backend-ui-component-standard.md` definiert.

## Core Principle

**Anlegen und Bearbeiten derselben Fachentität verwenden dieselbe Form-Sprache.**

Feldanzahl, Feldnamen und fachliche Aktionen dürfen sich unterscheiden. Karten, Feldgruppen, Labels, Abstände, Eingabehöhen, Buttons, Typografie und Interaktionsmuster bleiben jedoch konsistent, solange kein fachlicher Grund dagegen spricht.

## Main Content

### 1. Gemeinsame Form-Sprache

Für Create- und Edit-Ansichten derselben Fachentität gelten gemeinsam:

- gleiche Karten- und Containerlogik,
- gleiche Feldgruppen und visuelle Hierarchie,
- gleiche Label-Typografie,
- gleiche Eingabefeld-Höhen und Abstände,
- gleiche Primär-/Sekundärbutton-Logik,
- gleiche Checkbox-, Upload- und URL-Muster,
- gleiche Responsive-Regeln,
- gleiche Fokus- und Accessibility-Regeln.

Unterschiede entstehen nur aus dem fachlichen Kontext, nicht aus einer separaten Styling-Implementierung.

### 2. Wiederverwendung vor Duplizierung

Bestehende, verifizierte UI-Komponenten werden wiederverwendet.

Wenn `Anlegen` und `Bearbeiten` dieselben Feldtypen oder Gruppen verwenden, sollen dieselben CSS-Klassen, Komponenten und Bedienmuster genutzt werden. Eine zweite nahezu identische Form-Implementierung wird vermieden.

Die konkrete Ausprägung dieser Komponenten richtet sich nach `backend-ui-component-standard.md`.

### 3. Informationshierarchie

Ein Bearbeitungsscreen darf übergeordnete Status- oder Fortschrittsinformationen vor den eigentlichen Bearbeitungscontainern zeigen.

Für operative Arbeitsoberflächen gilt:

1. übergeordneter Status / Fortschritt,
2. kompakter Überblick über die bearbeitbaren Fachbereiche,
3. aufgeklappte Detailbearbeitung,
4. nachgelagerte operative Container.

Damit bleibt der Gesamtzustand sichtbar, auch wenn einzelne Bereiche bearbeitet werden.

### 4. Formgruppen

Zusammengehörige Felder werden in klar benannten Gruppen dargestellt.

Für breitere Desktopansichten dürfen zwei Spalten genutzt werden, wenn dies die fachliche Gruppierung verbessert. Auf kleinen Displays erfolgt Reflow auf eine Spalte.

Einzelne Felder werden nicht nur zur optischen Füllung nebeneinander gestellt.

### 5. Wiederholbare Einträge

Wiederholbare Datensätze wie Sponsoren, Ansprechpartner oder ähnliche fachliche Einträge werden als strukturierte Zeilen oder Container dargestellt.

Jeder Eintrag besitzt klar getrennte Felder und eindeutige Aktionen. Große unstrukturierte Sammel-Textfelder sind für dauerhaft einzeln bearbeitbare Daten nicht vorgesehen.

### 6. Persistenz

Die einheitliche Form-Sprache ändert nichts an der Datenhaltungsregel:

- dauerhaft relevante Fachdaten werden persistent gespeichert,
- flüchtiger UI-Zustand darf nur Darstellung und Interaktion steuern,
- Create und Edit verwenden dieselbe fachliche Source of Truth,
- ein UI-Umbau darf keine zweite Datenquelle erzeugen.

### 7. Referenzimplementierung

Der Event Planner ist die erste Referenzimplementierung dieses Musters:

- `Neues Event anlegen` definiert die Form-Sprache,
- `Event bearbeiten` verwendet dieselben Formkomponenten und dieselbe visuelle Hierarchie wieder,
- unterschiedliche Felder oder Aktionen ändern nicht das Grunddesign.

## Relationship to other documents

- `ui-standard.md`
- `backend-ui-component-standard.md`
- `design-principles.md`
- `../projects/event-planner/EVENT-FORM-UI.md`
- `../projects/event-planner/EVENT-EDIT-UI.md`
- `../projects/event-planner/DATA-PERSISTENCE.md`

## Future Development

Wenn sich dieses Muster in weiteren Backend-Modulen bewährt, werden zusätzliche wiederverwendbare Komponenten nur dann standardisiert, wenn sie mehrfach praktisch benötigt werden.
