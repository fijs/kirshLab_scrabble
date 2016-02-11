<?php 
session_start();		
		include('header.php');
		$arr=$_SESSION['order'];	
		$i=$_SESSION['status'];

?>

<!doctype html>
<html lang="en">
<head>
<?
	//echo "asdf";
	//echo $i;
if($i>6.5) {
 header('Location: paradigm.php');
} 

if($i==3) {
 header('Location: paradigm.php');

} 
?> 

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
  width: 790px;}
  
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
#seconds {
	display:none;
	width: 790px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	font-size: 60px;
	margin-top: 20px;;
    font-family: "Arial", Verdana, sans-serif;

	}
h1 {
	width: 790px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	font-size: 50px;


	}
* {
    font-family: "Arial", Verdana, sans-serif;
    }
  </style>
<?php $stim=array("S", "A", "M","P","L","E","S"); 
?>
 <script type="text/javascript">

function rearr(array) {
  var currentIndex = array.length
    , temporaryValue
    , randomIndex
    ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
var stim = [
	"<li class='ui-state-default'><?php echo $stim[0]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[1]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[2]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[3]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[4]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[5]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[6]; ?></li>"
	];

function shuffle()
{
rearr(stim);
document.getElementById('letters').innerHTML = "<ul id='sortable'>"+stim[0]+stim[1]+stim[2]+stim[3]+stim[4]+stim[5]+stim[6]+"</ul>";
	var replaceme = stim[0]+stim[1]+stim[2]+stim[3]+stim[4]+stim[5]+stim[6];
	replaceme = replaceme.replace(/<li class='ui-state-default'>/g,"");
	replaceme = replaceme.replace(/<\/li>/g,"");
	outputme = replaceme.replace(/<li id='blank'>/g, "&");
    var mydiv = document.getElementById("log");
    mydiv.appendChild(document.createElement("br"));
    mydiv.appendChild(document.createTextNode(outputme + " " + setTime()));
}
function setTime()
{
    ++totalSeconds;
	
    secondsLabel.innerHTML = 20 - Math.round(totalSeconds/100);

	if ((totalSeconds/100) > 20)
	{
	//window.location.href = 'paradigm.php';
	}	
	
	return totalSeconds/100;


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
$(document).keypress(function(){
   window.location.href = 'paradigm.php';
});
  </script>
</head>
<body onload="">
<br><br><br>
<h1>
<?php 
		$i=$_SESSION['status'];
		$arr=$_SESSION['order'];
//		print_r($arr);	
		if($i>2.5)
		{
			$i--;
//			echo $i;
		}
		//echo $i;		
		//$test = $arr[$i].".php";

	if ($arr[$i] == "A") 
	{
    	echo "Tiles will be fixed";
	}elseif ($arr[$i] == "B"){
    	echo "You will be able to move the tiles";

	}elseif ($arr[$i] == "C"){
    	echo "You will be able to shuffle the tiles";
	}
	//kill the next button
	//10 seconds between 1&2
	//15 seconds between a&b
?></h1>
<br><br><br>
<h1>Press any key to continue</h1>
<div id="seconds">
<label id="seconds">0</label>
    <script type="text/javascript">
		var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 0;
        setInterval(setTime, 10);
		//document.getElementById('ding').play();
        
    </script>
</div>

<div style=clear:both></div>
<br>
<center>	
<br><br>
<a href=paradigm.php><button type="button" style="
  background-color: green;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-size: 40px;
    text-decoration: none;
    cursor: pointer;
    width: 200px;
    border:none;">Advance</button></a>
    </div>

<div id="log"></div>

</body>
</html>