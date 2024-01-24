<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/index_styles.css">
    <title>Inicio</title>
</head>

<body>

    <?php
    include "nav.php";
    include "config.php";
    if (isset($_POST["buscador"])) {
        
    };
    if (isset($_SESSION["correo"])) {
        $nombre = $_SESSION["nombre"];
        // El usuario ha iniciado sesión
        echo '<div class="registro">
                <h1>Buscador</h1>
                <form method="post" action="busqueda.php">
                <tr><td><input type="text" name="search"></td></tr>
                <tr><td><input type="submit" name="enviar" ></td></tr>
                </form>
            </div>';
        $sql = "SELECT AVG(a.calificacion), b.nombre_plato from (resenas a join receta b) WHERE (a.id_receta = b.id_r) and (a.nombre_plato = b.nombre_plato) ORDER BY AVG(a.calificacion) DESC";
        $result = mysqli_query($conn, $sql);
        echo "Top 10 mejores platos";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombre_plato = $row["nombre_plato"];
                $calif = $row["AVG(a.calificacion)"];
                echo '
                <div class="pack">
                <ul><h1>' . $nombre_plato . '</h1>
                <div class="info">
                    <p>Calificacion puesta: '.$calif.'</p>
                </ul> 
                </div>
                </div>
                ';
            }
        } else {
            echo "No tienes resenas";
            exit;
        }
        $sql = "SELECT AVG(a.calificacion), b.nombre_plato from (resenas a join receta b) WHERE (a.id_receta = b.id_r) and (a.nombre_plato = b.nombre_plato) ORDER BY AVG(a.calificacion) ASC";
        $result = mysqli_query($conn, $sql);
        echo "Top 10 PEORES platos";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombre_plato = $row["nombre_plato"];
                $calif = $row["AVG(a.calificacion)"];
                echo '
                <div class="pack">
                <ul><h1>' . $nombre_plato . '</h1>
                <div class="info">
                    <p>Calificacion puesta: '.$calif.'</p>
                </ul> 
                </div>
                </div>
                ';
            }
        }
        else {
            echo "No tienes resenas";
            exit;
        }}
    else {
        echo' <div class="registro">
                <h1>Registrate si aun no lo has hecho</h1>
                <a href="register.php">Registrese</a>
            </div>';
    }

    ?>
    <?php

    
    if(isset($_GET["enviado"]) && $_GET["enviado"] == 1){
        echo "<h1>Resena ha sido enviada</h1>";
    }
    else if(isset($_GET["enviado"]) && $_GET["enviado"] == 2){
        echo "<h1>Se ha agregado exitosamente a favoritos</h1>";
    }
    else if(isset($_GET["enviado"]) && $_GET["enviado"] == 3){
        echo "<h1>Se ha eliminado exitosamente la resena</h1>";
    }
    else if(isset($_GET["enviado"]) && $_GET["enviado"] == 4){
        echo "<h1>Tu resena ha sido exitosamente editada</h1>";
    }
    include "footer.php";
    ?>

</body>

</html>