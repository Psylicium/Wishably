<?php if(isset($_COOKIE["UID"])) {
	session_start();
	session_unset();
	unset($_COOKIE["UID"]);
	header("Location: index.php");
	setcookie("UID", "", time()-3600);
} else {
	header("Location: index.php");
} ?>