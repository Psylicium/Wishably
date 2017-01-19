<?php include("header.php");
$invite_code = "<INVITATION_CODE>";
$mailfrom    = "From: Sender Name <sender@mail.address>";
?>

<?php if (!isset($_POST['submit'])) { ?>

<form class="login padding" action="register.php" method="POST">
	<input type="text" name="username" placeholder="<?php echo $lang['ph_username']; ?>" class="input-nopad" autocomplete="off" required />
	<div class="input-note"><?php echo $lang['reg-namenote']; ?></div>
	<input type="email" name="email" placeholder="<?php echo $lang['ph_emailadd']; ?>" class="input-nopad" required />
	<div class="input-note"><?php echo $lang['reg-emailnote']; ?></div>
	<input type="text" name="invite" placeholder="<?php echo $lang['ph_invitecode']; ?>" class="input-nopad" autocomplete="off" required />
	<div class="input-note"><?php echo $lang['reg-invitenote']; ?></div>
	<input type="text" name="address" class="honey" />
	<button id="singlebutton" name="submit" class="submit"><?php echo $lang['register']; ?></button>
</form>

<?php } else {

	// Check if invitation code is correct
	$invite = e($_POST['invite']);
	
	if ( $invite != $invite_code ) { ?>
	
		<div class="status error"><p><?php echo $lang['invitenotcorrect']; ?></p><p><script>document.write('<a href="' + document.referrer + '">&#10094; <?php echo $lang['goback-tryagain']; ?></a>');</script></p></div>
	
	<?php } else {
	
	// Check honeypot for spam protection. If the address field contains any data, exit the script
	$honeypot = $_POST['address'];

		if ($honeypot) {
			exit("G&aring; v&aelig;k!");
		}
		
		// Check the database to see if the user's email exists
		
		include("conxion.php");
		$sql = "SELECT * FROM `users` WHERE email = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('s', e($_POST['email']));
		$stmt->execute();
		$stmt->store_result();
		
		// If email is not available
		if (($stmt->num_rows) > 0 ) { ?>
		
			<div class="status error"><p><?php echo $lang['emailinuse']; ?></p><p><script>document.write('<a href="' + document.referrer + '">&#10094; <?php echo $lang['goback-tryagain']; ?></a>');</script></p></div>
		
		<?php } else {

			// All is good, let's add the user to the database and send a password
			
			$stmt->bind_result($id, $username, $password, $email);

			// Sanitize POST data
			$username = e($_POST['username']);
			$email    = e($_POST['email']);
			
			// Generate a random password
			$password = generateRandomString();

			// Send mail
			$to       = "$email";
			$subject  = $lang['mail-subject'];
			$body     = $lang['mail-body'];
			$body	 .= "$password</h2>";
			$body    .= $lang['mail-sign'];
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "$mailfrom";

			mail($to,$subject,$body,$headers);
			
			// Add user to database
			include("conxion.php");
			$sql = "INSERT INTO `users` (username, password, email) VALUES (?, ?, ?)";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('sss', $username, $password, $email);
			$stmt->execute();
			
			if ( ($stmt->affected_rows) == 1 ) {
				echo '<div class="status ok"><p>' . $lang['usersignup-suc']. '</p><p><a href="'.$basedir.'">&#10094; ' . $lang['backtoindex'] . '</a></p></div>';
			} else echo '<div class="status error"><p>' . $lang['usersignup-err']. '</p></div>';
			
			}
		}
		}
	 ?>
	 
<?php include_once("footer.php"); ?>