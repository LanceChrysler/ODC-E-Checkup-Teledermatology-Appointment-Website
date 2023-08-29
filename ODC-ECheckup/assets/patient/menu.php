<?php
include "../config.php";

//Check if someone is logged in
if (!isset($_SESSION['patient_id'])) {

	header('location:../../index.php');
}

$sessionUser = $_SESSION['patient_id'];

$patient_data = "SELECT * FROM patient_table WHERE patient_id='$sessionUser'";

$results = mysqli_query($conn, $patient_data);

$patient = mysqli_fetch_array($results);

$appointment_data = "SELECT * FROM appointment_table WHERE patient_id='$sessionUser' AND appointment_status='Waiting for schedule'";

$results = mysqli_query($conn, $appointment_data);

$patient_pending_appointment = mysqli_num_rows($results);

$appointment_data = "SELECT * FROM appointment_table WHERE patient_id='$sessionUser' AND appointment_status='Scheduled'";

$results = mysqli_query($conn, $appointment_data);

$patient_scheduled_appointment = mysqli_num_rows($results);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="../css/style.css">
	<title>ODC E-Checkup</title>
	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark py-2 fixed-top">
		<div class="container">
			<!-- Branding -->
			<a href="#"><img src="../img/logo.png" alt="logo"></a>
			<a href="#" class="navbar-brand mx-1">OUR Dermatology Clinic</a>

			<!-- Menu -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navmenu">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="request_appointment.php">Request Appointment</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="appointment_records.php">Appointment Record</a>
					</li>

					<li class="nav-item">
						<div class="dropdown navbar-nav">
							<button class="pt-2 dropdown-toggle" id="dropdown_logout" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="bi-person-fill"> </span><?php if (!empty($patient['patient_name'])) echo $patient['patient_name'];
																		else echo $patient['patient_username']; ?>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdown_logout">
								<li><a class="dropdown-item" data-bs-toggle="modal" onClick="location.href='profile.php'">Profile</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" data-bs-toggle="modal" href="../logout.php">Log out</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="text-center text-md-start">
		<div class="container py-5">
			<div class="row">
				<div class="d-lg-flex align-items-center ">
					<!-- first column -->
					<div class="col px-5">
						<p class="head">Welcome to OUR Dermatology Clinic, <br><b><span class="text-primary"><?php if (!empty($patient['patient_name'])) echo $patient['patient_name'];
																												else echo $patient['patient_username']; ?></span></b>!</p>
						<hr>
						<p class="body">Feel the ease and convenience of online consultation. You may book your appointment requests for teledermatology clinic services, from the comfort of your home!</p>
						<p class="list"><b><i>No long queues.<br>No location boundaries.<br>No transportation costs.</i></b></p>
						<p class="book"><a href="request_appointment.php"><b>Book your appointment now!</b></a></p>
					</div>
					<!-- 2nd column -->
					<div class="col">
						<!-- 1st row -->
						<div class="row">
							<div class="col card" style="width: 18rem;">
								<div class="card-header card-title">
									<h5>Pending Appointment</h5>
								</div>
								<div class="card-body card-text h5">
									<?php
									if ($patient_pending_appointment == 0)
										echo 'No appointment requests';
									else echo $patient_pending_appointment;
									?>
								</div>
							</div>
							<div class="col card" style="width: 18rem;">
								<div class="card-header">
									<h5 class="card-title">Scheduled Appointment</h5>
								</div>
								<div class="card-body card-text h5">
									<?php
									if ($patient_scheduled_appointment == 0)
										echo 'No scheduled appointments';
									else echo $patient_scheduled_appointment;
									?></div>
							</div>
							<!-- 2nd row -->
							<div class="row">
								<img src="../img/welcome.png" alt="welcome" class="img-fluid rounded mx-auto d-none d-md-block w-100%">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>