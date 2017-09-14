<?php include("header-admin.php"); ?>

<?php if (!isset($_POST['submit'])) { ?>

	<h1 class="center"><?php echo $lang['crtadm-title']; ?></h1>
	<p><?php echo $lang['crtadm-desc']; ?></p>

	<form class="login padding" action="createadmin.php" method="POST">
		<input type="text" name="username" placeholder="<?php echo $lang['ph_username']; ?>" class="input-nopad" autocomplete="off" required />
		<div class="input-note"><?php echo $lang['reg-namenote']; ?></div>
		<input type="email" name="email" placeholder="<?php echo $lang['ph_emailadd']; ?>" class="input-nopad" required />
		<div class="input-note"><?php echo $lang['reg-emailnote']; ?></div>
		<input type="text" name="password" placeholder="<?php echo $lang['ph_password']; ?>" class="input-nopad" autocomplete="off" required />
		<div class="input-note"><?php echo $lang['crtadm-passnote']; ?></div>
		<input type="text" name="address" class="honey" />
		<button id="singlebutton" name="submit" class="submit"><?php echo $lang['register']; ?></button>
	</form>

<?php } else {
	
	// Check honeypot for spam protection. If the address field contains any data, exit the script
	$honeypot = $_POST['address'];

	if ($honeypot) {
		exit("No way!");
	}
	
	// All is good, let's add the user to the database and send a password
		
	// Sanitize POST data
	$username = e($_POST['username']);
	$email    = e($_POST['email']);
	
	// Hash the password and add regular user
	$hashpwd = password_hash(e($_POST['password']), PASSWORD_DEFAULT);
	$admin   = 1;
	
	// Add user to database
	include("../conxion.php");
	$sql = "INSERT INTO `users` (username, password, email, admin, token) VALUES (?, ?, ?, ?, ?)";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('sssis', $username, $hashpwd, $email, $admin, $token);
	if (!$stmt->execute()) {
		$stat = '<span class="red">&#x2716;</span>' . $lang['adminerr'] . mysqli_error($db_conx);
	} else {
		$stat  = '<span class="green">&#x2714;</span>' . $lang['adminok'];
	}
	
	echo '<div class="status center">';
	echo '<p>' . $stat . '</p>';
	echo '</div>';
	
} ?>
	 
<?php include_once("../footer.php"); ?>