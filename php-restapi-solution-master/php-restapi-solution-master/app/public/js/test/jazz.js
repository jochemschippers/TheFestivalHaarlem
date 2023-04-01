const dynamicForm = document.getElementById('dynamicForm');
const updateButton = document.getElementById('updateButton');
const alertMessage = document.getElementById("alert");

$(document).ready(function() {
    $('#dataTable').DataTable({
      pageLength: 10
    });
  });

  function openEditModalArtists(artistID, name, description, imagePath) {
    // Define the form fields and labels
    const fields = [
        { id: 'artistIDInput', label: 'Artist ID', value: artistID, type: 'text', readonly: true },
        { id: 'artistName', label: 'Artist Name', value: name, type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: description, type: 'textarea', rows: 5 },
        { id: 'imagePathInput', label: 'Image Path', value: imagePath, type: 'text' }
    ];

    const form = generateForm(fields);
    dynamicForm.innerHTML = '';
    dynamicForm.appendChild(form);
    updateButton.setAttribute("onClick","updateArtist()");  

    $('#editModal').modal('show');
}



function updateArtist(){
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
    })
}).then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            document.location.href="/";
        }
        else{
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = data.message;
        }

    })
    .catch(error => {
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = error;
    });
}



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