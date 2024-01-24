<?php
include "config.php";
$nombre = $_POST["nombre_usuario"];
$pass = $_POST["contrasena_usuario"];


$query = mysqli_query($conn, "SELECT * FROM usuario WHERE correo = '" . $nombre . "' and password = '" . $pass . "'");
$nr = mysqli_num_rows($query);

if ($nr == 1) {
    session_start();
    $row = mysqli_fetch_assoc($query);
    $_SESSION["correo"] = $nombre;
    $_SESSION["nombre"] = $row["nombre"]; 
    $_SESSION["fecha"] = $row["fecha_nacimiento"]; 
    $_SESSION["ID"] = $row["id"];
    $query = mysqli_query($conn, "UPDATE usuario SET fecha_hora = SYSDATE() WHERE correo = '$nombre'");
    header("Location: index.php");
} else {
    header("Location: login.php?error=1");
}

mysqli_close($conn);
?>