<?php
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	$myusername = $_SESSION['myusername'];
	$itemId = $_GET['item_id'];
	
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "fail"){
			?> <script> alert("Please fill up all fields!"); </script> <?php
		} else if ($msg ==  "special"){
			?> <script> alert("Special Characters ()!#$%^&* are not allowed!"); </script> <?php
		}
	}
		
	$itemId = $_GET['item_id'];
	$query="SELECT * FROM items WHERE item_id = '" . $itemId . "'";
	$rs = mysql_query($query);
	
	
	if (mysql_num_rows($rs) > 0){
        $row = mysql_fetch_array($rs);

        $item_name = $row["item_name"];
        $item_description = $row["item_description"];
        $item_price = $row["item_price"];
        $item_image = $row["item_image"];
    }
	
	$myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Edit Item</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/signup-in-style.css">

		<script src="js/jquery.min.js"></script>
		<script>
			jQuery(function($) {
				// $('.0').hide();
				$('input:radio').change(function(){
					var val = $('input:radio:checked').val();
					$('#Select1').val(0);
					$('.0, .1').hide();
					$('.' + val).show();
				});

				$('input:radio').change(function(){
					var val = $('input#m:checked').val();
					var val1 = $('input#f:checked').val();
					if(val){
						$('#Select1').val(0);
						$('#mr').attr("selected", "true");
					}else if(val1) {
						$('#Select1').val(0);
						$('#ms').attr("selected", "true");
					}
				});

			});


		</script>

	</head>
	<body>

		<nav class="navbar navbar-static-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="" class="navbar-brand"><!--<img src="assets/images/TRACKME LOGO2.png" alt="Logo" class="logo">--></a>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="content">
				<form action="updateitem.php" method="post">
					<h2>Edit Item</h2>
					<hr>
					Item name: <input type="text" name="item_name" size="50" maxlength="50" value="<?php echo $item_name;?>">
					<br><br>
					Description: <textarea rows="2" cols="50" name = "item_description" type = "text"><?php echo $item_description;?></textarea>
					<br><br>
					Price: <input type="text" name="item_price" size="50" maxlength="50" value="<?php echo $item_price;?>">
					<br><br>
					Image: <input type="file" name="item_image" <?php echo $item_image;?>/><br />
					<input type="hidden" name="MAX_FILE_SIZE" value="4000000" />

				<input class="btn-danger" type="submit" name="additem" value="Submit">
				<a href="store.php">
						<button class="btn-danger" type="button" style="position: relative; top: 5px; width: 365px; height: 40px;">Cancel</button>
				</a>
				</form>
			</div>
		</div><!-- container -->

	</body>
</html>
