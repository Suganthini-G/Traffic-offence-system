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
                <?php
                define("ROW_PER_PAGE", 5);
                require_once('includes/config.php');
                ?>

                <div class="mb-5bottom">
                    <p class="btn add-btn fw-bolder btn-rounded btn-lg btn-light"> Manage traffic offences

                    </p>
                </div>


                <?php
                $search_keyword = '';
                if (!empty($_POST['search']['keyword'])) {
                    $search_keyword = $_POST['search']['keyword'];
                }
                $sql = "SELECT * FROM offence WHERE 
        CONCAT(offence_id,offender_id,reporter_id,offence_type,date,
        location,spotfine_no,exp_date,payment_status,case_status ) LIKE '%$search_keyword%' ";

                /* Pagination Code starts */
                $per_page_html = '';
                $page = 1;
                $start = 0;
                if (!empty($_POST["page"])) {
                    $page = $_POST["page"];
                    $start = ($page - 1) * ROW_PER_PAGE;
                }
                $limit = " limit " . $start . "," . ROW_PER_PAGE;
                $pagination_statement = $pdo->prepare($sql);
                $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                $pagination_statement->execute();

                $row_count = $pagination_statement->rowCount();
                if (!empty($row_count)) {
                    $per_page_html .= "<nav class='text-end pb-3'>"; ?>


                <?php
                    $page_count = ceil($row_count / ROW_PER_PAGE);
                    if ($page_count > 1) {
                        for ($i = 1; $i <= $page_count; $i++) {

                            if ($i == $page) {
                                $per_page_html .= '<input class="btn btn-light all px-n1 py-2" type="submit"  name="page" value="' . $i . '"  />';
                            } else {
                                $per_page_html .= '<input class="btn btn-dark all px-n1 py-2" type="submit"  name="page" value="' . $i . '"  /> ';
                            }
                        }
                    }
                    $per_page_html .= "</nav>";
                }

                $query = $sql . $limit;
                $pdo_statement = $pdo->prepare($query);
                $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                $pdo_statement->execute();
                $result = $pdo_statement->fetchAll();
                ?>
                <!--===================================-->
                <form name='frmSearch' action='' method='post'>
                    <div class="row justify-content-between mb-3 mt-5 bottom pb-3 mb-3">
                        <div class="col-9 ms-3 ps-2  ">
                            <a href="confirmedSpotfine.php" class="fw-bold me-3  btn btn-success all">Paid spot
                                fines</a>
                            <a href="spotfinependings.php" class="fw-bold  btn btn-danger all">spotfine pendings</a>
                        </div>
                        <div class="col "><input type="search" style="width: 200px;" id="form1" placeholder="Search..."
                                aria-label="Search" class="all btn btn-white py-2 fw-bolder " autocomplete="off"
                                name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' />
                        </div>
                    </div>


                    <table
                        class="table mx-auto  text-nowrap table-hover auto-capitalised fw-bold table-striped table-sm all  table-bordered">
                        <caption>List of traffic offences</caption>
                        <thead>
                            <tr class="table-dark all fw-bold">
                                <th>Offence ID</th>
                                <th>Offender Liecense</th>
                                <th>Reported ID</th>
                                <th>Act no</th>
                                <th>Location</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id='' class="table-bordered border-primary all" style="background-color:#f7f775;">
                            <?php
                            if (!empty($result)) {
                                foreach ($result as $row) {
                            ?>
                            <tr> <?php
                                            echo "<td>" . $row['offence_id'] . "</td>";
                                            echo "<td>" . $row['offender_id'] . "</td>";
                                            echo "<td>" . $row['reporter_id'] . "</td>";
                                            echo "<td>" . $row['offence_type'] . "</td>";
                                            echo "<td>" . $row['location'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";    ?> </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php echo $per_page_html; ?>
                </form>

            </div>


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