<?php
include "../baseDatos.php";

$userData = mysqli_query($conexion,"select * from bodega");
$response = array();

while($row = mysqli_fetch_assoc($userData)){

   $response[] = $row;
}

echo json_encode($response);
?>