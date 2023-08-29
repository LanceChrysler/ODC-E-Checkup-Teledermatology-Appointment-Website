<?php
	include "dbConn.php";
	
	if(!isset($_SESSION['patient_id']) || !isset($_SESSION['doctor_id'])){
		
		header('location:../index.php');
	}
	
	if(isset($_SESSION['patient_id'])){
		
		session_unset();
		session_destroy();
		$conn->close();
		echo "<script>alert('Logged out!');</script>";
		echo "<script>window.location.href='../index.php'</script>";	
	}
	
	if(isset($_SESSION['doctor_id'])){
		
		session_unset();
		session_destroy();
		$conn->close();

		$sessionUser = $_SESSION['doctor_id'];

		$doctor_data = "UPDATE doctor_table SET doctor_status = 'Inactive' WHERE patient_id='$sessionUser'";
		
		mysqli_query($conn, $doctor_data);

		echo "<script>alert('Logged out!');</script>";
		echo "<script>window.location.href='../index.php'</script>";	
	}
?>