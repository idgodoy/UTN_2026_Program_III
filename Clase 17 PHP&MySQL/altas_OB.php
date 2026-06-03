<?php
// altas.php

$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'mi_banco_db';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Error crítico de conexión: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura de los datos enviados desde registro.html
    $nombre           = trim($_POST['nombre'] ?? '');
    $apellido         = trim($_POST['apellido'] ?? '');
    $tipo_doc         = $_POST['tipo_doc'] ?? '';
    $documento        = trim($_POST['documento'] ?? '');
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $email            = trim($_POST['email'] ?? '');
    $banco_emisor     = $_POST['banco_emisor'] ?? '';
    
    // Datos temporales de prueba para el login posterior
    $usuario_temporal  = strtolower($nombre . substr($documento, -4)); 
    $password_temporal = password_hash($documento, PASSWORD_DEFAULT); // DNI hasheado como clave inicial

    if (empty($nombre) || empty($apellido) || empty($documento) || empty($email) || empty($banco_emisor)) {
        die("Error: Faltan datos necesarios para procesar el alta.");
    }

    // 3. Preparar la inserción
    $sql = "INSERT INTO usuarios (nombre, apellido, tipo_doc, documento, fecha_nacimiento, email, banco_emisor, usuario, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
    if ($stmt = $mysqli->prepare($sql)) {
        
        // "sssssssss" representa los 9 strings que le pasamos por parámetro
        $stmt->bind_param("sssssssss", 
            $nombre, 
            $apellido, 
            $tipo_doc, 
            $documento, 
            $fecha_nacimiento, 
            $email, 
            $banco_emisor, 
            $usuario_temporal, 
            $password_temporal
        );
        
        // Ejecutar la sentencia e identificar si fue exitosa
        if ($stmt->execute()) {
            echo "<h2>🎉 ¡Alta de Usuario Exitosa!</h2>";
            echo "<p>Registrado en el banco emisor: <strong>" . strtoupper($banco_emisor) . "</strong> con MySQLi.</p>";
            echo "<hr>";
            echo "<p><strong>Credenciales generadas para la prueba:</strong></p>";
            echo "<ul>";
            echo "  <li><strong>Usuario:</strong> " . htmlspecialchars($usuario_temporal) . "</li>";
            echo "  <li><strong>Contraseña (DNI):</strong> " . htmlspecialchars($documento) . "</li>";
            echo "</ul>";
            echo "<br><a href='login.html' style='padding: 10px 20px; background-color: #004691; color: white; text-decoration: none; border-radius: 20px;'>Ir al Ingreso</a>";
        } else {
            // Evaluar código de error por duplicados (DNI o Email ya registrados)
            if ($mysqli->errno == 1062) {
                echo "<p style='color:red;'>Error: El documento o correo electrónico ya se encuentran registrados.</p>";
            } else {
                echo "<p style='color:red;'>Error al procesar el alta: " . $mysqli->error . "</p>";
            }
            echo "<a href='registro.html'>Volver al formulario</a>";
        }
        
        $stmt->close();
    }
    
} else {
    header('Location: registro.html');
    exit;
}

$mysqli->close();