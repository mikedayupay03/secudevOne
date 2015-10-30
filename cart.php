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
		
?>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="design.css">
		<link rel="icon" type="image/ico" href="Favicon.ico">
        <title>Magic Card Store</title>
    </head>
    <body bgcolor="black">
 	<span class ="imgpos">
            <img src= http://www.tpreview.co.uk/wp-content/uploads/2013/12/magic_the_gathering_symbols_by_thekagestar-d37388h.png width="350" height="197">
	</span>
	<form action="http://localhost/mtgstore/home.php">
	<span class = "buttonHomePos">
	    <input type="submit" value="Home" class="button_home">
	</span>
	</form>
	<form action="http://localhost/mtgstore/listCards.php" method="GET">
	<span class = "buttonCommonPos">
		<input type="hidden" name="rarity" value="Common">
	    <input type="submit" value="Common" class="button_center">
	</span>
	</form>
	<form action="http://localhost/mtgstore/listCards.php" method="GET">
	<span class = "buttonUncommonPos">
		<input type="hidden" name="rarity" value="Uncommon">
	    <input type="submit" value="Uncommon" class="button_center">
	</span>
	</form>
	<form action="http://localhost/mtgstore/listCards.php" method="GET">
	<span class = "buttonRarePos">
		<input type="hidden" name="rarity" value="Rare">
	    <input type="submit" value="Rare" class="button_center">
	</span>
	</form>
	<form action="http://localhost/mtgstore/listCards.php" method="GET">
	<span class = "buttonMythicPos">
		<input type="hidden" name="rarity" value="Mythic Rare">
	    <input type="submit" value="Mythic Rare" class="button_right">
	</span>
	</form>

	<form action="http://localhost/mtgstore/searchResults.php" method="post">
	<span class = "searchPos">
	    <input type="text" name="search" placeholder="Search card"/>
	    <input type="image" src="http://www.iconsdb.com/icons/preview/white/search-3-xxl.png" height="15" width="15">
	</span>
	</form>

	<form action="http://localhost/mtgstore/cart.php" method="post">
	<span class = "cartPos">
	    <input type="image" src="http://www.inmotionhosting.com/support/images/stories/icons/ecommerce/empty-cart-dark.png" height="27" width="27">
	</span>
	</form>
	<span class="shoppingPos">
	<form name="form1" method="post">
	<input type="hidden" name="pid" />
	<input type="hidden" name="command" />
	<div style="margin:0px auto; width:870px;" >
    <div style="padding-bottom:10px">
    </div>
    	<div style="color:#F00"><?php echo $msg?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; color:white; font-size:13px; background-color:black" width="100%">
    	<?php
			if(is_array($_SESSION['cart'])){
            	echo '<tr bgcolor="grey" style="font-weight:bold"><td>Number</td><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>
            		<tr bgcolor="black"><td><?php echo $i+1?></td><td><?php echo $pname?></td>
                    <td>$ <?php echo get_price($pid)?></td>
                    <td><input type="text" name="product<?php echo $pid?>" value="<?php echo $q?>" maxlength="3" size="2" /></td>                    
                    <td>$ <?php echo get_price($pid)*$q?></td>
                    <td><a href="javascript:del(<?php echo $pid?>)">Remove</a></td></tr>
            <?php					
				}
			?>
			<?php
			$total = get_order_total();
			?>
				<tr><td><b>Order Total: $<?php echo get_order_total()?></b></td><td colspan="5" align="right">
				<input type="button" value="Clear Cart" onclick="clear_cart()">
				<input type="button" value="Update Cart" onclick="update_cart()">
				<input type="button" value="Place Order" onclick="window.location='billing.php?total=<?php echo $total;?>'"></td></tr>
			<?php
            }
			else{
				echo "<tr bgColor='black'><td>There are no items in your shopping cart!</td>";
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
	</script>
	
    </body>
</html>