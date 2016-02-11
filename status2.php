<?	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$result = $mysqli->query("SELECT * FROM  `data` ORDER BY time DESC LIMIT 1");

	while ($row = $result->fetch_assoc())
	{
		echo $row['condition'];
	}

?>