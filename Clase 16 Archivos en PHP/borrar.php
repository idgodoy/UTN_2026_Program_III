<?php

$vectorArchivos = $_POST['chbx'];






?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">  


</head>
<body>
<?
 echo "Se tildaron borraron: <br><br>"; 
foreach($vectorArchivos as $archivo){

echo $archivo. "<br>";
unlink($archivo);



}
?>
<p>Archivos borrados con éxito</p>
<p></p>
<a href="index.php">Volver</a>



</body>
</html>