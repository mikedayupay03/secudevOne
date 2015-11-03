<?php
$username="root";
$password="1234";
$database="secudev1";

$link = mysql_connect('localhost', $username, $password);
        if (!$link) {
            die('Could not connect');
        }
        @mysql_select_db($database) or die( "Unable to select database");
		session_start();

	function connect()
    {
        global $username;
        global $password;
        global $database;
	

        $link = mysql_connect('localhost', $username, $password);
        if (!$link) {
            die('Could not connect');
        }
        @mysql_select_db($database) or die( "Unable to select database");
    }


    function listCards($rarity)
    {
        connect();
        $query="SELECT * FROM cards WHERE rarity like '$rarity' ORDER BY name ASC";$result=mysql_query($query);
		echo "<p></p>";
		echo '<table class="rockwell">';

		while($row = mysql_fetch_array($result)){
		    echo "<tr><td>"
		    .'<a href="card.php?card_id='.$row['card_id'].'">' . $row['name'] . '</a>' 
		    . "</td><td>" . "</td></tr>";	
		}
		echo '</table>';
		mysql_close();
    }
	
	function search($name)
    {
        connect();
		$output = ' ';
        $query="SELECT name, card_id FROM cards WHERE name like '%$name%'";$result=mysql_query($query);
		$count=mysql_num_rows($result);
		if($count == 0){
			$output = 'No Results Found';
			echo $output;
		}
		else{
			echo "<p></p>";
			echo '<table class="rockwell">';

			while($row = mysql_fetch_array($result)){
				echo "<tr><td>"
				.'<a href="card.php?card_id='.$row['card_id'].'">' . $row['name'] . '</a>' 
				. "</td><td>" . "</td></tr>";	
			}
		echo '</table>';
		mysql_close();
		}
	}
	
	function viewCard($cardId)
    {
        connect();
        $query="SELECT * FROM cards WHERE card_id like '$cardId'";$result=mysql_query($query);
		echo "<p></p>";
		echo '<table class="rockwell">';

		while($row = mysql_fetch_array($result)){
		    echo "<tr><td>". "Name: ". $row['name'] . "</td></tr>";
			echo "<tr><td>". "<br>" ."</td></tr>";
			echo "<tr><td>"."Rarity: ". $row['rarity'] . "</td></tr>";
			echo "<tr><td>". "<br>" ."</td></tr>";
			echo "<tr><td>"."Description: ". $row['description'] . "</td></tr>";
			echo "<tr><td>". "<br>" ."</td></tr>";
			echo "<tr><td>"."Price: ". $row['price']." Pesos" . "</td></tr>";
		}
		echo '</table>';
		mysql_close();
    }

?>