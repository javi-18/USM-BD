<?php
include "config.php";
session_start();

if (!isset($_SESSION["correo"])) {
    header("Location: login.php");
    exit;
}
$correo = $_SESSION["correo"];
$id = $_SESSION["ID"];
if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar') {
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_correo = $_POST['correo'];
    echo $nuevo_correo;
    $nueva_password = $_POST['password'];
    $sql = "UPDATE usuario SET nombre='$nuevo_nombre', password='$nueva_password', correo = '$nuevo_correo' WHERE correo='$correo'";
    if (mysqli_query($conn, $sql)) {
        header("Location: user.php?cod=1");
        exit;
    } else {
        header("Location: user.php?error=1");
        exit;
    }
}

// Eliminar la cuenta
if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
    $sql = "DELETE FROM usuario WHERE correo = '$correo'";
    if (mysqli_query($conn, $sql)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        header("Location: user.php?error=2");
        exit;
    }
}
if (isset($_POST['accion']) && $_POST['accion'] === 'resenas') {
    $sql = "SELECT * resenas WHERE id_votante = '$id'";
    if (mysqli_query($conn, $sql)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        header("Location: user.php?error=2");
        exit;
    }
}



mysqli_close($conn);
?>