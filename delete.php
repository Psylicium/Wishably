<?php include("header.php");

if (!$_COOKIE["UID"]) {
	header("Location:".$basedir );
}

if (isset($_POST['submit'])) {

	include("conxion.php");
	require_once("func.php");
	
	// Check credentials
	$sql = "SELECT * FROM `users` WHERE id = ? AND email = ?";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('is', e($_COOKIE["UID"]), e($_POST['profidelete']));
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($id, $username, $password, $email);
	$stmt->fetch();
	
	// If no rows are found (i.e. id and email doesn't match), throw an error
	if ( ($stmt->affected_rows) != 1 ) {
	
		echo '<script src="js.js"></script>'; echo '<div class="status error">' . $lang['del-notauthorized']. '</div>';
		header("refresh:3;url=".$basedir );
		exit;
	
	} else {
	
		echo '<div class="status ok">';
		
			// Unsetting reservations
			include("conxion.php");
			$sql = "UPDATE `gifts` SET `gift_reserved` = 0, `reserved_by` = NULL WHERE `reserved_by` = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', e($_COOKIE['UID']));
			if ($stmt->execute()) { echo '<p>&#x2714; ' . $lang['del-userres'] . '</p>'; } else { echo '<p>&#x2716; ' . $lang['del-userres-err'] . '</p>'; };
			
			// Remove the user's gifts from the database
			$sql = "DELETE FROM `gifts` WHERE gift_owner = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', $_COOKIE["UID"]);
			if ($stmt->execute()) { echo '<p>&#x2714; ' . $lang['del-userwish'] . '</p>'; } else { echo '<p>&#x2716; ' . $lang['del-userwish-err'] . '</p>'; };
			
			// Remove the user from the database
			$sql = "DELETE FROM `users` WHERE id = ? AND email = ? LIMIT 1";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('is', e($_COOKIE["UID"]), e($_POST['profidelete']));
			$stmt->store_result();
			if ($stmt->execute()) { echo '<p>&#x2714; ' . $lang['del-user'] . '</p>'; } else { echo '<p>&#x2716; ' . $lang['del-user-err'] . '</p>'; };
			
			// Unsetting cookie and redirect to index page
			echo '<script src="js.js"></script>';
			echo '<p>' . $lang['del-loggingout'] . '</p>';
			header("refresh:3;url=".$basedir."?logout=true" );
		
		echo '</div>';
		
		}
		
	} else { ?>

	<h1><?php echo $lang['deleteuser']; ?></h1>
	
	<form class="padding" action="delete.php" method="POST">
		<fieldset>		
			<input id="textinput" name="profidelete" type="email" class="input-nopad" placeholder="<?php echo $lang['ph_emailadd']; ?>" autocomplete="off" required>
			<div class="input-note"><?php echo $lang['delete-note']; ?></div>
			<p><button id="singlebutton" name="submit" class="submit confirmred"><span style="text-transform: uppercase;"><?php echo $lang['deleteuser']; ?></span></button></p>
			<script>document.write('<a href="' + document.referrer + '"><?php echo $lang['cancelgoback']; ?>');</script>
		</fieldset>
	</form>

<?php } ?>