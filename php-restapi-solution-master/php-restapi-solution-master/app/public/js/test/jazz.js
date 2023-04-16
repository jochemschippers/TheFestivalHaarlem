const dynamicFormModal = document.getElementById('dynamicFormModal');
const modalLabel = document.getElementById('universalModalLabel');
const universalModal = new bootstrap.Modal(document.getElementById('universalModal'), {});
const confirmButton = document.getElementById('confirmButton');
//this is for the alert message inside the modal
const alertMessage = document.getElementById("alert");
//this is for the alert outside the modal, which should always just give an success.
const successMessage = document.getElementById("successMessage")

function showError(errorMessage) {
    alertMessage.classList.remove('d-none');
    if (alertMessage.classList.contains("success")) {
        alertMessage.classList.remove("alert-success")
    }
    alertMessage.classList.add("alert-danger");
    alertMessage.innerHTML = errorMessage;
}


dynamicFormModal.addEventListener('submit', function (e) {
    e.preventDefault
});


let dataTable = new DataTable("#dataTableArtists", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});


function openModal(button, modalType) {
    alertMessage.classList.add("d-none");
    const row = button.closest("tr");

    if (modalType === 'editArtist') {
        configureEditModalArtists(button);

    } else if (modalType === 'deleteArtist') {
        configureDeleteModalArtists(button);
    }
    else if (modalType === 'addArtist') {
        configureAddModalArtists();
    }   
    else if (modalType === 'editLocation') {
        configureEditModalLocations(button);
    }

    universalModal.show();
}
//update/edit artist functions
function configureEditModalArtists(button) {
    const row = button.closest("tr");
    const fields = [
        { id: 'artistIDInput', label: 'Artist ID', value: row.dataset.artistId, type: 'text', readonly: true },
        { id: 'artistName', label: 'Artist Name', value: row.dataset.name, type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: row.dataset.description, type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: row.dataset.image, type: 'text' },
        { id: 'imageSmallPathInput', label: 'Image Small Path', value: row.dataset.imageSmall, type: 'text' }
    ];
    modalLabel.textContent = 'Edit Artist';
    confirmButton.textContent = 'Update';
    confirmButton.onclick = () => updateArtist(row);
    const form = generateForm(fields);
    dynamicFormModal.innerHTML = '';
    dynamicFormModal.appendChild(form);
}
function updateArtist(row) {
    fetch('/test/updateArtist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            artistID: document.querySelector('#artistIDInput').value,
            artistName: document.querySelector('#artistName').value,
            description: document.querySelector('#descriptionInput').value,
            imagePath: document.querySelector('#imagePathInput').value,
            imageSmallPath: document.querySelector('#imageSmallPathInput').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                // Update the table row with the new data
                row.dataset.artistId = document.querySelector('#artistIDInput').value;
                row.dataset.name = document.querySelector('#artistName').value;
                row.dataset.description = document.querySelector('#descriptionInput').value;
                row.dataset.image = document.querySelector('#imagePathInput').value;
                row.dataset.imageSmall = document.querySelector('#imageSmallPathInput').value;

                const columns = row.children;
                columns[1].textContent = document.querySelector('#artistName').value;
                columns[2].textContent = (document.querySelector('#descriptionInput').value).substring(0, 80) + "...";
                columns[3].textContent = document.querySelector('#imagePathInput').value;
                columns[4].textContent = document.querySelector('#imageSmallPathInput').value;
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



//create artist functions
function configureAddModalArtists() {
    const fields = [
        { id: 'artistName', label: 'Artist Name', value: '', type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: '', type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: '', type: 'text' },
        { id: 'imageSmallPathInput', label: 'Image Small Path', value: '', type: 'text' }
    ];
    modalLabel.textContent = 'Add Artist';
    confirmButton.textContent = 'create';
    confirmButton.onclick = () => createArtist();
    const form = generateForm(fields);
    dynamicFormModal.innerHTML = '';
    dynamicFormModal.appendChild(form);
}

function createArtist() {
    fetch('/test/createArtist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            artistName: document.querySelector('#artistName').value,
            description: document.querySelector('#descriptionInput').value,
            imagePath: document.querySelector('#imagePathInput').value,
            imageSmallPath: document.querySelector('#imageSmallPathInput').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToTable({
                    artistID: data["artist"]["artistID"],
                    artistName: data["artist"]["name"],
                    description: data["artist"]["description"],
                    imagePath: data["artist"]["imagePath"],
                    imageSmallPath: data["artist"]["imageSmallPath"]
                });
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
function addNewRowToTable(data) {
    // Access the underlying table element
    const tableElement = dataTable.table;

    // Insert a new row to the table
    const newRow = tableElement.insertRow(-1);

    newRow.dataset.artistId = data.artistID;
    newRow.dataset.name = data.artistName;
    newRow.dataset.description = data.description;
    newRow.dataset.image = data.imagePath;
    newRow.dataset.imageSmall = data.imageSmallPath;

    newRow.insertCell(0).textContent = data.artistID;
    newRow.insertCell(1).textContent = data.artistName;
    newRow.insertCell(2).textContent = data.description.substring(0, 80) + "...";
    newRow.insertCell(3).textContent = data.imagePath;
    newRow.insertCell(4).textContent = data.imageSmallPath;

    let editCell = document.createElement('td');
    editCell.innerHTML = '<button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, \'edit\')">edit</button>';
    newRow.appendChild(editCell);

    let deleteCell = document.createElement('td');
    deleteCell.innerHTML = '<button class="btn btn-danger" onclick="openModal(this, \'delete\')">delete</button>';
    newRow.appendChild(deleteCell);
    goToLastPage();
}
function goToLastPage() {
    // Calculate the last page index
    const perPage = dataTable.options.perPage;
    const rowCount = dataTable.data.length;
    const lastPageIndex = Math.ceil(rowCount / perPage);
    dataTable.page(lastPageIndex);
}



//delete artists functions

function configureDeleteModalArtists(button) {
    modalLabel.textContent = 'Delete Artist';
    confirmButton.textContent = 'Delete';
    confirmButton.className = 'btn btn-danger';
    dynamicFormModal.innerHTML = 'Are you <strong>POSITIVE</strong> you want to delete this artist? <strong>This will also delete the timeslot corresponding to the artist</strong>';
    confirmButton.onclick = () => confirmDeleteArtist(button.closest("tr"));
}

function confirmDeleteArtist(row) {
    const artistID = row.dataset.artistId;
    fetch('/test/deleteArtist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            artistID: artistID
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                successMessage.classList.remove("d-none");
                successMessage.innerHTML = data.message;
                row.remove();
                universalModal.hide();
            }
            else {
                showError(data.message);
            }
        })
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.value = "Something went wrong! Please try again later";
        });
}




function generateForm(fields) {
    const form = document.createElement('form');
    fields.forEach(field => {

        const formGroup = document.createElement('div');
        formGroup.className = 'form-group';

        const label = document.createElement('label');
        label.htmlFor = field.id;
        label.textContent = field.label;

        var input = createInput(field);

        formGroup.appendChild(label);
        formGroup.appendChild(input);
        form.appendChild(formGroup);
    });
    return form;
}
function createInput(field) {
    var input;
    //create tag
    if (field.type === 'textarea') {
        input = document.createElement('textarea');
        if (field.rows) {
            input.rows = field.rows;
        }
    } else {
        input = document.createElement('input');
        input.type = field.type;
    }

    input.id = field.id;
    input.className = 'form-control';

    if (field.readonly) {
        input.readOnly = true;
    }

    input.value = field.value;
    if (field.readonly) {
        input.readOnly = true;
    }
    return input;
}


// code for locations table: 

const dataTableLocations = new DataTable("#dataTableLocations", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});


//edit update location methods
function configureEditModalLocations(button) {
    const row = button.closest("tr");
    const fields = [
        { id: 'locationIDInput', label: 'Location ID', value: row.dataset.locationId, type: 'text', readonly: true },
        { id: 'locationNameInput', label: 'Location Name', value: row.dataset.locationName, type: 'text' },
        { id: 'addressInput', label: 'Address', value: row.dataset.address, type: 'text' },
        { id: 'imagePathInput', label: 'Image Path', value: row.dataset.image, type: 'text' },
        { id: 'toAndFromText', label: 'To And From Text', value: row.dataset.toAndFromText, type: 'textarea', rows: 5 },
        { id: 'accessibilityText', label: 'To And From Text', value: row.dataset.accessibilityText, type: 'textarea', rows: 5 }
    ];
    modalLabel.textContent = 'Edit Locations';
    confirmButton.textContent = 'Update';
    confirmButton.onclick = () => updateLocation(row);

    const form = generateForm(fields);
    dynamicFormModal.innerHTML = '';
    dynamicFormModal.appendChild(form);
}
function updateLocation(row) {
    fetch('/test/updateLocation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            locationID: row.dataset.locationId,
            locationName: document.querySelector('#locationNameInput').value,
            address: document.querySelector('#addressInput').value,
            imagePath: document.querySelector('#imagePathInput').value,
            toAndFromText: document.querySelector('#toAndFromText').value,
            accessibilityText: document.querySelector('#toAndFromText').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                  // Update the table row with the new data
                  row.dataset.locationId = row.dataset.locationId,
                  row.dataset.locationName = document.querySelector('#locationNameInput').value;
                  row.dataset.description = document.querySelector('#addressInput').value;
                  row.dataset.image = document.querySelector('#imagePathInput').value;
                  row.dataset.imageSmall = document.querySelector('#toAndFromText').value;
                  row.dataset.accessibilityText = document.querySelector('#toAndFromText').value;
  
                  const columns = row.children;
                  columns[1].textContent = document.querySelector('#locationNameInput').value;
                  columns[2].textContent = document.querySelector('#addressInput').value;
                  columns[3].textContent = document.querySelector('#imagePathInput').value;
                  columns[4].textContent = (document.querySelector('#toAndFromText').value).substring(0, 80) + "...";
                  columns[5].textContent = (document.querySelector('#toAndFromText').value).substring(0, 80) + "...";

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