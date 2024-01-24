<?php

// Se crea un link entre la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bdt2";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Error al conectar: " . mysqli_connect_error());
}
?>