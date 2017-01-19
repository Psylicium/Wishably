<?php
/*

-------------------------------------------------------------------------------------
lang_da.php - Danish language file for Onskesedlen
-------------------------------------------------------------------------------------

Usage: Each element of the array contains a key (shortcode)
and a value (the phrase), like this:

'<shortcode>' => '<The phrase displayed on the page>'

DO NOT EDIT THE SHORTCODE IN ANY WAY!

------------------------------------------------------------------------------------------

Danish translation by: Henrik Mortensen (www.psylicium.dk)

*/

// For sanitizing POST data in the email
function x($string) { return htmlentities($string, ENT_QUOTES, 'UTF-8', false); }

$lang = array(
	
	// ****************************** NAVIGATION BAR *****************************************************
	
		'notloggedin'		=> 'Du er ikke logget ind.',	
		'toindexpage'		=> 'Til forsiden',
		'login'				=> 'Log ind',
		'register'			=> 'Tilmelding',
		'loggedinas'		=> 'Logget ind som',
		'logout'			=> 'Log ud',
		'mywishlist'		=> 'Min &oslash;nskeseddel',
		'myreservations'	=> 'Mine reservationer',
		'deleteuser'		=> 'Slet brugerprofil',
		'loginerror'		=> 'Forkerte loginoplysninger!',
	
	// ****************************** INDEX PAGE **********************************************************
	
		'therearenowishes'	=> 'Der er ingen &oslash;nsker i &oslash;jeblikket, eller ogs&aring; er du den eneste der har afgivet.',
		'tbl_wish'			=> '&Oslash;nske',
		'tbl_wishedby'		=> '&Oslash;nsket af',
		'tbl_actions'		=> 'Handlinger',
		'tbl_linkalt'		=> 'Klik for at g&aring; til denne side (&aring;bner i ny fane)',

	// ****************************** WISHLIST OPERATIONS *************************************************
	
		'tbl_description'	=> 'Beskrivelse',
		'addnewwish'		=> 'Tilf&oslash;j nyt &oslash;nske',
		'edit'				=> 'Redig&eacute;r',
		'delete'			=> 'Slet',
		'ph_yourwish'		=> 'Hvad &oslash;nsker du dig?',
		'ph_onlinebuy'		=> 'Kan det k&oslash;bes online?',
		'note_url'			=> 'Hvis du indtaster en URL, skal du huske at skrive <code>http://</code> eller <code>https://</code> i starten, f.eks. <code>http://butik.dk/link-til-vare/</code>',						
		'savechanges'		=> 'Gem &aelig;ndringer',
		'wishsaved'			=> 'Dit &oslash;nske er gemt. Omdirigerer dig til din &oslash;nskeseddel om <span id="counter">3</span> sekunder...',					
		'wishnotsaved'		=> 'Dit &oslash;nske kan ikke gemmes p&aring; grund af en fejl. Pr&oslash;v igen senere. Omdirigerer dig til din &oslash;nskeseddel om <span id="counter">3</span> sekunder...',
		'deletewish'		=> 'Slet &oslash;nske',
		'wanttodelete'		=> 'Vil du slette dit &oslash;nske',
		'cancelgoback'		=> 'Fortryd og g&aring; tilbage',
		'wishisdeleted'		=> 'Dit &oslash;nske er slettet. Omdirigerer dig til din &oslash;nskeseddel om <span id="counter">3</span> sekunder...',
		'editwish'			=> 'Redig&eacute;r &oslash;nske',
		'wishupdated'		=> 'Dit &oslash;nske er opdateret. Omdirigerer dig til din &oslash;nskeseddel om <span id="counter">3</span> sekunder...',
		'wishnotupdated'	=> 'Dit &oslash;nske blev ikke opdateret. M&aring;ske er du blevet logget ud, eller ogs&aring; foretog du ingen &aelig;ndringer. Omdirigerer dig til din &oslash;nskeseddel om <span id="counter">5</span> sekunder...',
		'wanttoreserve'		=> 'Vil du reservere',
		'wish'				=> '&oslash;nske',
		'reserve'			=> 'Reserv&eacute;r',
		'wishreserved'		=> 'Dette &oslash;nske er nu reserveret til dig. Omdirigerer dig til forsiden om <span id="counter">3</span> sekunder...',		
		'noreservations'	=> 'Du har ingen reserverede &oslash;nsker.',
		'reservewish'		=> 'Reserv&eacute;r &oslash;nske',
		'deletereservation'	=> 'Fjern reservation',
		'wanttounreserve'	=> 'Vil du fjerne reservationen af',
		'wishunreserved'	=> 'Du har fjernet reservationen af dette &oslash;nske. Omdirigerer dig til forsiden om <span id="counter">3</span> sekunder...',
				
	// ****************************** REGISTER/DELETE PROCEDURE *******************************************
	
		'ph_username'		=> 'Dit navn',
		'reg-namenote'		=> 'Dette vil vises ved siden af dine &oslash;nsker p&aring; listen, s&aring; brug dit rigtige navn.',
		'reg-emailnote'		=> 'En 6-cifret numerisk adgangskode vil blive sendt til dig, s&aring; det er vigtigt du angiver en gyldig email-adresse. Det er denne email-adresse og den tilh&oslash;rende adgangskode du skal logge p&aring; med.',
		'ph_invitecode'		=> 'Din invitationskode',
		'reg-invitenote'	=> 'Indtast invitationskoden du har modtaget fra administratoren.',
		'invitenotcorrect'	=> 'Invitationskoden er ikke korrekt.',
		'emailinuse'		=> 'Den angivne email-adresse er allerede i brug.',
		'goback-tryagain'	=> 'G&aring; tilbage og pr&oslash;v igen...',
		'usersignup-suc'	=> 'Du er nu registreret, og din adgangskode er blevet sendt til den email-adresse du angav. Den b&oslash;r dukke op indenfor 10 sekunder, men hvis ikke, s&aring; check din spammappe for en sikkerheds skyld...',
		'usersignup-err'	=> 'Der er opst&aring;et en fejl. Pr&oslash;v igen senere, eller kontakt administratoren.',
		'backtoindex'		=> 'Tilbage til forsiden',
		'ph_emailadd'		=> 'Din email-adresse',
		'delete-note'		=> 'Indtast din email-adresse i feltet ovenfor, og tryk <span style="color: #fff;">SLET BRUGERPROFIL</span>. Dette kan ikke fortrydes!',
		'del-userres'		=> 'Reservationer slettet',
		'del-userwish'		=> '&Oslash;nsker slettet',
		'del-user'			=> 'Bruger slettet',
		'del-userres-err'	=> 'Reservationer IKKE slettet',
		'del-userwish-err'	=> '&Oslash;nsker IKKE slettet',
		'del-user-err'		=> 'Bruger IKKE slettet',
		'del-loggingout'	=> 'Du vil blive logget ud og omdirigeret til forsiden om <span id="counter">3</span> sekunder...',
		'del-notauthorized'	=> 'Du har ikke lov til at udf&oslash;re denne handling. Omdirigerer dig til forsiden om <span id="counter">3</span> sekunder...',
					
	// ****************************** EMAIL CONTENT *******************************************************
	// These elements are used for the email sent to new users. The password is appended in register.php...

		'mail-subject'		=> 'Registrering på Ønskesedlen',
		
		'mail-body'			=> 'Hej '.x($_POST['username']).', og velkommen til &Oslash;nskesedlen!<br /><br />
								Du er nu registreret, og kan logge ind. Det er meget vigtigt, at du HUSKER din adgangskode, da den ikke kan &aelig;ndres eller sendes til dig igen! For at f&aring; en ny adgangskode, er du n&oslash;dt til at slette din brugerprofil (og dermed dine &oslash;nsker) og tilmelde dig igen.<br /><br />
								Din adgangskode er: <h2 style="color: #f00;">',
		
		'mail-sign'			=> 'Med venlig hilsen<br />&Oslash;nskesedlen'

);

?>