<?php

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

<body class="bg-dark">

    <main>
        <?php include('includes/header.php'); ?>
        <div class="h-5 pt-n5 ">
            <h1 class="text-center ">
                <img src="css/gobottom.png" class=" text-center vert-mf" alt="gyuho"><br>
                <a href="index.php#home-index"><i class="fas fa-angle-double-down text-danger  fa-3x"></i></a>
            </h1>
            <a href="#home" class="fs-3 fw-bold lh-1 text-center ">
            </a>
            <div class="d-flex flex-row-reverse me-5 mt-n5 pt-n5 text-s">
                <a class="btn text-dark btn-success btn-rounded fs-5 me-5 py-1" href="login.php">
                    Login
                </a>
                <a href="signup.php" class="btn text-dark btn-warning btn-rounded fs-5 me-5 py-1">Signup</a>
            </div>
        </div>
        <div class="mt-5" id="home-index">
            <nav class="py-2 sticky-top bottom ">
                <div class="row mx-0">
                    <ul class="nav  me-auto mb-3 mt-2">
                        <li class="nav-item ps-3 mx-2"><a href="#home-index" class="text-dark fw-bold btn btn-rounded px-3 link-light px-2 " aria-current="page">Home</a></li>
                        <li class="nav-item mx-2"><a href="#about" class="text-dark fw-bold btn btn-rounded px-3 link-light px-2">About</a></li>
                        <li class="nav-item mx-2"><a href="#reachus" class="text-dark fw-bold btn btn-rounded px-3 link-light px-2">Contact</a></li>
                        <li class="nav-item mx-2"><a href="login.php" class="text-dark fw-bold btn-success btn btn-rounded px-3 link-light px-2">login</a></li>
                        <li class="nav-item mx-2 me-2"><a href="signup.php" class="btn btn-warning text-dark fw-bold  btn-rounded me-2 ">Sign up</a></li>
                    </ul>
                </div>
            </nav>
            <div class=" position-relative overflow-auto   text-center  min-vh-100 py-5">
                <div class="row h-100 mx-0 justify-content-center ">
                    <br><br><br><br>
                    <div class="col-lg-7">
                        <div class="row justify-content-center my-5 py-5">
                            <div class="col-lg-8 col-11">
                                <img class="w-100 mb-0" src="css/logo.png" alt="">

                                <h2 class="fs-1 fw-bold lh-1 text-dark ms-4 text-s">TRAFFIC OFFENCE SYSTEM</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mt-5">
                        <img class="rounded-circle bg-dark text-center" src="css/ambulance.jpg" alt="" style="height: 100px;width:100px">
                        <h2>Ambulance services</h2>
                        <h5>In case of emergency you can search nearby ambulance services easily.</h5>
                        <p><a class="btn btn-light btn-rounded fw-bold" href="#">View details »</a></p>
                    </div>
                </div>
            </div>
            <?php include("includes/about.php"); ?>
            <?php include("includes/condact.php"); ?>
        </div>
        <?php include("includes/footer.php"); ?>
    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</body>

</html>