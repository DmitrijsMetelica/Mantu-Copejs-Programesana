<?php
require_once('db.php');

if (isset($_POST['selected_ads'])) {
    $selectedAds = explode(',', $_POST['selected_ads']);
    $placeholders = rtrim(str_repeat('?,', count($selectedAds)), ',');
    $query = "DELETE FROM sludinajumi WHERE id IN ($placeholders)";
    
    $stmt = $connection->prepare($query);
    $stmt->bind_param(str_repeat('s', count($selectedAds)), ...$selectedAds);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Sludinājums veiksmīgi dzēsts'); window.location='rediget_dzesana.php';</script>";
    } else {
        echo "<script>alert('Sludinājums neveiksmīgi dzēsts'); window.location='rediget_dzesana.php';</script>";
    }

    $stmt->close();
}
?>
