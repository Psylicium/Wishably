<?php
/*

------------------------------------------------------------------------------------------
lang_en.php - English language file for Onskesedlen
------------------------------------------------------------------------------------------

Usage: Each element of the array contains a key (shortcode)
and a value (the phrase), like this:

'<shortcode>' => '<The phrase displayed on the page>'

DO NOT EDIT THE SHORTCODE IN ANY WAY!

------------------------------------------------------------------------------------------

English translation by: Henrik Mortensen (www.psylicium.dk)

*/

// For sanitizing POST data in the email
function x($string) { return htmlentities($string, ENT_QUOTES, 'UTF-8', false); }

$lang = array(
	
	// ****************************** NAVIGATION BAR ******************************************************
	
		'notloggedin'		=> 'You are not logged in.',
		'toindexpage'		=> 'To index page',
		'login'				=> 'Login',
		'register'			=> 'Register',
		'forgotpassword'	=> 'Forgot password?',
		'loggedinas'		=> 'Logged in as',
		'logout'			=> 'Logout',
		'mywishlist'		=> 'My wishlist',
		'myreservations'	=> 'My reservations',
		'deleteuser'		=> 'Delete user profile',
		'loginerror'		=> 'Incorrect login credentials!',
		'adm-delwish'		=> 'Delete wishes',
		'adm-delall'		=> 'Delete all',
	
	// ****************************** INDEX PAGE **********************************************************
	
		'login-email'		=> 'Email address',
		'login-pwd'			=> 'Password',
		'therearenowishes'	=> 'There are currently no wishes, or you are the only one who have made some.',					
		'tbl_wish'			=> 'Wish',
		'tbl_wishedby'		=> 'Wished by',
		'tbl_actions'		=> 'Actions',
		'tbl_linkalt'		=> 'Click to go to this page (opens in a new tab)',
		// 'indexredir'		=> 'Redirecting you to the index page in <span id="counter">3</span> seconds...',
		'redir-index'		=> '<div class="redir">Redirecting you to the index page in <span id="counter">5</span> seconds... <a href="'.$server.'">or click here</a></div>',
		'redir-wishlist'	=> '<div class="redir">Redirecting you to your wishlist in <span id="counter">5</span> seconds... <a href="'.$server.'/mylist.php">or click here</a></div>',
		'redir-reservation'	=> '<div class="redir">Redirecting you to your reservations in <span id="counter">5</span> seconds... <a href="'.$server.'/gift.php?do=myreservations">or click here</a></div>',
		'redir-logoutdel'	=> '<div class="redir">You will be logged out and redirected to the index page in <span id="counter">5</span> seconds... <a href="'.$server.'/?do=logout">or click here</a></div>',

	// ****************************** WISHLIST OPERATIONS *************************************************
	
		'addnewwish'		=> 'Add new wish',
		'edit'				=> 'Edit',
		'delete'			=> 'Delete',
		'ph_yourwish'		=> 'Hvad do you wish for?',
		'ph_onlinebuy'		=> 'Can it be bought online?',
		'note_url'			=> 'If you are entering an URL, remember to write <code>http://</code> or <code>https://</code> at the beginning, i.e. <code>http://store.com/link-to-item/</code>',						
		'savechanges'		=> 'Save changes',
		'wishsaved'			=> 'Your wish is saved.',					
		'wishnotsaved'		=> 'Your wish cannot be saved.',
		'deletewish'		=> 'Delete wish',
		'wanttodelete'		=> 'Do you want to delete your wish',
		'cancelgoback'		=> '<span style="font-size: .8em;">&#10094; Cancel and go back</span>',
		'wishisdeleted'		=> 'Your wish is deleted.',
		'wishnotdeleted'	=> 'Your wish was not deleted.',
		// 'wishlistredir'		=> 'Redirecting you to your wishlist in <span id="counter">3</span> seconds...',
		'editwish'			=> 'Edit wish',
		'wishupdated'		=> 'Your wish is updated.',
		'wishnotupdated'	=> 'Your wish was not updated. Perhaps you have been logged out, or you didn\'t make any changes.',
		'wanttoreserve'		=> 'Do you want to reserve',
		'wish'				=> 'wish',
		'reserve'			=> 'Reserve',
		'wishreserved'		=> 'This wish is now reserved for you.',		
		'noreservations'	=> 'You have no reserved wishes.',
		'reservewish'		=> 'Reserve wish',
		'deletereservation'	=> 'Cancel reservation',
		'wanttounreserve'	=> 'Do you want to cancel your reservation of',
		'wishunreserved'	=> 'You have cancelled your reservation.',
		'wishnotunreserved'	=> 'Your reservation could not be cancelled.',
				
	// ****************************** REGISTER/DELETE PROCEDURE *******************************************
	
		'ph_username'		=> 'Your name',
		'reg-namenote'		=> 'This will be shown next to your wishes on the list, so please use your real name.',
		'ph_emailadd'		=> 'Your email address',
		'reg-emailnote'		=> 'This will be your login, so make sure you enter it correctly.',
		'ph_password'		=> 'Password',
		'ph_password_rep'	=> 'Confirm password',
		'ph_invitecode'		=> 'Your invite code',
		'reg-invitenote'	=> 'Enter the invite code you have received from the administrator.',
		'passnotmatch'		=> 'The passwords do not match.',
		'invitenotcorrect'	=> 'The invitation code is not correct.',
		'emailinuse'		=> 'The email address you entered is already in use. <a href="login.php?do=lostpwd">Glemt adgangskode?</a>',
		'usersignup-suc'	=> 'You are now registered, and your login details has been sent to <b>'.x($_POST['email']).'</b>.',
		'usersignup-err'	=> 'An error occured. Try again later, or contact the administrator.',
		'delete-note'		=> 'Enter your email address in the field above, and click <span style="color: #fff;">DELETE USER PROFILE</span>. This cannot be undone!',
		'del-userres'		=> 'Your reservations are deleted',
		'del-userwish'		=> 'Your wishes are deleted',
		'del-user'			=> 'Your user profile is deleted',
		'del-userres-err'	=> 'Your reservations were not deleted',
		'del-userwish-err'	=> 'Your wishes were not deleted',
		'del-user-err'		=> 'Your user profile was not deleted',
					
	// ****************************** LOST PASSWORD PROCEDURE *********************************************
	
		'forgotpwd'			=> 'Forgot your password?',
		'fgp-emailnote'		=> 'You will receive an email with instructions on how to set a new password for your account.',
		'fgp-submit'		=> 'Submit',
		'fgp-authok'		=> 'Check your email for the password reset instructions',
		'fgp-autherr'		=> 'There was an error. Either your email isn\'t recognized, or a reset is pending. You may want to contact the administrator if the problem persists.',
		'fgp-mismatch'		=> 'There was an error. You may want to contact the administrator if the problem persists.',
		'fgp-redir-index'	=> '<div class="redir">Redirecting you to the index page in <span id="counter">10</span> seconds... <a href="'.$server.'">or click here</a></div>',
		'newpwd-passheader'	=> 'Reset your password',
		'newpwd-pass'		=> 'Enter your new password',
		'newpwd-passconf'	=> 'Confirm your new password',
		'newpwd-updok'		=> 'Your password was changed.',
		'newpwd-upderr'		=> 'Your password could not be changed. Try again later, or contact the administrator if the problem persists.',
	
	// ****************************** EMAIL CONTENT *******************************************************
	// These elements are used for the email sent to new users.

		'mail-subject'		=> "Registration at ".SITENAME."",
		
		'mail-body'			=> "Hi ".x($_POST['username']).", and welcome to ".SITENAME."!<br /><br />
								Your login details are as follows:<br /><br />
								<code><h3>Email address: ".x($_POST['email'])."<br />
								Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".x($_POST['password'])."</h3></code>
		",
		
		'mail-sign'			=> 'Regards,<br />'.SITENAME.'',
		
		'mail-subject-lpwd'	=> 'Password reset at '.SITENAME.'',
		
		'mail-body-lpwd'	=> 'There has been a request to reset your password at '.SITENAME.'.<br /><br />
								Click the link below to reset your current password and set a new one. The link can only be used once, so if you forget your password again, you have to repeat the process.<br /><br />',
								
	// ****************************** ADMIN CONTENT *******************************************************
	
		'crtadm-title'		=> 'Create administrator profile',
		'crtadm-desc'		=> 'The first step is to create an administrator profile, so you have some control over the site. You will get some extra options in the navigation bar for easy deletion of wishes (to reuse the script next christmas), and to wipe the database completely for a fresh start.<br /><br />That way, you won\'t have to login to the database from time to time to perform administrative tasks (and "accidentally" get a sneak peek of what gifts you can expect :)...',
		'crtadm-passnote'	=> 'Don\'t worry, the site uses Eksblowfish hashing algorithm to encrypt passwords :)',
		'adminok'			=> 'Admin profile created. It is very important that you either delete or rename the file <code>'.$server.'/admin/createadmin.php</code> right away, to prevent others from gaining administrator rights to your site.',
		'adminerr'			=> 'Admin profile not created - check your configuration.',
		'adm-delwish-title'	=> 'Delete wishes',
		'adm-delwish-desc'	=> 'This will delete all wishes from the database, but keep the user information. Click the checkbox below and click OK to perform the action.',
		'adm-delwish-conf'	=> 'Yes, I want to delete all wishes from the database, but keep the user information.',
		'adm-delall-title'	=> 'Delete everything',
		'adm-delall-desc'	=> 'This will delete everything in the database - wish entries and user information, including the administrator profile! You must run the file <code>'.$server.'/admin/createadmin.php</code> again to create a new administrator profile. Once you click OK, everything will be deleted, and you will be logged out. Click the checkbox below and click OK to perform the action.',
		'adm-delall-conf'	=> 'Yes, I want to clear all tables in the database, including the administrator profile.',
		'adm-del-submit'	=> 'OK',
		'adm-delgift-ok'	=> 'Tabellen `gifts` is cleared',
		'adm-delgift-err'	=> 'The table `gifts` was not cleared: ',
		'adm-deluser-ok'	=> 'The table `users` is cleared',
		'adm-deluser-err'	=> 'The table `users` was not cleared: '
		
);

?>