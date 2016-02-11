
	
		
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
		
		//display the data as a test
		//echo $id['qualtrics_id'];

		$uniqueID = $id['qualtrics_id']
		
		?>
<?php
	
// Was the form submitted?

if (isset($_POST["qualid"])) {

   // Harvest submitted e-mail address and check if its valid
   if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST["email"];
     
   }else{
        echo 	$email;
		
		"email is not valid";
        exit;

    }
 // Mail them their key

        $mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. Thank you for completing the 'scrabble' experiment on Mechanical Turk. This is the unique code you will need to enter into mturk in order to receive your payment. 
		\n\n \n\nThanks,\nThe Administration";

        mail($email, "Scrabble experiment unique ID", $mailbody);

        echo "The following unique code has been sent to your email address:";

   

		
echo $uniqueID;


       

?>
