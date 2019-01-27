<?php 
include "../baseDatos.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $data = json_decode($json, true);
    $nombre = $data["nombre"];
    $descripcion = $data["descripcion"];
    $id_bodega = $data["id_bodega"];
    $stock = $data["stock"]; 
    $sql_producto = "INSERT INTO producto (nombre,descripcion) VALUES ('".$nombre."','".$descripcion."')";
    $sql_stock = "INSERT INTO stock (id_producto,id_bodega,stock) VALUES (LAST_INSERT_ID(),".$id_bodega.",".$stock.")";
    if ($conexion->query($sql_producto) === TRUE  | $conexion->query($sql_stock) === TRUE) {
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