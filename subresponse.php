<h1>Copy Paste this somewhere, just in case </h1>
<?php 
  	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$i=1;
	
	while($i<1000)
	{
    	$in='inc-'.$i;
    	$tinc='time-'.$i;
    	$pinc='prog-'.$i;
	if($_POST[$i] !=null)
	{
	$query='INSERT INTO `response`(`demographics_id`, `response_no`, `response_time`, `response`,`prog`) VALUES ('.$_POST['demographics_id'].','.$i.','.$_POST[$tinc].',"'.$_POST[$i].'","'.$_POST[$pinc].'")';
	echo $query . "<br>";
 	$result= $mysqli->query($query);
	}
	$i++;
    }


?>
