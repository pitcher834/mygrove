<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // Example 26-3: setup.php
  require_once 'functions.php';




  createTable ('entries',
              'entry_user VARCHAR(16),
              entry_text VARCHAR(4096),
			  entry_num int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			  entry_date VARCHAR(26),
			  edit_date VARCHAR(46),
			  entry_destination VARCHAR(16),
              INDEX(entry_user(10))');
			  
	queryMysql("ALTER TABLE entries ADD FULLTEXT(entry_text)");

	
	
	
	
	
	?>

    <br>...done.
  </body>
</html>
