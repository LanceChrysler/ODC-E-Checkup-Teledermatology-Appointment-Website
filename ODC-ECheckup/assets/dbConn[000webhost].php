<?php
	session_start();
	
	$servername = "localhost";
	$username = "id19284299_odc_echeckup";
	$password = "IeZU3!&dLECLlh_4";
	$dbname = "id19284299_db_odc_echeckup";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		
	  die("Connection failed: " . $conn->connect_error);
	}
?>