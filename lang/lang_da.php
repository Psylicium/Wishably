<?php
/*

------------------------------------------------------------------------------------------
lang_da.php - Danish language file for Onskesedlen
------------------------------------------------------------------------------------------

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
	
	// ****************************** NAVIGATION BAR ******************************************************
	
		'notloggedin'		=> 'Du er ikke logget ind.',
		'toindexpage'		=> 'Til forsiden',
		'login'				=> 'Log ind',
		'register'			=> 'Registrering',
		'forgotpassword'	=> 'Glemt adgangskode?',
		'loggedinas'		=> 'Logget ind som',
		'logout'			=> 'Log ud',
		'mywishlist'		=> 'Min ønskeseddel',
		'myreservations'	=> 'Mine reservationer',
		'deleteuser'		=> 'Slet brugerprofil',
		'loginerror'		=> 'Forkerte loginoplysninger',
		'adm-delwish'		=> 'Slet ønsker',
		'adm-delall'		=> 'Slet alt',
	
	// ****************************** INDEX PAGE **********************************************************
	
		'users'				=> 'Registrerede brugere',
		'login-email'		=> 'Email-adresse',
		'login-pwd'			=> 'Adgangskode',
		'therearenowishes'	=> 'Der er i øjeblikket ingen ønsker, eller også er du den eneste der har afgivet.',
		'tbl_wish'			=> 'Ønske',
		'tbl_wishedby'		=> 'Ønsket af',
		'tbl_actions'		=> 'Handlinger',
		'tbl_linkalt'		=> 'Klik for at gå til siden (åbner i en ny fane)',
		// 'indexredir'		=> 'Redirecting you to the index page in <span id="counter">3</span> seconds...',
		'redir-index'		=> '<div class="redir">Omdirigerer dig til forsiden om <span id="counter">5</span> sekunder... <a href="'.$server.'">eller klik her</a></div>',
		'redir-wishlist'	=> '<div class="redir">Omdirigerer dig til din ønskeseddel om <span id="counter">5</span> sekunder... <a href="'.$server.'/mylist.php">eller klik her</a></div>',
		'redir-reservation'	=> '<div class="redir">Omdirigerer dig til dine reservationer om <span id="counter">5</span> sekunder... <a href="'.$server.'/gift.php?do=myreservations">eller klik her</a></div>',
		'redir-logoutdel'	=> '<div class="redir">Du vil blive logget ud og omdirigeret til forsiden om <span id="counter">5</span> sekunder... <a href="'.$server.'/?do=logout">eller klik her</a></div>',

	// ****************************** WISHLIST OPERATIONS *************************************************
	
		'addnewwish'		=> 'Tilføj nyt ønske',
		'edit'				=> 'Redig&eacute;r',
		'delete'			=> 'Slet',
		'ph_yourwish'		=> 'Hvad ønsker du dig?',
		'ph_onlinebuy'		=> 'Kan det købes online?',
		'note_url'			=> 'Hvis du indtaster en webadresse, så husk at skrive <code>http://</code> eller <code>https://</code> i starten, f.eks. <code>http://butik.dk/mit-onske</code>',						
		'savechanges'		=> 'Gem ændringer',
		'wishsaved'			=> 'Dit ønske er gemt.',					
		'wishnotsaved'		=> 'Dit ønske kunne ikke gemmes.',
		'deletewish'		=> 'Slet ønske',
		'wanttodelete'		=> 'Vil du slette dit ønske',
		'cancelgoback'		=> '<span style="font-size: .8em;">&#10094; Fortryd og gå tilbage</span>',
		'wishisdeleted'		=> 'Dit ønske er slettet.',
		'wishnotdeleted'	=> 'Dit ønske kunne ikke slettes.',
		// 'wishlistredir'		=> 'Redirecting you to your wishlist in <span id="counter">3</span> seconds...',
		'editwish'			=> 'Redig&eacute;r ønske',
		'wishupdated'		=> 'Dit ønske er opdateret.',
		'wishnotupdated'	=> 'Dit ønske blev ikke opdateret. Måske er du blevet logget af, eller også har du ikke foretaget nogen ændringer.',
		'wanttoreserve'		=> 'Vil du reservere',
		'wish'				=> 'ønske',
		'reserve'			=> 'Reserv&eacute;r',
		'wishreserved'		=> 'Dette ønske er nu reserveret til dig.',
		'noreservations'	=> 'Du har ikke reserveret nogen ønsker.',
		'reservewish'		=> 'Reserv&eacute;r ønske',
		'deletereservation'	=> 'Slet reservation',
		'wanttounreserve'	=> 'Vil du slette din reservation af',
		'wishunreserved'	=> 'Din reservation er slettet.',
		'wishnotunreserved'	=> 'Din reservation kunne ikke slettes.',
				
	// ****************************** REGISTER/DELETE PROCEDURE *******************************************
	
		'ph_username'		=> 'Dit navn',
		'reg-namenote'		=> 'Dette vil blive vist ud for dit ønske, så du bør bruge dit rigtige navn.',
		'ph_emailadd'		=> 'Din email-adresse',
		'reg-emailnote'		=> 'Din email-adresse vil være dit login, så vær sikker på at du indtaster den korrekt.',
		'ph_password'		=> 'Adgangskode',
		'ph_password_rep'	=> 'Bekræft adgangskode',
		'ph_invitecode'		=> 'Din invitationskode',
		'reg-invitenote'	=> 'Indtast invitationskoden du har modtaget fra administratoren',
		'passnotmatch'		=> 'Adgangskoderne stemmer ikke overens.',
		'invitenotcorrect'	=> 'Invitationskoden er ikke korrekt.',
		'emailinuse'		=> 'Den indtastede email-adresse er allerede i brug. <a href="login.php?do=lostpwd">Glemt adgangskode?</a>',
		'usersignup-suc'	=> 'Du er nu registreret, og dine logininformationer er sendt til <b>'.x($_POST['email']).'</b>.',
		'usersignup-err'	=> 'Der er opstået en fejl. Prøv igen senere, eller kontakt administratoren.',
		'delete-note'		=> 'Indtast din email-adresse i feltet herover, og tryk <span style="color: #fff;">SLET BRUGERPROFIL</span>. Det kan ikke fortrydes!',
		'del-userres'		=> 'Dine reservationer er slettet',
		'del-userwish'		=> 'Dine ønsker er slettet',
		'del-user'			=> 'Din brugerprofil er slettet',
		'del-userres-err'	=> 'Dine reservationer blev ikke slettet',
		'del-userwish-err'	=> 'Dine ønsker blev ikke slettet',
		'del-user-err'		=> 'Din brugerprofil blev ikke slettet',
					
	// ****************************** LOST PASSWORD PROCEDURE *********************************************
	
		'forgotpwd'			=> 'Har du glemt din adgangskode?',
		'fgp-emailnote'		=> 'Du vil modtage en email med en vejledning til hvordan du opretter en ny adgangskode til din profil.',
		'fgp-submit'		=> 'Send',
		'fgp-authok'		=> 'Check din email for nulstillingsvejledningen.',
		'fgp-autherr'		=> 'Der er opstået en fejl. Enten er din email-adresse ikke genkendt, eller også er der en verserende nulstilling i gang. Du bør kontakt administratoren hvis problemet fortsætter.',
		'fgp-mismatch'		=> 'Der er opstået en fejl. Du bør kontakte administratoren hvis problemet fortsætter.',
		'fgp-redir-index'	=> '<div class="redir">Omdirigerer dig til forsiden om <span id="counter">10</span> sekunder... <a href="'.$server.'">eller klik her</a></div>',
		'newpwd-passheader'	=> 'Nulstil din adgangskode',
		'newpwd-pass'		=> 'Indtast din nye adgangskode',
		'newpwd-passconf'	=> 'Bekræft din nye adgangskode',
		'newpwd-updok'		=> 'Din adgangskode er blevet ændret.',
		'newpwd-upderr'		=> 'Din adgangskode kunne ikke ændres. Prøv igen senere, eller kontakt administratoren hvis problemet fortsætter.',
	
	// ****************************** EMAIL CONTENT *******************************************************
	// These elements are used for the email sent to new users.

		'mail-subject'		=> "Registrering på ".SITENAME."",
		
		'mail-body'			=> "Hej ".x($_POST['username']).", og velkommen til ".SITENAME."!<br /><br />
								Dine logininformationer er som følger:<br /><br />
								<code><h3>Email-addresse: ".x($_POST['email'])."<br />
								Adgangskode&nbsp;&nbsp;&nbsp;: ".x($_POST['password'])."</h3></code>
		",
		
		'mail-sign'			=> 'Med venlig hilsen<br />'.SITENAME.'',
		
		'mail-subject-lpwd'	=> 'Nulstilling af adgangskode på '.SITENAME.'',
		
		'mail-body-lpwd'	=> 'Der har været en forespørgsel på at nulstille din adgangskode på '.SITENAME.'.<br /><br />
								Klik på linket herunder for at nulstille din nuværende adgangskode og oprette en ny. Linket kan kun bruges én gang, så hvis du glemmer adgangskoden igen, skal processen gentages.<br /><br />',
								
	// ****************************** ADMIN CONTENT *******************************************************
	
		'crtadm-title'		=> 'Opret administratorprofil',
		'crtadm-desc'		=> 'Første skridt på vejener er at oprette en administratorprofil, så du kan få lidt kontrol over siden. Du vil få nogle ekstra menupunkter i navigationsbaren, så du nemt kan slette ønsker (for at genbruge scriptet til næste jul), eller slette databasen fuldstændig.<br /><br />På den måde behøver du ikke logge ind i databasen fra tid til anden for at udføre administrative handlinger (og "ved et uheld" se hvilke gaver du kan regne med at få :)...',
		'crtadm-passnote'	=> 'Bare rolig, scriptet bruger Eksblowfish hashing-algoritme til at kryptere adgangskoder :)',
		'adminok'			=> 'Administratorprofil er oprettet. Det er meget vigtigt, du enten sletter eller omdøber filen <code>'.$server.'/admin/createadmin.php</code> omgående, så andre ikke kan opnå administratorrettigheder til din side.',
		'adminerr'			=> 'Administratorprofil blev ikke oprettet - check din konfiguration.',
		'adm-delwish-title'	=> 'Slet ønsker',
		'adm-delwish-desc'	=> 'Dette vil slette alle ønsker i databasen, men bevare brugerinformationerne. Klik på afkrydsningsfeltet herunder og tryk OK for at udføre handlingen.',
		'adm-delwish-conf'	=> 'Ja, jeg vil slette alle ønsker i databasen, men bevare brugerinformationerne.',
		'adm-delall-title'	=> 'Slet alt',
		'adm-delall-desc'	=> 'Dette vil slette alt i databasen - ønsker og brugerinformation, inklusive administratorprofilen! Du skal køre filen <code>'.$server.'/admin/createadmin.php</code> igen for at oprette en ny administratorprofil. Når du trykker OK, vil alt blive slettet, og du vil blive logget ud. Klik på afkrydsningsfeltet herunder og tryk OK for at udføre handlingen.',
		'adm-delall-conf'	=> 'Ja, jeg vil slette alt i databasen, inklusive administratorprofilen.',
		'adm-del-submit'	=> 'OK',
		'adm-delgift-ok'	=> 'Tabellen `gifts` er tømt',
		'adm-delgift-err'	=> 'Tabellen `gifts` blev ikke tømt: ',
		'adm-deluser-ok'	=> 'Tabellen `users` er tømt',
		'adm-deluser-err'	=> 'Tabellen `users` blev ikke tømt: '
		
);

?>