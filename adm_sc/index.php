<? 
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	
?>
<!DOCTYPE html>
<!--
Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
-->
<html>
<head>
	<meta charset="utf-8">
	<script src="./ckeditor/ckeditor.js"></script>
</head>
<body>
<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
<?	$result = $mysqli->query("SELECT * FROM  `train_text` WHERE TYPE =  'A' LIMIT 1");


	while ($row = $result->fetch_assoc())
	{
		echo $row['text'];
	}
?>
			</textarea>
		</p>
		<p>
			<input type="submit" value="Submit">
		</p>
	</form>
<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
<?	$result = $mysqli->query("SELECT * FROM  `train_text` WHERE TYPE =  'B' LIMIT 1");


	while ($row = $result->fetch_assoc())
	{
		echo $row['text'];
	}
?>
			</textarea>
<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
<?	$result = $mysqli->query("SELECT * FROM  `train_text` WHERE TYPE =  'C' LIMIT 1");


	while ($row = $result->fetch_assoc())
	{
		echo $row['text'];
	}
?>
			</textarea>
</body>
</html>
