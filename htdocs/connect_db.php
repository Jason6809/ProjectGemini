<?php
define("DBHOST", "localhost");
define("DBUSERNAME", "root");
define("DBPASSWORD", "");
define("DBNAME", "gemini");

$connection = mysqli_connect(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);

//CHECK CONNECTION
if (!$connection) die("Connection failed".mysqli_connect_error());

mysqli_set_charset($connection, "utf8"); 
?>