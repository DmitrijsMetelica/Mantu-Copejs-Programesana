
<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['sludinajumsId'])) {
        $sludinajumsId = $_POST['sludinajumsId'];
        
        // Move data from 'sludinajumi' to 'arhiva_sludinajumi'
        $sql = "INSERT INTO arhiva_sludinajumi SELECT * FROM sludinajumi WHERE id = $sludinajumsId";
        $result = $connection->query($sql);
        
        if ($result) {
            // Delete the record from 'sludinajumi' after moving
            $delete_sql = "DELETE FROM sludinajumi WHERE id = $sludinajumsId";
            $delete_result = $connection->query($delete_sql);
            
            if ($delete_result) {
                echo "Sludinājums pārvietots veiksmīgi!";
            } else {
                echo "Kļūda dzēšot sludinājumu!";
            }
        } else {
            echo "Kļūda pārvietojot sludinājumu!";
        }
    } else {
        echo "Nepieciešams norādīt sludinājuma ID!";
    }
} else {
    echo "Nederīgs pieprasījuma veids!";
}
?>
