<?php 
 
/**
 * This is where you would inject your sql into the database 
 * but we're just going to format it and send it back 
 */ 
$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
foreach ($_GET['listItem'] as $position => $item)
{
    $mysqli->query("UPDATE `test` SET `test` = $position WHERE `id` = $item"); 
}


mysqli_close($con);
 
?>