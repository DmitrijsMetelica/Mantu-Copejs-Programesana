<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mantu Copējs: Dzēšana</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='entry.css'>
    <script src='delete_mod.js'></script>
    
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Roboto+Condensed:ital,wght@1,700&display=swap');
</style>
<body id="enter_background">
    <div id="main_entry_start">
        <div id="top">
            <div class="entry_start_top">
                <img src="images/mantu copējs.png" class="dzest_mantu_copejs">
                <button type="submit" class="dzest_sludinajumus">Dzēst</button>;
            </div>
        </div>
        <div id="content">
            <div class="sidebar_dzesana">
                <ul>
                    <a href="Entry_start.php"><li class="entry_filtri">-Visi sludinājumi</li></a>
                </ul>
            </div>  
            <form id="deleteForm" action="rediget_dzesana.php" method="POST">
                <div class="sludinajumu_parskats">
                    <?php
                    require_once('db.php');

                    // Pārbauda, vai GET pieprasījumā ir norādīts lietotāja ID
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];

                        // SQL vaicājums, lai atlasītu sludinājumus no konkrētā lietotāja
                        $sql = "SELECT id, img, ko_cope, apraksts, statuss, vieta FROM sludinajumi WHERE user_id = $user_id ORDER BY id DESC";
                    } else {
                        // Ja nav norādīts lietotāja ID, tiek atgriezti visi sludinājumi
                        $sql = "SELECT id, img, ko_cope, apraksts, statuss, vieta FROM sludinajumi ORDER BY id DESC";
                    }

                    $result = $connection->query($sql);
                    while ($row = $result->fetch_assoc()){
                        $sludinajums_id = $row['id'];
                        $show_img = $row['img'];
                        $show_ko_cope = $row['ko_cope'];
                        $show_apraksts = $row['apraksts'];
                        $show_statuss = $row['statuss'];
                        $show_vieta = $row['vieta'];
                        $status_class = '';

                        if ($show_statuss == '-Nocopēts') {
                            $status_class = 'green'; 
                        } elseif ($show_statuss == '-Pazaudēts') {
                            $status_class = 'red'; 
                        }

                        echo "<div class='sludinajums'>
                                    <div class='sludinajums_img'><img src='uploads/$show_img' /></div>
                                    <div class='sludinajums_info'>
                                        <div class='sludinajums_ko_cope'>$show_ko_cope</div>
                                        <div class='sludinajums_apraksts'>$show_apraksts</div>
                                        <div class='sludinajums_statuss $status_class'>$show_statuss</div>
                                        <div class='sludinajums_vieta'>$show_vieta</div>
                                        <div>  
                                            <label>
                                                <input type='checkbox' class='deleteCheckbox' data-sludinajums-id='$sludinajums_id'> Atzīmēt
                                            </label>
                                        </div>
                                    </div>
                                </div>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
