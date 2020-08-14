<?php
    // singup.php

    include "conexion.php";

    $datosVacios["id_usuario"]='';
    $datosVacios["nombre"]='';
    $datosVacios["fecha_nacimiento"]='';
    $datosVacios["edad"]='';
    $datosVacios["genero"]='';
    $datosVacios["nacionalidad"]='';
    $datosVacios["nivel_socioeconomico"]='';
    $datosVacios["ocupacion"]='';
    $jsonVacio['datos'][]=$datosVacios;

    if(isset($_POST["nombre"]) && isset($_POST["contrasena"])){
        $user=$_POST["nombre"];
        $pwd=$_POST["contrasena"];
        $sql="SELECT * FROM usuario WHERE nombre = '$user' AND contrasena = '$pwd'";
        $qwery = mysqli_query($conexion, $sql);
        if($qwery){

            if($row = mysqli_num_rows($qwery)== 1){

                $fila = mysqli_fetch_array($qwery);
                $json['datos'][] = $fila;
                echo json_encode($json);
            }
            else{
                echo json_encode($jsonVacio);
            }
        }
        else{
            echo json_encode($jsonVacio);
        }
    }
    else{
        echo json_encode($jsonVacio);
    }
?>