<?php
require_once('db.php');

// Pārbaude, vai forma iesniegta
if(isset($_POST['submit'])){
    // Pārbaude, vai img_slud definēts POST pieprasījumā
    if(isset($_POST['img_slud'])) {
        $img = $_POST['img_slud'];
    } else {
        $img = null;
    }

    // Iegūstam citus POST dati
    $ko_cope = $_POST['slud_nos'];
    $slud_apr = $_POST['slud_aprk'];
    $vieta = $_POST['slud_vieta'];
    $statuss = $_POST['slud_status'];

    // Pārbaude, vai faila ielāde notiek pareizi
    if(!empty($_FILES['img_slud']['tmp_name'])) {
        $img = addslashes(file_get_contents($_FILES['img_slud']['tmp_name']));
    }

    // Veidojam SQL vaicājumu
    $sql = "INSERT INTO sludinajumi (img, ko_cope, apraksts, vieta, statuss) VALUES ('$img', '$ko_cope', '$slud_apr', '$vieta', '$statuss')";

    // Izpildam SQL vaicājumu
    if ($connection->query($sql) === TRUE) {
        // Ja veiksmīgi pievienots, izvadam ziņojumu un pārsūtam uz Entry_start.html
        echo "<script>alert('Sludinājums veiksmīgi pievienots'); window.location='Entry_start.html';</script>";
    } else {
        // Ja neizdevās, izvadam kļūdas ziņojumu un pārsūtam uz add_sludinajums.html
        echo "Nosludēt neizdevās - mēģiniet vēlreiz";
        header("Location: add_sludinajums.html");
        exit();
    }

    // Aizvērt savienojumu ar datubāzi
    $connection->close();
}
?>
