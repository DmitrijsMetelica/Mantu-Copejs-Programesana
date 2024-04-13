<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mantu Copējs: Skolas zāle</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='entry.css'>
    <script src='main.js'></script>
    
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Roboto+Condensed:ital,wght@1,700&display=swap');
    </style>
<body id = "enter_background">
    <div id="main_entry_start">
        <div id="top">
            <div class="entry_start_top">
                <img src="images/mantu copējs.png" class = "entry_mantu_copejs">
                <ul>
                    <a href = ""><li class = "vesture_enter_zemkategorija">VĒSTURE</li></a>
                    <a><li class = "ednica_zemkategorija">Skolas zāle</li></a>
                    <a href = "add_sludinajums.html"><li class = "pievienot_rediget_zemkategorija">PIEVIENOT</li></a>
                    <a href = "rediget_dzesana.php"><li class = "pievienot_rediget_zemkategorija">REDIĢĒT</li></a>
                    
                </ul>
            </div>
        </div>
        <div id="content">
            <div class = "sidebar">
                <ul id = "filt_nos">
                    <li>Filtrācija</li>
                </ul>
                <ul>
                    <a href = "Entry_start.php"><li class = "entry_filtri">-Visi sludinājumi</li></a>
                    <a href = "mani-sludinajumi.php"><li class = "entry_filtri">-Mani Sludinājumi</li></a>
                    
                </ul>
                
                </ul>
            </div>  
            
            <div class = "sludinajumu_parskats">
            <?php
            require_once('db.php');

            $sql = "SELECT img, ko_cope, apraksts, statuss, vieta FROM sludinajumi WHERE vieta = '-Skolas zāle' ORDER BY id DESC";
            $result = $connection->query($sql);
            while ($row = $result->fetch_assoc()){
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
                        </div>
                    </div>";
            }
            ?>
            </div>
        </div>

    </div>
    
</body>
</html>