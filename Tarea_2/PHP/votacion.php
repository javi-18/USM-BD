<?php
include "config.php";
include "nav.php";
include "funciones.php";
$total = 0;
$id_usuario = 5;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/carrito_style.css">
    <title>Votaciones</title>
</head>

<body>
    <h1>Votacion de la semana para comida</h1>
    <?php
    $sql = "SELECT * FROM carrito WHERE usuario='$id_usuario';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $unidades = $row["cantidad"];
            if (!$row["producto_hotel"] == NULL) {
                $producto = $row["producto_hotel"];
                $tabla = "hoteles";
                $id_b = "Id";
            } elseif (!$row["producto_paquete"] == NULL) {
                $producto = $row["producto_paquete"];
                $tabla = "paquete";
                $id_b = "id_paquete";
            }

            $querry = "SELECT * FROM " . $tabla . " Where " . $id_b . "=" . $producto . ";";

            $resultado = mysqli_query($conn, $querry);
            if (mysqli_num_rows($resultado) > 0) {
                $inf = mysqli_fetch_assoc($resultado);
                $nombrep = $inf["nombre"];
                $precio = $inf["precio"];
            }
            $valor_paquete = $precio * $unidades;
            $total += $valor_paquete;



            echo ' 
            <div class="completo">
        <div class="cuerpo">
        <div class="opcion">
            <p class="imagen">
                
            </p>
            
            <div class="contenido">
                <p>Nombre: ' . $nombrep . '</p>
                <p>Cantidad: ' . $unidades . '</p>
                <p>valor: ' . $precio . '</p>
                <p>precio total: ' . $valor_paquete . '</p>

            </div>

            <div class="boton">
                <form method="post" action="' . $_SERVER['PHP_SELF'] . '">
                    <input type="submit" name="Eliminar" value="Eliminar">

                </form>
            </div>

        </div>
        </div>
        </div>';
        }

    }



    ?>
    <div class="descuento">
        <p>¿Tienes un código de descuento?</p>
        <form action="bd_carrito.php" method="POST">
            <label for="codigo_descuento">Código de descuento:</label>
            <input type="text" name="codigo_descuento" id="codigo_descuento" required>
            <button type="submit">Verificar</button>
        </form>
        <?php
        if (isset($_GET["error"]) && $_GET["error"] == 1) {
            echo "<p style='color: red; text-align: center;'>Código inválido</p>";
        } elseif (isset($_GET["cod"]) && $_GET["cod"] == 1) {
            echo "<p style='color: black; text-align: center;'>¡Descuento aplicado!</p>";
        }
        ?>
    </div>
    <?php



    echo '
    <div class="final">
    <p>Precio total: $' . $total . '</p>
    
    ';

    if (isset($_GET["cod"]) && $_GET["cod"] == 1) {
        $nuevo_total = 0.9 * $total;
        $descuento = 0.1 * $total;
        echo "Descuento: $$descuento";
        echo "<br>";
        echo "<br>";
        echo "Nuevo total: $$nuevo_total ";
    }

    echo '<div class="boton">
    <form method="post" action="' . $_SERVER['PHP_SELF'] . '">
        <input type="submit" name="comprar" value="comprar">
    </form>
</div>
</div>';

    ?>



</body>
<footer>
    <?php
    include "footer.php";
    ?>
</footer>

</html>