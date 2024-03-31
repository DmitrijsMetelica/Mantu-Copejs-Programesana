<?php
require_once('db.php');

$img=  $_POST['img_slud'];
$ko_cope = $_POST['slud_nos'];
$slud_apr = $_POST['slud_aprk.'];
$vieta = $_POST['slud_vieta'];
$statuss = $_POST['slud_status'];

if(isset($_POST['submit'])){
    if(!empty($_FILES['img_slud']['tmp_name'])) $img = addslashes(file_get_contents($_FILES['img_slud']['tmp_name']));
    $connection->query("INSERT INTO sludinajumi (img) VALUES ('$img')");

    $sql = "INSERT INTO 'sludinajumi' (ko_cope, apraksts, vieta, statuss) VALUES ('$ko_cope', '$slud_apr', '$vieta', '$statuss')";

}
?>