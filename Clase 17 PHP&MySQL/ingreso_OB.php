<?php
/*
$mysqli->prepare(): El motor de la base de datos precompila la estructura de la consulta dejando "huecos" con los signos ?.

$stmt->bind_param("sss", ...): Seguridad frente a SQL injection. Le dice a PHP: "No importa lo que el alumno escriba en el formulario, tratalo estrictamente como una cadena de texto muerta (s), nunca como código SQL ejecutable".
*/
// ingreso.php

// 1. Configuración de la conexión mediante el objeto mysqli
$host = 'localhost';
$user = 'root';
$pass = ''; // Cambiar por tu contraseña
$db   = 'mi_banco_db';

// Crear la conexión orientada a objetos
$mysqli = new mysqli($host, $user, $pass, $db);

// Verificar si hubo un error de conexión
if ($mysqli->connect_error) {
    die("Error crítico de conexión: " . $mysqli->connect_error);
}

// Asegurar que use codificación utf8mb4 para eñes y acentos
$mysqli->set_charset("utf8mb4");

// 2. Verificar origen POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura de datos
    $tipo_doc  = $_POST['tipo_doc'] ?? '';
    $documento = trim($_POST['documento'] ?? '');
    $usuario   = trim($_POST['usuario'] ?? '');
    $password  = $_POST['password'] ?? '';

    if (empty($usuario) || empty($password) || empty($documento)) {
        die("Por favor, completa todos los campos.");
    }

    // 3. Preparar la consulta segura (Prepared Statement en MySQLi)
    $sql = "SELECT id, nombre, password FROM usuarios WHERE usuario = ? AND tipo_doc = ? AND documento = ? LIMIT 1";
    
    if ($stmt = $mysqli->prepare($sql)) {
        
        // "sss" indica que los tres parámetros son de tipo string (texto)
        $stmt->bind_param("sss", $usuario, $tipo_doc, $documento);
        $stmt->execute();
        
        // Obtener el resultado de la ejecución
        $resultado = $stmt->get_result();
        
        // Verificamos si trajo una fila
        if ($userRow = $resultado->fetch_assoc()) {
            
            // Verificación de contraseña (reemplazar por password_verify si usan hash)
            if (password_verify($password, $userRow['password'])) {
                session_start();
                $_SESSION['usuario_id'] = $userRow['id'];
                $_SESSION['nombre']     = $userRow['nombre'];
                
                echo "<h1>¡Bienvenido, " . htmlspecialchars($userRow['nombre']) . "!</h1>";
                echo "<p>Has ingresado correctamente (Validado con MySQLi).</p>";
            } else {
                echo "<p style='color:red;'>Contraseña incorrecta.</p>";
                echo "<a href='login.html'>Volver a intentar</a>";
            }
            
        } else {
            echo "<p style='color:red;'>Usuario o documento no registrados.</p>";
            echo "<a href='login.html'>Volver a intentar</a>";
        }
        
        // Cerrar la sentencia de consulta
        $stmt->close();
    }
    
} else {
    header('Location: login.html');
    exit;
}

// Cerrar la conexión principal al finalizar el script
$mysqli->close();