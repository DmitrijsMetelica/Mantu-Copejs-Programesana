<?php
// Iekļaujam datu bāzes savienojumu
require_once('db.php');

// Saņemam datus no formas
$uname =  $_POST['reguname'];
$usname = $_POST['regusname'];
$email = $_POST['regemail'];
$password = $_POST['regpassword'];

// Izveidojam SQL vaicājumu, pielāgojot to datu bāzes nosaukumam
$sql = "INSERT INTO user_datubase (uname, usname, email, password) VALUES ('$uname', '$usname', '$email', '$password')";

$conn -> query($sql);

// Aizveram savienojumu ar datu bāzi
// $conn->close();

?>