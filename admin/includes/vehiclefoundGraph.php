<?php
require("config.php");
$get_data = $pdo->prepare("SELECT hand_over , COUNT(*) as veh FROM found_vehicle   
    GROUP BY hand_over   
    ORDER BY COUNT(*); ");


$get_data->execute();
if ($get_data->rowCount() > 0) {
    while ($value = $get_data->fetch(PDO::FETCH_OBJ)) {
        $hand_over = $value->hand_over;
        $veh = $value->veh;

        $result_array[] = ['hand_over' => $hand_over, 'veh' => $veh];
    }
    echo json_encode($result_array);
    die();
}
