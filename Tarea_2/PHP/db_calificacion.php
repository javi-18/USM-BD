<?php
include "config.php";
include "nav.php";

$calif = $_POST["calif"];
$resena = $_POST["resena"];
$id_foo = $_GET["p1"];
$id_us = $_GET["p2"];
$nombre = $_GET["p3"];
$query = mysqli_query($conn, "INSERT into resenas (id_receta, resenia, calificacion, id_votante, tiempo, nombre_plato) values ('$id_foo','$resena', '$calif', '$id_us', SYSDATE(), '$nombre' )");
header("Location: index.php?enviado=1");
?>