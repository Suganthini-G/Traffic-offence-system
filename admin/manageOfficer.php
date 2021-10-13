<?php

include('includes/config.php'); ?>
<form action="" class="" method="GET">

    <input autocomplete="off" required value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                } ?>">
    <button ">Search</button>

</form>

<?php

if (isset($_GET['search'])) {
    try {
        $filtervalues = $_GET['search'];
        $sql = "SELECT * FROM officer WHERE CONCAT(officer_id,fname,  lname, station, email, mobile,work_status) LIKE '%$filtervalues%' ";

        $result = $pdo->query($sql);
        if ($result->rowCount() > 0) {
            echo '<table style="overflow-x:auto;">';
            echo '<thead>';
            echo '<tr >';
            echo "<th>Officer ID</th>";
            echo "<th>Fullname</th>";
            echo "<th>Station</th>";
            echo "<th>Email</th>";
            echo "<th>Mobile</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo '<tbody style" background: #2b0d0de3;">';
            while ($row = $result->fetch()) {
                echo '<tr >';
                echo "<td>" . $row['officer_id'] . "</td>";
                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                echo "<td>" . $row['station'] . "</td>";
                echo '<td style="text-transform: lowercase;">' . $row['email'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['work_status'] . "</td>";
                echo "<td>";
                echo '<a href="EditOfficer.php?officer_id=' . $row['officer_id'] . '"class="mr-3" title="Update Record" data-bs-toggle="tooltip" data-bs-placement="top">Edit</a>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
?> <div class=" row">
        <div class="col-5"></div>
        <div class="col-5"></div>
        <div class="col-2 mt-2 me-0"> <a href="manageOfficer.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8);color:azure;">Back</a></div>

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
            <div class="col-2 mt-2 me-0"> <a href="manageOfficer.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8);color:azure;">Back</a></div>
        </div>
<?php
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
} else {
    $sql = "SELECT * FROM officer ";
    if ($result = $pdo->query($sql)) {
        if ($result->rowCount() > 0) {
            echo '<table >';
            echo '<thead >';
            echo "<tr>";
            echo "<th>Officer ID</th>";
            echo "<th>Full name</th>";
            echo "<th>Station</th>";
            echo "<th>Email</th>";
            echo "<th>Mobile</th>";
            echo '<th>Status</th>';
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['officer_id'] . "</td>";
                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                echo "<td>" . $row['station'] . "</td>";
                echo '<td style="text-transform: lowercase;">' . $row['email'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['work_status'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            unset($result);
        }
    }
}
unset($pdo);
?>


</html>