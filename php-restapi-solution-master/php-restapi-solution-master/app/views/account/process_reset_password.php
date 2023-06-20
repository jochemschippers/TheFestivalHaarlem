<form method="post" action="process_reset_password.php">
    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" required>
    <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
    <input type="hidden" name="email" value="<?= $_GET['email'] ?>">
    <input type="submit" value="Reset Password">
</form>

<?php
$newPassword = $_POST['newPassword'];
$token = $_POST['token'];
$email = $_POST['email'];

// Fetch the stored token from the DB
$storedToken = getTokenFromDB($email);

if (hash_equals($storedToken, $token)) {
    // If the token is valid, hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Update the password in the database
    updatePassword($email, $hashedPassword);

    // Remove the token from the database
    removeTokenFromDB($email);
    echo "Password reset successful";
} else {
    echo "Invalid token";
}
?>