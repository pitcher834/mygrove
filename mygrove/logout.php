<?php // final project: logout.php
  require_once 'header.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    echo "<div class='main'>You will be logged out shortly or you can " .
         "<a href='index.php'>click here</a> to log out manually.";
  }
  else echo "<div class='main'><br>" .
            "You cannot log out because you are not logged in";
?>
	<script>
		setTimeout(function(){window.location.assign("index.php");}, 500);
	</script>
    <br><br></div>
<?php
	addFooter();
?>
  </body>
</html>
