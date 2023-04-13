const dynamicForm = document.getElementById('dynamicForm');
const confirmButton = document.getElementById('updateButton');
const alertMessage = document.getElementById("alert");
var isUpdate;

const dataTable = new DataTable("#dataTableArtists", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});


function openEditModalArtists(button) {
    const row = button.closest("tr");
    const artistID = row.dataset.artistId;
    const name = row.dataset.name;
    const description = row.dataset.description;
    const imagePath = row.dataset.image;
    const imageSmallPath = row.dataset.imageSmall;

    
    const fields = [
        { id: 'artistIDInput', label: 'Artist ID', value: artistID, type: 'text', readonly: true },
        { id: 'artistName', label: 'Artist Name', value: name, type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: description, type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: imagePath, type: 'text' },
        { id: 'imageSmallPathInput', label: 'Image Small Path', value: imageSmallPath, type: 'text' }
    ];
    isUpdate = true;
    confirmButton.textContent = 'Update';
    const form = generateForm(fields);
    dynamicForm.innerHTML = '';
    dynamicForm.appendChild(form);
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}
function openAddModalArtists(button) {
    confirmButton.textContent = "Create";
    const fields = [
        { id: 'artistName', label: 'Artist Name', value: '', type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: '', type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: '', type: 'text' },
        { id: 'imageSmallPathInput', label: 'Image Small Path', value: '', type: 'text' }
    ];
    isUpdate = false;
    const form = generateForm(fields);
    dynamicForm.innerHTML = '';
    dynamicForm.appendChild(form);
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

dynamicForm.addEventListener('submit', function (e) {
    e.preventDefault
});
//add artist code
document.getElementById('add-user-button').addEventListener('click', openAddModalArtists);
function openAddModalArtists() {
    const fields = [
        { id: 'artistName', label: 'Artist Name', value: '', type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: '', type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: '', type: 'text' },
        { id: 'imageSmallPathInput', label: 'Image Small Path', value: '', type: 'text' }
    ];

    const form = generateForm(fields);
    dynamicForm.innerHTML = '';
    dynamicForm.appendChild(form);
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

confirmButton.addEventListener("click", function (event) {
    console.log("isUpdate:", isUpdate);

    event.preventDefault();
    if (isUpdate) {
        updateArtist();
    } else {
        createArtist();
    }
});


//update artist code
function updateArtist() {
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
        alertMessage.classList.remove('alert-danger');
        alertMessage.classList.add('alert-success');
    }
    alertMessage.classList.remove('d-none');
    alertMessage.innerHTML = data.message;
    window.location.reload();
})
.catch(error => {
    alertMessage.classList.remove('d-none');
    alertMessage.value = "Something went wrong! Please try again later";
});
}

//create artist code
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
            alertMessage.classList.remove('alert-danger');
            alertMessage.classList.add('alert-success');
        }
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = data.message;
        window.location.reload();
    })
    .catch(error => {
        alertMessage.classList.remove('d-none');
        alertMessage.value = "Something went wrong! Please try again later";
    });
}
let selectedRow;

function deleteArtist(button) {
    selectedRow = button.closest("tr");
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

function confirmDeleteArtist() {
    const artistID = selectedRow.dataset.artistId;
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
            alertMessage.classList.remove('alert-danger');
            alertMessage.classList.add('alert-success');
            selectedRow.remove();
        } 
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = data.message;
    })
    .catch(error => {
        alertMessage.classList.remove('d-none');
        alertMessage.value = "Something went wrong! Please try again later";
    });
}

document.getElementById('confirmDelete').addEventListener('click', confirmDeleteArtist);



function generateForm(fields){
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
function createInput(field){
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

function openEditModalLocations(button) {
    const row = button.closest("tr");
    const locationID = row.dataset.locationId;
    const locationName = row.dataset.locationName;
    const address = row.dataset.address;
    const imagePath = row.dataset.image;
    const toAndFromText = row.dataset.toAndFromText;
    const accessibilityText = row.dataset.accessibilityText;
    const fields = [
        { id: 'locationIDInput', label: 'Location ID', value: locationID, type: 'text', readonly: true },
        { id: 'locationNameInput', label: 'Location Name', value: locationName, type: 'text' },
        { id: 'addressInput', label: 'Address', value: address, type: 'text' },
        { id: 'imagePathInput', label: 'Image Path', value: imagePath, type: 'text' },
        { id: 'toAndFromText', label: 'To And From Text', value: toAndFromText, type: 'textarea', rows: 5},
        { id: 'toAndFromText', label: 'To And From Text', value: toAndFromText, type: 'textarea', rows:5 }
    ];
    
    const form = generateForm(fields);
    dynamicForm.innerHTML = '';
    dynamicForm.appendChild(form);

    const saveButton = document.createElement('button');
    saveButton.className = 'btn btn-primary';
    saveButton.textContent = 'Save Changes';
    saveButton.onclick = () => updateLocation(locationID);

    const cancelButton = document.createElement('button');
    cancelButton.className = 'btn btn-secondary';
    cancelButton.textContent = 'Cancel';
    cancelButton.setAttribute('data-bs-dismiss', 'modal');

    form.appendChild(saveButton);
    form.appendChild(cancelButton);

    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}



function updateLocation(locationID) {
    fetch('/test/updateLocation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            locationID: locationID,
            locationName: document.querySelector('#locationNameInput').value,
            address: document.querySelector('#addressInput').value,
            imagePath: document.querySelector('#imagePathInput').value,
            toAndFromText: document.querySelector('#toAndFromTextInput').value,
            accessibilityText: document.querySelector('#accessibilityTextInput').value,
        })
    }).then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            alertMessage.classList.remove('alert-danger');
            alertMessage.classList.add('alert-success');
        }
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = data.message;
        window.location.reload();
    })
    .catch(error => {
        alertMessage.classList.remove('d-none');
        alertMessage.value = "Something went wrong! Please try again later";
    });
}