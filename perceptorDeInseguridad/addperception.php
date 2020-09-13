<?php 
    include 'connection.php';

    if(
    	isset($_POST["longitude"]) && 
    	isset($_POST["latitude"]) && 
        isset($_POST["insecurity_value"]) && 
        isset($_POST["x"]) && 
        isset($_POST["y"]) && 
        isset($_POST["zone"]) && 
        isset($_POST["hemisphere"]) && 
        isset($_POST["fk_user"]) && 
        isset($_POST["context"]) && 
        isset($_POST["description"])){

        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $insecurity_value = $_POST['insecurity_value'];
        $x = $_POST['x'];
        $y = $_POST['y'];
        $zone = $_POST['zone'];
        $hemisphere = $_POST['hemisphere'];
        $fk_user = $_POST['fk_user'];
        $context = $_POST['context'];
        $description = $_POST['description'];

        $sql = "INSERT INTO perceptions (latitude, longitude, insecurity_value, x, y, zone, hemisphere, context, description, fk_user) VALUES ($latitude, $longitude, $insecurity_value, $x, $y, $zone, $hemisphere, $context, $description', $fk_user);";
        $query = mysqli_query($connection, $sql);
        if ($query){
            //se inserto el registro
            $sql ="SELECT pk_perception FROM perception WHERE (fk_user = $fk_user) ORDER BY pk_perception DESC LIMIT 1";
            $query = mysqli_query($connection,$sql);
            if ($query) {
                $data_perceptions = mysqli_fetch_array($query);
                echo $data_perceptions['pk_perception'];
            }
            else{
                //consulta id_perception no realizada
                echo "invalid";
            }
        }
        else{
            //no se inserto el registro
            echo "invalid";
        }
        
        mysqli_close($connection);
    }
    else{
        //Post no satisfecho
        echo "invalid";
    }

    //puedes hacer pruebas utilizando este link y cambiando los metodos GET por POST

    //https://www.edacarquitectos.com/perceptorDeInseguridad/addperception.php?latitud=0.1&longitud=1.1&valor_inseguridad=3&x=12312.0&y=34.3424&zona=2&hemisferio=norte&fk_usuario=3&contexto=desconocido&tipo_peligro=desconocido
?>
