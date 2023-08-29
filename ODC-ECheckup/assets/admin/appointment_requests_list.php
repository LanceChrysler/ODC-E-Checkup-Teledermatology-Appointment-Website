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

$appointment_qry = "SELECT * FROM appointment_table JOIN patient_table ON appointment_table.patient_id = patient_table.patient_id WHERE appointment_status = 'Waiting for Schedule'";

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
                        <a class="nav-link" href="#">Appointment Requests</a>
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

    <!-- List of Appointment Request -->
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <!-- Display Update Messsage -->
                    <?php include("../message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <span class="h2">Appointment Requests</span>
                        </div>
                        <div class="card-body">
                            <div class="container table-responsive-md">
                                <table class="table table-light table-hover caption-top">
                                    <?php
                                    if ($row_count == 0) {
                                    ?>
                                        <strong>No Scheduled Appointments</strong>
                                    <?php
                                    } else {
                                    ?><thead>
                                            <th>No.</th>
                                            <th>Patient</th>
                                            <th>Reason</th>
                                            <th>Communication</th>
                                            <th>Status</th>
                                            <th>Accept Appointment</th>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            <?php
                                            $appointment_number = 1;
                                            foreach ($results as $result) {
                                            ?>
                                                <tr>
                                                    <td><?= $appointment_number ?></td>
                                                    <td><?= $result['patient_name']; ?></td>
                                                    <td><?= $result['appointment_reason']; ?></td>
                                                    <td><?= $result['appointment_comms']; ?></td>
                                                    <td><?= $result['appointment_status']; ?></td>
                                                    <td>
                                                        <form action="#" method="post">
                                                            <input type="date" class="col-12 col-xl-4 btn btn-sm bg-white text-dark border-secondary" name="appointment_date" value="" min="2020-01-20" required />
                                                            <select name="doctor_id" class="col-12 col-xl-4 btn btn-sm bg-white text-dark border-secondary" required>
                                                                <option value="" selected> Doctor </option>
                                                                <?php
                                                                $results = mysqli_query($conn, "SELECT * FROM doctor_table");
                                                                while ($row = $results->fetch_assoc()) {
                                                                    echo '<option value="'.$row['doctor_id'].'">' ."Dr." . $row['doctor_name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            
                                                            <!--
                                                            <!--<input type="number" class="col-12 col-lg-3 btn btn-sm bg-white text-dark border-secondary" name="doctor_id" placeholder="Doctor ID" value="" required />-->
                                                            <button class="col-12 col-xl-3 btn btn-sm bg-success text-white" type="submit" name="admin_accept_appointment" value="<?= $result['appointment_id']; ?>">Accept</button>
                                                        </form>
                                                    </td>
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
                </div>
            </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>