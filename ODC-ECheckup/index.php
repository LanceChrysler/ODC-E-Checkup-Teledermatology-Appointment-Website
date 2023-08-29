<?php include "assets/config.php"; ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>ODC E-Checkup</title>
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
</head>

<body>
	<nav class="navbar navbar-expand bg-primary navbar-dark py-2 fixed-top">
		<div class="container">
			<a href="#"><img src="assets/img/logo.png" alt="logo"></a>
			<a href="#" class="navbar-brand mx-1">OUR Dermatology Clinic</a>

			<!-- Log in -->
			<div class="collapse navbar-collapse">
				<div class="dropdown navbar-nav ms-auto">
					<button class="btn btn-primary dropdown-toggle" id="dropdown_login" data-bs-toggle="dropdown" aria-expanded="false">Log in</button>
					<ul class="dropdown-menu" aria-labelledby="dropdown_login">
						<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#patient_login">Patient</a></li>
						<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#doctor_login">Doctor</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<!-- Display Update Messsage -->
	<?php include("assets/message.php"); ?>

	<!-- Display Error Message -->
	<?php include("assets/errors.php"); ?>

	<!-- Sign Up -->
	<section class="text-center text-md-start">
		<div class="container py-5">
			<div class="d-sm-flex align-items-center justify-content-between">
				<img src="assets/img/laptop.jpg" alt="laptop" class="img-fluid rounded mx-auto d-none d-md-block w-50">
				<div class="px-5">
					<h1>Get <span class="text-primary">Started</span>!</h1>
					<p class="lead">Free Teledermatology Services.<br>You can consult with our professional
						dermatologists through hassle-free online conferencing. Sign up for an account now!</p>
					<button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#signup">Sign
						Up</button>
				</div>
			</div>
		</div>
	</section>

	<!-- About the Clinic -->
	<section>
		<div class="container text-center align-items-center justify-content-between">
			<div class="row my-3 d-md-flex">
				<div class="col-md">
					<img src="assets/img/doctors.svg" alt="doctors" class="img-fluid mx-auto w-70">
				</div>
				<div class="col-md card bg-transparent border-none">
					<div class="card-header">
						Welcome to OUR Dermatology Clinic! Feel the ease and convenience of online consultation.
						You may book your appointment requests for teledermatology clinic services, from the comfort of your home!
					</div>
					<div class="card-body bg-transparent">
						<b><i>No long queues.<br>
								No location boundaries.<br>
								No transportation costs.</i></b>
					</div>
					<div class="card-footer text-info bg-transparent">
						<span class="text-primary"><a href="#"><b>Sign up and book your appointment now!</b></a></span>
					</div>
				</div>
				<div class="col-md">
					<img src="assets/img/medicine.svg" alt="doctors" class="img-fluid mx-auto w-70">
				</div>
			</div>
		</div>
	</section>

	<footer class="bg-dark text-white text-start p-3 position-relative">
		<div class="container">
			<p class="lead">Copyright &copy; OUR Dermatology Clinic</p>
			<button class="position-absolute bottom-0 end-0 p-3" data-bs-toggle="modal" data-bs-target="#admin_login">Admin<span class="bi-shield"></span></button>
		</div>
	</footer>

	<!-- Modal for Sign Up -->
	<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="signupLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="signupLabel">Sign Up</h5>
					<button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
						<div class="mb-3">
							<label for="patient_username">Username:</label>
							<input type="text" class="form-control" name="patient_username">
						</div>
						<div class="mb-3">
							<label for="patient_email">Email:</label>
							<input type="email" class="form-control" name="patient_email">
						</div>
						<div class="mb-3">
							<label for="patient_password">Password:</label>
							<input type="password" class="form-control" minlength="8" name="patient_password">
						</div>
						<div class="mb-3">
							<label for="patient_passwordConfirm">Confirm Password:</label>
							<input type="password" class="form-control" minlength="8" name="patient_passwordConfirm">
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="sign_Up" class="btn btn-primary">Sign Up</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal for Patient Login -->
	<div class="modal fade" id="patient_login" tabindex="-1" aria-labelledby="patient_loginLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="patient_loginLabel">Patient Log in</h5>
					<button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
						<div class="mb-3">
							<label for="patient_username">Username:</label>
							<input type="text" class="form-control" name="patient_username" required>
						</div>
						<div class="mb-3">
							<label for="patient_password">Password:</label>
							<input type="password" class="form-control" name="patient_password" required>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button name="login_patient" class="btn btn-primary" type="submit">Log in</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal for Doctor Login -->
	<div class="modal fade" id="doctor_login" tabindex="-1" aria-labelledby="doctor_loginLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="doctor_loginLabel">Doctor Log in</h5>
					<button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
						<div class="mb-3">
							<label for="doctor_username">Username:</label>
							<input type="text" class="form-control" name="doctor_username" required>
						</div>
						<div class="mb-3">
							<label for="doctor_password">Password:</label>
							<input type="password" class="form-control" name="doctor_password" required>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button name="login_doctor" class="btn btn-primary" type="submit">Log in</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal for Admin Login -->
	<div class="modal fade" id="admin_login" tabindex="-1" aria-labelledby="admin_loginLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="admin_loginLabel">Admin Log in</h5>
					<button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
						<div class="mb-3">
							<label for="admin_username">Username:</label>
							<input type="text" class="form-control" name="admin_username">
						</div>
						<div class="mb-3">
							<label for="admin_password">Password:</label>
							<input type="password" class="form-control" name="admin_password">
						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="login_admin" class="btn btn-primary">Log in</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>