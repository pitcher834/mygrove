<?php // final project: edit.php

  require_once 'header.php';
  
  

  if (!$loggedin) die();  
  
  $entry_text = "";
  $entry_date = getDate();
  $entry_destination = "none";
  $entry_user = "guest";

  if (isset($_POST['entry_text']) && isset($_POST['entry_destination'])) 
  {
	  echo "<script>O('error').innerHTML = 'New record created successfully.'</script>";
	$entry_text = sanitizeString($_POST['entry_text']);
	$entry_date = sanitizeString($_POST['entry_date']);
	$entry_destination = sanitizeString($_POST['entry_destination']);
	$entry_user = sanitizeString($_POST['entry_user']);
  
    if ($entry_text == "" || $entry_destination == "none") {
        $error = "Not all fields were entered<br>";
	}
    else
    {
		$entry_insert = queryMysql("INSERT INTO entries (entry_text, entry_date, entry_destination, entry_user)
						VALUES ('$entry_text', '$entry_date', '$entry_destination', '$entry_user')");
							
	}
  
  }
  
  
  echo <<<_END
	<div class='main'>
	<span id='current_datetime'>current_datetime</span><br>
	
	<script>
	setInterval("showDate(O('current_datetime'))", 1000);
	window.onload = function() {document.getElementById('form_start').focus();};
	O('current_datetime').innerHTML = getDate();
	</script>
    
	<form method='post' action='edit.php' enctype='multipart/form-data'>
    <textarea name='entry_text' id='form_start' cols='168' rows='13'>$entry_text</textarea>
    <div id='compose_form'>

	<input type='hidden' name='entry_user' value='$user'>


	<input type='hidden' name='edit_date' value='the date' id='date_edit'>
	<input type='submit' value=' Save ' id='dest_post'>
	</div></form>
	<div id='error'></div></div><br>
_END;


	addFooter();
	echo "</body></html>";
?>	
