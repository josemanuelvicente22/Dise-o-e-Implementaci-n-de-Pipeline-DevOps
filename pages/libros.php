<?php
// pages/libros.php

require_once __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';

// 1) Obtener lista de tipos de libro para el select
$sqlTipos = "SELECT DISTINCT tipo FROM titulos ORDER BY tipo";
$tiposStmt = $pdo->query($sqlTipos);
$tipos = $tiposStmt->fetchAll(PDO::FETCH_COLUMN);

// 2) Leer filtros desde la URL (GET)
$tipoSeleccionado = isset($_GET['tipo']) ? trim($_GET['tipo']) : '';
$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';

// 3) Construir la consulta principal con o sin filtros
$sql = "
    SELECT 
        t.id_titulo,
        t.titulo,
        t.tipo,
        p.nombre_pub AS editorial,
        t.precio,
        t.total_ventas
    FROM titulos t
    LEFT JOIN publicadores p ON t.id_pub = p.id_pub
";

$condiciones = [];
$params = [];

if ($tipoSeleccionado !== '') {
    $condiciones[] = 't.tipo = ?';
    $params[] = $tipoSeleccionado;
}

if ($busqueda !== '') {
    $condiciones[] = 't.titulo LIKE ?';
    $params[] = '%' . $busqueda . '%';
}

if ($condiciones) {
    $sql .= ' WHERE ' . implode(' AND ', $condiciones);
}

$sql .= ' ORDER BY t.titulo';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$libros = $stmt->fetchAll();
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Listado de libros</h1>
        <span class="badge bg-secondary badge-count">
            <?= count($libros) ?> libro(s)
        </span>
    </div>

    <!-- Filtros (tipo + búsqueda) -->
    <form method="GET" class="row g-2 mb-4 filtros-libros">
        <div class="col-md-4">
            <label class="form-label">Filtrar por tipo</label>
            <select name="tipo" class="form-select">
                <option value="">Todos los tipos</option>
                <?php foreach ($tipos as $tipo): ?>
                    <option value="<?= htmlspecialchars($tipo) ?>"
                        <?= $tipo === $tipoSeleccionado ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tipo) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-5">
            <label class="form-label">Buscar por título</label>
            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Escribe parte del título..."
                value="<?= htmlspecialchars($busqueda) ?>"
            >
        </div>

        <div class="col-md-3 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary w-100">
                Aplicar
            </button>
            <a href="libros.php" class="btn btn-outline-secondary">
                Limpiar
            </a>
        </div>
    </form>

    <?php if (count($libros) === 0): ?>
        <div class="alert alert-info">
            No se encontraron libros con los criterios seleccionados.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle table-custom">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Editorial</th>
                        <th>Precio</th>
                        <th>Ventas totales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                        <tr>
                            <td><?= htmlspecialchars($libro['id_titulo']) ?></td>
                            <td><?= htmlspecialchars($libro['titulo']) ?></td>
                            <td><?= htmlspecialchars($libro['tipo']) ?></td>
                            <td><?= htmlspecialchars($libro['editorial'] ?? 'N/D') ?></td>
                            <td>
                                <?= $libro['precio'] !== null
                                    ? '$ ' . number_format($libro['precio'], 2)
                                    : 'N/D' ?>
                            </td>
                            <td><?= $libro['total_ventas'] ?? 0 ?></td>
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
