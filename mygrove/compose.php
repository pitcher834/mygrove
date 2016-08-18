<?php // final project: compose.php

  require_once 'header.php';
  
  

  if (!$loggedin) die();  
  
  $entry_text = "";
  $entry_date = getDate();
  $entry_destination = "none";
  $entry_user = "guest";

  if (isset($_POST['entry_text']) && isset($_POST['entry_destination'])) {
	  echo "<script>O('error').innerHTML = 'New record created successfully.'</script>";
	$entry_text = sanitizeString($_POST['entry_text']);
	$entry_date = sanitizeString($_POST['entry_date']);
	$entry_destination = sanitizeString($_POST['entry_destination']);
	$entry_user = sanitizeString($_POST['entry_user']);
	$edit_date = "edit";
  
    if ($entry_text == "" || $entry_destination == "none") {
        $error = "Not all fields were entered<br>";
	}
    else
    {
		$entry_insert = queryMysql("INSERT INTO entries (entry_text, entry_date, entry_destination, entry_user, edit_date)
						VALUES ('$entry_text', '$entry_date', '$entry_destination', '$entry_user', '$edit_date')");
						
		if($entry_destination == 'journal'){
			echo <<<_END
			<script>
			setTimeout(function(){window.location.assign("journal.php?view='.$user.'");}, 500)
			</script>;
_END;
		}				
	
	else if($entry_destination == 'treehouse'){
			echo <<<_END
			<script>
			setTimeout(function(){window.location.assign("treehouse.php?view='.$user.'");}, 500)
			</script>;
_END;
		}				
	 else if($entry_destination == 'park'){
			echo <<<_END
			<script>
			setTimeout(function(){window.location.assign("park.php?view='.$user.'");}, 500)
			</script>;
_END;
		}				
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
    
	<form method='post' action='compose.php' enctype='multipart/form-data' onsubmit='return validatePost(this)'>
    <textarea name='entry_text' id='form_start'class='main_textarea' rows='13'>$entry_text</textarea>
    <div id='compose_form'>
	<span class='radio_buttons'>
	<input type='radio' name='entry_destination' value='journal' id='dest_journal'>
	<label class='dest' for='dest_journal'>Journal</label>
    <input type='radio' name='entry_destination' value='treehouse' id='dest_treehouse'>
	<label class='dest' for='dest_treehouse'>Treehouse</label>
    <input type='radio' name='entry_destination' value='park' id='dest_park'>
	<label class='dest' for='dest_park'>Park</label>
	</span>


	<input type='hidden' name='entry_user' value='$user'>


	<input type='hidden' name='entry_date' value='the date' id='date_submit'>
	<input type='submit' value=' Post To: ' id='dest_post'>
	</div></form>
	<div id='error'></div></div><br>
_END;


	addFooter();
	echo "</body></html>";
?>	
	