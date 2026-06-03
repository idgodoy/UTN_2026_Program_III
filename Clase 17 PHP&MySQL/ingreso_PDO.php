<?php
// ingreso.php

// 1. Configuración de la conexión a la base de datos
$host    = 'localhost';
$db      = 'mi_banco_db';
$user    = 'root';
$pass    = ''; // Cambiar por la contraseña correspondiente
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Intentamos conectar
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error crítico de conexión: " . $e->getMessage());
}

// 2. Verificar que los datos llegaron por el método correcto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura y limpieza básica de datos enviados desde login.html
    $tipo_doc   = $_POST['tipo_doc'] ?? '';
    $documento  = trim($_POST['documento'] ?? '');
    $usuario    = trim($_POST['usuario'] ?? '');
    $password   = $_POST['password'] ?? '';

    // Validación simple del lado del servidor
    if (empty($usuario) || empty($password) || empty($documento)) {
        die("Por favor, completa todos los campos obligatorios.");
    }

    // 3. Consulta segura usando Prepared Statements (Evita SQL Injection)
    // Buscamos al usuario combinando su nickname, tipo y número de documento
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = ? AND tipo_doc = ? AND documento = ? LIMIT 1');
    $stmt->execute([$usuario, $tipo_doc, $documento]);
    $userRow = $stmt->fetch();

    // 4. Verificación de credenciales
    if ($userRow) {
        // Idealmente las contraseñas se guardan con password_hash(). 
        // Si usás texto plano para la primera clase, sería: if ($password === $userRow['password'])
        if (password_verify($password, $userRow['password'])) {
            
            // ¡Ingreso exitoso! Iniciamos sesión
            session_start();
            $_SESSION['usuario_id'] = $userRow['id'];
            $_SESSION['nombre']     = $userRow['nombre'];
            
            echo "<h1>¡Bienvenido, " . htmlspecialchars($userRow['nombre']) . "!</h1>";
            echo "<p>Has ingresado correctamente al sistema de simulación de Visa Home.</p>";
            // Aquí podrías redirigir a un escritorio privado: header('Location: escritorio.php');
            
        } else {
            echo "<p style='color:red;'>Contraseña incorrecta.</p>";
            echo "<a href='login.html'>Volver a intentar</a>";
        }
    } else {
        echo "<p style='color:red;'>Usuario o documento no registrados.</p>";
        echo "<a href='login.html'>Volver a intentar</a>";
    }
} else {
    // Si intentan entrar directo a ingreso.php por URL (GET), los mandamos al formulario
    header('Location: login.html');
    exit;
}