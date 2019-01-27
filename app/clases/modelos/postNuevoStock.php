<?php 
include "../baseDatos.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $data = json_decode($json, true);
    $id_stock = $data["id_stock"];
    $id_nuevo_stock = $data["id_nuevo_stock"];
    $stockNuevo = $data["stock_actual"];
    $id_bodega = $data["bodega_seleccionada"];
    $sql_stock = "UPDATE stock SET stock = $stockNuevo,id_bodega =$id_bodega  WHERE id_stock = $id_stock ";
    if ($conexion->query($sql_stock) === TRUE) {    
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