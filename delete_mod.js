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

    deleteButton.addEventListener('click', function(e) {
        e.preventDefault(); // Novēršam noklusējuma formas iesniegšanu

        const sludinajumiToDelete = [];
        deleteCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                sludinajumiToDelete.push(checkbox.dataset.sludinajumsId);
            }
        });

        if (sludinajumiToDelete.length > 0) {
            const deleteForm = document.getElementById('deleteForm');
            const sludinajumsIdInput = document.createElement('input');
            sludinajumsIdInput.setAttribute('type', 'hidden');
            sludinajumsIdInput.setAttribute('name', 'sludinajums_id');
            sludinajumsIdInput.setAttribute('value', sludinajumiToDelete.join(','));

            deleteForm.appendChild(sludinajumsIdInput);

            deleteForm.submit(); // Iesniedzam formu, lai nosūtītu dzēšanas pieprasījumu
        } else {
            console.log('Nav atlasīts neviens sludinājums dzēšanai.');
        }
    });
});
