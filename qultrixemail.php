<?php
	echo "test sending email";
	
	$msg = "message body";
	
	echo "content: ". $msg;
	
	mail("mga.allen@gmail.com", "subject", $msg);
?>