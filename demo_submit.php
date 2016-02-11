<?		session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Kirsh Lab</title>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">
  <style>
  #sortable { 
  margin-top: 20%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 820px;}
  
  #sortable li { 
  box-shadow: 4px 4px 10px #888888;
  border: 0px solid; 
  border-radius: 5px; 
  background: #FFDEAD; 
  margin: 10px 10px 10px 0; 
  padding: 1px; 
  padding-top: 9px; 
  float: left; 
  width: 100px; 
  height: 90px; 
  font-size: 4em; 
  text-align: center; 
  background: url("tile.jpg");
  background-size: 103px 100px;
  }
   
 #sortable li#blank{
     background: #FFfdead;
     box-shadow: 0px 0px 0px #888888; 
  background: url("tile.jpg");
  background-size: 30px 100px;
     padding: 1px; 
     padding-top: 9px;
     border: 0px solid;  
     float: left; 
     margin-left: 10px;
     border-radius: 0px;
     width: 25px; height: 90px; font-size: 4em; text-align: center; }
label {
	display: none;
	}
#seconds2{
	margin-left: auto;
	margin-right: auto;
	font-size: 60px;
	display: none;
	color: red;
	}
#tiletype {
	float: left;
	height: 110px;
	text-align: center;
	font-size: 40px;
	color: black;
	margin-left: 10px;
	}
#info {
	display: none;
	}


  </style>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
<script src="js.js"></script>
</head>
<body>
<?php
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	?>
<?php 	
		$_SESSION['static'] = 0;
		$_SESSION['interactive'] = 0;
		$_SESSION['shuffle'] = 0;
		
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
				
				$_SESSION['beginning'] = $_SESSION['beginning'] + 2;
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
		$query='INSERT INTO `demographics_test`(`demographics_id`, `fname`, `lname`, `email`, `age`, `education`, `scrabble`,  `wordgamelike`, `gender`, `native`, `handedness`, `date`, `expnum`, `groupnum`, `seq`) VALUES (NULL,"'.$_POST['fname'].'","'.$_POST['lname'].'","'.$_POST['email'].'","'.$_POST['age'].'","'.$_POST['education'].'","'.$_POST['scrabble'].'","'.$_POST['wordgamelike'].'","'.$_POST['sex'].'","'.$_POST['language'].'","'.$_POST['handedness'].'",now(),"'.$_SESSION['expnum'].'","'.$_SESSION['groupnum'].'","'.$_SESSION['beginning'].'")';

		$mysqli->query($query);
		$f=$_SESSION['expnum'];

switch($f)
{
case 1: $_SESSION['order'] =  str_split('ABCABC'); break; 
case 10: $_SESSION['order'] =  str_split('ABCABC'); break; 
case 19: $_SESSION['order'] =  str_split('ABCABC'); break; 
case 28: $_SESSION['order'] =  str_split('ABCABC'); break; 
case 37: $_SESSION['order'] =  str_split('ABCABC'); break;
case 46: $_SESSION['order'] =  str_split('ABCABC'); break;
case 55: $_SESSION['order'] =  str_split('ABCABC'); break;
case 64: $_SESSION['order'] =  str_split('ABCABC'); break;
case 73: $_SESSION['order'] =  str_split('ABCABC'); break;
case 82: $_SESSION['order'] =  str_split('ABCABC'); break;
case 91: $_SESSION['order'] =  str_split('ABCABC'); break;
case 100: $_SESSION['order'] =  str_split('ABCABC'); break;
case 2: $_SESSION['order'] = str_split('BCAABC'); break; 
case 11: $_SESSION['order'] = str_split('BCAABC'); break;
case 20: $_SESSION['order'] = str_split('BCAABC'); break;
case 29: $_SESSION['order'] = str_split('BCAABC'); break;
case 38: $_SESSION['order'] = str_split('BCAABC'); break;
case 47: $_SESSION['order'] = str_split('BCAABC'); break;
case 56: $_SESSION['order'] = str_split('BCAABC'); break;
case 65: $_SESSION['order'] = str_split('BCAABC'); break;
case 74: $_SESSION['order'] = str_split('BCAABC'); break;
case 83: $_SESSION['order'] = str_split('BCAABC'); break;
case 92: $_SESSION['order'] = str_split('BCAABC'); break;
case 101: $_SESSION['order'] = str_split('BCAABC'); break;
case 3: $_SESSION['order'] = str_split('CABABC'); break;
case 12: $_SESSION['order'] = str_split('CABABC'); break;
case 21: $_SESSION['order'] = str_split('CABABC'); break;
case 30: $_SESSION['order'] = str_split('CABABC'); break;
case 39: $_SESSION['order'] = str_split('CABABC'); break;
case 48: $_SESSION['order'] = str_split('CABABC'); break;
case 57: $_SESSION['order'] = str_split('CABABC'); break;
case 66: $_SESSION['order'] = str_split('CABABC'); break;
case 75: $_SESSION['order'] = str_split('CABABC'); break;
case 84: $_SESSION['order'] = str_split('CABABC'); break;
case 93: $_SESSION['order'] = str_split('CABABC'); break;
case 102: $_SESSION['order'] = str_split('CABABC'); break;
case 4: $_SESSION['order'] = str_split('BCABCA'); break;
case 13: $_SESSION['order'] = str_split('BCABCA'); break;
case 22: $_SESSION['order'] = str_split('BCABCA'); break;
case 31: $_SESSION['order'] = str_split('BCABCA'); break;
case 40: $_SESSION['order'] = str_split('BCABCA'); break;
case 49: $_SESSION['order'] = str_split('BCABCA'); break;
case 58: $_SESSION['order'] = str_split('BCABCA'); break;
case 67: $_SESSION['order'] = str_split('BCABCA'); break;
case 76: $_SESSION['order'] = str_split('BCABCA'); break;
case 85: $_SESSION['order'] = str_split('BCABCA'); break;
case 94: $_SESSION['order'] = str_split('BCABCA'); break;
case 103: $_SESSION['order'] = str_split('BCABCA'); break;
case 5: $_SESSION['order'] = str_split('BCACAB'); break;
case 14: $_SESSION['order'] = str_split('BCACAB'); break;
case 23: $_SESSION['order'] = str_split('BCACAB'); break;
case 32: $_SESSION['order'] = str_split('BCACAB'); break;
case 41: $_SESSION['order'] = str_split('BCACAB'); break;
case 50: $_SESSION['order'] = str_split('BCACAB'); break;
case 59: $_SESSION['order'] = str_split('BCACAB'); break;
case 68: $_SESSION['order'] = str_split('BCACAB'); break;
case 77: $_SESSION['order'] = str_split('BCACAB'); break;
case 86: $_SESSION['order'] = str_split('BCACAB'); break;
case 95: $_SESSION['order'] = str_split('BCACAB'); break;
case 104: $_SESSION['order'] = str_split('BCACAB'); break;
case 6: $_SESSION['order'] = str_split('CABBCA'); break;
case 15: $_SESSION['order'] = str_split('CABBCA'); break;
case 24: $_SESSION['order'] = str_split('CABBCA'); break;
case 33: $_SESSION['order'] = str_split('CABBCA'); break;
case 42: $_SESSION['order'] = str_split('CABBCA'); break;
case 51: $_SESSION['order'] = str_split('CABBCA'); break;
case 60: $_SESSION['order'] = str_split('CABBCA'); break;
case 69: $_SESSION['order'] = str_split('CABBCA'); break;
case 78: $_SESSION['order'] = str_split('CABBCA'); break;
case 87: $_SESSION['order'] = str_split('CABBCA'); break;
case 96: $_SESSION['order'] = str_split('CABBCA'); break;
case 105: $_SESSION['order'] = str_split('CABBCA'); break;
case 7: $_SESSION['order'] = str_split('CABCAB'); break;
case 16: $_SESSION['order'] = str_split('CABCAB'); break;
case 25: $_SESSION['order'] = str_split('CABCAB'); break;
case 34: $_SESSION['order'] = str_split('CABCAB'); break;
case 43: $_SESSION['order'] = str_split('CABCAB'); break;
case 52: $_SESSION['order'] = str_split('CABCAB'); break;
case 61: $_SESSION['order'] = str_split('CABCAB'); break;
case 70: $_SESSION['order'] = str_split('CABCAB'); break;
case 79: $_SESSION['order'] = str_split('CABCAB'); break;
case 88: $_SESSION['order'] = str_split('CABCAB'); break;
case 97: $_SESSION['order'] = str_split('CABCAB'); break;
case 106: $_SESSION['order'] = str_split('CABCAB'); break;
case 8: $_SESSION['order'] = str_split('ABCBCA'); break;
case 17: $_SESSION['order'] = str_split('ABCBCA'); break;
case 26: $_SESSION['order'] = str_split('ABCBCA'); break;
case 35: $_SESSION['order'] = str_split('ABCBCA'); break;
case 44: $_SESSION['order'] = str_split('ABCBCA'); break;
case 53: $_SESSION['order'] = str_split('ABCBCA'); break;
case 62: $_SESSION['order'] = str_split('ABCBCA'); break;
case 71: $_SESSION['order'] = str_split('ABCBCA'); break;
case 80: $_SESSION['order'] = str_split('ABCBCA'); break;
case 89: $_SESSION['order'] = str_split('ABCBCA'); break;
case 98: $_SESSION['order'] = str_split('ABCBCA'); break;
case 107: $_SESSION['order'] = str_split('ABCBCA'); break;
case 9: $_SESSION['order'] = str_split('ABCCAB'); break;
case 18: $_SESSION['order'] = str_split('ABCCAB'); break;
case 27: $_SESSION['order'] = str_split('ABCCAB'); break;
case 36: $_SESSION['order'] = str_split('ABCCAB'); break;
case 45: $_SESSION['order'] = str_split('ABCCAB'); break;
case 54: $_SESSION['order'] = str_split('ABCCAB'); break;
case 63: $_SESSION['order'] = str_split('ABCCAB'); break;
case 72: $_SESSION['order'] = str_split('ABCCAB'); break;
case 81: $_SESSION['order'] = str_split('ABCCAB'); break;
case 90: $_SESSION['order'] = str_split('ABCCAB'); break;
case 99: $_SESSION['order'] = str_split('ABCCAB'); break;
case 108: $_SESSION['order'] = str_split('ABCCAB'); break;
}


?>

<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

 <script type="text/javascript">

function load()
{
}



var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=80-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	if (totalSeconds > 82)
	{


	}	


	if (totalSeconds > 5)
	{

	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

  </script>
</head>
<body>
<div id="tiletype">Tiles are fixed</div><div style="clear:both"></div>
<div style="margin-left: 400px; margin-right: auto; margin-bottom: -200px; margin-top: -100px;">
<ul style="font-size: 24px;">
<li>You will have 3 minutes</li>
<li>Call out all the words you can make.</li>
<li>Only words with 3 or more letters count.</li>
<li>Proper names like "SAM" do not count.</li>
<li>All legal words are worth one point.</li>
<li>Big words are worth no extra</li>
<li>If two words sound the same like "TOO" or "TWO", spell them out.</li>
<li>There are no penalties for calling out the same word twice, or calling out nonsense words</li>
<li>A timer appears when 10 seconds remain</li>
<li>Click Next</li>

</ul>
</div>

<div id="letters"> 
<ul id="sortable">
<?php 
$stim=array("M", "C", "A","I","H","N","E"); 

$start_li="<li class='ui-state-default'>";
$close_li="</li>";
$i = 0;
while ($i<=6) {
echo $start_li.$stim[$i].$close_li;
$i++;
}
?>
</ul>
</div><br><br><br><br><br><br><br><br>
<center>
<div id="info"></div>
<div id="seconds2">0</div>

<div style="clear:both"></div>
<br><br><br><br>
<center>
<a href=begin.php><button type="button" style="background-color: grey;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none;">Next</button></a>

</center>
<br><br><br><br><br>
</body>
</html>
