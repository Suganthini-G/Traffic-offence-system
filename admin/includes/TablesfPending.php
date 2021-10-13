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
        location,spotfine_no,exp_date,payment_status,case_status ) LIKE '%$filtervalues%' AND payment_status= 'confirmed'
        and o.offender_id=d.license_no  
         and o.payment_status= 'pending' 
         and o.exp_date < now() 
        and d.lie_status!='blocked'";

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
                echo "<td>" . $row['offence_type'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                $_SESSION['liecense_hold'] = $row['license_no'];
                echo '<td> <a href="lie_hold.php?license_no=' . $row['license_no'] . '"class="mr-3" title="Update Record" data-bs-toggle="tooltip" data-bs-placement="top">Action</a></td>';
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
    $sql = "SELECT o.* , d.* FROM offence o,drivers d 
                                            WHERE o.offender_id=d.license_no  
                                            and o.payment_status= 'pending' 
                                            and o.exp_date < now() 
                                            and d.lie_status!='blocked' ";

    if ($result = $pdo->query($sql)) {
        if ($result->rowCount() > 0) {
            echo '<table>';
            echo '<thead  >';
            echo '<tr>';
            echo "<th>Offence ID</th>";
            echo "<th>Offender Liecense</th>";
            echo "<th>Act no</th>";
            echo "<th>Location</th>";
            echo '<th>Date</th>';
            echo "<th>Hold liecense</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['offence_id'] . "</td>";
                echo "<td>" . $row['offender_id'] . "</td>";
                echo "<td>" . $row['offence_type'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                $_SESSION['liecense_hold'] = $row['license_no'];
                echo '<td> <a href="includes/lie_hold.php?license_no=' . $row['license_no'] . '"class="mr-3" title="Update Record" data-bs-toggle="tooltip" data-bs-placement="top">Action</a></td>';
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