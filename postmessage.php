<?php

  session_start();
  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $myusername = $_SESSION['myusername'];
  echo $myusername;
  $sql = "SELECT user_id FROM userdb WHERE username = '" . $myusername . "'";
  $userId = mysql_fetch_array(mysql_query($sql));



  $insertMessageQuery = "INSERT INTO message_board(user_id, message, date_posted) VALUES ('" . $userId[0] . "', '" . $_POST['message'] . "', CURRENT_TIMESTAMP)";
  $result = mysql_query($insertMessageQuery);
  if ($result) {
    echo "success!";
  } else {
    echo "failed!";
  }


  mysql_close();
  //header("location:logged.php");

 ?>
