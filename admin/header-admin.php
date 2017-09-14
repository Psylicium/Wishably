<?php session_start(); ob_start();
include("../func.php");
?>

<?php

if ($_GET['logout'] == "true" ) {
	unset($_COOKIE["UID"]);
	setcookie("UID", "", time()-3600);
}

include("../conxion.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ønskesedlen</title>
	<link rel="stylesheet" href="../global.css">
</head>
<body class="admin">

<div class="stickywrapper">

<div class="headerbar headerbar-admin">

<ul>
		<li><p><a class="frontpage" href="<?php echo $server; ?>">&#10094; <?php echo $lang['toindexpage']; ?></a></p></li>
		<li><p>ADMINISTRATOR</p></li>
	</ul>

</div>

<div class="wrapper">