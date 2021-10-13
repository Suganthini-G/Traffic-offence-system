<?php
session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
    header("location: ../login.php");
    exit;
}
include('includes/config.php'); 
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

    <style>
        body {
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: #5a5a5a;
        }

        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .marketing h2 {
            font-weight: 400;
        }

        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }

        .featurette-divider {
            margin: 3rem 0;
        }

        .featurette-heading {
            font-weight: 300;
            line-height: 1;
            letter-spacing: -.05rem;
        }

        .featurette a {
            text-decoration: none;
        }

        @media (min-width: 40em) {
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

<body class="body-welcome">

    <main>

        <div class="" id="home">
            <div class=" position-relative overflow-auto  text-center vh-100 min-vh-100">
                <?php include('../officer/includes/header.php') ?>
                <div class="mt-3 d-flex d-flex flex-row-reverse fixed-top">

                    <?php include("includes/userDrop.php"); ?>
                    <?php include("includes/notification.php"); ?>

                </div>
            </div>
        </div>
        <main>
            <div class="container marketing">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="css/profile.png" class="bd-placeholder-img" width="140" height="140">
                        <h2>View offence history</h2>
                        <p><a class="btn btn-secondary" href="offenceHistory.php">Get Started &raquo;</a></p>
                        <p><a href="#1">View details</a></p>
                    </div>

                    <div class="col-lg-4">
                        <img src="css/notes.png" class="bd-placeholder-img" width="140" height="140">
                        <h2>Complaint on lose of vehicle</h2>
                        <p><a class="btn btn-secondary" href="vehicleLost.php">Get Started &raquo;</a></p>
                        <p><a href="#1">View details</a></p>
                    </div>

                    <div class="col-lg-4">
                        <img src="css/online-payment.png" class="bd-placeholder-img" width="140" height="140">
                        <h2>Make a payment</h2>
                        <p><a class="btn btn-secondary" href="paymentPortal.php">Get Started &raquo;</a></p>
                        <p><a href="#2">View details</a></p>
                    </div>

                    <div class="col-lg-4">
                        <img src="css/help.png" class="bd-placeholder-img" width="140" height="140">
                        <h2>Request</h2>
                        <p><a class="btn btn-secondary" href="RequestHelp.php">Get Started &raquo;</a></p>
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
                        <h2 class="featurette-heading">View offence history</h2>
                        <p class="lead">Driver can view their own offence history here.</p>
                    </div>
                    <div class="col-md-5">
                        <a href="#"><img src="css/detail.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="200"></a>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette" id="2">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">Complaint on lose of vehicle</h2>
                        <p class="lead">If you are unable to find your vehicle from the place you had last left it,then that means it is probably stolen. So, you can make your complaint here.</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <a href="#"><img src="css/writing.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="200"></a>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette" id="3">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Make a payment</h2>
                        <p class="lead">The driver who break a traffic rules has to pay fine using their their spot fine reference number. If driver failto pay the fine,he/she will be submitted to the court.Here you can make your payment easy via online.</p>
                    </div>
                    <div class="col-md-5">
                        <a href="#"><img src="css/e-commerce-digital-banking-online-payment-shutterstock_547990171.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400" height="400"></a>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette" id="4">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">Request</h2>
                        <p class="lead">Here you can request a police officer when you need in any emergency situation.</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <a href="#"><img src="css/bigstock-Ask-for-help-advice-or-reminde-208547185.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400" height="400"></a>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette" id="5">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Ambulance Contact</h2>
                        <p class="lead">In a medical emergency,calling for an ambulance could mean the difference between life and death and not sure if the situation qualifies as an emergency.Here,you can easy to contact ambulance.</p>
                    </div>
                    <div class="col-md-5">
                        <a href="#"><img src="css/33968.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400" height="400"></a>
                    </div>
                </div>

                <hr class="featurette-divider">


            </div>
        </main>
        <!--About us-->
        <?php include("../includes/about.php"); ?>
        <!--===============================================-->
        <!--reach us-->
        <?php include("../includes/condact.php"); ?>
        <!-- footer-->
        <?php include("../includes/footer.php"); ?>
        <!--===============================================-->
        </div>


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