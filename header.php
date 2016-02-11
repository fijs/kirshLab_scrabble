<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Kirsh Lab</title>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
<script>
function validateForm() {
    var x = document.forms["demo"]["fname"].value;
    if (x == null || x == "") {
        alert("First name must be filled out");
        return false;
	}
    var x = document.forms["demo"]["lname"].value;
    if (x == null || x == "") {
        alert("Last name must be filled out");
        return false;
	}
    var x = document.forms["demo"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
    var x = document.forms["demo"]["age"].value;
    if (x == null || x == "") {
        alert("Please select your age");
        return false;
	}
    var x = document.forms["demo"]["education"].value;
    if (x == null || x == "") {
        alert("Please select your education level");
        return false;
	}
    var x = document.forms["demo"]["scrabble"].value;
    if (x == null || x == "") {
        alert("Please select your scrabble level");
        return false;
	}
    var x = document.forms["demo"]["boggle"].value;
    if (x == null || x == "") {
        alert("Please select your boggle level");
        return false;
	}
    var x = document.forms["demo"]["wordsearch"].value;
    if (x == null || x == "") {
        alert("Please select your wordsearch level");
        return false;
	}
    var x = document.forms["demo"]["crossword"].value;
    if (x == null || x == "") {
        alert("Please select your crossword level");
        return false;
	}
    var x = document.forms["demo"]["gender"].value;
    if (x == null || x == "") {
        alert("Please select your gender");
        return false;
	}
    var x = document.forms["demo"]["handedness"].value;
    if (x == null || x == "") {
        alert("Please select handedness");
        return false;
	}
    var x = document.forms["demo"]["language"].value;
    if (x == null || x == "") {
        alert("Please select native English speaker option");
        return false;
	}
    var x = document.forms["demo"]["permission"].value;
    if (x == null || x == "") {
        alert("Please select permission option");
        return false;
	}
}
</script>

</head>
<body>
<div id="header">
	
	<div style='float: right; padding-right: 20px; padding-top: 25px;'>
	Kirsh Laboratory [Participant
<?php
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$query= '';
	$result = $mysqli->query("SELECT demographics_id FROM demographics ORDER BY demographics_id DESC LIMIT 1");
	echo "#000";
	while ($row = $result->fetch_assoc())
	{
		echo $row['demographics_id'] + 1;
	}
	echo "]  - ";
	echo date('l jS \of F Y h:i:s A'); 
	?>
	</div>
</div>