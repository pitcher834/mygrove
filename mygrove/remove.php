<?php  //final project:  remove.php
  require_once 'header.php';
  
  
  if (!$loggedin) die();
  
	if (isset($_POST['view']))
	{
		$view = sanitizeString($_POST['view']);
		$user = sanitizeString($_POST['user']);
		
		removeFriend($user, $view);
		
		echo "<div class='main'>" . $view . " is no longer a friend.<br></div>";
		addFooter();
		echo "<script>setTimeout(function(){window.location.assign('members.php?view=$view');}, 2500);</script>";
	}
	else
		echo "<div class='main'>something went wrong<br></div>";
?>
</body>
</html>