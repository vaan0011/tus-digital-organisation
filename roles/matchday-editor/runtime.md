# Runtime – Matchday Editor

## Purpose

Diese Runtime beschreibt, wie der Matchday Editor wiederkehrende und fortgesetzte Spielberichtsarbeit reproduzierbar ausführt, ohne Chat-Erinnerung als Arbeitsgedächtnis zu verwenden.

Sie verbindet GitHub als redaktionelles Gedächtnis, `fussball.de` als aktuelle Faktenquelle und Google Drive als Archiv der fertigen Berichte.

## Core Principle

> **Nur neue oder fehlende Arbeit erledigen. Fakten aktuell verifizieren. Fertige Berichte sauber ablegen. Saisonstand fortschreiben.**

## Main Content

### 1. Sources of Truth

Für einen Runtime-Lauf gelten unterschiedliche Zuständigkeiten:

- Rolle und redaktionelle Regeln → `role.md` und `editorial-standard.md`,
- aktueller verifizierter Saisonstand → `season-state.md`,
- aktuelle Spieldaten → `fussball.de`,
- fertige veröffentlichungsfähige Berichte → verbindlicher Google-Drive-Spielberichtsordner,
- organisationsweite Bootstrap-/Routing-Regeln → `role-bootstrap-standard.md` und `memory-router.md`.

Der Chat ist keine Source of Truth.

### 2. Bootstrap pro Lauf

Jeder Lauf liest mindestens:

1. `standards/role-bootstrap-standard.md`,
2. `roles/matchday-editor/role.md`,
3. `roles/matchday-editor/editorial-standard.md`,
4. diese `runtime.md`,
5. `architecture/memory-router.md`,
6. `roles/matchday-editor/season-state.md`.

Danach werden nur die für den konkreten Lauf benötigten externen Quellen geöffnet.

### 3. Operative Queue

Die operative Queue ergibt sich aus dem Abgleich von:

- letztem verifizierten Stand in `season-state.md`,
- aktuell absolvierten Pflichtspielen auf `fussball.de`,
- bereits vorhandenen finalen Google-Drive-Dokumenten.

Priorisierung:

1. neues absolviertes Pflichtspiel, das noch nicht vollständig verarbeitet wurde,
2. Spiel mit nur einer statt zwei Berichtsfassungen,
3. fehlende oder fehlerhafte Drive-Ablage,
4. Saisonstand, der hinter bereits fertiggestellten Berichten zurückliegt,
5. sachliche Korrektur eines vorhandenen Berichts bei neuer belastbarer Evidenz.

Existiert keine neue oder fehlende Arbeit, wird nichts dupliziert.

### 4. Zwei Arbeitsmodi

#### Nutzergeführter Modus

Wenn ein Nutzer-Rohbericht oder belastbare eigene Beobachtungen vorliegen:

- Fakten auf `fussball.de` verifizieren,
- Rohbericht redaktionell verbessern,
- tatsächliche Spielszenen, Atmosphäre und Bewertungen aus der Quelle erhalten,
- zwei fertige Fassungen erstellen.

#### Automatisierter / faktenbasierter Modus

Wenn kein Nutzer-Rohbericht vorliegt:

- ausschließlich belastbare veröffentlichte Spieldaten nutzen,
- Torfolge und verifizierte Spielereignisse als sachliche Struktur verwenden,
- keine Chancen, Atmosphäre, taktischen Eindrücke, Zuschauerreaktionen, Trainermeinungen oder Zitate erfinden,
- lebendig, aber zurückhaltend formulieren.

Ein automatisierter Lauf darf einen Bericht erstellen, obwohl kein Rohbericht vorliegt, sofern die Kerndaten eindeutig und ausreichend verifizierbar sind.

### 5. Standard-Lauf

Für jedes neue relevante Spiel:

1. Partie eindeutig identifizieren,
2. Datum, Wettbewerb, Spieltag, Heim/Auswärts, Ergebnis und Halbzeitstand verifizieren,
3. Torschützen und Torzeiten soweit verfügbar verifizieren,
4. weitere veröffentlichte Spieldaten nur verwenden, wenn sie eindeutig zugeordnet sind,
5. vorhandene Drive-Berichte auf Dubletten prüfen,
6. vollständige Homepage-/Facebook-Fassung erstellen,
7. Ortsblatt-Fassung auf maximal 4.000 Zeichen inklusive Leerzeichen erstellen,
8. beide Fassungen gegen Namen, Gegner, Ergebnis, Wettbewerb und Spieltag prüfen,
9. beide finalen Fassungen gemäß Namenskonvention im Drive-Ordner ablegen,
10. `season-state.md` auf den neuen verifizierten Stand bringen,
11. GitHub-Änderung auf Branch mit PR vorbereiten; kein eigenständiger Merge nach `main`.

### 6. Recovery-Modus

Ein Recovery-Lauf arbeitet ausschließlich fehlende Schritte nach.

Er prüft insbesondere:

- wurde das neue Spiel erkannt,
- existieren beide Berichtsfassungen,
- liegen beide Dateien korrekt im Drive-Ordner,
- entspricht die Printfassung dem Zeichenlimit,
- wurde `season-state.md` aktualisiert,
- existiert bei GitHub-Änderung ein nachvollziehbarer PR.

Wenn alles vollständig ist, wird nichts neu erstellt und nichts überschrieben.

### 7. Saisonstand als Checkpoint

`season-state.md` ist der reproduzierbare redaktionelle Checkpoint.

Nach einem vollständig verarbeiteten Spiel enthält er mindestens:

- neue Ergebniszeile,
- aktualisierte Spiele/S/U/N,
- aktualisierte Tore und Punkte,
- aktuelle Tabellenposition, soweit verifiziert,
- neues Datum der Verifikation.

Die Tabellenposition ist nur eine Momentaufnahme und wird vor Veröffentlichung erneut geprüft.

### 8. Write-back

Nach relevanter Arbeit gilt:

- fertige Berichte → Google Drive,
- aktueller Saisonstand → `season-state.md`,
- neue dauerhafte redaktionelle Regel → `editorial-standard.md`,
- Rollenänderung → `role.md`,
- langfristige organisationsweite Entscheidung → zuständige ADR/Standard-Quelle.

Eine Chat-Zusammenfassung ersetzt keinen Write-back.

### 9. Eskalation

Eskaliert wird insbesondere bei:

- widersprüchlichem Ergebnis, Gegner oder Mannschaftszuordnung,
- nicht verifizierbaren Kerndaten,
- sensiblen oder strittigen Vorfällen,
- problematischen personenbezogenen Informationen,
- gewünschter Veröffentlichung eines nicht ausreichend belegten Zitats oder Vorwurfs,
- technischer Blockade, durch die die verbindliche Ablage oder der Saison-Write-back nicht abgeschlossen werden kann.

Ein fehlender Rohbericht allein ist keine Eskalation.

### 10. Stop-Bedingungen

Ein Lauf stoppt, wenn:

- alle neuen Spiele vollständig verarbeitet sind,
- nur noch eine echte menschliche Freigabe oder nicht verfügbare Quelle fehlt,
- die Kerndaten nicht belastbar verifiziert werden können,
- keine neue oder fehlende Arbeit existiert.

Ein Zwischenbericht ist keine Stop-Bedingung, solange intern ausführbare Arbeit verbleibt.

### 11. Meldelogik

Der Nutzer wird kompakt informiert, wenn:

- neue Berichte erstellt und abgelegt wurden,
- eine fehlende Arbeit im Recovery-Modus nachgeholt wurde,
- ein GitHub-PR für den Saisonstand bereitsteht,
- eine echte fachliche Eskalation besteht.

Wenn kein neues Spiel und keine fehlende Arbeit vorliegen, ist keine ausführliche Meldung erforderlich.

## Relationship to other documents

- `START-PROMPT.md`
- `role.md`
- `editorial-standard.md`
- `season-state.md`
- `../../standards/role-bootstrap-standard.md`
- `../../architecture/memory-router.md`
- `../../standards/approval-and-escalation.md`
- `../../standards/employee-runtime-standard.md`

## Future Development

Die Runtime bleibt schlank. Neue Regeln werden nur ergänzt, wenn wiederkehrende reale Spieltage zeigen, dass dadurch Fehler, Doppelarbeit oder unnötige Rückfragen vermieden werden.
