<?php
    //checkusername.php
    include "conexion.php";

    //validar parametros POST
    if(isset($_POST['nombre']) && isset($_POST['correo'])){

        $nombre=$_POST['nombre'];
        $correo=$_POST['correo'];
        $consulta = "select * from usuario where nombre = '$nombre'";
        $qwery = mysqli_query($conexion, $consulta);

        if($qwery){
        //la consulta se realizo con exito

            if($row = mysqli_num_rows($qwery)> 0){
                //Ya hay 1 o mas registros con el mismo nombre             
                echo "Usuario ya existe";
            }
            else{
                $consulta = "select * from usuario where correo='$correo'";
                $qwery = mysqli_query($conexion, $consulta);
                if($qwery){
                //la consulta se realizo con exito

                    if($row = mysqli_num_rows($qwery)> 0){
                        //Ya hay 1 o mas registros con el mismo nombre             
                        echo "Correo ya ocupado";
                    }
                    else {
                        echo "libre";
                    }
                }
                else{
                    //La consulta no se realizo con exito
                    echo "error del servidor";
                }
            }
        }
        else{
            //La consulta no se realizo con exito
            echo "error del servidor";
        }
        mysql_close($conexion);
        
    }
    else{
        //No se establecieron los parametros POST
        echo "POST no enviado";
    }

    //Para hacer pruebas, utilice este url.
    //  www.edacarquitectos.com/perceptorDeInseguridad/checkusername.php?nombre=mordekai&correo=pepe@bixor.com
?>