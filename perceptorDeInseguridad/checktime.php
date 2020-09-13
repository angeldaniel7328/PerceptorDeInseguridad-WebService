<?php
    include "connection.php";
    
    $pk_user= $_POST["pk_user"];

    $sql = "SELECT DATE_SUB(TIME(NOW()),INTERVAL 5 MINUTE) <= (SELECT TIME(p.date_time) FROM users u INNER JOIN perceptions p ON u.pk_user = p.fk_user WHERE u.pk_user = '$pk_user' ORDER BY p.date_time DESC LIMIT 1) AS time_perception;";
    
    $query = mysqli_query($connection, $sql);
    while($records = mysqli_fetch_array($query)){
        $date_percepctions[] = array_map("utf8_encode", $records);
    }
    if ($arreglo["time_perception*"] == "") {
        echo "available";
    }
    else{
        echo "not available";
    }
    mysqli_close($connection);
?>