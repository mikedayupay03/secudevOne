<?php
  session_start();
  $paypalmode = 'sandbox'; //Sandbox for testing or empty ''
  $dbusername     = 'root'; //db username
  $dbpassword     = '1234'; //db password
  $dbhost     = 'localhost'; //db host
  $dbname     = 'secudev1'; //db name


  if($_POST)
  {
          if($paypalmode=='sandbox')
          {
              $paypalmode     =   '.sandbox';
          }
          $req = 'cmd=' . urlencode('_notify-validate');
          foreach ($_POST as $key => $value) {
              $value = urlencode(stripslashes($value));
              $req .= "&$key=$value";
          }
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.paypal.com'));
          $res = curl_exec($ch);
          curl_close($ch);

          //if (strcmp ($_POST['payer_status'], "verified") == 0)
          if (true)
          {
              $transaction_id = $_POST['txn_id'];
              $payerid = $_POST['payer_id'];
              $firstname = $_POST['first_name'];
              $lastname = $_POST['last_name'];
              $payeremail = $_POST['payer_email'];
              $paymentdate = $_POST['payment_date'];
              $paymentstatus = $_POST['payment_status'];
              $total = $_POST['mc_gross'];
              $mdate= date('Y-m-d h:i:s',strtotime($paymentdate));
              $otherstuff = json_encode($_POST);

              echo $transaction_id;
              mysql_connect("localhost","root","1234") or die (mysql_error());
              mysql_select_db("secudev1") or die (mysql_error());

              $sql = "INSERT INTO donations (donators_name, donators_email, donation_amount) VALUES ('$firstname $lastname', '$payeremail', '$total')";
              $result=mysql_query($sql);

              $strSQL = "UPDATE badges a, userdb b SET donations = donations + 1 WHERE a.user_id = b.user_id AND b.username = '" . $myusername . "'";
              mysql_query($strSQL);
              mysql_close();
              header("location:logged.php");
          }
  }

 ?>
