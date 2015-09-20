<?php

  mysql_connect("localhost","root","1234") or die (mysql_error());
  mysql_select_db("secudev1") or die (mysql_error());

  $getMessageQuery = "SELECT u.first_name, u.username, u.date_joined, m.message, m.date_posted FROM message_board AS m, userdb AS u WHERE u.user_id = m.user_id ORDER BY m.date_posted DESC LIMIT 10";
  $rs = mysql_query($getMessageQuery);
  $messages = mysql_fetch_array($rs);

  echo "<table>";

  while ($messages) {
    echo "<tr>";
    echo "<td>";
    echo $messages['u.firstname'] . "<br>";
    echo $messages['u.username'] . "<br>";
    echo $messages['u.date_joined'] . "<br>";
    echo "</td>";
    echo "<td>";
    echo "<h5>" . $messages['m.date_posted'] . "</h5>";
    echo "<p>" . $messages['m.message'] . "</p>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</table>";


  ?>
