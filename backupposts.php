<!DOCTYPE html>
<html>
	<head>
		<title></title>

	</head>
	<body>
		<?php
			if ($handle = opendir('backup/')) {
				while(false !== ($entry = readdir($handle))) {
					if($entry != "." && $entry != "..") {
						echo "<a href='backup/" . $entry . "' download>" . $entry . "</a><br/>";
					}
				}
			}
		?>



	</body>



</html>
