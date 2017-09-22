<?php

// The admin email address. Change this to your sender email address
$mailfrom	= "From: Wishably <your@email.com>";

// Invite code to prevent strangers from signing up. Change this to whatever you like
$invite_code = "<invite-code>";

// The name of your site. Change this to whatever you like
define("SITENAME", "Wishably");

// The URL of your site, ie. "http://mysite.com/wishably/". Don't forget "http://" and the the "/" at the end!
$basedir = "http://mysite.com/wishably/";

// Sanitize form input
function e($string) { return htmlentities($string, ENT_QUOTES, 'UTF-8', false); }

// Preparing some variables for the language file
if (isset($_POST['email'])) { $email = e($_POST['email']); } else { $email = ""; }
if (isset($_POST['username'])) { $username = e($_POST['username']); } else { $username = ""; }
if (isset($_POST['password'])) { $password = e($_POST['password']); } else { $password = ""; }

// Select the display language. Refer to the /lang/languages.txt file for more information.
include('lang/lang_en.php');

?>