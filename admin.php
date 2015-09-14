<?php
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	} else{
		$myusername = $_SESSION['myusername'];
		$admin = 0;
		mysql_connect("localhost","root","1234") or die (mysql_error());
		mysql_select_db("secudev1") or die (mysql_error());
		$result = mysql_query("SELECT admin FROM userdb WHERE username like '$myusername'");
		while ($row = mysql_fetch_assoc($result)) {
			$admin = $admin + $row['admin'];
			if ($admin == 0){
				header("Location:index.php");
			}
		}
	}
?>
<html>
<head>
<title>Register</title>
</head>
<body>
<script>
function checkFields() {
document.getElementById("mensalute").disabled = true
document.getElementById("femalesalute").disabled = true
if (document.getElementById("m").checked) {
document.getElementById("mensalute").disabled = false
}
if (document.getElementById("f").checked) {
document.getElementById("femalesalute").disabled = false
}
}
setInterval("checkFields()",0);
</script>
<form action="adminsubmit.php" method="post">
First Name: <input type="text" name="first_name"><br>
Last Name: <input type="text" name="last_name"><br>
Gender: <input type="radio" name="sex" id="m" value="1">Male
<input type="radio" name="sex" id="f" value="0">Female<br>
Salutation: <select id="mensalute" name="malesalute">
<option name="malesalute" value="Mr.">Mr.</option>
<option name="malesalute" value="Sir">Sir</option>
<option name="malesalute" value="Senior">Senior</option>
<option name="malesalute" value="Count">Count</option>
</select>
<select id="femalesalute" name="femalesalute">
<option name="femalesalute" value="Miss">Miss</option>
<option name="femalesalute" value="Ms.">Ms.</option>
<option name="femalesalute" value="Mrs.">Mrs.</option>
<option name="femalesalute" value="Madame">Madame</option>
<option name="femalesalute" value="Majesty">Majesty</option>
<option name="femalesalute" value="Seniora">Seniora</option>
</select><br>
Birthday: <input type="date" name="bday"><br>
Username: <input type="text" name="username"><br>
Password: <input type="password" name="pass"><br>
About Me: <br><textarea name="me" rows="4" cols="50"></textarea><br>
Admin Status: <select id="admin" name="admin">
<option name="admin" value="1">Admin</option>
<option name="admin" value="0">Normal</option>
</select><br>
<input type="submit">
</form>
</body>
</html>