<?php
	$conn = new mysqli('localhost', 'root' , '', 'fullstack111');
	if ($conn->connect_error) {
	    die("connection failed: " . $conn->connect_error);
	}
?>