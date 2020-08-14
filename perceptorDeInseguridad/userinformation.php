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

    if(isset($_GET['nombre']) && isset($_GET['contrasena']) && isset($_GET['fecha_nacimiento']) && isset($_GET['genero']) && isset($_GET['correo'])
    ){
        $nombre=$_GET['nombre'];
        $contrasena=$_GET['contrasena'];
        $fecha_nacimiento = $_GET['fecha_nacimiento'];
        $genero = $_GET['genero'];
        $correo = $_GET['correo'];

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
                if (isset($_GET['nacionalidad']) && isset($_GET['nivel_socioeconomico']) isset($_GET['ocupacion'])) {
                    $nacionalidad = $_GET['nacionalidad'];
                    $nivel_socioeconomico = $_GET['nivel_socioeconomico'];
                    $ocupacion = $_GET['ocupacion'];
                    $insercion = "insert into usuario (nombre, contrasena, fecha_nacimiento, edad, genero, correo,nacionalidad, nivel_socioeconomico, ocupacion) values ('".$nombre."', '".$contrasena."', '".$fecha_nacimiento."', $edad, '".$genero."', '".$correo."', '".$nacionalidad."', '".$nivel_socioeconomico."', '".$ocupacion."');";
                }
                /*
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
                }*/
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


    //  Para hacer prubebas, utilice estos códigos.

    //  Registrar usuario sin nacionalidad, nivel socioeconomico ni ocupación
    //  https://www.edacarquitectos.com/perceptorDeInseguridad/singup.php?nombre=frufru&contrasena=123&fecha_nacimiento=2000-07-27&genero=masculino&correo=sam@bixor.com

    //  Registrar usuario con datos completos
    //  https://www.edacarquitectos.com/perceptorDeInseguridad/singup.php?nombre=teco&contrasena=123&fecha_nacimiento=2000-07-27&genero=masculino&correo=jojo@bixor.com&nacionalidad=mexicana&nivel_socioeconomico=medio&ocupacion=plomero

?>
