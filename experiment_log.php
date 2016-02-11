<?
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	if(isset($_POST['exno']))
	{
	$query="INSERT INTO `exlog`(`demographics_id`, `experiment_no`) VALUES (".$_POST['demographics_id'].",".$_POST['exno'].")";
//	echo $query;
	$result=$mysqli->query($query);	
//	header("Location: experiment_log.php");
	}
	if(isset($_POST['checked']))
	{
	foreach($_POST['checked'] as $checked)
	{
		$query="DELETE FROM `exlog` WHERE `experiment_no` =". $checked;
		$result=$mysqli->query($query);	
	}
	}
?>
<form action="experiment_log.php" method="post">
<table cellspacing=2 cellpadding=3 border=1>
<tr><td><b>Delete?</td><td><b>Experiment No</td><td><b>Participant Id</td><td><b>Name</td><td><b>E-mail</td></tr>
<?

$result = $mysqli->query("SELECT * FROM `exlog` INNER JOIN (demographics) ON exlog.demographics_id = demographics.demographics_id ORDER BY experiment_no ASC");

while ($row = $result->fetch_assoc())
	{
		echo "<tr><td><input type=checkbox value=".$row['experiment_no']." name='checked[]'><td>".$row['experiment_no']."</td><td>".$row['demographics_id']."</td><td>".$row['fname']." " .$row['lname']."</td><td>". $row['email']."</td></tr>";
	}
?>
</table>
<input type=submit value="delete checked?">
</form>
<br><br>
<table border=0><tr>
<form action="experiment_log.php" method="post">
<td>Experiment Number: </td><td><input type=text name=exno></td>
<td>Participant Id: </td><td><input type=text name=demographics_id></td>
</tr></table>
<input type=submit value=save>
</form>