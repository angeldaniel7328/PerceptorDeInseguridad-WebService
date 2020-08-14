<?php
    include "conexion.php";
    $json=array();

    $datosVacios["nombre"]='';
    $datosVacios["contrasena"]='';
    $datosVacios["fecha_nacimiento"]='';
    $datosVacios["genero"]='';
    $jsonVacio['datos'][]=$datosVacios;

    if(isset($_POST['nombre']) && isset($_POST['contrasena']) && isset($_POST['fecha_nacimiento']) && isset($_POST['genero'])){

        $nombre=$_POST['nombre'];
        $contrasena=$_POST['contrasena'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $genero = $_POST['genero'];

        $consulta = "select * from usuario where nombre = '$nombre'";
        $qwery = mysqli_query($conexion, $consulta);

        if($qwery){
        //la consulta se realizo con exito

            if($row = mysqli_num_rows($qwery)> 0){
                //Ya hay 1 o mas registros con el mismo nombre             
                echo json_encode($jsonVacio);
            }
            else {
                //no hay registros con el mismo nombre

                //funcion para calcular la edad
                function busca_edad($fecha_nacimiento){
                    $dia=date("d");
                    $mes=date("m");
                    $ano=date("Y");
                    $dianaz=date("d",strtotime($fecha_nacimiento));
                    $mesnaz=date("m",strtotime($fecha_nacimiento));
                    $anonaz=date("Y",strtotime($fecha_nacimiento));

                    if (($mesnaz == $mes) && ($dianaz > $dia)) {
                    $ano=($ano-1); }

                    if ($mesnaz > $mes) {
                    $ano=($ano-1);}
                    $edad=($ano-$anonaz);

                    return $edad;
                }
                $edad = busca_edad($fecha_nacimiento);

                $insercion = "insert into usuario (nombre, contrasena, fecha_nacimiento,edad, genero) values ('".$nombre."', '".$contrasena."', '".$fecha_nacimiento."', $edad, '".$genero."');";
                $insert = mysqli_query($conexion, $insercion);
                if ($insert){
                    //se inserto el nuevo registro
                    
                    $fila = mysqli_fetch_array(mysqli_query($conexion, "select * from usuario where nombre = '$nombre'"));
                    $json['datos'][] = $fila;
                    echo json_encode($json);
                }
                else {
                    //no se inserto el nuevo registro
                    echo json_encode($jsonVacio);
                }
                mysqli_close($conexion);
            }
        }
        else{
            //La consulta no se realizo con exito
            echo json_encode($jsonVacio);
        }
        
    }
    else{
    	//No se establecieron los parametros POST
        echo json_encode($jsonVacio);
    }
?>