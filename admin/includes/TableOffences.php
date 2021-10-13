<?php include('config.php'); ?>

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
        $sql = "SELECT * FROM offence WHERE 
        CONCAT(offence_id,offender_id,reporter_id,offence_type,date,
        location,spotfine_no,exp_date,payment_status,case_status ) LIKE '%$filtervalues%' ";

        $result = $pdo->query($sql);
        if ($result->rowCount() > 0) {
            echo '<table>';
            echo '<thead  >';
            echo '<tr >';
            echo "<th>Offence ID</th>";
            echo "<th>Offender Liecense</th>";
            echo "<th>Reported ID</th>";
            echo "<th>Act no</th>";
            echo "<th>Location</th>";
            echo '<th>Date</th>';
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['offence_id'] . "</td>";
                echo "<td>" . $row['offender_id'] . "</td>";
                echo "<td>" . $row['reporter_id'] . "</td>";
                echo "<td>" . $row['offence_type'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";

                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table> ";
            unset($result);
        } else {
            ############### no record error
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
} else {
    $sql = "SELECT * FROM offence ";
    if ($result = $pdo->query($sql)) {
        if ($result->rowCount() > 0) {
            echo '<table>';
            echo '<thead  >';
            echo '<tr >';
            echo "<th>Offence ID</th>";
            echo "<th>Offender Liecense</th>";
            echo "<th>Reported ID</th>";
            echo "<th>Act no</th>";
            echo "<th>Location</th>";
            echo '<th>Date</th>';
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['offence_id'] . "</td>";
                echo "<td>" . $row['offender_id'] . "</td>";
                echo "<td>" . $row['reporter_id'] . "</td>";
                echo "<td>" . $row['offence_type'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";

                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table> ";
            unset($result);
        }
    }
}
unset($pdo);
?>