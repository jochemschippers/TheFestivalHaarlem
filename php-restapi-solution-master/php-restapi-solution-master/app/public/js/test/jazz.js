const dynamicFormModal = document.getElementById('dynamicFormModal');
const modalLabel = document.getElementById('universalModalLabel');
const universalModal = new bootstrap.Modal(document.getElementById('universalModal'), {});
const confirmButton = document.getElementById('confirmButton');
//this is for the alert message inside the modal
const alertMessage = document.getElementById("alert");
//this is for the alert outside the modal, which should always just give an success.
const successMessage = document.getElementById("successMessage")

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
                columns[2].textContent = shortenString(document.querySelector('#descriptionInput').value);
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
            artistName: document.querySelector('#artistName').value,
            description: document.querySelector('#descriptionInput').value,
            imagePath: document.querySelector('#imagePathInput').value,
            imageSmallPath: document.querySelector('#imageSmallPathInput').value,
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
            imagePath: document.querySelector('#imagePathInput').value,
            toAndFromText: document.querySelector('#toAndFromText').value,
            accesibillityText: document.querySelector('#toAndFromText').value,
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
                  row.dataset.accesibillityText = document.querySelector('#toAndFromText').value;
  
                  const columns = row.children;
                  columns[1].textContent = document.querySelector('#locationNameInput').value;
                  columns[2].textContent = document.querySelector('#addressInput').value;
                  columns[3].textContent = document.querySelector('#imagePathInput').value;
                  columns[4].textContent = shortenString(document.querySelector('#toAndFromText').value);
                  columns[5].textContent = shortenString(document.querySelector('#toAndFromText').value).substring(0, 80);

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
            locationName: document.querySelector('#locationNameInput').value,
            address: document.querySelector('#addressInput').value,
            imagePath: document.querySelector('#imagePathInput').value,
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
                // Update the table row with the new data
                row.dataset.hallId = row.dataset.hallId;
                row.dataset.locationId = row.dataset.locationId;
                row.dataset.hallName = document.querySelector('#hallNameInput').value;

                const columns = row.children;
                columns[1].textContent = row.dataset.locationId;
                columns[2].textContent = document.querySelector('#hallNameInput').value;

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
    confirmButton.onclick = () => updateTimeSlot(row);

    const form = generateForm(fields);
    updateModalContent(form);
}

// helper functions
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
    var input;
    if (field.type === 'textarea') {
        input = document.createElement('textarea');
        if (field.rows) {
            input.rows = field.rows;
        }
    } else if (field.type === 'dropdown') {
        input = document.createElement('select');
        field.source.activeRows.forEach(row => {
            
            const option = document.createElement('option');
            option.value = row.children[0].textContent;
            option.text = row.children[1].textContent;
            if (option.value === field.value) {
                option.selected = true;
            }
            input.add(option);
        });
    } else {
        input = document.createElement('input');
        input.type = field.type;
    }
    if (field.type === 'date') {
        input.type = 'text';

        const pickerWrapper = document.createElement('div');
        pickerWrapper.className = 'input-group date';
        pickerWrapper.appendChild(input);

        const pickerAddon = document.createElement('div');
        pickerAddon.className = 'input-group-append';
        pickerWrapper.appendChild(pickerAddon);

        const pickerAddonButton = document.createElement('button');
        pickerAddonButton.className = 'btn btn-outline-secondary';
        pickerAddonButton.type = 'button';
        pickerAddonButton.innerHTML = '<i class="fas fa-calendar-alt"></i>';
        pickerAddon.appendChild(pickerAddonButton);

        const picker = new tempusDominus.TempusDominus(pickerWrapper, {
            localization: {
                format: 'YYYY-MM-DD HH:mm:ss', // Set the desired format
            },
            useCurrent: !field.value, // Set picker to current date and time if field.value is not set
            display: {
                viewMode: 'clock',
                components: {
                  decades: false,
                  year: false,
                  month: false,
                  date: false,
                  hours: true,
                  minutes: true,
                  seconds: false
                }
            }
        });
    }

    input.id = field.id;
    input.className = 'form-control';

    if (field.readonly) {
        input.readOnly = true;
    }

    if (field.type !== 'dropdown') {
        input.value = field.value;
    }
    if (field.readonly) {
        input.readOnly = true;
    }

    

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

    const tableElement = dataTableArtists.table;

    const lastRowIndex = tableElement.rows.length - 1;
    const newRow = tableElement.rows[lastRowIndex];

    newRow.dataset.artistId = data.artistID;
    newRow.dataset.name = data.artistName;
    newRow.dataset.description = data.description;
    newRow.dataset.image = data.imagePath;
    newRow.dataset.imageSmall = data.imageSmallPath;

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

    const tableElement = dataTableLocations.table;
    const lastRowIndex = tableElement.rows.length - 1;
    const newRow = tableElement.rows[lastRowIndex];

    newRow.dataset.locationId = data.locationID;
    newRow.dataset.locationName = data.locationName;
    newRow.dataset.address = data.address;
    newRow.dataset.image = data.imagePath;
    newRow.dataset.toAndFromText = data.toAndFromText;
    newRow.dataset.accesibillityText = data.accesibillityText;

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
  function getLocationFields(row){
    if( row !== null)
    {
        return [
            { id: 'locationIDInput', label: 'Location ID', value: row.dataset.locationId, type: 'text', readonly: true },
            { id: 'locationNameInput', label: 'Location Name', value: row.dataset.locationName, type: 'text' },
            { id: 'addressInput', label: 'Address', value: row.dataset.address, type: 'text' },
            { id: 'imagePathInput', label: 'Image Path', value: row.dataset.image, type: 'text' },
            { id: 'toAndFromText', label: 'To And From Text', value: row.dataset.toAndFromText, type: 'textarea', rows: 5 },
            { id: 'accesibillityText', label: 'Accessibility Text', value: row.dataset.accesibillityText, type: 'textarea', rows: 5 }
        ];
    }
    else{
        return [
            { id: 'locationNameInput', label: 'Location Name', value: '', type: 'text' },
            { id: 'addressInput', label: 'Address', value: '', type: 'text' },
            { id: 'imagePathInput', label: 'Image Path', value: '', type: 'text' },
            { id: 'toAndFromText', label: 'To And From Text', value: '', type: 'textarea', rows: 5 },
            { id: 'accesibillityText', label: 'Accessibility Text', value: '', type: 'textarea', rows: 5 }
        ];
    }
    
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
            { id: 'locationIDInput', label: 'Location ID', value: row.dataset.locationId, type: 'text'},
            { id: 'hallNameInput', label: 'Hall Name', value: '', type: 'text' }
        ];
    }
}
function getTimeSlotsFields(row) {
    if (row !== null) {
        return [
            { id: 'timeslotIDInput', label: 'Timeslot ID', value: row.dataset.timeslotId, type: 'text', readonly: true },
            { id: 'artistNameInput', label: 'Artist Name', value: row.dataset.artistName, type: 'dropdown', source: dataTableArtists },
            { id: 'locationNameInput', label: 'Location Name', value: row.dataset.locationName, type: 'dropdown', source: dataTableLocations },
            { id: 'hallNameInput', label: 'Hall Name', value: row.dataset.hallName, type: 'dropdown', source: dataTableHalls },
            { id: 'priceInput', label: 'Price', value: row.dataset.price, type: 'text' },
            { id: 'startTimeInput', label: 'Start Time', value: row.dataset.startTime, type: 'date' },
            { id: 'endTimeInput', label: 'End Time', value: row.dataset.endTime, type: 'date' },
            { id: 'maxTicketsInput', label: 'Maximum Tickets', value: row.dataset.maxTickets, type: 'text' }
        ];
    } else {
        return [
            { id: 'artistNameInput', label: 'Artist Name', value: '', type: 'dropdown', source: dataTableArtists },
            { id: 'locationNameInput', label: 'Location Name', value: '', type: 'dropdown', source: dataTableLocations },
            { id: 'hallNameInput', label: 'Hall Name', value: '', type: 'dropdown', source: dataTableHalls },
            { id: 'priceInput', label: 'Price', value: '', type: 'text' },
            { id: 'startTimeInput', label: 'Start Time', value: '', type: 'text' },
            { id: 'endTimeInput', label: 'End Time', value: '', type: 'text' },
            { id: 'maxTicketsInput', label: 'Maximum Tickets', value: '', type: 'text' }
        ];
    }
}
  function updateModalContent(form) {
    dynamicFormModal.innerHTML = '';
    dynamicFormModal.appendChild(form);
}
  
