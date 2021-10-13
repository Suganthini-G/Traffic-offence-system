<?php include_once("config.php"); ?>

<form action="" class="" method="GET">
    <div class="d-flex">
        <input name="search" autocomplete="off" required value="<?php if (isset($_GET['search'])) {
                                                                    echo $_GET['search'];
                                                                } ?>" class="form-control" placeholder="Search data">
        <button type="submit">Search</button>
    </div>
</form>
<?php

if (isset($_GET['search'])) {

    try {
        $filtervalues = $_GET['search'];
        $sql = "SELECT * FROM officer WHERE CONCAT(officer_id,fname,  lname, station, email, mobile,work_status) LIKE '%$filtervalues%' ";

        $result = $pdo->query($sql);
        if ($result->rowCount() > 0) {
            echo '<table  id="myTable2" class="table table-primary table-hover text-nowrap">';
            echo '<thead class="sticky-top fs-6 table-secondary border-dark">';
            echo '<tr>';
            echo '<th>Officer ID</th>';
            echo '<th>Fullname</th>';
            echo '<th>Station</th>';
            echo '<th>Email</th>';
            echo '<th>Mobile</th>';
            echo '<th>Status</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody style" background: #2b0d0de3;">';
            while ($row = $result->fetch()) {
                echo '<tr >';
                echo "<td>" . $row['officer_id'] . "</td>";
                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                echo "<td>" . $row['station'] . "</td>";
                echo '<td style="text-transform: lowercase;">' . $row['email'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['work_status'] . "</td>";
                echo '<td> <a href="updateOff.php?officer_id=' . $row['officer_id'] . '"class="btn btn-danger btn-sm px-3" title="Update officer details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fas fa-user-edit"></i></a></td>';
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
?> <div class="row">
                <div class="col-5"></div>
                <div class="col-5"></div>
                <div class="col-2 mt-2 me-0"> <a href="manageOfficer.php" class="btn btn-info" style="background-color: rgba(0, 0, 0, 0.8);color:azure;">Back</a></div>

            </div>
<?php
            unset($result);
        } else {
            ############### no record error
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
} else {
    $sql = "SELECT * FROM officer ";
    if ($result = $pdo->query($sql)) {
        if ($result->rowCount() > 0) {
            echo '<table  id="myTable2" class="table table-primary table-hover text-nowrap">';
            echo '<thead class="sticky-top fs-6 table-secondary border-dark">';
            echo '<tr>';
            echo '<th>Officer ID</th>';
            echo '<th>Fullname</th>';
            echo '<th>Station</th>';
            echo '<th>Email</th>';
            echo '<th>Mobile</th>';
            echo '<th>Status</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody style" background: #2b0d0de3;">';
            while ($row = $result->fetch()) {
                echo '<tr >';
                echo "<td>" . $row['officer_id'] . "</td>";
                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                echo "<td>" . $row['station'] . "</td>";
                echo '<td style="text-transform: lowercase;">' . $row['email'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['work_status'] . "</td>";
                echo '<td> <a href="updateOffForm.php?officer_id=' . $row['officer_id'] . '"class="btn btn-danger btn-sm px-3" title="Update officer details" data-bs-toggle="tooltip" data-bs-placement="top">iuyh8uij<i class="fas fa-user-edit"></i></a></td>';
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