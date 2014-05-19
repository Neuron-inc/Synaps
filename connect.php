<?php
	//connect.php

	$server = 'localhost';
	$username = 'synaps';
	$password = 'neuron2014';
	$database = 'synaps';

	$con = mysql_connect($server,$username,$password);
	$con_db = mysql_select_db($database,$con);
	if (!$con)
	{
		die('Could not connect00: ' . mysql_error() .'Seems like you have wrong database setting.');
	}
	if (!$con_db)	
	{
		die('Could not connect: ' . mysql_error() . 'Seems like you have wrong databse name.');
	}

	//UTF8
	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");

?>
<!--con-->