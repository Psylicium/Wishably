<?php include("header.php");

switch ($_GET['do']) {

case "delete":
		
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
			
			// Check that only the owner can delete his/her gift, otherwise redirect to index page
			if ( ($stmt->affected_rows) == 1 ) { ?>
				
				<h1 class="center"><?php echo $lang['deletewish']; ?></h1>
				<form class="login padding" action="gift.php?do=delete" method="POST">
					<fieldset>		
						<?php echo $lang['wanttodelete']; ?> <b><?php echo $gift_desc; ?></b>?
						<div class="clearfix"></div>
						<button id="singlebutton" name="submit" class="submit confirmred"><?php echo $lang['deletewish']; ?></button>
						<script>document.write('<a href="' + document.referrer + '"><?php echo $lang['cancelgoback']; ?></a>');</script>
						<input type="hidden" name="gid" value="<?php echo $gift_id; ?>">
					</fieldset>
				</form>	
				
			<?php } else header("Location:".$basedir );
			
		 } else {
		
			// If gift id and user id match, delete the gift
			$gid = e($_POST["gid"]);
			$uid = e($_COOKIE["UID"]);
			$status = array();
			include("conxion.php");
			$sql = "DELETE FROM `gifts` WHERE gift_id = ? AND gift_owner = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('is', $gid, $uid);
			
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['wishnotdeleted'];
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['wishisdeleted'];
			}
			
			echo '<div class="status center">';
			foreach ($status as $stat) {
				echo '<p>' . $stat . '</p>';
				echo $lang['redir-wishlist'];
			}
			echo '</div>';
			
			echo '<script src="js.js"></script>';
			header("refresh:5;url=mylist.php" );
			exit;
		
		}
		
		break;

	case "edit":
		
		// Check credentials (if gift id and owner match)
		include("conxion.php");
		$sql = "SELECT * FROM `gifts` WHERE gift_id = ? AND gift_owner = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('ss', $_GET['id'], $_COOKIE["UID"]);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by);
		$stmt->fetch();
		
		// If no rows are returned (if gift id and user mismatch), redirect to index page
		if (($stmt->num_rows) == 0 ) {
		
			header("Location:".$basedir );
		
		} else { ?>
		
			<h1><?php echo $lang['editwish']; ?></h1>
			
			<form class="padding" action="gift.php?do=update" method="POST">
				<fieldset>		
					<input id="textinput" name="gift-desc" type="text" placeholder="<?php echo $lang['ph_yourwish']; ?>" class="" value="<?php echo $gift_desc; ?>" required autofocus>
					<input id="textinput" name="gift-link" type="url" pattern="https?://.+" placeholder="<?php echo $lang['ph_onlinebuy']; ?>" class="input-nopad" value="<?php echo $gift_link; ?>">
					<div class="input-note"><?php echo $lang['note_url']; ?></div>
					<input type="hidden" name ="gid" value="<?php echo $gift_id; ?>">
					<button id="singlebutton" name="submit" class="submit"><?php echo $lang['savechanges']; ?></button>
				</fieldset>
			</form>
			
		<?php }
		
	break;
	
	case "update":
	
		$desc = e($_POST["gift-desc"]);
		$link = e($_POST["gift-link"]);
		$gid  = e($_POST["gid"]);
		
		// Update the database
		$status = array();
		include("conxion.php");
		$sql = "UPDATE `gifts` SET `gift_desc`=?,`gift_link`=? WHERE `gift_id`=?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('ssi', $desc, $link, $gid);
		$stmt->execute();
		
		// If updating failed
		if ( ($stmt->affected_rows) == 0 ) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['wishnotupdated'];
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['wishupdated'];
			}
			
			echo '<div class="status center">';
			foreach ($status as $stat) {
				echo '<p>' . $stat . '</p>';
			}
			echo $lang['redir-wishlist'];
			echo '</div>';
			
			echo '<script src="js.js"></script>';
			header("refresh:5;url=mylist.php" );
			exit;
	
	break;
	
	case "addnew":
	
		if (!isset($_POST['submit'])) { ?>
	
			<h1><?php echo $lang['addnewwish']; ?></h1>
			
			<form class="padding" action="gift.php?do=addnew" method="POST">
				<fieldset>		
					<input id="textinput" name="gift-desc" type="text" placeholder="<?php echo $lang['ph_yourwish']; ?>" class="" required autofocus>
					<input id="textinput" name="gift-link" type="url" pattern="https?://.+" placeholder="<?php echo $lang['ph_onlinebuy']; ?>" class="input-nopad">
					<div class="input-note"><?php echo $lang['note_url']; ?></div>
					<button id="singlebutton" name="submit" class="submit"><?php echo $lang['savechanges']; ?></button>
				</fieldset>
			</form>
		
		<?php } else {
		
			$status = array();
			$desc = e($_POST["gift-desc"]);
			$link = e($_POST["gift-link"]);
			$uid  = $_COOKIE["UID"];
		
			// Insert the record into the database
			include("conxion.php");
			$sql = "INSERT INTO `gifts` (gift_desc, gift_link, gift_owner) VALUES (?, ?, ?)";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('sss', $desc, $link, $uid);
			
			if (!$stmt->execute()) {
				$status[] = '<span class="red">&#x2716;</span>' . $lang['wishnotsaved'];
			} else {
				$status[] = '<span class="green">&#x2714;</span>' . $lang['wishsaved'];
			}
			
			echo '<div class="status center">';
			foreach ($status as $stat) {
				echo '<p>' . $stat . '</p>';
			}
			echo $lang['redir-wishlist'];
			echo '</div>';
			
			echo '<script src="js.js"></script>';
			header("refresh:5;url=mylist.php" );
			exit;
				
		}
			
	break;
		
	case "myreservations":
	
		echo '<h1>' . $lang['myreservations'] . '</h1>';
		
		// Query reservations
		include("conxion.php");
		$sql = "SELECT * FROM `gifts` INNER JOIN users on gifts.gift_owner = users.id WHERE gift_reserved = 1 AND reserved_by = ?";
		$stmt = $db_conx->prepare($sql);
		$stmt->bind_param('s', $_COOKIE["UID"]);
		$stmt->execute();
		
		$stmt->store_result();
		
		// If there are no reserved gifts
		if (($stmt->num_rows) < 1 ) {
		
			echo '<div class="alert">' . $lang['noreservations'] . '</div>';
		
		// - otherwise, display reservations
		} else {
		
			$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email, $admin, $token); ?>
		
			<table>
				<tr class="tablehead"><td><?php echo $lang['tbl_wish']; ?></td><td><?php echo $lang['tbl_wishedby']; ?></td><td><?php echo $lang['tbl_actions']; ?></td></tr>
				<?php while ($stmt->fetch()) { ?><tr>
					<td class="gift"><?php echo $gift_desc; if ($gift_link) { echo '<div class="giftlink"><a title="' . $lang['tbl_linkalt'] . '" href="' . $gift_link . '" target="_blank">'.$gift_link.'</a></div>'; } ?></td>
					<td class="author"><?php echo $username; ?></td>
					<td class="actions"><a class="unreserve" href="gift.php?do=unreserve&amp;gift_id=<?php echo $gift_id; ?>"><?php echo $lang['deletereservation']; ?></a></td>
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
				$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email, $admin, $token);
				$stmt->fetch(); ?>
			
				<h1 class="center"><?php echo $lang['deletereservation']; ?></h1>
				<form class="login padding" action="gift.php?do=unreserve" method="POST">
					<fieldset>		
						<?php echo $lang['wanttounreserve']; ?> <?php echo $username; ?>'s <?php echo $lang['wish']; ?> <b><?php echo $gift_desc; ?></b>?
						<div class="clearfix"></div>
						<button id="singlebutton" name="submit" class="submit confirmred"><?php echo $lang['deletereservation']; ?></button>
						<script>document.write('<a href="' + document.referrer + '"><?php echo $lang['cancelgoback']; ?></a>');</script>
						<input type="hidden" name="gid" value="<?php echo $gift_id; ?>">
					</fieldset>
				</form>
				
			<?php } else {
			
				// If the gift is not reserved by the logged-in user, redirect to index page
				header("Location:".$basedir );
			
			}
		} else { 
		
			// Update the record
			include("conxion.php");
			$gid = e($_POST["gid"]);
			$sql = "UPDATE `gifts` SET `gift_reserved` = 0, `reserved_by` = NULL WHERE `gift_id` = ?";
			$stmt = $db_conx->prepare($sql);
			$stmt->bind_param('i', $gid);
			
			if (!$stmt->execute()) {
				$stat = '<span class="red">&#x2716;</span>' . $lang['wishnotunreserved'];
			} else {
				$stat = '<span class="green">&#x2714;</span>' . $lang['wishunreserved'];
			};
					
			echo '<div class="status center">';
			echo '<p>' . $stat . '</p>';
			echo $lang['redir-reservation'];
			echo '</div>';
			echo '<script src="js.js"></script>'; 
			header("refresh:5;url=gift.php?do=myreservations" );
			
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
				$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_owner, $gift_reserved, $reserved_by, $id, $username, $password, $email, $admin, $token);
				$stmt->fetch();
		
				// If gift doesn't exist OR user is trying to reserve a gift that's already reserved OR reserve his/her own gift, redirect to index page
				if ( $gift_owner == $_COOKIE["UID"] || $gift_reserved == 1 || $stmt->num_rows < 1 ) {
				
					header("Location:".$basedir );
					
			}  else { ?>
		
					<h1 class="center"><?php echo $lang['reservewish']; ?></h1>
					<form class="login padding" action="gift.php?do=reserve" method="POST">
						<fieldset>		
							<?php echo $lang['wanttoreserve']; ?> <?php echo $username; ?>'s <?php echo $lang['wish']; ?> <b><?php echo $gift_desc; ?></b>?
							<div class="clearfix"></div>
							<button id="singlebutton" name="submit" class="submit confirmgreen"><?php echo $lang['reserve']; ?></button>
							<script>document.write('<a href="' + document.referrer + '"><?php echo $lang['cancelgoback']; ?></a>');</script>
							<input type="hidden" name="gid" value="<?php echo $gift_id; ?>">
						</fieldset>
					</form>
			
				<?php }
		
			} else {
		
					// Otherwise, let's reserve
					$sql = "UPDATE `gifts` SET gift_reserved = 1, reserved_by = ? WHERE gift_id = ?";
					$stmt = $db_conx->prepare($sql);
					$stmt->bind_param('ss', $_COOKIE["UID"], $_POST['gid']);
					if (!$stmt->execute()) {
						$stat = '<span class="red">&#x2716;</span>' . $lang['wishnotreserved'];
					} else {
						$stat = '<span class="green">&#x2714;</span>' . $lang['wishreserved'];
					};
					
					echo '<div class="status center">';
					echo '<p>' . $stat . '</p>';
					echo $lang['redir-index'];
					echo '</div>';
					echo '<script src="js.js"></script>'; 
					header("refresh:5;url=".$basedir );
			}

		break;

	// Direct access redirects to index page
	default: header("Location:".$basedir );

}

include_once("footer.php"); ?>