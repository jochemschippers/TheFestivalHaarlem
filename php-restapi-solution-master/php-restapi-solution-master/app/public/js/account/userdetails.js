document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // prevent the form from submitting normally

    let fullName = document.querySelector('#fullNameUpdate').value;
    let email = document.querySelector('#emailUpdate').value;
    let phoneNumber = document.querySelector('#phoneNumberUpdate').value;
    let password = document.querySelector('#passwordUpdate').value;
    let confirmPassword = document.querySelector('#confirmPasswordUpdate').value;
    let alertMessageElement = document.getElementById('alertUpdate');

    if (password != confirmPassword) {
        alert("Passwords do not match!");
        return false;
    }

    let data = {
        fullName: fullName,
        email: email,
        phoneNumber: phoneNumber,
        password: password,
    };

    fetch('/account/updateUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    // .then(data => console.log(data))
    .then(data => {
        console.log(data);
        if (data.status === 1) {
            alertMessageElement.innerHTML = data.message;
            alertMessageElement.classList.remove('d-none');
            alert("User details updated successfully!")
            location.reload();
        } else {
            alertMessageElement.innerHTML = data.message;
            alertMessageElement.classList.remove('d-none');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});