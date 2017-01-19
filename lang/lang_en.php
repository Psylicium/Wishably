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
	
	// ****************************** NAVIGATION BAR *****************************************************
	
		'notloggedin'		=> 'You are not logged in.',	
		'toindexpage'		=> 'To index page',
		'login'				=> 'Login',
		'register'			=> 'Register',
		'loggedinas'		=> 'Logged in as',
		'logout'			=> 'Logout',
		'mywishlist'		=> 'My wishlist',
		'myreservations'	=> 'My reservations',
		'deleteuser'		=> 'Delete user profile',
		'loginerror'		=> 'Incorrect login credentials!',
	
	// ****************************** INDEX PAGE **********************************************************
	
		'therearenowishes'	=> 'There are currently no wishes, or you are the only one who has made some.',					
		'tbl_wish'			=> 'Wish',
		'tbl_wishedby'		=> 'Wished by',
		'tbl_actions'		=> 'Actions',
		'tbl_linkalt'		=> 'Click to go to this page (opens in a new tab)',

	// ****************************** WISHLIST OPERATIONS *************************************************
	
		'tbl_description'	=> 'Description',
		'addnewwish'		=> 'Add new wish',
		'edit'				=> 'Edit',
		'delete'			=> 'Delete',
		'ph_yourwish'		=> 'Hvad do you wish for?',
		'ph_onlinebuy'		=> 'Can it be bought online?',
		'note_url'			=> 'If you are entering an URL, remember to write <code>http://</code> or <code>https://</code> at the beginning, i.e. <code>http://store.com/link-to-item/</code>',						
		'savechanges'		=> 'Save changes',
		'wishsaved'			=> 'Your wish is saved. Redirecting you to your wishlist in <span id="counter">3</span> seconds...',					
		'wishnotsaved'		=> 'Your wish cannot be saved due to an error. Try again later. Redirecting you to your wishlist in <span id="counter">3</span> seconds...',
		'deletewish'		=> 'Delete wish',
		'wanttodelete'		=> 'Do you want to delete your wish',
		'cancelgoback'		=> 'Cancel and go back',
		'wishisdeleted'		=> 'Your wish is deleted. Redirecting you to your wishlist in <span id="counter">3</span> seconds...',
		'editwish'			=> 'Edit wish',
		'wishupdated'		=> 'Your wish is updated. Redirecting you to your wishlist in <span id="counter">3</span> seconds...',
		'wishnotupdated'	=> 'Your wish is not updated. Perhaps you have been logged out, or you didn\'t make any changes. Redirecting you to your wishlist in <span id="counter">5</span> seconds...',
		'wanttoreserve'		=> 'Do you want to reserve',
		'wish'				=> 'wish',
		'reserve'			=> 'Reserve',
		'wishreserved'		=> 'This wish is now reserved for you. Redirecting you to the index page in <span id="counter">3</span> seconds...',		
		'noreservations'	=> 'You have no reserved wishes.',
		'reservewish'		=> 'Reserve wish',
		'deletereservation'	=> 'Cancel reservation',
		'wanttounreserve'	=> 'Do you want to cancel your reservation of',
		'wishunreserved'	=> 'You have cancelled your reservation of this wish. Redirecting you to the index page in <span id="counter">3</span> seconds...',
				
	// ****************************** REGISTER/DELETE PROCEDURE *******************************************
	
		'ph_username'		=> 'Your name',
		'reg-namenote'		=> 'This will be shown next to your wishes on the list, so use your real name.',
		'reg-emailnote'		=> 'A 6-digit numerical password will be sent to you, so it\'s important that you enter a valid email address. It is this email address and the corrsponding password you will be using for logging in.',
		'ph_invitecode'		=> 'Your invite code',
		'reg-invitenote'	=> 'Enter the invite code you have received from the administrator.',
		'invitenotcorrect'	=> 'The invitation code is not correct.',
		'emailinuse'		=> 'The entered email address is already in use.',
		'goback-tryagain'	=> 'Go back and try again...',
		'usersignup-suc'	=> 'You are now registered, and your password has been sent to the email address you provided. It should show up within 10 seconds, but if not, check your spam folder just in case...',
		'usersignup-err'	=> 'An error occured. Try again later, or contact the administrator.',
		'backtoindex'		=> 'Back to the index page',
		'ph_emailadd'		=> 'Your email address',
		'delete-note'		=> 'Enter your email address in the field above, and click <span style="color: #fff;">DELETE USER PROFILE</span>. This cannot be undone!',
		'del-userres'		=> 'Reservations deleted',
		'del-userwish'		=> 'Wishes deleted',
		'del-user'			=> 'User deleted',
		'del-userres-err'	=> 'Reservations NOT deleted',
		'del-userwish-err'	=> 'Wishes NOT deleted',
		'del-user-err'		=> 'User NOT deleted',
		'del-loggingout'	=> 'You will be logged out and redirected to the index page in <span id="counter">3</span> seconds...',
		'del-notauthorized'	=> 'You do not have permission to perform this action. Redirecting you to the index page in <span id="counter">3</span> seconds...',
					
	// ****************************** EMAIL CONTENT *******************************************************
	// These elements are used for the email sent to new users. The password is appended in register.php...

		'mail-subject'		=> 'Registration at Onskesedlen',
		
		'mail-body'			=> 'Hi '.x($_POST['username']).', and welcome to Onskesedlen!<br /><br />
								You are now registered and may login. It is very important that you REMEMBER your password, as it can\'t be changed or re-sent to you! To get a new password, you will have to delete your user profile (and your wishes), and sign up again.<br /><br />
								Your password is: <h2 style="color: #f00;">',
		
		'mail-sign'			=> 'Regards,<br />Onskesedlen'

);

?>