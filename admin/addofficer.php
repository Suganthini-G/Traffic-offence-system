<?php
//session_start();

include_once("includes/config.php");

$officer_id = $fname = $lname = $email = $mobile = $station = $add = $work_status = $msg = "";
$officer_id_err = $fname_err = $lname_err = $email_err = $mobile_err = $station_err =  "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((strlen(($_POST["officer_id"])) != 6) && (!preg_match('/[0-9]{6}/', ($_POST["officer_id"])))) {
        $officer_id_err = "officer_id contain just six digits!";
        $msg = "Accountt creation failed!";
    } else {
        $sql = "SELECT officer_id FROM officer WHERE officer_id = :officer_id";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":officer_id", $param_officer_id, PDO::PARAM_STR);
            $param_officer_id = trim($_POST["officer_id"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $officer_id_err = "Already registered ID";
                    $msg = "Accountt creation  failed!";
                } else {
                    $officer_id = trim($_POST["officer_id"]);
                }
            } else {
                $msg = "Account creation failed";
            }
            unset($stmt);
        }
    }

    if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", trim($_POST["email"]))) {
        $email_err = "Please provide a valid email station";
        $msg = "Account creation failed";
    } else {
        $sql = "SELECT email FROM officer WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "Email not available.";
                    $msg = "Account creation failed!";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                $msg = "Account creation failed";
            }
            unset($stmt);
        }
    }
    if (empty(($_POST["mobile"]))) {
        $mobile_err = "Please enter a mobile.";
        $msg = "Account creation failed";
    } elseif ((strlen(($_POST["mobile"])) != 10) && (!preg_match('/[0-9]{10}/', ($_POST["mobile"])))) {
        $mobile_err = "Not valid";
        $msg = "Account creation failed";
    } else {
        $sql = "SELECT mobile FROM officer WHERE mobile = :mobile";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $param_mobile = trim($_POST["mobile"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {

                    $mobile_err = "Not available";
                    $msg = "Account creation failed!";
                } else {
                    $mobile = trim($_POST["mobile"]);
                }
            } else {

                $msg = "Account creation failed";
            }
            unset($stmt);
        }
    }

    if (!preg_match('/^[a-zA-Z]+$/', trim($_POST["fname"]))) {
        $fname_err = "Not valid";
        $msg = "Account creation failed";
    } else {
        $fname = trim($_POST["fname"]);
    }

    if (!preg_match('/^[a-zA-Z]+$/', trim($_POST["lname"]))) {
        $lname_err = "Not valid";
        $msg = "Account creation failed";
    } else {
        $lname = trim($_POST["lname"]);
    }

    if (!preg_match('/^[a-zA-Z]+$/', trim($_POST["station"]))) {
        $station_err = "Not valid";
        $msg = "Account creation failed";
    } else {
        $station = trim($_POST["station"]);
        $password = "abcd1234";
        $work_status = "active";
    }


    if (empty($officer_id_err) && empty($fname_err) && empty($lname_err) && empty($station_err) && empty($email_err) && empty($mobile_err)) {

        $sql = "INSERT INTO officer (officer_id,fname, lname, email, mobile, station, password, work_status) VALUES (:officer_id, :fname, :lname ,:email, :mobile, :station, :password, :work_status)";
        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":officer_id", $param_officer_id, PDO::PARAM_STR);
            $stmt->bindParam(":fname", $param_fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $param_lname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $stmt->bindParam(":station", $param_station, PDO::PARAM_STR);
            $stmt->bindParam(":work_status", $param_work_status, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            $param_officer_id = $officer_id;
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_station = $station;
            $param_work_status = $work_status;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                $officer_id = $fname = $lname = $email = $mobile = $password = $confirm_password = $station = $work_status = "";
                $_SESSION['add'] = "added officer account successfully!";
                header("Location:manageofficers.php");
                exit();
            } else {
                $msg = "Account creation failed!";
                header("Location:addOfficer.php");
                exit();
            }
            unset($stmt);
        }
    }
    unset($pdo);
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
                <div class="mb-5bottom">
                    <p class="btn add-btn fw-bolder btn-rounded btn-lg btn-light"> Manage traffic offences
                    </p>
                </div>
                <div class="mb-1 bottom">
                    <div class="row justify-content-center">

                        <div class="row mx-0 text-ceneter add-btn" style="max-width: 460px;min-width:360px">
                            <div class="all mx-1 my-1 ">
                                <div class="row justify-content-between pt-3 px-1 mb-4 all">
                                    <div class="col-9">
                                        <h4 class="fw-bold">Officer account add form</h4>
                                    </div>
                                    <div class="col-2">

                                        <a type="button" href="manageOfficers.php"
                                            class="btn-close btn-rounded btn-danger" aria-label="Close"></a>

                                    </div>
                                </div>
                                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"
                                    class="px-5 pb-3 " method="post">
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Officer ID</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="officer_id" type="text"
                                            placeholder="<?php echo $officer_id_err;   ?> "
                                            value="<?php echo $officer_id ?>" required>

                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">First name</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="fname" type="text" placeholder="<?php echo $fname_err;   ?> "
                                            value="<?php echo $fname ?>" required>

                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Last name</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="lname" type="text" placeholder="<?php echo $lname_err;   ?> "
                                            value="<?php echo $lname ?>" required>

                                    </div>

                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Station</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            name="station" type="text" placeholder="<?php echo $station_err;   ?> "
                                            value="<?php echo $station ?>" required>

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