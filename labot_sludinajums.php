<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mantu copējs: Sludinājuma rediģēšana</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='add_sludinajums.css'>
    <script src='add_sludinajumi.js'></script>
</head>
<body>
    <div id="add_sludinajumi_kaste">
        <img src="images/mantu copējs.png" class="log_add_slud">
        <div class="add_logss">
            <?php
            require_once('db.php'); // Pielāgojiet šo atbilstoši jūsu datu bāzes pieslēgumam

            // Izgūstam sludinājumu datus no datu bāzes un attēlojam tos HTML formā
            $sql = "SELECT * FROM sludinajumi";
            $result = $connection->query($sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $sludinajumsId = $row['id'];
            ?>
            <div class="sludinajums" data-sludinajumsId="<?php echo $sludinajumsId; ?>">
                <h3><?php echo $row['ko_cope']; ?></h3>
                <p><?php echo $row['apraksts']; ?></p>
                <button class="skatit_sludinajumu">Rediģēt</button>
            </div>
            <?php
                }
            } else {
                echo "Nav atrasts neviens sludinājums!";
            }
            ?>
        </div>
    </div>

    <!-- Modālais logs sludinājuma rediģēšanai -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Sludinājuma rediģēšana</h2>
            <form id="editForm" action="labot_sludinajums.php" method="post">
                <input type="hidden" id="editId" name="id">
                <label for="editNosaukums">Nosaukums:</label><br>
                <input type="text" id="editNosaukums" name="ko_cope" required><br>
                <label for="editApraksts">Apraksts:</label><br>
                <textarea id="editApraksts" name="apraksts" required></textarea><br><br>
                <button type="submit">Saglabāt izmaiņas</button>
            </form>
            <button id="closeModal">Aizvērt</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editModal');
            const closeModal = document.getElementById('closeModal');
            const editForm = document.getElementById('editForm');

            const sludinajumi = document.querySelectorAll('.sludinajums');

            sludinajumi.forEach(function(sludinajums) {
                const sludinajumsId = sludinajums.getAttribute('data-sludinajumsId');
                const editButton = sludinajums.querySelector('.skatit_sludinajumu');

                editButton.addEventListener('click', function() {
                    const nosaukums = sludinajums.querySelector('h3').textContent;
                    const apraksts = sludinajums.querySelector('p').textContent;

                    document.getElementById('editId').value = sludinajumsId;
                    document.getElementById('editNosaukums').value = nosaukums;
                    document.getElementById('editApraksts').value = apraksts;

                    editModal.style.display = 'block';
                });
            });

            closeModal.addEventListener('click', function() {
                editModal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === editModal) {
                    editModal.style.display = 'none';
                }
            });

            editForm.addEventListener('submit', function(event) {
                // Izvēloties rediģēt un saglabāt izmaiņas, forma tiek iesniegta standarta veidā
                // Tādējādi rediģētie dati tiks nosūtīti uz labot_sludinajums.php
            });
        });
    </script>
</body>
</html>
