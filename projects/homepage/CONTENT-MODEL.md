# Homepage Content Model

## Purpose

Dieses Dokument legt fest, welche Homepage-Inhalte in WordPress Core gepflegt werden und welche aus fachlich führenden Plugins oder externen Quellen stammen.

Es verhindert, dass das neue Theme oder die Startseite zu einer zweiten Datenbank für Vereinsinformationen wird.

## Core Principle

> **Redaktionelle Inhalte werden in WordPress gepflegt. Fachdaten werden im zuständigen Fachsystem gepflegt. Das Theme stellt beides dar.**

## Main Content

### 1. Inhaltsklassen

#### Redaktioneller Content

Redaktionelle Inhalte sind Texte, Bilder und Links, die bewusst für die Website erstellt werden. Sie werden mit WordPress-Core-Mitteln gepflegt.

#### Fachlicher Content

Fachlicher Content besitzt eine eigene operative Quelle, zum Beispiel Spiel, Mannschaft, Veranstaltung, Partner oder Belegung. Er wird nicht zusätzlich als freier Seitentext gepflegt.

#### Externe Referenz

Ein externer Link wie Shop, Facebook oder FUSSBALL.DE bleibt eine Referenz. Die URL wird zentral gepflegt und nicht in vielen Templates dupliziert.

### 2. Verbindliche Zuordnung

| Inhalt | WordPress-Modell | Führende Quelle | Pflegeprinzip |
|---|---|---|---|
| Startseiten-Hero | Startseite mit Core Blocks | WordPress | Text, Bild und CTAs redaktionell; Layout aus Theme Pattern |
| Schnelleinstiege | Core Blocks auf der Startseite | WordPress | zielorientierte Links; keine Theme-Konstanten |
| Nachrichten / Spielberichte | `post` | WordPress | Titel, Inhalt, Auszug, Beitragsbild, Kategorie, Datum |
| Statische Vereinsseiten | `page` | WordPress | dauerhafte Inhalte und Downloads |
| Abteilungen | hierarchische `page` unter `Abteilungen` | WordPress | Titel, Auszug, Beitragsbild, Inhalt; Grid dynamisch erzeugt |
| Haupt-/Service-/Social-Navigation | WordPress Navigation | WordPress | zentral, nicht im Theme hardcodiert |
| Shop-Link | WordPress Service-Navigation | WordPress | eine zentrale externe URL |
| Facebook / Instagram | WordPress Social-/Service-Navigation | WordPress | Links statt automatischer Drittanbieter-Embeds |
| Jubiläumsmagazin | Magazinseite + Media/PDF | WordPress | Cover, Einführung, Online-Lesen-/Download-Link redaktionell |
| Nächste Spiele | dynamischer Fachblock | FUSSBALL.DE + Team-Mapping | keine manuelle Spielpflege |
| Mannschaftsseiten | dynamischer Fachinhalt | Team Manager | saisonale Mannschaftsdaten zentral |
| Veranstaltungen | dynamischer Fachblock | Event Planner | einmal pflegen, mehrfach ausgeben |
| Platzbelegung | dynamischer Fachblock / eigene Ansicht | TuS Platzbelegung | keine iframe-/Bild-Doppelpflege |
| Partner | dynamischer Fachblock | künftige Partnerdatenquelle | Übergang nur kontrolliert redaktionell |
| Vereinskennzahlen | zentrale Plugin-Konfiguration | Homepage Components | ein Wert je Kennzahl, mehrfach darstellbar |
| Kontaktwege | Rollen-/Kontaktkonfiguration | freigegebene TuS-Rollenpostfächer | keine personengebundenen Templatewerte |
| Impressum / Datenschutz / Satzung | `page` | WordPress + fachliche Freigabe | vor Go-live aus realem System prüfen |

### 3. Nachrichtenmodell

Für Nachrichten bleibt der WordPress-Beitrag ausreichend.

Pflicht beziehungsweise empfohlene Felder:

- Titel,
- Inhalt,
- Veröffentlichungsdatum,
- Beitragsbild mit Alt-Text,
- redaktioneller Auszug,
- Kategorie,
- Autor-/Redaktionszuordnung intern.

Die Startseite zeigt:

- eine redaktionell priorisierte Lead Story,
- weitere aktuelle Beiträge,
- Link `Alle Nachrichten`.

Für die Priorisierung werden zunächst native WordPress-Mittel wie Sticky Posts oder eine klar dokumentierte Kategorie verwendet. Ein eigenes News-Datenmodell entsteht nur bei nachgewiesenem Bedarf.

### 4. Abteilungsmodell

In V1 werden Abteilungen als normale WordPress-Seiten modelliert.

Gründe:

- Inhalte sind überwiegend redaktionell,
- bestehende WordPress-Seiten können kontrolliert migriert werden,
- kein zusätzlicher Custom Post Type ohne realen Bedarf,
- gute SEO- und Editor-Unterstützung durch Core.

Mindestfelder:

- Titel,
- verständlicher Kurztext/Auszug,
- Beitragsbild,
- Hauptinhalt,
- optional zentrale Kontaktrolle,
- Sichtbarkeit in Navigation beziehungsweise Homepage-Auswahl.

Die Homepage-Komponente liest freigegebene Abteilungsseiten und rendert daraus Cards. Die genaue Auswahl darf redaktionell konfigurierbar sein, ohne die Cards einzeln nachzubauen.

### 5. Jubiläumsmagazin und Publikationen

Für das aktuelle Jubiläumsmagazin wird kein eigener Custom Post Type eingeführt.

V1 verwendet:

- eine eigene Magazinseite,
- das echte Cover als Media-Asset,
- die PDF beziehungsweise einen kontrollierten Online-Lesen-Link,
- einen prominenten Startseitenblock.

Erst wenn mehrere Publikationen mit wiederkehrenden Feldern real verwaltet werden, wird ein eigenes Publikationsmodell geprüft.

### 6. Vereinskennzahlen

Kennzahlen wie Mitglieder, Kinder/Jugendliche, Trainer/Betreuer und Jubiläumsjahre werden nicht im Theme oder in mehreren Seiten hardcodiert.

V1 sieht eine kleine zentrale Konfiguration im Homepage-Components-Plugin vor:

- stabiler Kennzahlenschlüssel,
- öffentliche Bezeichnung,
- Wert,
- optional Einheit/Zusatz,
- Stand/Prüfdatum,
- Sichtbarkeit und Reihenfolge.

Eine spätere fachlich bessere Quelle kann diese Konfiguration ersetzen, ohne das Theme zu ändern.

### 7. Links und Navigationen

Folgende Linkgruppen werden zentral als WordPress-Navigation gepflegt:

- Hauptnavigation,
- Service-Navigation,
- Social/Shop,
- Footer-Rechtliches,
- bei Bedarf Abteilungsnavigation.

Templates referenzieren die Navigation; URLs werden nicht mehrfach im Theme verteilt.

### 8. Medien

- Original-TuS-Logos stammen aus `design/logo/` und werden technisch kontrolliert in das Theme übernommen.
- Vereinsfotos liegen in der WordPress-Mediathek beziehungsweise dem freigegebenen Medienprozess.
- Relevante Bilder benötigen Alt-Texte; dekorative Bilder werden entsprechend behandelt.
- Externe Bild-CDNs oder Social-Embeds werden nicht beiläufig aktiviert.
- PDF-, Cover- und Download-Links werden zentral von der jeweiligen Seite referenziert.

### 9. Kontakte

Öffentliche Kontaktwege folgen `design/homepage-contact-architecture.md`.

Inhalte dürfen Namen und Funktionen darstellen, aber persönliche E-Mail-Adressen oder Mobilnummern werden nicht als Standardkontakt in Theme Patterns oder wiederverwendbaren Komponenten gespeichert.

### 10. Keine Theme-Daten

Nicht als Theme-Option, Theme-Mod oder PHP-Konstante speichern:

- Spieltermine,
- Mannschaftsdaten,
- Trainingszeiten,
- Events,
- Partnerstammdaten,
- Platzbelegungen,
- persönliche Kontaktdaten,
- Vereinskennzahlen,
- Shop-/Social-/Magazin-URLs, wenn WordPress sie als Content/Navigation pflegen kann.

## Relationship to other documents

- `README.md`
- `ARCHITECTURE.md`
- `FUSSBALL-DE-INTEGRATION.md`
- `../../design/homepage-standard.md`
- `../../design/homepage-contact-architecture.md`
- `../team-manager/FUNCTIONAL-SCOPE.md`
- `../event-planner/FUNCTIONAL-SCOPE.md`
- `../platzbelegung/README.md`

## Future Development

Neue Custom Post Types oder eigene Tabellen werden nur eingeführt, wenn ein realer wiederkehrender fachlicher Bedarf mit WordPress Core oder dem zuständigen Fachplugin nicht sauber abgebildet werden kann.
