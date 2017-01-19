<?php if(isset($_COOKIE["UID"])) {
	unset($_COOKIE["UID"]); header("Location: index.php");
	setcookie("UID", "", time()-3600);
} else {
	echo 'Boo!';
} ?>