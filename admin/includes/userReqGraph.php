<?php
require("config.php");
$get_data = $pdo->prepare("SELECT off_ass , COUNT(*) as request FROM help   
    GROUP BY off_ass   
    ORDER BY COUNT(*); ");


$get_data->execute();
if ($get_data->rowCount() > 0) {
    while ($value = $get_data->fetch(PDO::FETCH_OBJ)) {
        $off_ass = $value->off_ass;
        $request = $value->request;

        $result_array[] = ['off_ass' => $off_ass, 'request' => $request];
    }
    echo json_encode($result_array);
    die();
}
