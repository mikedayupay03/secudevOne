<?php
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "fail"){
			?> <script> alert("Please fill up all fields!"); </script> <?php
		} else if ($msg ==  "special"){
			?> <script> alert("Special Characters ()!#$%^&* are not allowed!"); </script> <?php
		} else if ($msg ==  "bday"){
			?> <script> alert("Invalid Date!"); </script> <?php
		} else if ($msg ==  "user"){
			?> <script> alert("Username already taken!"); </script> <?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Item</title>
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

		<!--<script>
		function checkFields() {
			document.getElementById("mensalute").disabled = true
			document.getElementById("femalesalute").disabled = true
			if (document.getElementById("m").checked) {
				document.getElementById("mensalute").disabled = false
			}
			if (document.getElementById("f").checked) {
				document.getElementById("femalesalute").disabled = false
			}
		}
		setInterval("checkFields()",0);
		</script>-->
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
				<form action="insertitem.php" method="post">
					<h2>Add Item</h2>
					<hr>
					Item name: <input type="text" name="item_name" size="50" maxlength="50" value="">
					<br><br>
					Description: <textarea rows="2" cols="50" name = "item_description" type = "text"></textarea>
					<br><br>
					Price: <input type="text" name="item_price" size="50" maxlength="50" value="">
					<br><br>
					Image: <input type="file" name="item_image" /><br />
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
