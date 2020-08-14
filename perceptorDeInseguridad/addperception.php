<?php 
    include 'conexion.php';

    if(isset($_POST["longitud"])              && isset($_POST["latitud"])
        && isset($_POST["valor_inseguridad"]) && isset($_POST["x"]) 
        && isset($_POST["y"])                 && isset($_POST["zona"]) 
        && isset($_POST["hemisferio"])        && isset($_POST["fk_usuario"]) 
        && isset($_POST["contexto"])          && isset($_POST["tipo_peligro"])){

        $longitud     = $_POST['longitud'];
        $latitud      = $_POST['latitud'];
        $valor_inseg  = $_POST['valor_inseguridad'];
        $x            = $_POST['x'];
        $y            = $_POST['y'];
        $zona         = $_POST['zona'];
        $hemisferio   = $_POST['hemisferio'];
        $fk_usuario   = $_POST['fk_usuario'];
        $contexto     = $_POST['contexto'];
        $tipo_peligro = $_POST['tipo_peligro'];

        $sql = "insert into percepcion (latitud, longitud, valor_inseguridad, x, y, zona, hemisferio, contexto, tipo_peligro, fk_usuario) values ($latitud, $longitud, $valor_inseg, $x, $y, $zona, '".$hemisferio."', '".$contexto."', '".$tipo_peligro."', $fk_usuario);";
        $query = mysqli_query($conexion, $sql);
        if ($query){
            //se inserto el registro
            $sq ="select id_percepcion from percepcion where (fk_usuario = $fk_usuario) ORDER by id_percepcion DESC LIMIT 1";
            $quer = mysqli_query($conexion,$sq);
            if ($quer) {
                $datos = mysqli_fetch_array($quer);
                echo $datos['id_percepcion'];
            }
            else{
                //consulta id_perception no realizada
                echo "invalido";
            }
        }
        else{
            //no se inserto el registro
            echo "invalido";
        }
        
        mysqli_close($conexion);
    }
    else{
        //Post no satisfecho
        echo "invalido";
    }

    //puedes hacer pruebas utilizando este link y cambiando los metodos GET por POST

    //https://www.edacarquitectos.com/perceptorDeInseguridad/addperception.php?latitud=0.1&longitud=1.1&valor_inseguridad=3&x=12312.0&y=34.3424&zona=2&hemisferio=norte&fk_usuario=3&contexto=desconocido&tipo_peligro=desconocido
?>
