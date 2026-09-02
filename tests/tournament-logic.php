<?php
// Kleine Regressionstests für die reinen Turnierplan-Funktionen, ohne WordPress-Bootstrap.
define('ABSPATH', __DIR__ . '/');
function absint($value) { return abs((int) $value); }
require_once __DIR__ . '/../projects/event-planner/plugin/verein-turnierplaner/includes/class-vtp-plugin.php';

function assert_true($condition, $message) {
    if (!$condition) {
        fwrite(STDERR, "FEHLER: {$message}\n");
        exit(1);
    }
}

function invoke_private($object, $method, array $arguments) {
    $reflection = new ReflectionMethod($object, $method);
    return $reflection->invokeArgs($object, $arguments);
}

$plugin = (new ReflectionClass('VTP_Plugin'))->newInstanceWithoutConstructor();
$team = function ($id, $group = 'A') {
    return (object) ['id' => $id, 'group_name' => $group, 'status' => 'active'];
};

// Liga heißt unabhängig von alten Gruppenzuweisungen wirklich jeder gegen jeden.
$leagueGroups = invoke_private($plugin, 'group_teams_for_mode', [
    [$team(1, 'A'), $team(2, 'A'), $team(3, 'B'), $team(4, 'B')],
    'league',
]);
assert_true(array_keys($leagueGroups) === ['A'], 'Liga darf nicht in mehrere Gruppen zerfallen.');
assert_true(count($leagueGroups['A']) === 4, 'Liga muss alle Mannschaften enthalten.');

// Nicht zugewiesene Mannschaften dürfen keine unsichtbare leere Gruppe erzeugen.
$grouped = invoke_private($plugin, 'group_teams_for_mode', [
    [$team(1, 'A'), $team(2, ''), $team(3, 'B')],
    'groups_ko',
]);
assert_true(array_keys($grouped) === ['A', 'B'], 'Nicht zugewiesene Teams dürfen nicht eingeplant werden.');

// Vollständigkeit, Feldbelegung und Mindestpause über verschiedene Größen prüfen.
for ($teamCount = 2; $teamCount <= 8; $teamCount++) {
    for ($fields = 1; $fields <= 3; $fields++) {
        for ($minimumRest = 0; $minimumRest <= 2; $minimumRest++) {
            $teams = [];
            for ($id = 1; $id <= $teamCount; $id++) $teams[] = $team($id);
            $pairs = [];
            for ($i = 0; $i < count($teams); $i++) {
                for ($j = $i + 1; $j < count($teams); $j++) {
                    $pairs[] = ['h' => $teams[$i], 'a' => $teams[$j], 'g' => 'A'];
                }
            }
            $schedule = invoke_private($plugin, 'schedule_group_matches', [$pairs, $fields, $minimumRest]);
            $expected = (int) ($teamCount * ($teamCount - 1) / 2);
            assert_true(count($schedule) === $expected, 'Der Jeder-gegen-jeden-Spielplan ist unvollständig.');
            $lastSlot = [];
            $slotTeams = [];
            $slotFields = [];
            foreach ($schedule as $match) {
                assert_true($match['field'] >= 1 && $match['field'] <= $fields, 'Ungültige Feldnummer.');
                assert_true(empty($slotFields[$match['slot']][$match['field']]), 'Ein Feld ist doppelt belegt.');
                $slotFields[$match['slot']][$match['field']] = true;
                foreach ([$match['h']->id, $match['a']->id] as $teamId) {
                    assert_true(empty($slotTeams[$match['slot']][$teamId]), 'Eine Mannschaft spielt im selben Slot doppelt.');
                    $slotTeams[$match['slot']][$teamId] = true;
                    if (isset($lastSlot[$teamId])) {
                        assert_true($match['slot'] - $lastSlot[$teamId] - 1 >= $minimumRest, 'Mindestpause wurde unterschritten.');
                    }
                    $lastSlot[$teamId] = $match['slot'];
                }
            }
        }
    }
}

// Setzlisten der K.O.-Modi müssen die vorgesehenen gruppenübergreifenden Paarungen liefern.
$standings = [
    'A' => array_map(fn($id) => ['team' => $team($id, 'A')], [1, 2, 3, 4]),
    'B' => array_map(fn($id) => ['team' => $team($id, 'B')], [5, 6, 7, 8]),
];
$quarterFinals = invoke_private($plugin, 'ko_first_seed_pairs', [8, $standings, ['A', 'B']]);
assert_true($quarterFinals === [[1, 8], [2, 7], [5, 4], [6, 3]], 'Viertelfinal-Setzliste ist nicht korrekt.');

// Bei exakt zwei ansonsten gleichplatzierten Teams entscheidet der direkte Vergleich.
$first = $team(1); $first->name = 'Alpha';
$second = $team(2); $second->name = 'Beta';
$tiedRows = [
    ['team' => $first, 'played' => 3, 'won' => 1, 'draw' => 1, 'lost' => 1, 'gf' => 4, 'ga' => 3, 'gd' => 1, 'pts' => 4],
    ['team' => $second, 'played' => 3, 'won' => 1, 'draw' => 1, 'lost' => 1, 'gf' => 4, 'ga' => 3, 'gd' => 1, 'pts' => 4],
];
$directMatch = (object) ['team_home' => 1, 'team_away' => 2, 'goals_home' => 0, 'goals_away' => 1];
$ranked = VTP_Plugin::sort_standing_rows($tiedRows, [$directMatch]);
assert_true($ranked[0]['team']->id === 2, 'Der Sieger des direkten Vergleichs muss vorne stehen.');

fwrite(STDOUT, "Turnierlogik: alle Tests erfolgreich.\n");
