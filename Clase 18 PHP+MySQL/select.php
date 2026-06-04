<?php

include ("../Clase 17 PHP&MySQL/conecta.php");

$tabla = "alumnos";
$sql = "SELECT id, nombre, apellido FROM ".$tabla;
// Executa la consulta SQL
$result = $conexión->query($sql);

echo "Contenido de la tabla ".$tabla;
echo "<br>";

// Procesa "$resultado"
if ($result->num_rows > 0) {
  // Muestra cada row (fila) de la respuesta

  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " Apellido: " . $row["apellido"]. "<br>";
  }
} else {
  echo "Sin resultados";
}
echo "<p>";
echo "Selecciona id=6: <br>";
$sql = "SELECT id, nombre, apellido FROM $tabla WHERE id = 6 ";
$result = $conexión->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " Apellido: " . $row["apellido"]. "<br>";
  }
} else {
  echo "Sin resultados";
}


//Cerramos la conexión con la BD.
$conexión->close();
?>