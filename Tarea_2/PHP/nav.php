<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/nav_styles.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <div class="nav-bg">
        <a class="prest" href="index.php">SaborUSM</a>
        <nav class="navegador-principal contenedor">
            <?php
            session_start();

            if (isset($_SESSION["correo"])) {
                $nombre = $_SESSION["nombre"];
                // El usuario ha iniciado sesión
                echo '<a href="logout.php">Cerrar Sesión</a>';
                echo '<a href="platos.php">Platos</a>';
                echo '<a href="wishlist.php">Favoritos</a>';
                echo '<a href="votacion.php">Votacion de la semana</a>';
                echo "<a class='usuario-iniciado' href='user.php'><span class='material-symbols-outlined'>person</span> $nombre</a>";
            } else {
                // El usuario no ha iniciado sesión
                echo '<a href="login.php">Iniciar Sesión</a>';
            }
            ?>
        </nav>
    </div>



</body>

</html>