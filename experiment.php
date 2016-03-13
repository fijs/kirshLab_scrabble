<?php

//session start is a key php variable
session_start();

if(!isset($_SESSION['expKey']))
{
	header("location: index.php");
}

/*
$test = $_SESSION['expKey'];
echo "<script>console.log( 'expKey: " . $test . "' );</script>";
// Check if they come from qualtrics.php (which is where we redirect from the qualtrics survey) 

require 'configuration.php';


	$_SESSION['current']=7;
	
	$curr = $_SESSION['current'];
	$output = "<script>console.log( 'CURRENT INDEX: " . $curr . "' );</script>";
	echo $output;
	$last = $_SESSION['last'];
	$output2 = "<script>console.log( 'LAST VISITED: " . $last . "' );</script>";
	echo $output2;
	
if($_SESSION['expstart']==0){
	$temp = $_SESSION['expstart'];
	$_SESSION['expstart']= $temp+1;
	if($_SESSION['current'] <= $_SESSION['last']){
			// delete data
			$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$curr = $_SESSION['current'];
			$output = "<script>console.log( 'CURRENT INDEX111: " . $curr . "' );</script>";
			echo $output;
			$last = $_SESSION['last'];
			$output2 = "<script>console.log( 'LAST VISITED111: " . $last . "' );</script>";
			echo $output2;
			session_destroy();
			header("location: index.php");
	}
}
else if($_SESSION['expstart']>0){
	$temp = $_SESSION['expstart'];
	$_SESSION['expstart']=$temp+1;
	if($_SESSION['current'] != $_SESSION['last']){
			// delete data
			$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$curr = $_SESSION['current'];
			$output = "<script>console.log( 'CURRENT INDEX222: " . $curr . "' );</script>";
			echo $output;
			$last = $_SESSION['last'];
			$output2 = "<script>console.log( 'LAST VISITED222: " . $last . "' );</script>";
			echo $output2;
			session_destroy();
			header("location: index.php");
	}
}
	$_SESSION['last']=7;
*/
require 'configuration.php';
// determine the sequence
$condition_order = ($_SESSION['demographics_id'] % 6) + 1;

// various orderings of tests to load. tests a, b, c
switch($condition_order) {
	case 1: $_SESSION['order'] = str_split('ABCCBA'); break;
	case 2: $_SESSION['order'] = str_split('BCAABC'); break;
	case 3: $_SESSION['order'] = str_split('CABBAC'); break;
	case 4: $_SESSION['order'] = str_split('CBAABC'); break;
	case 5: $_SESSION['order'] = str_split('ACBBCA'); break;
	case 6: $_SESSION['order'] = str_split('BACCAB'); break;
}

//stores data into arr. The value of SESSION variable index order is set when session_start is called
$arr=$_SESSION['order'];	
$input = $arr;
$output = array_slice($input,3);
$output2 = array_slice($input,0,3);
array_push($output2, " ");
$arr = array_merge($output2, $output);
$i=$_SESSION['status'];

if($i<7){
	$test = $arr[$i].".php";
		/* [ 0 0.5 1 1.5 2 2.5 3 3.5 4 4.5 5 5.5 6 6.7 7 ] */
		/* [ A  B  A  A  C  ]*/

		// test only
		//$test = "a.php";

	$test = strtolower($test);

		//	echo "$_SESSION['status']: " .$_SESSION['status'] ."\n";
		//echo "$test: ".$test . " \n";
	
			/*echo "test : ".$test;
			echo "<br>";
			echo "session : ". $_SESSION['status'];
			echo "<br>";
			echo " array : ". $arr[$_SESSION['status']];
			echo "<br>";*/
}// end if condition

// check if the user refreshed or pressed back
if($_SESSION['timed_out'] == 0) {	
	// delete data
	$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
	$mysqli->query($delete_q);
	$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
	$mysqli->query($delete_q);
	$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
	$mysqli->query($delete_q);
	$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
	$mysqli->query($delete_q);
	// redirect to the thank you page
	$_SESSION['status'] = 7;
}
		
$_SESSION['timed_out'] = 0;
$order="0";
switch($_SESSION['status'])
{
	
	case 0:
		//$order="1";
		//$order = strval($seq_combined[0]);
		$order = $_SESSION['seq'][0];
		//echo "Case 0  ".$test;
		include $test;
		//echo "including : ". $test;
		break;
	case 0.5:
		//$order="2";
		//$order = strval($seq_combined[1]);
		$order = $_SESSION['seq'][1];
		//echo "Case 0.5  ".$test;
		include $test;
		//echo "including : ". $test;
		break;
	case 1:
		//$order="1";
		//$order = strval($seq_combined[2]);
		$order = $_SESSION['seq'][2];
		//echo "Case 1  ".$test;
		include $test;
		//echo "including : ". $test;
		break;
	case 1.5:
		//$order="2";
		//$order = strval($seq_combined[3]);
		$order = $_SESSION['seq'][3];
		//echo "Case 1.5  ".$test;
		include $test;
		//echo "including : ". $test;
		break;
	case 2:
		//$order="1";
		//$order = strval($seq_combined[4]);
	//	echo "including11 : ". $test;
		$order = $_SESSION['seq'][4];
		//echo "Case 2  ".$test;
		include $test;
		//echo "including22 : ". $test;
		break;
	case 2.5:
		//$order="2";
		//$order = strval($seq_combined[5]);
		$order = $_SESSION['seq'][5];
		//echo "Case 2.5  ".$test;
		include $test;
		//echo "including : ". $test;
		break;
	case 3:
		include 'break.php';
		break;	
	case 4:
		//$order="3";
		//$order = strval($seq_combined[6]);
		$order = $_SESSION['seq'][6];
		//echo "Case 4  ".$test;
		include $test;
		//echo "including : ". $test;
		break;
	case 4.5:
		//$order="4";
		//$order = strval($seq_combined[7]);
		$order = $_SESSION['seq'][7];
		//echo "Case 4.5  ".$test;
		include $test;
		break;
	case 5:
		//$order="3";
		//$order = strval($seq_combined[8]);
		$order = $_SESSION['seq'][8];
		//echo "Case 5  ".$test;
		include $test;
		break;
	case 5.5:
		//$order="4";
		//$order = strval($seq_combined[9]);
		$order = $_SESSION['seq'][9];
		//echo "Case 5.5  ".$test;
		include $test;
		break;
	case 6:
		//$order="3";
		//$order = strval($seq_combined[10]);
		$order = $_SESSION['seq'][10];
		//echo "Case 6  ".$test;
		include $test;
		break;
	case 6.5:
		//$order="4";
		//$order = strval($seq_combined[11]);
		$order = $_SESSION['seq'][11];
		//echo "Case 6.5  ".$test;
		include $test;
		break;
	case 7:
		$_SESSION['status']= 0;
		//echo "Case 0  ".$test;
		include 'thankyou.php';
		break;



}
	
	$_SESSION['status']+=.5;		

?>
