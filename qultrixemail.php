<?php
	echo "test sending email";
	
	$msg = "message body";
	
	echo "content: ". $msg;
	
	mail("michio.prosci@gmail.com", "subject", $msg);
?>