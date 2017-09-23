<?php session_start(); ob_start();
include("func.php");
?>

<?php

if (isset($_GET['logout'])) {
	session_unset();
	unset($_COOKIE["UID"]);
	setcookie("UID", "", time()-3600);
}

include("conxion.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITENAME; ?></title>
	<link rel="stylesheet" href="global.css">
</head>
<body>

<div class="stickywrapper">

<div class="headerbar">

<?php if (isset($_COOKIE["UID"])) {

	include("conxion.php");
	$sql = "SELECT username, admin FROM users WHERE id = ?";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('s', $_COOKIE["UID"]);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($username, $admin);
	$stmt->fetch();
	if (($stmt->num_rows) == 0 ) {
		header("Location:/?logout=true");
	} ?>
	<ul>
		<li><p><a class="frontpage" href="<?php echo $basedir; ?>">&#10094; <?php echo $lang['toindexpage']; ?></a></p></li>
		<li><p><?php echo $lang['loggedinas']; ?> <?php echo $username; ?> (<a class="logout" href="<?php echo $basedir; ?>?logout"><?php echo $lang['logout']; ?></a>)</p></li>
		<li><a href="mylist.php"><?php echo $lang['mywishlist']; ?></a></li>
		<li><a href="gift.php?do=myreservations"><?php echo $lang['myreservations']; ?></a></li>
		<li><p><a class="deleteuser" href="delete.php"><?php echo $lang['deleteuser']; ?></a></p></li>
		<?php if ($admin == TRUE) { ?>
			<li class="admin"><a href="<?php echo $basedir; ?>admin/admin.php?do=delwish"><?php echo $lang['adm-delwish']; ?></a></li>
			<li class="admin"><a href="<?php echo $basedir; ?>admin/admin.php?do=delall"><?php echo $lang['adm-delall']; ?></a></li>
		<?php } ?>
	</ul>

<?php } else { ?>
	<ul>
		<li><p><a class="frontpage" href="<?php echo $basedir; ?>">&#10094; <?php echo $lang['toindexpage']; ?></a></p></li>
		<li><p><?php echo $lang['notloggedin']; ?></p></li>
	</ul>
<?php } ?>

</div>

<div class="wrapper">