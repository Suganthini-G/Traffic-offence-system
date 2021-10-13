<?php

session_start();
if (!isset($_SESSION["ulogin"]) || $_SESSION["ulogin"] !== true) {
     header("location:../login.php");
     exit;
 }

include('includes/config.php');

// $nic = $password = "";
// $nic_err = $password_err = $login_err = "";

if (isset($_POST['btn'])) {

    $spotfine_no = trim($_POST['spotfine_no']);
    $money = $_POST['amount'];

    $sql = "SELECT spotfine_no FROM offence WHERE spotfine_no = :spotfine_no";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":spotfine_no", $param_spotfine, PDO::PARAM_STR);
        $param_spotfine = trim($_POST["spotfine_no"]);

        if ($stmt->execute()) {
            $sql_insert = "INSERT INTO payment(spotfine_no,amount) VALUES('$spotfine_no','$money')";
            $pdo->exec($sql_insert);
            $message ="Payment sucess"; 

            $sql_update ="UPDATE offence SET payment_status='paid' WHERE spotfine_no=:spotfine_no  ";
            $pdo->prepare($sql_update);

        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        unset($stmt);
    }
    unset($pdo);
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
        <!-- <div class=" position-relative overflow-auto text-center mt-lg-n2 mt-2 vh-100 min-vh-100"> -->
            <!--header-->
            <header class="d-flex flex-wrap ju  stify-content-center pt-lg-4 bottom sticky-top pb-2 ">
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
                    Online fine Payment Portal
                                    </div>

                    <div class="mb-1 bottom" style="margin-top:25px;">
                    <div class="row justify-content-center">

                        <div class="row mx-0 text-ceneter add-btn" style="max-width: 500px;min-width:400px; background-color:#fff7c7;">
                            <div class="all mx-1 my-1 ">
       
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  name="Help_form" autocomplete="off"  class="px-5 pb-3 ">
                        <div class="mb-3 justify-content-between row py-1">
                            
                        </div>
                        <fieldset>
                        <legend>Fine Details</legend>
                        <div class="mb-3 justify-content-between row all btn-rounded py-1">
                            <label for="User_id" class="form-label pb-n2 text-nowrap col-6 fw-bold">Spotfine number</label>
                            <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " id="spotfine_no" name="spotfine_no" placeholder="Enter spotfine number" required onblur="return validate_nic()">
                            <span id="err_nic" class="text"></span>
                        </div>

                        <div class="mb-3 justify-content-between row all btn-rounded py-1">
                        <label for="location" class="form-label pb-n2 text-nowrap col-6 fw-bold">Amount</label>
                        <input type="text" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "  placeholder="Enter amount" required name="amount" type="text" id="amount" onblur="return checkamount()" required>
                        <div id="error_amt"></div>
                        </div>
                        </fieldset>

                        <fieldset>
                        <legend>Enter Creditcard Details</legend>
                        <label for="" class="form-label pb-n2 text-nowrap col-6 fw-bold">Type of card </label><select class="form-select">
                        <option value="American Express">American Express</option>
                        <option value="Discover">Discover</option>
                        <option value="Mastercard">Mastercard</option>
                        <option value="Visa">Visa</option>
                        </select>
                        <label for="" class="form-label pb-n2 text-nowrap col-6 fw-bold" >Card holder name</label> 
                        <input class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " type="text" name="fname" id="fname" onblur="return checkName()" required>
                    <div id="error_fname"></div>
                    <label for="" class="form-label pb-n2 text-nowrap col-6 fw-bold">Card number </label>
                     <input class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " type="text" id="cnum" name="cnum" onblur="return checkcard()" required>
                    <div id="error_cnum"></div>
                    <div class="mt-3 row"> <br> <br>
                    <div class="col-md-3">
                    <label for="" class="form-label pb-n2 text-nowrap col-6 fw-bold">Expiry date </label>
                     <select required class="form-select">
                        <option selected>month</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        </select> </div>
                        <div class="col-md-3">
                        <br> <select required class="form-select">
                        <option selected>year</option>
                        <option>2021</option>
                        <option>2022</option>
                        <option>2023</option>
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                        <option>2027</option>
                        <option>2028</option>
                        <option>2029</option>
                        </select>   </div> 
                        <div class="col-md-2"> </div>
                        <div class="col-md-4"> <label for="" class="form-label pb-n2 text-nowrap col-6 fw-bold">CVC </label>
                    <input class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " type="text" name="code" id="code" onblur="return checkcode()"  required>
                    <div id="error_code"></div> </div> 
                
                </div>
                    </fieldset>

                        <!-- <div class="mb-3 justify-content-between row all btn-rounded py-1">
                        <label for="date" class="form-label pb-n2 text-nowrap col-6 fw-bold">Message</label>
                        <textarea name="message" class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 " placeholder="Your message here...." required id="msg" onblur="return check_msg()"></textarea>
                        <span id="err_msg" class="text"></span>
                        </div> -->

                        <!-- <div class="text-center mt-3 " role="group" aria-label="Basic example">
                            <button type="submit" value="Submit" name="submit" class="btn btn-success btn-rounded fw-bold ">submit</button>
                            <a href="" class="btn btn-danger btn-rounded fw-bold ">Reset</a>
                        </div> -->

                        <div class="row" style="margin:10px; padding:10px;">
                        <div class="col-5"></div>
                        <input type="submit" class="button  btn btn-success " value="Pay now" name="btn" id="btn">
                        <div class="col-5"></div>
                    </div>

</div>
                    </form>
              
                    </div>

                </div>

                </div>

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
          

    </main>
    <script src="includes/scripts.php"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</body>
</html>

<script>
        function checkamount() {
            var amount = document.getElementById("amount").value;
            var amount_err = document.getElementById("error_amt");
            var pattern = /[0-9]{4}/;
            if (amount.length == 4) {
                if (pattern.test(amount)) {
                    amount_err.textContent = "";
                    return true;
                } else {
                    amount_err.textContent = "contains 4 digits only";
                    amount_err.style.color = "black";
                    amount_err.style.fontWeight = "900";
                    document.getElementById("amount").value = "";
                    return false;
                }
            } else {
                amount_err.textContent = "contains digits only";
                amount_err.style.color = "black";
                amount_err.style.fontWeight = "900";
                document.getElementById("amount").value = "";
                return false;
            }
        }

        function checkcard() {
            var card = document.getElementById("cnum").value;
            var card_err = document.getElementById("error_cnum");
            var pattern = /[0-9]{16}/;
            if (card.length == 16) {
                if (pattern.test(card)) {
                    card_err.textContent = "";
                    return true;
                } else {
                    card_err.textContent = "contains 16 digits only";
                    card_err.style.color = "black";
                    card_err.style.fontWeight = "900";
                    document.getElementById("cnum").value = "";
                    return false;
                }
            } else {
                card_err.textContent = "must contain 16 digits";
                card_err.style.color = "black";
                card_err.style.fontWeight = "900";                    
                document.getElementById("cnum").value = "";
                return false;
            }
        }

        function checkcode() {
            var code = document.getElementById("code").value;
            var code_err = document.getElementById("error_code");
            var pattern = /[0-9]{3}/;
            if (code.length == 3) {
                if (pattern.test(code)) {
                    code_err.textContent = "";
                    return true;
                } else {
                    code_err.textContent = "contains 3 digits only";
                    code_err.style.color = "black";
                    code_err.style.fontWeight = "900";
                    document.getElementById("code").value = "";
                    return false;
                }
            } else {
                code_err.textContent = "Invalid format";
                code_err.style.color = "black";
                code_err.style.fontWeight = "900";
                document.getElementById("code").value = "";
                return false;
            }
        }

        function checkName() {
            var fname = document.getElementById("fname").value;
            var f = document.getElementById("error_fname");
            if (fname.match(/^[a-zA-Z]+$/)) {
                f.textContent = "";
                return true;
            } else {
                f.textContent = "contains letters only";
                f.style.color = "black";
                f.style.fontWeight = "900";
                document.getElementById("fname").value = "";
                return false;
            }
        }
        </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php if (!empty($message)){?>
        <script>
            swal({
                title: "<?php echo$message; unset( $message); ?> ",
                icon: "success",
            });
        </script> <?php } ?>
        