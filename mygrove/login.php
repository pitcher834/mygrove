<?php // final project: login.php
  require_once 'header.php';
  echo <<<_END
		<script>window.onload = function() {document.getElementById('form_start').focus();}</script>
		<div class='main'><h3>Please enter your details to log in</h3>
_END;
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
	$user = ucfirst(strtolower($user));
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else
    {
      $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;

        echo "You will be logged in momentarily or you can <a href='members.php?view=$user'>" .
            "click here</a> to manually log in.<br><br></div>";
		addFooter(); 
		echo "</body></html>" .
			'<script>setTimeout(function(){window.location.assign("members.php?view='.$user.'");}, 500);</script>';
		die();
      }
    }
	
  }

  echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span><input type='text' id='form_start'
      maxlength='16' name='user' value='$user'><br>
    <span class='fieldname'>Password</span><input type='password'
      maxlength='16' name='pass' value='$pass'>
	  <br><span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Login'>
    </form><br></div>

_END;

	addFooter();
	echo "</body></html>";
?>