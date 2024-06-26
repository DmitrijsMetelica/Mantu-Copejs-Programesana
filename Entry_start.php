<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mantu Copējs</title>
    <meta name='viewport' content='entry_arhiva.php'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='entry.css'>
    <script src='start.js'></script>
    
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    
    @keyframes fly-in {
    0% {
      transform: scale(0.5) rotate(0deg) translateX(-100%);
    }
    25% {
      transform: scale(1.5) rotate(90deg) translateX(50%);
    }
    50% {
      transform: scale(3) rotate(180deg) translateX(50%);
    }
    75% {
      transform: scale(4.5) rotate(270deg) translateX(50%);
    }
    100% {
      transform: scale(1) rotate(0deg) translateX(0%);
    }
    }
    
    .animated-div {
    position: absolute; /* Lai varētu precīzi kontrolēt elementa atrašanās vietu */
    left: 0; /* Uzstādam sākotnējo pozīciju kreisajā malā */
    top: 50%; /* Vertikāli centrējam elementu */
    transform: translateY(-50%); /* Horizontāli centrējam elementu */
    animation: fly-in 4s infinite; /* Izpildām animāciju */
}

     .animated-logo {
    animation: fly-in 2s ease-in-out;
    }
  

    </style>
<body id="enter_background">
    <div id="main_entry_start">
        <div id="top">
            <div class="entry_start_top">
                <a href="index.html">
                    <img src="images/mantu copējs.png" class="entry_mantu_copejs animated-logo">
                </a>
                <ul>
                    <a href=""><li class="vesture_enter">VĒSTURE</li></a>
                    <a href="add_sludinajums.html"><li class="pievienot_rediget">PIEVIENOT</li></a>
                    <a href="rediget_dzesana.php"><li class="pievienot_rediget">REDIĢĒT</li></a>
                    
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="sidebar">
                <ul id="filt_nos">
                    <li>Filtrācija</li>
                </ul>
                <ul>
                    <a href=""><li class="entry_filtri">-Visi sludinājumi</li></a>
                    <a href="mani-sludinajumi.php"><li class="entry_filtri">-Mani Sludinājumi</li></a>
                    <a><li class="entry_filtri">-Nocopēšanas / pazaudēšanas vieta:</li></a>
                </ul>
                <ul>
                    <a href="filtrs_ednica.php"><li class="entry_filtri_zem">-Ēdnīca</li></a>
                    <a href="filtrs_sporta-centrs.php"><li class="entry_filtri_zem">-Sporta centrs</li></a>
                    <a href="filtrs_a-korpuss.php"><li class="entry_filtri_zem">-A Korpuss</li></a>
                    <a href="filtrs_b-korpuss.php"><li class="entry_filtri_zem">-B Korpuss</li></a>
                    <a href="filtrs_galvena-eka.php"><li class="entry_filtri_zem">-Galvenā ēka</li></a>
                    <a href="filtrs_skolas-zale.php"><li class="entry_filtri_zem">-Skolas zāle</li></a>
                    <a href="filtrs_cits.php"><li class="entry_filtri_zem">-Cits</li></a>
                </ul>
                <ul>
                    <a href="pec_alfabeta.php"><li class="entry_filtri_vel">-Pēc Alfabēta</li></a>
                    <a href="nocopets.php"><li class="entry_filtri_vel">-Nocopēts</li></a>
                    <a href="pazaudets.php"><li class="entry_filtri_vel">-Pazaudēts</li></a>
                </ul>
                <?php
                require_once('db.php');

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    $sql = "SELECT uname FROM user_datubase WHERE id = $user_id";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $user_name = $row['uname'];
                        echo "<ul>
                                <li class='copnesejs'>Copnesējs: $user_name</li>
                            </ul>";
                    }
                }

                ?>
            </div>  
            
            <div class="sludinajumu_parskats">
                <?php
                require_once('db.php');

                $sql = "SELECT id, img, ko_cope, apraksts, statuss, vieta FROM sludinajumi ORDER BY id DESC";
                $result = $connection->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()){
                        $sludinajums_id = $row['id']; // Pārbauda, vai `id` indekss ir pieejams pirms tā izmantošanas
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
                                    <div class='skatit_sludinajumu'>
                                        <button  data-sludinajums-id='$sludinajums_id'>Skatīt</button>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "Kļūda: " . $connection->error; // Parāda kļūdas ziņojumu, ja pieprasījums nav izdevies
                }
                ?>
            </div>

        </div>

    </div>
    
</body>
</html>
