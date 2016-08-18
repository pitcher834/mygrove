<?php  //final project:  add.php
  require_once 'header.php';
  
  
  if (!$loggedin) die();
  
	if (isset($_POST['view']))
	{
		$view = sanitizeString($_POST['view']);
		$user = sanitizeString($_POST['user']);
		
		addFriend($user, $view);
		
		addFooter();
		echo "<script>setTimeout(function(){window.location.assign('members.php?view=$view');}, 2500);</script>";
	}
	else
		echo "<div class='main'>something went wrong<br></div>";
?>
</body>
</html>