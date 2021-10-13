<?php
session_start();
include("includes/config.php");


$nic = $fname = $lname = $email = $mobile = $password = $confirm_password = $address = $msg = $success = "";
$nic_err = $fname_err = $lname_err = $email_err = $mobile_err = $password_err = $cpassword_err = $address_err = "";


if (isset($_POST['signup'])) {


    if (strlen(trim($_POST["nic"])) != 10 && strlen(trim($_POST["nic"])) != 12) {
        $nic_err = "Please provide a valid NIC number";
        $msg = "Registration failed!";
    } elseif (!preg_match('/([0-9]{9}[vVxX]{1}|[0-9]{12})/', trim($_POST["nic"]))) {
        $nic_err = "Please provide a valid NIC number";
        $msg = "Registration failed!";
    } else {
        $sql = "SELECT nic FROM user WHERE nic = :nic";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nic", $param_nic, PDO::PARAM_STR);
            $param_nic = trim($_POST["nic"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $nic_err = "This NIC has been alreadyregistered.";
                    $msg = "Registration failed! you have been already registered.";
                } else {
                    $nic = trim($_POST["nic"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                $msg = "Registration failed";
            }
            unset($stmt);
        }
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
        $msg = "Registration failed";
    } elseif (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", trim($_POST["email"]))) {
        $email_err = "Please provide a valid email address";
        $msg = "Registration failed";
    } else {
        $sql = "SELECT email FROM user WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "This email is not available.";
                    $msg = "Registration failed!";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                $msg = "Registration failed";
            }
            unset($stmt);
        }
    }

    if (empty(($_POST["mobile"]))) {
        $mobile_err = "Please enter a mobile.";
        $msg = "Registration failed";
    } elseif ((strlen(($_POST["mobile"])) != 10) && (!preg_match('/[0-9]{10}/', ($_POST["mobile"])))) {
        $mobile_err = "mobile numbers contain numbers only.";
        $msg = "Registration failed";
    } else {
        $sql = "SELECT mobile FROM user WHERE mobile = :mobile";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $param_mobile = trim($_POST["mobile"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {

                    $mobile_err = "This contact number not available for registration";
                    $msg = "Registration failed!";
                } else {
                    $mobile = trim($_POST["mobile"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                $msg = "Registration failed";
            }
            unset($stmt);
        }
    }

    if (empty(trim($_POST["fname"]))) {
        $fname_err = "Please enter your name.";
        $msg = "Registration failed";
    } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["fname"]))) {
        $fname_err = "Please enter a valid name";
        $msg = "Registration failed";
    } else {
        $fname = trim($_POST["fname"]);
    }

    if (empty(trim($_POST["lname"]))) {
        $lname_err = "Please enter your last name.";
        $msg = "Registration failed";
    } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["lname"]))) {
        $lname_err = "Please enter a valid name";
        $msg = "Registration failed";
    } else {
        $lname = trim($_POST["lname"]);
    }

    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
        $msg = "Registration failed";
    } else {
        $address = trim($_POST["address"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have atleast 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["cpassword"]))) {
        $cpassword_err = "Please confirm your password.";
        $msg = "Registration failed! please confirm password";
    } else {
        $cpassword = trim($_POST["cpassword"]);
        if (empty($password_err) && ($password != $cpassword)) {
            $cpassword_err = "Password did not match.";
            $msg = "Registration failed";
        }
    }

    if (empty($nic_err) && empty($fname_err) && empty($lname_err) && empty($address_err) && empty($email_err) && empty($mobile_err) && empty($password_err) && empty($cpassword_err)) {

        $sql = "INSERT INTO user (nic,fname, lname, email, mobile, password) VALUES (:nic, :fname, :lname ,:email, :mobile, :password)";
        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":nic", $param_nic, PDO::PARAM_STR);
            $stmt->bindParam(":fname", $param_fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $param_lname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $param_mobile, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            $param_nic = $nic;
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {

                $_SESSION['status'] = "have Registered successfully! ";
                $_SESSION['nic'] = $nic;
                $nic = $fname = $lname = $email = $mobile = $password = $confirm_password = $address = "";
                $_SESSION["user_id"] =   $user_id;
                header("Location:index.php");
                exit();
            } else {
                $msg = "Something went wrong please try again.";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/tos.css">
    <link rel="stylesheet" href="css/signup.css">

<body class="bg-dark ">

    <main>
        <div class="home-ua position-relative overflow-hidden  min-vh-75 all mx-5 my-5 ">
            <center class="vh-75 overflow-hidden">
                <h3 class="pt-4">Signup page</h3>
                <form action="" class="my-5 mt-n1 mx-5 black-t pb-4 rounded-3 form-double all" method="post">
                    <div class="nav justify-content-end text-end ">
                        <a href="index.php#home" class="btn-close btn-close-white" aria-label="Close"></a>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-11 col-md-5 text-center" style="max-width: 300px;">

                            <div class="form-outline mb-4 ">
                                <input id="nic" class="form-control text-info fw-bold" name="nic" type="text" placeholder="<?php echo $nic_err;  ?>" value="<?php echo $nic ?>" required minlength="10" maxlength="12">
                                <label class="form-label text-light fw-bold ">NIC No</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="fname" class="form-control text-info fw-bold" name="fname" type="text" placeholder="<?php echo $fname_err;  ?>" value="<?php echo $fname ?>" pattern="[A-Za-z]+" autocomplete="off" required>
                                <label class="form-label text-light fw-bold">First Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="lname" class="form-control text-info fw-bold" name="lname" type="text" placeholder="<?php echo $lname_err;  ?>" value="<?php echo $lname ?>" pattern="[A-Za-z]+" required>
                                <label class="form-label text-light fw-bold">Last Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="address" class="form-control text-info fw-bold" name="address" type="text" placeholder="<?php echo $address_err;  ?> " value="<?php echo $address ?>" required>
                                <label class="form-label text-light fw-bold">Address</label>
                            </div>
                        </div>
                        <div class="col-11 col-md-5 text-center" style="max-width: 300px;">
                            <div class="form-outline mb-4">
                                <input id="email" class="form-control text-info fw-bold" name="email" type="email" placeholder="<?php echo $email_err;  ?> " value="<?php echo $email ?>" required>
                                <label class="form-label text-light fw-bold">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="mobile" class="form-control text-info fw-bold" name="mobile" type="tel" placeholder="<?php echo $mobile_err;  ?> " value="<?php echo $mobile ?>" pattern="[0]{1}[0-9]{9}" maxlength="10" required>
                                <label class="form-label text-light fw-bold">Contact Number</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="password" class="form-control text-info fw-bold" name="password" type="password" placeholder="<?php echo $password_err;  ?> " value="<?php echo $password ?>" minlength="8" required>
                                <label class="form-label text-light fw-bold">Password</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="conpassword" class="form-control text-info fw-bold" name="cpassword" type="password <?php echo (!empty($cpassword_err)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $cpassword_err;  ?> " required>
                                <label class="form-label text-light fw-bold">Confirm Password</label>
                            </div>
                        </div>

                    </div>


                    <div class="form-check d-flex justify-content-center mb-4 ">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                        <label class="form-check-label" for="form2Example3">
                            <span class="text-light fw-bold">I agree the<a href="www.google.com">Terms & Conditions </a></span>
                        </label>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-rounded btn-success mx-1 px-5" type="submit" value="register" name="signup">
                        <input class="btn btn-rounded btn-danger mx-1 px-5" type="reset" value="Reset">
                    </div>
                </form>
            </center>
        </div>

    </main>




    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    </head>

    <body>

    </body>

</html>