<?php
<<<<<<< HEAD
  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());
  $strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
  $rs = mysql_query($strSQL);
  $row = mysql_fetch_array($rs);
  $count = $row[0];
  if ($count == 1) {
   $strSQL = "SELECT * FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
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
   echo "Password: " . $row[6] . "<br>";
   echo "About: " . $row[7];
   if ($row[8] == 1) {
    echo "<br><a href=admin.html>Admin User Registration Page</a>";
   }
  } else {
   echo "No account with username/password combination found.";
  }
  mysql_close();
?>
=======
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];
if ($count == 1) {
 $strSQL = "SELECT * FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
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
} else {
 echo "Incorrect username/password.";
}
mysql_close();
?>
>>>>>>> e6e240acd6bc59f52ac16008e77c91c052c07806
