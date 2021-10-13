<?php
/*session_start();
if (!isset($_SESSION["alogin"]) || $_SESSION["alogin"] !== true) {
    header("location:../../index.php");
    exit;
}*/

include('config.php');

$license_no = $_SESSION['liecense_hold'];

$sql = "UPDATE drivers SET lie_status='blocked' WHERE license_no='$license_no'";
$sql2 = "UPDATE offence SET case_status='court' WHERE offender_id='$license_no'";

$pdo->exec($sql);
$pdo->exec($sql2);

//header("Location:../SFpending.php");

unset($pdo);
