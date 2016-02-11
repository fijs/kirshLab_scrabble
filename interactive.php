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
	width: 160px;
	}
  #sortable { 
  margin-top: 20%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 1008px;}
  
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
  </style>
<?php $array=$array2=array("S", "A", "M","P","L","E","S", " ", " "); 
shuffle($array);

?>
 <script type="text/javascript">

        function setTime()
        {
            ++totalSeconds;
            secondsLabel.innerHTML = (totalSeconds/100)-1.75;
			return totalSeconds/100;
        	if (totalSeconds > 10000)
        	{
        	//document.getElementById('stop').play();
        		alert("Best to close the window for now....");
        		}
        }

function load()
{
//document.getElementById('ding').play();
}
  $(function() {
    $( "#sortable" ).sortable({
    start: function(event, ui) {

    },
    update : function () { 
      var order = $('#sortable').sortable('serialize'); 

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
//	  var container = document.getElementById('log');
//	  container.innerHTML = order;  
	  var mydiv = document.getElementById("log");
	  mydiv.appendChild(document.createTextNode(replaceme));
	  mydiv.appendChild(document.createElement("br"));   
	  mydiv.appendChild(document.createTextNode(totalSeconds/100 - 1.75));
	  mydiv.appendChild(document.createElement("hr"));   
	}
});
    $( "#sortable" ).disableSelection();

});



  </script>
</head>
<body onload="load()">
<div id="asdf">asdf</div>
<label id="seconds">0</label>
    <script type="text/javascript">
		var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 0;
        setInterval(setTime, 10);
		//document.getElementById('ding').play();
        
    </script>
<audio id="ding" src="ready_begin.mp3"></audio>
<audio id="stop" src="2.mp3"></audio>
<div id="letters"> 
<ul id="sortable">

<?php 
$close_li="</li>";
$i = 0;
while ($i<=8) {
$start_li="<li class='ui-state-default' id='let_".$i."'>";

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
<div id="log">
<? echo $array[0].", ".$array[1].", ".$array[2].", ".$array[3].", ".$array[4].", ".$array[5].", ".$array[6].", ".$array[7].", ".$array[8]."<br>0.00<br><hr>";?>

</div>


<div id="asdf">

</div>

<a href="javascript:ReplaceContentInContainer('asdf','<?php shuffle($array); echo $array[0].$array[1].$array[2].$array[3].$array[4].$array[5].$array[6]; ?>')">
click
</a>
 
</body>
</html>