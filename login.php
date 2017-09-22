<?php include("header.php"); ?>

<?php

if (isset($_GET['do'])) {

	switch ($_GET['do']) {
		
		case "lostpwd":
		
			echo "<h1 class=\"center\">{$lang['forgotpwd']}</h1>";
			
			if (isset($_POST['submit'])) {
				
				if ( e($_POST['address']) ) { echo 'no way!'; exit; }
				
				include("conxion.php");
				require_once("func.php");
				
				// Check credentials
				$email = e($_POST['email']);
				$sql = "SELECT * FROM `users` WHERE `email` = ? AND `token` IS NULL";
				$stmt = $db_conx->prepare($sql);
				$stmt->bind_param('s', $email);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($id, $username, $password, $email, $admin, $token);
				if (!$stmt->fetch() || $stmt->affected_rows != 1) {
					
					$stat = '<span class="red">&#x2716;</span>' . $lang['fgp-autherr'];
					
				} else {
					
					$stat = '<span class="green">&#x2714;</span>' . $lang['fgp-authok'];
					
					// If the email is found, generate a token and add it to the database
					$token = bin2hex(random_bytes(32));
					
					// Update the database
					$sql = "UPDATE `users` SET `token`=? WHERE `email`=?";
					$stmt = $db_conx->prepare($sql);
					$stmt->bind_param('ss', $token, $email);
					$stmt->execute();
					
					// Send mail
					$to       = "$email";
					$subject  = $lang['mail-subject-lpwd'];
					$body     = "<body style=\"font-family:Arial, Verdana, sans-serif; font-size:14px; color:#333;\">\n";
					$body    .= $lang['mail-body-lpwd'];
					$body	 .= "<a href=\"{$basedir}login.php?do=resetpwd&u={$email}&t={$token}\">{$basedir}login.php?do=resetpwd&u={$email}&t={$token}</a><br /><br />";
					$body    .= $lang['mail-sign'];
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= "$mailfrom";

				mail($to,$subject,$body,$headers);
				
				};
				
				echo '<div class="status center">';
				echo '<p>' . $stat . '</p>';
				echo $lang['fgp-redir-index'];
				echo '</div>';
				
				echo '<script src="js.js"></script>';
				header("refresh:10;url={$basedir}");
				exit;
				

		break;
				
			} else { ?>
				
				<form class="login padding" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?do=lostpwd" method="POST">
				<fieldset>		
					<input id="textinput" name="email" type="email" class="input-nopad" placeholder="<?php echo $lang['ph_emailadd']; ?>" autocomplete="off" required>
					<div class="input-note"><?php echo $lang['fgp-emailnote']; ?></div>
					<input type="text" name="address" class="input-nopad honey" autocomplete="off" />
					<p><button id="singlebutton" name="submit" class="submit confirmgreen"><?php echo $lang['fgp-submit']; ?></button></p>
					<script>document.write('<a href="' + document.referrer + '"><?php echo $lang['cancelgoback']; ?></a>');</script>
				</fieldset>
			</form>
		
		<?php break; }
		
		case "resetpwd":
		$errors = array();
		
		echo "<h1 align=\"center\">{$lang['newpwd-passheader']}</h1>";
		
		// Verify that the email address and the token match up
		
		include("conxion.php");
		$user = e($_GET['u']);
		$token = e($_GET['t']);
		$sql = "SELECT * FROM `users` WHERE `email` = ? AND `token` = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('ss', $user, $token);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $username, $password, $email, $admin, $token);
		$stmt->fetch();
		
		// If they don't, throw an error
		
		if ( ($stmt->affected_rows) != 1 ) {
			echo '<div class="status center"><span class="red">&#x2716;</span>' . $lang['fgp-mismatch'] . '</p>' . $lang['fgp-redir-index'] . '</div>';
			echo '<script src="js.js"></script>';
			header("refresh:10;url=".$basedir );exit;
		} else {
		
			// Otherwise, let the user enter a new password
		
			// If the passwords doesn't match, throw an error
			if (isset($_POST['youremovedtheheadstonesbutyouleftthebodiesdidntya'])) {
				if ( e($_POST['password']) != e($_POST['password-repeat']) ) {
					$errors[] = $lang['passnotmatch'];
				} else {
					
					// The passwords match, update the database with the new password
					
					$password = e($_POST['password']);
					if (isset($_POST['user'])) { $user = e($_POST['user']); }
					$hashpwd = password_hash($password, PASSWORD_DEFAULT);
					
					include("conxion.php");
					$sql = "UPDATE `users` SET `password` = ?, `token` = NULL WHERE `email` = ?";
					$stmt = $db_conx->prepare($sql);
					$stmt->bind_param('ss', $hashpwd, $user);
					if (!$stmt->execute()) {
						$stat = '<span class="red">&#x2716;</span>' . $lang['newpwd-upderr'];
					} else {
						$stat = '<span class="green">&#x2714;</span>' . $lang['newpwd-updok'];
					}
					
					echo '<div class="status center">';
					echo '<p>' . $stat . '</p>';
					echo $lang['fgp-redir-index'];
					echo '</div>';
					
					echo '<script src="js.js"></script>';
					header("refresh:10;url=".$basedir );
					
					exit;
				}
			}
		
		?>
			
			<form class="login padding" action="login.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
			<?php if ($errors) {
				echo '<div class="regstatus err"><ul>';
				foreach ($errors as $error) {
					echo '<li class="err"><span style="color: #f00;">&#x2716;&nbsp;&nbsp;&nbsp;</span>'.$error.'</li>';
				} echo '</ul></div>';
			} ?>
			<input type="password" name="password" placeholder="<?php echo $lang['newpwd-pass']; ?>" class="input" autocomplete="off" required />
			<input type="password" name="password-repeat" placeholder="<?php echo $lang['newpwd-passconf']; ?>" class="input" autocomplete="off" required />
			<input type="text" name="address" class="honey" />
			<button id="singlebutton" name="youremovedtheheadstonesbutyouleftthebodiesdidntya" class="submit"><?php echo $lang['fgp-submit']; ?></button>
		</form>
			
		<?php }
		
		break;
		
	}
}

if (isset($_POST['submit'])) {
	
	//session_start();
	include_once("conxion.php");
	require_once("func.php");

	// Construct query
	$sql = "SELECT id, username, password, email FROM `users` WHERE email = ? LIMIT 1";

	// Prepare the query
	$stmt = $db_conx->prepare($sql);

	// Bind parameters
	$email = e($_POST['email']);
	$stmt->bind_param('s', $email);

	// Execute the query and check for errors. On succes, redirect to page, otherwise kill the script
	$stmt->execute();

	$stmt->bind_result($id, $username, $password, $email);

	if ($stmt->fetch()) {
		
		// Check if the hashed password matches the one entered
		$passcheck = password_verify($_POST['password'], $password);
		
		if ($passcheck == true) {
			// If the credentials match, log user in
			setcookie("UID", $id, time()+3600);
			header("Location: {$basedir}");
		} else {
			// If the login credentials are incorrect, output an error
			$_SESSION["Error"] = '<div class="unf">' . $lang['loginerror'] . '</div>';
			header("Location: {$basedir}");
		}
	} else {
		// If the user doesn't exist at all
		$_SESSION["Error"] = '<div class="unf">' . $lang['loginerror'] . '</div>';
		header("Location: {$basedir}");
	}
	
}

include_once("footer.php"); ?>