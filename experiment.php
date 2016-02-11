<? 
//session start is a key php variable
session_start();

		// connect to database
		$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
		if (mysqli_connect_errno()) 
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
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
		if($i<7)
		{
		$test = $arr[$i].".php";
		
		// test only
		//$test = "a.php";
		
		$test = strtolower($test);
		}

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
		include $test;
		break;
	case 0.5:
		//$order="2";
		//$order = strval($seq_combined[1]);
		$order = $_SESSION['seq'][1];
		include $test;
		break;
	case 1:
		//$order="1";
		//$order = strval($seq_combined[2]);
		$order = $_SESSION['seq'][2];
		include $test;
		break;
	case 1.5:
		//$order="2";
		//$order = strval($seq_combined[3]);
		$order = $_SESSION['seq'][3];
		include $test;
		break;
	case 2:
		//$order="1";
		//$order = strval($seq_combined[4]);
		$order = $_SESSION['seq'][4];
		include $test;
		break;
	case 2.5:
		//$order="2";
		//$order = strval($seq_combined[5]);
		$order = $_SESSION['seq'][5];
		include $test;
		break;
	case 3:
		include 'break.php';
		break;	
	case 4:
		//$order="3";
		//$order = strval($seq_combined[6]);
		$order = $_SESSION['seq'][6];
		include $test;
		break;
	case 4.5:
		//$order="4";
		//$order = strval($seq_combined[7]);
		$order = $_SESSION['seq'][7];
		include $test;
		break;
	case 5:
		//$order="3";
		//$order = strval($seq_combined[8]);
		$order = $_SESSION['seq'][8];
		include $test;
		break;
	case 5.5:
		//$order="4";
		//$order = strval($seq_combined[9]);
		$order = $_SESSION['seq'][9];
		include $test;
		break;
	case 6:
		//$order="3";
		//$order = strval($seq_combined[10]);
		$order = $_SESSION['seq'][10];
		include $test;
		break;
	case 6.5:
		//$order="4";
		//$order = strval($seq_combined[11]);
		$order = $_SESSION['seq'][11];
		include $test;
		break;
	case 7:
		$_SESSION['status']= 0;
		include 'thankyou.php';
		break;



}
	
	$_SESSION['status']+=.5;		
?>
