<nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Inicio</a>
        <?php if($cookie->exists()) { ?>
                <button type="button" class="btn btn-danger" id="logout">Desconectar</button>
        <?php } ?>
</nav>
<div class="loading"></div>