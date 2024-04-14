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
                    <button class="atpakalButton">Atpakaļ</button>
                    <button class="labotButton" data-sludinajumsId='${sludinajumsId}'>Labot</button>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        const atpakalButton = document.querySelector('.atpakalButton');
        const labotButton = document.querySelector('.labotButton');

        atpakalButton.addEventListener('click', function() {
            closeModal();
        });

        labotButton.addEventListener('click', function() {
            const sludinajumsId = labotButton.dataset.sludinajumsId;
            window.location.href = `labot_sludinajums.php?id=${sludinajumsId}`;
        });
    }

    function closeModal() {
        const modal = document.querySelector('.modal');
        if (modal) {
            modal.remove();
        }
    }
});
