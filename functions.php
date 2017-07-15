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

require 'config.php';

    
function startDBConnection( $db_server, $db_user, $db_pass, $db_database, $db_port = NULL )
{
	if ( empty( $db_port ) )
		$db_port = ini_get("mysqli.default_port");
	$mysqli = new mysqli( $db_server,$db_user,$db_pass,$db_database, $db_port );

	// Check connection
	if( $mysqli->connect_error ) 
		 die( "Connect Error (" . mysqli_connect_errno() . ") ". mysqli_connect_error() );
		
	return $mysqli;
}

function closeDBConnection( $mysqli )
{
	$mysqli->close();
}
function startTime()
{
	if ( $GLOBALS['debug'] )
	{
		show( "Script started." );
		global $start;
		$start = microtime(true);
	}
}

function endTime()
{
	if ( $GLOBALS['debug'] )
	{
		$finish = microtime(true);
		show( "Memory Peak: ". cMem(memory_get_peak_usage() ) );
		show( "Script ended." );
	}
}

function show( $data )
{
	if ( $GLOBALS['debug'] )
		echo '<pre>'. print_r($data, true) .'</pre>';
}

function cMem( $size )
{
	$tmp = array( 'b','kb','mb','gb','tb','pb' );
	if ( $GLOBALS['debug'] )
		return @round( $size/pow( 1024, ( $i=floor( log( $size,1024 ) ) ) ),2 ).' '.$tmp[$i];
}
