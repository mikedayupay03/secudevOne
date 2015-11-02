<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());


		$itemId = $_POST['item_id'];
		$strSQL = "SELECT COUNT(*) FROM items WHERE item_id = '" . $_POST["item_id"] . "'";
		$rs = mysql_query($strSQL);
		$row = mysql_fetch_array($rs);
		$count = $row[0];


$required = array('item_name', 'item_description', 'item_price');
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
		 $strSQL = "UPDATE items SET item_name = '" . $_POST["item_name"] . "', item_description = '" . $_POST["item_description"] . "', item_price = '" . $_POST["item_price"] . "' WHERE item_id = '" . $itemId . "'";
		 
		 mysql_query($strSQL);
		 header("location:store.php?msg=success");
	}



?>
