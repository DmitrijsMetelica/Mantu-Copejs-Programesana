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
        echo "<p>Atlasītie sludinājumi ir veiksmīgi dzēsti.</p>";
    } else {
        echo "<p>Radās kļūda. Sludinājumi netika dzēsti.</p>";
    }

    $stmt->close();
}
?>
