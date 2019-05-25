<?php
	session_start();
	
	include("inc/cred.inc.php");
	include("inc/user.inc.php");

	//connect to database
	$dbc = mysqli_connect($hostname,$username_sql,$password_sql,$dbname) OR die("##Couldn't connect to database. ERROR: ".mysqli_connect_error());

	//set encoding
	mysqli_set_charset($dbc,"utf8");


?>