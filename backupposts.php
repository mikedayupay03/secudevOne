<!DOCTYPE html>
<html>
	<head>
		<title></title>

	</head>
	<body>
		<?php
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
