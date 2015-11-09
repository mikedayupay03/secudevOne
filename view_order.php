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
	
	if(isset($_GET['customer_id'])){
		$customerId = $_GET['customer_id'];
        connect();
		//mysql_close();
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
				<?php
					connect();
					$customerId = $_GET['customer_id'];
					$orderId = $_GET['order_id'];
					$query="SELECT * from customer c, orders o WHERE c.customer_id = o. customer_id";$result=mysql_query($query);
				?>
				<span class = "rockwell">
				<fieldset>
					<legend><h3><font color="white">Customer Info</font></h3></legend>
					<?php
					$row = mysql_fetch_array($result);
					echo "Name: " . $row['name'] . "<br>";
					//echo "Address: " . $row['address'] . "<br>";
					//echo "Contact No: " . $row['contact_no'] . "<br>";
					echo "Email: " . $row['email'];
					?>
				</fieldset>
				<?php
					echo "<br>";
					echo "Order Number: ". $orderId;
					echo "<br>";
					echo "<br>";
					$query="SELECT o.order_id, GROUP_CONCAT(item_id SEPARATOR ', ') as item_id from orders o, cart c WHERE o.order_id = c.order_id AND o.order_id = $orderId";
					$result=mysql_query($query);
					$row = mysql_fetch_array($result);
					$value = $row['item_id'];
					$values = explode(",", $value);
					
					$query2="SELECT o.order_id, GROUP_CONCAT(quantity SEPARATOR ', ') as qty from orders o, cart c WHERE o.order_id = c.order_id AND o.order_id = $orderId";
					$result2=mysql_query($query2);
					$row2 = mysql_fetch_array($result2);
					$value2 = $row2['qty'];
					$values2 = explode(",", $value2);

					//$values is an array of strings concatenated by group_concat
					//PRINT CARDS BOUGHT
					$count = count($values);
					echo"<table border='1' cellpadding='5px' cellspacing='1px'>";
					echo '<tr bgcolor="grey" style="font-weight:bold"><td width="30%">Item Name</td><td align="center">Price</td><td align="center">Quantity</td><td align="center">Subtotal</td></tr>';
					for($i=0; $i<$count; $i++){
						echo"<tr>";
						echo"<td>";
						$query="SELECT * FROM items WHERE item_id = '$values[$i]'";
						$result=mysql_query($query);
						$row = mysql_fetch_array($result);
						echo $row['item_name'];
						echo "</td>";
						echo "<td align='center'>";
						echo $row['item_price']. " Pesos";
						echo "</td>";
						echo "<td align= 'center'>";
						echo $values2[$i];
						echo "</td>";
						echo "<td align= 'center'>";
						echo $values2[$i] * $row['item_price'] . " Pesos";
						echo "</td>";
					}
					echo"</tr>";
					$query="SELECT * FROM orders WHERE order_id = '$orderId'";
						$result=mysql_query($query);
						$row = mysql_fetch_array($result);
					echo '<tr bgcolor="lightgreen" style="font-weight:bold"><td colspan="4" align="right">Order Total: '
						 . $row['total_price']. ' Pesos' .'</td></tr>';
					echo"</table>";
					echo "<br>";
					echo "Date Created: " . $row['date_created'];
				?>
				</span>
			</div>
		</div>
	</div>


</body>
</html>