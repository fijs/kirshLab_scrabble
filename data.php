<table>
<?
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
$a="";
$result = $mysqli->query("SELECT * FROM `response` WHERE `demographics_id` = '679' ORDER BY `prog`, `response_no`");
while ($row = $result->fetch_assoc())
	{
		if($a!=$row['prog'])
		{
		echo "<tr><td><BR><BR></td></tr>";
		}
		echo "<tr><td>".$row['response_time']."</td><td><b>&nbsp;&nbsp;".$row['response']."</b></td><td>".$row['prog']."</td></tr>";
		$a=$row['prog'];

	}
?>