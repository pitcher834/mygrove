<?php // final project: members.php
  require_once 'header.php';

  if (!$loggedin) die();

  $result = "bob";  
    
  echo "<div class='primary'>";

	  
	if (isset($_GET['view']))
	{
		$view = sanitizeString($_GET['view']);
		
		
		if ($view == $user) 
		{
			echo "<h3>Your Profile</h3>";
		showProfile($view);
		echo "<div class='profile_buttons'><ul class='button'>" .
			"<li><a href='profile.php?view=$view'>Edit Profile</a></li>" .
			"<li><a href='notices.php?view=$view'>View Notices</a></li>";
		}
		else
		{
			
			$result = queryMysql("SELECT * FROM friends WHERE user='$user' && friend='$view'");
			$row = $result->fetch_assoc();
  
			echo "<h3>$view's Profile</h3>";
			showProfile($view);
		

			if ($row['friend']==$view)
			{
				echo "<div class='profile_buttons'><form method='post' action='remove.php'><ul>";
				echo "<li><input type='submit' class='button' value='Remove Friend'></li>";
				echo "<li><input type='hidden' name='user' value='$user'></li>";
				echo "<li><input type='hidden' name='view' value='$view'></li>";
			}
			
			else 
			{
				echo "<div class='profile_buttons'><form method='post' action='add.php'><ul>";
				echo "<li><input type='submit' class='button' value='Add Friend'></li>";
				echo "<li><input type='hidden' name='user' value='$user'></li>";
				echo "<li><input type='hidden' name='view' value='$view'></li>";
			}
		}
		
		echo "</ul></form></div></div>";
	}

	echo "<div class='secondary'>";
 
	$result = queryMysql("SELECT user FROM members ORDER BY user");
	$num    = $result->num_rows;

  
	echo "<h3>Other Members</h3><ul class='members'>";

	for ($j = 0 ; $j < $num ; ++$j)
	{
		$row = $result->fetch_array(MYSQLI_ASSOC);
		if ($row['user'] == $user) continue;
    
		echo "<li><a href='members.php?view=" .
			$row['user'] . "'>" . $row['user'] . "</a>";    
	}
	
	echo "</ul></div>";
	addFooter();
	echo"</body></html>";
?>

    
