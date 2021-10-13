<?php
session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
    header("location: ../login.php");
    exit;
} 
include('includes/config.php');

$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tos";

    if (isset($_POST['submit'])) {
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            // echo "Connected successfully.";
    
           //getting value from user and assign those values into a variable created by us     
            $userid = $_POST['user_id'];
		    $location = $_POST['location'];
            $message = $_POST['message'];
    
            // sql query to insert data into database
            $insert = "INSERT INTO help (nic,location,message) 
                                        VALUES ('$userid', '$location', '$message')";

                $insertQuery_run = $conn->prepare($insert);
                $insertQuery_exec = $insertQuery_run->execute();
                $messa = "Submitted successfully";
        } 
        
        catch (PDOException $e) 
        {
            echo "DB Connection failed!! : " . $e->getMessage() . "<br/>";
        }
        $conn = null;
        unset($userid);
        unset($location);
        unset($message);
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
                   
                    Request for help
                    </div>

                    <div class="mb-1 bottom"  style="margin-top: 25px;">
                    <div class="row justify-content-center">

                        <div class="row mx-0 text-ceneter add-btn" style="max-width: 500px;min-width:400px; background-color:#fff7c7;">
                            <div class="all mx-1 my-1 ">
       
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  name="Help_form" autocomplete="off"  class="px-5 pb-3 ">
                        <div class="mb-3 justify-content-between row py-1">
                            
                        </div>
                        
                        <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">NIC No</label>
                            <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="user_id" placeholder="Enter your NIC no" required id="nic" onblur="return validate_nic()">
                            <span id="err_nic" class="text"></span>
                        </div>

                        <div class="mb-3 justify-content-between row all btn-rounded py-1">
                        <label for="location" class="form-label pb-n2 text-nowrap col-6 fw-bold">Location</label>
                        <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " name="location" placeholder="Enter your location" required id="loc" onblur="return check_loc()">
                        <span id="err_loc" class="text"></span>
                        </div>

                        <div class="mb-3 justify-content-between row all btn-rounded py-1">
                        <label for="date" class="form-label pb-n2 text-nowrap col-6 fw-bold">Message</label>
                        <textarea name="message" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " placeholder="Your message here...." required id="msg" onblur="return check_msg()"></textarea>
                        <span id="err_msg" class="text"></span>
                        </div>

                        <div class="text-center mt-3 " role="group" aria-label="Basic example">
                            <button type="submit" value="Submit" name="submit" class="btn btn-success btn-rounded fw-bold ">submit</button>
                            <a href="" class="btn btn-danger btn-rounded fw-bold ">Reset</a>
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

    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="sweetalert2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
	<!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    <script>

function validate_nic()
{
    var nic = document.getElementById('nic').value; 
    var nic_error = document.getElementById("err_nic");
    var pattern1 = /[0-9]{9}[V|X|v|x]/; 
    var pattern2 = /[0-9]{12}/;

        if(nic.length==10)
            {
                if(pattern1.test(nic))
                    {
                        nic_error.textContent="";
                        return true;
                    }
                else
                    {
                        nic_error.textContent="NIC must be have 9 Digits with V/X";
                        nic_error.style.color="red";
                        document.getElementById("nic").value="";
                      return false;
                    }
            }
        else if(nic.length==12)
            {
                if(pattern2.test(nic))
                    {
                        nic_error.textContent="";
                        return true;
                    }
                else
                    {
                        nic_error.textContent="please enter numbers only";
                        nic_error.style.color="red";
                        document.getElementById("nic").value="";
                      return false;
                    }  
            }
        else
            {
                nic_error.textContent="Invalid format of NIC";
                nic_error.style.color="red";
                document.getElementById("nic").value="";
                return false;
            }

}
    
function check_loc()
{
    var loc= document.getElementById("loc").value;
    var l_err = document.getElementById("err_loc");
    if(loc.match(/^[a-zA-Z )\(+=._-]+$/g))
    {
        l_err.textContent="";
        return true;
    }
    else
     {
        l_err.textContent = "only letters are allowed!....";
        l_err.style.color="red";
        document.getElementById("loc").value="";
        return false;
     } 
} 

function check_msg()
{
    var msg= document.getElementById("msg").value;
    var m_err = document.getElementById("err_msg");
    if(msg.match(/^[a-zA-Z )\(+=._-]+$/g))
    {
        m_err.textContent="";
        return true;
    }
    else
     {
        m_err.textContent = "only letters are allowed!....";
        m_err.style.color="red";
        document.getElementById("msg").value="";
        return false;
     } 
} 

</script>


<?php if (!empty($messa)){?>
    <script>
        swal({
            title: "<?php echo $messa; unset( $messa); ?> ",
            icon: "success",  
        });
    </script> <?php } ?>

</body>

</html>