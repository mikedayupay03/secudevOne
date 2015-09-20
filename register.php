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
		} else if ($msg ==  "salute"){
			?> <script> alert("Invalid Salutation!"); </script> <?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/signup-in-style.css">

		<script src="js/jquery.min.js"></script>
		<script src="js/gen_validatorv4.js" type="text/javascript"></script>
		<script>
			jQuery(function($) {
				// $('.0').hide();
				$('input:radio').change(function(){
					var val = $('input:radio:checked').val();
					$('#Select1').val(0);
					$('.2, .1').hide();
					$('.' + val).show();
				});

				$('input:radio').change(function(){
					var val = $('input#m:checked').val();
					var val1 = $('input#f:checked').val();
					if(val){
						$('#Select1').val('Mr.');
						$('#mr').attr("selected", "true");
					}else if(val1) {
						$('#Select1').val('Ms.');
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
				<form id="form1" action="submit.php" method="post">
					<h2>Sign Up</h2>
					<hr>
					First Name: <input type="text" name="first_name" size="50" maxlength="50" value="">
					<br><br>
					Last Name: <input type="text" name="last_name" size="50" maxlength="50" value="">
					<br><br>


					<!-- Gender:    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<!--<input type="radio" name="sex" id="m" value="1">Male-->
					<!--	<input id="m" name="sex" type="radio" value="1">Male
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f" name="sex" type="radio" value="0">Female<br><br>
					Salutation:
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<!--<select id="mensalute" name="malesalute">
					  <option name="malesalute" value="Mr.">Mr.</option>
					  <option name="malesalute" value="Sir">Sir</option>
					  <option name="malesalute" value="Senior">Senior</option>
					  <option name="malesalute" value="Count">Count</option>
					</select>
					<select id="femalesalute" name="femalesalute">
					  <option name="femalesalute" value="Miss">Miss</option>
					  <option name="femalesalute" value="Ms.">Ms.</option>
					  <option name="femalesalute" value="Mrs.">Mrs.</option>
					  <option name="femalesalute" value="Madame">Madame</option>
					  <option name="femalesalute" value="Majesty">Majesty</option>
					  <option name="femalesalute" value="Seniora">Seniora</option>
					</select><br><br>-->

					<input id="m" name="sex" type="radio" value="1"/>Male<br />
					<input id="f" name="sex" type="radio" value="2" />Female<br />

					<select id="Select1" name="Select1">
						<option name="malesalute" value="Mr." class="1" id="mr">Mr.</option>
						<option name="malesalute" value="Sir" class="1">Sir</option>
						<option name="malesalute" value="Senior" class="1">Senior</option>
						<option name="malesalute" value="Count" class="1">Count</option>
						<option name="femalesalute" value="Ms." class="2" id="ms">Ms.</option>
						<option name="femalesalute" value="Mrs." class="2">Mrs.</option>
						<option name="femalesalute" value="Madame" class="2">Madame</option>
						<option name="femalesalute" value="Majesty" class="2">Majesty</option>
						<option name="femalesalute" value="Seniora" class="2">Seniora</option>
						<!--<option value="HO-House 1" class="house">House 1</option>
						<option value="HO-House 2" class="house">House 2</option>
						<option value="HO-House 3" class="house">House 3</option>
						<option value="CO-Condo 1" class="condo">Condo 1</option>
						<option value="CO-Condo 2" class="condo">Condo 2</option>
						<option value="CO-Condo 3" class="condo">Condo 3</option>-->
					</select><br><br>

					Username: <input type="text" name="username" size="30" value="">
					<br><br>
					Password: <input type="password" name="pass" size="20" value="">
					<br><br>


				<div id="bday-content">
					Birthday: <input type="date" name="bday">
				</div>
				<br>

				About Me: <br><textarea name="me" rows="2" cols="50"></textarea><br><br>

				<input class="btn-danger" type="submit" name="submit" value="Sign up">
				</form>
			</div>
		</div><!-- container -->
	
		<script type="text/javascript">
		 var frmvalidator = new Validator("form1");
		 frmvalidator.addValidation("first_name","req","Please enter your first name");
		 frmvalidator.addValidation("first_name","maxlen=50","Max length for first name is 50");
		 frmvalidator.addValidation("first_name","alnum_s","Special Characters are not allowed");
		 
		 frmvalidator.addValidation("last_name","req","Please enter your last name");
		 frmvalidator.addValidation("last_name","maxlen=50","Max length for last name is 50");
		 frmvalidator.addValidation("last_name","alnum_s","Special Characters are not allowed");
		 
		 frmvalidator.addValidation("sex","selone_radio","Please select your gender");
		 
		 frmvalidator.addValidation("username","req","Please enter a username");
		 frmvalidator.addValidation("username","alnum","Special characters are not allowed");
		 frmvalidator.addValidation("username","maxlen=50","Max length for username is 50");
		 
		 frmvalidator.addValidation("pass","req","Please enter a password");
		 frmvalidator.addValidation("pass","alnum","Special characters are not allowed");
		 frmvalidator.addValidation("pass","maxlen=50","Max length for username is 50");
		 
		 frmvalidator.addValidation("me","req","Please enter something about you");
		</script>
	</body>
</html>
