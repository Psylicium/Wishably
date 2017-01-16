<?php

// Database host
$dbhost		= "<ADRESSE_TIL_DIN_DATABASE>";

// Database username
$dbusername = "<DATABASE_BRUGERNAVN>";

// Database password
$dbpassword = "<DATABASE_ADGANGSKODE>";

// Database name
$dbname		= "<NAVNET_PÅ_DATABASEN>";

// Connect to database
$db_conx = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()) {
	echo mysqli_connect_error();
exit();
} ?>