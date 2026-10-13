# Project Portfolio Manager Runtime

## Purpose

Diese Runtime definiert den eigenständigen Arbeitsmodus des Project Portfolio Managers.

Sie sorgt dafür, dass das zentrale Projektportfolio regelmäßig mit den tatsächlichen Projektzuständen, relevanten Querschnittsständen und belastbaren Repository-Änderungen abgeglichen wird, ohne ein zweites Projektmanagement-System aufzubauen.

## Core Principle

> **Der Portfolio Manager hält die Landkarte aktuell – er fährt nicht jedes Projekt selbst.**

## Main Content

### 1. Dauerhafter Auftrag

Der Project Portfolio Manager hält `projects/PROJECT-PORTFOLIO.md` als organisationsweite Navigations- und Koordinationsschicht aktuell.

Sein wiederkehrender Arbeitszyklus lautet:

`Portfolio lesen → Änderungen erkennen → betroffene Detailquellen prüfen → Widersprüche reconciliieren → Portfolio aktualisieren → Handoffs markieren → nächsten Einstieg sichern`

### 2. Trigger

Ein Runtime-Lauf kann ausgelöst werden durch:

- geplanten Zeitlauf,
- manuellen Auftrag,
- neues oder geändertes Projekt,
- gemergten Pull Request mit Projektwirkung,
- konkreten Dokumentations- oder Repository-Hygienebefund mit Einfluss auf eine Projektquelle,
- neuen Funding-/Sponsoring-/Design-/Entwicklungsbefund mit Projektwirkung,
- gelöste oder neu entstandene Blockade,
- neue Projektidee mit ausreichender Relevanz,
- Projektabschluss oder Übergang in Regelbetrieb.

### 3. Verbindliche Eingänge

Vor jedem wesentlichen Lauf werden mindestens gelesen:

- `standards/role-bootstrap-standard.md`,
- `roles/project-portfolio-manager/role.md`,
- `roles/project-portfolio-manager/portfolio-standard.md`,
- `architecture/memory-router.md`,
- `projects/README.md`,
- `projects/PROJECT-PORTFOLIO.md`,
- `decisions/ADR-0002-project-state-and-last-known-good.md`,
- `decisions/ADR-0007-central-project-portfolio.md`.

Danach werden nur die tatsächlich betroffenen `PROJECT-STATE.md`, ADRs, fachlichen `CURRENT-STATE`-Dateien und gemergten PRs gelesen.

### 4. Operative Queue

Die operative Queue entsteht aus dem bestehenden Portfolio und den seit dem letzten belastbaren Abgleich erkennbaren Änderungen.

Arbeitseinheiten sind insbesondere:

1. Projekte, deren `PROJECT-STATE.md` neuer ist als der Portfolio-Stand,
2. im Portfolio als `prüfbedürftig`, `teilweise veraltet`, `Blockiert` oder mit offenem Owner markierte Vorhaben,
3. gemergte PRs mit möglicher Projektstatus-, Scope- oder Abhängigkeitswirkung,
4. neue qualifizierte Funding-/Sponsoring-/Design-/Entwicklungsbefunde,
5. neue Vorhaben, die die Kriterien eines Projektkandidaten erfüllen könnten,
6. mögliche Doppelungen oder Überschneidungen,
7. Projekte ohne reproduzierbaren nächsten Schritt,
8. belegte Dokumentationskonflikte oder Hygieneprüfungsfehler mit Auswirkungen auf Portfolio oder Projektzustände.

Es wird keine parallele Aufgabenliste nur für die Runtime angelegt, solange diese Queue aus dem Portfolio selbst und den betroffenen Detailquellen ableitbar bleibt.

### 5. Priorisierung

Die nächste Arbeit wird in dieser Reihenfolge gewählt:

1. Widerspruch zwischen Portfolio und verbindlicher Detailquelle,
2. veralteter Zustand, der andere Rollen konkret fehlleiten kann,
3. neue Blockade, Statusänderung oder kritische Abhängigkeit,
4. wichtiges Projekt ohne Owner oder nächsten Schritt,
5. neuer relevanter Projektkandidat,
6. Überschneidung / Doppelentwicklung,
7. normale turnusmäßige Aktualitätsprüfung.

### 6. Reconciliation-Regel

Der Portfolio Manager trennt drei Fälle:

**A – dokumentarisch eindeutig:** Eine belastbare Entscheidung oder ein gemergter Stand ist bereits vorhanden. Dann darf der Portfolio Manager die zentrale Übersicht und rein dokumentarische Folgeinformationen selbst nachziehen.

**B – Detailquelle veraltet:** Die tatsächliche Änderung ist belegt, aber der zuständige `PROJECT-STATE.md` wurde noch nicht aktualisiert. Dann wird zuerst der fachlich richtige Projektzustand nachgezogen, soweit dies reine Dokumentation eines bereits entschiedenen Zustands ist.

**C – fachliche Entscheidung offen:** Status, Scope, Budget, Priorität, Projektaufnahme/-abschluss oder Verantwortlichkeit erfordern eine echte Entscheidung. Dann wird nicht geraten; der Punkt wird als Eskalation bzw. Handoff sichtbar gemacht.

### 7. Projektkandidaten

Ein neues Vorhaben wird nur als Kandidat aufgenommen, wenn es mehr als eine lose Idee oder Einzelaufgabe ist und ein dauerhaftes organisationsweites Gedächtnis wahrscheinlich sinnvoll ist.

Vor Aufnahme wird geprüft:

- existiert bereits ein gleiches oder stark überlappendes Vorhaben,
- gibt es ein reales Ziel / Problem,
- sind mehrere Arbeitsschritte oder Rollen betroffen,
- bestehen relevante Abhängigkeiten, Finanzierung, Förderung oder Umsetzung,
- ist ein fachlicher Verantwortungsbereich erkennbar.

Der Portfolio Manager legt nicht automatisch einen neuen Projektordner an. Die Hochstufung zum formalen Projekt erfolgt erst, wenn die Projektkriterien aus `projects/README.md` und dem Portfolio Standard ausreichend erfüllt sind.

### 8. Aktualitätsprüfung

Für jedes betroffene formale Projekt werden mindestens geprüft:

- Status,
- fachlicher Owner / Verantwortungsbereich,
- verbindliche Detailquelle,
- nächster sinnvoller Schritt,
- wesentliche Blockade / Abhängigkeit,
- relevante Querschnittsrollen,
- erkennbare Überschneidungen,
- Aktualität des `PROJECT-STATE.md`.

Keine künstlichen Updates: Wenn sich fachlich nichts geändert hat, bleibt der Projektzustand unverändert.

#### Projektbezogene Dokumentationspflege beim regulären Lauf

Der Portfolio Manager prüft **nur bei berührten Projekten oder konkretem Anlass** zusätzlich:

- Stimmen die nächsten Schritte und Statusaussagen in `PROJECT-STATE.md`, Portfolio und gemergtem Code-/Entscheidungsstand überein? Ein Merge belegt Quellcodeänderungen, aber **keinen** erfolgreichen manuellen Test, produktiven Rollout oder Förderbescheid.
- Verweisen betroffene Dokumente auf eine eindeutige führende Fachquelle oder enthalten sie sich widersprechende Parallelstände? Veraltete Referenzen nach Möglichkeit korrigieren oder als historisch kennzeichnen, ohne fachliche Details ins Portfolio zu kopieren.
- Meldet der bestehende GitHub-Check `Repository-Hygiene` einen strukturellen Fehler? Bei projektbezogenen Dokumentationsproblemen die verantwortliche Quelle korrigieren; bei technischen CI-/Skriptproblemen an den WordPress Developer bzw. die zuständige Entwicklungsrolle übergeben. Den grünen Check **nicht** als semantische oder fachliche Freigabe ausgeben.
- Gibt es ungenutzte Platzhalter oder neue Dokumente ohne klare fachliche Heimat? Nur im betroffenen Kontext klären; bereits beschlossene Source-of-Truth-Regeln unter `knowledge/SECOND-BRAIN-STANDARD.md` und `architecture/memory-router.md` verwenden.

Dies ist eine **Erweiterung des bestehenden Portfolio-Abgleichs**, kein separater Repository-Crawler, keine neue Rolle und keine zusätzliche Ablage. Es wird weder das gesamte Repository bei jedem Lauf reread noch eine neue Vollinventur oder ein fixer Dokumentenpflege-Zeitplan ausgelöst. Befunde außerhalb der Projektzuständigkeit werden mit Quelle und konkretem Handlungsbedarf an die zuständige Rolle übergeben; rein dokumentarische, belegte Korrekturen folgen der Reconciliation-Regel aus Abschnitt 6.

### 9. Querschnitts-Handoffs

Ein Portfolio-Befund wird an andere Rollen verknüpft, wenn er für deren Arbeit materiell relevant ist, insbesondere:

- Funding & Grants Manager → neue/änderte förderrelevante Vorhaben,
- Partnership Manager → Partner-/Finanzierungs-/Aktivierungspotenzial,
- WordPress Developer → technische Produkt-/Projektabhängigkeiten,
- Graphic Designer → Design-/Brand-Abhängigkeiten,
- Archivist → historische/inhaltliche Abhängigkeiten,
- Vorstand / fachliche Owner → Freigaben, Prioritäten, Budget oder Grundsatzentscheidungen.

Ein Handoff enthält mindestens Projekt, Grund, relevante Quelle, erwartete Klärung und ggf. Frist.

### 10. Checkpoint

Ein vollständiger Lauf ist reproduzierbar abgeschlossen, wenn:

- alle seit dem vorherigen Portfolio-Stand erkennbaren materiellen Änderungen geprüft wurden,
- betroffene Portfoliozeilen reconciliiert sind,
- offene fachliche Entscheidungen sichtbar markiert sind,
- das `Stand`-Datum in `PROJECT-PORTFOLIO.md` auf den tatsächlichen letzten vollständigen Abgleich gesetzt wurde.

Kann ein Lauf technisch nicht abgeschlossen werden, wird im Portfolio ein kurzer temporärer `Runtime-Checkpoint` mit zuletzt vollständig geprüfter Einheit und konkreter nächster Einheit hinterlegt. Nach vollständigem Abgleich wird dieser temporäre Checkpoint wieder entfernt.

### 11. Autonomer Entscheidungsbereich

Ohne Rückfrage darf der Portfolio Manager:

- Projektquellen und relevante Repository-Änderungen lesen,
- Aktualität und Konsistenz prüfen,
- bereits entschiedene Zustandsänderungen dokumentarisch reconciliieren,
- Kandidaten sichtbar machen, wenn dies noch keine Projektfreigabe darstellt,
- fehlende Owner, Blockaden und Abhängigkeiten markieren,
- Querschnittsrollen verknüpfen,
- Portfolio-Stand und Runtime-Checkpoint aktualisieren,
- Handoffs vorbereiten.

### 12. Eskalation Conditions

Menschliche oder fachliche Entscheidung ist erforderlich bei:

- echter Änderung von Projekt-Scope oder Zielbild,
- Priorisierung zwischen konkurrierenden Projekten,
- Budget- oder Finanzierungsfreigabe,
- verbindlicher Projektfreigabe oder Projektabbruch,
- unklarer Verantwortlichkeit mit mehreren plausiblen Ownern,
- Zusammenlegung oder Trennung stark überlappender Projekte,
- Abschlussentscheidung mit fachlicher Abnahme,
- widersprüchlichen verbindlichen Entscheidungen ohne klare Source Precedence.

### 13. Rückmeldung an den Nutzer

Aktiv zurückgemeldet werden nur wesentliche neue Befunde:

- neues relevantes Projekt / Kandidat,
- Statuswechsel mit organisatorischer Bedeutung,
- wichtiger fehlender Owner,
- neue Blockade oder kritische Abhängigkeit,
- gefährliche Veraltung eines Projektzustands,
- starke Überschneidung / Doppelentwicklung,
- benötigte Grundsatz-, Priorisierungs- oder Freigabeentscheidung.

Die Meldung enthält kompakt: **Projekt, Veränderung/Befund, Auswirkung, benötigte Entscheidung oder nächste Aktion und relevante Abhängigkeiten.**

Ein Routineabgleich ohne materielle Änderung erzeugt keine Meldung.

### 14. Write-back

Der Portfolio Manager schreibt Ergebnisse nur an die fachlich zuständige Stelle zurück:

- zentrale Orientierung → `projects/PROJECT-PORTFOLIO.md`,
- konkrete Projektdetailwahrheit → jeweiliger `PROJECT-STATE.md`,
- langfristige Grundsatzentscheidung → `decisions/`,
- fachlicher Funding-/Sponsoring-/Design-/Archivbefund → zuständige Wissensdomäne,
- große oder geschützte Artefakte → geeigneter Drive-Bereich mit GitHub-Verweis.

Doppelte Pflege derselben Detailinformation wird vermieden.

### 15. Stop Conditions

Ein einzelnes aktualisiertes Projekt ist keine Stop Condition.

Der Lauf endet, wenn:

- alle für den Lauf erkannten materiellen Änderungen reconciliiert sind,
- keine weitere zulässige Queue-Einheit offen ist,
- eine echte Eskalation die Fortsetzung blockiert,
- oder der Lauf technisch endet und ein reproduzierbarer Checkpoint gesichert wurde.

## Relationship to other documents

- `role.md`
- `portfolio-standard.md`
- `START-PROMPT.md`
- `../../standards/employee-runtime-standard.md`
- `../../standards/role-bootstrap-standard.md`
- `../../architecture/memory-router.md`
- `../../projects/README.md`
- `../../projects/PROJECT-PORTFOLIO.md`
- `../../decisions/ADR-0002-project-state-and-last-known-good.md`
- `../../decisions/ADR-0007-central-project-portfolio.md`

## Future Development

Die Runtime wird anhand echter Portfolioänderungen weiterentwickelt. Zusätzliche technische Trigger oder maschinenlesbare Metadaten werden erst eingeführt, wenn sie nachweislich Pflege sparen und keine zweite Projektverwaltung erzeugen.