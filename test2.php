 <meta http-equiv="refresh" content="1; URL=http://caffeine.ucsd.edu/scrabble/test2.php?id=<?php echo $_GET['id']; ?>" />
<div style="width:3500">
<?php
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$n=0;
	while($n<8)
	{
	echo "<div style='border: 5px black; float:left;'>";
	$asdf="SELECT * FROM `data` WHERE `demographics_id`=".$_GET['id']." AND status=".$n." ORDER BY time asc, paradigm_time";
	$result=$mysqli->query($asdf);
		while ($row = $result->fetch_assoc())
	{
			if ($row['condition']=="")
			{$bg="blue";}
			echo $row['condition'];
			echo "<div style='bacgkround-color: ".$bg."padding: 5px; border: 1px solid; margin-right: 5px; margin-bottom: 5px; width: 250px;'>";
			echo "<b>Stimulus: </b>" . $row['stim'];
			echo "<br>";
//				echo $row['status'];
//			echo "<br>";
			echo "<b>Server Time:</b> " . $row['time'];
			echo "<br>";
			echo "<b>Experiment Time: </b>" . $row['paradigm_time'];
			echo "<br>";
			echo "<b>Status: </b>" . $row['status'];
			echo "</div>";
			
	}
	$n+=.5;
	echo "</div>";
	}
?>
</div>