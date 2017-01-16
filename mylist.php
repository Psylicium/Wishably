<?php include("header.php"); ?>
<?php if (!$_COOKIE["UID"]) { header("Location:/" ); } ?>

<?php echo '<h1>Mine ønsker</h1>';
		
include("conxion.php");
$sql = "SELECT gift_id, gift_desc, gift_link, gift_reserved FROM gifts WHERE gift_owner = ? ORDER BY gift_id DESC";
$stmt = $db_conx->prepare($sql);
$stmt->bind_param('s', $_COOKIE["UID"]);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($gift_id, $gift_desc, $gift_link, $gift_reserved); ?>
<form action="gift.php?do=addnew" method="POST">
	<fieldset>
	
		<table>
		
			<tr class="tablehead"><td class="gift">Beskrivelse</td><td class="actions">Handlinger</td></tr>
			
			<?php while ($stmt->fetch()) { ?>
				<tr>
					<td class="gift"><?php echo $gift_desc; if ($gift_link) { echo '<div class="giftlink"><a title="Klik for at gå til link (åbner i nyt vindue)" href="' . $gift_link . '" target="_blank">'.$gift_link.'</a></div>'; } ?></td>
					<td class="actions"><?php /* if ( $gift_reserved == "1" ) { echo '<span class="disabled">Ikke muligt</span>'; } else { */ echo '<a href="gift.php?do=editgift&amp;id=' . $gift_id . '">Redigér</a><br /><a href="gift.php?do=deletegift&amp;id=' . $gift_id . '">Slet</a>'; /* } ) */ ?></td>
				</tr>
			<?php } ?>
			
			<tr>
				<td colspan="2"><button id="singlebutton" name="singlebutton" class="submit">Tilføj nyt ønske</button></td>
			</tr>

		</table>
	
	</fieldset>
</form>
<?php include("footer.php"); ?>