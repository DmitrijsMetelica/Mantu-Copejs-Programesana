document.addEventListener('DOMContentLoaded', function() {
    const deleteCheckboxes = document.querySelectorAll('.deleteCheckbox');
    const deleteButton = document.querySelector('.dzest_sludinajumus');

    deleteCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let anyChecked = false;
            deleteCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    anyChecked = true;
                }
            });

            if (anyChecked) {
                deleteButton.style.display = 'block';
            } else {
                deleteButton.style.display = 'none';
            }
        });
    });

    deleteButton.addEventListener('click', function() {
        const sludinajumiToDelete = [];
        deleteCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                sludinajumiToDelete.push(checkbox.dataset.sludinajumsId);
            }
        });

        if (sludinajumiToDelete.length > 0) {
            // Veic AJAX pieprasījumu, lai dzēstu sludinājumus
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'rediget_dzesana.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Atgrieztā atbilde no servera
                    // Ja veiksmīgi, atjaunojiet klienta pusi
                    location.reload();
                } else {
                    console.error('Radās kļūda:', xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('AJAX pieprasījuma kļūda');
            };
            xhr.send('sludinajums_id=' + sludinajumiToDelete.join('&sludinajums_id='));
        } else {
            console.log('Nav atlasīts neviens sludinājums dzēšanai.');
        }
    });
});
