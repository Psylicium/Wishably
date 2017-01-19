<?php include("header.php");

// Show text below gift list?
$display_text = 0; // 0 = disable | 1 = enable

// If text field is enabled, show this text
$page_text    = 'This is displayed in the text field below the wishlist';

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
		echo '<div class="alert">' . $lang['therearenowishes'] . '</div>';
	} else {
		echo '<table>';
		echo '<tr class="tablehead"><td>' . $lang['tbl_wish'] . '</td><td>' . $lang['tbl_wishedby'] . '</td><td>' . $lang['tbl_actions'] . '</td></tr>';
		while ($stmt->fetch()) {
		   echo '<tr><td class="gift">' . $gift_desc; if ($gift_link) { echo '<div class="giftlink"><a title="' . $lang['tbl_linkalt'] . '" href="' . $gift_link . '" target="_blank">'.$gift_link.'</a></div>'; } echo '</td><td class="author">' . $username . '</td><td class="actions"><a href="gift.php?do=reserve&amp;gift_id=' . $gift_id . '">' . $lang['reservewish'] . '</a></td></tr>';
		}
		echo '</table>';
	}
		
	if ( $display_text == 1 ) { echo '<div class="pagetext">' . $page_text . '</div>'; }
		
} else { // If user is not logged in, show login area ?>

	<form class="login padding" action="login.php" method="POST">
		<input type="email" name="email" placeholder="Email-adresse" required autofocus />
		<input type="password" name="password" placeholder="Adgangskode" required />
		<?php if (isset($_SESSION["Error"])) { echo $_SESSION["Error"]; unset($_SESSION["Error"]); } ?>
		<button id="singlebutton" name="submit" class="submit"><?php echo $lang['login']; ?></button>
		<div class="register"><a href="register.php"><?php echo $lang['register']; ?></a></div>
	</form>

<?php } ?>

<?php include_once("footer.php"); ?>