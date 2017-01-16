<?php include("header.php");

// Tekstfelt under gaveønskerne (0: Skjul tekstfelt | 1: Vis tekstfelt)
$display_text = 1;

// Tekst der skal vises, hvis ovenstående er 1
$page_text    = 'Dette er teksten der vises i feltet under ønskelisten.';

if (isset($_COOKIE["UID"])) {

	// If user is logged in, then render wishlist
	include("conxion.php");
	$guid = $_COOKIE["UID"];
	$sql = "SELECT * FROM gifts INNER JOIN users on gifts.gift_owner = users.id WHERE gift_reserved = 0 AND NOT users.id = ? ORDER BY users.username ASC, gifts.gift_desc ASC";
	$stmt = $db_conx->prepare($sql);
	$stmt->bind_param('s', $guid);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email);

	if (($stmt->num_rows) < 1 ) {
		echo '<div class="alert">Der er ingen ønsker i øjeblikket, eller også er du den eneste der har afgivet.</div>';
	} else {
		echo '<table>';
		echo '<tr class="tablehead"><td>Ønske</td><td>Ønsket af</td><td>Handlinger</td></tr>';
		while ($stmt->fetch()) {
		   echo '<tr><td class="gift">' . $gift_desc; if ($gift_link) { echo '<div class="giftlink"><a title="Klik for at gå til link (åbner i nyt vindue)" href="' . $gift_link . '" target="_blank">'.$gift_link.'</a></div>'; } echo '</td><td class="author">' . $username . '</td><td class="actions"><a href="gift.php?do=reserve&amp;gift_id=' . $gift_id . '">Reservér gave</a></td></tr>';
		}
		echo '</table>';
	}
		
	if ( $display_text == 1 ) { echo '<div class="pagetext">' . $page_text . '</div>'; }
		
} else { ?>

	<form class="login padding" action="login.php" method="POST">
		<input type="email" name="email" placeholder="Email-adresse" required autofocus />
		<input type="password" name="password" placeholder="Adgangskode" required />
		<?php if (isset($_SESSION["Error"])) { echo $_SESSION["Error"]; unset($_SESSION["Error"]); } ?>
		<button id="singlebutton" name="submit" class="submit">Log ind</button>
		<div class="register"><a href="register.php">Tilmelding</a></div>
	</form>

<?php } ?>

<?php include_once("footer.php"); ?>