<?php
session_start();

unset($_SESSION["login_id"]);
header("Location: Velkommen.php");
?>