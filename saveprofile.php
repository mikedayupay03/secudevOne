<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$strSQL = "UPDATE userdb SET first_name = '" . $_POST["first_name"] . "', last_name = '" . $_POST["last_name"] . "', male = " . $_POST["male"] . ", salutation = '" . $_POST["salutation"] . "', bday = '" . $_POST["bday"] . "', password = '" . $_POST["password"] . "', about = '" . $_POST["about"] . "' WHERE username = '" . $_SESSION["myusername"] . "'";
mysql_query($strSQL);
mysql_close();
header("Location:logged.php");
?>