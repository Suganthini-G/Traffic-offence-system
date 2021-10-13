
<?php
session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
     header("location:../login.php");
     exit;
 }

require_once "includes/config.php";
if (isset($_POST['btnsubmit'])) {
    try {
        //$offence = $_POST['txtoffenceid'];          //getting value from user and assign those values into a variable created by us
        $offender = $_POST['txtoffender'];
        $reporter = $_POST['repid'];
        $type = $_POST['txttype'];
        $location = $_POST['txtlocation'];
        $spotfine = $_POST['spotfine_no'];
        //$date_now=date("Y/m/d");


        //    // sql query to insert data into database 
        $sql_insert = "INSERT INTO offence (offender_id,reporter_id,offence_type,location,spotfine_no)
         VALUES ('$offender','$reporter','$type','$location','$spotfine')";

        // use exec() because no results are returned
        $pdo->exec($sql_insert);
        $message ="Offence was reported sucessfully!";        // box will be shown after offence sucessfully reported
    } catch (PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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
                    Found of vehicles
                </div>

                <div class="mb-1 bottom"  style="margin-top: 25px;">
                    <div class="row justify-content-center">

                        <div class="row mx-0 text-ceneter add-btn" style="max-width: 500px;min-width:400px; background-color:#fff7c7;">
                            <div class="all mx-1 my-1 ">
                    
                    <form method="POST" action="report_offence.php" class="px-5 pb-3 ">
                    
                    <div class="mb-3 justify-content-between row py-1">  </div>       
                                 <!-- <label class="lb" style="color: white; font-weight:700;">Offence id</label>
                    <input type="text" class="form-control" name="txtoffenceid" id="txtoffenceid" autocomplete="off" required> <br> -->
                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Offender id</label>
                    <!-- <input type="text" class="form-control" name="txtoffender" id="txtoffender" autocomplete="off" required onblur="return validate_nic()">   -->
                    <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="txtoffender" id="txtoffender" placeholder="Enter your NIC no" required onblur="return validate_nic()">
                    <span id="err_nic"></span>
                    </div> <br>
                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Reporter id</label>
                    <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="repid" id="repid" autocomplete="off" required> </div> <br>
                    <label class="lb" style="font-weight:700;">Act no </label>
                    <select name="txttype" id="txttype" class="form-select" aria-label="Default select example" required> <br>
                        <option value="d001">Drunk Driving</option>
                        <option value="d002">Traffic light violation</option>
                        <option value="d003">No helmet</option>
                        <option value="d004">No Seatbelt</option>
                        <option value="d005">No child seatbelt</option>
                        <option value="d006">No stopping and standing</option>
                        <option value="d007">Defeat of vehicle maintainance</option>
                        <option value="d008">Over speed</option>
                        <option value="d009">Violation of mobile phone restriction</option>
                        <option value="d011">Failure to stop at a stop sign</option>
                        <option value="d012">Designated turning violation</option>
                    </select> <br>

 <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Location</label>
                                       <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="txtlocation" id="txtlocation" autocomplete="off" required>
                                    </div> <br>
                                       <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Spotfine no</label>
                          <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="spotfine_no" id="spotfine_no" autocomplete="off" required> 
                                       </div><br>

                                       <div class="text-center mt-3 " role="group" aria-label="Basic example">
                            <button type="submit" value="Submit" name="submit" class="btn btn-success btn-rounded fw-bold ">Submit</button>
                            <a href="" class="btn btn-danger btn-rounded fw-bold ">Reset</a>
                        </div>

                        </form>
                            </div>

</div>

</div>

</div>
                <div class="col-lg-8 col-md-3 col-sm-6 col-2" style="color:ghostwhite; padding:80px">
                   
                <p style="border:solid blue 5px;">
                <h2 style="color:black; font-weight:600;"> Duties of a Police Officer</h2>
                   <ul style="color:black; font-weight:600;">
                   <li>Protects life and property through the enforcement of laws & regulations; Proactively patrols assigned areas</li>
                   <li>Responds to calls for police service</li>
                   <li> Conducts preliminary & follow-up criminal and traffic investigations </li>
                   <li>Conducts interviews</li>
                   <li>Prepares written reports and field notes of investigations and patrol activities</li>
                   <li>Arrest and processes criminals</li>
                   <li>Testifies in court</li>
                   <li>Emergency duties required during adverse weather conditions</li>
                   <li>Ability to exercise judgment in determining when to use force and to what degree</li>
                   <li>Operate a law enforcement vehicle under emergency conditions day or night</li>
                   <li>Comprehending legal documents including citations, affidavits, warrants and other documents.</li>
                   <li>Commanding emergency personnel at accident emergencies and disasters</li>
                    <li>Takes an active role in Community Oriented Policing on campus</li>
                   </ul>
                    </p>

            </div>


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
<script>
        function validate_nic() {
            var nic = document.getElementById("txtoffender").value;
            var offender= document.getElementById("err_nic");
            var pattern1 = /[B]{1}[0-9]{7}/;

            if (nic.length == 8) {
                if (pattern1.test(nic)) {
                    offender.textContent = "";
                    return true;
                } else {
                    offender.textContent = "License number must start with B and contains 7 digits";
                    offender.style.color = "black";
                    offender.style.fontWeight = "900";                    
                    document.getElementById("txtoffender").value="";               
                    return false;
                }
            } 
             else {
                offender.textContent = "Invalid format of Licence";
                offender.style.color = "black";
                offender.style.fontWeight = "900";                    
                document.getElementById("txtoffender").value="";               
               return false;
            }
        }
    </script>
    <?php if (!empty($message)){?>
        <script>
            swal({
                title: "<?php echo$message; unset( $message); ?> ",
                icon: "success",
            });
        </script> <?php } ?>
</html>