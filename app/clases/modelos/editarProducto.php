<?php 
include "../baseDatos.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $data = json_decode($json, true);
    $id_producto = $data["id_producto"];
    $nombre_nuevo = $data["nombre_actual_p"];
    $descripcion_nuevo = $data["descripcion_actual_p"];

    $sql_producto= "UPDATE producto SET nombre = '".$nombre_nuevo ."',descripcion = '".$descripcion_nuevo ."'  WHERE id_producto = ".$id_producto. ";";


    if ($conexion->query($sql_producto) === TRUE) {
        $status = array(
            'status' => 200
        );
        echo json_encode($status);
    } else {
        $status = array(
            'status' => 500
        );
        echo json_encode($status);
    }
    $conexion->close();
    
    
}else{
    $status = array(
        'status' => 404
    );
    echo json_encode($status);
}

?>