<?php
// altas.php

// 1. Configuración de la conexión (Idéntica a ingreso.php)
$host    = 'localhost';
$db      = 'mi_banco_db';
$user    = 'root';
$pass    = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error crítico de conexión: " . $e->getMessage());
}

// 2. Verificar origen POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura de todos los campos solicitados
    $nombre           = trim($_POST['nombre'] ?? '');
    $apellido         = trim($_POST['apellido'] ?? '');
    $tipo_doc         = $_POST['tipo_doc'] ?? '';
    $documento        = trim($_POST['documento'] ?? '');
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $email            = trim($_POST['email'] ?? '');
    $banco_emisor     = $_POST['banco_emisor'] ?? '';
    
    // NOTA: Si en el registro decidís generarles un usuario/password temporal por defecto:
    $usuario_temporal  = strtolower($nombre . substr($documento, -4)); // Ej: osvaldo4567
    $password_temporal = password_hash($documento, PASSWORD_DEFAULT);   // Usamos el DNI como clave inicial encriptada

    // Validación rápida de campos vacíos
    if (empty($nombre) || empty($apellido) || empty($documento) || empty($email) || empty($banco_emisor)) {
        die("Error: Faltan datos necesarios para procesar el alta.");
    }

    try {
        // 3. Insertar el nuevo usuario en la base de datos de manera segura
        $sql = "INSERT INTO usuarios (nombre, apellido, tipo_doc, documento, fecha_nacimiento, email, banco_emisor, usuario, password) 
                VALUES (:nombre, :apellido, :tipo_doc, :documento, :fecha_nacimiento, :email, :banco_emisor, :usuario, :password)";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':nombre'           => $nombre,
            ':apellido'         => $apellido,
            ':tipo_doc'         => $tipo_doc,
            ':documento'        => $documento,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':email'            => $email,
            ':banco_emisor'     => $banco_emisor,
            ':usuario'          => $usuario_temporal,
            ':password'         => $password_temporal
        ]);

        // 4. Mostrar confirmación de éxito en pantalla
        echo "<h2>🎉 ¡Alta de Usuario Exitosa!</h2>";
        echo "<p>El usuario se ha registrado correctamente en el banco emisor: <strong>" . strtoupper($banco_emisor) . "</strong>.</p>";
        echo "<hr>";
        echo "<p><strong>Datos generados para pruebas de ingreso:</strong></p>";
        echo "<ul>";
        echo "  <li><strong>Usuario:</strong> " . htmlspecialchars($usuario_temporal) . "</li>";
        echo "  <li><strong>Contraseña por defecto (su DNI):</strong> " . htmlspecialchars($documento) . "</li>";
        echo "</ul>";
        echo "<br><a href='login.html' style='padding: 10px 20px; background-color: #004691; color: white; text-decoration: none; border-radius: 20px;'>Ir al Ingreso</a>";

    } catch (\PDOException $e) {
        // Manejo por si el documento o email ya existen (llave duplicada)
        if ($e->getCode() == 23000) {
            echo "<p style='color:red;'>Error: El documento o correo electrónico ya se encuentran registrados.</p>";
        } else {
            echo "<p style='color:red;'>Hubo un error al procesar el alta: " . $e->getMessage() . "</p>";
        }
        echo "<a href='registro.html'>Volver al formulario</a>";
    }

} else {
    header('Location: registro.html');
    exit;
}