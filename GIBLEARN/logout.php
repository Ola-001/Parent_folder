<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to homepage
header("Location: /Parent_folder/GIBLEARN/index.php");
exit;
?>
