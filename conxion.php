<?php

// Database host
$dbhost     = "";

// Database username
$dbusername = "";

// Database password
$dbpassword = "";

// Database name
$dbname     = "";

// Connect to database
$db_conx = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()) {
	die('Database error.');
exit();
} ?>