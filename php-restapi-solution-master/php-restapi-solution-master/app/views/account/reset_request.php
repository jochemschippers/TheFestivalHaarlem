<form method="post" action="reset_request.php">
    <label for="email">Enter your email to reset password:</label>
    <input type="email" id="email" name="email" required>
    <input type="submit" value="Submit">
</form>

<?php
$email = $_POST['email'];
$token = bin2hex(random_bytes(50)); // generate a random token
storeTokenInDB($email, $token); // store the token in your DB, associated with the user

$resetLink = "https://localhost/reset_password.php?token=$token&email=$email";

// Then send an email with the reset link
sendEmail($email, $resetLink);
?>