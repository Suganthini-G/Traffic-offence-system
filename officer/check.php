<?php
 session_start();
 if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
     header("location:../login.php");
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

<body>
    <main class="pt-0">
        <div class=" position-relative overflow-auto text-center mt-lg-n2 mt-2 vh-100 min-vh-100">
            <!--header-->
            <header class="d-flex flex-wrap justify-content-center pt-lg-4 bottom sticky-top pb-2 ">
                <a href="/" class="d-flex align-items-center ms-md-0 ps-3 text-dark text-decoration-none mt-lg-n3 ">
                    <img src="../css/(5).png" height="60px" class="py-0" alt="">
                    <span class="display-6 d-none d-lg-block mt-3">Traffic offence system</span>
                    <span class="fs-4 d-block d-lg-none mt-3">Traffic offence system</span>
                </a>

                <div class="d-none d-lg-block m-auto me-0">
                    <ul class="nav nav-pills m-auto">
                        <?php include("includes/userDrop.php");
                        include("includes/notification.php"); ?>
                    </ul>
                </div>
            </header>
            <!-- Navbar -->
            <?php include('includes/navbar.php'); ?>
            <!-- ======================== -->
            <div class="row mx-auto justify-content-center overflow-auto ">
                <!--sidebar-->
                <?php include('includes/sidebar.php'); ?>
                <div class="col mb-5 mb-lg-0 px-5 py-0" style="min-height: 500px;">
                    <!--main content-->
                    <!-- ======================== -->
                    <div class="all text-center mt-n1 mb-5 py-2 bg-light fw-bold">
                    Check Details
                    </div>
        
            <div class="row text-center justify-content-between" style="margin-top: 50px;">
            <form action="" class="" method="GET">
                <div class="col "><input type="search" style="width: 200px;" placeholder="Search..."
                                    aria-label="Search" class="all btn-light py-2 fw-bolder " autocomplete="off" required
                                    name='search' value="<?php if (isset($_GET['search'])) {echo $_GET['search'];} ?>" id='keyword' />
                </div>
            </form>
        </div>
        <div class="row text-center  text-capitalize ms-lg-4 me-lg-4 ms-md-4 me-md-4 ms-sm-1 me-sm-1 mt-5 " style=" max-height: 270px;overflow: auto;  ">
            <?php
            if (isset($_GET['search'])) {

                try {
                    $filtervalues = $_GET['search'];
                    $sql = "SELECT * FROM vehicles WHERE CONCAT(reg_no, cessi_no, owner_nic, type, colour, seating_capacity) LIKE '%$filtervalues%' ";
                    $sql1 = "SELECT citizens.nic, citizens.fname, citizens.lname, drivers.license_no, drivers.expiry_date, drivers.lie_status, drivers.type FROM citizens LEFT JOIN drivers ON citizens.nic=drivers.nic WHERE CONCAT(citizens.nic, citizens.fname, citizens.lname, drivers.license_no, drivers.expiry_date) LIKE '%$filtervalues%' ";

                    $result = $pdo->query($sql);
                    $result1 = $pdo->query($sql1);

                    if ($result->rowCount() > 0) { ?>

                        <table
                        class="table mx-auto  text-nowrap table-hover auto-capitalised fw-bold table-striped table-sm all  table-bordered">
                        <thead>
                            <tr class="table-dark all fw-bold">
                                <th>Vehicle no</th>
                                <th>Cessi no</th>
                                <th>Owner NIC</th>
                                <th>Vehicle type</th>
                                <th>Colour</th>
                                <th>Seating capacity(Ex/Driver)</th>
                            </tr>
                        </thead>
                        <tbody id='' class="table-bordered border-primary all" style="background-color:#f7f775;">

                        <?php while ($row = $result->fetch()) { ?>
                             <tr> <?php
                            echo "<td>" . $row['reg_no'] . "</td>";
                            echo "<td>" . $row['cessi_no'] . "</td>";
                            echo "<td>" . $row['owner_nic'] . "</td>";
                            echo "<td>" . $row['type'] . "</td>";
                            echo "<td>" . $row['colour'] . "</td>";
                            echo "<td>" . $row['seating_capacity'] . "</td>";
                            ?> </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>

                        
                    <div class="row">
                            <div class="col-5"></div>
                            <div class="col-5"></div>
                            <div class="col-2 mt-2 me-0"> <a href="check.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8);color:azure;">Back</a></div>

                        </div>
                    <?php
                        unset($result);
                    }
                    else if ($result1->rowCount() > 0) { ?>
                    <table
                        class="table mx-auto  text-nowrap table-hover auto-capitalised fw-bold table-striped table-sm all  table-bordered">
                        <thead>
                            <tr class="table-dark all fw-bold">
                                <th>NIC no</th>
                                <th>Fullname</th>
                                <th>License no</th>
                                <th>Expiry date</th>
                                <th>Status</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody id='' class="table-bordered border-primary all" style="background-color:#f7f775;">
                        
                        <?php while ($row = $result1->fetch()) { ?>
                            <tr> <?php
                            echo "<td>" . $row['nic'] . "</td>";
                            echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                            echo "<td>" . $row['license_no'] . "</td>";
                            echo "<td>" . $row['expiry_date'] . "</td>";
                            echo "<td>" . $row['lie_status'] . "</td>";
                            echo "<td>" . $row['type'] . "</td>";
                            ?> </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                
                 <div class="row">
                            <div class="col-5"></div>
                            <div class="col-5"></div>
                            <div class="col-2 mt-2 me-0"> <a href="check.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8);color:azure;">Back</a></div>

                        </div>
                    <?php
                        unset($result1);
                    }
                    
                    else {
                    ?> <div>
                            <h2>No Records were found</h2>
                        </div>
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-5"></div>
                            <div class="col-2 mt-2 me-0"> <a href="check.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8);color:azure;">Back</a></div>
                        </div>
            <?php
                    }
                }
                

                catch (PDOException $e) {
                    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                }
            } 
            unset($pdo);
            ?>
        </div>

                    <!-- ======================== -->


                    <!--++++++++++++++++++++++++++++++++++-->
                </div>
            </div>
            <div class=" red text-light pb-0 pt-4">
                <div class="d-flex flex-wrap justify-content-around align-items-center  border-top">
                    <div class="col-md-6 d-flex text-center px-4">

                        <p class="text-sm-center fs-small">Copyright © 2021 Department of Motor Traffic. All Rights Reserved. <br> Designed & Developed by CST 2017/18 Project-1 Group-9</p>
                    </div>

                    <ul class="nav col-md-4 justify-content-center col-10  me-2 pe-5 text-center list-unstyled d-flex">

                        <img src="../css/footer.gif" alt="footer" height="50px">
                        <span class="fs-small">
                            Last modified <br> 2021 august 21
                        </span>
                    </ul>
                </div>
            </div>
            <!-- ======================== -->
        </div>

        <!-- -------------------------function script----------------------------------------- -->



        <!-- ------------------------------------------------------------------ -->


    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</body>

</html>