
<?	
$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
$result = $mysqli->query("SELECT * FROM  `data` order by `time` desc limit 1");
$word="";
while ($row = $result->fetch_assoc())
	{
		$word=$row['word'];
	}
//echo $word;
$mysqli = new mysqli("localhost","root", "paintFRAME!", "words");
$result = $mysqli->query("SELECT * FROM  `all_words` WHERE `stimuli` =  '".$word."' order by `word` ASC");
echo "<table cellspacing=50 cellpadding=15><tr><td valign=top>";
		$i=0;
$firstlet=$secondlet="";
while ($row = $result->fetch_assoc())
	{

		if($row['ngram_value']*1000000000>100)
		{
			
			$firstlet= substr($row['word'],0,1);
//			echo $firstlet ."," .$secondlet . "<br>";
			if($firstlet!=$secondlet)
			{
				echo "<br>";
			}
			echo $row['word'] . "<br> ";

			if($i==15)
			{
				echo "</td><td valign=top>";
				$i=0;
			}
			$secondlet=$firstlet;
		
					$i++;
		}
	
	}
	echo "</td></tr></table><div style='clear:both'></div>";


?>