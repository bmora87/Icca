<?php

	$host = "10.0.3.11";
	$user = "icca";
	$password = "icca_pass";
	$db = "ICCA";
	$conn = new mysqli($host,$user,$password,$db);

  	if ($conn->connect_error) {
    	die("ERROR: Unable to connect: " . $conn->connect_error);
 	 }

?>
