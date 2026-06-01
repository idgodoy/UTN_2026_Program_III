<?php
$contenido = $_POST['contarchivo'];
$nombre = $_POST['nomarchivo'];

$archivo = fopen($nombre,"w");
fwrite($archivo, $contenido);
fclose($archivo);
?>


<!DOCTYPE html>
<html lang="es">
<head>  

</head>
<body>
Archivo <? echo $nombre ?> creado con éxito


<p><a href="index.php">Volver</a></p>


</body>
</html>