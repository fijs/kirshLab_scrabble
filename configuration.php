<!-- <?php //require 	require '/home/fjaime/configuration.php'; ?> -->

<?php
   
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'scrabble');
    define('DB_USER', 'scribble');
    define('DB_PASS', 'Thu,Jan21');

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	
	//get most recent demographics id
	//	$get_demo=$mysqli->query("SELECT `demographics_id` FROM `qualtrics` ORDER BY `demographics_id` DESC LIMIT 1");
		$get_demo=$mysqli->query("SELECT `demographics_id` FROM `qualtrics` where `qualtrics_id`='".$_SESSION['qid']."'");
		
		//convert data from sql format
		$result=$get_demo->fetch_array();
		
		//store in the current session variable for future use
		$_SESSION['demographics_id']=$result['demographics_id'];
		
		//test
		//echo $_SESSION['demographics_id'];
		
		//query the database for qualtrics id
		$query=$mysqli->query("SELECT `qualtrics_id` FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'");
		
		//use this query below to test (especially if you didn't compete the qualtrics form,
		//the previous query above will show an error b/c you don't have qctrx id)
		//$query=$mysqli->query("SELECT `qualtrics_id` FROM `qualtrics` WHERE `demographics_id`='823'");
		
		//convert from sql format data
		$id = $query->fetch_array();
		$uniqueID = $id['qualtrics_id'];
		
		$_SESSION['expstart']=0;

	 
?>

<script type="text/javascript">
var maxSecs = 5;
var	maxShowSecs = 3;
</script>