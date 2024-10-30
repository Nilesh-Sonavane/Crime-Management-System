<?php
include 'database.php';
// session_unset();
// session_destroy();
unset($_SESSION["uid"]);
header('Location:../index.php');
?>