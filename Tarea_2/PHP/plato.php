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
?>

<?php

$id_plato = $_GET["parametro1"];
$sql = "SELECT * FROM receta WHERE id_r = '$id_plato'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        $images = $row["foto"];
        $nombre_plato1 = $row["nombre_plato"];
        $tipo_plato = $row["tipo_plato"];
        $t_p = $row["tiempo_preparacion"];
        $instru = $row["instrucciones"];
        $ingre= $row["Ingredientes"];
        $diabet = $row["para_diabeticos"];
        $lact=$row["tiene_lactosa"]; 
        $gluten=$row["gluten"];}};


echo '
 <center> <h1>'.$nombre_plato1.'</h1></center>
    <div class="pack">
        <p class="imagen">
            <img src="data:image/jpeg;base64,'.base64_encode($images).'" width="600" height="350">
        </p>
    </div>
    <div class="info">
      <b>Tipo de plato: ' . $tipo_plato . '<br>
      Tiempo de preparacion: '.$t_p.' horas.<br>
      Ingredientes: '.$ingre.'.<br>
      Instrucciones: '.$instru.'.<br>
      ';
    if ($diabet == 1){
        echo 'Para diabeticos: Si <br>';
    }
    else {
        echo 'Para diabeticos: No <br>';
    };
    if ($lact == 1){
        echo 'Tiene lactosa: Si<br>';
    }
    else {
        echo 'Tiene lactosa: No<br>';
    };if ($gluten == 1){
        echo 'Tiene Gluten: Si <br>';
    }
    else {
        echo 'Tiene Gluten: No <br>';
    };
    echo '
    <a href="resena.php?parametro1='.urldecode($id_plato).'&p2='.urldecode($nombre_plato1).'">Dar resena</a><br>
    <a href="db_wishlist.php?parametro1='.urldecode($id_plato).'">Agregar a favoritos</a><br>
    </b>
  </div>';
?>

<?php
$sql1 = "SELECT AVG(`b`.`calificacion`) from (`bdt2`.`usuario` `a` join `bdt2`.`resenas` `b`) where (`a`.`id` = `b`.`id_votante`) and (`b`.`id_receta`= ".$id_plato.")";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
$puntuacion = $row["AVG(`b`.`calificacion`)"];
if (mysqli_num_rows($result) > 0){
    echo "<div class='info'>
    <b>Calificacion ".$puntuacion." <br></b>
    </div>
    <h1> Resenas </h1>";
};

$sql2 = "SELECT * FROM user_resenas WHERE id_receta = '$id_plato'";
$result = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        $username = $row["nombre"];   
        $resenia = $row["resenia"];
        echo "<h2>".$username."</h2>
        <p>".$resenia." <br></p>";
    }}
else{
    echo "<h2>No hay resenas</h2>";
}
  include "footer.php";
mysqli_close($conn);
?>
    




