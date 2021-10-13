<?php
 session_start();
 if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
     header("location:../login.php");
     exit;
 }
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tos";



try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
   // echo "Successfully connected with  database";
    if (isset($_POST['update'])) {

        $officer_id     =   $_POST['officer_id'];
        $location       =   $_POST['location'];
        $on_time        =   $_POST['on_time'];
        $date           =   $_POST['date'];
       // $staus          =   $_POST['status'];

        $updateQuery = "UPDATE duty_details SET location='$location' , on_time='$on_time', date='$date', off_time='', status='on' WHERE officer_id='$officer_id' ";
        $updateQuery_run = $conn->prepare($updateQuery);
        $updateQuery_exec = $updateQuery_run->execute();

        if ($updateQuery_exec) {
            $message1 = "Duty on Data Successfully updated";

            $_SESSION['update'] = "added duty account successfully!";
                header("location: dutyDetails.php");
        } else {
            $message2 = "Data update Failed,Try Again";
        }
    }
}
    catch (PDOException $e) 
{
    echo "Connection failed" . $e->getMessage();
}

if (isset($_GET["officer_id"]) && !empty(trim($_GET["officer_id"]))) {
    $officer_id =  trim($_GET["officer_id"]);

    $sql = "SELECT * FROM duty_details WHERE officer_id = :officer_id";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":officer_id", $param_officer_id);

        $param_officer_id = $officer_id;

        $_SESSION['update'] = "added duty account successfully!";
                header("location: duty1.php");
                exit();
    }
                
} 
else {
        $update_err = "duty account update failed";
       
 
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
    <link rel="stylesheet" href="css/dutyDetails.css">

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
                    Update officer duty Details
                    
                </div>

                            <div class="mb-5bottom">
                                <p class="btn add-btn fw-bolder btn-rounded btn-lg btn-light"> Update officer duty-on details
                                </p>
                            </div>
                            <div class="mb-1 bottom">
                                <div class="row justify-content-center">

                                    <div class="row mx-0 text-ceneter add-btn" style="max-width: 460px;min-width:360px">
                                        <div class="all mx-1 my-1 ">
                                            <div class="row justify-content-between pt-3 px-1 mb-4 all">
                                                <div class="col-9">
                                                    <h4 class="fw-bold">You are updating your duty-on deails </h4>
                                                </div>
                                                <div class="col-2">

                                                    <a type="button" href="dutyDetails.php"
                                                        class="btn-close btn-rounded btn-danger" aria-label="Close"></a>

                                                </div>
                                            </div>
                                            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"
                                                class="px-5 pb-3 " method="post" onsubmit="return validate()">
                                        
                                                <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                                    <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Officer ID</label>
                                                    <input
                                                        class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                                        type="text" name="officer_id" id="officer_id" onblur="return validate_officerid()" required placeholder="Enter your officer id">
                                                        <span id="err_officerid" class="danger"></span>
                                                </div>

                                                <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                                    <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Location</label>
                                                    <input
                                                        class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                                        type="text" name="location" id="location" onblur="return validate_location()" required placeholder="Enter Location">
                                                        <span id="err_location" class="danger"></span>
                                                </div>

                                                <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                                    <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Date</label>
                                                    <input
                                                        class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                                        type="date" name="date" id="date" onblur="return validate_date()" required > 
                                                       
                                                </div>

                                                <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                                    <label class="form-label pb-n2 text-nowrap col-6 fw-bold">On Time</label>
                                                    <input
                                                        class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                                        type="text" name="on_time" id="time" onblur="return validate_time()" required placeholder="Enter the on Time">  
                                                        <span id="err_time" class="danger"></span>
                                                </div>
                                            
                                            
                                                <div class="text-center mt-3 " role="group" aria-label="Basic example">
                                                    <button type="submit" value="Update" name="update"
                                                        class="btn btn-success btn-rounded fw-bold ">Update</button>
                                                    <a href="dutyOn.php" class="btn btn-danger btn-rounded fw-bold ">Reset</a>

                                                </div>
                                        
                                     
                                    
               
                                

                                </form>
                            </div>

                        </div>

                    </div>

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

        
        <script>

function validate_officerid()
        {
            var officerid = document.getElementById('officer_id').value; 
            var err_officerid = document.getElementById("err_officerid");
            var pattern = /[0-9]{6}/;
            
                if(officerid.length==6)
                {
                        if(pattern.test(officerid))
                        {
                            officerid_error.textContent="";
                            return true; 
                        }
                        else
                        {
                            err_officerid.textContent="Invalid officer id";
                            err_officerid.style.color="red";
                            document.getElementById("officerid").value="";
                            return false;
                        }
                }  
            else
            {
                    err_officerid.textContent="Invalid officer id";
                    err_officerid.style.color="red";
                    document.getElementById("officerid").value="";
                    return false;
            }

        }

   
   function validate_location()
   {
       var location= document.getElementById("location").value;
       var ocation_err = document.getElementById("err_location");

       if(location.match(/^[a-zA-Z]+$/))
       {
           f_err.textContent="";
           return true;
       }

       else
       {
           ocation_err.textContent = "only letters are allowed";
           ocation_err.style.color="red";
           document.getElementById("location").value="";
       return false;
       } 
   } 

function validate_time()
{
   var time = document.getElementById("time").value;
   var  time_err = document.getElementById("err_time");
   if(time.match(/[0-9]{2}[:][0-9]{2}/))
   {
       time_err.textContent="";
       return true;
   }
   else
   {
       time_err.textContent="Invalid format (00:00)";
       time_err.style.color="red";
       document.getElementById("time").value="";
       return false;
   }
}



</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if (!empty($message1)){ ?>
        <script>
        swal({
            title: "<?php echo $message1; ?> ",
            icon: "success"
        });
        </script>
    <?php } ?>
    <?php if (!empty($message2)){ ?>
        <script>
        swal({
            title: "<?php echo $message2; ?> ",
            icon: "success"
        });
        </script>
    <?php } ?>
        <!-- ------------------------------------------------------------------ -->


    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</body>

</html>