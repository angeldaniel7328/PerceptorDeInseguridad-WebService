<?php
    include "conexion.php";
        $id_usuario= $_GET["id_usuario"];
    $sql = "SELECT DATE_SUB(TIME(NOW()),INTERVAL 5 MINUTE) <= (SELECT TIME(p.fecha_hora) FROM usuario u INNER JOIN percepcion p ON u.id_usuario = p.fk_usuario WHERE u.id_usuario = '$id_usuario' ORDER BY p.fecha_hora DESC LIMIT 1) AS tiempo;";
    $query = mysqli_query($conexion, $sql);
    while($registros = mysqli_fetch_array($query))
    {
        $arreglo[] = array_map("utf8_encode", $registros);
    }
    if ($arreglo["tiempo"] == "") {
        echo "disponible";
    }
    else{
        echo "indisponible";
    }
    mysqli_close($conexion);
?>