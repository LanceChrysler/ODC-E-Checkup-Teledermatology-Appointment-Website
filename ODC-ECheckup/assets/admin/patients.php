<?php
include "../config.php";

//Check if someone is logged in
if (!isset($_SESSION['admin_id'])) {

    header('location:../../index.php');
}

$_SESSION['chosen_patient'] = NULL;

$sessionUser = $_SESSION['admin_id'];

$admin_data = "SELECT * FROM admin_table WHERE admin_id='$sessionUser'";

$results = mysqli_query($conn, $admin_data);

$admin = mysqli_fetch_array($results);

$patient_qry = "SELECT * FROM patient_table";

$results = mysqli_query($conn, $patient_qry);

$row_count = mysqli_num_rows($results);

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
                        <a class="nav-link" href="#">Patients</a>
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

    <section>
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h2">Patient Records</span>
                        </div>
                        <div class="card-body">
                            <div class="container table-responsive-md">
                                <table class="table table-light table-hover caption-top">
                                    <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>Nationality</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                        if ($row_count > 0) {
                                            foreach ($results as $result) {
                                        ?>
                                                <tr>
                                                    <td><?= $result['patient_id']; ?></td>
                                                    <td><?= $result['patient_name']; ?></td>
                                                    <td><?= $result['patient_sex']; ?></td>
                                                    <td><?= $result['patient_age']; ?></td>
                                                    <td><?= $result['patient_email']; ?></td>
                                                    <td><?= $result['patient_nationality']; ?></td>
                                                    <td>
                                                        <form action="patient_profile.php" method="post">
                                                            <button class="col-12 btn btn-sm bg-secondary text-white" type="submit" name="selected_patient" value="<?= $result['patient_id']; ?>">View</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Patient Profile -->
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
                            <input type="text" class="form-control" name="patient_username" <?php echo $username; ?>>
                        </div>
                        <div class="mb-3">
                            <label for="patient_email">Email:</label>
                            <input type="email" class="form-control" name="patient_email" <?php echo $email; ?>>
                        </div>
                        <div class="mb-3">
                            <label for="patient_password">Password:</label>
                            <input type="password" class="form-control" name="patient_password">
                        </div>
                        <div class="mb-3">
                            <label for="patient_passwordConfirm">Confirm Password:</label>
                            <input type="password" class="form-control" name="patient_passwordConfirm">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>