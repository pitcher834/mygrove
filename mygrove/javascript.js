// final project: javascript.js

function O(i) { return typeof i == 'object' ? i : document.getElementById(i) }
function S(i) { return O(i).style                                            }
function C(i) { return document.getElementsByClassName(i)                    }


function getDate() {
	var date = new Date();
	var hour = date.getHours();
	var amPM = "am";

	if(hour > 12){
		hour = hour - 12;
		amPM = "pm";
	}
	else if (hour == 0) {hour = 12;}
	var n = date.getMinutes()
	var minutes = n<10 ? '0'+n : n
	return date.toDateString() + " - " + hour + ":" + minutes + amPM;
}

function showDate(at) {
	at.innerHTML = getDate();
}

function validatePost(form) {
	O('date_submit').value = getDate()
	if(form.entry_text.value == "") {
		O('error').innerHTML = "Writers block getting you?  Feel free to go hang out, you can always come back.<br>";
		return false
	}
	else if(form.destination.value == "") {
		O('error').innerHTML = "No post location was selected.<br>";
		return false
	}
	else return true;
}

function editPost(message, place, destination) {
	O("edit" + place).innerHTML = "<form method='post' action='" + destination + "' enctype='multipart/form-data'><textarea name='entry_text' " +
				"id='form_start' class='main_textarea' rows='5'>" + message + "</textarea><br><input type ='submit' name='post" + place + "' value='save'></form>";
	
}

function deletePost(place, destination) {
	
//	O("edit" + place).innerHTML = "<form method='post' action='" + destination + "' enctype='multipart/form-data'><input type ='submit' name='delete" + place + "' value='delete'>";
	
}