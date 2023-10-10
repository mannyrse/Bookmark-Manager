<?php

require_once("autoload.php");
require_once("classes/SitePage.class.php");

// Redirect to homepage if user is logged in
if (isset($_SESSION['id'])) {
    die(header("Location: " . HOME));
} 

$page = new SitePage("Login");

print $page->getTopSection();

  //Navigation Bar  
  print '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">';
    print '<div class="container-fluid mx-5 px-5 py-2">';
      print '<a class="navbar-brand sparkBranding" href="' . HOME . '"><img src="images/logo.png" width="50" height="50" class="d-inline-block align-top mx-2">Spark</a>';
    print '</div>';
  print '</nav>';
    
  // -----------Login Form----------------  
  // Username: id="username" name="username"
  // Password: id="password" name="password"
  // Submit Button: id="btn_submit" name="submit"
  print '<div class="d-flex justify-content-center align-items-center mt-5">';
    print '<div class="container">';
      print '<div class="row d-flex justify-content-center">';
        print '<div class="col-12 col-md-8 col-lg-6">';
          print '<div class="card bg-white">';
            print '<div class="card-body p-5">';
              // updated to use action-login file for processing
              print '<form class="mb-3 mt-md-1" action="action-login.php" method = "post">';
                print '<div class="text-center">';
                  print '<img src="images/logo.png" width="75" height="75" class="mb-3">';
                  print '<h2 class="fw-bold mb-2">Login to your account</h2>';
                  print '<p class=" mb-5">Welcome back! Please enter in your details.</p>';
                print '</div>';
                // If errors, print here: 
				if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                print '<div class="errorMessage">';
                  print '<p>' .$_SESSION["error"]. '</p>';
                print '</div>';
				$_SESSION['error'] = "";
				}
                print '<div class="mb-3">';
                  print '<label for="username" class="form-label ">Username</label>';
                  print '<input type="username" class="form-control inputFocus" id="username" name ="username" placeholder="Enter your username">';
                print '</div>';
                print '<div class="mb-3">';
                  print '<label for="password" class="form-label ">Password</label>';
                  print '<input type="password" class="form-control inputFocus" id="password" name="password" placeholder="Enter your password">';
                print '</div>';
                print '<div class="d-grid">';
                  print '<button class="btn purpleButton" type="submit" id="btn_submit" name="submit">Login</button>';
                print '</div>';
              print '</form>';
              print '<div>';
                print '<a href="' . HOME . '" class="text-center text-decoration-none fw-bold purple">&lt; Return to homepage</a>';
              print '</div>';
            print '</div>';
          print '</div>';
        print '</div>';
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
