<?php
// Pārbaudam, vai forma iesniegta un vai ir veikta augšupielāde
if(isset($_POST['submit']) && isset($_FILES['img_slud'])) {
    
    require_once('db.php');

    
    $ko_cope = $_POST['slud_nos'];
    $slud_apr = $_POST['slud_aprk'];
    $vieta = $_POST['slud_vieta'];
    $statuss = $_POST['slud_status'];

    $sql_insert = "INSERT INTO sludinajumi (ko_cope, apraksts, vieta, statuss) VALUES ('$ko_cope', '$slud_apr', '$vieta', '$statuss')";
    
    if ($connection->query($sql_insert) === TRUE) {
        // Iegūstam jaunā sludinājuma ID
        $last_id = $connection->insert_id;
        
        // Pārbaudam, vai faila ielāde notiek pareizi
        if(!empty($_FILES['img_slud']['tmp_name'])) {
            // Mape, kur saglabāt bildes
            $upload_directory = "uploads/";

            // Iegūstam faila paplašinājumu
            $file_extension = pathinfo($_FILES['img_slud']['name'], PATHINFO_EXTENSION);

            // Jauni nosaukums bildes failam ar sludinājuma ID
            $new_filename = $last_id . "." . $file_extension;

            // Ceļš uz jauno bildes failu
            $upload_path = $upload_directory . $new_filename;

            // Pārvieto bildi uz uploads mapi ar jaunu nosaukumu
            if(move_uploaded_file($_FILES['img_slud']['tmp_name'], $upload_path)) {
                // Atjaunojam datubāzes ierakstu ar bildes nosaukumu
                $sql_update = "UPDATE sludinajumi SET img='$new_filename' WHERE id='$last_id'";
                if ($connection->query($sql_update) === TRUE) {
                    // Ja veiksmīgi pievienots, izvadam ziņojumu un pārsūtam uz Entry_start.php
                    echo "<script>alert('Sludinājums veiksmīgi pievienots'); window.location='Entry_start.php';</script>";
                } else {
                    echo "<script>alert('Nosludēt neizdevās'); window.location='add_sludinajums.html';</script>";
                }
            } else {
                // "Nebija iespējams augšupielādēt bildi"
                echo "<script>alert('Nosludēt neizdevās'); window.location='add_sludinajums.html';</script>";
            }
        } else {
            echo "<script>alert('Bilde nav norādīta'); window.location='add_sludinajums.html';</script>";
        }
    } else {
        echo "<script>alert('Nosludēt neizdevās'); window.location='add_sludinajums.html';</script>";
    }

    $connection->close();
} else {
    echo "<script>alert('Forma nav pareizi iesniegta vai nav norādīta bilde'); window.location='add_sludinajums.html';</script>";
}
?>
