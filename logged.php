<!DOCTYPE html>
<?php
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Profile edited successfully!"); </script> <?php
		}
		else if ($msg ==  "export"){
			?> <script> alert("Export Successful"); </script> <?php
		}
	}
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
	mysql_connect("localhost","root","1234") or die (mysql_error());
	mysql_select_db("secudev1") or die (mysql_error());
	//This code block is for deleting messages
	$myusername = $_SESSION['myusername'];
	if(isset($_GET['message_id'])){
		$messageId = $_GET['message_id'];
		$query="DELETE FROM message_board WHERE message_id like '$messageId'";
		$result=mysql_query($query);
		$query = "UPDATE badges a , userdb b SET a.posts = a.posts - 1 WHERE b.username = '" . $myusername . "'";
		$result=mysql_query($query);
	}
   $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
   $rs = mysql_query($strSQL);
   $row = mysql_fetch_array($rs);
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>SECUDEV: Landing Page</title>
		<link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
		<script src="js/jquery.min.js"></script>
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
        <script>
            function logoutFunction(){
                $("input#logout").val(1);
                // alert($("input#logout").val());
                $("form#logoutForm").submit();
            }
        </script>
        <script>
        $(document).ready(function(){
			$("#advanced").hide();
            $("#hideButton").hide();
		});
        
        function toggle (advanced){
            if(advanced){
                $("#advanced").show();
                $("#advancedButton").hide();
                $("#hideButton").show();
            } else{
                $("#advanced").hide();
                $("#advancedButton").show();
                $("#hideButton").hide();
            }
        }
        
        </script>
        <script>
            var a = 0;
            var b = 0;
            var elem = 1;
            /*function moreDates() {
                elem = this;
                var newDiv = document.createElement('div');
                alert(elem.value);
            }*/
            function addUsers(name) {
                var newDiv = document.createElement('div');
                newDiv.innerHTML = "<div class='sname'><select name='cond'><option value=AND>AND</option><option value=OR>OR</option></select> &nbsp; Input user " + a + ": <input type=text name=suser[]></div><br>";
                document.getElementById("testing2").appendChild(newDiv);
                a++;
            }
            function addDates(name) {
                var newDiv = document.createElement('div');
                newDiv.innerHTML = "<br><div id=container><div id=temp2 style= display:inline;><select name='cond'><option value=AND>AND</option><option value=OR>OR</option></select> <select id=doption" + b + "  name=doption[] onchange=myFunction('doption" + b + "','hider" + b + "')><option value=1>Between</option><option value=2>Earlier</option><option value=3>Later</option><option value=4>During</option></select></div> <div id=temp style= display:inline;><input type=date name='d0[]'> <input type=date id=hider" + b + " name=d1[]></div></div>";
                document.getElementById("testing").appendChild(newDiv);
                b++;
            }
            
            function myFunction(name1,name2) {
                var x = document.getElementById(name1).value;
                if (x == 1) {
                    document.getElementById(name2).style.visibility = "visible";
                } else {
                    document.getElementById(name2).style.visibility = "hidden";
                }
            }
    </script>
	</head>
	<body>
        <form id="logoutForm" action="logout.php" method="POST">
            <input type="hidden" name="logout" id="logout"/>
        </form>
		<header>
			<h1>WELCOME <?php echo $row[1] . " " . $row[2] ?>! <a href="cart.php"><img align="right" src= "res/cart.png" width="95" height="50"></a><a href="store.php"><img align="right" src= "res/store.png" width="95" height="50"></h1></a>
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
			echo "About: " . $row[8] . "<br>";
			echo "Badges: <ul>";
			$query = "SELECT a.posts,a.donations,a.purchases FROM badges a , userdb b WHERE b.username = '" . $myusername . "'";
			$result = mysql_fetch_array(mysql_query($query));
			$a = $result[0];
			$b = $result[1];
			$c = $result[2];
			if ($a >= 10) {
				echo "<li>Socialite<img src=socialite.png></li>";
			} else if ($a >= 5) {
				echo "<li>Chatter<img src=chatter.png></li>";
			} else if ($a >= 3) {
				echo "<li>Participant<img src=participant.png></li>";
			}
			if ($b >= 100) {
				echo "<li>Pillar<img src=pillar.png></li>";
			} else if ($b >= 20) {
				echo "<li>Contributor<img src=contributor.png></li>";
			} else if ($b >= 5) {
				echo "<li>Supporter<img src=supporter.png></li>";
			}
			if ($c >= 100) {
				echo "<li>Elite<img src=elite.png></li>";
			} else if ($c >= 20) {
				echo "<li>Promoter<img src=promoter.png></li>";
			} else if ($c >= 5) {
				echo "<li>Shopper<img src=shopper.png></li>";
			}
			if ($a >= 10 && $b >= 100 && $c >= 100) {
				echo "<li>Evangelist<img src=evangelist.png></li>";
			} else if ($a >= 5 && $b >= 20 && $c >= 20)) {
				echo "<li>Backer<img src=backer.png></li>";
			} else if ($a >= 3 && $b >= 5 && $c >= 5) {
				echo "<li>Explorer<img src=explorer.png></li>";
			}
			echo "</ul>";
			if ($row[9] == 1) {
			 echo "<br><a href=admin.php>Admin User Registration Page</a>";
			}
			echo "<br><br><a href='#' onclick='logoutFunction();'>Log Out</a>";
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
			<div>
				<form method="post" action="query.php">
				Search messages: <input type="text" name="squery">
				<input type="submit"/>
				<button type="button" id="advancedButton" onclick="toggle(1)">Advanced Search</button>
		
				<?php
					if($row['admin'] == 1){
						echo "<br><a href='export.php'>Backup Posts</a><br>";
						echo "<a href='backupposts.php'>See Backup Posts</a>";
					}
				 ?>
               
                <button type="button" id="hideButton" style="position:absolute; left:375px; top: 505px;" onclick="toggle(0)">Hide Advanced Search</button>
                <div id="advanced">
                <div id="testing"></div><br>
                <div id="testing2"></div>
                    <input type="button" value='Specify dates' onClick=addDates('testing')>
                    <input type="button" value='Specify users' onClick=addUsers('testing')>

                </div>
                </form>
			</div>
			<hr>
			<div id="message_container">

			</div>
		</div>
		<?php mysql_close(); ?>
	</body>
</html>
