<?php

require_once("bookmarkcards.php");
require_once("getbookmarks.php");

// Redirect if accessed directly
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    die(header("Location: " . COMMUNITY));
}

// Check for search term
if(isset($_POST['search'])) {
    // Get search term from form data
    $search_term = $_POST['search_term'];

    // Get public bookmarks
    $bookmarks = getPublicBookmarks();

    // Filter bookmarks by search term
    $matching_bookmarks = array_filter($bookmarks, function($bookmark) use ($search_term) {
        return stripos($bookmark->displayname, $search_term) !== false;
    });

    // Generate bookmark cards for matching bookmarks
    ob_start();
    generatePublicBookmarkCards($matching_bookmarks);
    $bookmark_cards = ob_get_clean();

    // Display matching bookmarks on community.php
    include 'community.php';
} else {
    // Redirect to community page if no search term submitted
    header("Location: " . COMMUNITY);
    exit;
}
