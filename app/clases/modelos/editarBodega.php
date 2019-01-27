<?php 
include "../baseDatos.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $data = json_decode($json, true);
    $id_bodega = $data["id_bodega"];
    $nombre_nuevo = $data["nombre_nuevo"];
    
    $sql_bodega = "UPDATE bodega SET nombre = '".$nombre_nuevo ."' WHERE id_bodega = ".$id_bodega. ";";


    if ($conexion->query($sql_bodega) === TRUE) {
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