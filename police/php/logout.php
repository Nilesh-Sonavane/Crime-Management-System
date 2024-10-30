<?php
include 'database.php';
// session_unset();
// session_destroy();
unset($_SESSION["pid"]);
header('Location:../index.php');
?>