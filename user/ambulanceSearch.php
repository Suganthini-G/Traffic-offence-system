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
                        Search for ambulances
                    </div>
                    <?php
                    define("ROW_PER_PAGE", 3);
                    require_once('../includes/config.php');
                    ?>
                    <div class="row">
                        <div >
                            <div >
                                <?php
                                $search_keyword = '';
                                if (!empty($_POST['search']['keyword'])) {
                                    $search_keyword = $_POST['search']['keyword'];
                                }
                                $sql = 'SELECT * FROM ambulance WHERE district LIKE :keyword OR location LIKE :keyword  ORDER BY location DESC ';

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
                                    $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
                                    $page_count = ceil($row_count / ROW_PER_PAGE);
                                    if ($page_count > 1) {
                                        for ($i = 1; $i <= $page_count; $i++) {
                                            if ($i == $page) {
                                                $per_page_html .= '<input type="submit" class="btn btn-sm all mx-1" name="page" value="' . $i . '" class="btn-page current" />';
                                            } else {
                                                $per_page_html .= '<input type="submit" class="btn btn-sm all mx-1" name="page" value="' . $i . '" class="btn-page" /> ';
                                            }
                                        }
                                    }
                                    $per_page_html .= "</div>";
                                }

                                $query = $sql . $limit;
                                $pdo_statement = $pdo->prepare($query);
                                $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                                $pdo_statement->execute();
                                $result = $pdo_statement->fetchAll();
                                ?>
                                <form name='frmSearch' action='' class="ms-2 bg-light mb-5 all" method='post'>
                                    <div class="pt-4 ps-3 input-group mb-1">
                                        <div class="form-outline">
                                            <input type="text" id="form1" class="form-control" autocomplete="off" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' />
                                            <label class="form-label" for="form1">Search</label>
                                        </div>
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                    <table class="table-sm shadow-lg  table-hover table table-bordered fw-bold caption-top mt-3">
                                        <thead>
                                            <tr class="all">
                                                <th class='table-header' width='20%'>District</th>
                                                <th class='table-header' width='40%'>Division</th>
                                                <th class='table-header' width='20%'>Telephone No</th>
                                            </tr>
                                        </thead>
                                        <tbody id='table-body '>
                                            <?php
                                            if (!empty($result)) {
                                                foreach ($result as $row) {
                                            ?>
                                                    <tr class='table-row'>
                                                        <td><?php echo $row['district']; ?></td>
                                                        <td><?php echo $row['location']; ?></td>
                                                        <td><?php echo $row['telephone']; ?></td>
                                                    </tr>
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