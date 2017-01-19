<?php

// Database host
$dbhost     = "<YOUR_DATABASE_ADDRESS>";

// Database username
$dbusername = "<DATABASE_USERNAME>";

// Database password
$dbpassword = "<DATABASE_PASSWORD>";

// Database name
$dbname     = "<DATABASE_NAME>";

// Connect to database
@$db_conx = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()) {
	die('Database error.');
exit();
} ?>