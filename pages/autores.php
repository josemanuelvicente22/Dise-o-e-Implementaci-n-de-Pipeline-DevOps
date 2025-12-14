<?php
// pages/autores.php

require_once __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';

$sql = "
    SELECT 
        id_autor,
        apellido,
        nombre,
        ciudad,
        estado,
        pais,
        telefono
    FROM autores
    ORDER BY apellido, nombre;
";

$stmt = $pdo->query($sql);
$autores = $stmt->fetchAll();
?>

<div class="container mt-4">
    <h1 class="mb-4">Listado de autores</h1>

    <?php if (count($autores) === 0): ?>
        <div class="alert alert-info">
            No hay autores registrados en la base de datos.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle table-custom">
                <thead class="table-dark">
                    <tr>
                        <th>ID Autor</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>País</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autores as $autor): ?>
                        <tr>
                            <td><?= htmlspecialchars($autor['id_autor']) ?></td>
                            <td><?= htmlspecialchars(trim($autor['apellido'])) ?></td>
                            <td><?= htmlspecialchars(trim($autor['nombre'])) ?></td>
                            <td><?= htmlspecialchars($autor['ciudad']) ?></td>
                            <td><?= htmlspecialchars($autor['estado']) ?></td>
                            <td><?= htmlspecialchars($autor['pais']) ?></td>
                            <td><?= htmlspecialchars($autor['telefono']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>