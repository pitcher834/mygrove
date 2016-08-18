<?php  //final project:  journal.php
  require_once 'header.php';
  
  
  if (!$loggedin) die();

  
     $result = queryMySQL("SELECT * FROM entries WHERE entry_user='$user' AND entry_destination='journal'");
		
		
	$rows = $result->num_rows;
  
	echo <<<_END
		<div class='main'>
		<div class='page_header'>
		Journal -
		<span id='current_datetime'></span><br>
		</div>
		<div id='my_journal'>
_END;

	
	for ($j = 0 ; $j < $rows ; ++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$entry_num = $row['entry_num'];
		$entry_text = $row['entry_text'];
		$destination = "journal.php";
		echo "<div class='journal_date'>" . $row['entry_date'];
		echo "<form method='post' action='journal.php'>";
		if ($user == $row['entry_user'])
		{
			echo(' - <span class="edit" onclick="editPost(\''. addslashes($entry_text).'\', '. $entry_num . ', \''. $destination.'\')">');
			echo $row['edit_date'] ."</span> - <input type='submit' class='button' name='delete$entry_num' value='Delete'>";
			echo "</div>";
		}
		echo "<div id='edit$entry_num'>" . $entry_text . "</div><br>";
		
		echo "<br>";
		
		if(isset($_POST['delete' .$entry_num]))
		{
			$remove = queryMysql("DELETE FROM entries WHERE entry_num='$entry_num'");
			echo "<script>window.location.assign('" .$destination."')</script>";
		}
		
		if(isset($_POST['post' .$entry_num]))
		{
    
			$text = sanitizeString($_POST["entry_text"]);
			$text = preg_replace('/\s\s+/', ' ', $text);
		
			$edit_date = date('\e\d\i\t\e\d M j Y \a\t h:ia');
		
			queryMysql("UPDATE entries SET edit_date='$edit_date' where entry_num='$entry_num'");
			queryMysql("UPDATE entries SET entry_text='$text' where entry_num='$entry_num'");
			echo "<script>window.location.assign('" .$destination."')</script>";
		}

	}	
	echo "</form>";
	echo <<<_END
			</div>
		</div>	
		
	<script>
	setInterval("showDate(O('current_datetime'))", 1000);
	window.onload = function() {document.getElementById('form_start').focus();};
	O('current_datetime').innerHTML = getDate();
	
	</script>
_END;

		addFooter();
	echo "</body></html>";
?>