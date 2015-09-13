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
		<title>Register</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">		
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/signup-in-style.css">
		
		<script>
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
				<form action="submit.php" method="post">
					<h2>Sign Up</h2>
					<hr>
					First Name: <input type="text" name="first_name" size="50" maxlength="50" value="">
					<br><br>
					Last Name: <input type="text" name="last_name" size="50" maxlength="50" value="">
					<br><br>
					
					Gender:    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="sex" id="m" value="1">Male
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="sex" id="f" value="0">Female<br><br>
						
					Salutation:
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					
					<select id="mensalute" name="malesalute">
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
	
	</body>
</html>