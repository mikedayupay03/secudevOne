<?php
    session_start();
       //Change these with your information
    $paypalmode = 'sandbox'; //Sandbox for testing or empty ''
    $dbusername     = 'root'; //db username
    $dbpassword     = '1234'; //db password
    $dbhost     = 'localhost'; //db host
    $dbname     = 'secudev1'; //db name
	
	echo $_SESSION[0];

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

            $conn = mysql_connect($dbhost,$dbusername,$dbpassword);
            if (!$conn)
            {
             die('Could not connect: ' . mysql_error());
            }

            mysql_select_db($dbname, $conn);

            // insert in our customer table
            $query = "INSERT INTO customer
            (name, email)
            VALUES
            ('$firstname $lastname','$payeremail')";
            $result=mysql_query($query);


            // insert into our orders table
            $query="SELECT * FROM customer WHERE name like '$firstname $lastname' ";
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)){
                    $customerId = $row['customer_id'];
            }
            $query="INSERT INTO orders (total_price, date_created, customer_id, status) VALUES('$total', now(), '$customerId', '$paymentstatus')";
            $result=mysql_query($query);

            // insert into our cart table
            $query="SELECT order_id FROM orders WHERE customer_id like $customerId ORDER BY order_id DESC";
            $result=mysql_query($query);
            $row = mysql_fetch_array($result);
            $orderId = $row['order_id'];

            $sql = "INSERT INTO donations (donators_name, donators_email, donation_amount) VALUES ('$firstname $lastname', '$payeremail', '$total')";
            $result=mysql_query($sql);

			$mu = $_SESSION['myusername'];
			
			$query = "UPDATE badges a, userdb b SET a.donations = a.donations + 1 WHERE (a.user_id = b.user_id AND b.username = '". $mu ."')";
			$result = mysql_query($query);

            $max=$_POST["num_cart_items"];
                for($i=0;$i<$max;$i++){
                    $j = $i+1;
                    $pnamevar = "item_name";
                    $pname = $_POST[$pnamevar . $j];
                    $query="SELECT item_id FROM items WHERE item_name like '$pname'";
                    $result=mysql_query($query);
                    $row = mysql_fetch_array($result);
                    $pid = $row['item_id'];
                    $qtyvar = "quantity";
                    $qty=$_POST[$qtyvar . $j];
                    $query="INSERT INTO cart (order_id, customer_id, item_id, quantity) VALUES('$orderId', '$customerId', '$pid', '$qty')";
                    $result=mysql_query($query);
                    $query = "UPDATE badges a, userdb b SET a.donations = a.donations + 1 WHERE (a.user_id = b.user_id AND b.username = '". $mu ."')";
					$result = mysql_query($query);
                }


        }
}
?>
