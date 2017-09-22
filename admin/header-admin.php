<?php session_start(); ob_start();
include("../func.php");
?>

<?php include("../conxion.php"); ?>
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
		<li><p><a class="frontpage" href="<?php echo $basedir; ?>">&#10094; <?php echo $lang['toindexpage']; ?></a></p></li>
		<li><p>ADMINISTRATOR</p></li>
	</ul>

</div>

<div class="wrapper">