<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mibd";

// Crea conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Chequea conexión
if ($conn->connect_error) {
  die("Error al conectar a la base de datos: " . $conn->connect_error);
}

$sql = "DELETE FROM alumnos WHERE id = 2";
// Executa la consulta SQL
$result = $conn->query($sql);

// Procesa "$resultado"
if ($result->num_rows > 0) {
  // Muestra cada row (fila) de la respuesta
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " " . $row["apellido"]. "<br>";
  }
} else {
  echo "Sin resultados";
}
//Cerramos la conexión con la BD.
$conn->close();
?>