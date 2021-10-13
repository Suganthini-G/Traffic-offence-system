<?php
session_start();

include_once("config.php");
$officer_id = $work_status  = $email = $mobile = $station = $update = $update_err = "";
$officer_id_err = $work_status_err  = $email_err = $mobile_err = $station_err =  "";

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
        $officer_id =  trim($_GET["officer_id"]);

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
                    header("location: manageOfficer.php");
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
