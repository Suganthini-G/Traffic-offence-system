<?php
session_start();
include('includes/config.php');

$user_id = $password = "";
$user_id_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = trim($_POST["user_id"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT nic, password FROM user WHERE nic = :user_id";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":user_id", $param_nic, PDO::PARAM_STR);
        $param_nic = trim($_POST["user_id"]);

        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    $user_id = $row["nic"];
                    $hashed_password = $row["password"];
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["ulogin"] = true;
                        $_SESSION["user_id"] =   $user_id;
                        $_SESSION["password"] = $_POST["password"];
                        //$_SESSION['loggedin_time'] = time();
                        header("Location: user/welcome.php");
                    } else {

                        $login_err = "Invalid nic or password.";
                        $user_id = $password = "";
                    }
                }
            } else {

                $sql = "SELECT officer_id, password,role FROM officer WHERE officer_id = :user_id";

                if ($stmt = $pdo->prepare($sql)) {
                    $stmt->bindParam(":user_id", $param_officer_id, PDO::PARAM_STR);
                    $param_officer_id = trim($_POST["user_id"]);

                    if ($stmt->execute()) {
                        if ($stmt->rowCount() == 1) {
                            if ($row = $stmt->fetch()) {
                                $user_id = $row["officer_id"];
                                $role = $row["role"];
                                $hashed_password = $row["password"];
                                if (password_verify($password, $hashed_password)) {
                                    if ($role == "admin") {
                                        session_start();
                                        $_SESSION["ulogin"] = true;
                                        $_SESSION["admin_id"] =   $user_id;
                                        $_SESSION["password"] = $_POST["password"];
                                        //$_SESSION['loggedin_time'] = time();

                                        header("location: admin/dashboard.php");
                                    } else if ($role == "officer") {

                                        $sql = "UPDATE officer SET online_status='1' WHERE officer_id='" . $officer_id . "'";
                                        session_start();
                                        $_SESSION["ulogin"] = true;
                                        $_SESSION["officer_id"] =   $user_id;
                                        $_SESSION["password"] = $_POST["password"];
                                        //$_SESSION['loggedin_time'] = time();

                                        header("location: officer/welcome.php");
                                    }
                                } else {

                                    $login_err = "Invalid nic or password.";
                                    $user_id = $password = "";
                                }
                            }
                        } else {

                            $login_err = "Invalid nic or password.";
                            $user_id = $password = "";
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    unset($stmt);
                }
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        unset($stmt);
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
                <h3 class="pt-4">Login page</h3>
                <form action="" class=" my-0 all  rounded-3 form-double all px-2 py-2 black-t" style="max-width: 320px;" method="post">
                    <div class="nav justify-content-end text-end ">
                        <a href="index.php" class="btn-close btn-close-white" aria-label="Close"></a>
                    </div>
                    <div class="row justify-content-center mx-5 my-3">


                        <div class="form-outline mb-4 ">
                            <input id="user_id" class="form-control text-info fw-bold" name="user_id" type="text" placeholder="<?php echo $user_id_err;  ?>" value="<?php echo $user_id ?>" required minlength="" maxlength="12">
                            <label class="form-label text-light fw-bold ">User ID</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input id="password" class="form-control text-info fw-bold" name="password" type="password" placeholder="<?php echo $password_err;  ?>" value="<?php echo $password ?>" autocomplete="off" required>
                            <label class="form-label text-light fw-bold">Password</label>
                        </div>
                        <div class="text-center">
                            <input class="btn btn-rounded btn-success px-5 fw-bold" type="submit" value="Log in" name="login">
                        </div>

                    </div>


                    <div class="col fs-5  mb-3 text-center">
                        <!-- Simple link -->
                        <a class="text-danger" href="passwordReset.php">Forgot password</a>
                        <button type="button" class="btn btn-primary  btn-floating fw-bold mx-1">
                            ?
                        </button>
                    </div>

                    <div class="text-center fw-bold">
                        <p class="text-light fw-bold">Not a registered user? </p>
                        <p><a class=" btn btn-rounded btn-warning text-dark fw-bold" href="signup.php">Register</a></p>

                    </div>
                </form>

            </center>
        </div>
    </main>




    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    <?php
    if (isset($_SESSION['status'])) { ?>
        <script>
            swal({
                title: " You <?php echo $_SESSION['status'] ?> log in here ",
            });
        </script>

    <?php unset($_SESSION['status']);
    }
    ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"){?>
        <script>
            swal({
                title: "<?php echo $login_err; $login_err=""; ?> ",
            });
        </script> <?php } ?>

</body>

</html>