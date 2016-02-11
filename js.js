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

}


