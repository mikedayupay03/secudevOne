<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$sql1 = "SELECT * FROM salutations";
$rs1 = mysql_query($sql1);
$salutations = mysql_fetch_array($rs1);
$strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_SESSION["myusername"] . "' AND password = '" . $_POST["pass"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];
$bdate = new DateTime($_POST["bday"]);
$tdate = new DateTime(date("Y-m-d"));
$diff = $bdate->diff($tdate)->format("%y");

$required = array('first_name', 'last_name', 'sex', 'pass', 'bday', 'me');
$error = false;
$isSpecial = false;

foreach($required as $field) {
		if (empty($_POST[$field]) || ctype_space($_POST[$field])) {
			$error = true;
		} else if (preg_match('/[\^£$%&*()}{#~?><>|=¬]/', $_POST[$field])){ //Check for special characters
			$isSpecial = true;
		}
	}

	if ($error) {
	    header("location:editprofile.php?msg=fail");
	} else if ($isSpecial){
		header("location:editprofile.php?msg=special");
	} else if (($_POST["sex"] == 1) && !($_POST["Select1"] == "Mr." || $_POST["Select1"] == "Sir" || $_POST["Select1"] == "Senior" || $_POST["Select1"] == "Count")) {
		header("location:editprofile.php?msg=salute");
	} else if (($_POST["sex"] == 2) && !($_POST["Select1"] == "Ms." || $_POST["Select1"] == "Mrs." || $_POST["Select1"] == "Madame" || $_POST["Select1"] == "Majesty" || $_POST["Select1"] == "Seniora")) {
		header("location:editprofile.php?msg=salute");
	} else if ($diff < 18) {
		header("location:editprofile.php?msg=bday");
	} else {
		 if ($_POST["sex"] == 1) {	
				$strSQL = "UPDATE userdb SET first_name = '" . $_POST["first_name"] . "', last_name = '" . $_POST["last_name"] . "', male = " . $_POST["sex"] . ", salutation = '" . $_POST["Select1"] . "', bday = '" . $_POST["bday"] . "', password = '" . $_POST["pass"] . "', about = '" . $_POST["me"] . "' WHERE username = '" . $_SESSION["myusername"] . "'";		
		 } else if ($_POST["sex"] == 2) {
				$strSQL = "UPDATE userdb SET first_name = '" . $_POST["first_name"] . "', last_name = '" . $_POST["last_name"] . "', male = " . '0' . ", salutation = '" . $_POST["Select1"] . "', bday = '" . $_POST["bday"] . "', password = '" . $_POST["pass"] . "', about = '" . $_POST["me"] . "' WHERE username = '" . $_SESSION["myusername"] . "'";	
		 }
		 mysql_query($strSQL);
		 header("location:logged.php?msg=success");
	}



?>
