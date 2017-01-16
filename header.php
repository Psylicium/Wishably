<?php session_start(); ob_start(); ?>

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
		<li><p><a class="frontpage" href="/">&#10094; Til forsiden</a></p></li>
		<li><p>Logget ind som <?php echo $username; ?> (<a class="logout" href="logout.php">Log ud</a>)</p></li>
		<li><a href="mylist.php">Min ønskeseddel</a></li>
		<li><a href="gift.php?do=myreservations">Ønsker jeg har reserveret</a></li>
		<li><p><a class="deleteuser" href="delete.php">Slet bruger</a></p></li>
	</ul>

<?php } else { ?>
	<ul>
		<li><p><a class="frontpage" href="/">&#10094; Til forsiden</a></p></li>
		<li><p>Du er ikke logget ind</p></li>
	</ul>
<?php } ?>

</div>

<div class="wrapper">