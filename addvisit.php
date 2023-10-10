<?php

require_once("autoload.php");
require_once("WebServiceClient.php");

// Change to reflect where your user credit file is stored
require_once(__DIR__ . "/usr_creds.php");

$bookmarkurl = "";
if (isset($_GET["bookmark_id"]) && isset($_GET["bookmarkurl"]) ) {
    $bookmarkID = $_GET["bookmark_id"];
	$bookmarkurl = $_GET["bookmarkurl"];
    addVisit($bookmarkID, $bookmarkurl);
} else {
    die(header("Location: " . BOOKMARKS));
}

// Function to track visit to a bookmark
function addVisit($bookmark_id, $bookmarkurl) {
    // set API endpoint url
    $url = "https://cnmt310.classconvo.com/bookmarks/";

    // Create data array to send to the API
    $data = array(
        "bookmark_id" => $bookmark_id,
        "user_id" => $_SESSION['id']
    );

    // Set API action and bookmark fields
    $action = "addvisit";
    $fields = array(
        "apikey" => APIKEY,
        "apihash" => APIHASH,
        "data" => $data,
        "action" => $action
    );

    // Create WebServiceClient instance
    $client = new WebServiceClient($url);

    // Set POST fields
    $client->setPostFields($fields);

    // Call API and get response
    $response = $client->send();

    // Decode JSON response into php object
    $obj = json_decode($response);

    // Check if the visit was added successfully
    if (property_exists($obj, "result") && $obj->result == "Success") {
        // Return the number of rows updated
		die(header("Location: " . $bookmarkurl));
        return $obj->data->number_of_rows_updated;
    } else {
        // Handle error
        if (property_exists($obj, "data") && property_exists($obj->data, "message")) {
            die("Error: " . $obj->data->message);
        } else {
            die("Error: Unable to add visit to bookmark.");
        }
    }
}
