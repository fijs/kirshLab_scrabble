<?php 
  	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$query="SELECT * FROM `timesync` WHERE `demographics_id`='".$_GET['demo_id']."' LIMIT 1";
	$result = $mysqli->query($query);
//	$query="SELECT * FROM `timesync` WHERE `demographics_id`='646' LIMIT 1";

//	echo $query;
	$result = $mysqli->query($query);

//	echo "<br>";
	while ($row = $result->fetch_assoc())
	{
    	echo json_encode(array("timereceive"=>$row['timesend'], "prog"=>$row['loc']));
//		echo "<br>";	echo "<br>";
//		echo $row['timesend'];
		}
?>
