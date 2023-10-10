<?php

require_once("autoload.php");
require_once("WebServiceClient.php");

// change name to reflect your user credit file/location
require_once(__DIR__ . "/../usr_creds.php");

// Check if a bookmark id is set, if not redirect to bookmarks
if (isset($_GET["bookmarkID"])) {
    $bookmarkID = $_GET["bookmarkID"];
    deleteBookmark($bookmarkID);
} else {
    die(header("Location: " . BOOKMARKS));
}

function deleteBookmark($bookmarkID) {
    // set API endpoint url
    $url = "https://cnmt310.classconvo.com/bookmarks/";

    $client = new WebServiceClient($url);
	$client->setMethod("GET");

	
    $userID = $_SESSION["id"];
    // create data array to send to the API
    $data = array(
	"bookmark_id" => $bookmarkID, 
	"user_id" => $userID
	);
    
    // set API action and auth fields
    $action = "deletebookmark";
    $fields = array(
        "apikey" => APIKEY,
        "apihash" => APIHASH,
        "data" => $data,
        "action" => $action,
    );

    $client->setPostFields($fields);

    // call API and get response
    $returnValue = $client->send();

    // decode JSON response into php object
    $obj = json_decode($returnValue);
    if (!property_exists($obj,"result")) {
        die(print("Error, no result property"));
    }

    // Check if the bookmark was deleted successfully
    if (property_exists($obj, "result") && $obj->result == "Success") {
        die(header("Location: " . BOOKMARKS));
    } else {
        // Handle error
        if (property_exists($obj, "data") && property_exists($obj->data, "message")) {
            die("Error: " . $obj->data->message);
        } else {
            die("Error: Unable to delete bookmark.");
        }
    }
}
