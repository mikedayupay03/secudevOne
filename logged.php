<!DOCTYPE html>
<?php

	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	$myusername = $_SESSION['myusername'];
   $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
   $rs = mysql_query($strSQL);
   $row = mysql_fetch_array($rs);

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>SECUDEV: Landing Page</title>
		<link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript">

		$(document).ready(function(){
			loadstation();
		});

		function loadstation(){
			$.ajax({
				url: "getmessages.php",
				type: "GET",
				success: function(response) {
					$("#message_container").html(response);
					setTimeout(loadstation,5000);
				}
			});
		}
			// function loadMessages() {
			// 	var xmlhttp;
			// 	if(window.XMLHttpRequest) {
			// 		xmlhttp = new XMLHttpRequest();
			// 	} else {
			// 		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// 	}
			//
			// 	xmlhttp.onreadystatechange = function () {
			// 		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			// 			document.getElementById("message_container").innerHTML = xmlhttp.responseText;
			// 		}
			// 	}
			//
			// 	xmlhttp.open("GET", "getMessages.php", true);
			// 	xmlhttp.send();
			// }

		</script>
	</head>
	<body>
		<header>
			<h1>WELCOME <?php echo $row[1] . " " . $row[2] ?>!</h1>
		</header>

		<div class="container">
			<h3>Personal Information</h3>
			<a href="editprofile.php">Edit Profile</a>
			<hr />
			<?php echo "First name: " . $row[1] . "<br>";
			echo "Last name: " . $row[2] . "<br>";
			if ($row[3] == 1) {
			 echo "Gender: Male<br>";
			} else {
			 echo "Gender: Female<br>";
			}
			echo "Salutation: " . $row[4] . "<br>";
			echo "Birthday: " . $row[5] . "<br>";
			echo "Username: " . $row[6] . "<br>";
			echo "About: " . $row[8];
			if ($row[9] == 1) {
			 echo "<br><a href=admin.php>Admin User Registration Page</a>";
			}
			echo "<br><br><a href=logout.php>Log Out</a>";
			?>

		</div>

		<div class="post_message">
			<h3>Post on the Message Board</h3>


			<form class="message_box" action="postmessage.php" method="post" id="msgform">
				<textarea name="message" rows="10" cols="50" placeholder="Enter message here" ></textarea><br><br>
				<input type="submit">
			</form>
		</div>

		<div class="message_board">
			<h3>Message Board</h3>
			<div id="message_container">

			</div>
		</div>
		<?php mysql_close(); ?>
	</body>
</html>
