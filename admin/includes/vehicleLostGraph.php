<?php
require("config.php");
$get_data = $pdo->prepare("SELECT found_status , COUNT(*) as vehicles FROM vehicle_lost   
    GROUP BY found_status   
    ORDER BY COUNT(*); ");


$get_data->execute();
if ($get_data->rowCount() > 0) {
    while ($value = $get_data->fetch(PDO::FETCH_OBJ)) {
        $found_status = $value->found_status;
        $vehicles = $value->vehicles;

        $result_array[] = ['found_status' => $found_status, 'vehicles' => $vehicles];
    }
    echo json_encode($result_array);
    die();
}
