<?php
// Configuración por variables de entorno para que funcione igual
// en tu PC y dentro de Docker/GitHub Actions.
$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = (int)(getenv('DB_PORT') ?: 3306);
$db   = getenv('DB_NAME') ?: 'dblibreria';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
