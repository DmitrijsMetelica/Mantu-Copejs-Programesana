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
                <!-- Sidebar content -->
            </div>  
            
            <div class="sludinajumu_parskats">
                <!-- Sludinājumu parskata sadaļa -->
            </div>

        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skatitButtons = document.querySelectorAll('.skatit_sludinajumu');

            skatitButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const sludinajumsId = button.dataset.sludinajumsId;
                    showModal(sludinajumsId);
                });
            });

            function showModal(sludinajumsId) {
                const modalHTML = `
                    <div class="modal">
                        <div class="modal-content">
                            <h2>Sludinājuma pārvaldība</h2>
                            <button class="copyButton" data-sludinajums-id='${sludinajumsId}'>Copēt</button>
                            <button class="atpakalButton">Atpakaļ</button>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHTML);

                const copyButton = document.querySelector('.copyButton');
                const atpakalButton = document.querySelector('.atpakalButton');

                copyButton.addEventListener('click', function() {
                    const sludinajumsId = copyButton.dataset.sludinajumsId;
                    moveSludinajums(sludinajumsId);
                });

                atpakalButton.addEventListener('click', function() {
                    closeModal();
                });
            }

            function closeModal() {
                const modal = document.querySelector('.modal');
                if (modal) {
                    modal.remove();
                }
            }

            function moveSludinajums(sludinajumsId) {
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log("Sludinājums pārvietots veiksmīgi!");
                            closeModal();
                            // Optionally, you can reload the page or update the UI here
                        } else {
                            console.error("Kļūda pārvietojot sludinājumu!");
                        }
                    }
                };
                xhr.open("POST", "move_sludinajums.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("sludinajumsId=" + sludinajumsId);
            }
        });
    </script>
</body>
</html>
