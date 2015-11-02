<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());


		$itemId = $_POST['item_id'];
		$strSQL = "SELECT COUNT(*) FROM items WHERE item_id = '" . $_POST["item_id"] . "'";
		$rs = mysql_query($strSQL);
		$row = mysql_fetch_array($rs);
		$count = $row[0];

$image = $_FILES['item_image'];
// Sanitize our inputs
$image['name'] = mysql_real_escape_string($image['name']);
$required = array('item_name', 'item_description', 'item_price');
$error = false;
$isSpecial = false;

foreach($required as $field) {
		if (empty($_POST[$field]) || ctype_space($_POST[$field]) || $image['name'] == "") {
			$error = true;
		} else if (preg_match('/[\^£$%&*()}{#~?><>|=¬]/', $_POST[$field])){ //Check for special characters
			$isSpecial = true;
		}
	}
    $itemId = $_GET['item_id'];
	if ($error) {
	    header("location:edititem.php?msg=fail&item_id=$itemId");
	} else if ($isSpecial){
		header("location:edititem.php?msg=special&item_id=$itemId");
	} else {
    
         // This variable is the path to the image folder where all the images are going to be stored
		$TARGET_PATH = "item_images/";
 
		// Build our target path full string.  This is where the file will be moved do
		$TARGET_PATH .= $image['name'];
		
		// Check to make sure that our file is actually an image
		if (!is_valid_type($image)){
			$_SESSION['error'] = "You must upload a jpeg, png, or bmp";
			header("Location: edititem.php");
			exit;
		}
		 
		// Here we check to see if a file with that name already exists
		if (file_exists($TARGET_PATH)){
			$_SESSION['error'] = "A file with that name already exists";
			header("Location: edititem.php");
			exit;
		}
		if(isset($_GET['item_id'])){
		$itemId = $_GET['item_id'];
		$query="SELECT item_image FROM items WHERE item_id like '$itemId'";$result=mysql_query($query);
		while($row = mysql_fetch_array($result)){
		    unlink("item_images/" . $row['item_image']);	
		}
		
		}
		
		if (move_uploaded_file($image['tmp_name'], $TARGET_PATH)){
			$itemId = $_GET['item_id'];
			$strSQL = "UPDATE items SET item_name = '" . $_POST["item_name"] . "', item_description = '" . $_POST["item_description"] . "', item_image = '" . $image['name'] . "', item_price = '" . $_POST["item_price"] . "' WHERE item_id = '" . $itemId . "'";
		}
		 
		 mysql_query($strSQL);
		 header("location:store.php?msg=success");
	}

// Check to see if the type of file uploaded is a valid image type
function is_valid_type($file){
    // This is an array that holds all the valid image MIME types
    $valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/png");
 
    if (in_array($file['type'], $valid_types))
        return 1;
    return 0;
}


?>
