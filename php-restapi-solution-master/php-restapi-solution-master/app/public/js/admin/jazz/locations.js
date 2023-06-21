function configureEditModalLocations(button) {
    const row = button.closest("tr");
    const fields = getLocationFields(row);

    modalLabel.textContent = 'Edit Location';
    confirmButton.textContent = 'Update';
    confirmButton.onclick = () => updateLocation(row);

    const form = generateForm(fields);
    updateModalContent(form);
}
function updateLocation(row) {
    fetch('/test/updateLocation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getInputDataLocations(row))
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                const columnProperties = [
                    { datasetKey: 'locationId', value: row.dataset.locationId },
                    { datasetKey: 'locationName', value: document.querySelector('#locationNameInput').value },
                    { columnIndex: 1, value: document.querySelector('#locationNameInput').value },
                    { columnIndex: 2, value: document.querySelector('#addressInput').value },
                    { columnIndex: 3, value: document.querySelector('#imagePathInput').value },
                    { columnIndex: 4, value: shortenString(document.querySelector('#toAndFromText').value) },
                    { columnIndex: 5, value: shortenString(document.querySelector('#toAndFromText').value).substring(0, 80) },
                ];
                handleResponse(data, row, columnProperties);
            }
            else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError("Something went wrong! Please try again later");
        });
}
//delete locations:
function configureDeleteModalLocations(button) {
    modalLabel.textContent = 'Delete Location';
    confirmButton.textContent = 'Delete';
    confirmButton.className = 'btn btn-danger';
    dynamicFormModal.innerHTML = 'Are you <strong>POSITIVE</strong> you want to delete this location?';
    confirmButton.onclick = () => confirmDeleteLocation(button.closest("tr"));
}
function confirmDeleteLocation(row) {
    const locationID = row.dataset.locationId;
    fetch('/test/deleteLocation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            locationID: locationID
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                successMessage.classList.remove("d-none");
                successMessage.innerHTML = data.message;
                removeRow(dataTableLocations, row);
                universalModal.hide();
            }
            else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError("Something went wrong! Please try again later");
        });
}
function configureAddModalLocations(button) {
    const fields = getLocationFields(button.closest("tr"));

    modalLabel.textContent = 'Add Location';
    confirmButton.textContent = 'Create';
    confirmButton.onclick = () => createLocation();

    const form = generateForm(fields);
    updateModalContent(form);
}
function createLocation() {
    fetch('/test/createLocation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getInputDataLocations(null))
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToLocationsTable(data);

                successMessage.classList.remove("d-none");
                successMessage.innerHTML = data.message;
                universalModal.hide();
            }
            else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError("Something went wrong! Please try again later");
        });

}
function getLocationFields(row) {
    let fields = [];
    //no need to get a locationID input field for adding a new location, as that will be done with auto increment in the db. means no field for location id required.
    if (row !== null) {
        fields.push({ id: 'locationIDInput', label: 'Location ID', value: row.dataset.locationId, type: 'text', readonly: true })
    }
    fields.push(
        { id: 'locationNameInput', label: 'Location Name', value: row ? row.dataset.locationName : '', type: 'text' },
        { id: 'addressInput', label: 'Address', value: row ? row.dataset.address : '', type: 'text' },
        { id: 'imagePathInput', label: 'Image Path', value: row ? row.dataset.image : '', type: 'text' },
        { id: 'toAndFromText', label: 'To And From Text', value: row ? row.dataset.toAndFromText : '', type: 'textarea', rows: 5 },
        { id: 'accesibillityText', label: 'Accessibility Text', value: row ? row.dataset.accessibilityText : '', type: 'textarea', rows: 5 }
    );

    return fields
}
function getInputDataLocations(row) {
    return {
        locationID: row ?  row.dataset.locationId : 0,
        locationName: document.querySelector('#locationNameInput').value,
        address: document.querySelector('#addressInput').value,
        locationImage: document.querySelector('#imagePathInput').value,
        toAndFromText: document.querySelector('#toAndFromText').value,
        accesibillityText: document.querySelector('#toAndFromText').value,
    };
}
function addNewRowToLocationsTable(data) {
    const newRowData = [
        data.location.locationID,
        data.location.locationName,
        data.location.address,
        data.location.locationImage,
        shortenString(data.location.toAndFromText,),
        shortenString(data.location.accesibillityText),
        '<button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, \'editLocation\')">edit</button>',
        '<button class="btn btn-danger" onclick="openModal(this, \'deleteLocation\')">delete</button>',
    ];
    dataTableLocations.rows().add([newRowData]);

    dataTableLocations.update();
    const lastRowData = dataTableLocations.activeRows[dataTableLocations.activeRows.length - 1];

    lastRowData.dataset.locationId = data.location.locationID;
    lastRowData.dataset.locationName = data.location.locationName;
    lastRowData.dataset.address = data.location.address;
    lastRowData.dataset.image = data.location.locationImage;
    lastRowData.dataset.toAndFromText = data.location.toAndFromText;
    lastRowData.dataset.accesibillityText = data.location.accesibillityText;

    goToLastPage(dataTableLocations);
}