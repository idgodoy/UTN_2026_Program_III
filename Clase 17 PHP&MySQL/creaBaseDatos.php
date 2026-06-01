<?php
//Variables de entorno.
$server = "localhost";
$usuario = "root";      // de http://localhost/MAMP/
$password = "root";     // idem

// Establece la conexión con el servidor.
$conexión = new mysqli($server, $usuario, $password);

// Check connection
if ($conexión->connect_error) {
  die("Fallo al conectar: " . $conexión->connect_error);
}
echo "Conexión exitosa!";

$sql = "CREATE DATABASE miBD";
if ($conexión->query($sql) === TRUE) {
  echo "Base de datos creada con éxito!";
} else {
  echo "Error al crear la base de datos: " . $conexión->error;
}

// Cierra la conexión.
$conexión->close();
?>
