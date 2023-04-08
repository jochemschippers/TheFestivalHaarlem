const loginForm = document.getElementById("login");
const registerForm = document.getElementById("register");
const buttonStyle = document.getElementById("btn");
const loginButton = document.getElementById("loginbtn");
const registerButton = document.getElementById("registerbtn");
const form = document.getElementById("form-box");
const alertMessage = document.getElementById("alert");


function register() {
    loginForm.style.left = "-400px";
    registerForm.style.left = "50px";
    buttonStyle.style.left = "110px";
    loginButton.style.color = "#262626";
    registerButton.style.color = "white";
    form.style.height = "65vh";
    alertMessage.classList.add("d-none")
};

function login() {
    loginForm.style.left = "50px";
    registerForm.style.left = "550px";
    buttonStyle.style.left = "0";
    registerButton.style.color = "#262626";
    loginButton.style.color = "white";
    form.style.height = "50vh";
    alertMessage.classList.add("d-none")
};
function checkPassword(password, confirmPassword) {
    if (password != confirmPassword) {
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = "Passwords do not match!";
        return false;
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#register').addEventListener('submit', function (e) {
        e.preventDefault(); 
        alertMessage.classList.remove('alert-success');
        alertMessage.classList.add('alert-danger');
        if (checkPassword(document.getElementById('passwordRegister').value, document.getElementById('passwordConfirm').value)) {
            fetch('account/createAccount', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: document.querySelector('#emailRegister').value,
                    fullname: document.querySelector('#fullName').value,
                    phoneNumber: document.querySelector('#phoneNumber').value,
                    password: document.querySelector('#passwordRegister').value,
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        document.querySelector('#register').reset();
                        alertMessage.classList.remove('alert-danger');
                        alertMessage.classList.add('alert-success');
                    }
                    alertMessage.classList.remove('d-none');
                    alertMessage.innerHTML = data.message;
                })
                .catch(error => {
                    alertMessage.classList.remove('d-none');
                    alertMessage.value = "Something went wrong! Please try again later";
                });
        }
    });

    document.querySelector('#login').addEventListener('submit', function (e) {
        e.preventDefault(); 
        alertMessage.classList.remove('alert-success');
        alertMessage.classList.add('alert-danger');

        fetch('account/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: document.querySelector('#emailLogin').value,
                password: document.querySelector('#passwordLogin').value,
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
                alertMessage.innerHTML = "Something went wrong! Please try again later";
            });

    });
})