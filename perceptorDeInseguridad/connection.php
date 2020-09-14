<?php 
	//connection.php
	$hostname = 'localhost';
	$database = 'edacarqu_wp1';
	$username = 'edacarqu';
	$password = 'YbsPfbX6[3.4H2#';
	$connection = mysqli_connect($hostname, $username, $password, $database);
	if (!$connection){
	    echo "<h2>Connection error</h2>";
	}
?>