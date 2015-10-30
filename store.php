<!DOCTYPE html>
<?php
    //functions for shopping cart
    include_once "db.php";
	include_once "functions.php";
    
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
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
    
    if(isset($_REQUEST['command'])){
	    if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
		    $pid=$_REQUEST['productid'];
			addtocart($pid, 1);
			header("location:cart.php");
			exit();
		}
	}
    
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
        <script language="javascript">
            function addToCart(pid){
                document.form1.productid.value=pid;
                document.form1.command.value='add';
                document.form1.submit();
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

		<div class="message_board">
			<a href ='logged.php'>Go Back</a>
			<h3>Store Items</h3>
			
			<?php	
				if($row['admin'] == 1){
					echo "<a href='additem.php'><button class='btn' type='button'><strong><center>Add Item</center></strong></button></a>";
					echo "</td>";
				}
              $sql = "SELECT * FROM items";
              $query="SELECT item_id, item_name, item_description, item_image, item_price FROM items WHERE 1";
              $rs = mysql_query($query);
              $items = mysql_fetch_row($rs);
              // if($items) {
              //   echo "success!";
              // }else {
              //   echo mysql_error();
              // }

                echo "<table border = '1' col = >";
              do {


                echo "<tr>
                <td>";

               echo "<a href='#?item_id=". $items[0] ."'>" . $items[1] . "</a>" . "<br>";//name of item
               echo "<b>P</b>" . $items[4] . "<br>";//price of item
               
               if(isset($_GET['item_id'])){
               $itemId = $_GET['item_id'];
               $query="SELECT item_image FROM items WHERE item_id = '" . $itemId . "'";
               $result=mysql_query($query);
               }?>
          
               <img src = "item_images/<?php echo $items[3];?>"  width="300" height="300" class="itemImage">
               
                <?php
               echo "<br>" . $items[2] . "<br>";//description of item

               echo "</td>";
               echo "<td>";
               echo "<input type='image' src='res/add-to-cart.png' onclick='addToCart(" . $items[0] . ")'>";
               echo "</td>";
               echo "<td>";
               if($row[0] == $items[1] || $row['admin'] == 1){
                    echo "<a href='edititem.php?item_id=".$items[0]."'><button class='btn' type='button'><strong><center>Edit</center></strong></button></a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='store.php?item_id=".$items[0]."'" ?> onclick="return confirm('Are you sure you want to delete this message?')";<?php echo "><button class='btn' type='button'><strong><center>Delete</center></strong></button></a>";
                }
                echo "</td>";
                echo "</tr>";

              } while ($items = mysql_fetch_row($rs));
              echo "</table>"; ?>
			<hr>
			<div id="message_container">

			</div>
		</div>
        <!--FORM for adding to cart-->
        <form name="form1">
        <input type="hidden" name="productid" />
        <input type="hidden" name="command" />
        </form>
        
		<?php mysql_close(); ?>
        
	</body>
</html>
