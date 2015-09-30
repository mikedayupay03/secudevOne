<html>
<head>
<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
mysql_close();
$myusername = $_SESSION['myusername'];
?>
</head>
<body>
<form method=post action=query.php>
Search query: <input type=text name=squery><br>
<input type=submit>
</form>
</body>
</html>