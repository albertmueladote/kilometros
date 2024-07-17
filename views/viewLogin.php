<!DOCTYPE html>
<html lang="es">
<head>
    <?php require 'head.php'; ?>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js" defer></script>
</head>
<body>
    <?php require 'navbar.php'; ?>
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
    <?php require 'footer.php'; ?>
</body>
</html>