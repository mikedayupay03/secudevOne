<?php
  session_start();
  error_reporting(0);
  if(!isset($_SESSION['myusername'])){ //if login in session is not set
  header("Location:index.php");
  }

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $itemId = $_GET['item_id'];
  $query="SELECT * FROM items WHERE item_id = '" . $itemId . "'";
  $rs = mysql_query($query);
  $items = mysql_fetch_row($rs);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <div class="container">
      <h3><?php echo $items[1] . "<br>"; ?></h3>
      <hr />
        <?php
               echo "<tr>
               <td>";
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
               echo "</tr>";
			   echo "</table>"; 
        ?>
		<br><br><a href ='store.php'>Back to Store</a>
		<br><a href ='logged.php'>Back to Homepage</a>
    </div>

  </body>
</html>
