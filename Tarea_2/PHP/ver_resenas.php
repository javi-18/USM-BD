<?php
include "config.php";
include "nav.php";
include "funciones.php";
$id = $_SESSION["ID"];
if (isset($_POST['accion']) && $_POST['accion'] === 'resenas') {
    $sql = "SELECT a.*, b.nombre_plato from (resenas a join receta b) WHERE (a.id_votante = '$id') and (a.id_receta = b.id_r) ORDER BY a.tiempo DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nombre_plato = $row["nombre_plato"];
            $calif = $row["calificacion"];
            $resennia = $row["resenia"];
            $time = $row["tiempo"];
            echo '
            <div class="pack">
                <h1>' . $nombre_plato . '</h1>
            <div class="info">
            <ul>
                <p>Calificacion puesta: '.$calif.'</p>
                <p>Comentario: '.$resennia.'<br</p>
                <p>Fecha y hora: '.$time.'<br></p>
                <form action="editar_resena.php?p1='.urldecode($time).'" method="POST">
                <label for="calif">Calificacion del 1 al 5:</label>
                    <select name="calif" id="calif">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select><br>
                <textarea name="resena" rows="10" cols="40">Edita aquí tu resena</textarea>
                <input type="submit" value="Guardar cambios">
                </form> <br>
                <a href="delete_resena.php?p1='.urldecode($time).'">Borrar Resena</a>
            </ul> 
            </div>>
            </div>
            ';
        }
    } else {
        echo "No tienes resenas";
        exit;
    }
}

?>



<?php

mysqli_close($conn);
?>
<?php
include "footer.php";
?>