document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // prevent the form from submitting normally

    let fullName = document.querySelector('#fullNameUpdate').value;
    let email = document.querySelector('#emailUpdate').value;
    let phoneNumber = document.querySelector('#phoneNumberUpdate').value;
    let password = document.querySelector('#passwordUpdate').value;
    let confirmPassword = document.querySelector('#confirmPasswordUpdate').value;

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
    .then(data => {
        if (data.status === 1) {
            // Handle success, e.g., display a success message
            alert(data.message);
        } else {
            // Handle error, e.g., display an error message
            alert(data.message);
        }
        location.reload();
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});