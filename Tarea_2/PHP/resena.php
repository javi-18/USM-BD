<?php

include "config.php";
include "funciones.php";
include "nav.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/whislist_styles.css">
    <title>Reseña</title>
</head>
<body>
<h1>Reseña</h1>
    <?php 
    $id_plato = $_GET["parametro1"];
    $nombre = $_GET["p2"];
    echo '<form method="post" action="db_calificacion.php?p1='.urldecode($id_plato).'&p2='.urldecode($_SESSION["ID"]).'&p3='.urldecode($nombre).'">
        <label for="calif">Calificacion del 1 al 5:</label>
        <select name="calif" id="calif">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br>
        <textarea name="resena" rows="10" cols="40">Escribe aquí tu resena</textarea>';
        echo '
        <br><br>
        <input type="submit" value="Enviar">'?>
    <?php
        if(isset($_GET["error"]) && $_GET["error"] == 1){
            echo "<p style='color: red; text-align: center;'>Correo o contrasena incorrectos</p>";
        }
        ?>
    </form>
</body>
</html>