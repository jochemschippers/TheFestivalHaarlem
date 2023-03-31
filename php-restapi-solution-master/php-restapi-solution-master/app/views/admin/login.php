<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>

</head>

<body class='text-center'>
    <main class="form-login">
        <form method="POST" id="loginForm" onSubmit="return false;"> <!-- Returning false stops the page from reloading -->
            <h1 class="h3 mb-3 fw-normal">Login hier</h1>
            <div class="infoMessage"> </div>
            <div class="form-floating">
                <input type="email" class="form-control" placeholder="name@example.com" id="email" minlength="7" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Password" id="password" minlength="8" required>
                <label for="floatingPassword">Wachtwoord</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember_me" id="remember_me"> Onthoud mij
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" id="login">login</button>
        </form>
    </main>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("#loginForm").addEventListener('submit', function(e) {
                e.preventDefault();
                var remember_meBool = document.querySelector("#remember_me").checked;
                fetch('user/LoginToAccount', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            email: document.querySelector("#email").value,
                            password: document.querySelector("#password").value,
                            remember_me: remember_meBool,
                        }),
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        document.querySelector(".infoMessage").style.display = "block";
                        if (data.status === 1) {
                            document.querySelector("#loginForm").reset();
                            document.location.href = "/";
                        }
                        document.querySelector(".infoMessage").innerHTML = '<p>' + data.message + '</p>';
                    })
                    .catch(function(error) {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            });
        });
    </script>
</body>