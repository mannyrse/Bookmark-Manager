<?php

require_once('autoload.php');

// set session variable to false and unset it
$_SESSION["logged_in"] = false;
unset($_SESSION["logged_in"]);

// destroy the session and remove all session variables
session_destroy();
$_SESSION = array();

// close session
session_write_close();

// redirect to home page
die(header("Location: " . HOME));
