<?php
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$sql1 = "SELECT * FROM salutations";
$rs1 = mysql_query($sql1);
$salutations = mysql_fetch_array($rs1);
$strSQL = "SELECT COUNT(*) FROM userdb WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];
$bdate = new DateTime($_POST["bday"]);
$tdate = new DateTime(date("Y-m-d"));
$diff = $bdate->diff($tdate)->format("%y");

$required = array('first_name', 'last_name', 'sex', 'username', 'pass', 'bday', 'me');
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
	    header("location:register.php?msg=fail");
	} else if ($isSpecial){
		header("location:register.php?msg=special");
	}else if ($diff < 18) {
		header("location:register.php?msg=bday");
	}else if ($count == 1) {
		header("location:register.php?msg=user");
	} else {
		 if ($_POST["sex"] == 1) {
		  $strSQL = "INSERT INTO userdb(first_name,last_name,male,salutation,bday,username,password,about,admin) VALUES ('" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "'," . $_POST["sex"] . ",'" . $_POST["Select1"] . "','" . $_POST["bday"] . "','". $_POST["username"] . "','" . $_POST["pass"] . "','" . $_POST["me"] . "',0)";
		 } else if ($_POST["sex"] == 0) {
		  $strSQL = "INSERT INTO userdb(first_name,last_name,male,salutation,bday,username,password,about,admin) VALUES ('" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "'," . $_POST["sex"] . ",'" . $_POST["Select1"] . "','" . $_POST["bday"] . "','". $_POST["username"] . "','" . $_POST["pass"] . "','" . $_POST["me"] . "',0)";
		 }
		 mysql_query($strSQL);
		 header("location:index.php?msg=success");
	}



?>
