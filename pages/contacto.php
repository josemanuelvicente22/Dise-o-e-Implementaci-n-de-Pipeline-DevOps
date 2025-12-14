<?php
// pages/contacto.php

require_once __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';

$mensajeEnviado = false;

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);

    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        $sql = "INSERT INTO contacto (nombre, email, mensaje) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $email, $mensaje]);
        $mensajeEnviado = true;
    }
}
?>

<div class="container mt-4">
    <h1>Contacto</h1>

    <?php if ($mensajeEnviado): ?>
        <div class="alert alert-success alert-auto-dismiss">
            ¡Gracias por contactarnos! Tu mensaje fue enviado correctamente.
        </div>
    <?php endif; ?>


    <form action="" method="POST" class="mt-4" id="form-contacto">
        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mensaje</label>
            <textarea name="mensaje" class="form-control" rows="5" required></textarea>
        </div>

        <button class="btn btn-primary">Enviar mensaje</button>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>