<?php
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("secudev1") or die (mysql_error());
$strSQL = "SELECT COUNT(*) FROM items WHERE item_name = '" . $_POST["item_name"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];

$required = array('item_name', 'item_description', 'item_price');

$image = $_FILES['item_image'];
// Sanitize our inputs
$image['name'] = mysql_real_escape_string($image['name']);
$error = false;
$isSpecial = false;

foreach($required as $field) {
		if (empty($_POST[$field]) || ctype_space($_POST[$field]) || $image['name'] == "") {
			$error = true;
		} else if (preg_match('/[\^£$%&*()}{#~?><>|=¬]/', $_POST[$field])){ //Check for special characters
			$isSpecial = true;
		}
	}
 

	if ($error) {
	    header("location:store.php?msg=fail");
	} else if ($isSpecial){
		header("location:store.php?msg=special");
	} else {
    
        // This variable is the path to the image folder where all the images are going to be stored
		$TARGET_PATH = "item_images/";
 
		// Build our target path full string.  This is where the file will be moved do
		$TARGET_PATH .= $image['name'];
		
		// Check to make sure that our file is actually an image
		if (!is_valid_type($image)){
			$_SESSION['error'] = "You must upload a jpeg, png, or bmp";
			header("Location: additem.php");
			exit;
		}
		 
		// Here we check to see if a file with that name already exists
		if (file_exists($TARGET_PATH)){
			$_SESSION['error'] = "A file with that name already exists";
			header("Location: additem.php");
			exit;
		}
		if (move_uploaded_file($image['tmp_name'], $TARGET_PATH)){
			$strSQL = "INSERT INTO items(item_name,item_description, item_image, item_price) VALUES ('" . $_POST["item_name"] . "', '" . $_POST["item_description"] . "','" . $image['name'] . "','" . $_POST["item_price"] . "')";
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
