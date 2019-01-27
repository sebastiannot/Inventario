<?php
include "../baseDatos.php";
 $userData = mysqli_query($conexion,"SELECT p.id_producto,p.nombre,p.descripcion,s.id_stock,s.stock,b.id_bodega,b.nombre as nombre_bodega FROM stock s 
    RIGHT JOIN producto p ON s.id_producto = p.id_producto
    LEFT JOIN bodega b ON s.id_bodega = b.id_bodega");
$response = array();

while($row = mysqli_fetch_assoc($userData)){

   $response[] = $row;
}

echo json_encode($response);
?>