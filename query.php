<?php
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
	$n = $_POST["suser"];
	$o = $_POST["doption"];
	$p = $_POST["d0"];
	$q = $_POST["d1"];
	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	$x = $_POST["squery"];
	if (count($n) > 0 && count($o) > 0) {
		$strSQL = "SELECT a.message,a.date_posted,b.username FROM message_board a,userdb b WHERE a.user_id = b.user_id AND LOWER(a.message) LIKE '%" . strtolower($x) . "%' AND ((";
		for ($b = 0 ; $b < count($o) ; $b++) {
			if ($o[$b] == 1) { // between
 				$strSQL = $strSQL . "a.date_posted >= '" . $p[$b] . "' AND a.date_posted <= '" . $q[$b] . "'";
			} else if ($o[$b] == 2) { //earlier
				$strSQL = $strSQL . "a.date_posted <= '" . $p[$b] . "'";
			} else if ($o[$b] == 3) { //later
				$strSQL = $strSQL . "a.date_posted >= '" . $p[$b] . "'";
			} else if ($o[$b] == 4) { //exactly
				$strSQL = $strSQL . "a.date_posted LIKE '%" . $p[$b] . "%'";
			}
			if ($b != count($o) - 1) {
				$strSQL = $strSQL . " OR ";
			}
		}
		$strSQL = $strSQL . ") " . $_POST["cond"] . " (";
		for ($a = 0 ; $a < count($n) ; $a++) {
			$strSQL = $strSQL . "b.username = '" . $n[$a] . "'";
			if ($a != count($n) - 1) {
				$strSQL = $strSQL . " OR ";
			}
		}
		$strSQL = $strSQL . "))";
	} else if (count($n) > 0) {
		$strSQL = "SELECT a.message,a.date_posted,b.username FROM message_board a,userdb b WHERE a.user_id = b.user_id AND LOWER(a.message) LIKE '%" . strtolower($x) . "%' AND (";
		for ($a = 0 ; $a < count($n) ; $a++) {
			$strSQL = $strSQL . "b.username = '" . $n[$a] . "'";
			if ($a != count($n) - 1) {
				$strSQL = $strSQL . " OR ";
			}
		}
		$strSQL = $strSQL . ")";
	} else if (count($o) > 0){
		$strSQL = "SELECT a.message,a.date_posted,b.username FROM message_board a,userdb b WHERE a.user_id = b.user_id AND LOWER(a.message) LIKE '%" . strtolower($x) . "%' AND (";
		for ($b = 0 ; $b < count($o) ; $b++) {
			if ($o[$b] == 1) {
				$strSQL = $strSQL . "(a.date_posted >= '" . $p[$b] . "' AND a.date_posted <= '" . $q[$b] . "') OR a.date_posted LIKE '%" . $p[$b] . "%' OR a.date_posted LIKE '%" . $q[$b] . "%'";
			} else if ($o[$b] == 2) {
				$strSQL = $strSQL . "a.date_posted < '" . $p[$b] . "' OR a.date_posted LIKE '%" . $p[$b] . "%'";
			} else if ($o[$b] == 3) {
				$strSQL = $strSQL . "a.date_posted > '" . $p[$b] . "' OR a.date_posted LIKE '%" . $p[$b] . "%'";
			} else if ($o[$b] == 4) {
				$strSQL = $strSQL . "a.date_posted LIKE '%" . $p[$b] . "%'";
			}
			if ($b != count($o) - 1) {
				$strSQL = $strSQL . " OR ";
			}
		}
		$strSQL = $strSQL . ")";
	} else {
		$strSQL = "SELECT a.message,a.date_posted,b.username FROM message_board a,userdb b WHERE a.user_id = b.user_id AND LOWER(a.message) LIKE '%" . strtolower($x) . "%'";
	}
	$rs = mysql_query($strSQL);
echo mysql_error();
	echo "<table border=1 style=width:100%>\n<tr>\n<td>Message</td>\n<td>Date posted</td>\n<td>User</td>\n</tr>\n";
	while ($row = mysql_fetch_array($rs)) {
		echo "<tr>\n<td>" . $row["message"] . "</td>\n<td>" . $row["date_posted"] . "</td>\n<td>" . $row["username"] . "</td>\n</tr>\n";
	
	}
	echo "</table>";
	echo "<br><a href=logged.php>Go Back</a>";
	mysql_close();
?>