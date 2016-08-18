<?php // finalProject: functions.php
  $dbhost  = 'localhost';
  $dbname  = 'my_grove';
  $dbuser  = 'jake'; 
  $dbpass  = 'drysso';
  $appname = "My Grove";

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die($connection->connect_error);

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }

  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }

  function showProfile($user)
  {
    if (file_exists("profile/$user.jpg"))
      echo "<img src='profile/$user.jpg' style='float:left;'>";
  
	else
		echo "<img src='images/nobody.jpg' style='float:left;'>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

	echo "<div class='profile_description'>";
    
	if ($result->num_rows)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      	  
	  if (stripslashes($row['text']) == "") {
		  echo "no profile";
	  }
	  else
	  echo stripslashes($row['text']);
    }
	
	else {
		echo "no profile";
	}
	
	echo "</div>";
  }
  
  function addFriend ($user, $friend)
  {
		$blah = queryMysql("SELECT * FROM notices WHERE requested='$friend' AND requester='$user'");
		$request_you = $blah->num_rows;
		
		$blah = queryMysql("SELECT * FROM notices WHERE requested='$user' AND requester='$friend'");
		$request_me = $blah->num_rows;
		
	  if ($request_you == 0 && $request_me == 0)
	  {
		  $sql = queryMysql("INSERT INTO notices (requested, requester) VALUES ('$friend','$user')");
		  
		echo "<div class='main'>" . $friend . " has been sent a friend request.<br></div>";
	  }
	  elseif ($request_you == 1 && $request_me == 0)
	  {
		  echo "<div class='main'>You have already sent " . $friend . " a friend request.<br></div>";
	  }
	  
	  if ($request_me == 1)
	  {
		$add_friend = queryMysql("INSERT INTO friends (user, friend) VALUES ('$user', '$friend')");
		$add_friend = queryMysql("INSERT INTO friends (user, friend) VALUES ('$friend', '$user')");
		$add_friend = queryMysql("DELETE FROM notices WHERE requested='$user' AND requester='$friend'");
		$add_friend = queryMysql("DELETE FROM notices WHERE requested='$friend' AND requester='$user'");
		
		echo "<div class='main'>You and " . $friend . " are now friends.<br></div>";
	  }
	  
  }
  
  function removeFriend ($user, $friend)
  {
	$remove_friend = queryMysql("DELETE FROM friends WHERE user='$user' AND friend='$friend'");
	$remove_friend = queryMysql("DELETE FROM friends WHERE user='$friend' AND friend='$user'");
  }
  
  function addFooter ()
  {
	  echo "<div id='footer_wrapper'><footer>my grove brought to you by <img src='images/emerald_oak.png' alt='Emerald Oak'></footer></div>";
  }
  
  function deletePost($entry_num)
  {
	  $remove = queryMysql("DELETE FROM entries WHERE entry_num='$entry_num'");
	
  }
  
?>
