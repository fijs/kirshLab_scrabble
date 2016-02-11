
<!doctype html>
<html>
	<head><!--<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>--></head>
	<title></title>
<style>
#text1 {
    font-size: 30px; 
	display: block; 
	color: black; 
	margin-left: 25%; 
	margin-top: 5%; 
	margin-right: auto;
}
#text1:first-line {
    font-size: 40px; 
	
}


</style>
	
	<body>
		
	<?php 
		
		// connect to database
		$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
		
		//if the database connection attempt returns an error, display error message
		if (mysqli_connect_errno()) 
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		//get most recent qualtrix id
		$get_demo=$mysqli->query("SELECT `demographics_id` FROM `qualtrics` ORDER BY `demographics_id` DESC LIMIT 1");
		
		//convert data from sql format
		$result=$get_demo->fetch_array();
		
		//store in the current session variable for future use
		$_SESSION['demographics_id']=$result['demographics_id'];
		
		//test
		//echo $_SESSION['demographics_id'];
		
		//query the database for qualtrics id
		//$query=$mysqli->query("SELECT `qualtrics_id` FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'");
		
		//use this query below to test (especially if you didn't compete the qualtrics form,
		//the previous query above will show an error b/c you don't have qctrx id)
		$query=$mysqli->query("SELECT `qualtrics_id` FROM `qualtrics` WHERE `demographics_id`='823'");
		
		//convert from sql format data
		$id = $query->fetch_array();
		$uniqueID = $id['qualtrics_id']
		//display the data as a test
		//echo $id['qualtrics_id'];

		
		
	?>
        
	
<div id= "text1" >
		
		Thank you for completing the experiment.</br>
		Please continue to receive your unique code required for your payment</font><br>
		</div>
		<br>
	<center>
<a href=done.php><button type="button" style="
  background-color: green;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-size: 40px;
    text-decoration: none;
    cursor: pointer;
    width: 200px;
    border:none;" onclick="setWarningOff()">Continue</button></a>	</center>	






		<style>
		body {
		  background-attachment: fixed;
		  background-image: url(''),
		                    url('ty.jpg');
		  background-position: 50% 50%;
		  background-size: auto, cover;
		  font-size: 100%;
		}
		</style>
<html>
