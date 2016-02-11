<html>
<head>
<style>
* {

	font-family: arial;
	font-size: 10px;
	color: black;
}
</style>
</head>
<body>

<table border=1>
<? 
	$demos=array("681","685","741","743","744","745","747","748","750", "751","752","753","754","755","760","761","763","764","765","766");
foreach($demos as $demo)
{
	$staticduplicates=$interactiveduplicates=$shuffleduplicates=0;
	$static=$interactive=$shuffle=0;
	$staticfreq=$interactivefreq=$shufflefreq=0;

	$x=0;
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$freqarr=array();
	$movingorder=array();
	$shuffleorder=array();
	$amountmoved=array();
	$amountshuffled=array();
	$amountshuffledlast=array();
	$qry='SELECT DISTINCT `status` FROM `data` WHERE `demographics_id` = "'.$demo.'" AND `condition`="moving"';
	$result = $mysqli->query($qry);
	while ($row = $result->fetch_assoc())
	{	
		array_push($movingorder, $row['status']);
	}
	$jj=0;
	while($jj<4)
	{	
		$qry='SELECT * FROM  `data` WHERE `status`="'.$movingorder[$jj].'" AND `demographics_id` =  "'.$demo.'" AND  `condition` =  "moving"';
//		echo $qry . "<br>";
		$result = $mysqli->query($qry);
		$i=0;
		while ($row = $result->fetch_assoc())
		{	
			//echo $row['stim'];
			$temp=preg_replace("/-/","",$row['stim']);
			$temp=preg_replace("/[A-Z]/","",$temp);
			$temp=preg_replace("/,/","",$temp);		
			$temp=preg_replace("/blank/","",$temp);		
			$temp=preg_replace("/init move/","",$temp);		
			$temp=preg_replace("/_/","",$temp);		
			$temp=preg_replace("/ /","",$temp);	
			if($temp=="new")
			{
				$i++;
			}

		}		
		array_push($amountmoved, $i);	
		$jj++;
	}
	$qry='SELECT DISTINCT `status` FROM `data` WHERE `demographics_id` = "'.$demo.'" AND `condition`="shuffle"';
	$result = $mysqli->query($qry);
	while ($row = $result->fetch_assoc())
	{	
		array_push($shuffleorder, $row['status']);
	}	
	$kk=0;
	$amountshuffledlast3=0;
	while($kk<4)
	{	
		$qry='SELECT * FROM  `data` WHERE `status`="'.$shuffleorder[$kk].'" AND `demographics_id` =  "'.$demo.'" AND  `condition` =  "shuffle" ORDER BY TIME ASC';
		$result = $mysqli->query($qry);
		//array_push($amountshuffled, $row['num_rows']);
		array_push($amountshuffled, $result->num_rows);
		$j=0;
		while ($row = $result->fetch_assoc())
		{	
			if($row['paradigm_time'] > 120)
			{
				$amountshuffledlast3++;
			}			

		}

//		echo $result->num_rows . "<br>";
	//	echo $amountshuffledlast3 . "<br>";
		array_push($amountshuffledlast, $amountshuffledlast3);
		$amountshuffledlast3=0;
		$kk++;
	}


	$positionarray=array("STATIC1",	"STATIC2","STATIC3","STATIC4","INTERACTIVE1","INTERACTIVE2","INTERACTIVE3","INTERACTIVE4","SHUFFLE1","SHUFFLE2","SHUFFLE3","SHUFFLE4");
	$words=array("TUSHING","SECONDE","UPROOTS","DELVING","BREATHE","LARCENY","FADDIER","PASSKEY","FAUCETS","WAITRON","WHORLED","LOGWAYS");

	foreach($positionarray as $position_in_array)
	{
		echo "<td valign=top><table>";
		$numberofvalidresponsemin1=$numberofvalidresponsemin2=$numberofvalidresponsemin3=0;
		$groupcheck = preg_replace("/[1-4]/", "", $position_in_array);
		$groupcheck2 = strtolower($groupcheck);

//		echo $position_in_array."</td>";
//		echo "<td colspan=2>".$words[$x]."</td></tr>";
		$test="SELECT * FROM `all_words` WHERE `stimuli` = '".$words[$x]."'";
		$result = $mysqli->query($test);
		$totalwords=$result->num_rows;
		$validwords=array();
		$freqarr=array();
		while ($row = $result->fetch_assoc())
		{	
			array_push($validwords, $row['word']);
		}		
		$result = $mysqli->query("SELECT * FROM `coding-good` WHERE `demographics_id` = ".$demo." AND `position`='" . $position_in_array . "'" . "ORDER BY `coding-good`.`time`  ASC");

		$check=array();
		$numberofduplicates=0;
		$numberofvalid=0;
		$freqtotal=0;
		while ($row = $result->fetch_assoc())
		{
			if($row['word']=="START")
			{
				$begintime=strtotime($row['time']);
			}else{
				$eventtime=strtotime($row['time']);
				$time=$eventtime-$begintime;
//				echo "<tr><td>".$time."</td><td>" . $row['word'] . "</td><td>";

				$result2 = $mysqli->query('SELECT * FROM `all_words` WHERE `word`="'.$row['word'].'" LIMIT 1');
					while ($row2=$result2->fetch_assoc())
					{
//						echo round($row2['ngram_value']*1000000, 2);
						$freqtotal+=$row2['ngram_value']*1000000;	
					}
				if(in_array($row['word'], $validwords))
				{

										
					
//					echo"<td>VALID</td>";
				}else{
//					echo "<td><font color=red>INVALID</font></td>";
				}
//					echo "</td></tr>";

				if(in_array($row['word'], $check))
				{
					$numberofduplicates++;
				}
				if(!in_array($row['word'], $check) && in_array($row['word'], $validwords))
				{
					array_push($check, $row['word']);
					$numberofvalid++;
					if($time <= 60)
					{
						$numberofvalidresponsemin1++;
					}
					if($time > 60 && $time <= 120)
					{
						$numberofvalidresponsemin2++;
					}
					if($time > 120)
					{
						$numberofvalidresponsemin3++;
					}
				$result2 = $mysqli->query('SELECT * FROM `all_words` WHERE `word`="'.$row['word'].'" LIMIT 1');
					while ($row2=$result2->fetch_assoc())
					{
						array_push($freqarr, $row2['ngram_value']*1000000);
						$freqtotal+=$row2['ngram_value']*1000000;
	
					}
				}
				
			} //end else
		} //end while


		if($groupcheck=="STATIC")
		{
			$static+=$numberofvalid;
			$staticduplicates+=$numberofduplicates;
			$staticfreq+=$freqtotal;
		}
		if($groupcheck=="INTERACTIVE")
		{
			$interactive+=$numberofvalid;
			$interactiveduplicates+=$numberofduplicates;
			$interactivefreq+=$freqtotal;
		}
		if($groupcheck=="SHUFFLE")
		{
			$shuffle+=$numberofvalid;
			$shuffleduplicates+=$numberofduplicates;
			$shufflefreq+=$freqtotal;
		}
	echo "<tr><td>";
		$groupcheck = preg_replace("/[1-4]/", "", $position_in_array);
		$groupcheck2 = strtolower($groupcheck);
		echo $position_in_array."</td>";
		echo "<td>".$words[$x]."</td><td></td><td></td></tr>";
		echo "<tr><td><b>Valid</b></td><td>".$numberofvalid. "</td><td></td><td></td></tr>";
		sort($freqarr);
		$countfreqarr = count($freqarr);
		$middlevalfreqarr = floor(($countfreqarr-1)/2);
//		echo $middlevalfreqarr;
		if($countfreqarr % 2)
		{
			$median = $freqarr[$middlevalfreqarr];
		}else{
			$low=$freqarr[$middlevalfreqarr];
			$high=$freqarr[$middlevalfreqarr+1];
			$median=(($low+$high)/2);
		}
//		print_r($freqarr);
		echo "<tr><td><b>Median Frequency:</b> </td><td>".round($median,2). "</td><td></td><td></td></tr>";
		echo "<tr><td><b>Valid Minute 1: </b></td><td>".$numberofvalidresponsemin1."</td><td></td><td></td></tr>";
		echo "<tr><td><b>Valid Minute 2: </b></td><td>".$numberofvalidresponsemin2."</td><td></td><td></td></tr>";
		echo "<tr><td><b>Valid Minute 3: </b></td><td>".$numberofvalidresponsemin3."</td><td></td><td></td></tr>";		

//		echo "<b> duplicate : </b>".$numberofduplicates. "</b><br>";
//		echo "<b>Word Frequency Total: </b>".$freqtotal. "</b><br>";
//		echo "<b>Mean Frequency: </b>".$freqtotal/$numberofvalid. "</b><br>";
//		print_r($freqarr);

		echo "<tr><td><b>Total Words Possible: </b></td><td>".$totalwords. "</td><td></td><td></td></tr>";

		$numberofvalidresponsemin1=$numberofvalidresponsemin2=$numberofvalidresponsemin3=0;
		$test="SELECT * FROM `all_words` WHERE `stimuli` = '".$words[$x]."'";
		$result = $mysqli->query($test);
		$totalwords=$result->num_rows;
//		$validwords=array();
		$freqarr=array();
//		while ($row = $result->fetch_assoc())
//		{	
//			array_push($validwords, $row['word']);
//		}		
		$result = $mysqli->query("SELECT * FROM `coding-good` WHERE `demographics_id` = ".$demo." AND `position`='" . $position_in_array . "'" . "ORDER BY `coding-good`.`time`  ASC");

		$check=array();
		$numberofduplicates=0;
		$numberofvalid=0;
		$freqtotal=0;

		while ($row = $result->fetch_assoc())
		{
			if($row['word']=="START")
			{
				$begintime=strtotime($row['time']);
			}else{
				$eventtime=strtotime($row['time']);
				$time=$eventtime-$begintime;
				echo "<tr><td>".$time."</td><td>" . $row['word'] . "</td><td>";

				$result2 = $mysqli->query('SELECT * FROM `all_words` WHERE `word`="'.$row['word'].'" LIMIT 1');
					while ($row2=$result2->fetch_assoc())
					{
						echo round($row2['ngram_value']*1000000, 2);
						$freqtotal+=$row2['ngram_value']*1000000;	
					}
				if(in_array($row['word'], $validwords))
				{

										
					
					echo"<td>VALID</td>";
				}else{
					echo "<td><font color=red>INVALID</font></td>";
				}
					echo "</td></tr>";

				if(in_array($row['word'], $check))
				{
					$numberofduplicates++;
				}
				if(!in_array($row['word'], $check) && in_array($row['word'], $validwords))
				{
					array_push($check, $row['word']);
					$numberofvalid++;
					if($time <= 60)
					{
						$numberofvalidresponsemin1++;
					}
					if($time > 60 && $time <= 120)
					{
						$numberofvalidresponsemin2++;
					}
					if($time > 120)
					{
						$numberofvalidresponsemin3++;
					}
				$result2 = $mysqli->query('SELECT * FROM `all_words` WHERE `word`="'.$row['word'].'" LIMIT 1');
					while ($row2=$result2->fetch_assoc())
					{
						array_push($freqarr, $row2['ngram_value']*1000000);
						$freqtotal+=$row2['ngram_value']*1000000;
	
					}
				}
				
			} //end else
		} //end while
		echo "</table></td>";	
		$x++;
	} //end foreach
?>
<td valign=top>

<? echo $demo; ?>
<?php 
	$totalstatic=$staticduplicates + $static;
	$totalinteractive=$interactiveduplicates + $interactive;
	$totalshuffle=$shuffleduplicates + $shuffle;

	echo "<table border=1 width=400>";
echo "<tr><td>&nbsp;<br></td><td><td></tr>";
	echo "<tr><td><b>Valid Static: </b></td><td>" . $static . "<td></tr>";
	echo "<tr><td><b> Valid Interactive: </b></td><td>" . $interactive . "<td></tr>";
	echo "<tr><td><b> Valid Shuffle: </b></td><td>" . $shuffle . "</td></tr>";
	echo "<tr><td>&nbsp;<br></td><td><td></tr>";	
	
	echo "<tr><td><b>Avg Valid Static : </b></td><td>" . $static/4 . "</td></tr>";
	echo "<tr><td><b>Avg Valid Interactive : </b></td><td>" . $interactive/4 . "<td></tr>";
	echo "<tr><td><b>Avg Valid Shuffle : </b></td><td>" . $shuffle/4 . "<td></tr>";
	echo "<tr><td>&nbsp;<br></td><td><td></tr>";
	
	echo "<tr><td><b>Median Valid Frequency: </b></td><td> </td></tr>";
	echo "<tr><td>&nbsp;<br></td><td><td></tr>";
	echo "<tr><td><b>Total Static : </b></td><td>" . $totalstatic . "</td></tr>";
	echo "<tr><td><b>Total Interactive : </b></td><td>" . $totalinteractive . "<td></tr>";
	echo "<tr><td><b>Total Shuffle : </b></td><td>" . $totalshuffle . "<td></tr>";

	echo "<tr><td>&nbsp;<br></td><td><td></tr>";
	echo "<tr><td><b>Avg Static : </b></td><td>" . $totalstatic/4 . "</td></tr>";
	echo "<tr><td><b>Avg Interactive : </b></td><td>" . $totalinteractive/4 . "<td></tr>";
	echo "<tr><td><b>Avg Shuffle : </b></td><td>" . $totalshuffle/4 . "<td></tr>";

	echo "<tr><td>&nbsp;<br></td><td><td></tr>";


//	echo "<tr><td><b>Static Frequency Total: </b></td><td>" . round($staticfreq,2) . "<td></tr>";
//	echo "<tr><td><b>Interactive Frequency Total: </b></td><td>" . round($interactivefreq,2) . "<td></tr>";
//	echo "<tr><td><b>Shuffle Frequency Total </b></td><td>" . round($shufflefreq,2) . "</td></tr>";
	

	
echo "<tr><td>&nbsp;<br></td><td><td></tr>";
	echo "<tr><td><b>Interactions: </b></td><td>" . $amountmoved[0] . ", " . $amountmoved[1] .", "  . $amountmoved[2] .  ", " .$amountmoved[3]."<td></tr>";
	echo "<tr><td><b>Shuffles: </b></td><td>" . $amountshuffled[0] . ", " . $amountshuffled[1] .", "  . $amountshuffled[2] .  ", " .$amountshuffled[3]."<td></tr>";	
	echo "<tr><td><b>Shuffles In Last Minute: </b></td><td>" . $amountshuffledlast[0] . ", " . $amountshuffledlast[1] .", "  . $amountshuffledlast[2] .  ", " .$amountshuffledlast[3]."<td></tr></table>";	
?>
</td>

</tr></table>