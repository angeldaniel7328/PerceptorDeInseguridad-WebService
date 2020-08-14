<?php 
	$hostname = 'localhost';
	$database = 'edacarqu_wp1';
	$username = 'edacarqu';
	$password = 'YbsPfbX6[3.4H2#';
	$conexion = mysqli_connect($hostname, $username, $password, $database);
	if (!$conexion){
	    echo "<h2>Error de conexion</h2>";
	}
?>