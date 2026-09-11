# Homepage Privacy Check – TuS Mingolsheim

## Purpose

Dieses Dokument hält den ersten belastbaren Datenschutz- und Informationsschutz-Check der aktuellen öffentlichen TuS-Homepage sowie die verbindlichen Privacy-by-Design-Anforderungen für den geplanten Neuaufbau fest.

Es ist zugleich Handoff für den WordPress Developer. Es ersetzt keine technische Browser-/Cookie-Forensik und keine Rechtsberatung. Aussagen über tatsächlich aktive Plugins, Cookies, Tracking-Skripte oder Hosting-Komponenten gelten erst nach technischer Verifikation als bestätigt.

Stand der öffentlichen Prüfung: 11.09.2026.

## Core Principle

> **Die neue TuS-Homepage soll möglichst ohne unnötiges Tracking, unnötige Drittanbieteraufrufe und unnötige personenbezogene Datenspeicherung funktionieren.**

Wenn eine Funktion auch ohne personenbezogene Drittverarbeitung sinnvoll gebaut werden kann, wird diese Variante bevorzugt.

Ein Cookie-Banner ist kein Qualitätsmerkmal. Die bevorzugte Lösung ist eine Website, die für ihre Kernfunktionen möglichst keine einwilligungsbedürftigen Tracking- oder Drittanbieter-Techniken benötigt.

## Main Content

### 1. Geprüfte Quellen

Für diesen ersten Check wurden herangezogen:

- aktuelle öffentliche Startseite `https://www.tus-mingolsheim.de/`,
- aktuelle Seite `Impressum & Datenschutz`,
- aktuelle Seite `Platzbelegung`,
- aktuelle Eltern-/Jugend- und Formularinhalte soweit für Minderjährigendaten relevant,
- `design/homepage-standard.md`,
- `projects/partner-portal/PUBLIC-PARTNER-ENTRY.md`,
- `roles/data-protection-manager/privacy-standard.md`,
- aktuelle Hinweise des LfDI Baden-Württemberg zu Vereinen, Cookies/Tracking und Drittanbieter-Einbindungen,
- § 25 TDDDG,
- aktueller Medienstaatsvertrag, insbesondere § 18 MStV.

### 2. Aktueller öffentlicher Ist-Stand – belastbare Befunde

#### 2.1 Impressum / redaktionelle Verantwortlichkeit

Die aktuelle Seite führt ein Impressum mit Vereinsdaten, Vorstand, Registerangaben und einem inhaltlich Verantwortlichen.

Der Rechtshinweis nennt jedoch noch `§ 55 Abs. 2 RStV`. Der Rundfunkstaatsvertrag wurde durch den Medienstaatsvertrag ersetzt. Für journalistisch-redaktionell gestaltete Telemedien ist heute insbesondere `§ 18 Abs. 2 MStV` relevant.

**Bewertung:** Aktualisierung erforderlich. Die konkrete finale Formulierung ist vor Veröffentlichung gegen die aktuelle Anbieterkennzeichnung zu prüfen.

#### 2.2 Bezeichnung „Datenschutzbeauftragter“

Die öffentliche Datenschutzerklärung verweist für Fragen an `datenschutz@tus-mingolsheim.de` und bezeichnet diesen Kontakt als `Datenschutzbeauftragten`.

Im TuS-OS ist jedoch ausdrücklich noch offen, ob eine formelle Benennungspflicht besteht und ob tatsächlich ein Datenschutzbeauftragter wirksam bestellt wurde.

**Bewertung:** Solange keine formelle Bestellung bestätigt ist, soll die Homepage neutral von `Datenschutzkontakt` oder `Ansprechpartner für Datenschutzfragen` sprechen. Die E-Mail-Adresse kann bestehen bleiben, sofern sie organisatorisch korrekt geroutet und geschützt ist.

#### 2.3 Google Analytics in der Datenschutzerklärung

Die aktuelle Datenschutzerklärung erklärt, die Website benutze Google Analytics, und nennt als Grundlage ein berechtigtes Interesse. Sie verweist auf Browser-Einstellungen, Browser-Plugin und Opt-Out-Cookie.

Die öffentliche Prüfung konnte **nicht verifizieren, ob Google Analytics technisch aktuell tatsächlich geladen wird**.

Daraus folgen zwei mögliche Fälle:

- **Google Analytics ist nicht mehr aktiv:** Der veraltete Abschnitt wird entfernt.
- **Google Analytics ist aktiv:** Vor weiterer Nutzung sind tatsächliche Konfiguration, Cookies/Endgerätezugriffe, Datenflüsse, Drittlandbezug, Vertragssituation und Einwilligungsmechanismus technisch und rechtlich neu zu prüfen.

Für nicht unbedingt erforderliche Speicherung bzw. Zugriffe auf Endgeräte verlangt § 25 TDDDG grundsätzlich eine vorherige Einwilligung. Der LfDI Baden-Württemberg weist für Tracking ebenfalls darauf hin, dass in der Regel vorherige, informierte und freiwillige Einwilligung erforderlich ist.

**TuS-Ziel für Homepage V1:** zunächst **kein Marketing- oder Verhaltens-Tracking**. Analytics wird nur eingeführt, wenn ein konkreter Nutzen nachgewiesen und ein eigener Privacy Check abgeschlossen ist.

#### 2.4 Cookies / Consent

Die aktuelle Datenschutzerklärung enthält einen allgemeinen Cookie-Text und verweist im Wesentlichen auf Browser-Einstellungen.

Das reicht nicht als alleinige Lösung, falls auf der Website tatsächlich nicht unbedingt erforderliche Cookies oder vergleichbare Zugriffe stattfinden.

**Zielbild:**

- nur technisch notwendige Speicherung ohne Consent,
- keine optionalen Dienste vor Einwilligung,
- wenn später eine Einwilligung nötig wird: klar, freiwillig, granular, widerrufbar und ohne unnötige Hürden,
- keine vorangekreuzten optionalen Kategorien,
- Ablehnung darf nicht künstlich erschwert werden.

Wenn die Homepage ohne einwilligungsbedürftige Dienste auskommt, wird **kein unnötiger Cookie-Banner** eingesetzt.

#### 2.5 Google Calendar auf `Platzbelegung`

Die aktuelle Seite `Platzbelegung` bindet für den Spielbetrieb einen iframe direkt von `calendar.google.com` ein.

Dadurch kann bereits beim Laden der Seite eine Verbindung zu einem externen Google-Dienst entstehen, bevor der Besucher selbst aktiv auf Google wechselt.

**Bewertung:** Prioritärer Prüf-/Umbaupunkt.

Bevorzugte Reihenfolge:

1. Daten serverseitig bzw. über eine freigegebene Schnittstelle übernehmen und im TuS-Frontend selbst darstellen, oder
2. lokale Vorschau mit bewusster Zwei-Klick-/Freigabelösung, wenn eine echte Einbettung fachlich erforderlich bleibt.

Ein direkt beim Seitenaufruf ladender Drittanbieter-iframe ist nicht das Zielbild der neuen Homepage.

#### 2.6 Externe Bild-/CDN-Aufrufe

Auf der aktuellen Platzbelegungsseite werden Bildressourcen von `i0.wp.com` referenziert.

Damit ist mindestens ein externer Ressourcenabruf sichtbar. Ob und in welchem Umfang WordPress.com-/Jetpack-CDN-Funktionen auf weiteren Seiten genutzt werden, ist technisch noch zu inventarisieren.

**Zielbild:** Vereinsbilder, Logos und andere normale Homepage-Assets werden bevorzugt kontrolliert selbst bzw. über einen bewusst freigegebenen Hosting-/CDN-Weg ausgeliefert. Ein externer CDN-Dienst wird nicht beiläufig über Theme-/Plugin-Defaults aktiviert.

#### 2.7 Social Media

Auf der aktuellen Startseite sind Facebook und Instagram als normale externe Links erkennbar. Das ist datenschutzseitig deutlich einfacher als ein automatisch ladender Social Feed.

Der geplante Homepage-Standard sieht perspektivisch Instagram-Inhalte vor.

**Privacy-by-Design-Regel:** Kein direkter Instagram-/Facebook-Embed, der beim Seitenaufruf ungefragt Drittanbieterressourcen lädt.

Bevorzugt:

- lokal gepflegte bzw. serverseitig kontrolliert übernommene Teaser mit Link zum Original, oder
- bewusste Zwei-Klick-/Consent-Lösung, falls eine echte Einbettung später fachlich begründet wird.

#### 2.8 Minderjährige, Fotos und Sportinhalte

Die Homepage enthält umfangreiche Jugendinformationen und verweist auf Spielerpass-/Passfoto-Prozesse. Spielberichte, Mannschaftsinhalte und Fotos können Namen und Bilder von Kindern und Jugendlichen enthalten.

Für den Neuaufbau gilt deshalb:

- Veröffentlichungsprozesse für Minderjährige werden nicht pauschal aus Erwachsenenprozessen übernommen,
- Foto-/Video- und Namensveröffentlichungen benötigen einen nachvollziehbaren fachlichen Prozess,
- Lösch-/Widerspruchs- bzw. Widerrufsfälle müssen praktisch bearbeitbar sein,
- keine sensiblen Entwicklungs-, Gesundheits-, Familien- oder Schutzinformationen auf öffentlichen Mannschaftsseiten,
- der Kinder- und Jugendschutzstandard bleibt für Schutzfälle vorrangig.

Dies bedeutet nicht, dass jede Veröffentlichung im Sport automatisch eine Einwilligung benötigt; die konkrete Rechtsgrundlage und Interessenabwägung muss zum jeweiligen Veröffentlichungstyp passen.

### 3. Verbindliche Privacy-by-Design-Regeln für die neue Homepage

#### 3.1 Grundarchitektur

Die Homepage stellt fachlich führende Daten möglichst **im eigenen TuS-Frontend** dar und lädt nicht für jede Funktion einen externen iframe.

Bevorzugtes Muster:

`Fachquelle → kontrollierte serverseitige Schnittstelle / Adapter → TuS-Frontend`

statt:

`Browser des Besuchers → Drittanbieter-iframe / Drittanbieter-Skript`

#### 3.2 Nächste Spiele / fussball.de

Für `MatchCard` und Spielinformationen gilt:

- keine zweite manuelle Spielplan-Datenbank,
- möglichst serverseitige bzw. kontrollierte Übernahme der notwendigen öffentlichen Spieldaten,
- keine Drittanbieter-Einbettung im Browser, sofern die Daten technisch anders sinnvoll bereitgestellt werden können,
- nur für die Darstellung notwendige Informationen übernehmen,
- bei Jugendinhalten keine unnötige Übernahme personenbezogener Detaildaten.

Die genaue technische Nutzung von `fussball.de` ist zusätzlich gegen Nutzungsbedingungen und technische Schnittstellen zu prüfen.

#### 3.3 Veranstaltungen

Der eigene TuS Event Planner soll perspektivisch führende Quelle sein. Die Homepage rendert daraus eigene `EventCard`s.

Externe Kalender-iframes sollen nicht das Zielmodell für den Neuaufbau sein.

#### 3.4 Social Media

- Social Links sind erlaubt und einfach.
- Direkte Social-Media-Embeds sind nicht Default.
- Für Teaser werden möglichst lokale Bilder/Texte oder kontrolliert serverseitig bereitgestellte Daten verwendet.
- Externe Inhalte dürfen nach bewusster Nutzeraktion geöffnet werden.

#### 3.5 Karten, Videos und weitere Drittinhalte

Google Maps, YouTube, Vimeo oder vergleichbare Drittinhalte werden nicht beiläufig direkt geladen.

Bevorzugt wird:

- lokale Vorschau / statisches Bild / Adresse + externer Link,
- oder eine technisch saubere Zwei-Klick-Lösung bei echtem Mehrwert.

#### 3.6 Schriftarten und Assets

- freigegebene Schriften möglichst lokal hosten,
- Original-TuS-Logos lokal aus der freigegebenen Asset-Quelle verwenden,
- keine externen Font-CDNs ohne dokumentierte Entscheidung,
- keine generierten oder rekonstruierten Markenassets.

#### 3.7 Öffentliche Formulare

Für jedes Formular gelten mindestens:

- klarer Zweck,
- minimale Pflichtfelder,
- serverseitige Validierung,
- Missbrauchs-/Spam-Schutz mit möglichst wenig Dritttracking,
- keine personenbezogenen Eingaben in öffentliche Logs oder GitHub,
- eindeutige interne Ziel-Source-of-Truth,
- definierte Aufbewahrung/Löschung,
- passende Datenschutzinformation direkt am Prozess,
- keine Marketing-Einwilligung als Voraussetzung für eine fachlich unabhängige Anfrage.

#### 3.8 Partner-Fit-Check

Für `Partner werden` gilt zusätzlich:

- Unternehmen, Ansprechpartner und E-Mail sind für den Erstkontakt grundsätzlich ausreichend; weitere Felder bleiben nur soweit fachlich nötig,
- Telefonnummer, Website, Ort und Freitext bleiben optional, solange keine konkrete Notwendigkeit besteht,
- keine automatische Profilbildung über externe Datenquellen aus dem öffentlichen Formular heraus,
- keine Werbe-/Tracking-Pixel im Formularprozess,
- Lead-Daten werden kontrolliert in die interne Partnerarbeit übergeben und nicht parallel in mehreren Dateninseln dauerhaft gespeichert,
- Lösch-/Aufbewahrungsregel wird vor produktivem Start festgelegt.

#### 3.9 Analytics

Homepage V1 startet ohne Marketing-/Verhaltens-Tracking.

Wenn später Erfolgsmessung nötig ist, wird zuerst geprüft:

1. Welche konkrete Kennzahl wird wirklich benötigt?
2. Reichen vorhandene technische Server-/Systemdaten oder aggregierte interne Kennzahlen?
3. Ist ein datenschutzfreundlicheres Verfahren ohne Endgeräte-Tracking möglich?
4. Falls nein: Welche Einwilligung, Verträge, Drittlandprüfung und Datenschutzhinweise sind nötig?

Kein Analytics-Tool wird nur deshalb eingebaut, weil es bei Webseiten üblich ist.

#### 3.10 Datenschutzerklärung wird aus dem echten System erzeugt

Die neue Datenschutzerklärung darf nicht auf einem pauschalen Generatortext basieren, der Dienste beschreibt, die gar nicht genutzt werden, oder reale Dienste auslässt.

Vor Go-live wird ein technisches Inventar der produktiven Homepage erstellt:

- Hosting,
- Server-/Access-Logs,
- WordPress/Core/Theme,
- Plugins,
- lokale und externe Assets,
- Formulare,
- externe APIs,
- Cookies/Local Storage/vergleichbare Zugriffe,
- Analytics,
- Spam-Schutz,
- CDN,
- eingebundene Medien,
- Datenweiterleitungen.

Erst daraus wird die finale öffentliche Datenschutzerklärung abgeleitet.

### 4. Priorisierte Maßnahmen

#### P0 – aktuelle Homepage / vor weiterem Ausbau

1. Technisch verifizieren, ob Google Analytics aktuell tatsächlich aktiv ist.
2. Falls inaktiv: veralteten Analytics-Abschnitt entfernen; falls aktiv: Nutzung und Einwilligungsmodell neu prüfen.
3. Bezeichnung `Datenschutzbeauftragter` nur beibehalten, wenn eine formelle Bestellung tatsächlich bestätigt ist; sonst `Datenschutzkontakt`.
4. Impressumsverweis `§ 55 Abs. 2 RStV` gegen aktuellen `§ 18 Abs. 2 MStV` und DDG-Anforderungen aktualisieren.
5. Google-Calendar-iframe auf `Platzbelegung` technisch bewerten und für den Neuaufbau nicht als Default übernehmen.
6. WordPress-/Plugin-/Cookie-/External-Resource-Inventar der aktuellen Seite erstellen.

#### P1 – während des Homepage-Neuaufbaus

1. Drittanbieter-Embeds standardmäßig vermeiden.
2. `fussball.de`-Integration privacy-by-design als Adapter/Rendering-Konzept prüfen.
3. Event Planner als eigene Veranstaltungsquelle integrieren.
4. Social Media nur als Link oder privacy-freundlichen Teaser ausspielen.
5. Partner-Fit-Check mit Löschregel und klarer interner Datenübergabe bauen.
6. Kinder-/Jugendveröffentlichungen und Foto-/Medienprozess mit dem Schutzkonzept abstimmen.
7. lokale Fonts/Assets als Default.

#### P2 – vor Go-live

1. finale technische Ressourcen-/Cookie-Prüfung,
2. Datenschutzerklärung aus dem realen produktiven Stand aktualisieren,
3. Impressum final prüfen,
4. Formulare und Empfänger testen,
5. Löschung/Export für Formular- und Lead-Daten testen,
6. Berechtigungen im WordPress-Backend prüfen,
7. Backup-/Log-/Retention-Verhalten dokumentieren,
8. Privacy Check im Go-live-Review ausdrücklich abhaken.

### 5. Entwickler-Handoff

Der WordPress Developer soll die Homepage nicht mit einem pauschalen Cookie-/Consent-Plugin beginnen.

Reihenfolge:

1. Funktion ohne Dritttracking bauen,
2. externe Ressourcen inventarisieren,
3. Drittanbieterzugriffe vermeiden oder kontrollieren,
4. nur bei echtem Bedarf zusätzliche Einwilligungsmechanismen einführen,
5. produktiven technischen Stand an den Data Protection Manager zum Privacy Review übergeben.

Für jede neue Homepage-Funktion mit personenbezogenen Daten oder externen Diensten gilt `Privacy Check offen`, bis David bzw. die Datenschutzrolle den konkreten Datenfluss geprüft hat.

## Relationship to other documents

- `CURRENT-STATE.md`
- `../../roles/data-protection-manager/role.md`
- `../../roles/data-protection-manager/privacy-standard.md`
- `../../roles/wordpress-developer/development-standard.md`
- `../../design/homepage-standard.md`
- `../../projects/partner-portal/PUBLIC-PARTNER-ENTRY.md`
- `../../standards/child-youth-protection-standard.md`

Externe Referenzquellen:

- LfDI Baden-Württemberg – Datenschutz im Verein / Orientierungshilfe Vereine,
- LfDI Baden-Württemberg – FAQ Cookies und Tracking,
- Datenschutzkonferenz – Orientierungshilfe für Anbieter von Telemedien/Digitalen Diensten,
- § 25 TDDDG,
- Medienstaatsvertrag, insbesondere § 18 MStV.

## Future Development

Nach dem technischen Ist-Inventar der aktuellen WordPress-Seite wird dieser Check um eine bestätigte Komponentenliste ergänzt.

Beim Homepage-Neuaufbau wird daraus eine kurze Go-live-Privacy-Checkliste abgeleitet. Neue Einzelregeln werden nur ergänzt, wenn eine reale Funktion sie benötigt; das Dokument soll keine allgemeine juristische Enzyklopädie werden.