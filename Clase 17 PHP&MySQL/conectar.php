<?php
$server = "localhost";
$usuario = "root";   // de http://localhost/MAMP/
$password = "root";
$baseDatos = "mibd";

// Crea conexión (objeto)
$conexión = new mysqli($server, $usuario, $password, $baseDatos);

// Verifica estab lecimientro de la conexión:
if ($conexión->connect_error) {
  die("Fallo al conectar: " . $conexión->connect_error);
}

?>
