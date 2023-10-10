<?php

require_once("autoload.php");
require_once("classes/SitePage.class.php");
$page = new SitePage("Homepage");

print $page->getTopSection();

  //Navigation Bar
  print '<div class="bg-image">';
  print '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">';
    print '<div class="container-fluid mx-5 px-5 py-2">';
      if (isset($_SESSION['id'])) {
        print '<a class="navbar-brand sparkBranding" href="' . HOME . '"><img src="images/logo.png" width="50" height="50" class="d-inline-block align-top mx-2"></a>';
        // Customize navbar with user's full name 
        print '<span class="navName">' . $_SESSION['name'] . '\'s Sparks</span>';
      } else {
        print '<a class="navbar-brand sparkBranding" href="' . HOME . '"><img src="images/logo.png" width="50" height="50" class="d-inline-block align-top mx-2">Spark</a>';
      }
      print '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
        print '<span class="navbar-toggler-icon"></span>';
      print '</button>';
      print '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
        print '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
          print '<li class="nav-item px-2">';
            print '<a class="nav-link active" aria-current="page" href="' . HOME . '">Home</a>';
          print '</li>';

          // If logged in add the My Bookmarks link to navigation  
          if (isset($_SESSION['id'])) {
              print '<li class="nav-item px-2">';
                print '<a class="nav-link" href="' . BOOKMARKS . '">My Bookmarks</a>';
              print '</li>';
              print '<li class="nav-item px-2">';
                print '<a class="nav-link" aria-current="page" href="' . COMMUNITY . '">Community</a>';
              print '</li>';
          }

          // Updated the <button> to <a> to fix redirects 
          // If logged in change Login button to Logout button 
          if (isset($_SESSION['id'])) {
            print '<li class="nav-item px-2">';
              print '<a class="btn btn-outline-light" href="' . LOGOUT . '">Logout</a>';
            print '</li>';
          } else {
            // If not logged in, display Login button
            print '<li class="nav-item px-2">';
              print '<a class="btn btn-outline-light" href="' . LOGIN . '">Login</a>'; 
            print '</li>';
          }
        print '</ul>';
      print '</div>';
    print '</div>';
  print '</nav>';


  // Main Content
  print '<div class="container col-xxl-8 px-4 py-5">';
    print '<div class="row flex-lg-row-reverse align-items-center g-5 py-5">';
      print '<div class="col-10 col-sm-8 col-lg-6">';
      print '</div>';
      print '<div class="col-lg-6 p-5 darkBackground">';
        print '<h1 class="display-5 fw-bold lh-1 mb-3 text-white">Catch the spark</h1>';
        print '<hr class="homeDivider" />';
        print '<p class="lead text-white homepageText">Transform a spark of inspiration into a steady flame with our bookmark manager. Our tool gives you the ability to store multiple bookmark links, search for the spark you need, and delete what no longer catches your interest.</p>';
      print '</div>';
    print '</div>';
  print '</div>';

  //Footer
  print '<footer class="footer mt-auto py-3 bg-dark fixed-bottom">';
    print '<div class="container py-2 text-center">';
      print '<span class="text-white-50 ">Copyright 2023</span>';
    print '</div>';
  print '</footer>';

print $page->getBottomSection();