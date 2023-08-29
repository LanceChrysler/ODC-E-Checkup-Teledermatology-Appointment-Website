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

$appointment_qry = "SELECT appointment_reason, appointment_comms, appointment_date, appointment_status FROM appointment_table WHERE patient_id='$sessionUser' AND appointment_status = 'Waiting for Schedule'";

$results = mysqli_query($conn, $appointment_qry);

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
            <a href="menu.php"><img src="../img/logo.png" alt="logo"></a>
            <a href="menu.php" class="navbar-brand mx-1">OUR Dermatology Clinic</a>

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
                        <a class="nav-link" href="#">Appointment Record</a>
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

    <!-- Appointment Records -->
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h2">Appointment Records</span>
                        </div>
                        <div class="card-body">
                            <div class="container accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            <span class="h5">Pending Appointments</span>
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <!-- List of Scheduled Appointment -->
                                            <section>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="container table-responsive-lg">
                                                            <table class="table table-light table-hover caption-top">
                                                                <?php
                                                                if ($row_count == 0) {
                                                                ?>
                                                                    <strong>No Pending Appointment</strong>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <thead>
                                                                        <th>No.</th>
                                                                        <th>Reason</th>
                                                                        <th>Communication</th>
                                                                        <th>Status</th>
                                                                    </thead>
                                                                    <tbody class="table-group-divider">
                                                                        <?php
                                                                        $appointment_number = 1;
                                                                        foreach ($results as $result) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?= $appointment_number ?></td>
                                                                                <td><?= $result['appointment_reason']; ?></td>
                                                                                <td><?= $result['appointment_comms']; ?></td>
                                                                                <td><?= $result['appointment_status']; ?></td>
                                                                            </tr>
                                                                    <?php
                                                                            $appointment_number++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            <span class="h5">Scheduled Appointments</span>
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <!-- List of Scheduled Appointment -->
                                            <section>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="container table-responsive-lg">
                                                            <table class="table table-light table-hover caption-top">
                                                                <?php
                                                                $appointment_qry = "SELECT * FROM appointment_table JOIN doctor_table ON appointment_table.doctor_id = doctor_table.doctor_id WHERE appointment_status = 'Scheduled' AND patient_id = '$sessionUser' ORDER BY appointment_date ASC";

                                                                $results = mysqli_query($conn, $appointment_qry);

                                                                $row_count = mysqli_num_rows($results);
                                                                if ($row_count == 0) {
                                                                ?>
                                                                    <strong>No Scheduled Appointments</strong>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <thead>
                                                                        <th>No.</th>
                                                                        <th>Reason</th>
                                                                        <th>Communication</th>
                                                                        <th>Status</th>
                                                                        <th>Doctor</th>
                                                                        <th>Schedule</th>
                                                                    </thead>
                                                                    <tbody class="table-group-divider">
                                                                        <?php
                                                                        $appointment_number = 1;
                                                                        foreach ($results as $result) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?= $appointment_number ?></td>
                                                                                <td><?= $result['appointment_reason']; ?></td>
                                                                                <td><?= $result['appointment_comms']; ?></td>
                                                                                <td><?= $result['appointment_status']; ?></td>
                                                                                <td><?= $result['doctor_name']; ?></td>
                                                                                <td><?= $result['appointment_date']; ?></td>
                                                                            </tr>
                                                                    <?php
                                                                            $appointment_number++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            <span class="h5">Completed Appointments</span>
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            <!-- List of Completed Appointment -->
                                            <section>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="container table-responsive-lg">
                                                            <table class="table table-light table-hover caption-top">
                                                                <?php
                                                                $appointment_number = 1;

                                                                $appointment_qry = "SELECT * FROM appointment_table JOIN doctor_table ON appointment_table.doctor_id = doctor_table.doctor_id WHERE appointment_status = 'Completed' AND patient_id = '$sessionUser' ORDER BY appointment_date ASC";

                                                                $results = mysqli_query($conn, $appointment_qry);

                                                                $row_count = mysqli_num_rows($results);
                                                                if ($row_count == 0) {
                                                                ?>
                                                                    <strong>No Completed Appointments</strong>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <thead>
                                                                        <th>No.</th>
                                                                        <th>Reason</th>
                                                                        <th>Communication</th>
                                                                        <th>Status</th>
                                                                        <th>Doctor</th>
                                                                        <th>Schedule</th>
                                                                    </thead>
                                                                    <tbody class="table-group-divider">
                                                                        <?php
                                                                        $appointment_number = 1;
                                                                        foreach ($results as $result) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?= $appointment_number ?></td>
                                                                                <td><?= $result['appointment_reason']; ?></td>
                                                                                <td><?= $result['appointment_comms']; ?></td>
                                                                                <td><?= $result['appointment_status']; ?></td>
                                                                                <td><?= $result['doctor_name']; ?></td>
                                                                                <td><?= $result['appointment_date']; ?></td>
                                                                            </tr>
                                                                    <?php
                                                                            $appointment_number++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                            </section>
                                        </div>
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