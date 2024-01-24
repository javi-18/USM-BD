<?php
include "config.php";
include "nav.php";
include "funciones.php";

$id_us = $_SESSION["ID"];
if (isset($_POST["submit"])) {
    $sql = "SELECT * FROM receta where nombre_plato LIKE ".$_POST['search']."";
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
            header("Content-type: image/jpg");
            echo '
            <div class="pack">
                <p class="imagen">
                    <img src='.$images.' class="imagen">
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


};


?>