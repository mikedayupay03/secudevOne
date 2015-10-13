<?php

	mysql_connect("localhost", "root", "1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());

	$messageQuery = "SELECT u.username, m.message, m.date_posted FROM message_board AS m, userdb AS u WHERE m.user_id = u.user_id";
	$rs = mysql_query($messageQuery);
	
	$today = date("jS F Y");
	echo $today . "<br>";

	$fileName = "backup-" . $today . ".csv";
	
	$myfile = fopen($fileName, "w") or die ("Unable to open file!");

	$columnName = "username, message, date posted\n";
	fwrite($myfile, $columnName);

	while ($row = mysql_fetch_array($rs)) {

		$messageRow = $row['username'] . ", " . $row['message'] . ", " . $row['date_posted'] . "\n";
		fwrite($myfile, $messageRow);

	}

	mysql_close();
	header("location:logged.php");




?>
