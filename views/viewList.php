<!DOCTYPE html>
<html lang="es">
<head>
    <?php require 'partials/head.php'; ?>
    <link rel="stylesheet" href="public/css/list.css?v=<?php echo time(); ?>">
    <script src="public/js/list.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    <?php require PARTIALS . '/navbar.php'; ?>
    <div class="container-fluid">
        <header class="center">
            <h1>Kilómetros</h1>
        </header>
        <?php foreach($list AS $file) { ?>
            <div class="file_content data-<?php echo $file['id']; ?>">
                <div class="file">
                    <div>
                        <?php echo $file['name']; ?>
                    </div>
                    <div>
                        <a href="/pdf?id=<?php echo $file['id']; ?>">Ver</a>
                    </div>
                    <div class="remove" data-id="<?php echo $file['id']; ?>">
                        <button type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path></svg></button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php require PARTIALS . 'footer.php'; ?>
</body>
</html>