setTimeout(function() {
    document.getElementById('loading').classList.add('d-none');
s}, 2000);


const dynamicFormModal = document.getElementById('dynamicFormModal');
const modalLabel = document.getElementById('universalModalLabel');
const universalModal = new bootstrap.Modal(document.getElementById('universalModal'), {});
const confirmButton = document.getElementById('confirmButton');
//this is for the alert message inside the modal
const alertMessage = document.getElementById("alert");
//this is for the alert outside the modal, which should always just give an success.
const successMessage = document.getElementById("successMessage")

const minDate = '2023-07-27T00:00';
const maxDate = '2023-07-30T23:59';

loadJsFilesFromFolder('/js/admin/jazz/', ['halls.js', 'artists.js', 'timeSlots.js', 'locations.js']);

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


dynamicFormModal.addEventListener('submit', function (e) {
    e.preventDefault
});


function openModal(button, modalType) {
    alertMessage.classList.add("d-none");
    const row = button.closest("tr");

    switch (modalType) {
        case 'editArtist':
            configureEditModalArtists(button);
            break;

        case 'deleteArtist':
            configureDeleteModalArtists(button);
            break;

        case 'addArtist':
            configureAddModalArtists();
            break;

        case 'editLocation':
            configureEditModalLocations(button);
            break;

        case 'deleteLocation':
            configureDeleteModalLocations(button);
            break;

        case 'addLocation':
            configureAddModalLocations(button);
            break;

        case 'editHall':
            configureEditModalHalls(button);
            break;

        case 'editTimeSlot':
            configureEditModalTimeSlots(button);
            break;

        case 'deleteTimeSlot':
            configureDeleteModalTimeSlots(button);
            break;

        case 'addTimeSlot':
            configureAddModalTimeSlots(button);
            break;

        default:
            console.error('Unrecognized modal type:', modalType);
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
