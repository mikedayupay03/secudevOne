<?php
	session_start();
    
    require_once '/htmlpurifier-4.7.0/library/HTMLPurifier.auto.php';

	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);

	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	
	// Loop over field names, make sure each one exists and is not empty
	$required = array('message');
	$error = false;
	$isSpecial = false;
	foreach($required as $field) {
		if (empty($_POST[$field]) || ctype_space($_POST[$field])) {
			$error = true;
		}
	}
	
	$message_id = $_POST['message_id'];
    $editedMessage = $_POST["message"];
	$editedMessage = $purifier->purify($editedMessage);
    $editedMessage = mysql_real_escape_string($editedMessage);
	if ($error) {
	    header("location:profile.php?msg=fail");
	} else if ($isSpecial){
		header("location:profile.php?msg=special");
	} else {
		
			$query = "UPDATE message_board SET message='" . $editedMessage . "',edited_date= CURRENT_TIMESTAMP WHERE message_id = " . $message_id;
			
		
		$result = mysql_query($query);
		echo "message id " . $message_id;
		echo $result;
		echo mysql_error();
		header("location:logged.php?msg=success");
	}
	

?>