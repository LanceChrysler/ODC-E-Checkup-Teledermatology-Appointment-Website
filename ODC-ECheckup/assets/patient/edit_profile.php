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
                                <li><a class="dropdown-item" data-bs-toggle="modal" href="profile.php">Profile</a></li>
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

    <!-- Profile Details -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="profile.php" method="post" enctype="multipart/form-data">
                            <div class="card-header">
                                <span class="h2"> Profile</span>
                                <a href="profile.php" class="btn btn-success float-end">Back</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-light caption-top">
                                    <tr>
                                        <th scope="row">Name</td>
                                        <td><input type="text" class="form-control" name="patient_name" value="<?php echo $patient['patient_name']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sex</td>
                                        <td><select name="patient_sex" class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option <?php if ($patient['patient_sex'] == "M") echo "selected"; ?> value="M">Male</option>
                                                <option <?php if ($patient['patient_sex'] == "F") echo "selected"; ?> value="F">Female</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Age</td>
                                        <td><input type="number" class="form-control" name="patient_age" value="<?php echo $patient['patient_age']; ?>" min="18" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Birth</td>
                                        <td><input type="date" class="form-control" name="patient_birthdate" value="<?php echo $patient['patient_birthdate']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Place of Birth</td>
                                        <td><input type="text" class="form-control" name="patient_birthplace" value="<?php echo $patient['patient_birthplace']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone</td>
                                        <td><input type="tel" class="form-control" name="patient_phone_no" value="<?php echo $patient['patient_phone_no']; ?>" maxlength="11" placeholder="09*********" oninput="this.value = this.value.replace(/[^0-9]/, '');" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</td>
                                        <td><input type="email" class="form-control" name="patient_email" value="<?php echo $patient['patient_email']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</td>
                                        <td><input type="text" class="form-control" name="patient_address" value="<?php echo $patient['patient_address']; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Civil Status</td>
                                        <td><select name="patient_civil_status" class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option <?php if ($patient['patient_civil_status'] == "Single") echo "selected" ?> value="Single">Single</option>
                                                <option <?php if ($patient['patient_civil_status'] == "Married") echo "selected" ?> value="Married">Married</option>
                                                <option <?php if ($patient['patient_civil_status'] == "Widowed") echo "selected" ?> value="Widowed">Widowed</option>
                                                <option <?php if ($patient['patient_civil_status'] == "Separated") echo "selected" ?> value="Separated">Separated</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nationality</td>
                                        <td><select name="patient_nationality" class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option <?php if ($patient['patient_nationality'] == "Filipino") echo "selected" ?> value="Filipino">Filipino</option>
                                                <option <?php if ($patient['patient_nationality'] == "Foreign National") echo "selected" ?> value="Foreign National">Foreign National</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Religion</td>
                                        <td><input type="text" class="form-control" name="patient_religion" value="<?php echo $patient['patient_religion']; ?>" />
                                        </td>
                                    </tr>
                                </table>
                                <button name="patient_profile" class="btn btn-success" type="submit">Save</button>
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