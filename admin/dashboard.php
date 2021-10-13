<?php

// Initialize the session
/*session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}*/
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

<body>
    <!-- Side-Nav -->
    <div class="side-navbar active-nav d-flex justify-content-between  flex-column bg-light" id="sidebar">
        <ul class="nav flex-column text-white w-100">
            <a href="#" class="nav-link h3 text-white my-2 mx-4">
                Responsive </br>SideBar Nav
            </a>
            <li href="#" class="btn btn-light btn-rounded mt-3">
                <i class="bx bxs-dashboard"></i>
                <span class="mx-2">Home</span>
            </li>

            <li href="#" class="btn btn-light btn-rounded mt-3">
                <i class="bx bx-user-check"></i>
                <span class="mx-2">Profile</span>
            </li>
            <li href="#" class="btn btn-light btn-rounded mt-3">
                <i class="bx bx-conversation"></i>
                <span class="mx-2">Contact</span>
            </li>
        </ul>

        <span href="#" class="nav-link h4 w-100 mb-5">
            <a href=""><i class="bx bxl-instagram-alt text-dark"></i></a>
            <a href=""><i class="bx bxl-twitter px-2 text-white"></i></a>
            <a href=""><i class="bx bxl-facebook text-white"></i></a>
        </span>
    </div>

    <!-- Main Wrapper -->
    <div class="p-1 my-container active-cont " style="background-color: lightgoldenrodyellow;">
        <!-- Top Nav -->
        <nav class="navbar top-navbar navbar-light bg-light px-5 sticky-top">
            <a class="btn border-0 btn-success" id="menu-btn"><i class="fas fa-bars fa-2x"></i></i></a>
        </nav>
        <!--End Top Nav -->
        <div class="container px-5 mt-1 pt-5 all mt-xl-1">

            <div class="container px-5">
                <!-- contents-->
                <div class="row justify-content-around mb-3 ">

                    <div class="col-6 mx-n2 all all " style="max-height: 200px;">
                        <div class="row justify-content-between">
                            <div class="col ms-3 pt-5 mt-5">
                                <button type="button" class="btn fs-2 fw-bold btn-lg btn-primary btn-floating">
                                    4</i>
                                </button> <span class="fw-bold fs-5">User request pending</span>
                            </div>
                            <div class="col-4 mt-4 col-md-4 col-lg-4 m-auto "> <canvas
                                    style="max-height: 180px;max-width:200px" id="pie_canvas4"></canvas>
                            </div>


                        </div>
                    </div>
                    <div class="col-6 mx-n2 all all " style="height: 200px;">
                        <div class="row justify-content-between">
                            <div class="col-4 col-md-4 col-lg-4 mt-4 m-auto "> <canvas
                                    style="max-height: 180px;max-width:200px" id="pie_canvas"></canvas>
                            </div>
                            <div class="col ms-3 pt-5 mt-5">
                                <button type="button" class="btn fs-2 fw-bold btn-lg btn-primary btn-floating">
                                    8</i>
                                </button> <span class="fw-bold fs-5">Spotfine pending cars</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-around mb-3 ">

                    <div class="col-6 mx-n2 all all " style="max-height: 200px;">
                        <div class="row justify-content-between">
                            <div class="col-4 col-md-4 col-lg-4 mt-4 m-auto "> <canvas
                                    style="max-height: 180px;max-width:200px" id="pie_canvas1"></canvas>
                            </div>
                            <div class="col ms-3 pt-5 mt-5">
                                <button type="button" class="btn fs-2 fw-bold btn-lg btn-primary btn-floating">
                                    6</i>
                                </button> <span class="fw-bold fs-5">Total vehicle lost cases</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mx-n2 all all " style="height: 200px;">
                        <div class="row justify-content-between">
                            <div class="col-4 col-md-4 col-lg-4 mt-4 m-auto "> <canvas
                                    style="max-height: 180px;max-width:200px" id="pie_canvas2"></canvas>
                            </div>
                            <div class="col ms-3 pt-5 mt-5">
                                <button type="button" class="btn fs-2 fw-bold btn-lg btn-primary btn-floating">
                                    2</i>
                                </button> <span class="fw-bold fs-5">Total vehicle found cases</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- contents-->
                <div class="row justify-content-around mb-3 ">
                    <div class="col mx-n1 all all ">
                        <canvas id="fine_amounts"></canvas>
                    </div>

                </div>
                <!-- contents-->
                <div class="row justify-content-around mb-3 ">

                    <div class="col-9 mx-n2 all all " style="height: 200px;"></div>
                    <div class="col-3 mx-n2 all all " style="height: 200px;"></div>
                </div>
                <div class="row justify-content-around mb-3 ">

                    <div class="col-6 mx-n2 all all " style="max-height: 200px;">
                        <div class="row justify-content-between">
                            <div class="col-4 col-md-4 col-lg-4 mt-4 m-auto "> <canvas
                                    style="max-height: 180px;max-width:200px" id="pie_canvas1"></canvas>
                            </div>
                            <div class="col pt-5 mt-5">y7gyuguyhiygh</div>

                        </div>
                    </div>
                    <div class="col-6 mx-n2 all all " style="max-height: 200px;">
                        <div class="row justify-content-between">
                            <div class="col-4 col-md-4 col-lg-4 m-auto "> <canvas
                                    style="max-height: 180px;max-width:200px" id="pie_canvas2"></canvas>
                            </div>
                            <div class="col pt-5 mt-5">y7gyuguyhiygh</div>

                        </div>
                    </div>

                </div>
                <!-- contents-->
                <div class="row justify-content-around mb-3 ">
                    <div class="col-3 mx-n2 all all " style="height: 200px;"></div>

                    <div class="col-9 mx-n2 all all " style="height: 200px;"></div>
                </div>

                <!---------------------Offences table--------------------------------------------------------->

            </div>
            <!--========================================== -->



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