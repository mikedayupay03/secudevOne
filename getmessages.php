<?php

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $getMessageQuery = "SELECT 'u.first_name', 'u.username', 'u.date_joined', 'm.message', 'm.date_posted' FROM message_board AS m, userdb AS u WHERE 'u.user_id' = 'm.user_id' ORDER BY 'm.date_posted' DESC LIMIT 10";
  $rs = mysql_query($getMessageQuery);
  $messages = mysql_fetch_array($rs);

  echo "<table>";

  while ($messages) {
    echo "<tr>";
    echo "<td>";
    echo $messages[0] . "<br>";
    echo $messages[1] . "<br>";
    echo $messages[2] . "<br>";
    echo "</td>";
    echo "<td>";
    echo "<h5>" . $messages[4] . "</h5>";
    echo "<p>" . $messages[5] . "</p>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</table>";


  ?>
