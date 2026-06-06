<?php

include ("../Clase 17 PHP&MySQL/conectar.php");

$idBuscado = $_POST['idBuscado'];

$tabla = "alumnos";
$sql = "SELECT id, nombre, apellido FROM ".$tabla;
// Executa la consulta SQL
$resultado = $conexión->query($sql);

echo "Contenido de la tabla ".$tabla;
echo "<br>";




// Procesa "$resultado"
if ($resultado->num_rows > 0) {
  // Muestra cada row (fila) de la respuesta



  while( $fila = $resultado->fetch_assoc() ) {
    echo "id: " . $fila["id"]. "  -  Nombre y Apellido: " . $fila["nombre"]." ". $fila["apellido"]. "<br>";
  }
} else {
  echo "Sin resultados";
}
echo "<p>";
$orden = 4;
echo "Selecciona id = $idBuscado: <br>";

$sql = "SELECT id, nombre, apellido FROM $tabla WHERE id = $idBuscado";


$resultado = $conexión->query($sql);
if ($resultado->num_rows > 0) {
  while($fila = $resultado->fetch_assoc()) {
    echo "id: " . $fila["id"]. " - Nombre: " . $fila["nombre"]. " Apellido: " . $fila["apellido"]. "<br>";
  }
} else {
  echo "Sin resultados";
}


//Cerramos la conexión con la BD.
$conexión->close();
?>