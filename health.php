<?php
// Health check simple para CI/CD y monitoreo.
// - Responde 200 si el servidor está vivo.
// - Si la DB está disponible, también lo indica.

header('Content-Type: application/json');

$db_ok = false;
try {
    require_once __DIR__ . '/config/db.php';
    $pdo->query('SELECT 1');
    $db_ok = true;
} catch (Throwable $e) {
    $db_ok = false;
}

echo json_encode([
    'ok' => true,
    'db_ok' => $db_ok,
    'time' => date('c')
]);
