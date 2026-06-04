<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "miBD";

// vienen de cargarDatos.html
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<?
echo " <h2>Datos recibidos:</h2>";

echo "<p>Nombre: ".$nombre;
echo "<p>Apellido: ".$apellido;
echo "<p>Email: ".$email;

// Instancia un objeto "$conn" perteneciente a la clase msqli propia de php.
$conn = new mysqli($servername, $username, $password, $dbname);  //Mysqli orientada a objetos.
// Check connection
if ($conn->connect_error) {
  die("Error en la conexión: " . $conn->connect_error);
}
//VALUES ('John', 'Doe', 'john@example.com')";
$sql = "INSERT INTO Alumnos (nombre, apellido, email)
VALUES ('".$nombre."','".$apellido."','". $email."')";

if ($conn->query($sql) === TRUE) {
  echo "<p>Insertado con exito!";
} else {
  echo "Error insertando en la tabla: " . $conn->error;
}

$conn->close();

?>

</body>
</html>