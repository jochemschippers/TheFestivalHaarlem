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
                { datasetKey: 'endTime', value: document.querySelector('#endTimeInput').value },
                { datasetKey: 'maxTickets', value: document.querySelector('#maxTicketsInput').value },
                { columnIndex: 1, value: document.querySelector('#artistNameInput').options[document.querySelector('#artistNameInput').selectedIndex].innerHTML },
                { columnIndex: 2, value: document.querySelector('#locationNameInput').options[document.querySelector('#locationNameInput').selectedIndex].innerHTML },
                { columnIndex: 3, value: document.querySelector('#hallNameInput').options[document.querySelector('#hallNameInput').selectedIndex].innerHTML },
                { columnIndex: 4, value: document.querySelector('#priceInput').value },
                { columnIndex: 5, value: document.querySelector('#startTimeInput').value },
                { columnIndex: 6, value: document.querySelector('#endTimeInput').value },
                { columnIndex: 7, value: document.querySelector('#maxTicketsInput').value },
            ];
            handleResponse(data, row, columnProperties);
        })
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.value = error.message;
        });
}
function configureDeleteModalTimeSlots(button) {
    modalLabel.textContent = 'Delete Time Slot';
    confirmButton.textContent = 'Delete';
    confirmButton.className = 'btn btn-danger';
    dynamicFormModal.innerHTML = 'Are you <strong>POSITIVE</strong> you want to delete this time slot?';
    confirmButton.onclick = () => confirmDeleteTimeSlot(button.closest("tr"));
}

function confirmDeleteTimeSlot(row) {
    fetch('/test/deleteTimeslot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            timeSlotID: row.dataset.timeslotId
        })
    }).then(response => response.json())
        .then(data => {

            if (data.status === 1) {
                successMessage.classList.remove("d-none");
                successMessage.innerHTML = data.message;
                removeRow(dataTableTimeSlotsJazz, row);
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
        body: JSON.stringify(getInputDataTimeSlots(null))
    }).then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                addNewRowToTimeSlotsTable(data);

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
function getTimeSlotsFields(row) {
    let fields = [];
    if (row !== null) {
        fields.push({ id: 'timeslotIDInput', label: 'Timeslot ID', value: row.dataset.timeslotId, type: 'text', readonly: true });
    }
    fields.push({ id: 'artistNameInput', label: 'Artist Name', value: row ? row.dataset.artistId : '', type: 'dropdown', source: dataTableArtists },
        { id: 'locationNameInput', label: 'Location Name', value: row ? row.dataset.locationId : '', type: 'dropdown', source: dataTableLocations },
        { id: 'hallNameInput', label: 'Hall Name', value: row ? row.dataset.hallId : '', type: 'dropdown', source: dataTableHalls, locationID: row ? row.dataset.locationId : '' },
        { id: 'priceInput', label: 'Price', value: row ? row.dataset.price : '', type: 'text' },
        { id: 'startTimeInput', label: 'Start Time', value: row ? row.dataset.startTime : '', type: 'datetime-local' },
        { id: 'endTimeInput', label: 'End Time', value: row ? row.dataset.endTime : '', type: 'datetime-local' },
        { id: 'maxTicketsInput', label: 'Maximum Tickets', value: row ? row.dataset.maxTickets : '', type: 'text' });
    return fields;
}
function getInputDataTimeSlots(row) {
    return {
        timeslotID: row ? row.dataset.timeslotId : 0,
        artist: document.querySelector('#artistNameInput').value,
        eventID: 1,
        location: document.querySelector('#locationNameInput').value,
        hall: document.querySelector('#hallNameInput').value,
        price: document.querySelector('#priceInput').value,
        startTime: (document.querySelector('#startTimeInput').value.replace('T', ' ')) + ':00',
        endTime: (document.querySelector('#endTimeInput').value.replace('T', ' ')) + ':00',
        maximumAmountTickets: document.querySelector('#maxTicketsInput').value,
    };
}
function addNewRowToTimeSlotsTable(data) {
    const startTime = new Date(data.timeslot.startTime);
    const endTime = new Date(data.timeslot.endTime);

    const formattedStartTime = startTime.toISOString().slice(0, 19).replace('T', ' ');
    const formattedEndTime = endTime.toISOString().slice(0, 19).replace('T', ' ');

    const newRowData = [
        data.timeslot.timeSlotID,
        data.timeslot.artist.name,
        data.timeslot.jazzLocation.locationName,
        data.timeslot.hall.hallName,
        data.timeslot.price,
        formattedStartTime,
        formattedEndTime,
        data.timeslot.maximumAmountTickets,
        '<button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, \'editTimeSlot\')">edit</button>',
        '<button class="btn btn-danger" onclick="openModal(this, \'deleteTimeSlot\')">delete</button>',
    ];
    console.log(newRowData);

    dataTableTimeSlotsJazz.rows().add([newRowData]);
    dataTableTimeSlotsJazz.update();

    const lastRowData = dataTableTimeSlotsJazz.activeRows[dataTableTimeSlotsJazz.activeRows.length - 1];

    lastRowData.dataset.timeslotId = data.timeslot.timeSlotID;
    lastRowData.dataset.artistName = data.timeslot.artist.name;
    lastRowData.dataset.locationName = data.timeslot.jazzLocation.locationName;
    lastRowData.dataset.hallName = data.timeslot.hall.hallName;
    lastRowData.dataset.price = data.timeslot.price;
    lastRowData.dataset.startTime = formattedStartTime;
    lastRowData.dataset.endTime = formattedEndTime;
    lastRowData.dataset.maxTickets = data.timeslot.maximumAmountTickets;

    goToLastPage(dataTableTimeSlotsJazz);
}
