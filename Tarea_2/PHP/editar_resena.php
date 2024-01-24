<?php
include "config.php";
include "nav.php";
$tim = $_GET["p1"];
$resena = $_POST["resena"];
$calif = $_POST["calif"];
echo $resena;
$query = mysqli_query($conn, "UPDATE resenas set resenia = '$resena', calificacion = '$calif' Where tiempo = '$tim'");
header("Location: index.php?enviado=4");
?>