<?php
session_start();

// Unset all session variables
$_SESSION = [];

// end the session
session_destroy();

// Redirect the user to the login page after logging out
header("Location: login.php");
exit;
?>
