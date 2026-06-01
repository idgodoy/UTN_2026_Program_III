<?php
/**
* Index dinámico para Programación III - UTN
*/
$directory = '.';   // directory actual
$items = scandir($directory); //Acá está la lista de lo que hay en el directorio.

/*
echo "items via echo: ". $items;
printf("<p>items via printf():  %s", $items);
echo "<br>";
echo "Lista de elementos en el directorio: <br>";
foreach($items as $unelemento) echo $unelemento . "<br>";
*/


// Filtros para ignorar archivos de sistema y configuración
$ignorados = ['.', '..', '.git', '.gitignore', 'index.php', 'Readme.md', 'docker-compose.yml', 'configNginx',
'baseDatosWeb','borrar.php'];


$folders = [];
$files = [];

foreach ($items as $unItem) {
    // Si $unItem está en el string "ignorados[]" o su nombre comienza con guión bajo, no lo agrega.
    if (in_array($unItem, $ignorados) || str_starts_with($unItem, '_') ) continue;
    if (is_dir($directory . '/' . $unItem)) {
        $folders[] = $unItem;
        } else {
        $files[] = $unItem;
        }
}

natcasesort($folders);
natcasesort($files);



?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UTN - Programación III</title>
<style>
:root { 
    --primary: #003f5c;
    --accent: #ffa600;
    --bg: #f4f7f6;
    --card: #ffffff;
}
body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); margin: 0; padding:
20px; }
.container { max-width: 1000px; margin: 0 auto; }
header { background: var(--primary); color: white; padding: 30px; border-radius: 12px; text-align:
center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }

.grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;

margin-top: 30px; }

.card { background: var(--card); padding: 20px; border-radius: 10px; text-decoration: none; color:

#333; display: flex; align-items: center; transition: 0.3s; border-left: 5px solid var(--accent);
box-shadow: 0 2px 5px rgba(0,0,0,0.05); }

.card:hover { transform: translateY(-8px); box-shadow: 0 8px 20px rgba(0,0,0,1); }
.icon { font-size: 24px; margin-right: 15px; }
h2 { border-left: 5px solid var(--primary); padding-left: 10px; color: var(--primary); margin-top:
40px; }
footer { margin-top: 50px; text-align: center; color: #888; font-size: 0.9em; }
</style>
</head>
<body>
<div class="container">
<header>
<h1>Programación III</h1>
<p>Dashboard de Clases y Recursos - UTN</p>
</header>
<h2>Crear nuevo archivo PHP o HTML</h2>

<form name=F1 method= POST action=archivos.php>
Nombre del archivo <br>
<input name=nomarchivo placeholder="nombre del archivo "> <br>
Contenido<br>
<textarea name=contarchivo rows=10 cols=30 placeholder="Ingrese aquí el código php o html"></textarea>

<input type=submit value=Crear>

</form>




<h2>Carpetas de Clases</h2>
<div class="grid">
<?php foreach ($folders as $f): ?>

<a href="<?= $f ?>/" class="card">
    <input type=checkbox >
    <span class="icon">📁</span>
    <div><strong><?= $f ?></strong><br><small>Directorio de clase</small></div>
</a>
<?php endforeach; ?>
</div>

<h2>Archivos Sueltos</h2>
<form name=archABorrar method= POST action=borrar.php>
<div class="grid">

<?php $i =0; 
foreach ($files as $file): ?>
<a href="<?= $file ?>" class="card" style="border-left-color: #2196F3;">
    <span class="icon">📄</span>
    <input type=checkbox name="chbx[]" value=<?= $file ?> >
    <div><strong><?= $file ?></strong></div>
</a>
<?php endforeach; ?>
</div>

<input type=submit value="Borrar archivos seleccionados">
</form>



<footer>Generado automáticamente por el Servidor Nginx/PHP local</footer>
</div>
</body>
</html>