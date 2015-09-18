<?php
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "fail"){
			?> <script> alert("Please fill up all fields! Special Characters are not allowed."); </script> <?php
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
		<title>Profile Settings</title>
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
				<form action="#" method="post">
					<h2>Basic Information</h2>
					<hr>
					First Name: <input type="text" name="first_name" size="50" maxlength="50" value="">
					<br><br>
					Last Name: <input type="text" name="last_name" size="50" maxlength="50" value="">
					<br><br>

					<input id="m" name="sex" type="radio" value="1"/>Male<br />
					<input id="f" name="sex" type="radio" value="0" />Female<br /><br />

					<select id="Select1" name="Select1">
						<option name="malesalute" value="Mr." class="1" id="mr">Mr.</option>
						<option name="malesalute" value="Sir" class="1">Sir</option>
						<option name="malesalute" value="Senior" class="1">Senior</option>
						<option name="malesalute" value="Count" class="1">Count</option>
						<option name="femalesalute" value="Miss" class="0">Miss</option>
						<option name="femalesalute" value="Ms." class="0" id="ms">Ms.</option>
						<option name="femalesalute" value="Mrs." class="0">Mrs.</option>
						<option name="femalesalute" value="Madame" class="0">Madame</option>
						<option name="femalesalute" value="Majesty" class="0">Majesty</option>
						<option name="femalesalute" value="Seniora" class="0">Seniora</option>
					</select><br><br>
					
				<div id="bday-content">
					Birthday: <input type="date" name="bday">
				</div>
				<br>

				About Me: <br><textarea name="me" rows="2" cols="50"></textarea>

				<input class="btn-danger" type="submit" name="submit" value="Save Changes">
				</form>
			</div>
		</div><!-- container -->

	</body>
</html>