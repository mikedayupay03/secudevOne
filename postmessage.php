<?php

  session_start();
  
  require_once '/htmlpurifier-4.7.0/library/HTMLPurifier.auto.php';

  $config = HTMLPurifier_Config::createDefault();
  //$config->set('HTML.AllowedAttributes', 'src, height, width, alt');
  //$config->set('URI.AllowedSchemes', array('http' => true, 'https' => true, 'mailto' => true, 'ftp' => true, 'nntp' => true, 'news' => true, 'data' => true));
  $purifier = new HTMLPurifier($config);
    
  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $myusername = $_SESSION['myusername'];
  echo $myusername;
  $sql = "SELECT user_id FROM userdb WHERE username = '" . $myusername . "'";
  $userId = mysql_fetch_array(mysql_query($sql));

  //To protect from XSS attacks and Mysql Injection
  $message =($_POST["message"] );
  $message = $purifier->purify($message);
  $insertMessageQuery = "INSERT INTO message_board(user_id, message, date_posted) VALUES ('" . $userId[0] . "', '" . $message . "', CURRENT_TIMESTAMP)";
  $result = mysql_query($insertMessageQuery);
  if ($result) {
    echo "success!";
  } else {
    echo "failed!";
  }


  mysql_close();
  header("location:logged.php");

 ?>
