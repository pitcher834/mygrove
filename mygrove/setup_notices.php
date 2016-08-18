<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // Example 26-3: setup.php
  require_once 'functions.php';
  createTable('notices',
              'requested VARCHAR(16),
              requester VARCHAR(16),
			  INDEX(requester(6)),
              INDEX(requested(6))');
?>

    <br>...done.
  </body>
</html>
