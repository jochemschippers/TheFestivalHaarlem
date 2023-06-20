<div id="formBody">
    <form method="post" id="resetPasswordEmailForm">
        <h2>Reset password</h2>
        <div class="alert alert-danger d-none" id="alert" role="alert"></div>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <label for="confirmNewPassword">Confirm New Password:</label>
        <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
        <input type="submit" value="Reset Password">
    </form>
</div>


<?php
// $email = $_POST['email'];
// $token = bin2hex(random_bytes(50)); // generate a random token
// storeTokenInDB($email, $token); // store the token in your DB, associated with the user

// $resetLink = "https://localhost/reset_password.php?token=$token&email=$email";

// // Then send an email with the reset link
// sendEmail($email, $resetLink);
?>