<?php
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

	//Get username of logged in user
   $myusername = $_SESSION['myusername'];
   $strSQL = "SELECT username FROM userdb WHERE username = '" . $myusername . "'";
   $result = mysql_query($strSQL);
   $row = mysql_fetch_array($result);

  $sql = "SELECT * FROM message_board";
  $getMessageQuery = "SELECT u.first_name, u.username, u.date_joined, m.message, m.date_posted, m.message_id, u.user_id, m.edited_date FROM message_board AS m, userdb AS u WHERE u.user_id = m.user_id ORDER BY m.date_posted DESC LIMIT 10";
  $rs = mysql_query($getMessageQuery);
  $messages = mysql_fetch_row($rs);
  // if($messages) {
  //   echo "success!";
  // }else {
  //   echo mysql_error();
  // }

	echo "<table border = '1' col = >";
  do {


    echo "<tr>
    <td>";

    echo "<a href='otheruserprofile.php?user_id=". $messages[6] ."'>" . $messages[0] . "</a>" . "<br>";
    echo "<a href='otheruserprofile.php?user_id=". $messages[6] ."'>" . $messages[1] . "</a>" . "<br>";
   echo $messages[2] . "<br>";
    /*if($messages[7] == 0){
        echo "<br>";
    }else {
        echo "edited:" . "<br>";
        echo $messages[7] . "<br>";
    }*/
    echo "</td>
    <td>";

    echo "<b>Date posted: </b>" . $messages[4];
    if($messages[7] == 0){
        echo "<br>";
    }else {
        echo "<br><b>Date edited: </b>" . $messages[7];
    }
    echo "<p>" . $messages[3] . "</p>";
    echo "</td>";
	echo "<td>";
	if($row[0] == $messages[1]){
		echo "<a href='editmessage.php?message_id=".$messages[5]."'><button class='btn' type='button'><strong><center>Edit</center></strong></button></a>";
		echo "</td>";
		echo "<td>";
		echo "<a href='logged.php?message_id=".$messages[5]."'" ?> onclick="return confirm('Are you sure you want to delete this message?')";<?php echo "><button class='btn' type='button'><strong><center>Delete</center></strong></button></a>";
	}
	  echo "</td>";
    echo "</tr>";

  } while ($messages = mysql_fetch_row($rs));
  echo "</table>";


  ?>
