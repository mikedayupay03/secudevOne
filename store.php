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
	//This code block is for deleting items
	$myusername = $_SESSION['myusername'];
	if(isset($_GET['item_id'])){
		$itemId = $_GET['item_id'];
		$query="DELETE FROM items WHERE item_id = '" . $itemId . "'";
		$result=mysql_query($query);
	}
   $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
   $rs = mysql_query($strSQL);
   $row = mysql_fetch_array($rs);
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>SECUDEV: Store</title>
		<link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			loadstation();
		});
		function loadstation(){
			$.ajax({
				url: "getitems.php",
				type: "GET",
				success: function(response) {
					$("#message_container").html(response);
					setTimeout(loadstation,5000);
				}
			});
		}
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
			<h1>WELCOME <?php echo $row[1] . " " . $row[2] ?>! <a href=""><img align="right" src= "res/cart.png" width="95" height="50"></a><a href="store.php"><img align="right" src= "res/store.png" width="95" height="50"></h1></a>
		</header>

		<div class="message_board">
			<a href ='logged.php'>Go Back</a>
			<h3>Store Items</h3>
			
			<?php	
				if($row['admin'] == 1){
					echo "<a href='additem.php'><button class='btn' type='button'><strong><center>Add Item</center></strong></button></a>";
					echo "</td>";
				}
			?>
			<div>
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
