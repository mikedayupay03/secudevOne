<?php

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $sql = "SELECT * FROM message_board";
  $getMessageQuery = "SELECT u.first_name, u.username, u.date_joined, m.message, m.date_posted FROM message_board AS m, userdb AS u WHERE u.user_id = m.user_id ORDER BY m.date_posted DESC LIMIT 10";
  $rs = mysql_query($getMessageQuery);
  $messages = mysql_fetch_row($rs);
  if($messages) {
    echo "success!";
  }else {
    echo mysql_error();
  }


  echo "<table>";
  while ($messages = mysql_fetch_row($rs)) {
    echo "<tr>
    <td>";

    echo $messages[0] . "<br>";
    echo $messages[1] . "<br>";
    echo $messages[2] . "<br>";
    echo "</td>
    <td>";

    echo "<h5>" . $messages[4] . "</h5>";
    echo "<p>" . $messages[3] . "</p>";
    echo "</td>
    </tr>";

  }
  echo "</table>";


  ?>
