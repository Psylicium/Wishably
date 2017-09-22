<?php include("header.php");

if (!$_COOKIE["UID"]) {
	header("Location:".$basedir );
}

if (isset($_POST['submit'])) {

	include("conxion.php");
	require_once("func.php");
	
	// Check credentials
	$uid = e($_COOKIE["UID"]);
	$profidelete = e($_POST['profidelete']);
	$sql = "SELECT * FROM `users` WHERE id = ? AND email = ?";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('is', $uid, $profidelete);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($id, $username, $password, $email, $admin, $token);
	$stmt->fetch();
	
	// If no rows are found (i.e. id and email doesn't match), throw an error
	if ( ($stmt->affected_rows) != 1 ) {
		
		header("Location:".$basedir );
	
	} else {
		
		$status = array();
		
			// Unsetting reservations
			include("conxion.php");
			$sql = "UPDATE `gifts` SET `gift_reserved` = 0, `reserved_by` = NULL WHERE `reserved_by` = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', $uid);
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['del-userres-err'];
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['del-userres'];
			}
			
			// Remove the user's gifts from the database
			$sql = "DELETE FROM `gifts` WHERE gift_owner = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', $uid);
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['del-userwish-err'];
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['del-userwish'];
			}
			
			// Remove the user from the database
			$sql = "DELETE FROM `users` WHERE id = ? AND email = ? LIMIT 1";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('is', $uid, $profidelete);
			$stmt->store_result();
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['del-user-err'];
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['del-user'];
			}
			
			echo '<div class="status center">';
			foreach ($status as $stat) {
				echo '<p>' . $stat . '</p>';
			}
			echo $lang['redir-logoutdel'];
			echo '</div>';
			
			// Redirect to index page, logging out
			echo '<script src="js.js"></script>';
			header("refresh:5;url={$basedir}?logout" );
		
		}
		
	} else { ?>

	<h1 class="center"><?php echo $lang['deleteuser']; ?></h1>
	
	<form class="login padding" action="delete.php" method="POST">
		<fieldset>		
			<input id="textinput" name="profidelete" type="email" class="input-nopad" placeholder="<?php echo $lang['ph_emailadd']; ?>" autocomplete="off" required>
			<div class="input-note"><?php echo $lang['delete-note']; ?></div>
			<p><button id="singlebutton" name="submit" class="submit confirmred"><span style="text-transform: uppercase;"><?php echo $lang['deleteuser']; ?></span></button></p>
			<script>document.write('<a href="' + document.referrer + '"><?php echo $lang['cancelgoback']; ?>');</script>
		</fieldset>
	</form>

<?php } ?>