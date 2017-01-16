<?php include("header.php");

switch ($_GET['do']) {

	case "editgift":
		
		// Check credentials (if gift id and owner match)
		include("conxion.php");
		$sql = "SELECT * FROM `gifts` WHERE gift_id = ? AND gift_owner = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('ss', $_GET['id'], $_COOKIE["UID"]);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by);
		$stmt->fetch();
		
		// If no rows are returned (if gift id and user mismatch), throw an error
		if (($stmt->num_rows) == 0 ) {
		
			echo '<div class="status error"><h1>Sådan leger vi ikke...</h1><p>Dette er ikke dit ønske, og du kan derfor ikke redigere det.</p></div>';
		
		} else { ?>
		
			<h1>Redigér gave</h1>
			
			<form class="padding" action="gift.php?do=update" method="POST">
				<fieldset>		
					<input id="textinput" name="gift-desc" type="text" placeholder="Hvad ønsker du dig?" class="" value="<?php echo $gift_desc; ?>" required autofocus>
					<input id="textinput" name="gift-link" type="url" pattern="https?://.+" placeholder="Kan det købes online?" class="input-nopad" value="<?php echo $gift_link; ?>">
					<div class="input-note">Hvis du indtaster en webadresse, skal du huske at skrive <code>http://</code> eller <code>https://</code> i starten, f.eks. <code>http://www.butik.com/link-til-varen/</code></div>
					<input type="hidden" name ="gid" value="<?php echo $gift_id; ?>">
					<button id="singlebutton" name="submit" class="submit">Gem ændringer</button>
				</fieldset>
			</form>
			
		<?php }
		
	break;
	
	case "update":
	
		$desc = e($_POST["gift-desc"]);
		$link = e($_POST["gift-link"]);
		$gid  = e($_POST["gid"]);
		
		// Update the database
		include("conxion.php");
		$sql = "UPDATE `gifts` SET `gift_desc`=?,`gift_link`=? WHERE `gift_id`=?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('ssi', $desc, $link, e($_POST["gid"]));
		$stmt->execute();
		
		// If updating failed
		if ( ($stmt->affected_rows) == 0 ) {
			echo '<script src="js.js"></script>';
			echo '<div class="status error"><h1>Ønsket blev ikke opdateret!</h1><p>Måske er du blevet logget ud, eller også foretog du ingen ændringer... Omdirigerer dig til ønskesedlen om <span id="counter">5</span> sekunder</p></div>';
			header("refresh:5;url=mylist.php" );
		
		// If updating was successful
		} else {
			echo '<script src="js.js"></script>';
			echo '<div class="status ok"><h1>Dit ønsket er opdateret!</h1><p>Omdirigerer dig til ønskesedlen om <span id="counter">3</span> sekunder</p></div>';
			header("refresh:3;url=mylist.php" );
		}
	
	break;
	
	case "addnew":
	
		if (!isset($_POST['submit'])) { ?>
	
			<h1>Tilføj ny gave</h1>
			
			<form class="padding" action="gift.php?do=addnew" method="POST">
				<fieldset>		
					<input id="textinput" name="gift-desc" type="text" placeholder="Hvad ønsker du dig?" class="" value="<?php echo $gift_desc; ?>" required autofocus>
					<input id="textinput" name="gift-link" type="url" pattern="https?://.+" placeholder="Kan det købes online?" class="input-nopad" value="<?php echo $gift_link; ?>">
					<div class="input-note">Hvis du indtaster en webadresse, skal du huske at skrive <code>http://</code> eller <code>https://</code> i starten, f.eks. <code>http://www.butik.com/link-til-varen/</code></div>
					<button id="singlebutton" name="submit" class="submit">Gem ændringer</button>
				</fieldset>
			</form>
		
		<?php } else {
		
			$desc = e($_POST["gift-desc"]);
			$link = e($_POST["gift-link"]);
			$uid  = $_COOKIE["UID"];
		
			// Insert the record into the database
			include("conxion.php");
			$sql = "INSERT INTO `gifts` (gift_desc, gift_link, gift_owner) VALUES (?, ?, ?)";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('sss', $desc, $link, $uid);
			$stmt->execute();
		
			// If adding was successful
			if ( ($stmt->affected_rows) == 1 ) {
				echo '<script src="js.js"></script>';
				echo '<div class="status ok"><h1>Ønsket blev tilføjet!</h1><p>Omdirigerer dig til ønskesedlen om <span id="counter">3</span> sekunder</p></div>';
				header("refresh:3;url=mylist.php" );
				exit;
				
			// If adding failed
			} else echo '<script src="js.js"></script>'; echo '<div class="status error"><h1>Ønsket blev ikke tilføjet!</h1><p>Der er muligvis sket en fejl. Prøv igen senere. Omdirigerer dig til ønskesedlen om <span id="counter">3</span> sekunder</p></div>';
				header("refresh:3;url=mylist.php" );
				exit;
				
		}
			
	break;
		
	case "myreservations":
	
		echo '<h1>Ønsker jeg har reserveret</h1>';
		
		// Query reservations
		include("conxion.php");
		$sql = "SELECT * FROM `gifts` INNER JOIN users on gifts.gift_owner = users.id WHERE gift_reserved = 1 AND reserved_by = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('s', $_COOKIE["UID"]);
		$stmt->execute();
		
		$stmt->store_result();
		
		// If there are no reserved gifts
		if (($stmt->num_rows) < 1 ) {
		
			echo '<div class="alert">Du har ikke reserveret nogle ønsker.</div>';
		
		// - otherwise, display reservations
		} else {
		
			$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email); ?>
		
			<table>
				<tr class="tablehead"><td>Beskrivelse</td><td>Ønsket af</td><td>Handlinger</td></tr>
				<?php while ($stmt->fetch()) { ?><tr>
					<td class="gift"><?php echo $gift_desc; if ($gift_link) { echo '<div class="giftlink"><a title="Klik for at gå til link (åbner i nyt vindue)" href="' . $gift_link . '" target="_blank">'.$gift_link.'</a></div>'; } ?></td>
					<td><?php echo $username; ?></td>
					<td class="actions"><a href="gift.php?do=unreserve&amp;gift_id=<?php echo $gift_id; ?>">Fjern reservation</a></td>
				</tr><?php } ?>
			</table>
			
		<?php }
		
		break;
		
	case "unreserve":
	
		if (!isset($_POST['submit'])) {
		
			include("conxion.php");
			$sql = "SELECT * FROM `gifts` INNER JOIN users on gifts.gift_owner = users.id WHERE gift_id = ? AND reserved_by = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('si', $_GET['gift_id'], $_COOKIE['UID']);
			$stmt->execute();
			$stmt->store_result();
			
			// Check that the gift is reserved by this user
			if (($stmt->num_rows) == 1 ) {
				$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email);
				$stmt->fetch(); ?>
			
				<h1>Fjern reservation</h1>
				<form class="padding" action="gift.php?do=unreserve" method="POST">
					<fieldset>		
						Vil du fjerne reservationen af <b><?php echo $gift_desc; ?></b> til <?php echo $username; ?>?
						<div class="clearfix"></div>
						<button id="singlebutton" name="submit" class="submit confirmred">Fjern reservation</button>
						- eller <script>document.write('<a href="' + document.referrer + '">fortryd, og gå tilbage</a>');</script>
						<input type="hidden" name="gid" value="<?php echo $gift_id; ?>">
					</fieldset>
				</form>
				
			<?php } else {
			
				// If not, throw an error
				echo '<div class="status error"><p>Denne gave er ikke reserveret af dig...</p></div>';
			
			}
		} else { 
		
			// Update the record
			include("conxion.php");
			$sql = "UPDATE `gifts` SET `gift_reserved` = 0, `reserved_by` = NULL WHERE `gift_id` = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', e($_POST["gid"]));
			$stmt->execute();
			echo '<script src="js.js"></script>'; echo '<div class="status error"><h1>Du har fjernet reservationen!</h1><p>Omdirigerer dig til forsiden om <span id="counter">3</span> sekunder</p></div>';
			header("refresh:3;url=/" );
			
			}
	
		break;
	
		case "reserve":
	
			if (!isset($_POST['submit'])) {
	
				// Check if gift exists
				include("conxion.php");
				$sql = "SELECT * FROM `gifts` INNER JOIN users on gifts.gift_owner = users.id WHERE gift_id = ?";
				$stmt = $db_conx->prepare($sql);
				$stmt->bind_param('s', $_GET['gift_id']);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email);
				$stmt->fetch();
		
				// If gift doesn't exist
				if (($stmt->num_rows) < 1 ) {
				
					echo '<div class="status error"><h1>Drejede du forkert et sted?</h1><p>Dette ønske eksisterer ikke.</p></div>';
					
				// If you're trying to reserve your own gift
				} else if ($gift_owner == $_COOKIE["UID"]) {
				
					echo '<div class="status error"><p>Du kan ikke reservere dit eget ønske, fjollehoved...</p></div>';
					
				} else { ?>
		
					<h1>Reservér ønske</h1>
					<form class="padding" action="gift.php?do=reserve" method="POST">
						<fieldset>		
							Vil du reservere gaven <b><?php echo $gift_desc; ?></b> til <?php echo $username; ?>?
							<div class="clearfix"></div>
							<button id="singlebutton" name="submit" class="submit confirmgreen">Reservér</button>
							- eller <script>document.write('<a href="' + document.referrer + '">fortryd, og gå tilbage</a>');</script>
							<input type="hidden" name="gid" value="<?php echo $gift_id; ?>">
						</fieldset>
					</form>
			
				<?php }
		
			} else {
			
				// Check if the gift is reservable (ie. 0)
				include("conxion.php");
				$sql = "SELECT gift_reserved FROM `gifts` where gift_id = ? AND gift_reserved = 0";
				$stmt = $db_conx->prepare($sql);
				$stmt->bind_param('s', $_POST['gid']);
				$stmt->execute();
				$stmt->store_result();
		
				// If the gift is already reserved (no rows returned)
				if (($stmt->num_rows) == 0 ) {
				
					echo '<div class="status error"><h1>Ups.</h1><p>Denne gave er allerede reserveret.</p></div>';
					
				} else {
		
					// Otherwise, let's reserve
					$sql = "UPDATE `gifts` SET gift_reserved = 1, reserved_by = ? WHERE gift_id = ?";
					$stmt = $db_conx->prepare($sql);
					$stmt->bind_param('ss', $_COOKIE["UID"], $_POST['gid']);
					$stmt->execute();
					echo '<script src="js.js"></script>'; echo '<div class="status ok"><h1>Ønsket blev reserveret!</h1><p>Omdirigerer dig til forsiden om <span id="counter">3</span> sekunder</p></div>';
					header("refresh:3;url=/" );
				
				}
			}
		
		break;
		
		case "deletegift":
		
		if (!isset($_POST['submit'])) {
		
			// Query gift id, and compare it with the logged-in user's id
			include("conxion.php");
			$sql = "SELECT * FROM `gifts` WHERE gift_id = ? AND gift_owner = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('ss', $_GET['id'], $_COOKIE["UID"]);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by);
			$stmt->fetch();
			
			// Check that only the owner can delete his/her gift
			if ( ($stmt->affected_rows) == 1 ) { ?>
				
				<h1>Slet ønske</h1>
				<form class="padding" action="gift.php?do=deletegift" method="POST">
					<fieldset>		
						Vil du slette dit ønske <b><?php echo $gift_desc; ?></b>?
						<div class="clearfix"></div>
						<button id="singlebutton" name="submit" class="submit confirmred">Slet ønske</button>
						- eller <script>document.write('<a href="' + document.referrer + '">fortryd, og gå tilbage</a>');</script>
						<input type="hidden" name="gid" value="<?php echo $gift_id; ?>">
					</fieldset>
				</form>	
				
			<?php } else echo '<div class="status error"><h1>Sådan leger vi ikke...</h1><p>Dette er ikke dit ønske, og du kan derfor ikke slette det.</p></div>';
			
		 } else {
		
			// If gift id and user id match, delete the gift
			include("conxion.php");
			$sql = "DELETE FROM `gifts` WHERE gift_id = ? AND gift_owner = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('is', e($_POST["gid"]), $_COOKIE["UID"]);
			$stmt->execute();
			
			echo '<script src="js.js"></script>'; echo '<div class="status ok"><h1>Ønsket blev slettet!</h1><p>Omdirigerer dig til ønskesedlen om <span id="counter">3</span> sekunder</p></div>';
			header("refresh:3;url=mylist.php" );
			exit;
		
		}
		
		break;
	
	default: header("Location:/" );

}

include_once("footer.php"); ?>