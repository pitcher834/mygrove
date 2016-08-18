<?php //header.php
  session_start();

  echo "<!DOCTYPE html>\n<html><head>";

  require_once 'functions.php';

  date_default_timezone_set('America/Denver');
  
  $userstr = 'Guest';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " $user&apos;s Grove";
  }
  else $loggedin = FALSE;

  echo "<title>$appname$userstr</title>"									.
		'<meta name="viewport" content="width=device-width, initial-scale=1">'.
	   '<link rel="stylesheet" type="text/css" '							.
	   'href="//fonts.googleapis.com/css?family=Just+Me+Again+Down+Here" />'.
		"<link rel='stylesheet' " 											.
       "href='styles.css' type='text/css'>"                 		    	.
      '</head><body>'					  			           				.
       "<script src='javascript.js'></script>";

  if ($loggedin)
  {
    echo "<div class='menu2'><ul>" .
		 "<div class='appname2_wrapper'><a href='members.php?view=$user' class='appname2'>$userstr</a></div>" .
         "<div class='link_block'><li><a href='logout.php'>Log out</a></li>"			.
         "<li><a href='park.php'>Park</a></li></div>"					.
         "<div class='link_block'><li><a href='treehouse.php'>Treehouse</a></li>"		.
         "<li><a href='journal.php'>Journal</a></li>"			.
         "<li><a href='compose.php'>Compose</a></li></div>"		.
		 "</ul></div><br>";
  }
  else
  {
    echo ("<ul class='menu2'>" .
		  "<a href='index.php' class='appname2'>$appname</a>"		.
          "<li><a href='login.php'>Log in</a></li>"				 	.
          "<li><a href='signup.php'>Sign up</a></li>"				.
		  "</ul><br>");
  }
?>