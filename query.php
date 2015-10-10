<?php
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}

	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	$x = $_POST["squery"];
	$strSQL = "SELECT a.message,a.date_posted,b.username FROM message_board a,userdb b WHERE a.user_id = b.user_id AND LOWER(a.message) LIKE '%" . strtolower($x) . "%'";
	$rs = mysql_query($strSQL);
	echo "<table border=1 style=width:100%>\n<tr>\n<td>Message</td>\n<td>Date posted</td>\n<td>User</td>\n</tr>\n";
	while ($row = mysql_fetch_array($rs)) {
		echo "<tr>\n<td>" . $row["message"] . "</td>\n<td>" . $row["date_posted"] . "</td>\n<td>" . $row["username"] . "</td>\n</tr>\n";
	}
	echo "</table>";
	echo "<br><a href=logged.php>Go Back</a>";
	mysql_close();
?>