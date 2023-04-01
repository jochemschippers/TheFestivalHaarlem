<?php
// logout.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userID'])) {
    // Unset and destroy the session
    unset($_SESSION['userID']);
    session_destroy();
}

?>