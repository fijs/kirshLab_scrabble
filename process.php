<?php 
	
	session_start(); 	
	// import configuration settings
	require 'configuration.php';
		
		
?>
<?php
	
// Was the form submitted?

if (isset($_POST["qualid"])) {
	//$uniqueID=$_SESSION['qualid'];
   // Harvest submitted e-mail address and check if its valid
   $myqid=$_POST['qid'];
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST['email'];
     
  }else{
        
	
		echo "<font color='red'>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp " .$_POST['email']." is not a valid email </font>";
       exit;

    }
 

 // Mail them their key
$bound_text = "----*%$!$%*";
$bound = "--".$bound_text."\r\n";
$bound_last = "--".$bound_text."--\r\n";

$headers = "From: cogsci-scrabble@ucsd.edu\r\n";
$headers .= "MIME-Version: 1.0\r\n" .
        "Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;
		
      $mailbody = "Dear Participant!\n\nIf this e-mail does not apply to you please ignore it. Thank you for completing the 'scrabble' experiment on Mechanical Turk. This is the unique code you will need to enter into mturk in order to receive your payment \n\n '".$myqid."'
		\n\n \n\nThanks,\nThe Administration";

        mail($email,"Scrabble experiment unique ID", $mailbody, $headers);

        echo "The following unique code has been sent to your email address: ".$myqid;
		
		//$str = "The unique code: " .$id['qualtrics_id'] ." has been sent to: ".$email;
		$str = "The unique code: " .$myqid ." has been sent to: ".$email;
		echo '<script type="text/javascript">';
		echo 'alert("'.$str.'");';
		echo 'alert("Survey is now complete. You may now leave this page.");';
		//echo 'document.getElementById("myform").style.display="none";';
		echo '</script>';
		session_unset(); 
		
		header("Refresh:0; url=index.php");
       
}

?>



