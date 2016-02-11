
<!doctype html>
<html>
	<head><!--<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>--></head>
	<title></title>
<style>
	.style1 {
	text-align: left;
}



#message {
	font-size: 40px; 
	display: block; 
	color: black; 
margin-left: 15%; margin-top: 10%; margin-right: 15%; }

#copytext {
	font-size: 40px; 
	display: block; 
	color: black; 
	margin-left: 15%; margin-right: 15%;	
}
</style>
	<body>
		
	<?php 
		
		// connect to database
		$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
		
		//if the database connection attempt returns an error, display error message
		if (mysqli_connect_errno()) 
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		//get most recent qualtrix id
		$get_demo=$mysqli->query("SELECT `demographics_id` FROM `qualtrics` ORDER BY `demographics_id` DESC LIMIT 1");
		
		//convert data from sql format
		$result=$get_demo->fetch_array();
		
		//store in the current session variable for future use
		$_SESSION['demographics_id']=$result['demographics_id'];
		
		//test
		//echo $_SESSION['demographics_id'];
		
		//query the database for qualtrics id
		//$query=$mysqli->query("SELECT `qualtrics_id` FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'");
		
		//use this query below to test (especially if you didn't compete the qualtrics form,
		//the previous query above will show an error b/c you don't have qctrx id)
		$query=$mysqli->query("SELECT `qualtrics_id` FROM `qualtrics` WHERE `demographics_id`='823'");
		
		//convert from sql format data
		$id = $query->fetch_array();
		$uniqueID = $id['qualtrics_id']
		//display the data as a test
		//echo $id['qualtrics_id'];

		
		
	?>
        
	<table style="width: 100%; height: 100%" cellspacing="0" cellpadding="0" >
	<tr>
		<td class="style1">

<div id="message">
		

		<?php echo nl2br ("This is your unique code which you will need to enter into \n mechanical turk in order to get paid:");?>
		<br><br>
		<?php echo $id['qualtrics_id'];?>
		<br><br>
		<?php echo nl2br ("Enter your email to have the code sent to you:");?>
</div><br>
<div id="copytext" >
<!--form which accepts email address and posts to 'qualid.php'-->
<form action="qualid.php" method="post">

<!--E-mail Address: <input type="text" name="email" size="20" /> <input type="submit" name="qualid" value="Request Email" onclick="sendEmail()"/>-->
E-mail Address: <input type="text" name="email" size="20" /> <input type="submit" id="email_addr" name="submit" value="Request Email"/>
</form>

	</div>
	
	
<!-- this is something Michio was working on -->	
	<?php /*
		$dom = new DomDocument();
		if(isset($_POST['submit'])){
			$to=$dom->getElementById('email_addr');
			//$to="t4kmode@gmail.com";
			echo $to;
			$subject = "Online Survey Confirmation ID";
			$body = "Thank you for participating in the online survey!\n\n 
					 Your unique code used to confirm participation and payment with Mechanical Turk is: \n\n"
					 . $uniqueID . "\n\n ";
			$from = "mtakemot@ucsd.edu";
			mail($to, $subject, $body);
			mail($from, $subject, $body);
			echo "Message sent!";
		}*/
	 ?>
	</body>
<?php	 /*
	echo "test";
*/ ?>	
	
 <?php 
$_SESSION['timed_out'] = 1;
//echo "HELLO";
?>
</td>
	</tr>
</table>
	
<html>
