<!DOCTYPE html>
<html>
	<head>
		<title></title>

	</head>
	<body>
		<?php
			if ($handle = opendir('.csv')) {
				while(false !== ($entry = readdir($handle))) {
					if($entry != "." && $entry != "..") {
						echo "<a href='" . $entry . "' download>" . $entry . "</a><br/>";
					}
				}
			}
		?>



	</body>



</html>
