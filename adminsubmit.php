<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];
$bdate = new DateTime($_POST["bday"]);
$tdate = new DateTime(date("Y-m-d"));
$diff = $bdate->diff($tdate)->format("%y");
if (!preg_match("/^[a-zA-Z\s]+$/",$_POST["fullname"])) {
 echo "Invalid name";
} else if ($diff < 18) {
 echo "Invalid date";
} else if (!preg_match("/^[a-zA-Z0-9_]+$/",$_POST["username"])) {
 echo "Invalid username";
} else if (!preg_match("/^[^\s]+$/",$_POST["pass"])) {
 echo "Invalid password";
} else if ($count == 1) {
 echo "Username/password combination already taken";
} else {
 if ($_POST["sex"] == 1) {
  $strSQL = "INSERT INTO userdb(name,male,salutation,bday,username,password,about,admin) VALUES ('" . $_POST["fullname"] . "'," . $_POST["sex"] . ",'" . $_POST["malesalute"] . "','" . $_POST["bday"] . "','". $_POST["username"] . "','" . $_POST["pass"] . "','" . $_POST["me"] . "'," . $_POST["admin"] . ")";
 } else if ($_POST["sex"] == 0) {
  $strSQL = "INSERT INTO userdb(name,male,salutation,bday,username,password,about,admin) VALUES ('" . $_POST["fullname"] . "'," . $_POST["sex"] . ",'" . $_POST["femalesalute"] . "','" . $_POST["bday"] . "','". $_POST["username"] . "','" . $_POST["pass"] . "','" . $_POST["me"] . "'," . $_POST["admin"] . ")";
 }
 mysql_query($strSQL);
}
$myusername = $_SESSION['myusername'];
$strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername ."'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
echo "Full name: " . $row[1] . "<br>";
if ($row[2] == 1) {
 echo "Gender: Male<br>";
} else {
 echo "Gender: Female<br>";
}
echo "Salutation: " . $row[3] . "<br>";
echo "Birthday: " . $row[4] . "<br>";
echo "Username: " . $row[5] . "<br>";
echo "About: " . $row[7];
if ($row[8] == 1) {
 echo "<br><a href=admin.html>Admin User Registration Page</a>";
}

mysql_close();
?>
