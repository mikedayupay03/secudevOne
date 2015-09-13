<?php
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];
$bdate = new DateTime($_POST["bday"]);
$tdate = new DateTime(date("Y-m-d"));
$diff = $bdate->diff($tdate)->format("%y");
if (!preg_match("/^[a-zA-Z\s]+$/",$_POST["first_name"])) {
 header("location:register.php?msg=fail");
} else if (!preg_match("/^[a-zA-Z\s]+$/",$_POST["last_name"])) {
 header("location:register.php?msg=fail");
} else if ($diff < 18) {
 header("location:register.php?msg=bday");
} else if (!preg_match("/^[a-zA-Z0-9_]+$/",$_POST["username"])) {
 header("location:register.php?msg=fail");
} else if (!preg_match("/^[^\s]+$/",$_POST["pass"])) {
 header("location:register.php?msg=fail");
} else if ($count == 1) {
 header("location:register.php?msg=user");
} else {
 if ($_POST["sex"] == 1) {
  $strSQL = "INSERT INTO userdb(first_name,last_name,male,salutation,bday,username,password,about,admin) VALUES ('" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "'," . $_POST["sex"] . ",'" . $_POST["malesalute"] . "','" . $_POST["bday"] . "','". $_POST["username"] . "','" . $_POST["pass"] . "','" . $_POST["me"] . "',0)";
 } else if ($_POST["sex"] == 0) {
  $strSQL = "INSERT INTO userdb(first_name,last_name,male,salutation,bday,username,password,about,admin) VALUES ('" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "'," . $_POST["sex"] . ",'" . $_POST["femalesalute"] . "','" . $_POST["bday"] . "','". $_POST["username"] . "','" . $_POST["pass"] . "','" . $_POST["me"] . "',0)";
 }
 mysql_query($strSQL);
}

$strSQL = "SELECT * FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
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
