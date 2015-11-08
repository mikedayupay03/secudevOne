<?php


  //String sql = "INSERT INTO donations (donation_id, donators_name, donators_email, donation_amount) VALUES ()";
  
  session_start();
  $myusername = $_SESSION['myusername'];
  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());
  $strSQL = "UPDATE badges a, userdb b SET donations = donations + 1 WHERE a.user_id = b.user_id AND b.username = '" . $myusername . "'";
  mysql_query($strSQL);
  mysql_close();
  header("location:logged.php");

 ?>
