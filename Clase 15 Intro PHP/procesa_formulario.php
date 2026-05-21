<?php   // Llama al intérprete de PHP

$nom = $_POST['nnombre'];
$ape = $_POST['apellido'];
$email = $_POST['email'];
$suscripcion = $_POST['suscrip'];
$zona = $_POST['zona'];
$coment = $_POST['coment'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Procesa</title>
    <style>
        *{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: rgb(100,100,100);
            margin: 20;
            padding: 20;
        }

    </style>
</head>

<body>
<h3> Formulario recibido </h3>
<p> Nombre: <?php echo $nom; ?> </p>
<p> Apellido:<?php echo $ape; ?></p>

<?php
echo "<p> Email: ".$email. "</p>";

echo "<p> Suscripci&oacute;n: ".$suscripcion. "</p>";

echo "<p> Zona: ".$zona. "</p>";

echo "<p> Comentario ".$coment. "</p>";

printf ("Repito email de $nom $ape: %s ", $email);


for ($i=0; $i<10; $i++  ) echo "$i ";


$archivo = 'texto.txt';
$archivoJSON = 'personas.json';


if (file_exists($archivo)) {
    $cadena = file_get_contents($archivo);
    $texto_html = nl2br(htmlspecialchars($cadena));
}
else {
    $texto_html = "No existe el archivo";

}
echo "<p>Texto:<br> " . $texto_html. "</p>";

echo "<p>Personas:<br>";
if(file_exists($archivoJSON)){
    $cadenaJSON = file_get_contents($archivoJSON);
    $personas = [];
    $personas = json_decode($cadenaJSON, true);
   


    echo $cadenaJSON;
    echo "<br><br>";    
   // echo $personas. "<br>";
 
    if(!is_array($personas )) $personas =[];
 //   echo $personas[1]['nombre'] ;

for ($i = 0; $i < count($personas); $i++) {                    
         echo $personas[$i]['nombre']."<br>" ; 
         echo $personas[$i]['apellido']."<br>" ; 
         echo $personas[$i]['email']."<br><br>" ; 
       } 
}
else echo "No existe el archivo de personas";
  



?>
</body>

</html>
