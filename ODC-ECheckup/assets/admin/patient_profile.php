<?php
include "../config.php";

//Check if someone is logged in
if (!isset($_SESSION['admin_id'])) {

    header('location:../../index.php');
}

$sessionUser = $_SESSION['admin_id'];

$admin_data = "SELECT * FROM admin_table WHERE admin_id='$sessionUser'";

$results = mysqli_query($conn, $admin_data);

$admin = mysqli_fetch_array($results);

$selected_patient_id = $_POST['selected_patient'];

$selected_patient_qry = "SELECT * FROM patient_table WHERE patient_id = '$selected_patient_id'";

$patient_row = mysqli_query($conn, $selected_patient_qry);

$patient = mysqli_fetch_array($patient_row);
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
            <a href="menu.php#"><img src="../img/logo.png" alt="logo"></a>
            <a href="menu.php" class="navbar-brand mx-1">OUR Dermatology Clinic</a>

            <!-- Menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="appointment_records.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointment_requests_list.php">Appointment Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="patients.php">Patients</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="doctors.php">Doctors</a>
					</li>

                    <li class="nav-item">
                        <div class="dropdown navbar-nav">
                            <button class="pt-2 dropdown-toggle" id="dropdown_logout" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="bi-person-fill"> Admin </span><?php if (!empty($admin['admin_name'])) echo $admin['admin_name'];
                                                                            else echo $admin['admin_usernaname']; ?>
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

    <!-- Patient Profile Details -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h2">Patient Profile</span>
                            <a href="patients.php" class="btn btn-success float-end">Back</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-light caption-top">
                                <tr>
                                    <th scope="row">Name</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_name" value="<?= $patient['patient_name']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Sex</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_sex" value="<?php echo $patient['patient_sex']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Age</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_age" value="<?php echo $patient['patient_age']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Date of Birth</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_birthdate" value="<?php echo $patient['patient_birthdate']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Place of Birth</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_birthplace" value="<?php echo $patient['patient_birthplace']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_phone_no" value="<?php echo $patient['patient_phone_no']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_email" value="<?php echo $patient['patient_email']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_address" value="<?php echo $patient['patient_address']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Civil Status</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_civil_status" value="<?php echo $patient['patient_civil_status']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nationality</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_nationality" value="<?php echo $patient['patient_nationality']; ?>" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Religion</td>
                                    <td><input type="text" class="form-control-plaintext" name="patient_religion" value="<?php echo $patient['patient_religion']; ?>" readonly />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>