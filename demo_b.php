<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <title>Kirsh Lab</title>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="touchpunch.js"></script>
  <style>
	#log {
	width: 300px;
	}
  #sortable { 
  margin-top: 20%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 880px;}
  
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
   
 #sortable li.blank{
     background: green;
     color: green;
     box-shadow: 0px 0px 0px #888888; 
  background-size: 30px 100px;
     padding: 1px; 
     padding-top: 9px;
     border: 0px solid;  
     float: left; 
     margin-left: 10px;
     border-radius: 0px;
     font-size: 2px;
     width: 25px; height: 90px;  text-align: center; }
	 #log {
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

  </style>
<?php 
	$array=array("-", "S", "A", "M","P","L","E","S", "--"); 
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$stim=array("S", "A", "M","P","L","E","S"); 
	$result = $mysqli->query("SELECT * FROM  `B` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."'");
	while ($row = $result->fetch_assoc())
	{
		$array=str_split($row['stim']);
		array_unshift($array, "-");
		array_push($array,"--");
	}
?>

 <script type="text/javascript">

var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=11-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;
	if (totalSeconds > 10)
	{

	}	


	if (totalSeconds > 20)
	{

	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);



function load()
{
$("#info").load("process-b.php?stim=<?php echo $array[0].','.$array[1].','.$array[2].','.$array[3].','.$array[4].','.$array[5].','.$array[6].','.$array[7].','.$array[8]; ?>&status=<?php echo $_SESSION['status']; ?>"); 
}
  $(function() {
    $( "#sortable" ).sortable({
    start: function(event, ui) {
		console.log(event);
    },
    update : function () { 
      var order = $('#sortable').sortable('serialize'); 
		totalSeconds=performance.now() / 1000;
	  replaceme = order.replace(/let/g," ");
	  replaceme = replaceme.replace(/\]/g," ");
	  replaceme = replaceme.replace(/\[/g," ");
	  replaceme = replaceme.replace(/\=/g," ");
	  replaceme = replaceme.replace(/\&/g,",");
	  replaceme = replaceme.replace(/0/g,"<?php echo $array[0]; ?>");
	  replaceme = replaceme.replace(/1/g,"<?php echo $array[1]; ?>");
	  replaceme = replaceme.replace(/2/g,"<?php echo $array[2]; ?>");
  	  replaceme = replaceme.replace(/3/g,"<?php echo $array[3]; ?>");
	  replaceme = replaceme.replace(/4/g,"<?php echo $array[4]; ?>");
	  replaceme = replaceme.replace(/5/g,"<?php echo $array[5]; ?>");
	  replaceme = replaceme.replace(/6/g,"<?php echo $array[6]; ?>");
	  replaceme = replaceme.replace(/7/g,"<?php echo $array[7]; ?>");
	  replaceme = replaceme.replace(/8/g,"<?php echo $array[8]; ?>");
  	  replaceme = replaceme.replace(/ /g,"");


//	  var container = document.getElementById('log');
//	  container.innerHTML = order;  
		$("#info").load("process-b.php?stim="+replaceme+"%20new&status=<?php echo $_SESSION['status']; ?>&time="+totalSeconds); 


	  var mydiv = document.getElementById("log");
	  mydiv.appendChild(document.createTextNode(replaceme));
	  mydiv.appendChild(document.createElement("br"));  
   	totalSeconds=performance.now()/1000;
 
	  mydiv.appendChild(document.createTextNode(totalSeconds));
	  mydiv.appendChild(document.createElement("hr"));   


	}
});
    $( "#sortable" ).disableSelection();

});
function asdf(which)
{
	  var mydiv = document.getElementById("log");
	  mydiv.appendChild(document.createTextNode(which + " is starting to move"));
	  mydiv.appendChild(document.createElement("br"));   
		totalSeconds=performance.now() / 1000;
	  mydiv.appendChild(document.createTextNode(totalSeconds));
	  mydiv.appendChild(document.createElement("hr"));   
		$("#info").load("process-b.php?stim="+which+"%20init%20move&status=<?php echo $_SESSION['status']; ?>&time="+totalSeconds); 

}


  </script>
  <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

</head>
<body onload="load()">
<div id="tiletype">You can move the tiles.</div><div style="clear:both"></div>
<div id="info"></div>

<div id="letters"> 
<ul id="sortable">

<?php 
$close_li="</li>";
$i = 0;
while ($i<=8) {
if($array[$i]=="-" || $array[$i]=="--"){
$start_li="<li class='blank' onmousedown=\"asdf('".$array[$i]."_blank')\" id='let_".$i."'>";
	}else{
$start_li="<li class='ui-state-default' onmousedown=\"asdf('".$array[$i]."')\" id='let_".$i."'>";
}
echo $start_li.$array[$i].$close_li;
//if ($i==2){
//	   echo "<li name='test' id='blank'> </li>";
//}
//if ($i==3){
//	   echo "<li id='blank'> </li>";
//}

$i++;
}
?>
</ul>

<div style=clear:both></div>
<center>	
<div id="seconds2">0</div>
<div id="log">
<? echo $array[0].", ".$array[1].", ".$array[2].", ".$array[3].", ".$array[4].", ".$array[5].", ".$array[6].", ".$array[7].", ".$array[8]."<br>0.00<br><hr>";?>

</div>



<br><br><br><br>
</body>
</html>