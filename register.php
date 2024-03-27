<?php
require_once('db.php');

// Saņemam datus no formas
$uname =  $_POST['reguname'];
$usname = $_POST['regusname'];
$email = $_POST['regemail'];
$password = $_POST['regpassword'];

// Pārbaudam, vai e-pasta adrese atbilst noteiktajam formātam
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Atrodam pozīciju, kurā sākas domēna nosaukums
    $pos = strpos($email, '@marupe.edu.lv');

    // Ja domēna nosaukums ir pareizs un atrodas pareizajā vietā
    if ($pos !== false && $pos === strlen($email) - 14) {
        // Pārbaudam, vai starp "@" un "@marupe.edu.lv" ir viens vai divi "."
        $dotCount = substr_count(substr($email, 0, $pos), '.');
        if ($dotCount === 1 || $dotCount === 2) {
            // Ja viss ir kārtībā, ievietojam datus datu bāzē
            $sql = "INSERT INTO user_datubase (uname, usname, email, password) VALUES ('$uname', '$usname', '$email', '$password')";
            $result = $conn->query($sql);

            if ($result) {
                // Ja ieraksts veiksmīgi ievietots, izvadīt ziņojumu un pārnest uz index.html
                echo "<script>alert('Copnesējs reģistrēts'); window.location='index.html';</script>";
                exit; // Lai nodrošinātu, ka pēc pārvietošanās skripts beidzas
            } else {
                echo "<script>alert('Neizdevās reģistrēties'); window.location='register.html';</script>";
                exit; // Pārvietojam uz iepriekšējo lapu un beidzam skriptu
            }
        } else {
            echo "<script>alert('Neizdevās reģistrēties'); window.location='register.html';</script>";
            exit; // Pārvietojam uz iepriekšējo lapu un beidzam skriptu
        }
    } else {
        echo "<script>alert('Neizdevās reģistrēties'); window.location='register.html';</script>";
        
        exit; // Pārvietojam uz iepriekšējo lapu un beidzam skriptu
    }
} else {
    echo "<script>alert('Neizdevās reģistrēties'); window.location='register.html';</script>";
    exit; // Pārvietojam uz iepriekšējo lapu un beidzam skriptu
}
?>
