//halls functions
function configureEditModalHalls(button) {
    const row = button.closest("tr");
    const fields = getHallFields(row);

    modalLabel.textContent = 'Edit Hall';
    confirmButton.textContent = 'Update';
    confirmButton.onclick = () => updateHall(row);

    const form = generateForm(fields);
    updateModalContent(form);
}

function updateHall(row) {
    fetch('/admin/updateHall', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            hallID: row.dataset.hallId,
            locationID: row.dataset.locationId,
            hallName: document.querySelector('#hallNameInput').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                updateTableRow(row, [
                    { datasetKey: 'hallId', value: row.dataset.hallId },
                    { datasetKey: 'locationId', value: row.dataset.locationId },
                    { columnIndex: 1, value: row.dataset.locationId },
                    { columnIndex: 2, value: document.querySelector('#hallNameInput').value },
                ]);

                successMessage.classList.remove("d-none");
                successMessage.innerHTML = data.message;
                universalModal.hide();
            }
            else {
                showError(data.message);
            }
            if (data.status === 1) {
                alertMessage.classList.remove('alert-danger');
                alertMessage.classList.add('alert-success');
            }
        })
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.value = "Something went wrong! Please try again later";
        });
}
function getHallFields(row) {
    if (row !== null) {
        return [
            { id: 'hallIDInput', label: 'Hall ID', value: row.dataset.hallId, type: 'text', readonly: true },
            { id: 'locationIDInput', label: 'Location ID', value: row.dataset.locationId, type: 'text' },
            { id: 'hallNameInput', label: 'Hall Name', value: row.dataset.hallName, type: 'text' }
        ];
    } else {
        return [
            { id: 'locationIDInput', label: 'Location ID', value: row.dataset.locationId, type: 'text' },
            { id: 'hallNameInput', label: 'Hall Name', value: '', type: 'text' }
        ];
    }
}
function getInputDataHalls(row) {
    return {
        artistID: row ? row.dataset.artistId : 0,
        name: document.querySelector('#artistName').value,
        description: document.querySelector('#descriptionInput').value,
        image: document.querySelector('#imagePathInput').value,
        imageSmall: document.querySelector('#imageSmallPathInput').value,
    };
}