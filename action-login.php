<?php

require_once("autoload.php");
require_once("WebServiceClient.php");

// Change name to reflect your user credit file/location
require_once(__DIR__ . "/../usr_creds.php");

// Check if the HTTP_REFERER header is set
if (!isset($_SERVER['HTTP_REFERER'])) {
    // redirect the user to another page
    die(header('Location: ' . HOME));
}
// Set API endpoint url
$url = "https://cnmt310.classconvo.com/bookmarks/";

$client = new WebServiceClient($url);

// Check if the login form is submitted
if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create data array to send to the API
    $data = array("username" => $username, "password" => $password);
    
    // Set API action and auth fields
    $action = "authenticate";
    $fields = array(
        "apikey" => APIKEY,
        "apihash" => APIHASH,
        "data" => $data,
        "action" => $action,
    );

    $client->setPostFields($fields);

    // Call API and get response
    $returnValue = $client->send();

    // Decode JSON response into php object
    $obj = json_decode($returnValue);
    if (!property_exists($obj,"result")) {
        die(print("Error, no result property"));
    }
    $invalidCreds = "";
    // Check if login was successful
    if ($obj->result == "Success") {
        $_SESSION['loggedIn'] = true;
        // Save the user id to the session 
        $_SESSION["id"] = $obj->data->id;
	// Save the user's name to the session
        $_SESSION["name"] = $obj->data->name;
        die(header("Location: " . BOOKMARKS));
    } else {
        // Output result stored in session variable, then goes to LOGIN and is displayed there
		$_SESSION['error'] = 'Username or password is incorrect, please try again.';
		die(header("Location: " . LOGIN));
    }
}
