<?php
include "config.php";
include "nav.php";

$tim = $_GET["p1"];
$query = mysqli_query($conn, "UPDATE resenas set resenia = '$resena' Where tiempo = '$tim'");
header("Location: index.php?enviado=3");
?>