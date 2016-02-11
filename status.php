<?php
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$result=$mysqli->query("SELECT * FROM `data` WHERE `demographics_id`=530 ORDER BY time DESC, paradigm_time");
		while ($row = $result->fetch_assoc())
	{
			echo "<div style='padding: 5px; border: 1px solid; margin-right: 5px; margin-bottom: 5px; width: 250px;'>";
			echo "<b>Stimulus: </b>" . $row['stim'];
			echo "<br>";
//				echo $row['status'];
//			echo "<br>";
			echo "<b>Server Time:</b> " . $row['time'];
			echo "<br>";
			echo "<b>Experiment Time: </b>" . $row['paradigm_time'];
			echo "</div>";
			
	}
?>