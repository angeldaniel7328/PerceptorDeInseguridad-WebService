<?php
    // singup.php

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

    if(
    	isset($_POST['name']) && 
    	isset($_POST['password']) && 
    	isset($_POST['date_birth']) && 
    	isset($_POST['gender']) && 
    	isset($_POST['email'])){

        $name = $_POST['name'];
        $password = $_POST['password'];
        $date_birth = $_POST['date_birth'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM users WHERE name = '$name'";
        $qwery = mysqli_query($connetion, $sql);

        if($qwery){
        //la consulta se realizo con exito

            if($row = mysqli_num_rows($qwery)> 0){
                //Ya hay 1 o mas registros con el mismo nombre             
                echo json_encode($emptyJson);
            }
            else {
                //no hay registros con el mismo nombre

                //funcion para calcular la edad
                function calculate_age($date_birth){
                    $day = date("d");
                    $month = date("m");
                    $year = date("Y");
                    $day_birth = date("d",strtotime($date_birth));
                    $month_birth = date("m",strtotime($date_birth));
                    $year_birth = date("Y",strtotime($date_birth));

                    if (($month_birth == $month) && ($day_birth > $day)) {
                    	$year=($year-1); 
                	}

                    if ($month_birth > $month) {
                    	$year=($year-1);
                    }
                    $age=($year-$year_birth);

                    return $age;
                }
                $age = calculate_age($date_birth);
                $sql = "";

                if (
                	isset($_POST['nationality']) && 
                	isset($_POST['socioeconomic_level']) && 
                	isset($_POST['occupation']) && 
                	isset($_POST['sexual_orientation']) && 
                	isset($_POST['skin_color'])) {

                    $nationality = $_POST['nationality'];
                    $socioeconomic_level = $_POST['socioeconomic_level'];
                    $occupation = $_POST['occupation'];
    				$sexual_orientation = $_POST['sexual_orientation'];
   					$skin_color = $_POST['skin_color'];

                    $sql = "INSERT INTO users (name, password, date_birth, age, gender, email, nationality, socioeconomic_level, occupation, sexual_orientation, skin_color) VALUES ('".$name."', '".$password."', '".$date_birth."', $age, $gender, '".$email."', $nationality, socioeconomic_level, '".$occupation."', $sexual_orientation, $skin_color);";
                }
                else {
                    $sql = "INSERT INTO users (name, password, date_birth, age, gender) VALUES ('".$name."', '".$password."', '".$date_birth."', $age, $gender);";
                }
                $qwery = mysqli_query($connetion, $sql);
                if ($qwery){
                    //se inserto el nuevo registro

                    $record = mysqli_fetch_array(mysqli_query($connetion, "SELECT * FROM users WHERE name = '$name'"));
                    $json['date'][] = $record;
                    echo json_encode($json);
                }
                else {
                    //no se inserto el nuevo registro
                    echo json_encode($emptyJson);
                }
                mysqli_close($connetion);
            }
        }
        else{
            //La consulta no se realizo con exito
            echo json_encode($emptyJson);
        }
    }
    else{
        //No se establecieron los parametros POST
        echo json_encode($emptyJson);
    }
    echo json_encode($emptyJson);


    //  Para hacer prubebas, utilice estos códigos.

    //  Registrar usuario sin nacionalidad, nivel socioeconomico ni ocupación
    //  https://www.edacarquitectos.com/perceptorDeInseguridad/singup.php?nombre=frufru&contrasena=123&fecha_nacimiento=2000-07-27&genero=masculino&correo=sam@bixor.com

    //  Registrar usuario con datos completos
    //  https://www.edacarquitectos.com/perceptorDeInseguridad/singup.php?nombre=teco&contrasena=123&fecha_nacimiento=2000-07-27&genero=masculino&correo=jojo@bixor.com&nacionalidad=mexicana&nivel_socioeconomico=medio&ocupacion=plomero
?>
