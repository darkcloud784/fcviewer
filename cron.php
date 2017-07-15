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

$mysqli = startDBConnection($dbserver, $dbuser, $dbpassword, $dbname, $dbport);
$api = new Lodestone\Api;

try {
    $freeCompany = $api->getFreeCompanyMembers($fc_id, 1);
    $query = "TRUNCATE TABLE classinfo";
    $mysqli->query($query) or die($mysqli->error);

    foreach ($freeCompany['members'] as $member) {
        $id = $member['id'];
        $character = $api->getCharacter($id);
        show("Processing: " . $id);
        $avatar = $member['avatar'];
        $name = $member['name'];
        $rankicon = $member['rankicon'];
        $rank = $member['rank'];
        foreach ($character->getClassjobs() as $classJobs) {
            $level = $classJobs->getLevel();
            $jobName = $classJobs->getName();
            $sql_columns = "id, name, rank, rankicon";
            $sql_values = "\"$id\",\"$name\",\"$rank\",\"$rankicon\"";
            for ($i = 0; $i < count($classJobs); $i++) {
                $sql_columns .= ",`" . $jobName[$i] . "`";
                if ($level[$i] != "-") {
                    $sql_values .= "," . $level[$i];
                } else {
                    $sql_values .= ",0";
                }
            }
            $sql_columns .= ", avatar_url";
            $sql_values .= "\"$avatar\"";

            $query = "INSERT INTO `classinfo` " . "($sql_columns)" . "VALUES($sql_values)";
            show("Query: " . $query);
            $mysqli->query($query) or die($mysqli->error);
        }
    }

    closeDBConnection($mysqli);
} catch (HttpMaintenanceValidationException $hmvex) {
    show('Lodestone is down for maintence');
} catch (HttpNotFoundValidationException $hnfvex) {
    show('page was not found or deleted, please check your fcid to ensure it is correct');
} catch (ValidationException $vex) {
    show('Ninjas came and we were lucky to excape with our lives!');
}
    

