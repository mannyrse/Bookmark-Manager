<?php

require_once("autoload.php");
require_once("WebServiceClient.php");

// Change to reflect where your user credit file is stored
require_once(__DIR__ . "/../usr_creds.php");

// set API endpoint url
$url = "https://cnmt310.classconvo.com/bookmarks/";

$client = new WebServiceClient($url);

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    die(Header("Location: " . BOOKMARKS));
}

// Check if form data is submitted
if (isset($_POST["url"]) && isset($_POST["title"])) {
    
    // Determine shared property based on public/private radio button selection
    if (isset($_POST["visibility"]) && $_POST["visibility"] == "public") {
        $shared = true;
    } else {
        $shared = false;
    }
    
    // Create data array to send to the API
    $data = array(
        "url" => $_POST["url"],
        "displayname" => $_POST["title"],    
        "user_id" => $_SESSION['id'],
        "shared" => $shared
    );

    // Set API action and bookmark fields
    $action = "addbookmark";
    $fields = array(
        "apikey" => APIKEY,
        "apihash" => APIHASH,
        "data" => $data,
        "action" => $action
    );

    $client->setPostFields($fields);

    // Call API and get response
    $returnValue = $client->send();

    // Decode JSON response into php object
    $obj = json_decode($returnValue);
    if(!property_exists($obj, "result")) {
        die(print("Error, no result property"));
    }

    // Check if the bookmark was successfully added
    if ($obj->result == "Success") {
        $bookmark_id = $obj->data->bookmark_id;
        die(header("Location: " . BOOKMARKS));
    } else {
        die("Error: " . $obj->data->message);
    }
} else {
     die(header("Location: " . BOOKMARKS));
}
