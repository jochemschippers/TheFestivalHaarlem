const dynamicFormModal = document.getElementById('dynamicFormModal');
const modalLabel = document.getElementById('universalModalLabel');
const universalModal = new bootstrap.Modal(document.getElementById('universalModal'), {});
const confirmButton = document.getElementById('confirmButton');
//this is for the alert message inside the modal
const alertMessage = document.getElementById("alert");
//this is for the alert outside the modal, which should always just give an success.
const successMessage = document.getElementById("successMessage")

const minDate = '2023-07-26T00:00';
const maxDate = '2023-07-29T23:59';

let dataTableArtists = new DataTable("#dataTableArtists", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});


let dataTableLocations = new DataTable("#dataTableLocations", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});

let dataTableHalls = new DataTable("#dataTableHalls", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});

let dataTableTimeSlotsJazz = new DataTable("#dataTableTimeslots", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});
// artist functions

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
            name: document.querySelector('#artistName').value,
            description: document.querySelector('#descriptionInput').value,
            image: document.querySelector('#imagePathInput').value,
            imageSmall: document.querySelector('#imageSmallPathInput').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                updateTableRow(row, [
                    { datasetKey: 'artistId', value: document.querySelector('#artistIDInput').value },
                    { datasetKey: 'name', value: document.querySelector('#artistName').value },
                    { columnIndex: 1, value: document.querySelector('#artistName').value },
                    { columnIndex: 2, value: shortenString(document.querySelector('#descriptionInput').value) },
                    { columnIndex: 3, value: document.querySelector('#imagePathInput').value },
                    { columnIndex: 4, value: document.querySelector('#imageSmallPathInput').value },
                ]);
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



//create artist 
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
            artistID: 0,
            name: document.querySelector('#artistName').value,
            description: document.querySelector('#descriptionInput').value,
            image: document.querySelector('#imagePathInput').value,
            imageSmall: document.querySelector('#imageSmallPathInput').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToArtistsTable({
                    artistID: data["artist"]["artistID"],
                    artistName: data["artist"]["name"],
                    description: data["artist"]["description"],
                    imagePath: data["artist"]["image"],
                    imageSmallPath: data["artist"]["imageSmall"]
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
            console.log(error.message);
        });
}



//delete artists

function configureDeleteModalArtists(button) {
    modalLabel.textContent = 'Delete Artist';
    confirmButton.textContent = 'Delete';
    confirmButton.className = 'btn btn-danger';
    dynamicFormModal.innerHTML = 'Are you <strong>POSITIVE</strong> you want to delete this artist? <strong>This will also delete the timeslots that are assigned to this artist</strong>';
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
                const pageIndex = dataTableArtists.currentPage - 1;
                var rowIndex = Array.from(dataTableArtists.table.rows).indexOf(row);
                rowIndex += (dataTableArtists.options.perPage * pageIndex - 1);
                dataTableArtists.rows().remove(rowIndex);
                dataTableArtists.update();
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



//edit update location methods
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
        body: JSON.stringify({
            locationID: row.dataset.locationId,
            locationName: document.querySelector('#locationNameInput').value,
            address: document.querySelector('#addressInput').value,
            locationImage: document.querySelector('#imagePathInput').value,
            toAndFromText: document.querySelector('#toAndFromText').value,
            accesibillityText: document.querySelector('#toAndFromText').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                updateTableRow(row, [
                    { datasetKey: 'locationId', value: row.dataset.locationId },
                    { datasetKey: 'locationName', value: document.querySelector('#locationNameInput').value },
                    { columnIndex: 1, value: document.querySelector('#locationNameInput').value },
                    { columnIndex: 2, value: document.querySelector('#addressInput').value },
                    { columnIndex: 3, value: document.querySelector('#imagePathInput').value },
                    { columnIndex: 4, value: shortenString(document.querySelector('#toAndFromText').value) },
                    { columnIndex: 5, value: shortenString(document.querySelector('#toAndFromText').value).substring(0, 80) },
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
                const pageIndex = dataTableLocations.currentPage - 1;
                var rowIndex = Array.from(dataTableLocations.table.rows).indexOf(row);
                rowIndex += (dataTableLocations.options.perPage * pageIndex - 1);
                dataTableLocations.rows().remove(rowIndex);
                dataTableLocations.update();
                universalModal.hide();
            }
            else {
                showError("data.message");
            }
        })
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.value = "Something went wrong! Please try again later";
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
        body: JSON.stringify({
            locationID: 0,
            locationName: document.querySelector('#locationNameInput').value,
            address: document.querySelector('#addressInput').value,
            locationImage: document.querySelector('#imagePathInput').value,
            toAndFromText: document.querySelector('#toAndFromText').value,
            accesibillityText: document.querySelector('#accesibillityText').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToLocationsTable({
                    locationID: data.location.locationID,
                    locationName: data.location.locationName,
                    address: data.location.address,
                    imagePath: data.location.locationImage,
                    toAndFromText: data.location.toAndFromText,
                    accesibillityText: data.location.accesibillityText
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
            showError(error.message);
        });
}

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
    fetch('/test/updateHall', {
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

// timeslot functions
function configureEditModalTimeSlots(button) {
    const row = button.closest("tr");
    const fields = getTimeSlotsFields(row);

    modalLabel.textContent = 'Edit Timeslot';
    confirmButton.textContent = 'Update';
    confirmButton.onclick = () => updateTimeslot(row);

    const form = generateForm(fields);
    updateModalContent(form);
}
function updateTimeslot(row) {
    fetch('/test/updateTimeslot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getInputDataTimeSlots(row))
    }).then(response => response.json())
        .then(data => {
            const columnProperties = [
                { datasetKey: 'timeslotId', value: row.dataset.timeslotId },
                { datasetKey: 'artistId', value: document.querySelector('#artistNameInput').value },
                { datasetKey: 'locationId', value: document.querySelector('#locationNameInput').value },
                { datasetKey: 'hallId', value: document.querySelector('#hallNameInput').value },
                { datasetKey: 'price', value: document.querySelector('#priceInput').value },
                { datasetKey: 'startTime', value: document.querySelector('#startTimeInput').value },
                { datasetKey: 'endTime', value: document.querySelector('#endTimeInput').value},
                { datasetKey: 'maxTickets', value: document.querySelector('#maxTicketsInput').value },
                { columnIndex: 1, value: document.querySelector('#artistNameInput').options[document.querySelector('#artistNameInput').selectedIndex].innerHTML },
                { columnIndex: 2, value: document.querySelector('#locationNameInput').options[document.querySelector('#locationNameInput').selectedIndex].innerHTML },
                { columnIndex: 3, value: document.querySelector('#hallNameInput').options[document.querySelector('#hallNameInput').selectedIndex].innerHTML },
                { columnIndex: 4, value: document.querySelector('#priceInput').value },
                { columnIndex: 5, value: document.querySelector('#startTimeInput').value},
                { columnIndex: 6, value: document.querySelector('#endTimeInput').value },
                { columnIndex: 7, value: document.querySelector('#maxTicketsInput').value},
            ];
            handleResponse(data, row, columnProperties);})
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.value = error.message;
        });
}
function configureAddModalTimeSlots(button) {
    const fields = getTimeSlotsFields(null);

    modalLabel.textContent = 'Add Timeslot';
    confirmButton.textContent = 'Create';
    confirmButton.onclick = () => createTimeSlot();

    const form = generateForm(fields);
    updateModalContent(form);
}

function createTimeSlot() {
    fetch('/test/createTimeslot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            timeslotId: 0,
            artistId: document.querySelector('#artistNameInput').value,
            locationId: document.querySelector('#locationNameInput').value,
            hallId: document.querySelector('#hallNameInput').value,
            price: document.querySelector('#priceInput').value,
            startTime: document.querySelector('#startTimeInput').value,
            endTime: document.querySelector('#endTimeInput').value,
            maxTickets: document.querySelector('#maxTicketsInput').value,
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToTimeSlotsTable({
                    timeslotId: data.timeslot.timeslotId,
                    artistName: data.timeslot.artistName,
                    locationName: data.timeslot.locationName,
                    hallName: data.timeslot.hallName,
                    price: data.timeslot.price,
                    startTime: data.timeslot.startTime,
                    endTime: data.timeslot.endTime,
                    maxTickets: data.timeslot.maxTickets
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
            showError(error.message);
        });
}
// helper functions
function getSelectedOptionText(selectElement) {
    return selectElement.options[selectElement.selectedIndex].innerHTML;
}
function getInputDataTimeSlots(row) {
    return {
        timeslotID: row.dataset.timeslotId,
        eventID: 1,
        artistID: document.querySelector('#artistNameInput').value,
        locationID: document.querySelector('#locationNameInput').value,
        hallID: document.querySelector('#hallNameInput').value,
        price: document.querySelector('#priceInput').value,
        startTime: document.querySelector('#startTimeInput').value.replace('T', ' ') + ':00',
        endTime: document.querySelector('#endTimeInput').value.replace('T', ' ') + ':00',
        maximumAmountTickets: document.querySelector('#maxTicketsInput').value,
    };
}
function handleResponse(data, row, columnProperties) {
    if (data.status === 1) {
        updateTableRow(row, columnProperties);
        successMessage.classList.remove("d-none");
        successMessage.innerHTML = data.message;
        universalModal.hide();
    } else {
        showError(data.message);
    }
    if (data.status === 1) {
        alertMessage.classList.remove('alert-danger');
        alertMessage.classList.add('alert-success');
    }
}
function updateTableRow(row, columnProperties) {
    const columns = row.children;

    columnProperties.forEach((column, index) => {
        if (column.datasetKey) {
            row.dataset[column.datasetKey] = column.value;
        }
        if (column.columnIndex) {
            columns[column.columnIndex].textContent = column.value;
        }
    });
}

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
    else if (modalType === 'deleteLocation') {
        configureDeleteModalLocations(button);
    }
    else if (modalType === 'addLocation') {
        configureAddModalLocations(button);
    }
    else if (modalType === 'editHall') {
        configureEditModalHalls(button);
    }
    else if (modalType === 'editTimeslot') {
        configureEditModalTimeSlots(button);
    }
    else if (modalType === 'addTimeslot') {
        configureAddModalTimeSlots(button);
    }

    universalModal.show();
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
    let input;

    if (field.type === 'textarea') {
        input = createTextareaInput(field);
    } else if (field.type === 'dropdown') {
        input = createDropdownInput(field);
    } else {
        input = createBasicInput(field);
    }

    input.id = field.id;
    input.className = 'form-control';

    if (field.readonly) {
        input.readOnly = true;
    }

    return input;
}
function createTextareaInput(field) {
    let input = document.createElement('textarea');
    if (field.rows) {
        input.rows = field.rows;
    }
    input.value = field.value;
    return input;
}
function createDropdownInput(field) {
    let input = document.createElement('select');
    field.source.activeRows.forEach(row => {
        const option = document.createElement('option');
        option.value = row.children[0].textContent;
        option.text = row.children[1].textContent;
        if (option.value === field.value) {
            option.selected = true;
            if (field.id === "hallNameInput" && field.locationID != row.children[2].textContent) {
                console.log(field.locationID);
                option.selected = false;
            }
        }
        input.add(option);
    });
    return input;
}
function createBasicInput(field) {
    let input = document.createElement('input');
    input.type = field.type;

    if (field.type === 'datetime-local') {
        input.min = minDate;
        input.max = maxDate;
        input.step = '60';
    }

    input.value = field.value;
    return input;
}
function addNewRowToArtistsTable(data) {
    const newRowData = [
        data.artistID,
        data.artistName,
        shortenString(data.description),
        data.imagePath,
        data.imageSmallPath,
        '<button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, \'editArtist\')">edit</button>',
        '<button class="btn btn-danger" onclick="openModal(this, \'deleteArtist\')">delete</button>',
    ];
    dataTableArtists.rows().add([newRowData]);
    dataTableArtists.update();

    const lastRowData = dataTableArtists.activeRows[dataTableArtists.activeRows.length - 1];

    lastRowData.dataset.artistId = data.artistID;
    lastRowData.dataset.name = data.artistName;
    lastRowData.dataset.description = data.description;
    lastRowData.dataset.image = data.imagePath;
    lastRowData.dataset.imageSmall = data.imageSmallPath;
    goToLastPageArtists();
}
function goToLastPageArtists() {
    // Calculate the last page index
    const perPage = dataTableArtists.options.perPage;
    const rowCount = dataTableArtists.data.length;
    const lastPageIndex = Math.ceil(rowCount / perPage);
    dataTableArtists.page(lastPageIndex);
}
function addNewRowToLocationsTable(data) {
    const newRowData = [
        data.locationID,
        data.locationName,
        data.address,
        data.imagePath,
        shortenString(data.toAndFromText),
        shortenString(data.accesibillityText),
        '<button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, \'editLocation\')">edit</button>',
        '<button class="btn btn-danger" onclick="openModal(this, \'deleteLocation\')">delete</button>',
    ];
    dataTableLocations.rows().add([newRowData]);

    dataTableLocations.update();

    const lastRowData = dataTableLocations.activeRows[dataTableArtists.activeRows.length - 1];

    lastRowData.dataset.locationId = data.locationID;
    lastRowData.dataset.locationName = data.locationName;
    lastRowData.dataset.address = data.address;
    lastRowData.dataset.image = data.imagePath;
    lastRowData.dataset.toAndFromText = data.toAndFromText;
    lastRowData.dataset.accesibillityText = data.accesibillityText;

    goToLastPageLocations();
}
function goToLastPageLocations() {
    // Calculate the last page index
    const perPage = dataTableLocations.options.perPage;
    const rowCount = dataTableLocations.data.length;
    const lastPageIndex = Math.ceil(rowCount / perPage);
    dataTableLocations.page(lastPageIndex);
}
function shortenString(str) {
    if (str.length > 80) {
        return str.slice(0, 80) + "...";
    }
    return str;
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
        { id: 'accesibillityText', label: 'Accessibility Text', value: row ? row.dataset.accesibillityText : '', type: 'textarea', rows: 5 }
    );

    return fields
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
function getTimeSlotsFields(row) {
    let fields = [];
    if (row !== null) {
        fields.push({ id: 'timeslotIDInput', label: 'Timeslot ID', value: row.dataset.timeslotId, type: 'text', readonly: true });
    }
    fields.push({ id: 'artistNameInput', label: 'Artist Name', value: row ? row.dataset.artistId : '', type: 'dropdown', source: dataTableArtists },
    { id: 'locationNameInput', label: 'Location Name', value: row ? row.dataset.locationId : '', type: 'dropdown', source: dataTableLocations },
    { id: 'hallNameInput', label: 'Hall Name', value: row ? row.dataset.hallId : '', type: 'dropdown', source: dataTableHalls, locationID:  row ? row.dataset.locationId : '' },
    { id: 'priceInput', label: 'Price', value: row ? row.dataset.price : '', type: 'text' },
    { id: 'startTimeInput', label: 'Start Time', value: row ? row.dataset.startTime : '', type: 'datetime-local' },
    { id: 'endTimeInput', label: 'End Time', value: row ? row.dataset.endTime : '', type: 'datetime-local' },
    { id: 'maxTicketsInput', label: 'Maximum Tickets', value: row ? row.dataset.maxTickets : '', type: 'text' });
    return fields;
}
function updateModalContent(form) {
    dynamicFormModal.innerHTML = '';
    dynamicFormModal.appendChild(form);
}