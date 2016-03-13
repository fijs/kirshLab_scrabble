<?php 

// Start session 
session_start();
//store qid in session
$_SESSION['qid']=$_GET['qid'];
echo "before config";
// import configuration settings
require 'configuration.php';
echo "after config";
// grab the most recent participant. Result holds mysqli object
$result = $mysqli->query("SELECT demographics_id FROM demographics_test ORDER BY demographics_id DESC LIMIT 1");

// call fetch_assoc() function from the mysqli object $result and store the row information in an array called $row
while ($row = $result->fetch_assoc())
{	
	// store the most recent demographics_id + 1 in a session variable 'demographics_id'
	$_SESSION['demographics_id']=$row['demographics_id'] + 1;
}



// insert qualtrics id to database
$query= "INSERT INTO `qualtrics`(`demographics_id`, `qualtrics_id`) VALUES ('".$_SESSION['demographics_id']."','".$_GET['qid']."')";
$mysqli->query($query); 

// Save qid to SESSION. This will be used as session value for purposes of validating an experiment
$_SESSION['qid'] = $_GET['qid'];

var_dump($_GET);
// determine the groupnum
$_SESSION['groupnum'] = 1;

// condition order count
$_SESSION['static'] = 0;
$_SESSION['interactive'] = 0;
$_SESSION['shuffle'] = 0;

// get the last starting point of the iteration sequence
$sql2 = "SELECT seq FROM demographics_test ORDER BY demographics_id DESC LIMIT 1";
$result2 = $mysqli->query($sql2);
while ($row2 = $result2->fetch_assoc())
{
	$_SESSION['beginning']=((int)$row2['seq']);
}	

// determine the order
$beginning = $_SESSION['beginning'];
for($x = 0; $x < 12; $x++) {
	$seq_combined[$x] = $beginning++;
			
	if($beginning > 12) {
		$beginning = 1;
	}
}
		
// rotate the array elements by 2 for every 3 subjects
if($_SESSION['demographics_id'] % 3 == 0) {
	$temp = array_shift($seq_combined);
	array_push($seq_combined, $temp);
	$temp = array_shift($seq_combined);
	array_push($seq_combined, $temp);
				
	if($_SESSION['beginning'] >= 11) {
		$_SESSION['beginning'] = 1;
	}
	
	else {
		$_SESSION['beginning'] = $_SESSION['beginning'] + 2;
	}

}
	
// randomize each pair
$seq1 = array_slice($seq_combined, 0, 2);
shuffle($seq1);
$seq2 = array_slice($seq_combined, 2, 2);
shuffle($seq2);
$seq3 = array_slice($seq_combined, 4, 2);
shuffle($seq3);
$seq4 = array_slice($seq_combined, 6, 2);
shuffle($seq4);
$seq5 = array_slice($seq_combined, 8, 2);
shuffle($seq5);
$seq6 = array_slice($seq_combined, 10, 2);
shuffle($seq6);
		
$seq_combined = array_merge($seq1, $seq2, $seq3, $seq4, $seq5, $seq6);
		
$_SESSION['seq'] = $seq_combined;

$i=0;
$_SESSION['status'] = $i;
		
// insert a new row for demographics
$query='INSERT INTO `demographics_test`(`demographics_id`, `date`,`groupnum`, `seq`, `qid`) VALUES ("'.$_SESSION['demographics_id'].'",now(),"'.$_SESSION['groupnum'].'","'.$_SESSION['beginning'].'","'.$_SESSION['qid'].'")';

$mysqli->query($query);

// set the variable that checks if the user has finished the experiment
$_SESSION['timed_out'] = 1;

// create session variables for current page and last visited page
$_SESSION['current']=1;
$_SESSION['last']=1;

// Redirect to instruct.php
header('Location: instruct.php');

?>

<!-- 
<script>
	window.top.location.href="instruct.php";
</script>
 -->