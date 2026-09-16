# Event Planner – URL Input Standard

## Purpose

Dieses Dokument definiert den verbindlichen UX- und Speicherkontext für URL-Eingaben im TuS Event Planner.

## Core Principle

**Nutzer müssen bei einer normalen Webadresse nicht selbst `http://` oder `https://` voranstellen.**

Ein fachlich korrektes Ziel wie `tus-mingolsheim.de` soll ohne unnötige Browser-Validierungsbarriere eingegeben werden können.

## Main Content

### Eingabe

URL-Felder akzeptieren insbesondere:

- `tus-mingolsheim.de`
- `www.tus-mingolsheim.de`
- `https://tus-mingolsheim.de`
- `http://example.org`

Das Eingabefeld erzwingt im UI kein manuelles URL-Schema.

### Normalisierung

Vor dem dauerhaften Speichern wird die Eingabe normalisiert:

- fehlt ein Schema, wird standardmäßig `https://` ergänzt,
- beginnt die Eingabe mit `//`, wird `https:` ergänzt,
- ein bewusst eingegebenes `https://` bleibt erhalten,
- ein bewusst eingegebenes `http://` bleibt erhalten.

Für normale Weblinks werden nur `http` und `https` als dauerhafte Protokolle akzeptiert.

### Persistenz

In der Datenbank wird die normalisierte vollständige URL gespeichert. Dadurch bleiben öffentliche Links, Weiterverarbeitung und spätere Auswertungen eindeutig.

Die Regel gilt insbesondere für:

- zusätzliche Event-Links,
- Sponsor-/Partner-Webseiten,
- weitere künftige normale Weblink-Felder des Event Planners.

### UX

Die Normalisierung erfolgt möglichst bereits beim Verlassen des Feldes und spätestens beim Speichern. Die serverseitige Normalisierung bleibt dennoch verbindlich; JavaScript allein ist nicht Source of Truth.

## Relationship to other documents

- `EVENT-FORM-UI.md`
- `DATA-PERSISTENCE.md`
- `PROJECT-STATE.md`
- `../../design/ui-standard.md`

## Future Development

Falls später andere URI-Typen wie E-Mail-, Telefon- oder spezielle App-Links benötigt werden, werden diese bewusst als eigener Feldtyp definiert und nicht stillschweigend unter diesen Web-URL-Standard gemischt.
