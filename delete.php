<?php include("header.php");

if (!$_COOKIE["UID"]) {
	header("Location:/" );
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
	
		echo '<script src="js.js"></script>'; echo '<div class="status error"><h1>Sådan leger vi ikke...</h1><p>Du har ikke rettigheder til denne handling. Omdirigerer dig til forsiden om <span id="counter">5</span> sekunder</p></div>';
		header("refresh:5;url=/" );
		exit;
	
	} else {
	
		echo '<div class="status ok">';
		
			// Unsetting reservations
			include("conxion.php");
			$sql = "UPDATE `gifts` SET `gift_reserved` = 0, `reserved_by` = NULL WHERE `reserved_by` = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', e($_COOKIE['UID']));
			if ($stmt->execute()) { echo '<p>&#x2714; Reservationer fjernet</p>'; } else { echo '<p>&#x2716; Reservationer IKKE fjernet!</p>'; };
			
			// Remove the user's gifts from the database
			$sql = "DELETE FROM `gifts` WHERE gift_owner = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', $_COOKIE["UID"]);
			if ($stmt->execute()) { echo '<p>&#x2714; Gaver slettet</p>'; } else { echo '<p>&#x2716; Gaver IKKE slettet!</p>'; };
			
			// Remove the user from the database
			$sql = "DELETE FROM `users` WHERE id = ? AND email = ? LIMIT 1";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('is', e($_COOKIE["UID"]), e($_POST['profidelete']));
			$stmt->store_result();
			if ($stmt->execute()) { echo '<p>&#x2714; Bruger slettet</p>'; } else { echo '<p>&#x2716; Bruger IKKE slettet!</p>'; };
			
			// Unsetting cookie and redirect to index page
			echo '<script src="js.js"></script>';
			echo '<p>Du vil blive logget ud og omdirigeret til forsiden om <span id="counter">3</span> sekunder...';
			header("refresh:3;url=/?logout=true" );
		
		echo '</div>';
		
		}
		
	} else { ?>

	<form class="padding" action="delete.php" method="POST">
		<fieldset>		
			<input id="textinput" name="profidelete" type="email" class="input-nopad" placeholder="Email-adresse" autocomplete="off" required>
			<div class="input-note">Indtast din email-adresse i feltet herover, og tryk <span style="color: #fff">SLET PROFIL</span>. Dette kan IKKE fortrydes!</div>
			<p><button id="singlebutton" name="submit" class="submit confirmred">SLET PROFIL</button></p>
			- eller <script>document.write('<a href="' + document.referrer + '">fortryd, og gå tilbage</a>');</script>
		</fieldset>
	</form>

<?php } ?>