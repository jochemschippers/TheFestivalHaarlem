// artist functions
function configureEditModalArtists(button) {
    const row = button.closest("tr");
    const fields = getArtistFields(row);

    modalLabel.textContent = 'Edit Artist';
    confirmButton.textContent = 'Update';
    confirmButton.onclick = () => updateArtist(row);
    const form = generateForm(fields);
    updateModalContent(form);
}
function updateArtist(row) {
    fetch('/admin/updateArtist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getInputDataArtists(row))
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                const columnProperties = [
                    { datasetKey: 'artistId', value: document.querySelector('#artistIDInput').value },
                    { datasetKey: 'name', value: document.querySelector('#artistName').value },
                    { columnIndex: 1, value: document.querySelector('#artistName').value },
                    { columnIndex: 2, value: shortenString(document.querySelector('#descriptionInput').value) },
                    { columnIndex: 3, value: document.querySelector('#imagePathInput').value },
                    { columnIndex: 4, value: document.querySelector('#imageSmallPathInput').value },
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
function configureAddModalArtists() {
    const fields = getArtistFields(null);
    modalLabel.textContent = 'Add Artist';
    confirmButton.textContent = 'create';
    confirmButton.onclick = () => createArtist();
    const form = generateForm(fields);
    updateModalContent(form);
}

function createArtist() {
    fetch('/admin/createArtist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getInputDataArtists(null))
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToArtistsTable(data);
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
function configureDeleteModalArtists(button) {
    modalLabel.textContent = 'Delete Artist';
    confirmButton.textContent = 'Delete';
    confirmButton.className = 'btn btn-danger';
    dynamicFormModal.innerHTML = 'Are you <strong>POSITIVE</strong> you want to delete this artist? <strong>This will also delete the timeslots that are assigned to this artist</strong>';
    confirmButton.onclick = () => confirmDeleteArtist(button.closest("tr"));
}

function confirmDeleteArtist(row) {
    fetch('/admin/deleteArtist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            artistID: row.dataset.artistId
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                successMessage.classList.remove("d-none");
                successMessage.innerHTML = data.message;
                removeRow(dataTableArtists, row);
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
function getArtistFields(row) {
    let fields = [];

    if (row !== null) {
        fields.push({ id: 'artistIDInput', label: 'Artist ID', value: row.dataset.artistId, type: 'text', readonly: true },)
    }
    fields.push({ id: 'artistName', label: 'Artist Name', value: row ? row.dataset.name : '', type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: row ? row.dataset.description : '', type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: row ? row.dataset.image : '', type: 'text' },
        { id: 'imageSmallPathInput', label: 'Image Small Path', value: row ? row.dataset.imageSmall : '', type: 'text' });
    return fields;
}

function getInputDataArtists(row) {
    return {
        artistID: row ? row.dataset.artistId : 0,
        name: document.querySelector('#artistName').value,
        description: document.querySelector('#descriptionInput').value,
        image: document.querySelector('#imagePathInput').value,
        imageSmall: document.querySelector('#imageSmallPathInput').value,
    };
}
function addNewRowToArtistsTable(data) {
    console.log(data);
    const newRowData = [
        data.artist.artistID,
        data.artist.name,
        shortenString(data.artist.description),
        data.artist.image,
        data.artist.imageSmall,
        '<button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, \'editArtist\')">edit</button>',
        '<button class="btn btn-danger" onclick="openModal(this, \'deleteArtist\')">delete</button>',
    ];
    dataTableArtists.rows().add([newRowData]);

    dataTableArtists.update();

    const lastRowData = dataTableArtists.activeRows[dataTableArtists.activeRows.length - 1];

    lastRowData.dataset.artistId = data.artist.artistID;
    lastRowData.dataset.name = data.artist.name;
    lastRowData.dataset.description = data.artist.description;
    lastRowData.dataset.image = data.artist.image;
    lastRowData.dataset.imageSmall = data.artist.imageSmall;

    goToLastPage(dataTableArtists);
}