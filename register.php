<?php include("header.php");
$errors = array();
?>

<?php if (isset($_POST['submit'])) {
	
	if ( e($_POST['password']) != e($_POST['password-repeat']) ) { $errors[] = $lang['passnotmatch']; }
	if ( e($_POST['invite']) != $invite_code ) { $errors[] = $lang['invitenotcorrect']; }
	
	// Check honeypot for spam protection. If the address field contains any data, exit the script
	if ( e($_POST['address']) ) { echo 'No way!'; exit; }
		
		// Check the database to see if the user's email exists
		
		$email = e($_POST['email']);
		include("conxion.php");
		$sql = "SELECT * FROM `users` WHERE email = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();
		
		// If email is not available
		if (($stmt->num_rows) > 0 ) { $errors[] = $lang['emailinuse']; } else {
			
			// If the $errors array is empty, go on with the registration
			if (!$errors) {
				
				$stmt->bind_result($id, $username, $password, $email, $admin, $token);

				// Sanitize POST data
				$username = e($_POST['username']);
				$email    = e($_POST['email']);
				$password = e($_POST['password']);
				
				// Hash the password
				$hashpwd = password_hash($password, PASSWORD_DEFAULT);

				// Send mail
				$to       = "$email";
				$subject  = $lang['mail-subject'];
				$body     = "<body style=\"font-family:Arial, Verdana, sans-serif; font-size:14px; color:#333;\">\n";
				$body    .= $lang['mail-body'];
				$body    .= $lang['mail-sign'];
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= "$mailfrom";

				mail($to,$subject,$body,$headers);
				
				// Add user to database
				include("conxion.php");
				$sql = "INSERT INTO `users` (username, password, email) VALUES (?, ?, ?)";
				$stmt = $db_conx->prepare($sql);
				$stmt->bind_param('sss', $username, $hashpwd, $email);
				$stmt->execute();
				
				if ( (!$stmt->affected_rows) == 1 ) {
					$stat= '<span class="red">&#x2716;</span>' . $lang['usersignup-err'];
				} else {
					$stat= '<span class="green">&#x2714;</span>' . $lang['usersignup-suc'];
				}
				
				echo '<div class="status center">';
				echo '<p>'.$stat.'</p>';
				echo $lang['redir-index'];
				echo '</div>';
				echo '<script src="js.js"></script>'; 
				header("refresh:5;url=".$basedir );
				exit;
			}
		}
	}
	 ?>
	 
	 <h1 class="center"><?php echo $lang['register']; ?></h1>
	 
	 <form class="login padding" action="register.php" method="POST">
		<?php if ($errors) {
			echo '<div class="regstatus err"><ul>';
			foreach ($errors as $error) {
				echo '<li class="err"><span style="color: #f00;">&#x2716;&nbsp;&nbsp;&nbsp;</span>'.$error.'</li>';
			} echo '</ul></div>';
		} ?>
		<input type="email" name="email" placeholder="<?php echo $lang['ph_emailadd']; ?>" class="input-nopad" required />
		<div class="input-note"><?php echo $lang['reg-emailnote']; ?></div>
		<input type="password" name="password" placeholder="<?php echo $lang['ph_password']; ?>" class="input" autocomplete="off" required />
		<input type="password" name="password-repeat" placeholder="<?php echo $lang['ph_password_rep']; ?>" class="input" autocomplete="off" required />
		<input type="text" name="username" placeholder="<?php echo $lang['ph_username']; ?>" class="input-nopad" autocomplete="off" required />
		<div class="input-note"><?php echo $lang['reg-namenote']; ?></div>
		<input type="text" name="invite" placeholder="<?php echo $lang['ph_invitecode']; ?>" class="input-nopad" autocomplete="off" required />
		<div class="input-note"><?php echo $lang['reg-invitenote']; ?></div>
		<input type="text" name="address" class="input-nopad honey" autocomplete="off" />
		<button id="singlebutton" name="submit" class="submit"><?php echo $lang['register']; ?></button>
	</form>
	 
<?php include_once("footer.php"); ?>