<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
.word{
	display:none;
	display:none;
}
.increment {
	display:none;
	float:left;
}
.time {
	display:none;
	float:left;
}
#words {
font-size: 30px;
width: 800px;

}
</style>
<script>
j=1;
var myVar = setInterval(test,1);
var myVar = setInterval(test2,1);

function test() {
$("#info").load("status2.php");
}
function test2() {
$("#words").load("http://caffeine.ucsd.edu/scrabble/status3.php");
}
$(window).keypress(function(e) {
  if (e.keyCode == 0 || e.keyCode == 32) {
    console.log(j);
    $('#'+j).show();
    $('#in'+j).show();
    $('#tim'+j).show();
    totalSeconds=performance.now() / 1000;
    $('#tim'+j).val(Math.round(totalSeconds*100)/100);
    $('#'+j).focus();

    j++;
  }
});
</script>
</head>
<body>
<? 
$order=array('ABCCBA','ABCBAC','ABCACB','BCACBA','BCABAC','BCAACB','CABCBA','CABBAC','CABACB','CBAABC','BACABC','ACBABC','CBABCA','BACBCA','ACBBCA','CBACAB','BACCAB','ACBCAB','CBACBA','BACBAC','ACBACB','CBACBA','BACBAC','ACBACB','CBACBA','BACBAC','ACBACB','ABCABC','ABCBCA','ABCCAB','BCAABC','BCABCA','BCACAB','CABABC','CABBCA','CABCAB');

	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
?>

<div id=info>asdf</div>
<div style="width:500; margin-left: 100px;">
<h1>Experiment #:
<?

$result = $mysqli->query("SELECT * FROM  `data` order by `time` DESC limit 1");
$trialorder=array();
$demographics_id="";
$status="";
while ($row = $result->fetch_assoc())
	{
		echo $row['demographics_id'];
		$demographics_id=$row['demographics_id'];

		$status= $row['status'];
	}
$result = $mysqli->query("SELECT * FROM `demographics` INNER JOIN data ON data.demographics_id=demographics.demographics_id order by data.time desc limit 1");
while ($row = $result->fetch_assoc())
	{
		$trialorder=str_split($order[$row['expnum']-1]);
	}
switch($status)
{
	case null:
		$oder="1";
		break;
	case 0:
		$order="1";
		break;
	case 0.5:
		$order="2";
		break;
	case 1:
		$order="1";
		break;
	case 1.5:
		$order="2";
		break;
	case 2:
		$order="1";
		break;
	case 2.5:
		$order="2";
		break;
	case 3:
		$order="1";
		break;	
	case 3.5:
		$order="2";
		break;
	case 4:
		$order="1";
		break;
	case 4.5:
		$order="2";
		break;
	case 5:
		$order="1";
		break;
	case 5.5:
		$order="1";
		break;
	case 6:
		$order="2";
		break;
}


?>

</h1>
<h1>trial: <?echo $trialorder[$order] . "-" . $order; ?></h1>
<div id=words>



</div>
<form action='subresponse.php' method=post>
<input type=submit value=save>

<table>
<tr><td halign=center>utterance # &nbsp;&nbsp;&nbsp;</td><td bgcolor=black><div style='color:white'>&nbsp;&nbsp;&nbsp;time&nbsp;&nbsp;&nbsp;</div></td><td>utterance</td></tr>
<input type=text hidden name="demographics_id" value=<?php echo $demographics_id; ?>>
<?php
$k=1;
while($k<100)
{

echo "<tr><td><div class='increment' id='in".$k."'><b>".$k."&nbsp;&nbsp;&nbsp;&nbsp;</b></div></td>";
//echo "<td><div class='time' id='tim".$k."'><b>".$k."&nbsp;&nbsp;&nbsp;&nbsp;</b></div></td>";
echo "<td><input class='word' id='".$k."' type=text name=".$k."><div style='clear:both'></div></td>";
echo "<td><input class='word' id='tim".$k."' type=text name=time-".$k."><div style='clear:both'></div></td>";

$k++;
}

?>
</table>

</div>
</form>
</body>
</html>
