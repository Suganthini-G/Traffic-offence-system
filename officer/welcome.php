<?php
session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
    header("location:../login.php");
    exit;
}
include('includes/config.php'); ?>

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

<body class="body-welcome">

    <main>



        <div class="" id="home">
            <?php include('includes/header.php'); ?>
            <nav class="py-3 sticky-top bottom bg-light">

                <div class="container d-flex flex-wrap">
                    <ul class="nav  me-auto">
                        <li class="nav-item "><a href="#home" class="btn btn-rounded me-2 link-dark " aria-current="page">Home</a></li>
                        <li class="nav-item "><a href="#about" class="btn btn-rounded me-2 link-dark ">About</a></li>
                        <li class="nav-item "><a href="#reachus" class="btn btn-rounded me-2 link-dark  ">Contact</a></li>
                    </ul>
                    <div class="d-none d-lg-block m-auto me-0">
                        <ul class="nav nav-pills m-auto">
                            <?php include("includes/userDrop.php");
                            include("includes/notification.php"); ?>
                        </ul>
                    </div>
                </div>
            </nav>

           <!-- <div class=" position-relative overflow-auto  text-center vh-100 min-vh-100">
                <div class="h-100 w-75 mx-auto  overflow-auto">

                   <div class="mt-5 pt-3 bg-light">-->
                 <br><br>   
  <div class="container marketing">

    <div class="row">

      <div class="col-lg-4">
      <img src="css/notes.png" class="bd-placeholder-img" width="140" height="140">
        <h2>Enter Duty Details</h2>
        <p><a class="btn btn-secondary" href="dutyDetails.php">Get Started &raquo;</a></p>
        <p><a href="#1">View details</a></p>
      </div>

      <div class="col-lg-4">
        <img src="css/profile.png" class="bd-placeholder-img" width="140" height="140">
        <h2>Check details</h2>
        <p><a class="btn btn-secondary" href="check.php">Get Started &raquo;</a></p>
        <p><a  href="#1">View details</a></p>
      </div>

      <div class="col-lg-4">
        <img src="css/report.png" class="bd-placeholder-img" width="140" height="140">
        <h2>Report an offence</h2>
        <p><a class="btn btn-secondary" href="report_offence.php">Get Started &raquo;</a></p>
        <p><a href="#2">View details</a></p>
      </div>
      
      <div class="col-lg-4">
      <img src="css/specification.png" class="bd-placeholder-img" width="140" height="140">
        <h2>Report found of vehicle</h2>
        <p><a class="btn btn-secondary" href="found_vehicle.php">Get Started &raquo;</a></p>
        <p><a href="#3">View details</a></p>
      </div>

      <div class="col-lg-4">
      <img src="css/ambulance.png" class="bd-placeholder-img" width="140" height="140">
        <h2>Ambulance Contact</h2>
        <p><a class="btn btn-secondary" href="ambulanceSearch.php">Get Started &raquo;</a></p>
        <p><a href="#4">View details</a></p>
      </div>
      
    </div>



    <hr class="featurette-divider">

    <div class="row featurette" id="1">
      <div class="col-md-7">
        <h2 class="featurette-heading">Enter Duty Details</h2>
        <p class="lead">Traffic officer needs to enter their duty details.</p>
      </div>
      <div class="col-md-5">
        <a href="#"><img src="css/detail.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="200"></a>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette" id="2">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Check details</h2>
        <p class="lead">Traffic officer has the rights to check details of particular person or vehicles to conform those are in valid or not.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <a href="#"><img src="css/rc.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400" height="400"></a>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette" id="3">
      <div class="col-md-7">
        <h2 class="featurette-heading">Report an offence</h2>
        <p class="lead">When an offence took place, traffic officer can report that offence via online.</p>
      </div>
      <div class="col-md-5">
        <a href="#"><img src="css/writing.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="200"></a>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette" id="4">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Report found of vehicle</h2>
        <p class="lead">When traffic officer found lost vehicles, he can report that vehicle as found vehicle.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <a href="#"><img src="css/writing.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="200"></a>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette" id="5">
      <div class="col-md-7">
        <h2 class="featurette-heading">Ambulance Contact</h2>
        <p class="lead">In a medical emergency,calling for an ambulance could mean the difference between life and death and not sure if the situation qualifies as an emergency.Here,you can easy to contact ambulance.</p>
      </div>
      <div class="col-md-5">
        <a href="#"><img src="css/33968.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"  width="400" height="400"></a>
      </div>
    </div>

    <hr class="featurette-divider">


  </div>


                 <!--  </div>
                </div>
            </div>-->
            <!--About us-->
            <?php include("../includes/about.php"); ?>
            <!--===============================================-->
            <!--reach us-->
            <?php include("../includes/condact.php"); ?>

            <!--===============================================-->
        </div>

        </div>

        <!-- contact us-->


        <!-- footer-->
        <?php include("../includes/footer.php"); ?>

    </main>


    <script src="includes/scripts.php"></script>
    <!--sidebar -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    </head>

    <body>

    </body>

</html>