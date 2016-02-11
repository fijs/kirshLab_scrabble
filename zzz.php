<?php
echo "Testing email out to: mtakemot@ucsd.edu";
$to = "t4kmode@gmail.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: webmaster@caffeine.ucsd.edu/' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

$retval = mail($to,$subject,$message,$headers);

echo "<br><br><br>";
echo "mail return val: " .$retval;
//phpinfo();
?>
