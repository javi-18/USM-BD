<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/platos.css">
    <title>Platos</title>
</head>

<?php
include "config.php";
include "nav.php";
include "funciones.php";
$variable1=1;
$variable2=1;
?>

<header class="titulo">
    <h1>Platos</h1>
</header>

<?php


$condiciones = '';

//if($condiciones ==''){ $sql = "SELECT * FROM info" ;} else{$sql = "SELECT * FROM info WHERE $condiciones ";}

$sql = "SELECT * FROM receta";

// Se realiza una consulta
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $images = $row["foto"];
        $nombre_plato = $row["nombre_plato"];
        $tipo_plato = $row["tipo_plato"];
        $t_p = $row["tiempo_preparacion"];
        $diabet = $row["para_diabeticos"];
        $lact=$row["tiene_lactosa"]; 
        $gluten=$row["gluten"];
        $vegano=$row["vegano"];
        $id_plato = $row["id_r"];
        echo '
        <div class="pack">
            <p class="imagen">
                <img src="data:image/jpeg;base64,'.base64_encode($images).'" class="imagen">
            </p>
        <div class="info">
        <ul>
          <li>Es : ' . $nombre_plato . '</li>
          <li>Tipo de plato: ' . $tipo_plato . '</li>';
        if ($diabet == 1){
            echo '<li>Para diabeticos: Si </li>';
        }
        else {
            echo '<li>Para diabeticos: No </li>';
        };
        if ($lact == 1){
            echo '<li>Tiene lactosa: Si</li>';
        }
        else {
            echo '<li>Tiene lactosa: No</li>';
        };if ($gluten == 1){
            echo '<li>Tiene Gluten: Si </li>';
        }
        else {
            echo '<li>Tiene Gluten: No </li>';
        };if ($vegano == 1){
            echo '<li>Es vegano: Si </li>';
        }
        else {
            echo '<li>Es vegano: No </li>';
        };
        echo '
        </ul>
      </div>
        <div class="boton2">
            <a href="plato.php?parametro1='.urldecode($id_plato).'">Más Información</a>
        </div>
        </div>
        ';
    }
} else {
    echo "No se encontraron resultados.";
    echo " ";
}
?>



<?php

mysqli_close($conn);
?>
<?php
include "footer.php";
?>