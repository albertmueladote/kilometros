<!DOCTYPE html>
<html lang="es">
<head>
    <?php require PARTIALS . 'head.php'; ?>
    <link rel="stylesheet" href="public/css/menu.css?v=<?php echo time(); ?>">
    <script src="public/js/menu.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    <?php require PARTIALS . 'navbar.php'; ?>
    <div class="container-fluid">
        <header class="center">
            <h1>Kilómetros</h1>
        </header>
        <div class="row menu">
            <div class="col-sm-6 col-md-6 col-lg-12">
                <a href="/crear"><button type="button" class="btn btn-primary">Crear kilometros</button></a>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-12">
                <a href="/lista"><button type="button" class="btn btn-primary">Ver todos los kilometros</button></a>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-12">
                <a href="/horas-semanales"><button type="button" class="btn btn-primary">Horas semanales</button></a>
            </div>
        </div>
    </div>
    <?php require PARTIALS . 'footer.php'; ?>
</body>
</html>