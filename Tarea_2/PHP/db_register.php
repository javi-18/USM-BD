<?php 
include "config.php";

function creatorID(){
    $random_id = rand(0,999);
    return $random_id;
};
$nombre = $_POST["nombre_usuario"];
$pass = $_POST["password_usuario"];
$correo = $_POST["correo_usuario"];

if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
    $query = mysqli_query($conn, "SELECT * FROM usuario WHERE correo = '$correo'");
    $nr = mysqli_num_rows($query);
    $random_user_id = creatorID();
    $query2 = mysqli_query($conn, "SELECT id FROM usuario WHERE id = '$random_user_id'");
    $nr2 = mysqli_num_rows($query2);
    if($nr == 0){
        while($nr2 != 0){
            $random_user_id = creatorID();
            $query2 = mysqli_query($conn, "SELECT id FROM usuario WHERE id = '$random_user_id'");
            $nr2 = mysqli_num_rows($query2);
        }
        $query3 = mysqli_query($conn, "INSERT INTO usuario (id, password, nombre, correo) VALUES ('$random_user_id', '$pass', '$nombre', '$correo')");
        header("Location: index.php");
    }
    else{
        header("Location: register.php?error=1");
    }
    
}
else{
    header("Location: register.php?error=2");
}

mysqli_close($conn)

?>