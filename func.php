<?php

// Sanitize form input
function e($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8', false);
}

// Generate random 6 char numeric password
function generateRandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>