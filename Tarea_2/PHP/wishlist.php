<?php
include "config.php";
include "nav.php";
include "funciones.php";

$id_us = $_SESSION["ID"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/whislist_styles.css">
    <title>Whishlist</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['Eliminar'])) {
            $valor = $_POST['valor1'];
            $con = remove($valor, "favoritos", "id_receta");
            $res = mysqli_query($conn, $con);
            echo "Plato";
    }}
    ?>
    <h1>Whishlist</h1>
    <?php
    $sql = "SELECT * FROM platos_favoritos WHERE id_user = '$id_us'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idusuario = $row["id_user"];
            $images = $row["foto"];
            $nombre_plato = $row["nombre_plato"];
            $tipo_plato = $row["tipo_plato"];
            $t_p = $row["tiempo_preparacion"];
            $diabet = $row["para_diabeticos"];
            $lact=$row["tiene_lactosa"]; 
            $gluten=$row["gluten"];
            $vegano=$row["vegano"];
            $id_plato = $row["id_r"];
            ;
            echo'
            <div class="tabla">
                    <img src="data:image/jpeg;base64,'.base64_encode($images).'" width="600" height="350">
                <div class="info">
            <ul>
              <li>Es : ' . $nombre_plato . '</li>';
              $sql1 = "SELECT AVG(calificacion) FROM resenas WHERE id_receta = '$id_plato'";
              $result1 = mysqli_query($conn, $sql1);
              $row1 = mysqli_fetch_assoc($result1);
              $puntuacion = $row1["AVG(calificacion)"];
              if (mysqli_num_rows($result1) > 0){
                  echo "<div class='info'>
                  <li>Calificacion ".$puntuacion." <br></li>
                  </div>";
              };
              echo'
            </ul>
          </div>
            <div class="boton2">
                <a href="plato.php?parametro1='.urldecode($id_plato).'">Más Información</a>
            </div>
            </div>
                </div>
    
                <div class="botones">
                    <form method ="post" action="' . $_SERVER["PHP_SELF"] . '">
                        <input type="hidden" name="valor1" value="' . $id_plato . '">
                        <input type="submit" name="Eliminar" value="Eliminar">
                        <input type="hidden" name="valor3" value="' . $idusuario . '">
                    </form>
                </div>
            </div>
            </div>';
        }
    }
    else {

        echo "<h1>No has agregado nada aun</h1>";
    }
    ?>

    <?php
    include "footer.php";
    ?>

</body>

</html>