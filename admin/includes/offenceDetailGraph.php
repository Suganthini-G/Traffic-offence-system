<?php
require("config.php");
$get_data = $pdo->prepare("SELECT offence_name  as offence_name ,  amount FROM fine_details   
    GROUP BY offence_name   
    ORDER BY COUNT(*); ");


$get_data->execute();
if ($get_data->rowCount() > 0) {
    while ($value = $get_data->fetch(PDO::FETCH_OBJ)) {
        $offence_name = $value->offence_name;
        $amount = $value->amount;

        $result_array[] = ['offence_name' => $offence_name, 'amount' => $amount];
    }
    echo json_encode($result_array);
    die();
}
