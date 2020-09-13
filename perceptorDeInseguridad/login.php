<?php
    // login.php

    include "connection.php";

    $emptyData["pk_user"]='';
    $emptyData["name"]='';
    $emptyData["date_birth"]='';
    $emptyData["age"]='';
    $emptyData["gender"]='';
    $emptyData["nationality"]='';
    $emptyData["socioeconomic_level"]='';
    $emptyData["occupation"]='';
    $emptyData["sexual_orientation"]='';
    $emptyData["skin_color"]='';
    
    $emptyJson['date'][]=$emptyData;

    if(isset($_POST["name"]) && isset($_POST["password"])){
        $name=$_POST["name"];
        $password=$_POST["password"];
        $sql="SELECT * FROM users WHERE name = '$name' AND password = '$password'";
        $qwery = mysqli_query($connection, $sql);
        if($qwery){
            if($row = mysqli_num_rows($qwery)== 1){
                $record = mysqli_fetch_array($qwery);
                $json['date'][] = $record;
                echo json_encode($json);
            }
            else{
                echo json_encode($emptyJson);
            }
        }
        else{
            echo json_encode($emptyJson);
        }
    }
    else{
        echo json_encode($emptyJson);
    }
?>