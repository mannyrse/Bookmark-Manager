<?php

require_once("autoload.php");
require_once("getbookmarks.php");
require_once("bookmarkcards.php");
require_once("classes/SitePage.class.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    die(header("Location: " . LOGIN));
} 

$page = new SitePage("Community");

print $page->getTopSection();

print '<div class="d-flex flex-column min-vh-100">';
    // Navigation bar 
    print '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">';
        print '<div class="container-fluid mx-5 px-5 py-2">';
            print '<a class="navbar-brand sparkBranding" href="' . HOME . '"><img src="images/logo.png" width="50" height="50" class="d-inline-block align-top mx-2"></a>';
            // Customize navbar with user's full name 
            print '<span class="navName">' . $_SESSION['name'] . '\'s Sparks</span>';
            print '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
                print '<span class="navbar-toggler-icon"></span>';
            print '</button>';
            print '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
                print '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
                    print '<li class="nav-item px-2">';
                        print '<a class="nav-link" href="' . HOME . '">Home</a>';
                    print '</li>';
                    print '<li class="nav-item px-2">';
                        print '<a class="nav-link" aria-current="page" href="' . BOOKMARKS . '">My Bookmarks</a>';
                    print '</li>';
                    print '<li class="nav-item px-2">';
                        print '<a class="nav-link active" aria-current="page" href="' . COMMUNITY . '">Community</a>';
                    print '</li>';
                    print '<li class="nav-item px-2">';
                        print '<a class="btn btn-outline-light" href="' . LOGOUT . '">Logout</a>'; 
                    print '</li>';
                print '</ul>';
            print '</div>';
        print '</div>';
    print '</nav>';

    // Get user's bookmark titles, then adds them into an array
    $bookmarks = getPublicBookmarks();
    $bookmarksTitle = array();
    foreach($bookmarks as $bookmark) {
        array_push($bookmarksTitle, $bookmark->displayname);
    }

	print '<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">';
	print '<script src="https://code.jquery.com/jquery-3.6.0.js"></script>';
	print '<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>';

    // Javascript autocomplete function, takes the data from the array just made
    print '<script type="text/Javascript">
        $( function() {
            let bookmarks = ' . json_encode($bookmarksTitle) . ';
            $( "#searchBar" ).autocomplete({
                source: bookmarks ,
                minLength: 1,
            });
        });
    </script>';

		// Search bar
	   print '<div class="d-flex justify-content-center align-items-center my-5">
		 <div class="container">
			 <div class="row d-flex justify-content-center">
				 <div class="col-12 col-md-8 col-lg-10">
					 <form class="d-flex" action="searchpublicbookmarks.php" method="post">';						// Search bar input and button
						print '<input class="form-control me-1 inputFocus" type="search" placeholder="Search community bookmarks" aria-label="Search" name="search_term" id="searchBar">';
						print '<button class="btn btn-dark px-4" type="submit" name="search">';
							print '<img src="images/searchIcon.png">';
						print '</button>';
					print '</form>';
				print '</div>';
			print '</div>';
		print '</div>';
	print '</div>';
 
    //Display public posts here
	if(isset($_POST['search'])) {
    // Get search term from form data
    $search_term = $_POST['search_term'];

    // Get user's bookmarks from API
    $bookmarks = getPublicBookmarks();
    // Filter bookmarks by search term
    $matching_bookmarks = array_filter($bookmarks, function($bookmark) use ($search_term) {
        return strpos($bookmark->displayname, $search_term) !== false;
    });

    // Display matching bookmarks using generatePublicBookmarkCards function
    if(count($matching_bookmarks) > 0) {
        generatePublicBookmarkCards($matching_bookmarks);
    } else {
        print '<div class="d-flex justify-content-center align-items-center mt-2">';
            print '<div class="container">';
                print '<div class="row d-flex justify-content-center">';
                    print '<div class="col-12 col-md-8 col-lg-10">';
                        print '<p class="errorMessage justify-content-center">No matching bookmarks found.</p>';
                    print '</div>';
                print '</div>';
            print '</div>';
        print '</div>';
    }
} else {
    // Display all bookmarks
    $bookmarks = getPublicBookmarks();
    if(count($bookmarks) > 0) {
        generatePublicBookmarkCards($bookmarks);
    } else {
        print '<div class="d-flex justify-content-center align-items-center mt-2">';
            print '<div class="container">';
                print '<div class="row d-flex justify-content-center">';
                    print '<div class="col-12 col-md-8 col-lg-10">';
                        print '<p class="errorMessage justify-content-center">No bookmarks found.</p>';
                    print '</div>';
                print '</div>';
            print '</div>';
        print '</div>';
    }
}

print '</div>';

print $page->getBottomSection();
