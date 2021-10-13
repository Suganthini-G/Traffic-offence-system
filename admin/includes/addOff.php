<?php

include('config.php');
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
                    $officer_id_err = "This officer ID has been already registered";
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
                    $email_err = "This email not available.";
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
        $mobile_err = "mobile numbers contain numbers only.";
        $msg = "Account creation failed";
    } else {
        $sql = "SELECT mobile FROM officer WHERE mobile = :mobile";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $param_mobile = trim($_POST["mobile"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {

                    $mobile_err = "This contact number not available for Account creation";
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
        $fname_err = "Please enter a valid name";
        $msg = "Account creation failed";
    } else {
        $fname = trim($_POST["fname"]);
    }

    if (!preg_match('/^[a-zA-Z]+$/', trim($_POST["lname"]))) {
        $lname_err = "Please enter a valid name";
        $msg = "Account creation failed";
    } else {
        $lname = trim($_POST["lname"]);
    }

    if (!preg_match('/^[a-zA-Z]+$/', trim($_POST["station"]))) {
        $station_err = "Please enter a valid name";
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
                header("Location:manageofficer.php");
                exit();
            } else {
                $msg = "Account creation failed!";
                header("Location:addOff.php");
                exit();
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
