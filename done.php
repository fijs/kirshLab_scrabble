<?php 
	session_start(); 
	// Check if they come from qualtrics.php (which is where we redirect from the qualtrics survey 
	if(!isset($_SESSION['keyToPay']))
    {
    	header("location: index.php");
    }
    require 'configuration.php';
	$_SESSION['current']=8;
	if($_SESSION['current'] <= $_SESSION['last']){
			// delete data
			$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			session_destroy();
			header("location: index.php");
	}
	$_SESSION['last']=8;
	
?>

<!doctype html>
<html>
	<head><!--<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>--></head>
	<title></title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<style>

#message {
	font-size: 30px; 
	display: block; 
	color: black; 
	margin-top: 10%; 
	margin-left: auto;
	margin-right: auto;
	width: 900px;
	}

#message2 {
	font-size: 30px; 
	display: block; 
	color: black; 
	margin-top: 5%; 
	margin-left: auto;
	margin-right: auto;
	width: 900px;
}

#copytext {
	font-size: 25px; 
	display: block; 
	color: black; 
	margin-left: auto;
	margin-right: auto;
	width: 900px;	
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>
	<body>

        
<div id="message">		
		<?php echo nl2br ("This is your unique code which you will need to enter into \n mechanical turk in order to get paid:");?>
		<br><br>
		<font color="blue" size=10><?php echo $id['qualtrics_id'];?></font>
</div>
	
<div id="message2">
	<?php echo nl2br ("Enter your email to have the code sent to you:");?>
</div>

<div id="copytext" >

<!--form which accepts email address and posts to 'qualid.php'-->
<?php //echo $success ? '<!--' : ''; ?>
<form action="process.php" method="post" target="myIframe" id="myform">
	E-mail Address: <input type="email" name="email" size="20" title="Enter your email address"/> 
	<input type="text" name="qid" value="<?php echo $id['qualtrics_id']; ?>" hidden >
	<input type="submit" name="qualid" value="Request Email" />
</form>
<?php //echo $success ? '-->' : ''; ?>
<iframe name="myIframe" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 120px;">
</iframe>

</div>
</body>

<?php 
	// Unset session so user is not able to navigate through experiment again
	//session_unset(); 
?>

<html>
