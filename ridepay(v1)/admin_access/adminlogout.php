<?php
session_start(); 

// Clear all session data
session_unset();
session_destroy();

header("Location: /ridepay/index.php");
exit();
?>