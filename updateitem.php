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

$required = array('item_name', 'item_description', 'item_image', 'item_price');
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
	    header("location:edititem.php?msg=fail");
	} else if ($isSpecial){
		header("location:edititem.php?msg=special");
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
