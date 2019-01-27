<?php 
include "../baseDatos.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $data = json_decode($json, true);
    $id_producto= $data["id_producto_borrar"];

    $sql_stock = "DELETE FROM stock WHERE id_producto = " .$id_producto.";";
    $sql_producto = "DELETE FROM producto WHERE id_producto = " .$id_producto.";";
    
    if ($conexion->query($sql_stock) === TRUE && $conexion->query($sql_producto) === TRUE) {    
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