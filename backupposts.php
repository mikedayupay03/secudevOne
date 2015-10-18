<!DOCTYPE html>
<html>
	<head>
		<title></title>

	</head>
	<body>
		<?php
			error_reporting(0);
			session_start();
			if(!isset($_SESSION['myusername'])){ //if login in session is not set
			header("Location:index.php");
			}
			
			if ($handle = opendir('backup/')) {
				echo "Existing Backup Files <br>";
				while(false !== ($entry = readdir($handle))) {
					if($entry != "." && $entry != "..") {
						echo "<a href='backup/" . $entry . "' download>" . $entry . "</a><br/>";
					}
				}
				echo "<br/><a href='logged.php'>Go Back</a>";
			}
		?>



	</body>



</html>
