<?php

require_once("autoload.php"); 

// Redirect if accessed directly
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die(header("Location: " . BOOKMARKS));
}

// Function to create user's bookmark cards
function generateBookmarkCards($bookmarks) {
    // Loop through bookmarks array and generate a card for each bookmark
    foreach ($bookmarks as $bookmark) {
        // Bookmark card 
        print '<div class="d-flex justify-content-center align-items-center mb-2">';
            print '<div class="container">';
                print '<div class="row d-flex justify-content-center">';
                    print '<div class="col-12 col-md-8 col-lg-10">';
                        print '<div class="card bg-white">';
                            print '<div class="card-body p-3">';
                                print '<div>';
                                    print '<div class="float-end">';
                                        // Delete bookmark button 
                                        print '<button type="button" class="btn btn-light" name="submit">';
                                            print '<a class="deleteButton" id="deleteBookmark" href="deletebookmarks.php?bookmarkID=' . $bookmark->bookmark_id . '">';
                                                print '<img class="deleteIcon" src="images/deleteIcon.png">&nbsp;&nbsp;Delete';
                                            print '</a>';
                                        print '</button>';
                                    print '</div>';
                                    // Bookmark title - Added on click event to refresh page
									print '<a href ="addvisit.php?bookmark_id=' . $bookmark->bookmark_id . '&bookmarkurl=' . $bookmark->url .'" class="bookmarkTitle" id="bookmarkVisit" target="_blank" onclick="setTimeout(function(){location.reload();}, 100);"><h5>' . $bookmark->displayname . ' | <span class="visitCount">' . $bookmark->visits . '</span> Visits</h5></a>';
                                    // Bookmark url 
									print '<a href ="addvisit.php?bookmark_id=' . $bookmark->bookmark_id . '&bookmarkurl=' . $bookmark->url .'" class="bookmarkURL" target="_blank" onclick="setTimeout(function(){location.reload();}, 100);"><span>' . $bookmark->url . '</span></a>';
                                    // New line for badges
                                    print '<div class="clearfix"></div>';
                                    // Bookmark visibility indicator
									if ($bookmark->shared) {
										print '<span class="badge shared-badge">Public | ID: ' . $bookmark->bookmark_id . '</span>';
									} else {
										print '<span class="badge private-badge">Private | ID: ' . $bookmark->bookmark_id . '</span>';
									}
                                print '</div>';
                            print '</div>';    
                        print '</div>';
                    print '</div>';    
                print '</div>';
            print '</div>';
        print '</div>';
    }
}

// Function to create public bookmark cards
function generatePublicBookmarkCards($bookmarks) {
    // Loop through bookmarks array and generate a card for each bookmark
    foreach ($bookmarks as $bookmark) {
        // Bookmark card 
        print '<div class="d-flex justify-content-center align-items-center mb-2">';
            print '<div class="container">';
                print '<div class="row d-flex justify-content-center">';
                    print '<div class="col-12 col-md-8 col-lg-10">';
                        print '<div class="card bg-white">';
                            print '<div class="card-body p-3">';
                                print '<div>';
                                    // Bookmark title - Added on click event to refresh page
								print '<a href ="addvisit.php?bookmark_id=' . $bookmark->bookmark_id . '&bookmarkurl=' . $bookmark->url .'" class="bookmarkTitle" id="bookmarkVisit" target="_blank" onclick="setTimeout(function(){location.reload();}, 100);"><h5>' . $bookmark->displayname . ' | <span class="visitCount">' . $bookmark->visits . '</span> Visits</h5></a>';
                                    // Bookmark url 
									print '<a href ="addvisit.php?bookmark_id=' . $bookmark->bookmark_id . '&bookmarkurl=' . $bookmark->url .'" class="bookmarkURL" target="_blank" onclick="setTimeout(function(){location.reload();}, 100);"><span>' . $bookmark->url . '</span></a>';
                                    // New line for badges
                                    print '<div class="clearfix"></div>';
                                    // Bookmark visibility indicator
									print '<span class="badge shared-badge">Public | ID: ' . $bookmark->bookmark_id . '</span>';                        
							    print '</div>';
                            print '</div>';    
                        print '</div>';
                    print '</div>';    
                print '</div>';
            print '</div>';
        print '</div>';
    }
	
}
