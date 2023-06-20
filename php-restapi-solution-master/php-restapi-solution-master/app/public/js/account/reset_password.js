window.onload = function() {
    var resetForm = document.getElementById('resetPasswordEmailForm');
    var newPassword = document.getElementById('newPassword');
    const urlParams = new URLSearchParams(window.location.search);
    const email = decodeURIComponent(urlParams.get('email'));
    var confirmNewPassword = document.getElementById('confirmNewPassword');
    var alertMessage = document.getElementById("alert");

    resetForm.addEventListener('submit', function(event) {
        event.preventDefault(); // prevent form submission

        if (newPassword.value === confirmNewPassword.value) {
            resetPassword(email, newPassword.value);
        } else {
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = "Passwords do not match!";
        }
    });

    function resetPassword(email, newPassword) {
        try {
            fetch('resetPassword', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    newPassword: newPassword
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 0) {
                        alertMessage.classList.remove('d-none');
                        alertMessage.innerHTML = data.message;
                    }
                })
                .catch(error => {
                    alertMessage.classList.remove('d-none');
                    alertMessage.innerHTML = "Something went wrong! Please try again later";
                });
        }
        catch (error) {
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = "Something went wrong! Please try again later";
        }
    }
}