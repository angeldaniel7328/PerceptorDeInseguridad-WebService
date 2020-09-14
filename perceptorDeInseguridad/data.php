<?php
	//data.php
	include "connection.php";
	$sql = "select * from alarm;";
	$query = mysqli_query($connection, $sql);
	echo "<center>";
	echo "<table border=2>";
	echo "<tr>";
	echo "<th>ID<th>Date Time<th>Latitude<th>Longitude<th>Perception";
	while($record = mysqli_fetch_array($query))
	{
		echo "<tr>";
		echo "<td>".$record['id_alarm'];
		echo "<td>".$record['date_time'];
		echo "<td>".$record['latitude'];
		echo "<td>".$record['longitude'];
		echo "<td>".$record['insecurity_value'];
	}
	echo "</table>";
	echo "<center>";
	mysqli_close($connection);
?>