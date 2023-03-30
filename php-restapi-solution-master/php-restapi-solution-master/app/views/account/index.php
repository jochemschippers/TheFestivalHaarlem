<body>

    <div id="form-box">
    <div class="alert alert-danger d-none" id="alert" role="alert">

</div>
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="sign-up btn-account" id="loginbtn" onclick="login()">Log in</button>
            <button type="button" class="sign-up btn-account" id="registerbtn" onclick="register()" style="color: rgb(38, 38, 38);">Sign in</button>
        </div>
        <form id="login" class="form-group input-group">
            <div class="form-floating">
                <input type="email" class="form-control input-field" placeholder="name@example.com" id="emailLogin" minlength="7" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control input-field" placeholder="name@example.com" id="passwordLogin" minlength="7" required>
                <label for="floatingInput">password</label>
            </div>
            <button type="sumbit" class="submit-btn btn-account">Log in</button>
        </form>
        <form id="register" class="input-group" method="POST" onSubmit="return false;">
            <div class="form-floating">
                <input type="email" class="form-control input-field" placeholder="name@example.com" id="emailRegister" minlength="7" required>
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control input-field" placeholder="Pieter Van Der Berg" id="fullName" minlength="3" required>
                <label for="floatingInput">FullName</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control input-field" placeholder="+31 06 12 34 56 78" id="phoneNumber" minlength="9" required>
                <label for="floatingInput">Phone Number</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control input-field" placeholder="" id="passwordRegister" minlength="7" required>
                <label for="floatingInput">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control input-field" placeholder="" id="passwordConfirm" minlength="7" required>
                <label for="floatingInput">Confirm Password</label>
            </div>
            <button type="sumbit" class="submit-btn btn-account" id="signUp">Register</button>
        </form>
    </div>
    <script src="/js/account.js"></script>


    <script type="text/javascript">
        const alertMessage = document.querySelector("#alert");

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#register').addEventListener('submit', function(e) {
                alertMessage.classList.remove('alert-success');
                alertMessage.classList.add('alert-danger');
                if (document.getElementById('passwordRegister').value != document.getElementById('passwordConfirm').value) {
                    e.preventDefault();
                    alertMessage.classList.remove('d-none');
                    alertMessage.innerHTML = "Passwords do not match!";
                } else {
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
        })
    </script>