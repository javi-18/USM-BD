<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Información de usuario</title>
    <link rel="stylesheet" href="css/user_styles.css">
</head>

<body>
    <?php
    include "config.php";
    include "nav.php";
    include "funciones.php";

    if (isset($_GET["error"]) && $_GET["error"] == 1) {
        echo "<p style='color: red; text-align: center;'>Error al actualizar la información</p>";
    } elseif (isset($_GET["cod"]) && $_GET["cod"] == 1) {
        echo "<p style='color: black; text-align: center;'>La información se actualizó correctamente</p>";
    }
    $sql = "SELECT * from usuario where id = ".$_SESSION['ID']."";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $n_almuerzos = $row["n_almuerzos"];
            $pass = $row["password"];
            $time = $row["fecha_hora"];
    } };

    ?>

    <header>
        <h1>Información personal</h1>
    </header>
    <main>
        <section>
            <h2>Datos personales</h2>
            <br>
            <ul>
                <li>
                    <span class="label">Nombre:</span>
                    <span class="value">
                        <?php
                        echo $_SESSION["nombre"];
                        ?>
                    </span>
                </li>
                <li>
                    <span class="label">Correo electronico:</span>
                    <span class="value">
                        <?php
                        echo $_SESSION["correo"];
                        $corr = $_SESSION["correo"];
                        ?>
                    </span>
                </li>
                <li>
                    <span class="label">Almuerzos restantes:</span>
                    <span class="value">
                        <?php
                        echo $n_almuerzos;
                        ?>
                    </span>
                </li>
                <li>
                    <span class="label">Ultima conexion:</span>
                    <span class="value">
                        <?php
                        echo $time;
                        ?>
                    </span>
                </li>
                <li>
                <form action="ver_resenas.php" method="POST">
                <input type="hidden" name="accion" value="resenas">
                <input type="submit" value="Ver resenas">
                </form>
                </li>
            </ul>
        </section>
        <?php 

        ?>
        <section>
            <h3>Editar información</h3>
            <form action="bd_user.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                <label for="fecha">Fecha de nacimiento:</label>
                <input type="text" id="correo" name="correo" value="<?php echo $corr;?>">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" value="<?php echo $pass; ?>">
                <input type="hidden" name="accion" value="actualizar">
                <input type="submit" value="Guardar cambios">
            </form>
        </section>
        <section>
            <h3>Eliminar cuenta</h3>
            <form action="bd_user.php" method="POST"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
                <input type="hidden" name="accion" value="eliminar">
                <input type="submit" value="Eliminar cuenta" class="delete-button">
            </form>
        </section>


    </main>
    <footer>
        <?php
        include "footer.php";
        ?>
    </footer>
</body>

</html>