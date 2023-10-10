<?php

require_once("bookmarkcards.php");
require_once("getbookmarks.php");

// Redirect if accessed directly
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    die(header("Location: " . BOOKMARKS));
}


// Check for search term
if(isset($_POST['search'])) {
    // Get search term from form data
    $search_term = $_POST['search_term'];

    // Get user's bookmarks
    $bookmarks = getUserBookmarks();

    // Filter bookmarks by search term
    $matching_bookmarks = array_filter($bookmarks, function($bookmark) use ($search_term) {
        return strpos($bookmark->displayname, $search_term) !== false;
    });

    // Generate bookmark cards for matching bookmarks
    ob_start();
    generateBookmarkCards($matching_bookmarks);
    $bookmark_cards = ob_get_clean();

    // Display matching bookmarks on bookmarks.php
    include 'bookmarks.php';
} else {
    // Redirect to bookmarks page if no search term submitted
    header("Location: " . BOOKMARKS);
    exit;
}
