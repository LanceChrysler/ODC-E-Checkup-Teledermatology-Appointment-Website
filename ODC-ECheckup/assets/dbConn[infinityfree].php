<?php
	session_start();
	
	$servername = "sql303.epizy.com";
	$username = "epiz_32206392";
	$password = "6TYH1SNlTeKNTTH";
	$dbname = "epiz_32206392_db_ocd_echeckup";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		
	  die("Connection failed: " . $conn->connect_error);
	}
?>