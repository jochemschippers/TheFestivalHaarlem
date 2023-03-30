var loginForm = document.getElementById("login");
var registerForm = document.getElementById("register");
var buttonStyle = document.getElementById("btn");
var loginButton = document.getElementById("loginbtn");
var registerButton = document.getElementById("registerbtn");
var form = document.getElementById("form-box");


function register() {
    loginForm.style.left = "-400px";
    registerForm.style.left = "50px";
    buttonStyle.style.left = "110px";
    loginButton.style.color ="#262626";
    registerButton.style.color="white";
    form.style.height="65vh";
};

function login() {
    loginForm.style.left = "50px";
    registerForm.style.left = "550px";
    buttonStyle.style.left = "0";
    registerButton.style.color ="#262626";
    loginButton.style.color="white";
    form.style.height="50vh";

};