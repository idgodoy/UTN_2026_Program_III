<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "miBD";

// vienen de cargarDatos.html
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

echo $nombre."<br>";
echo $apellido."<br>";
echo $email."<br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//VALUES ('John', 'Doe', 'john@example.com')";
$sql = "INSERT INTO Alumnos (nombre, apellido, email)
VALUES ('".$nombre."','".$apellido."','". $email."')";

if ($conn->query($sql) === TRUE) {
  echo "Insertado con exito!";
} else {
  echo "Error insertando en la tabla: " . $conn->error;
}

$conn->close();
?>