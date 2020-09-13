<?php
    //checkusername.php
    include "connection.php";

    //check post parameters
    if(isset($_POST['name']) && isset($_POST['email'])){

        $name=$_POST['name'];
        $email=$_POST['email'];
        $consult = "SELECT * FROM user WHERE name = '$name'";
        $qwery = mysqli_query($connection, $consult);

        if($qwery){
        //query carried out successfully

            if($row = mysqli_num_rows($qwery)> 0){
                //there are 1 or more users with the same name            
                echo "user already exists";
            }
            else{
                $consult = "SELECT * FROM usuario WHERE email='$email'";
                $qwery = mysqli_query($connection, $consult);
                if($qwery){
                //query carried out successfully

                    if($row = mysqli_num_rows($qwery)> 0){
                        //there are 1 or more users with the same email             
                        echo "email already occupied";
                    }
                    else {
                        echo "free";
                    }
                }
                else{
                    //server error
                    echo "server error";
                }
            }
        }
        else{
            //the query was not successful
            echo "error server";
        }
        mysql_close($connection);
        
    }
    else{
        //POST parameters not set
        echo "POST not set";
    }

    //for tests use this link.
    //  www.edacarquitectos.com/perceptorDeInseguridad/checkusername.php?name=mordekai&email=pepe@bixor.com
?>