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
  #sortable { 
  margin-top: 20%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 790px;
  }
  
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
			 #log {
	 display: none;
	 }
	 #seconds2 {
		display: none;
		}
	#info {
		display: none;
		}
#tiletype {
	float: left;
	height: 110px;
	text-align: center;
	font-size: 40px;
	color: black;
	margin-left: 10px;
	}
	#seconds2{
	margin-left: auto;
	margin-right: auto;
	font-size: 60px;
	color: red;
	}
	button {
  background-color: green;
	}
  </style>
  
	

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
	rounded=51-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;
	if (totalSeconds > 41)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	
	if (totalSeconds > 51)
	{
		$('#seconds2').css({
			display: 'none'
			});
	}	


	if (totalSeconds > 51)
	{

//	window.location = 'waiting_screen.php';
	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);


var count=0;
var stim =["S", "A", "M","P","L","E","S"];
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
function shufflearr(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};
function shuffle() {

shufflearr(stim);
document.getElementById('letters').innerHTML = "<ul id='sortable'><li class='ui-state-default'>"+stim[0]+"</li><li class='ui-state-default'>"+stim[1]+"</li><li class='ui-state-default'>"+stim[2]+"</li><li class='ui-state-default'>"+stim[3]+"</li><li class='ui-state-default'>"+stim[4]+"</li><li class='ui-state-default'>"+stim[5]+"</li><li class='ui-state-default'>"+stim[6]+"</li></ul>";
	var outputme = stim[0]+"," +stim[1]+"," +stim[2]+"," +stim[3]+"," +stim[4]+"," +stim[5]+"," +stim[6];
    var mydiv = document.getElementById("log");
      mydiv.appendChild(document.createElement("hr"));
    mydiv.appendChild(document.createElement("br"));
    totalSeconds=performance.now() / 1000;
    mydiv.appendChild(document.createTextNode(outputme + " " + totalSeconds));
     mydiv.appendChild(document.createElement("hr"));
    mydiv.appendChild(document.createElement("br"));

};
function load()
{
shufflearr(stim);
}
//  $(function() {
//    $( "#sortable" ).sortable({
 //   start: function(event, ui) {
//        ui.item.startPos = ui.item.index();
//    },
//    stop: function(event, ui) {
//	var mydiv = document.getElementById("log");
//	stim[9] = stim[ui.item.index()];
//	stim[ui.item.index()] = stim[ui.item.startPos];
//	stim[ui.item.startPos] = stim[9];
//	var replaceme = stim[0]+stim[1]+stim[2]+stim[3]+stim[4]+stim[5]+stim[6]+stim[7]+stim[8];
//	replaceme = replaceme.replace(/<li class='ui-state-default'>/g,"");
//	replaceme = replaceme.replace(/<\/li>/g,"");
//	outputme = replaceme.replace(/<li id='blank'>/g, "&");
  //  var mydiv = document.getElementById("log");
  //  mydiv.appendChild(document.createTextNode("asdf"));
      
    //}

//});
 //   $( "#sortable" ).disableSelection();

//});
  </script>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

</head>
<body onload="load()">
<div id="tiletype">You can shuffle the tiles.</div>
<div stlye="clear:both"></div><br>
<div id="info"></div>
<div id="testing">
</div>



<div id="letters"> 
<ul id="sortable">

<?php 
$stim=array("S", "A", "M","P","L","E","S"); 
$start_li="<li class='ui-state-default'>";
$close_li="</li>";
$i = 0;
while ($i<=6) {
echo $start_li.$stim[$i].$close_li;
//if ($i==2){
//	   echo "<li id='blank'> </li>";
//}
//if ($i==3){
//	   echo "<li id='blank'> </li>";
//}

$i++;
}
?>
</ul>
</div>

<div style=clear:both></div>
<br>
<center>	

<button type="button" style="

    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;

    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    width: 200px;
	margin-top: 30px;
    border:none;" onclick="shuffle()">Shuffle</button>

    </div>
<div style="clear:both"></div>
<br><br>
<center>
<div id="seconds2">0</div>
<div id="log"><?php echo $stim[0].", ".$stim[1].", ".$stim[2].", ".$stim[3].", ".$stim[4].", ".$stim[5].", ".$stim[6]." 0.0";
?>

</div>
<br><br><br><br><br>



</body>
</html>