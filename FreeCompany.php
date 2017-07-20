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
include ('config.php');
include ('functions.php');
startTime();

$mysqli = startDBConnection($dbserver, $dbuser, $dbpassword, $dbname, $dbport);

$query = "SELECT * FROM characterinfo LEFT JOIN classinfo ON characterinfo.id = classinfo.id;";
$res = mysqli_query($mysqli, $query);
if (!$res)
    die(sqlError($mysqli->errno, $mysqli->error));
$rows = $res->num_rows;
?>

<link rel="stylesheet" type="text/css" href="./style/style.css">

<?php
pager($rows);
?>

<table class="tablesorter">
    <thead>
        <tr>   
            <th width="18%" align="left">Name</th><th width="5%" align="left" >Rank</th>
            <?php
            foreach ($jobs as $data){
                ?>
            <?="<th class='".$data['type']."' title='".$data['name']."'><img src=".curPageURL().$data['image']."></th>"?>
                <?php
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $res->fetch_assoc()) {
            ?>
            <tr>
                <td title="<?= $row['name'] ?>" style="text-align: left;">
                    <a href="http://na.finalfantasyxiv.com/lodestone/character/<?= $row['id'] ?>/"
                       target=_blank>
                        <img class="members" width="32" height="32" src="<?= $row['avatar_url'] ?>" />
    <?= $row['name'] ?>
                    </a>
                </td>
                <td><?= "<img src=" . $row['rankicon_url'] . " title=" . $row['rank'] .  " />" ?></td>
    <?php
    foreach ($jobs as $job) {
        ?>
                
                    <td class="<?= preg_replace('/\s+/', '', $job['name']) ?>" 
                        style="text-align: center;"><?= $row[$job['name']] ?></td>
                    <?php
                }
                ?>
            </tr>
                <?php
            }
            ?>
    </tbody>
</table>
        <?php
        pager($rows);
        closeDBConnection($mysqli);
        endTime();
        ?>
<script type="text/javascript" src="./lib/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="./lib/jquery.tablesorter.widgets.min.js"></script>
<script type="text/javascript" src="./lib/jquery.tablesorter.pager.min.js"></script>
<script type='text/javascript'>
    jQuery('table').tablesorter({
        widgets: ['zebra', 'columns'],
        sortInitialOrder: "desc"
    }).tablesorterPager({
        container: jQuery(".pager"),
        output: '{startRow} to {endRow} ({totalRows})',
        size: <?= $perPage ?>,
        removeRows: true
    });
</script>