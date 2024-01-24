<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<body>
    <form method="post" action="db_login.php">
        <table>
            <tr><td><label>Iniciar Sesion</label></td></tr>
            <tr><td>Correo</td></tr>
            <tr><td><input type="text" name="nombre_usuario"></td></tr>
            <tr><td>Contrasena</td></tr>
            <tr><td><input type="password" name="contrasena_usuario"></td></tr>
            <tr><td><input type="submit" value="Ingresar"></td></tr>
        </table>
        <?php
        if(isset($_GET["error"]) && $_GET["error"] == 1){
            echo "<p style='color: red; text-align: center;'>Correo o contrasena incorrectos</p>";
        }
        ?>
    <a href="register.php" style="display: block; color: black; padding: 20px; font-size: 15px; text-align: right;">Registrarse</a>
    </form>
    

</body>
</html>