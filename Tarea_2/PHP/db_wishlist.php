<?php 
include "config.php";
include "nav.php";
include "funciones.php";
$id_us = $_SESSION["ID"];
$id_re = $_GET["parametro1"];
echo"".$id_us."".$id_re."";
$sql= "insert into favoritos (id_user, id_receta) values ('$id_us', '$id_re')";
$result = mysqli_query($conn,$sql);
header("Location: index.php?enviado=2")

?>