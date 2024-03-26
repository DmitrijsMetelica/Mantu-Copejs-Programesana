<?php
// Iekļaujam datu bāzes savienojumu
// require_once('db_connection.php');

// Saņemam datus no formas
echo $_POST['reguname'];
// $usname = $_POST['regusname'];
// $email = $_POST['regemail'];
// $password = $_POST['regpassword'];

// // Izveidojam SQL vaicājumu, pielāgojot to datu bāzes nosaukumam
// $sql = "INSERT INTO user_datubase (uname, usname, email, password) VALUES ('$uname', '$usname', '$email', '$password')";

// // Palaist SQL vaicājumu un pārbaudīt rezultātu
// if ($conn->query($sql) === TRUE) {
//     echo "Jauns ieraksts veiksmīgi pievienots";
// } else {
//     echo "Kļūda: " . $sql . "<br>" . $conn->error;
// }

// // Aizveram savienojumu ar datu bāzi
// $conn->close();

// ?>