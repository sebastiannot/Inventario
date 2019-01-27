<?php 
include "../baseDatos.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $data = json_decode($json, true);
    $id_bodega= $data["id_bodega"];

    $sql_producto = "DELETE producto, stock FROM producto INNER JOIN stock ON stock.id_producto = producto.id_producto WHERE stock.id_bodega= ".$id_bodega.";";
    $sql_bodega = "DELETE FROM bodega WHERE id_bodega = " .$id_bodega.";";
   
    
    if ($conexion->query($sql_producto) === TRUE ) {  
        $conexion->query($sql_bodega);  
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