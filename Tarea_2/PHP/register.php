<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/register_styles.css">
</head>

<body>
    <form method="post" action="db_register.php">
        <table>
            <tr>
                <td><label>Registrarse</label></td>
            </tr>
            <tr>
                <td>Ingrese su nombre</td>
            </tr>
            <tr>
                <td><input type="text" name="nombre_usuario"></td>
            </tr>
            <tr>
                <td>Ingrese su correo</td>
            </tr>
            <tr>
                <td><input type="text" name="correo_usuario"></td>
            </tr>
            <tr>
                <td>Cree su contrasena</td>
            </tr>
            <tr>
                <td><input type="password" name="password_usuario"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Ingresar"></td>
            </tr>
        </table>
        <?php
        if (isset($_GET["error"]) && $_GET["error"] == 1) {
            echo "<p style='color: red; text-align: center;'>El correo ingresado ya esta registrado</p>";
        }
        if (isset($_GET["error"]) && $_GET["error"] == 2) {
            echo "<p style='color: red; text-align: center;'>El correo ingresado no es valido</p>";
        }
        ?>
        <a href="login.php"
            style="display: block; color: black; padding: 20px; font-size: 15px; text-align: right;">Iniciar sesion</a>

    </form>


</body>

</html>