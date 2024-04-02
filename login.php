<?php

require_once('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Pārbauda, vai ir jau norādīti pareizie tabulas nosaukumi
$sql = "SELECT * FROM user_datubase WHERE email = '$email' AND password = '$password'";
$result = $connection->query($sql);

// Pārbauda, vai vaicājums izdevās
if ($result) {
    // Pārbauda, vai atrasts lietotājs
    if ($result->num_rows > 0) {
        // Ja lietotājs ir atrasts, pārvirza uz nākamo lapu
        header("Location: Entry_start.php");
        exit; // Lai pārliecinātos, ka skripts beidzas pēc pārvirzīšanas
    } else {
        // Ja lietotājs nav atrasts, veic pārvirzīšanu un izvada ziņojumu
        echo "<script>alert('Lietotājs nav atrasts'); window.location='login.html';</script>";
    }
} else {
    // Ja ir kļūda datubāzes vaicājumā
    echo "Error: " . $connection->error;
}

// Atliek atvienoties no datubāzes

?>
