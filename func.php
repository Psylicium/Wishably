<?php

// The admin email address. Change this to your sender email address
$mailfrom	= "From: Sender Name <mailer@yourdomain.com>";

// Invite code to prevent strangers from signing up. Change this to whatever you like
$invite_code = "<INVITE_CODE>";

// The name of your site. Change this to whatever you like
define("SITENAME", "Wishably");

// Set $basedir to the document root and $server to the site URL
$basedir = dirname($_SERVER['PHP_SELF']);
$server	 = "http://" . $_SERVER['SERVER_NAME'];

// Select the display language. Refer to the /lang/languages.txt file for more information.
include('lang/lang_en.php');

// Sanitize form input
function e($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8', false);
}

?>