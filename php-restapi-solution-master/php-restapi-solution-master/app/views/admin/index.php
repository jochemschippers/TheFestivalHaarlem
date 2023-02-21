<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=
    "https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Admin Page</title>
    
</head>
 
<body class='text-center'>
    <main class="form-login">
        <form method="POST" id="loginForm" onSubmit="return false; // Returning false stops the page from reloading">
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


    <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#loginForm").on('submit', function(e) {
                var remember_meBool = $("#remember_me").is(":checked");
                $.ajax({
                    url: 'login/loginToAccount',
                    type: "POST",
                    data: {
                        email: $("#email").val(),
                        password: $("#password").val(),
                        remember_me: remember_meBool,
                    },
                    dataType: 'json',
                    processdate: false,
                    cache: false,
                    procesData: false,
                    success: function(response) {
                        $(".infoMessage").css("display", "block");
                        if (response.status === 1) {
                            $("#loginForm")[0].reset();
                            document.location.href="/";
                        }
                        $(".infoMessage").html('<p>' + response.message + '</p>');

                    },
                });

            });
        })
    </script> -->
</body>
