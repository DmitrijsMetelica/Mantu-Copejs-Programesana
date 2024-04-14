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
document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.copyButton');

    copyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const sludinajumsId = button.dataset.sludinajumsId;
            moveSludinajums(sludinajumsId);
        });
    });

    function moveSludinajums(sludinajumsId) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
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
