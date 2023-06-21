const loginForm = document.getElementById("login");
const registerForm = document.getElementById("register");
const resetForm = document.getElementById("reset");
const buttonStyle = document.getElementById("btn");
const loginButton = document.getElementById("loginbtn");
const registerButton = document.getElementById("registerbtn");
const resetButton = document.getElementById("resetbtn");
const form = document.getElementById("form-box");
const alertMessage = document.getElementById("alert");

resetForm.style.display = "none";

function register() {
    loginForm.style.left = "-400px";
    registerForm.style.left = "50px";
    // resetForm.style.left = "550px";
    buttonStyle.style.left = "110px";
    loginButton.style.color = "#262626";
    registerButton.style.color = "white";
    form.style.height = "80vh";
    loginForm.reset;
    resetForm.style.display = "none"; // hide the reset form
    alertMessage.classList.add("d-none")
};

function login() {
    loginForm.style.left = "50px";
    registerForm.style.left = "550px";
    // resetForm.style.left = "550px";
    buttonStyle.style.left = "0";
    registerButton.style.color = "#262626";
    loginButton.style.color = "white";
    form.style.height = "50vh";
    alertMessage.classList.add("d-none")
    registerForm.reset;
    resetForm.style.display = "none"; // hide the reset form
};

function reset() {
    loginForm.style.left = "-400px";
    registerForm.style.left = "550px";
    buttonStyle.style.left = "110px";
    loginButton.style.color = "#262626";
    // resetButton.style.color = "white";
    form.style.height = "50vh";
    alertMessage.classList.add("d-none")
    loginForm.reset;
    registerForm.reset;
    resetForm.style.display = "block"; // show the reset form
};


function checkPassword(password, confirmPassword) {
    if (password != confirmPassword) {
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = "Passwords do not match!";
        return false;
    }
    return true;
}


registerForm.addEventListener('submit', function (e) {
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
                    registerForm.reset();
                    resetForm.reset();
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
loginForm.addEventListener('submit', function (e) {
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
                document.location.href = "/";
            }
            else {
                alertMessage.classList.remove('d-none');
                alertMessage.innerHTML = data.message;
            }

        })
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = "Something went wrong! Please try again later" + error.message;
        });

});

resetForm.addEventListener('submit', function (e) {
    e.preventDefault();
    alertMessage.classList.remove('alert-success');
    alertMessage.classList.add('alert-danger');
    checkEmail(document.getElementById('emailReset').value)
});

function checkEmail(email) {
    try {
        fetch('account/checkEmail', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
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




// Array of image file names
var images = [
    "jazz-login-pic.jpg",
    "yummy-login-picture.jpg"
];

// Generate a random number between 0 and the number of images
var randomNumber = Math.floor(Math.random() * images.length);

// Create an img element and set its source using the random number
var imgElement = document.createElement("img");
imgElement.src = "../image/account/" + images[randomNumber];
imgElement.id = "background-image";

// Append the img element to the body
document.body.appendChild(imgElement);