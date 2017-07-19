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
$res = mysqli_query($mysqli,$query);
if( !$res )
	die( $mysqli->error );
$obj = $res->fetch_object();
$rows = intval( $obj->n );
unset( $obj );
unset( $res );
print "<link rel='stylesheet' type='text/css' href='".curPageURL()."style/style.css'>
		<script type='text/javascript' src='".curPageURL()."lib/jquery.tablesorter.min.js'></script>
		<script type='text/javascript' src='".curPageURL()."lib/jquery.tablesorter.widgets.min.js'></script>
		<script type='text/javascript' src='".curPageURL()."lib/jquery.tablesorter.pager.min.js'></script>";
pager( $rows );
echo "<table class='tablesorter'><thead><tr><th width='20%'>Name</th><th width='5%'>Rank</th>";

// Generate table headers (this is also a decent place to fill our max values, there's no point doing a for loop twice)
foreach( $jobs as $data )
{
		echo "<th class='".$data['type']."' title='".ucwords( $data['name'] )."'><img src=".curPageURL().$data['image']."></th>";
		
		//Max query and array storage
		$query = "SELECT MAX( `".$data['name']."` ) FROM characterinfo LEFT JOIN classinfo ON characterinfo.id = classinfo.id;";
		$res = $mysqli->query( $query );
		if( !$res )
			die( $mysqli->error );
		$obj = $res->fetch_object();
		$values[$data['name']] = intval( $obj->n );
		unset( $obj );
		unset( $res );
}
echo "</tr></thead><tbody>";

// Generate our query
$query = "SELECT * FROM characterinfo LEFT JOIN classinfo ON characterinfo.id = classinfo.id;";
if ( $result = $mysqli->query( $query ) )
{
	// We have our result, generate our table data
	foreach( $result as $row )
	{
		print "<tr>
		<td width='20%' title='".$row['name']."' style='text-align: left;'><img class='members' src='".$row['avatar_url']."'/> <a href=http://eu.finalfantasyxiv.com/lodestone/character/".$row['id']."/ target=_blank>".$row['name']."</a></td>
		<td>".$row['rank']."</td>";
		foreach( $jobs as $data )
		{
			$row[$data['name']] == $values[$data['name']] ?	$num = "<b>".$row[$data['name']]."</b>" : $num = $row[$data['name']];
			echo "<td class=".$data['name']." style='text-align: center;'>$num</td>";
		}
		echo "</tr>";
	}
	unset( $result );
}
else
	die( $mysqli->error );

echo "</tbody></table>";

pager( $rows );
closeDBConnection( $mysqli );
endTime();
?>
<script type='text/javascript'>
	jQuery('table').tablesorter({
		widgets: ['zebra', 'columns'],
		sortInitialOrder: "desc"
	}).tablesorterPager({
		container: jQuery(".pager"),
		output: '{startRow} to {endRow} ({totalRows})',
		size: <?php echo $perPage; ?>,
		removeRows: true
	});
</script>