<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mantu_copejs";

// Izveido savienojumu ar datu bāzi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Pārbauda savienojuma veiksmīgumu
if (!$conn) {
    die("Savienojuma neizdevās: " . mysqli_connect_error());
} else {
    echo "Savienojums veiksmīgs";
}

// Norādām, ka izmantojam UTF-8 kodējumu
mysqli_set_charset($conn, "utf8");
?>
