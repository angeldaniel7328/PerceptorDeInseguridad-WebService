<?php
	include "connection.php";
	$sql = "SELECT * FROM user;";
	$query = mysqli_query($connection, $sql);
	while($records = mysqli_fetch_array($query))
	{
		$array[] = array_map("utf8_encode", $records);
	}
	
	echo json_encode($array);
	mysqli_close($connection);
?>