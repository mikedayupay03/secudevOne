<!DOCTYPE html>
<html>
	<head>
		<title></title>

	</head>
	<body>
		<?php
			if ($handle = opendir('.')) {
				while(false !== ($entry = readdir($handle))) {
					if($entry != "." && $entry != "..") {
						echo "<a href='" . $entry . "' download>" . $entry . "</a>";
					}
				}
			}
		?>



	</body>



</html>
