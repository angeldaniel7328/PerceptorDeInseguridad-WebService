<?php 
	include 'conexion.php';

	if(isset($_GET["fk_usuario"])){
		$fk_usuario   = $_GET['fk_usuario'];
		$sq ="select id_percepcion from percepcion where (fk_usuario = $fk_usuario) ORDER by id_percepcion DESC LIMIT 1";
		$quer = mysqli_query($conexion,$sq);
		if ($quer) {
			echo "query2 hecho";
			$datos = mysqli_fetch_array($quer);
			echo $datos['id_percepcion'];
		}
		else{
			echo "query2 no hecho";
		}
		mysqli_close($conexion);
	}
	else{
		echo "[invalido]";
	}


	//https://www.edacarquitectos.com/perceptorDeInseguridad/lastperception.php?fk_usuario=3
?>
