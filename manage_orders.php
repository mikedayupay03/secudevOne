<?php
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
        header("Location:index.php");
	}else {
    if(!($_SESSION['admin'])) {

    header("Location:logged.php");	
    }
    }

	include_once 'db.php';
    
    //code block for deleting an order
	if(isset($_GET['customer_id'])){
		$customerId = $_GET['customer_id'];
		$orderId = $_GET['order_id'];
        connect();
        $query="DELETE FROM cart WHERE customer_id like '$customerId'";$result=mysql_query($query);
		$query="DELETE FROM orders WHERE order_id like '$orderId'";$result=mysql_query($query);
		$query="SELECT * FROM orders WHERE customer_id like '$customerId'";$result=mysql_query($query);
		$count=mysql_num_rows($result);
		if($count == 0){
			$query="DELETE FROM customer WHERE customer_id like '$customerId'";$result=mysql_query($query);
		}
		mysql_close();
	}
    
    $myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
?>

<!DOCTYPE html>
<html>
<head>
	<title>MANAGE ORDERS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"charset="utf-8">
    <link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
    <script src="js/jquery.min.js"></script>
    <script>
            function logoutFunction(){
                $("input#logout").val(1);
                // alert($("input#logout").val());
                $("form#logoutForm").submit();
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

            function addDates(name) {
                var newDiv = document.createElement('div');
                newDiv.innerHTML = "<br><div id=container><div id=temp2 style= display:inline;><select name='cond'><option value=AND>AND</option><option value=OR>OR</option></select> <select id=doption" + b + "  name=doption[] onchange=myFunction('doption" + b + "','hider" + b + "')><option value=1>Between</option><option value=2>Earlier</option><option value=3>Later</option><option value=4>During</option></select></div> <div id=temp style= display:inline;><input type=date name='d0[]'> <input type=date id=hider" + b + " name=d1[]></div></div>";
                document.getElementById("testing").appendChild(newDiv);
                b++;
            }
    </script>
</head>
<body>
    <header>
        <h1>WELCOME <?php echo $row[1] . " " . $row[2] ?>! <!--<a href="cart.php"><img align="right" src= "res/cart.png" width="95" height="50"></a><a href="store.php"><img align="right" src= "res/store.png" width="95" height="50">--></h1></a>
    </header>
    <form id="logoutForm" action="logout.php" method="POST">
            <input type="hidden" name="logout" id="logout"/>
    </form>
	<div id="frame">
		<div id="page">
			<div id="header">
				<h2>MANAGE ORDERS</h2><br>
				<span class = "welcome">
                <a href="logged.php">Go Back To Profile Page</a><br>
				<a href="#" onclick="logoutFunction();">Log-Out</a>
				</span>
			</div>

			<?php
                if (isset($_SESSION['error']))
                {
                    echo "<span id=\"error\"><p>" . $_SESSION['error'] . "</p></span>";
                    unset($_SESSION['error']);
                }  
                ?>

			<div class="content">
            <form method="post" action="query.php">
                <div id="testing"></div><br>
                <div id="testing2"></div>
                    <input type="button" value='Filter by date' onClick=addDates('testing')>
            </form>
				<?php
					connect();
					$query="SELECT * from customer c, orders o WHERE c.customer_id = o. customer_id";$result=mysql_query($query);
					echo "<p></p>";
					echo '<table class="rockwell" width="100%">';
					echo '<tr bgcolor="grey" style="font-weight:bold"><td width="30%">Customer Name</td><td align="center">Options</td><td align="center">Status</td></tr>';
					while($row = mysql_fetch_array($result)){
						echo
						"<table border='1' cellpadding='5px' cellspacing='1px' style='font-family:Verdana, Geneva, sans-serif; color:white; font-size:13px; background-color:black' width='100%'>"
						."<tr><td width = '30%'>"
						."<font color='white'>". $row['name']."</font>"
						. "</td>"
						."<td width = '20%' align='center'><a href='view_order.php?order_id=".$row['order_id']."&customer_id=".$row['customer_id']."'><font color='white'>View Order</font></a></td>"	
						."<td width = '20%' align='center'><a href='manage_orders.php?order_id=".$row['order_id']."&customer_id=".$row['customer_id']."'" ?> onclick="return confirm('Are you sure you want to delete this order?')";<?php echo "><font color='white'>Delete Order</font></a></td>"
                        ."<td width = '30%' align='center'><font color='white'>". $row['status']."</font></td></tr>"                        
						."</table>";
					}
					echo '</table>';
					mysql_close();  
				?>  
		  	</div>
		</div>
	</div>

</body>
</html>