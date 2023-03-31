<?php
// logout.php

session_start();

if (isset($_SESSION['userID'])) {
    // Unset and destroy the session
    unset($_SESSION['userID']);
    session_destroy();
}

// Redirect the user to the login page or another desired page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>