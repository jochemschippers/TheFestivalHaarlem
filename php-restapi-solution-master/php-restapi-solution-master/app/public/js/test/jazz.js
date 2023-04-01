$(document).ready(function() {
    $('#dataTable').DataTable({
      pageLength: 10
    });
  });

  function openEditModalArtists(artistID, name, description, imagePath) {
    // Define the form fields and labels
    const fields = [
        { id: 'artistIDInput', label: 'Artist ID', value: artistID, type: 'text', readonly: true },
        { id: 'nameInput', label: 'Name', value: name, type: 'text' },
        { id: 'descriptionInput', label: 'Description', value: description, type: 'textarea' },
        { id: 'imagePathInput', label: 'Image Path', value: imagePath, type: 'text' }
    ];

    const form = generateForm(fields);

    // Replace the existing form with the generated form
    const dynamicForm = document.getElementById('dynamicForm');
    dynamicForm.innerHTML = '';
    dynamicForm.appendChild(form);

    // Show the modal
    $('#editModal').modal('show');
}

function generateForm(fields){
  const form = document.createElement('form');
  fields.forEach(field => {
      const formGroup = document.createElement('div');
      formGroup.className = 'form-group';

      const label = document.createElement('label');
      label.htmlFor = field.id;
      label.textContent = field.label;

      let input;
      if (field.type === 'textarea') {
          input = document.createElement('textarea');
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

      formGroup.appendChild(label);
      formGroup.appendChild(input);
      form.appendChild(formGroup);
  });
  return form;
}