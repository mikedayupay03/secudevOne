<?php

	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	$myusername = $_SESSION['myusername'];
   $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
   $rs = mysql_query($strSQL);
   $row = mysql_fetch_array($rs);
    echo "First name: " . $row[1] . "<br>";
	echo "Last name: " . $row[2] . "<br>";
	if ($row[3] == 1) {
	 echo "Gender: Male<br>";
	} else {
	 echo "Gender: Female<br>";
	}
	echo "Salutation: " . $row[4] . "<br>";
	echo "Birthday: " . $row[5] . "<br>";
	echo "Username: " . $row[6] . "<br>";
	echo "About: " . $row[8];
	if ($row[9] == 1) {
	 echo "<br><a href=admin.php>Admin User Registration Page</a>";
	}
	echo "<br><a href=logout.php>Log Out</a>";
  
  mysql_close();
?>
