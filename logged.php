<?php

	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	$myusername = $_SESSION['myusername'];
	}

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());
  $strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
  $rs = mysql_query($strSQL);
  $row = mysql_fetch_array($rs);
  $count = $row[0];
  if ($count == 1) {
   session_start();
   $strSQL = "SELECT * FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
   $rs = mysql_query($strSQL);
   $row = mysql_fetch_array($rs);
   $_SESSION['myusername'] = $row[6];
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
  } else {
	header("location:index.php?message=Wrong Email or Password");
  }
  mysql_close();
?>
