<?php
    include "conection.php";
    $json=array();

    $emptyData["pk_perception"]='';
    $emptyData["latitude"]='';
    $emptyData["longitude"]='';
    $emptyData["date_time"]='';
    $emptyData["insecurity_value"]='';
    $emptyData["x"]='';
    $emptyData["y"]='';
    $emptyData["zone"]='';
    $emptyData["hemisphere"]='';
    $emptyData["context"]='';
    $emptyData["type_insecurity"]='';
    $emptyJSON['data'][]=$emptyData;
    if(isset($_POST['pk_perception'])){

        $pk_perception = $_POST['pk_perception'];
        $sql = mysqli_query($conexion, "SELECT * FROM perception WHERE pk_perception = $pk_perception");
        if ($sql) {
            $row = mysqli_fetch_array($sql);
            $json['data'][] = $row;
            echo json_encode($json);
        }
        else{
            //invalid connecion
            json_encode($emptyJSON);
        }
    }
    else{
        //POST parameters not set
        echo json_encode($emptyJSON);
    }

    //for tests use this link.
    //  www.edacarquitectos.com/perceptorDeInseguridad/searchperception.php?pk_perception=1
?>
