<?php
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$strSQL = "SELECT COUNT(*) FROM items WHERE item_name = '" . $_POST["item_name"] . "'";
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
	    header("location:store.php?msg=fail");
	} else if ($isSpecial){
		header("location:store.php?msg=special");
	} else {
		 $strSQL = "INSERT INTO items(item_name,item_description,item_price) VALUES ('" . $_POST["item_name"] . "', '" . $_POST["item_description"] . "','" . $_POST["item_price"] . "')";
		 mysql_query($strSQL);
		 header("location:store.php?msg=success");
		 }
?>
