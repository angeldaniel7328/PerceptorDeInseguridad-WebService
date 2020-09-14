<?php
    // userinformation.php
    include "connection.php";

    $emptyData["id_user"]='';
    $emptyData["name"]='';
    $emptyData["birthday"]='';
    $emptyData["age"]='';
    $emptyData["gender"]='';
    $emptyData["nacionality"]='';
    $emptyData["socioeconomic_level"]='';
    $emptyData["ocupation"]='';
    $emptyJson['data'][]=$emptyData;

    if(isset($_GET['name']) && isset($_GET['password']) && isset($_GET['birthday']) && isset($_GET['gender']) && isset($_GET['email'])
    ){
        $name=$_GET['name'];
        $password=$_GET['password'];
        $birthday = $_GET['birthday'];
        $gender = $_GET['gender'];
        $email = $_GET['email'];

        $query = "select * from user where name = '$name'";
        $qwery = mysqli_query($connection, $query);

        if($qwery){
        //Query was successful
            if($row = mysqli_num_rows($qwery)> 0){
                //There are 1 or more records with the same name
                echo json_encode($emptyJson);
            }
            else {
                //There are not records with the same name

                //Function to calculate age
                function search_age($birthday){
                    $day=date("d");
                    $month=date("m");
                    $year=date("Y");
                    $daynaz=date("d",strtotime($birthday));
                    $monthnaz=date("m",strtotime($birthday));
                    $yearnaz=date("Y",strtotime($birthday));

                    if (($monthnaz == $month) && ($daynaz > $day)) {
                    $year=($year-1); }

                    if ($monthnaz > $month) {
                    $year=($year-1);}
                    $age=($year-$yearnaz);

                    return $age;
                }
                $age = search_age($birthday);
                $insertion = "insert into user (name, password, birthday,age, gender) values ('".$name."', '".$password."', '".$birthday."', $age, '".$gender."');";
                if (isset($_GET['nacionality']) && isset($_GET['socioeconomic_level']) isset($_GET['ocupation'])) {
                    $nacionality = $_GET['nacionality'];
                    $socioeconomic_level = $_GET['socioeconomic_level'];
                    $ocupation = $_GET['ocupation'];
                    $insercion = "insert into user (name, password, birthday, age, gender, email,nacionality, socioeconomic_level, ocupation) values ('".$name."', '".$password."', '".$birthday."', $age, '".$gender."', '".$email."', '".$nacionality."', '".$socioeconomic_level."', '".$ocupation."');";
                }                
                mysqli_close($connection);
            }
        }
        else{
            //Query was not successful
            echo json_encode($emptyJson);
        }
    }
    else{
        //No POST parameters set
        echo json_encode($emptyJson);
    }

    //  For testing, use this codes.

    //  Sing up user without nacionality, socioeconomic level nor ocupation
    //  https://www.edacarquitectos.com/perceptorDeInseguridad/singup.php?name=frufru&password=123&birthday=2000-07-27&gender=masculino&email=sam@bixor.com

    //  Sign up user with complete data.
    //  https://www.edacarquitectos.com/perceptorDeInseguridad/singup.php?name=teco&password=123&birthday=2000-07-27&gender=masculino&email=jojo@bixor.com&nacionality=mexicana&socioeconomic_level=medio&ocupation=plomero

?>