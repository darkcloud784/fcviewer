<?php

/*
 * The MIT License
 *
 * Copyright 2017 DarkCloud.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require __DIR__ . '/vendor/autoload.php';
require 'config.php';
require 'functions.php';

show(startTime());
$mysqli = startDBConnection($dbserver, $dbuser, $dbpassword, $dbname, $dbport);
$api = new Lodestone\Api;

try {
    $freeCompany = $api->getFreeCompanyMembers($fc_id, 1);
} catch (HttpMaintenanceValidationException $hmvex) {
    show('Lodestone is down for maintence');
} catch (HttpNotFoundValidationException $hnfvex) {
    show('page was not found or deleted, please check your fcid to ensure it is correct');
} catch (ValidationException $vex) {
    show('Ninjas came and we were lucky to excape with our lives!');
}

$query = "TRUNCATE TABLE characterinfo";
$mysqli->query($query) or die(sqlError($mysqli->errno, $mysqli->error));
$query = "TRUNCATE TABLE classinfo";
$mysqli->query($query) or die(sqlError($mysqli->errno, $mysqli->error));


foreach ($freeCompany['members'] as $member) {
    $id = $member['id'];
    $character = $api->getCharacter($id);
    show("Processing: " . $id);
    $avatar_url = mysqli_real_escape_string($mysqli, $member['avatar']);
    $name = mysqli_real_escape_string($mysqli, $member['name']);
    $rankicon_url = mysqli_real_escape_string($mysqli, $member['rankicon']);
    $rank = mysqli_real_escape_string($mysqli, $member['rank']);

    $query = "INSERT INTO characterinfo(id, name, rank, rankicon_url, avatar_url)"
            . "VALUES('$id', '$name', '$rank', '$rankicon_url', '$avatar_url')";
    show("Query: " . $query);
    $mysqli->query($query) or die(sqlError($mysqli->errno, $mysqli->error));

    $sql_columns = "id";
    $sql_values = "$id";

    foreach ($character->getClassjobs() as $classJob) {
        if ($classJob->getLevel() == "-")
            continue;
        $sql_columns .= ',`' . $classJob->getName() . '`';
        $sql_values .= ',' . (int) $classJob->getLevel();
    }

    $query = "INSERT INTO classinfo " . "($sql_columns)" . "VALUES($sql_values)";
    show("Query: " . $query);
    $mysqli->query($query) or die(sqlError($mysqli->errno, $mysqli->error));
}

closeDBConnection($mysqli);
show(endTime());
