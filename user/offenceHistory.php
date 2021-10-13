<?php
session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
    header("location: ../login.php");
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
                    <div class="all text-center mt-n1 mb-5 py-2 bg-light fw-bold">
                        View own offence history
                    </div>

                    <div class="row text-center  text-capitalize ms-lg-4 me-lg-4 ms-md-4 me-md-4 ms-sm-1 me-sm-1 mt-5 " style=" max-height: 450px;overflow: auto; ">

            <?php
				    $user_id = $_SESSION["user_id"];

                $sql = "SELECT offence.spotfine_no, fine_details.offence_name, offence.location, fine_details.amount, offence.date, offence.exp_date, offence.payment_status 
                FROM offence LEFT JOIN fine_details ON offence.offence_type=fine_details.act_no 
                LEFT JOIN drivers ON offence.offender_id=drivers.license_no WHERE drivers.nic = :user_id";

                $result = $pdo->prepare($sql);

                $result->bindParam(':user_id',$user_id,PDO::PARAM_STR);
                $result->execute();

                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch()) {
				?>
                <div class="col-md-4">
				<form method="post">
					<div style="border:1px solid #000; background-color:#fff7c7; border-radius:5px; margin:10px; padding:10px;" align="left">

                        <h4 class="text-muted">Spotfine No: <span class="text-dark"><?php echo $row["spotfine_no"]; ?></span></h4>
                        <h4 class="text-muted">Offence Name: <span class="text-dark"><?php echo $row["offence_name"]; ?></span></h4>
						<h4 class="text-muted">Location: <span class="text-dark"><?php echo $row["location"]; ?></span></h4>
                        <h4 class="text-muted">Amount: <span class="text-dark"><?php echo $row["amount"]; ?></span></h4>
                        <h4 class="text-muted">Date: <span class="text-dark"><?php echo $row["date"]; ?></span></h4>
                        <h4 class="text-muted">Expiry Date: <span class="text-dark"><?php echo $row["exp_date"]; ?></span></h4>

                        <h4 class="text-muted">Status: <?php $stats=$row['payment_status'];
                				if($stats== 'pending'){
                                    echo '<a href="paymentPortal.php?spotfine_no=' . $row['spotfine_no'] . '"class="mr-3" title="Payment" data-bs-toggle="tooltip" data-bs-placement="top" style="color:blue;">Pay here</a>';
                                    } 
                                if($stats== 'paid')  { 
                                    echo '<a "class="mr-3" data-bs-toggle="tooltip" data-bs-placement="top" style="color:red;">Pending</a>';
                    				 } 
                                if($stats== 'confirmed')  { 
                                    echo '<a "class="mr-3" data-bs-toggle="tooltip" data-bs-placement="top" style="color:Green;">Paid</a>';
                    				 } ?> </h4>

					</div>
				</form>
			</div>
            <?php
					}
                    unset($result);
				}
                else{
                    echo " <h2>No Offences were found</h2>";
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

    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</body>

</html>