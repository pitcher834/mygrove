<?php // homepage;: index.php
  require_once 'header.php';


  if ($loggedin) {
	  destroySession();
	  window.location.assign("index.php");
  }
  else
	  echo "<div class='main'>Welcome to $appname, where your privacy matters. Here you can hang out with your friends in the treehouse,
			check out whats in the park, or sit back with your journal.<br><br></div>";
	addFooter();
?>
  </body>
</html>