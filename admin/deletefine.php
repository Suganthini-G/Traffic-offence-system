<?php
session_start();

include("includes/config.php");

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
           $actno = $_POST['act_no'];
           $offencename = $_POST['offence_name'];
    
            // sql query to insert data into database
            $insert = "DELETE FROM fine_details WHERE act_no='$actno' AND offence_name='$offencename'";

            $insertQuery_run = $conn->prepare($insert);
            $insertQuery_exec = $insertQuery_run->execute();
            $message = " Your data deleted successfully";
        } 
        
        catch (PDOException $e) 
        {
            echo "DB Connection failed!! : " . $e->getMessage() . "<br/>";
        }
        $conn = null;
        unset($actno);
    }

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

<body class="">
    <!-- Side-Nav -->
    <?php include('includes/sidebar.php') ?>
    <!-- Main Wrapper -->
    <div class=" my-container active-cont ">
        <!-- Top Nav -->
        <?php include('includes/topbar.php') ?>
        <!--End Top Nav -->

        <div class="container px-5   all mt-xl-1">

            <div class="container pt-3">
                <div class="mb-5bottom">
                    <p class="btn add-btn fw-bolder btn-rounded btn-lg btn-light"> Manage Fine details
                    </p>
                </div>
                <div class="mb-1 bottom">
                    <div class="row justify-content-center">

                        <div class="row mx-0 text-ceneter add-btn" style="max-width: 460px;min-width:360px">
                            <div class="all mx-1 my-1 ">
                                <div class="row justify-content-between pt-3 px-1 mb-4 all">
                                    <div class="col-9">
                                        <h4 class="fw-bold">Delete fine details</h4>
                                    </div>
                                    <div class="col-2">

                                        <a type="button" href="managefine.php"
                                            class="btn-close btn-rounded btn-danger" aria-label="Close"></a>

                                    </div>
                                    <form action="" class="" method="GET">
                                    <br>
                                    <div class="col "><input type="search" style="width: 200px;" placeholder="Search..."
                                        aria-label="Search" class="all btn py-2 fw-bolder " autocomplete="off" required
                                        name='search' value="<?php if (isset($_GET['search'])) {echo $_GET['search'];} ?>" id='keyword' />
                                    </div>
                                    </form>
                                    <div class="col-9">
                                    <br>
                                    </div>
                                </div>

                                <?php
                                    if (isset($_GET['search'])) {

                                        try {
                                            $filtervalues = $_GET['search'];
                                            $sql = "SELECT * FROM fine_details WHERE CONCAT(act_no, offence_name, amount) LIKE '%$filtervalues%' ";

                                            $result = $pdo->query($sql);
                                            if ($result->rowCount() > 0) {
                                                foreach($result as $row){
                                    ?>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                                    class="px-5 pb-3 " method="post">
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Act No</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            type="text" name="act_no" id="act_no" value="<?= $row['act_no']; ?>">

                                    </div>
                                    <div class="mb-3 justify-content-between row all btn-rounded py-1">
                                        <label class="form-label pb-n2 text-nowrap col-6 fw-bold">Offence name</label>
                                        <input
                                            class="all bg-transparent btn py-2 fw-bolder bg-light btn-light all btn-rounded col-6 "
                                            type="text" name="offence_name" id="offence_name" value="<?= $row['offence_name']; ?>">
                                    </div>

                                    <div class="text-center mt-3 " role="group" aria-label="Basic example">
                                        <button type="submit" value="Submit" name="submit"
                                            class="btn btn-success btn-rounded fw-bold ">submit</button>

                                    </div>

                                </form>
                                <?php
                    }
        ?>
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-5"></div>
                            <div class="col-2 mt-2 me-0"> <a href="Deletefine.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8); color:azure; width:100%;">Back</a></div>
                        </div>

            <?php
                        unset($result);
                    } else {
                    ?> <div>
                            <h2>No Records were found</h2>
                        </div>
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-5"></div>
                            <div class="col-2 mt-2 me-0"> <a href="Deletefine.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8); color:azure; width:50%;">Back</a></div>
                        </div>
            <?php
                    }
                } catch (PDOException $e) {
                    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                }
            }
            unset($pdo);
            ?>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <script src="js/db_graph1.js"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="sweetalert2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        

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


<?php if (!empty($message)){?>
        <script>
            swal({
                title: "<?php echo$message; unset( $message); ?> ",
                icon: "success",
                
            });
        </script> <?php } ?>

</body>

</html>