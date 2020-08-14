<?php
    include "conexion.php";
    $json=array();

    $datosVacios["id_percepcion"]='';
    $datosVacios["latitud"]='';
    $datosVacios["longitud"]='';
    $datosVacios["fecha_hora"]='';
    $datosVacios["valor_inseguridad"]='';
    $datosVacios["x"]='';
    $datosVacios["y"]='';
    $datosVacios["zona"]='';
    $datosVacios["hemisferio"]='';
    $datosVacios["contexto"]='';
    $datosVacios["tipo_peligro"]='';
    $jsonVacio['datos'][]=$datosVacios;
    if(isset($_POST['id_percepcion'])){

        $id_percepcion = $_POST['id_percepcion'];
        $sql = mysqli_query($conexion, "select * from percepcion where id_percepcion = $id_percepcion");
        if ($sql) {
            $fila = mysqli_fetch_array($sql);
            $json['datos'][] = $fila;
            echo json_encode($json);
        }
        else{
            //conexion invalida
            echo "conexion invalida";
        }
    }
    else{
        //No se establecieron los parametros POST
        echo json_encode($jsonVacio);
    }
?>
