<?php 
	//lastperseption.php
	include 'connection.php';
	if(isset($_GET["fk_user"])){
		$fk_user   = $_GET['fk_user'];
		$sq ="select id_perception from perception where (fk_user = $fk_user) ORDER by id_perception DESC LIMIT 1";
		$quer = mysqli_query($connection,$sq);
		if ($quer) {
			echo "query2 done";
			$data = mysqli_fetch_array($quer);
			echo $data['id_perception'];
		}
		else{
			echo "query2 not done";
		}
		mysqli_close($connection);
	}
	else{
		echo "[invalid]";
	}
	//https://www.edacarquitectos.com/perceptorDeInseguridad/lastperception.php?fk_user=3
?>