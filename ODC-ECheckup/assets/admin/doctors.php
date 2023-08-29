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

$doctor_qry = "SELECT * FROM doctor_table";

$results = mysqli_query($conn, $doctor_qry);

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
                        <a class="nav-link" href="patients.php">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Doctors</a>
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
                    <!-- Display Update Messsage -->
                    <?php include("../message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <span class="h2">Doctor Records</span>
                            <a href="#add_doctor" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#add_doctor"><span class="bi-person-plus-fill"> </span>Add</a>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                        if ($row_count > 0) {
                                            foreach ($results as $result) {
                                        ?>
                                                <tr>
                                                    <td><?= $result['doctor_id']; ?></td>
                                                    <td><?= $result['doctor_name']; ?></td>
                                                    <td><?= $result['doctor_sex']; ?></td>
                                                    <td><?= $result['doctor_age']; ?></td>
                                                    <td><?= $result['doctor_email']; ?></td>
                                                    <td><?= $result['doctor_status']; ?>
                                                    <td>
                                                        <form action="doctor_profile.php" method="post">
                                                            <button class="col-12 btn btn-sm bg-secondary text-white" type="submit" name="selected_doctor" value="<?= $result['doctor_id']; ?>">View</button>
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

    <!-- Doctor Details -->
    <div class="modal fade" id="add_doctor" tabindex="-1" aria-labelledby="add_doctorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_doctorLabel">Doctor Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="doctor_username">Username:</label>
                            <input type="text" class="form-control" name="doctor_username">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_email">Email:</label>
                            <input type="email" class="form-control" name="doctor_email">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_password">Password:</label>
                            <input type="password" class="form-control" name="doctor_password">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_name">Name:</label>
                            <input type="text" class="form-control" name="doctor_name">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_phone_no">Phone:</label>
                            <input type="text" class="form-control" name="doctor_phone_no" maxlength="11" placeholder="09*********" oninput="this.value = this.value.replace(/[^0-9]/, '');">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_sex">Sex:</label>
                            <select class="form-control" name="doctor_sex">
                                <option class="form-control" value=""></option>
                                <option class="form-control" value="M">Male</option>
                                <option class="form-control" value="F">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="doctor_age">Age:</label>
                            <input type="number" class="form-control" name="doctor_age">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_birthdate">Birthdate:</label>
                            <input type="date" class="form-control" name="doctor_birthdate">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_address">Address:</label>
                            <input type="text" class="form-control" name="doctor_address">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_doctor" class="btn btn-primary">Add Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>