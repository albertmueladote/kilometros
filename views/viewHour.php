<!DOCTYPE html>
<html lang="es">
<head>
    <?php require PARTIALS . 'head.php'; ?>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <link rel="stylesheet" href="public/css/hours.css?v=<?php echo time(); ?>">
    <script src="public/js/hours.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    <?php require PARTIALS . '/navbar.php'; ?>
    <div class="container-fluid">
        <header class="center">
            <h1>Horas</h1>
        </header>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <?php require PARTIALS . 'footer.php'; ?>
</body>
</html>