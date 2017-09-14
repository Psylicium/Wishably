<?php include("header-admin.php"); ?>

<?php

// Check if the user is logged in, and redirect to index page if not
if (!isset($_COOKIE["UID"])) {
	header("Location:/");
} else {

	include("../conxion.php");
	$sql = "SELECT username, admin FROM users WHERE id = ?";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('s', $_COOKIE["UID"]);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($username, $admin);
	$stmt->fetch();
	
	// If the user is logged in, but not admin, redirect to index page
	if ($admin == FALSE) {
			header("Location:/");
	}
} 

switch ($_GET['do']) {
	
	// Delete all wishes
	case "delwish":
	
		if(isset($_POST['submit']) && !isset($_POST['confirm'])){ // If checkbox isn't checked, abort...
			echo 'Error!';
			exit;
		} else if(isset($_POST['submit']) && isset($_POST['confirm'])) { // otherwise, go on
			
			// Truncate table `gifts`
			include("../conxion.php");
			$sql = "TRUNCATE `gifts`";
			$stmt = $db_conx->prepare($sql);
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['adm-delgift-err'] . mysqli_error($db_conx);
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['adm-delgift-ok'];
			}
			
			echo '<div class="status center">';
			foreach ($status as $stat) {
				echo '<p>' . $stat . '</p>';
			}
			echo $lang['redir-index'];
			echo '</div>';
			
			echo '<script src="../js.js"></script>';
			header("refresh:5;url=".$server );
			
			exit;	
			
		} ?>
	
		<h1><?php echo $lang['adm-delwish-title']; ?></h1>
		<p><?php echo $lang['adm-delwish-desc']; ?></p>
		<form class="login" action="<?php echo htmlspecialchars($server . $_SERVER['REQUEST_URI']); ?>" method="POST">
		<div class="checkbox"><input type="checkbox" id="mos8580" name="confirm" value="yes" />
		<label for="mos8580"><span></span><?php echo $lang['adm-delwish-conf']; ?></label>
		<button id="singlebutton" name="submit" class="submit"><?php echo $lang['adm-del-submit']; ?></button></div>
		</form>
		<?php break;
		
	// Delete all wishes
	case "delall":
	
		$status = array();
		
		if(isset($_POST['submit']) && !isset($_POST['confirm'])){ // If checkbox isn't checked, abort...
			echo 'Error!';
			exit;
		} else if(isset($_POST['submit']) && isset($_POST['confirm'])) { // otherwise, go on
			
			include("../conxion.php");
			
			// Truncate table `gifts`
			$sql = "TRUNCATE `gifts`";
			$stmt = $db_conx->prepare($sql);
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['adm-delgift-err'] . mysqli_error($db_conx);
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['adm-delgift-ok'];
			}
			
			// Truncate table `users`
			$sql = "TRUNCATE `users`";
			$stmt = $db_conx->prepare($sql);
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['adm-deluser-err'] . mysqli_error($db_conx);
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['adm-deluser-ok'];
			}
			
			echo '<div class="status center">';
			foreach ($status as $stat) {
				echo '<p>' . $stat . '</p>';
			}
			echo $lang['redir-logoutdel'];
			echo '</div>';
			
			echo '<script src="../js.js"></script>';
			header("refresh:5;url=/?logout=true" );
			
			exit;
			
		} ?>
	
		<h1><?php echo $lang['adm-delall-title']; ?></h1>
		<p><?php echo $lang['adm-delall-desc']; ?></p>
		
		<form class="login" action="<?php echo htmlspecialchars($server . $_SERVER['REQUEST_URI']); ?>" method="POST">
		<div class="checkbox"><input type="checkbox" id="mos8580" name="confirm" value="yes" />
		<label for="mos8580"><span></span><?php echo $lang['adm-delall-conf']; ?></label>
		<button id="singlebutton" name="submit" class="submit"><?php echo $lang['adm-del-submit']; ?></button></div>
		</form>
		<?php break;
	
	// Accessing the page directly redirects to index page. Nothing to see here...
	default:
	header("Location:/");
	break;
	
} ?>

<?php include_once("../footer.php"); ?>