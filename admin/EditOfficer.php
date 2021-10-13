<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}


include_once("includes/config.php");
$officer_id = $work_status = $lname = $email = $mobile = $station = $update = $update_err = "";
$officer_id_err = $work_status_err = $email_err = $mobile_err = $station_err = "";

if (isset($_POST["officer_id"]) && !empty($_POST["officer_id"])) {

    $officer_id = $_POST["officer_id"];

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
        $update_err = "Registration failed";
    } elseif (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", trim($_POST["email"]))) {
        $email_err = "Please provide a valid email station";
        $update_err = "Registration failed";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(($_POST["mobile"]))) {
        $mobile_err = "Please enter a mobile.";
        $update_err = "Registration failed";
    } elseif ((strlen(($_POST["mobile"])) != 10) && (!preg_match('/[0-9]{10}/', ($_POST["mobile"])))) {
        $mobile_err = "mobile numbers contain numbers only.";
        $update_err = "Registration failed";
    } else {
        $mobile = trim($_POST["mobile"]);
    }

    if (empty(trim($_POST["station"]))) {
        $station_err = "Please enter your name.";
        $update_err = "Registration failed";
    } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["station"]))) {
        $station_err = "Please enter a valid name";
        $update_err = "Registration failed";
    } else {
        $station = trim($_POST["station"]);
    }

    if (empty(trim($_POST["work_status"]))) {
        $work_status_err = "Please enter a valid name";
        $update_err = "Registration failed";
    } else {
        $work_status = trim($_POST["work_status"]);
    }

    if (empty($officer_id_err) && empty($fname_err) && empty($lname_err) && empty($station_err) && empty($email_err) && empty($mobile_err)) {

        $sql = "UPDATE officer SET email=:email, mobile=:mobile,station=:station,work_status =:work_status WHERE officer_id=:officer_id ";
        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":officer_id", $param_officer_id, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $stmt->bindParam(":station", $param_station, PDO::PARAM_STR);
            $stmt->bindParam(":work_status", $param_work_status, PDO::PARAM_STR);

            $param_officer_id = $officer_id;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_station = $station;
            $param_work_status = $work_status;

            if ($stmt->execute()) {
                $_SESSION['update'] = "Data edited successfully!!";
                header("Location:manageofficer.php");
                exit();
            } else {
                $_SESSION['update'] = "Registered failed!";
                header("Location:updateOff.php");
                exit();
            }
            unset($stmt);
        }
    }
    unset($pdo);
} else {
    if (isset($_GET["officer_id"]) && !empty(trim($_GET["officer_id"]))) {
        $officer_id = trim($_GET["officer_id"]);

        $sql = "SELECT * FROM officer WHERE officer_id = :officer_id";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":officer_id", $param_officer_id);

            $param_officer_id = $officer_id;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $fname = $row["fname"];
                    $email = $row["email"];
                    $mobile = $row["mobile"];
                    $station = $row["station"];
                    $work_status = $row["work_status"];
                } else {
                    $_SESSION['update'] = "added officer account successfully!";
                    header("location: manageOfficers.php");
                    exit();
                }
            } else {
                $update_err = "Officer accoungt update failed";
            }
        }

        unset($stmt);

        unset($pdo);
    } else {
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap 5 Side Bar Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js"
        integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/tos.css">

</head>

<body class="">

    <!-- Side-Nav -->
    <?php include('includes/sidebar.php') ?>
    <!-- Main Wrapper -->
    <div class=" my-container active-cont ">
        <!-- Top Nav -->
        <?php include('includes/topbar.php') ?>
        <!--End Top Nav -->
        <div class="container px-5   all mt-xl-1">

            <div class="container pt-3">
                <div class="mb-1 bottom">
                    <p class="btn add-btn fw-bolder btn-rounded btn-lg btn-light"> Manage traffic officers' account
                    </p>
                    <div class="row justify-content-center">

                        <div class="row mx-0 text-ceneter" style="max-width: 460px;min-width:360px">
                            <div class="all mx-1 my-1 ">
                                <div class="row justify-content-between pt-3 px-1 mb-4 all">
                                    <div class="col-9">
                                        <h4 class="fw-bold">Edit officers' detail form</h4>
                                    </div>
                                    <div class="col-2">

                                        <a type="button" href="manageOfficers.php"
                                            class="btn-close btn-rounded btn-danger" aria-label="Close"></a>

                                    </div>
                                </div>
                                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"
                                    class="px-5  pb-3 " method="post">
                                    <div class="">
                                        <input name="officer_id" type="text" class="rounded-pill"
                                            placeholder="<?php echo $officer_id_err;  ?>"
                                            value="<?php echo $officer_id ?>" required minlength="6" maxlength="6"
                                            hidden>
                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Officer
                                            ID</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="officer_id" type="text" value="<?php echo $officer_id ?>" disabled>

                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Officer
                                            Name</label>
                                        <input
                                            class="all bg-none btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="name" type="text" value="<?php echo $fname . " " . $lname; ?>"
                                            disabled>

                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">station</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="station" type="text" placeholder="<?php echo $station_err;   ?> "
                                            value="<?php echo $station ?>" required>

                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Duty
                                            status</label>
                                        <select
                                            class="all bg-transparent btn py-2 fw-bolder bg-light all btn-rounded col-6 "
                                            name="work_status" placeholder="<?php echo $work_status_err;  ?> "
                                            value="<?php echo $work_status ?>">
                                            <option class=" btn-rounded py-2 fw-bolder btn-dark" value="active">Active
                                            </option>
                                            <option class=" btn-rounded py-2 fw-bolder btn-dark" value="retired">
                                                Retired
                                            </option>
                                            <option class=" btn-rounded py-2 fw-bolder btn-dark" value="suspended">
                                                Suspended
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Email
                                            address</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="email" type="email" placeholder="<?php echo $email_err;  ?> "
                                            value="<?php echo $email ?>" required>
                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">

                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Contact
                                            Number</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="mobile" type="tel" placeholder="<?php echo $mobile_err;  ?> "
                                            value="<?php echo $mobile ?>" pattern="[0]{1}[0-9]{9}" maxlength="10"
                                            required>
                                    </div>

                                    <div class="text-center mt-3 " role="group" aria-label="Basic example">
                                        <button type="submit" value="Submit"
                                            class="btn btn-success btn-rounded fw-bold ">submit</button>
                                        <a href="" class="btn btn-danger btn-rounded fw-bold ">Reset</a>

                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <script src="js/db_graph1.js"></script>

        <!-- sidebar toggle -->
        <script>
        var menu_btn = document.querySelector("#menu-btn");
        var sidebar = document.querySelector("#sidebar");
        var container = document.querySelector(".my-container");
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav");
            container.classList.toggle("active-cont");
        });
        </script>
</body>

</html>