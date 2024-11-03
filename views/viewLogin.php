<!DOCTYPE html>
<html lang="es">
<head>
    <?php require PARTIALS . 'head.php'; ?>
    <link rel="stylesheet" href="public/css/login.css">
    <script src="public/js/login.js" defer></script>
</head>
<body>
    <?php require PARTIALS . 'navbar.php'; ?>
    <div class="container-fluid">
        <header class="center">
            <h1>Kilómetros</h1>
        </header>
        <form class="login" action="">
              <label for="username">
                    Username:
              </label>
              <input type="text" 
                     id="username" 
                     name="username" 
                     placeholder="Enter your Username" required>

              <label for="password">
                    Password:
              </label>
              <input type="password"
                     id="password" 
                     name="password"
                     placeholder="Enter your Password" required>

              <div class="wrap">
                    <button type="submit" id="login" class="btn btn-primary">
                          Submit
                    </button>
              </div>
        </form>
    </div>
    <?php require PARTIALS . '/footer.php'; ?>
</body>
</html>