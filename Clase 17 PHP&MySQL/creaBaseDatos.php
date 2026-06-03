<?php
//Variables de entorno.
$server = "localhost";
$usuario = "root";      // de http://localhost/MAMP/
$password = "root";     // idem
// Establece la conexión con el servidor.
$conexión = new mysqli($server, $usuario, $password);

$sql = "DROP DATABASE miNuevaBD";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($conexión->connect_error) {
  die("Fallo al conectar: " . $conexión->connect_error);
}
echo "<p>Conexión exitosa...!";

if ($conexión->query($sql) === TRUE) {
  echo "<p>Base de datos creada con éxito!";
} else {
  echo "<p>Error al crear la base de datos: " . $conexión->error;
}
// Cierra la conexión.
$conexión->close();
echo "Conexión cerrada.";
?>
<p> <a href=creaTabla.php>Crear tabla mediante creaTabla.php</a> </p>
<p> <a href="index.php">Volver</a>


</body>
</html>