<?php
    include_once "db.php";
	include_once "functions.php";
	
    error_reporting(0);
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}
    
	error_reporting(E_ALL ^ E_NOTICE);
	$msg="   ";
	if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		    remove_product($_REQUEST['pid']);
		}
		
	else if($_REQUEST['command']=='clear'){
		    unset($_SESSION['cart']);
		}
		
	else if($_REQUEST['command']=='update'){
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=intval($_REQUEST['product'.$pid]);
				if($q>0 && $q<=999){
					$_SESSION['cart'][$i]['qty']=$q;
				}
				else {
					$msg='Some products not updated!, quantity must be a number between 1 and 999';
				}
			}
		}
    
    //for getting user's name
    $myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM userdb WHERE username = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
		
?>
<html>
    <head>
		<meta charset="utf-8">
		<title>SECUDEV: Cart</title>
		<link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
    </head>
    <body>
        <header>
			<h1>WELCOME <?php echo $row[1] . " " . $row[2] ?>! <a href=""><img align="right" src= "res/cart.png" width="95" height="50"></a><a href="store.php"><img align="right" src= "res/store.png" width="95" height="50"></h1></a>
		</header>
        <form name="form1" id="form1" method="post">
            <input type="hidden" name="pid" />
            <input type="hidden" name="command" />
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
    	<div style="color:#F00"><?php echo $msg?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; color:black; font-size:13px; background-color:lightgreen" width="100%">
    	<?php
			if(is_array($_SESSION['cart'])){
            	echo '<tr bgcolor="grey" style="font-weight:bold"><td>Number</td><td>Name</td><td>Preview</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>
            		<tr bgcolor="lightgreen"><td><?php echo $i+1?></td><td><?php echo $pname?></td>
                    <td><img src="item_images/<?php echo get_product_image($pid)?>" height="100" width="100"></td>
                    <td>₱ <?php echo get_price($pid)?></td>
                    <td><input type="text" name="product<?php echo $pid?>" value="<?php echo $q?>" maxlength="3" size="2" /></td>                    
                    <td>₱ <?php echo get_price($pid)*$q?></td>
                    <td><a href="javascript:del(<?php echo $pid?>)">Remove</a></td></tr>
                    <input type="hidden" name="business" value="markg.romantigue-facilitator@gmail.com">
                    <input type="hidden" name="item_name_<?php echo $i+1?>" value="<?php echo $pname?>">
                    <input type="hidden" name="amount_<?php echo $i+1?>" value="<?php echo get_price($pid)?>">
                    <input type="hidden" name="quantity_<?php echo $i+1?>" value="<?php echo $q?>">
                    <input type="hidden" name="currency_code" value="PHP">
                    <!--<input type="hidden" name="notify_url" value="http://192.168.98.54/secudevOne/ipn_paypal.php">-->
                    <input type='hidden' name='rm' value='2'>
                    <input type="hidden" name="return" value="http://ad3aaf69.ngrok.io/secudevOne/cart.php">
            <?php					
				}
			?>
			<?php
			$total = get_order_total();
			?>
				<tr><td><b>Order Total: ₱<?php echo get_order_total()?></b></td><td colspan="5" align="right">
				<input type="button" value="Clear Cart" onclick="clear_cart()">
				<input type="button" value="Update Cart" onclick="update_cart()">
				<input type="button" value="Place Order" onclick="checkout()"></td></tr>
			<?php
            }
			else{
				echo "<tr bgColor='white'><td>There are no items in your shopping cart!</td>";
			}
		?>
        </table>
		</div>
	</form>
	</span>
	
	<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}
    
    form = document.getElementById("form1");
    function checkout() {
        form.action="https://www.sandbox.paypal.com/cgi-bin/webscr";
        form.submit();
    }
	</script>
	
    </body>
</html>