# Installierbare WordPress-Pakete

## Quelle und Umfang
`.github/workflows/wordpress-packages.yml` erkennt WordPress-Plugins anhand von `Plugin Name:` in einer PHP-Einstiegsdatei und Themes anhand von `Theme Name:` in `style.css`. Die ZIP-Datei enthält je Erweiterung genau ein Installations-Stammverzeichnis mit dem Original-Slug. Damit werden neue Plugins und Themes automatisch berücksichtigt, sofern die WordPress-Header korrekt gesetzt sind.

## Validierung
Der Workflow prüft Versions-Header, Theme-Einstiegsdatei, PHP-Syntax sämtlicher ausgelieferter PHP-Dateien (PHP 8.2), direkte statische `__DIR__`-Includes, Composer-Abhängigkeiten soweit erkennbar, ZIP-Integrität und den ZIP-Einstiegspfad. `manifest.json` und `SHA256SUMS` dokumentieren Pakete und Prüfsummen. Dynamische Includes, zur Laufzeit erwartete WordPress-Erweiterungen, WordPress-Kompatibilität und tatsächliche Installation benötigen ergänzende Tests. Child-Themes ohne mitgeliefertes Parent werden bewusst abgelehnt.

## Artefakte
Bei Pull Requests (relevante Dateipfade), Push auf `main`, Tags `wordpress-v*` oder manuellem Start unter **Actions → WordPress installable ZIP packages** ausführen. Unter dem jeweiligen erfolgreichen Workflow-Run liegt `wordpress-installable-zips` mit allen ZIP-Dateien, Manifest und SHA256SUMS. Ein PR-Build ist **keine Freigabe**.

## Versionierte Releases
Nach Review und Merge auf `main` einen **annotierten Tag** im Format `wordpress-vX.Y.Z` auf einem explizit freigegebenen Commit der main-Historie setzen und pushen. Die Tag-Ausführung validiert den Commit, erstellt alle Erweiterungs-ZIPs und hängt sie samt Prüfsummen an ein GitHub Release. Der Tag ist die gemeinsame Paket-Build-Version; jede einzelne ZIP benutzt weiter ihren eigenen Versions-Header im Dateinamen. Neue Tags niemals für ungeprüfte Stände setzen. GitHub Actions benötigt Release-Schreibberechtigung durch `GITHUB_TOKEN`; Repository-Einstellungen müssen die Ausführung zulassen.

## Grenzen
Kein Deployment oder WordPress-Backendzugriff. Pakete sind nicht automatisch als „Last Known Good“ getestet. Bei unaufgelösten PHP- oder Composer-Abhängigkeiten schlägt der Build fehl; es darf kein unvollständiges ZIP veröffentlicht werden.