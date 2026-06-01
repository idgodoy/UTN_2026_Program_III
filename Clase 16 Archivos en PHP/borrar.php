<?php

$vectorArchivos = $_POST['chbx'];  // chbx es un vector de elementos checkbox

?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">  


</head>
<body>

<?
echo "Se tildaron <br><br>"; 
foreach($vectorArchivos as $archivo){
    echo $archivo. " borrado <br>";
    unlink($archivo);  //borra el archivo.
}
?>

<p>Archivos borrados con éxito</p>
<p></p>
<a href="index.php">Volver</a>



</body>
</html>