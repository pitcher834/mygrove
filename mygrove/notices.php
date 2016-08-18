<?php  //final project:  notices.php
  require_once 'header.php';
  
  
	if (!$loggedin) die();
	
	
	echo "<div class='main'>";
	
	$result = queryMysql("SELECT * FROM notices WHERE requested='$user'");
	$rows = $result->num_rows;
	$requester = '';

	if ($rows == 0)
	{
		echo "You have no notices at this time.<br>";
	}
	else
	{
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$requester = $row['requester'];
			
			
			if (isset($_POST['accept' . $j]))
			{
				addFriend($user, $requester);
				echo "<script>window.location.assign('notices.php?view=$user');</script>";
			}

			echo "<br>" . $requester . " requests to be your friend. ";
			echo "<form method='post' action='notices.php'>";
			echo "<input class='button' type='submit' name='accept$j' value='accept'>";
			echo "<input class='button' type='submit' name='decline$j' value='decline'><br>";
			echo "<a class='linkbutton' href='members.php?view=" . $requester . "'><button class='button'>View Profile</button></a>";
			
			
					
		}
	}
	
	echo "</div>";
	
	addFooter();
	echo "</body></html>";
?>
