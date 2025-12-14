<?php
// index.php
require_once __DIR__ . '/config/db.php';
include __DIR__ . '/includes/header.php';
?>

<div class="container mt-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">Bienvenido a la Librería Jose Manuel</h1>
            <p class="col-md-8 fs-5">
                Aquí podrás consultar el listado de libros disponibles, ver los autores y ponerte en contacto con nosotros.
            </p>
            <a href="///pages/libros.php" class="btn btn-primary btn-lg">
                Ver libros
            </a>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/footer.php';
?>
