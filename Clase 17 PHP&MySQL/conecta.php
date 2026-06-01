<?php
$server = "localhost";
$usuario = "root";   // de http://localhost/MAMP/
$password = "root";
$baseDatos = "datos";

// Create connection
$conexión = new mysqli($server, $usuario, $password, $baseDatos);

// Check connection
if ($conexión->connect_error) {
  die("Fallo al conectar: " . $conexión->connect_error);
}
echo "Conexión exitosa!";
?>