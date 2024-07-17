<!DOCTYPE html>
<html lang="es">
<head>
    <?php require 'head.php'; ?>
    <link rel="stylesheet" href="css/menu.css">
    <script src="js/menu.js" defer></script>
</head>
<body>
    <?php require 'navbar.php'; ?>
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
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>