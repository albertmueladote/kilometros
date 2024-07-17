<!DOCTYPE html>
<html lang="es">
<head>
    <?php require 'head.php'; ?>
    <link rel="stylesheet" href="css/form.css">
    <script src="js/form.js" defer></script>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container-fluid">
        <header class="center">
            <h1>Kilómetros</h1>
        </header>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <table>
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Recorrido</th>
                            <th>Distancia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="options">
                            <td class="save"><button type="button" class="btn btn-primary">Guardar</button></td>
                            <td class="new_row" colspan="2"><button type="button" class="btn btn-primary">Añadir fila</button></td>
                        </tr>
                        <tr class="total">
                            <td colspan="2"><h3>Total</h3></td>
                            <td><input type="text" disabled name="total"></td>
                        </tr>
                        <tr class="dates_from">
                            <td colspan="2"><h4>De</h4></td>
                            <td><input type="date" name="date_from"></td>
                        </tr>
                        <tr class="dates_to">
                            <td colspan="2"><h4>A</h4></td>
                            <td><input type="date" name="date_to"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>