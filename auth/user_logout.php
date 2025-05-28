<?php
session_start();
session_destroy();
header("Location: ../auth/user_login.php");
exit;
?>
