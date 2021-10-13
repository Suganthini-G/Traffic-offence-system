<?php
session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
     header("location:../login.php");
     exit;
 }

require_once "includes/config.php";
if (isset($_POST['btnsubmit'])) {
    try {
        $reg_number = $_POST['reg'];          //getting value from user and assign those values into a variable created by us
        $cessi_number = $_POST['ces'];
        $location = $_POST['location'];

        // sql query to insert data into database 
        $sql_insert = "INSERT INTO found_vehicle (cessi_no,reg_no,location)
         VALUES ('$cessi_number','$reg_number','$location')";

        // use exec() because no results are returned
        $pdo->exec($sql_insert);
        $message ="Founded vehicle was reported sucessfully!";        // box will be shown after founded vehicle was sucessfully reported
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    
                    <form action="found_vehicle.php" method="POST" class="px-5 pb-3 ">
                    <div class="mb-3 justify-content-between row py-1">       </div>
                    
                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Registration number</label>
                            <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="reg" id="reg" autocomplete="off" required onblur="return validate_regno()"> 
                                <span id="r_err"></span><br> 
                    </div>


                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Cessi number</label>
                                                       <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="ces" id="ces" autocomplete="off" required onblur="return validate_cnum()">
                                <span id="c_err"></span> <br> 
                    </div>


                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Location</label>
                    <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="location" id="location" autocomplete="off" required size=50> <br>
                    </div>
                                <div class="text-center mt-3 " role="group" aria-label="Basic example">
                            <button type="submit" value="Submit" name="btnsubmit" class="btn btn-success btn-rounded fw-bold ">submit</button>
                            <a href="" class="btn btn-danger btn-rounded fw-bold ">Reset</a>
                        </div>

                            </form>
                            </div>

</div>

</div>

</div>
        
                    <!-- ======================== -->


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
        </div>
    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</body>
</html>

<script>
    function validate_cnum()
    {
    var cessi= document.getElementById("ces").value;
    var  err_cessi = document.getElementById("c_err");
    var pattern = /[a-zA-Z]{5}[0-9]{10}/; 
    if(cessi.length==15)
            {
                if(pattern.test(cessi))
                {
                    err_cessi.textContent="";
                    return true;
                }
                else
                {
                    err_cessi.textContent="Cessi no must be in the format of ABCDE1234567890 ";
                    err_cessi.style.color="black";
                    err_cessi.style.fontWeight="900";
                   document.getElementById("ces").value="";
                    return false;
                }
            }
            else
            {
                err_cessi.textContent="Invalid format of Cessi number";
                err_cessi.style.color="black";
                err_cessi.style.fontWeight="900";
                document.getElementById("ces").value="";
                return false;
            }
    }
        </script>
        <script>
function validate_regno()
        {
            var regno = document.getElementById('reg').value; 
            var regno_error = document.getElementById("r_err");
            var pattern = /[a-zA-Z]{2}[-][a-zA-Z]{3}[0-9]{4}/;  
        
            if(regno.length==10)
            {
                if(pattern.test(regno))
                {
                    regno_error.textContent="";
                    return true;
                }
                else
                {
                    regno_error.textContent="Registration no must be in the format of AB-CDE1234";
                    regno_error.style.color="black";
                    regno_error.style.fontWeight="900";
                    document.getElementById("reg").value="";
                    return false;
                }
            }

            else
            {
                regno_error.textContent="Invalid format of Registration number";
                regno_error.style.color="black";
                regno_error.style.fontWeight="900";
                document.getElementById("reg").value="";
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