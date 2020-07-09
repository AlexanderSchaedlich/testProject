<?php
	$myHost = "localhost";
	$myUser = "root";
	$myPassword = "";
	$myDatabase = "fullstack111";
	$connection = new mysqli($myHost, $myUser, $myPassword, $myDatabase);
	if ($connection->connect_error) {
	    die("Connection failed: " . $connection->connect_error);
	}
	$myPath = "http://" . $myHost . "/Full%20Stack%20Project/fs01-project5-common/alex1/";
?>