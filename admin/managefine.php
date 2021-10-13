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

                <?php
                define("ROW_PER_PAGE", 5);
                require_once('includes/config.php');
                ?>

            
                <!--===================================-->
                <form name='frmSearch' action='' method='post'>
                    <div class="row justify-content-between mb-3 pb-3 mt-5 bottom">
                        <div class="col-9 ms-3 ps-2  "> 
                        <a href="addfine.php" class="fw-bold  btn btn-rounded btn-success all">Add fine details</a>
                        <a href="deletefine.php" class="fw-bold  btn btn-rounded btn-danger all">Delete fine details</a>
                        <a href="updatefine.php" class="fw-bold  btn btn-rounded btn-warning all">Update fine details</a>
                        </div>
                    </div>

                    <?php
                    $sql = "SELECT * FROM fine_details ";
                    if($result = $pdo->query($sql)){
                    if ($result->rowCount() > 0) {
                        ?>

                    <table
                        class="table mx-auto  text-nowrap table-hover auto-capitalised fw-bold table-striped table-sm all  table-bordered">
                        <caption>List of Fine details</caption>
                        <thead>
                            <tr class="table-dark all fw-bold">
                                <th>Act no</th>
                                <th>Offence Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id='' class="table-bordered border-primary all" style="background-color:#f7f775;">

                        <?php
                             while ($row = $result->fetch()) { ?>
                             <tr> <?php
                            echo "<td>" . $row['act_no'] . "</td>";
                            echo "<td>" . $row['offence_name'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            ?> </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php 
                    unset($result);
                    }
                } 
            unset($pdo);
            ?>
                </form>

            </div>


        </div>
    </div>

    <!-- bootstrap js -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
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