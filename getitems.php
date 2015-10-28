<?php
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

	//Get username of logged in user
   $myusername = $_SESSION['myusername'];
   $strSQL = "SELECT username, admin FROM userdb WHERE username = '" . $myusername . "'";
   $result = mysql_query($strSQL);
   $row = mysql_fetch_array($result);

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
   }
   ?>
   <img src = "item_images/<?php echo $items[3];?>"  width="300" height="300" class="itemImage">
   
   <?php
   echo "<br>" . $items[2] . "<br>";//description of item

   echo "</td>";
   echo "<td>";
   echo "<a href='cart.php?item_id=".$items[0]."'><button class='btn' type='button'><strong><center>Add to Cart</center></strong></button></a>";
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
  echo "</table>";


  ?>
