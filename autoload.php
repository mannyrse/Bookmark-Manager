<?php 

// Redirect if accessed directly
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die(header("Location: " . "index.php"));
}

session_start(); 

// CONSTANTS 
define("HOME", "index.php");
define("BOOKMARKS", "bookmarks.php");
define("COMMUNITY", "community.php");
define("LOGIN", "form-login.php");
define("LOGOUT", "logout.php");
