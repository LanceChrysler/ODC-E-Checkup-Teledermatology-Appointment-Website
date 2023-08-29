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
            <a href="menu.php"><img src="../img/logo.png" alt="logo"></a>
            <a href="menu.php" class="navbar-brand mx-1">OUR Dermatology Clinic</a>

            <!-- Menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Request Appointment</a>
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

    <!-- Request Appointment -->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- Display Update Messsage -->
                    <?php include("../message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <span class="h2">Request for an Appointment</span>
                        </div>
                        <div class="card-body">
                            <form action="request_appointment.php" method="post" enctype="multipart/form-data">
                                <?php include("../errors.php"); ?>
                                <div class="input-group">
                                    <span class="input-group-text">Reason:</span>
                                    <textarea class="form-control" aria-label="With textarea" name="appointment_reason" rows="7" required></textarea>
                                </div>

                                <div class="input-group my-3">
                                    <label class="input-group-text" for="appointment_comms">Mode of Consultation:</label>
                                    <select class="form-select" id="appointment_comms" name="appointment_comms" required>
                                        <option value="">Choose...</option>
                                        <option value="Video Conferencing">Video Conferencing</option>
                                        <option value="Phone Call">Phone Call</option>
                                    </select>
                                </div>
                            

                            <div class="row justify-content-end">
                                <div class="col-12 col-md-6 col-lg-4 align-self-end">
                                    <button name="request" class="btn btn-primary btn-md" type="submit">Request Appointment</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>