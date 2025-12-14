<?php
// pages/mensajes.php

require_once __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';

$sql = "
    SELECT id_contacto, nombre, email, mensaje, fecha
    FROM contacto
    ORDER BY fecha DESC
";

$stmt = $pdo->query($sql);
$mensajes = $stmt->fetchAll();
?>

<div class="container mt-4">
    <h1 class="mb-4">Mensajes de contacto</h1>

    <?php if (count($mensajes) === 0): ?>
        <div class="alert alert-info">
            No hay mensajes registrados todavía.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mensajes as $fila): ?>
                        <tr>
                            <td><?= $fila['id_contacto'] ?></td>
                            <td><?= htmlspecialchars($fila['nombre']) ?></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($fila['email']) ?>">
                                    <?= htmlspecialchars($fila['email']) ?>
                                </a>
                            </td>
                            <td><?= nl2br(htmlspecialchars($fila['mensaje'])) ?></td>
                            <td><?= $fila['fecha'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
