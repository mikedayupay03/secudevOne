<?php
	session_start();

	require_once 'sql_login.inc';
	include 'class_cards.php';


	$db_server = new mysqli($db_hostname, $db_username, $db_password);

    if(!$db_server)
        die("Unable to connect to MySQL: " . mysql_error());

    $db_server->select_db($db_database)
        or die("Unable to select database: " . mysql_error()); 

	$required = array('name', 'rarity', 'desc', 'price');

	$tbl_name = "cards";
	$image = $_FILES['image'];
	// Sanitize our inputs
	$image['name'] = mysql_real_escape_string($image['name']);
	// Loop over field names, make sure each one exists and is not empty
	$error = false;
	$isSpecial = false;
	$invalidType = false;
	$isDuplicate = false;
	$isDuplicateName = false;
	$isDuplicateImage = false;
	$checkName = $_POST['name'];
	$checkImage = $image['name'];
	
	//Check for duplicate name and image
	$query = "SELECT * FROM cards WHERE name like '$checkName' AND image like '$checkImage'";
	$duplicate = mysqli_query($db_server, $query);
	$query2 = "SELECT * FROM cards WHERE name like '$checkName'";
	$duplicateName = mysqli_query($db_server, $query2);
	$query3 = "SELECT * FROM cards WHERE image like '$checkImage'";
	$duplicateImage = mysqli_query($db_server, $query3);
	
	foreach($required as $field) {
		if (!is_valid_type($image) && (empty($_POST[$field]) || ctype_space($_POST[$field]) || $image['name'] == "")){
			$error = true;
		} else if(!is_valid_type($image)){
			$invalidType = true;
		}else if (empty($_POST[$field]) || ctype_space($_POST[$field]) || $image['name'] == "") {
			$error = true;
		} else if (preg_match('/[\^£$%&*()}{@#~?><>|=_¬]/', $_POST[$field])){
			$isSpecial = true;
		} else if (mysqli_num_rows($duplicate) > 0) {
		    $isDuplicate = true;
		} else if (mysqli_num_rows($duplicateName) > 0) {
		    $isDuplicateName = true;
		} else if (mysqli_num_rows($duplicateImage) > 0) {
		    $isDuplicateImage = true;
		}
	}

	if ($error) {
	    header("location:add_cards.php?msg=fail");
	} else if ($isSpecial){
		header("location:add_cards.php?msg=special");
	} else if ($invalidType){
		header("location:add_cards.php?msg=invalidType");
	} else if ($isDuplicate){
		header("location:add_cards.php?msg=duplicate");
	} else if ($isDuplicateName){
		header("location:add_cards.php?msg=duplicateName");
	} else if ($isDuplicateImage){
		header("location:add_cards.php?msg=duplicateImage");
	} else {
		//A LITTLE OBJECT ORIENTED PROGRAMMING HERE
		$card = new Card(trim($_POST['name']) , trim((int)$_POST['price']) , trim($_POST['rarity']), preg_replace('/\s+/', ' ', trim($_POST['desc'])));
		
		$name = $card->getCardName();
		$rarity = $card->getCardRarity();
		$desc = $card->getCardDescription();
		$price = $card->getCardPrice();
		// This variable is the path to the image folder where all the images are going to be stored
		$TARGET_PATH = "images/";
 
		// Build our target path full string.  This is where the file will be moved do
		$TARGET_PATH .= $image['name'];
		
		// Check to make sure that our file is actually an image
		if (!is_valid_type($image)){
			$_SESSION['error'] = "You must upload a jpeg, png, or bmp";
			header("Location: add_cards.php");
			exit;
		}
		 
		// Here we check to see if a file with that name already exists
		if (file_exists($TARGET_PATH)){
			$_SESSION['error'] = "A file with that name already exists";
			header("Location: add_cards.php");
			exit;
		}
		if (move_uploaded_file($image['tmp_name'], $TARGET_PATH)){
			$query = "INSERT INTO $tbl_name (name, description, price, rarity, image) VALUES('$name', '$desc', '$price', '$rarity', '" . $image['name'] . "')";
		}
		
		$result = mysqli_query($db_server, $query);
		header("location:add_cards.php?msg=success");
	}
	
	// Check to see if the type of file uploaded is a valid image type
function is_valid_type($file)
{
    // This is an array that holds all the valid image MIME types
    $valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/png");
 
    if (in_array($file['type'], $valid_types))
        return 1;
    return 0;
}
 
function showContents($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

?>