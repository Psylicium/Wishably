<?php include("header.php"); ?>
<?php
session_start();
include_once("conxion.php");
require_once("func.php");

// Construct query
$sql = "SELECT id, username, password, email FROM `users` WHERE email = ? AND password = ? LIMIT 1";

// Prepare the query
$stmt = $db_conx->prepare($sql);


// Bind parameters
$stmt->bind_param('ss', e($_POST['email']), e($_POST['password']));

// Execute the query and check for errors. On succes, redirect to page, otherwise kill the script
$stmt->execute();

$stmt->bind_result($id, $username, $password, $email);

if ($stmt->fetch()) {
	setcookie("UID", $id, time()+3600);
	header("Location: index.php");
} else {
	// If user is not found, output an error
	$_SESSION["Error"] = '<div class="unf">' . $lang['loginerror'] . '</div>';
	header("Location: index.php");
	}

?>

<p><a href="/">forside</a></p>