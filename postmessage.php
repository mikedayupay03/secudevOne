<?php

  session_start();
  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $myusername = $_SESSION['myusername'];

  $insertMessageQuery = "INSERT INTO message_board(user_id, message, date_posted) VALUES ((SELECT user_id FROM userdb WHERE username = {$myusername}), {$_POST['message']}, CURRENT_TIMESTAMP)";
  mysql_query($insertMessageQuery);

  mysql_close();
  header("location:logged.php");

 ?>