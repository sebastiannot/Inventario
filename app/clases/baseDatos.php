<?php
/*Conexión a base de datos,modificar según configuración local*/
$host = "localhost"; 
$usuario = "root"; 
$password = ""; 
$bd = "bd_inventario"; 

$conexion = mysqli_connect($host, $usuario, $password,$bd);
if (!$conexion) {
  die("ERROR : " . mysqli_connect_error());
}

?>