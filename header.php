<?php session_start(); ob_start();

// Select the display language. Refer to the /lang/languages.txt file for more information.
include('lang/lang_en.php'); ?>

<?php

if ($_GET['logout'] == "true" ) {
	unset($_COOKIE["UID"]);
	setcookie("UID", "", time()-3600);
}

include("conxion.php");
include("func.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ønskesedlen</title>
	<link rel="stylesheet" href="global.css">
</head>
<body>

<div class="stickywrapper">

<div class="headerbar">

<?php if (isset($_COOKIE["UID"])) {

	include("conxion.php");
	$sql = "SELECT username FROM users WHERE id = ?";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('s', $_COOKIE["UID"]);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($username);
	$stmt->fetch();
	if (($stmt->num_rows) == 0 ) {
		header("Location:/?logout=true" );
	} ?>
	
	<ul>
		<li><p><a class="frontpage" href="<?php echo $basedir; ?>">&#10094; <?php echo $lang['toindexpage']; ?></a></p></li>
		<li><p><?php echo $lang['loggedinas']; ?> <?php echo $username; ?> (<a class="logout" href="logout.php"><?php echo $lang['logout']; ?></a>)</p></li>
		<li><a href="mylist.php"><?php echo $lang['mywishlist']; ?></a></li>
		<li><a href="gift.php?do=myreservations"><?php echo $lang['myreservations']; ?></a></li>
		<li><p><a class="deleteuser" href="delete.php"><?php echo $lang['deleteuser']; ?></a></p></li>
	</ul>

<?php } else { ?>
	<ul>
		<li><p><a class="frontpage" href="<?php echo $basedir; ?>">&#10094; <?php echo $lang['toindexpage']; ?></a></p></li>
		<li><p><?php echo $lang['notloggedin']; ?></p></li>
	</ul>
<?php } ?>

</div>

<div class="wrapper">