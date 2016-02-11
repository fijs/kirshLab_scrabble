<?php 
	session_start();
	include ('header.php');	// has functions that validate form and fetch the most recent participant's info
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$result = $mysqli->query("SELECT * FROM `demographics_test` WHERE `approved`=1 ORDER by `expnum` DESC LIMIT 1");
	while ($row = $result->fetch_assoc())
	{
		$_SESSION['expnum'] = $row['expnum']+1;
	}
	$_SESSION['groupnum'] = 1;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Kirsh Lab</title>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
 <script type="text/javascript">
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
    var x = document.forms["demo"]["wordgamelike"].value;
    if (x == null || x == "") {
        alert("Please select how much you like word games.");
        return false;
	}
	
    var x = document.forms["demo"]["sex"].value;
    if (x == null || x == "") {
        alert("Please select your gender.");
        return false;
	}
    var x = document.forms["demo"]["wordgamelike"].value;
    if (x == null || x == "") {
        alert("Please select how much you like word games.");
        return false;
	}
    var x = document.forms["demo"]["handedness"].value;
    if (x == null || x == "") {
        alert("Please select if you are right or left handed.");
        return false;
	}

    var x = document.forms["demo"]["language"].value;
    if (x == null || x == "") {
        alert("Please verify you are a native English Speaker.");
        return false;
	}


}
</script>
</head>

<div id="container">
<h1>

Thank you for agreeing to participate in this experiment!<br><br>


<!--<a href=demo_submit.php>skip the form</a><br><br> --!>
</h1>
Please begin by filling out the following form:
<form id="stats" onsubmit="return validateForm();" action="demo_submit.php" method="POST" name="demo">
	<div class=colcontainer>
		<div class="formlabel">First Name</div>
		<input name="fname" type="text" class="feedback-input" placeholder="First Name" />
	</div>
	<div class=colcontainer>
		<div class="formlabel">Last Name</div>
		<input name="lname" type="text" class="feedback-input" placeholder="Last Name" />
    </div>
	<div class="break"></div>
	<div class=colcontainer>
		<div class=formlabel>Email</div>
		<input name="email" type="text" class="feedback-input" placeholder="johndoe@ucsd.edu" />
	</div>
	<div class=colcontainer>
		<div class=formlabel>Age</div>
		<select name="age">
			<option value="" selected>Select Age</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
			<option value="32">32</option>
			<option value="33">33</option>
			<option value="34">34</option>
			<option value="35">35</option>
			<option value="36">36</option>
			<option value="37">37</option>
			<option value="38">38</option>
			<option value="39">39</option>
			<option value="40">40</option>
			<option value="41">41</option>
			<option value="42">42</option>
			<option value="43">43</option>
			<option value="44">44</option>
			<option value="45">45</option>
			<option value="46">46</option>
			<option value="47">47</option>
			<option value="48">48</option>
			<option value="49">49</option>
			<option value="50">50</option>
			<option value="51">51</option>
			<option value="52">52</option>
			<option value="53">53</option>
			<option value="54">54</option>
			<option value="55">55</option>
			<option value="56">56</option>
			<option value="57">57</option>
			<option value="58">58</option>
			<option value="59">59</option>
			<option value="60">60</option>
			<option value="61">61</option>
			<option value="62">62</option>
			<option value="63">63</option>
			<option value="64">64</option>
			<option value="65">65</option>
			<option value="66">66</option>
			<option value="67">67</option>
			<option value="68">68</option>
			<option value="69">69</option>
			<option value="70">70</option>
		</select>
	</div>	
	<div class="break"></div>
	<div class=colcontainer>
		<div class=formlabel>Education Level</div>
		<select name="education">
			<option value="" selected>Select Education</option>
			<option value="hs">High School</option>
			<option value="bs">Bachelor's of Science</option>
			<option value="ba">Bachelor's of Arts</option>
			<option value="ma">Master's Degree</option>
			<option value="phd">Doctorate</option>
		</select>
	</div>
	<div class="break"></div>
	<hr>
	<div class=colcontainer>
		<img src=scrabble.jpg>
		<div class=imglabel>Please rate yourself on a scale of 1-5 on scrabble ability.
		<br>
		<div class=radiolabel><input name="scrabble" type="radio" class="rbutton" value="1"/>Not Good.</div>
		<div class=radiolabel><input name="scrabble" type="radio" class="rbutton" value="2"/>Ok.</div>
		<div class=radiolabel><input name="scrabble" type="radio" class="rbutton" value="3"/>Good.</div>
		<div class=radiolabel><input name="scrabble" type="radio" class="rbutton" value="4"/>Very Good.</div>
		<div class=radiolabel><input name="scrabble" type="radio" class="rbutton" value="5"/>Excellent.</div>
		</div>
	</div>
	<div class=colcontainer>

	<!---<div style="margin-left:auto; margin-right:auto; width: 350px; ">	--!>
		<div class=imglabel>How much do you like word games?<br>
		<div class=radiolabel><input name="wordgamelike" type="radio" class="rbutton" value="1"/>I don't like them.</div>
		<div class=radiolabel><input name="wordgamelike" type="radio" class="rbutton" value="2"/>Not Much.</div>
		<div class=radiolabel><input name="wordgamelike" type="radio" class="rbutton" value="3"/>They are ok.</div>
		<div class=radiolabel><input name="wordgamelike" type="radio" class="rbutton" value="4"/>I like them.</div>
		<div class=radiolabel><input name="wordgamelike" type="radio" class="rbutton" value="5"/>I really like them.</div>
	</div>		
		<!--</div> --!>

	</div>
	<div class=colcontainer>

	</div>
	<div class="break"></div>
	<hr>
	<div class=colcontainer>
		<div class=formlabel>Gender</div><br>
		<div class=radiolabel><input name="sex" type="radio" class="rbutton" value="male"/>Male</div>
		<div class=radiolabel><input name="sex" type="radio" class="rbutton" value="female"/>Female</div>
	</div>
	<div class=colcontainer>
		<div class=formlabel>Handedness</div><br>
		<div class=radiolabel><input name="handedness" type="radio" class="rbutton" value="left"/>Left-Handed</div>
		<div class=radiolabel><input name="handedness" type="radio" class="rbutton" value="right"/>Right-Handed</div>
	</div>
	<div class="break"></div>

	<div class=colcontainer>
		<div class=formlabel>Are you a native English speaker? <br><small>(From the age of 5)</small></div><br><br>
        <div class=radiolabel><input name="language" type="radio" class="rbutton" value="ynative"/>Yes</div>
        <div class=radiolabel><input name="language" type="radio" class="rbutton" value="nnative"/>No</div>
	</div>
	<div class="break"></div>

	<div style="margin-left: 700px;">
      <div class="submit">
        <input type="submit" value="NEXT" style="background-color: grey;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none;">
    </div>


      </div>
    </form>
</center>
        <div class="ease"></div><br><br><br><br><br><br><br><br><br><br><br>