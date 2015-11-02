<!DOCTYPE html>
<?php
	if(isset($_GET['msg'])){	
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Message edited successfully!"); </script> <?php
		}
	}
	
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

	
    if (mysql_num_rows($rs) > 0){
        $row = mysql_fetch_array($rs);
        
        $message_id = $_GET['message_id'];
        $about = $row["about"];
    }
    
    $q = "SELECT message FROM message_board WHERE message_id =" . $message_id;
    $rs2 = mysql_query($q);
    $row2 = mysql_fetch_array($rs2);
    $message = $row2['message'];
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>SECUDEV: Landing Page</title>
		<link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
	<body>

		<div class="post_message">
			<h3>Edit your post on the Message Board</h3>


			<form class="message_box" action="posteditedmessage.php" method="post" id="msgform">
				<textarea name="message" rows="10" cols="50" placeholder="Enter message here" ><?php echo $message;?></textarea><br><br>
				<input type='hidden' name='message_id' value="<?php echo "$message_id"; ?>"/> 
				<input type="submit">
			</form>
		</div>
		<?php mysql_close(); ?>
	</body>
</html>
