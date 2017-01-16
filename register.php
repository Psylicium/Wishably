<?php include("header.php");
$invite_code = "<INVITATIONSKODE>";
$mailfrom    = "From: Afsendernavn <afsenders@emailadresse.dk>";
?>

<?php if (!isset($_POST['submit'])) { ?>

<form class="login padding" action="register.php" method="POST">
	<input type="text" name="username" placeholder="Brugernavn" class="input-nopad" autocomplete="off" required />
	<div class="input-note">Dette vil være dit navn på ønskelisten, så brug dit rigtige navn.</div>
	<input type="email" name="email" placeholder="Email-adresse" class="input-nopad" required />
	<div class="input-note">En 6-cifret numerisk adgangskode vil blive sendt til dig, så det er vigtigt at du angiver en korrekt email-adresse. Det er denne email-adresse og den tilhørende adgangskode du skal logge på med.</div>
	<input type="text" name="invite" placeholder="Invitationskode" class="input-nopad" required />
	<div class="input-note">Indtast invitationskoden du har fået fra administratoren.</div>
	<input type="text" name="address" class="honey" />
	<button id="singlebutton" name="submit" class="submit">Tilmeld</button>
</form>

<?php } else {

	// Check if invitation code is correct
	$invite = e($_POST['invite']);
	
	if ( $invite != $invite_code ) { ?>
	
		<div class="status error"><p>Invitationskoden er ikke korrekt.</p><p><script>document.write('<a href="' + document.referrer + '">&#10094; Gå tilbage og prøv igen...</a>');</script></p></div>
	
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
		
			<div class="status error"><p>Den angivne email-adresse er allerede i brug.</p><p><script>document.write('<a href="' + document.referrer + '">&#10094; Gå tilbage og prøv igen...</a>');</script></p></div>
		
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
			$subject  = "Oprettelse på Ønskesedlen";
			$body     = "Hej $username!<br /><br />
			Du kan nu logge ind med din emailadresse (<b>$email</b>) samt din adgangskode som er:<br /><br />
			<span style=\"font-size: 1.5em;\"><code><b>$password</b></code></span><br /><br />
			<span style=\"color: #f00;\"><b>Det er vigtigt at du HUSKER og GEMMER denne adgangskode, da den hverken kan sendes til dig igen eller ændres!</b></span><br /><br />
			For at få en ny adgangskode, er du nødt til at slette din brugerprofil (og dermed dine ønsker), og derefter oprette dig igen.";
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
				echo '<div class="status ok"><p>Du er nu oprettet, og din adgangskode er blevet sendt til den email-adresse du angav. Den burde lande inden for de næste 10 sekunder, men hvis ikke, så tjek spammappen for en sikkerheds skyld...</p><p><a href="/">&#10094; Tilbage til forsiden</a></p></div>';
			} else echo "Der er sket en fejl. Prøv igen senere (not added to DB)";
			
			}
		}
		}
	 ?>
	 
<?php include_once("footer.php"); ?>