<?php

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $sql = "SELECT * FROM userdb WHERE user_id = " . $_GET["user_id"];
  $rs = mysql_query($sql);
  $row = mysql_fetch_array($rs);



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      <h1>WELCOME <?php echo $row[1] . " " . $row[2] ?>!</h1>
    </header>

    <div class="container">
      <h3>Personal Information</h3>
      <hr />
        <?php echo "First name: " . $row[1] . "<br>";
        echo "Last name: " . $row[2] . "<br>";
        if ($row[3] == 1) {
         echo "Gender: Male<br>";
        } else {
         echo "Gender: Female<br>";
        }
        echo "Salutation: " . $row[4] . "<br>";
        echo "Birthday: " . $row[5] . "<br>";
        echo "Username: " . $row[6] . "<br>";
        echo "About: " . $row[8];
        ?>
    </div>

  </body>
</html>
