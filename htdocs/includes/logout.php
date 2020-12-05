<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("login_tools.php");
  load();
}

$_SESSION = array();

session_destroy();

header("Location: ../index.php");
?>
