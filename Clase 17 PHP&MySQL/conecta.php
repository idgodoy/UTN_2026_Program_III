<?php
$server = "localhost";
$usuario = "root";   // de http://localhost/MAMP/
$password = "root";
$baseDatos = "mibd";



// Crea conexión (objeto)
$conexión = new mysqli($server, $usuario, $password);

// Verifica estab lecimientro de la conexión:
if ($conexión->connect_error) {
  die("Fallo al conectar: " . $conexión->connect_error);
}
else {
  echo "Conexión exitosa a MySQL <br>";
}
$conexión->close();
?>
